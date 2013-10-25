<?php

Yii::import('application.modules.registration.controllers.YumRegistrationController');

class RegistrationController extends YumRegistrationController {
 public function actionRegistration() {
        Yii::import('application.modules.profile.models.*');
		$form = new YumRegistrationForm;
        $profile = new YumProfile;
		
		$this->performAjaxValidation('YumRegistrationForm', $form);
 
        if (isset($_POST['YumRegistrationForm'])) { 
			$form->attributes = $_POST['YumRegistrationForm'];
			$profile->attributes = $_POST['YumProfile'];
 $profile->user_code = uniqid();
 
 $form->validate();
			$profile->validate();
            if(!$form->hasErrors() && !$profile->hasErrors()) {
				$user = new YumUser;
				$user->register($form->username, $form->password, $profile);
				$user->profile = $profile;
				
				$process=new UserProcess;
				$process->process = '<process><level id="1"><action id="1"><mailaddress></mailaddress><mailbody></mailbody></action></level><level id="2"><action id="1"><mailaddress></mailaddress><mailbody></mailbody></action></level><level id="3"><action id="1"><mailaddress></mailaddress><mailbody></mailbody></action></level><level id="4"><action id="1"><mailaddress></mailaddress><mailbody></mailbody></action></level></process>';
				$process->user_code = $profile->user_code;
				$process->save();
				$this->sendRegistrationEmail($user,$form->password);
				Yum::setFlash('Thank you for your registration. Please check your email.');
				$this->redirect(Yum::module()->loginUrl);
            }
 }
        $this->render(Yum::module('registration')->registrationView, array(
					'form' => $form,
					'profile' => $profile,
					)
                );  
    }
	
	public function sendRegistrationEmail($user, $password) {
            if (!isset($user->profile->email)) {
                throw new CException(Yum::t('Email is not set when trying to send Registration Email'));
            }
            $activation_url = $user->getActivationUrl();
 
  //          if (is_object($content)) {
                    $body = strtr('Hi, {email}, your new password is "{password}". Your code is "{user_code}".Please activate your account by clicking this link: {activation_url}', array(
                                '{email}' => $user->profile->email,
                                '{password}' => $password,
								'{user_code}' => $user->profile->user_code,
                                '{activation_url}' => $activation_url));
 
                $mail = array(
                        'from' => Yum::module('registration')->registrationEmail,
                        'to' => $user->profile->email,
                        'subject' => 'Your registration on SaveUs',
                        'body' => $body,
                        );
          //      $sent = YumMailer::send($mail);
				
				Yii::app()->mailer->Host = '194.116.110.17';
Yii::app()->mailer->IsSMTP();
Yii::app()->mailer->From = Yum::module('registration')->registrationEmail;
Yii::app()->mailer->FromName = 'saveus@cloudlabcsi.eu';
Yii::app()->mailer->SMTPAuth = "true";
Yii::app()->mailer->Username = "saveus@cloudlabcsi.eu";
Yii::app()->mailer->Password =  '1!Saveus';
//Yii::app()->mailer->AddReplyTo('wei@pradosoft.com');
Yii::app()->mailer->AddAddress($user->profile->email);
Yii::app()->mailer->Subject = 'Yii rulez!';
Yii::app()->mailer->Body = $body;
$sent = Yii::app()->mailer->Send();
				
    //        }
 
            return $sent;
        }
}