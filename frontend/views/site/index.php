<?php

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;

use dosamigos\chartjs\ChartJs;

use kartik\social\TwitterPlugin;

use yii\authclient\clients\Twitter;
use yii\authclient\OAuthToken;
            
use frontend\models\Mensaje;
use frontend\models\Usuario;

/* @var $this yii\web\View */

$this->title = 'CB Tracker';
?>
<div class="site-index">

    <div class="jumbotron">

        <h3>CB Tracker</h3>

        <p><a class="btn-large waves-effect waves-light orange" href="index.php?r=site/about">Say no to Cyberbullying</a></p>
    </div>




<div style="width: 100%">
        <div style="width: 50%; float: left; display: inline-block;">
        

        <?php 
            // Search Timeline
        echo TwitterPlugin::widget([
            'type' => TwitterPlugin::TIMELINE, 
            'settings' => ['widget-id' => '840125264826777600'],
            'timelineConfig' => ['search' => '#CB_HackForGood'],
            'options' => ['height'=>'600', 'width'=>'500']
        ]);
         
        ?>


            
        </div>

        <div style="width: 50%; display: inline-block;">
        
        <h5>Tweets Detectados</h5>            
        <?php 
            // Search Timeline
            $mensajes = Mensaje::find()
                             ->leftJoin('usuario', '`usuario`.`id` = `mensaje`.`idusuario`')
                            ->orderBy('id desc')
                            ->all();

            //var_dump($mensajes);
            ?>
            <div id="contenedor-mensajes">

        <?php
            foreach ($mensajes as $mensaje)
           {
             if($mensaje->estado == 1)
             {
                ?>
                <div id="test5">
                    <div class="row">
                          <div class="col s12">
                            <div class="card-panel red darken-4">
                              <span class="white-text">
                                <?php echo $mensaje->usuario['nombre'].$mensaje->contenido; ?>
                              </span>
                            </div>
                          </div>
                    </div>
                </div>
                <?php
             }
             else if ($mensaje->estado == 2)
             {
                ?>
                <div id="test5">
                    <div class="row">
                          <div class="col s12">
                            <div class="card-panel amber darken-1">
                              <span class="white-text">
                                <?php echo $mensaje->usuario['nombre'].$mensaje->contenido; ?>
                              </span>
                            </div>
                          </div>
                    </div>
                </div>
                <?php
             }
             else
             {


            ?>
                
           
        <?php
             }
           }
         
        ?>
        </div>

        </div>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                
            </div>
            
        </div>

    </div>
</div>

<script type="text/javascript">
    
    
    
    window.onload = setupRefresh;

    function setupRefresh() {
      setTimeout("refreshPage();", 5000); // milliseconds
    }
    function refreshPage() {
       window.location = location.href;
    }
    

    //NO FUNCIONA
    /*
    function refreshPage() {
       setTimeout("location.reload(true);",2000)"
    }
    */

    //NO FUNCIONA
    // function refresh() {
    //  $.pjax.reload({container:".contenedor-mensajes"});
    //  setTimeout(refresh, 1000); // restart the function every 5 seconds
    //  }
    //  refresh();
     
  </script> 