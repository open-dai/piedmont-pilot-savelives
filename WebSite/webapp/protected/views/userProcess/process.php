<?php
/* @var $this UserProcessController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
        'User Processes',
);

$this->menu=array(
        array('label'=>'Create UserProcess', 'url'=>array('create')),
        array('label'=>'Manage UserProcess', 'url'=>array('admin')),
);
?><?php Yii::app()->clientScript->registerScript('someScript', "

 
});
");
/*
$('#user-process-form').submit(function() {
    alert('testing');
});
*/
Yii::app()->clientScript->registerScript('someScript', "
 $('#myTab a').click(function(e) {
    e.preventDefault();
    $(this).tab('show');
})
");

Yii::app()->clientScript->registerScript('gioppofun1', "
function gioppofun1(form) {
$(form)[0][\"UserProcess[process]\"].value='<process><level id=\"1\"><action id=\"1\"><mailaddress>'+$.trim($('#mail11').val())+'</mailaddress><mailbody>'+$('<div/>').text($.trim($('#mailbody11').val())).html()+'</mailbody></action></level><level id=\"2\"><action id=\"1\"><mailaddress>'+$('#mail21').val()+'</mailaddress><mailbody>'+$('#mailbody21').val()+'</mailbody></action></level><level id=\"3\"><action id=\"1\"><mailaddress>'+$('#mail31').val()+'</mailaddress><mailbody>'+$('#mailbody31').val()+'</mailbody></action></level><level id=\"4\"><action id=\"1\"><mailaddress>'+$('#mail41').val()+'</mailaddress><mailbody>'+$('#mailbody41').val()+'</mailbody></action></level></process>';
alert($(form)[0][\"UserProcess[process]\"].value);
alert($('<div/>').text($.trim($('#mailbody11').val())).html());
//form.submit();
//            alert('test');
        return true;
};
",CClientScript::POS_HEAD);
$process = null;
if(!is_null($model)&&!is_null($model->process)){
$process = new SimpleXMLElement($model->process);
}
$mail11 = (is_null($process))?'':$process->xpath('/process/level[@id=1]/action[@id=1]/mailaddress');//print_r( $mail11[0]);echo $mail11[0];

?>
<html>
  <head>
    <meta name="generator"
    content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39" />
    <title></title>
  </head>
  <body>
    <!-- <h1>User Processes</h1>  --><?php //echo $model->process ?>
    <br /><?php //echo '"'.$code.'"' ?>
    <div class="form">
      <?php $form=$this->beginWidget('CActiveForm', array(
              'id'=>'user-process-form',
              'enableAjaxValidation'=>false,
			  'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
        'afterValidate'=>'js:gioppofun'
      ))); ?>
      <!--<p class="note">Fields with 
       <span class="required">*</span> are required.</p><?php // echo $form->errorSummary($model); ?> -->
	  <?php echo $form->errorSummary($model); ?>

      <div class="row">
        <?php //echo $form->labelEx($model,'user_code'); ?><?php echo $form->hiddenField($model,'user_code',array('size'=>45,'maxlength'=>45)); ?><?php // echo $form->error($model,'user_code'); ?>
      </div>
      <div class="row">
        <?php //echo $form->labelEx($model,'process'); ?><?php echo $form->textArea($model,'process',array('rows'=>6, 'cols'=>50,'style'=>'width: 570px; height: 80px;display:none')); ?><?php  echo $form->error($model,'process'); ?>
      </div>
      <div class="row">
        <div class="span11">
          <h3 class="header">Personalizza le azioni dei pulsanti</h3>
          <ul class="nav nav-tabs" id="myTab">
            <li class="active">
              <a href="#level1" data-toggle="tab">Livello 1</a>
            </li>
            <li>
              <a href="#level2" data-toggle="tab">Livello 2</a>
            </li>
            <li>
              <a href="#level3" data-toggle="tab">Livello 3</a>
            </li>
            <li>
              <a href="#level4" data-toggle="tab">Livello 4</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="level1">
            <h3>Livello 1</h3>Questo livello corrisponde al massimo livello di emergenza, verranno eseguite le azioni indicate,
            mandata la segnalazione dell&#39;incidente e effettuata la chiamata al 118
            <div class="span7">
     <!--           <h3 class="header">Azioni</h3> -->
              <div class="accordion" id="accordion1">
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne">Azione 1</a>
                  </div>
                  <div id="collapseOne" class="accordion-body collapse in">
                    <div class="accordion-inner">
                    <h4>Invio mail</h4>Con questa azione si invia una mail con il testo indicato al singolo indirizzo di posta. 
                    <input name="mail11" type="email"
                    value="<?php $mail11 = (is_null($process))?'':$process->xpath('/process/level[@id=1]/action[@id=1]/mailaddress');echo $mail11[0];?>" id="mail11" maxlength="30" /> 
                    <textarea rows="2" cols="40" name="mailbody11" id="mailbody11"><?php $mailbody11 = (is_null($process))?'':$process->xpath('/process/level[@id=1]/action[@id=1]/mailbody');echo $mailbody11[0];?></textarea></div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo">Collapsible
                    Group Item #2</a>
                  </div>
                  <div id="collapseTwo" class="accordion-body collapse">
                    <div class="accordion-inner">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                    richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.</div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree">Collapsible
                    Group Item #3</a>
                  </div>
                  <div id="collapseThree" class="accordion-body collapse">
                    <div class="accordion-inner">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                    richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.</div>
                  </div>
                </div>
              </div>
            </div></div>
            <div class="tab-pane" id="level2">
            <h3>Livello 2</h3>Questo livello ad un livello di emergenza tale da non richiedere l'intervento del 118, ma consente di scatenare le azioni opportune
            <div class="span7">
   <!--           <h3 class="header">Azioni</h3> -->
              <div class="accordion" id="accordion2">
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">Azione 1</a>
                  </div>
                  <div id="collapseFour" class="accordion-body collapse in">
                    <div class="accordion-inner">
                    <h4>Invio mail</h4>Con questa azione si invia una mail con il testo indicato al singolo indirizzo di posta. 
                    <input name="mail21" type="email"
                    value="<?php $mail21 = (is_null($process))?'':$process->xpath('/process/level[@id=2]/action[@id=1]/mailaddress');echo $mail21[0];?>" id="mail21" maxlength="30" /> 
                    <textarea rows="2" cols="40" name="mailbody11" id="mailbody21">
                      <?php $mailbody21 = (is_null($process))?'':$process->xpath('/process/level[@id=2]/action[@id=1]/mailbody');echo $mailbody21[0];?>
                    </textarea></div>
                  </div>
                </div>
              </div>
            </div></div>
            <div class="tab-pane" id="level3">
            <h3>Livello 3</h3>Questo livello ad un livello è utile per segnalare situazioni di imprevisti da non considerarsi incidenti, che però consentono di attivare comunque delle azioni
            <div class="span7">
    <!--           <h3 class="header">Azioni</h3> -->
              <div class="accordion" id="accordion3">
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapseFive">Azione 1</a>
                  </div>
                  <div id="collapseFive" class="accordion-body collapse in">
                    <div class="accordion-inner">
                    <h4>Invio mail</h4>Con questa azione si invia una mail con il testo indicato al singolo indirizzo di posta. 
                    <input name="mail31" type="email"
                    value="<?php $mail31 = (is_null($process))?'':$process->xpath('/process/level[@id=3]/action[@id=1]/mailaddress');echo $mail31[0];?>" id="mail31" maxlength="30" /> 
                    <textarea rows="2" cols="40" name="mailbody11" id="mailbody31">
                      <?php $mailbody31 = (is_null($process))?'':$process->xpath('/process/level[@id=3]/action[@id=1]/mailbody');echo $mailbody31[0];?>
                    </textarea></div>
                  </div>
                </div>
              </div>
            </div></div>
            <div class="tab-pane" id="level4">
            <h3>Livello 4</h3>Questo livello consente di segnalare un incidente cui si sta assistendo in modo da allertare il sistema sulla presenza di un incidente.
            <div class="span7">
    <!--           <h3 class="header">Azioni</h3> -->
              <div class="accordion" id="accordion4">
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion4" href="#collapseSix">Azione 1</a>
                  </div>
                  <div id="collapseSix" class="accordion-body collapse in">
                    <div class="accordion-inner">
                    <h4>Invio mail</h4>Con questa azione si invia una mail con il testo indicato al singolo indirizzo di posta. 
                    <input name="mail41" type="email"
                    value="<?php $mail41 = (is_null($process))?'':$process->xpath('/process/level[@id=4]/action[@id=1]/mailaddress');echo $mail41[0];?>" id="mail41" maxlength="30" /> 
                    <textarea rows="2" cols="40" name="mailbody41" id="mailbody41">
                      <?php $mailbody41 = (is_null($process))?'':$process->xpath('/process/level[@id=4]/action[@id=1]/mailbody');echo $mailbody41[0];?>
                    </textarea></div>
                  </div>
                </div>
              </div>
            </div></div>
          </div>
        </div>
      </div>
      <div class="row buttons">
        <?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save');
echo CHtml::ajaxSubmitButton($model->isNewRecord ? 'Create' : 'Save', null, array('beforeSend'=>'js:gioppofun1("#user-process-form")'));		?>
      </div><?php $this->endWidget(); ?>
      <script>
//$('#user-process-form').validate({
//submitHandler: function(form) {
//form.process='<process><level id="1"><action id="1"><mailaddress>'+$('#mail11').val()+'</mailaddress><mailbody>'+$('#mailbody11').val()+'</mailbody></action></level><level id="2"><action id="1"><mailaddress>'+$('#mail21').val()+'</mailaddress><mailbody>'+$('#mailbody21').val()+'</mailbody></action></level><level id="3"><action id="1"><mailaddress>'+$('#mail31').val()+'</mailaddress><mailbody>'+$('#mailbody31').val()+'</mailbody></action></level><level id="4"><action id="1"><mailaddress>'+$('#mail41').val()+'</mailaddress><mailbody>'+$('#mailbody41').val()+'</mailbody></action></level></process>';
//form.submit();
//alert('testing');
//["$(form)"][0]["UserProcess[process]"]

//}
</script>
    </div>
    <!-- form -->
  </body>
</html>
