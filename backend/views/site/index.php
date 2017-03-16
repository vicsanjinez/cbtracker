<?php

/* @var $this yii\web\View */

$this->title = 'Sistema 2.0';
?>
<div class="site-index">

    <div class="jumbotron">
        <?php Yii::$app->Util->hello(); ?>
        <br>

        <h1>Sistema 2.0</h1>

        <p class="lead"><?php echo Yii::t('app', 'Welcome')?></p>
        <p class="lead"><?php echo Yii::t('app', 'Adventure')?> Yii2 </p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">


    </div>
</div>
