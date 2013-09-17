<section id="navigation-main">  
<div class="navbar">
	<div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
  
          <div class="nav-collapse">
			<?php $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'nav'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
					'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
                    'items'=>array(
						array('label'=>'Home', 'url'=>array('/site/index')),
						array('label'=>'Progetto', 'url'=>array('/site/page', 'view'=>'progetto'),'linkOptions'=>array("data-description"=>"il progetto SaveMe"),),
						array('label'=>'Legal', 'url'=>array('/site/page', 'view'=>'legale'),'linkOptions'=>array("data-description"=>"aspetti legali"),),
						array('label'=>'Register', 'url'=>array('/Registration/registration'), 'visible'=>Yii::app()->user->isGuest),
						array('label'=>'Admin', 'url'=>array('/user/user/index'), 'visible'=>Yii::app()->user->isAdmin()),
                        array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about'),'linkOptions'=>array("data-description"=>"what we are about"),),
						array('label'=>'il mio processo', 'url'=>array('/userprocess/ownprocess', 'view'=>'ownprocess'),'visible'=>!Yii::app()->user->isGuest,'linkOptions'=>array("data-description"=>"gestione del proprio processo"),),
                        array('label'=>'Login', 'url'=>array('/user/user/login'), 'visible'=>Yii::app()->user->isGuest,'linkOptions'=>array("data-description"=>"member area")),
                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest,'linkOptions'=>array("data-description"=>"member area")),
                    ),
                )); ?>
    	</div>
    </div>
	</div>
</div>
</section><!-- /#navigation-main -->