    <div class="slider-bootstrap"><!-- start slider -->
    	<div class="slider-wrapper theme-default">
            <div id="slider-nivo" class="nivoSlider">
                <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/slider/ambulanza.jpg" data-thumb="<?php echo Yii::app()->theme->baseUrl;?>/img/slider/ambulanza.jpg" alt="" title="" />
                <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/slider/auto.jpg" data-thumb="<?php echo Yii::app()->theme->baseUrl;?>/img/slider/auto.jpg" alt="" title="" />
                <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/slider/aiuto.jpg" data-thumb="<?php echo Yii::app()->theme->baseUrl;?>/img/slider/aiuto.jpg" alt="" data-transition="slideInLeft"  />
                <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/slider/emergency.jpg" data-thumb="<?php echo Yii::app()->theme->baseUrl;?>/img/slider/emergency.jpg" alt="" title="" />
            </div>
        </div>

    </div> <!-- /slider -->
    
    
    <div class="shout-box">
        <div class="shout-text">
          <h1>SaveMe Ottieni l'aiuto che ti serve</h1>
        </div>
    </div>
    	<div class="row-fluid"><br/>
           SaveMe &egrave; l&rsquo;applicazione di social collaboration che pu&ograve; salvarti la vita, ed &egrave; un esempio di smart use delle informazioni che coinvolge le pubbliche amministrazioni e i dati in loro possesso. Nasce nell&rsquo;ambito del progetto Open-DAI, il progetto europeo per la realizzazione delle innovazioni tecnologiche utili alle pubbliche amministrazioni per la condivisione di open data, per la creazione di servizi innovativi e l&rsquo;apertura della conoscenza. E&rsquo; realizzato da Regione Piemonte, partner e capofila del progetto Open-DAI.
        </div>
        
        <hr>
        
        <div class="row-fluid">
            <div class="span9">
				<blockquote>
                  <h2>Chiamare il 118 con 2 &quot;tap&quot;</h2>
                  <small>ogni istante conta</small>
                </blockquote>
                <blockquote>
                  <h2>Avere i dati in tempo reale degli incidenti pu&ograve; aiutare a migliorare il traffico</h2>
                  <small>ridurre gli ingorghi riduce gli incidenti</small>
                </blockquote>
            </div>
            
            <div class="span3" style="text-align:center;">
            
            <h3 class="text-error">Scarica l'app!!</h3>
                        
			<a href="https://play.google.com/store/apps/details?id=saveus">
  <img alt="Android app on Google Play"
       src="https://developer.android.com/images/brand/en_app_rgb_wo_45.png" />
</a>
            <p> <small>* terms and conditions apply</small></p>
            </div>
            
        </div>
       
        
	
     
     
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/js/nivo-slider/jquery.nivo.slider.pack.js"></script>
    
     <script type="text/javascript">
    $(function() {
        $('#slider-nivo').nivoSlider({
			effect: 'boxRandom',
			manualAdvance:false,
			controlNav: false
			});
    });
    </script> <!--<script type="text/javascript">
    $(document).ready(function() {
        $('#slider-nivo2').nivoSlider();
    });
    </script>-->