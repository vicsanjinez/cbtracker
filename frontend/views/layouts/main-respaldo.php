<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="index.php" class="brand-logo">Sistema 2.0</a>
      
      <ul class="right hide-on-med-and-down">
        <li><a href="index.php">Home</a></li>
      </ul>

      <ul class="right hide-on-med-and-down">
        <li><a href="index.php?r=site/about">About</a></li>
      </ul>

      <ul class="right hide-on-med-and-down">
        <li><a href="index.php?r=site/contact">Contact</a></li>
      </ul>

      <ul class="right hide-on-med-and-down">
        <li><a href="index.php?r=site/login">Login</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="index.php">Home</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="index.php?r=site/about">About</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="index.php?r=site/contact">Contact</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="index.php?r=site/login">Login</a></li>
      </ul>

      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
      
    </div>
  </nav>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>


<footer class="page-footer light-blue lighten-1">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Sistema inicial de Yii2</h5>
                <p class="grey-text text-lighten-4">Para mayor informacion puede consultar los websites de nuestros parners.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="www.google.es">Google</a></li>
                  <li><a class="grey-text text-lighten-3" href="www.facebook.es">Facebook</a></li>
                  <li><a class="grey-text text-lighten-3" href="www.ibm.com">IBM</a></li>
                  <li><a class="grey-text text-lighten-3" href="www.hp.com">HP</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            &copy; App Dimension <?= date('Y') ?>
            
            </div>
          </div>
        </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
