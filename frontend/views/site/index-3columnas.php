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
            
/* @var $this yii\web\View */

$this->title = 'Word Analizer';
?>
<div class="site-index">

    <div class="jumbotron">

        <h3>Word Analizer</h3>

        <p><a class="btn-large waves-effect waves-light orange" href="index.php?r=site/login">Say no to Cyberbullying</a></p>
    </div>




<div style="width: 100%">
        <div style="width: 35%; float: left; display: inline-block;">
        

        <?php 
            // Search Timeline
        echo TwitterPlugin::widget([
            'type' => TwitterPlugin::TIMELINE, 
            'settings' => ['widget-id' => '840125264826777600'],
            'timelineConfig' => ['search' => '#hackforgood'],
            'options' => ['height'=>'600', 'width'=>'500']
        ]);
         
        ?>


            
        </div>

        <div style="width: 35%; display: inline-block;">
            
        <?php 
            // Search Timeline
        echo TwitterPlugin::widget([
            'type' => TwitterPlugin::TIMELINE, 
            'settings' => ['widget-id' => '840125264826777600'],
            'timelineConfig' => ['search' => '#hackforgood'],
            'options' => ['height'=>'600', 'width'=>'500']
        ]);
         
        ?>

        </div>

        <div style="width: 30%; float: right; display: inline-block;">
        
        
        <?php 
            // Search Timeline
        echo TwitterPlugin::widget([
            'type' => TwitterPlugin::TIMELINE, 
            'settings' => ['widget-id' => '840125264826777600'],
            'timelineConfig' => ['search' => '#hackforgood'],
            'options' => ['height'=>'600', 'width'=>'500']
        ]);
         
        ?>


            
        </div>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. </p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            
        </div>

    </div>
</div>
