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

$this->title = 'Sistema 2.0';
?>
<div class="site-index">

    <div class="jumbotron">

        <?php

            /* 
            // create your OAuthToken 
            $token = new OAuthToken([
                'token' => Yii::$app->params['twitterAccessToken'],
                'tokenSecret' => Yii::$app->params['twitterAccessTokenSecret']
            ]);
             
            // start a Twitter Client and configure your access token with your
            // recently created token
            $twitter = new Twitter([
                'accessToken' => $token,
                'consumerKey' => Yii::$app->params['twitterApiKey'],
                'consumerSecret' => Yii::$app->params['twitterApiSecret']
            ]);
             
            var_dump($twitter->api('statuses/home_timeline.json', 'GET'));
            die();
            */

        ?>


        <?php 
            // Search Timeline
        echo TwitterPlugin::widget([
            'type' => TwitterPlugin::TIMELINE, 
            'settings' => ['widget-id' => '840125264826777600'],
            'timelineConfig' => ['search' => '#hackforgood'],
            'options' => ['height'=>'350', 'width'=>'500']
        ]);
         
        ?>

        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>


        <p><a class="btn-large waves-effect waves-light orange" href="#">Get started with Yii</a></p>
    </div>




<div style="width: 100%">
        <div style="width: 50%; float: left; display: inline-block;">
            
        <?php
        
            $coord = new LatLng(['lat' => 39.720089311812094, 'lng' => 2.91165944519042]);
            $map = new Map([
                'center' => $coord,
                'zoom' => 14,
            ]);

            // lets use the directions renderer
            $home = new LatLng(['lat' => 39.720991014764536, 'lng' => 2.911801719665541]);
            $school = new LatLng(['lat' => 39.719456079114956, 'lng' => 2.8979293346405166]);
            $santo_domingo = new LatLng(['lat' => 39.72118906848983, 'lng' => 2.907628202438368]);

            // setup just one waypoint (Google allows a max of 8)
            $waypoints = [
                new DirectionsWayPoint(['location' => $santo_domingo])
            ];

            $directionsRequest = new DirectionsRequest([
                'origin' => $home,
                'destination' => $school,
                'waypoints' => $waypoints,
                'travelMode' => TravelMode::DRIVING
            ]);

            // Lets configure the polyline that renders the direction
            $polylineOptions = new PolylineOptions([
                'strokeColor' => '#FFAA00',
                'draggable' => true
            ]);

            // Now the renderer
            $directionsRenderer = new DirectionsRenderer([
                'map' => $map->getName(),
                'polylineOptions' => $polylineOptions
            ]);

            // Finally the directions service
            $directionsService = new DirectionsService([
                'directionsRenderer' => $directionsRenderer,
                'directionsRequest' => $directionsRequest
            ]);

            // Thats it, append the resulting script to the map
            $map->appendScript($directionsService->getJs());

            // Lets add a marker now
            $marker = new Marker([
                'position' => $coord,
                'title' => 'My Home Town',
            ]);

            // Provide a shared InfoWindow to the marker
            $marker->attachInfoWindow(
                new InfoWindow([
                    'content' => '<p>This is my super cool content</p>'
                ])
            );

            // Add marker to the map
            $map->addOverlay($marker);

            // Now lets write a polygon
            $coords = [
                new LatLng(['lat' => 25.774252, 'lng' => -80.190262]),
                new LatLng(['lat' => 18.466465, 'lng' => -66.118292]),
                new LatLng(['lat' => 32.321384, 'lng' => -64.75737]),
                new LatLng(['lat' => 25.774252, 'lng' => -80.190262])
            ];

            $polygon = new Polygon([
                'paths' => $coords
            ]);

            // Add a shared info window
            $polygon->attachInfoWindow(new InfoWindow([
                    'content' => '<p>This is my super cool Polygon</p>'
                ]));

            // Add it now to the map
            $map->addOverlay($polygon);


            // Lets show the BicyclingLayer :)
            $bikeLayer = new BicyclingLayer(['map' => $map->getName()]);

            // Append its resulting script
            $map->appendScript($bikeLayer->getJs());

            // Display the map -finally :)
            echo $map->display();

            ?>
        </div>

        <div style="width: 50%; display: inline-block;">
            <?php 
                
                echo \yii2mod\c3\chart\Chart::widget([
            'options' => [
                    'id' => 'popularity_chart'
            ],
            'clientOptions' => [
               'data' => [
                    'x' => 'x',
                    'columns' => [
                        ['x', 'week 1', 'week 2', 'week 3', 'week 4'],
                        ['Popularity', 10, 20, 30, 50]
                    ],
                    'colors' => [
                        'Popularity' => '#4EB269',
                    ],
                ],
                'axis' => [
                    'x' => [
                        'label' => 'Month',
                        'type' => 'category'
                    ],
                    'y' => [
                        'label' => [
                            'text' => 'Popularity',
                            'position' => 'outer-top'
                        ],
                        'min' => 0,
                        'max' => 100,
                        'padding' => ['top' => 10, 'bottom' => 0]
                    ]
                ]
            ]
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
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
