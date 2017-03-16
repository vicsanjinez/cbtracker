<?php

/* @var $this \yii\web\View */
/* @var $content string */

use macgyer\yii2materializecss\lib\Html;
use macgyer\yii2materializecss\widgets\Nav;
use macgyer\yii2materializecss\widgets\NavBar;
use macgyer\yii2materializecss\widgets\Breadcrumbs;
use macgyer\yii2materializecss\widgets\Alert;

use frontend\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


    <header class="page-header">
            <?php
            NavBar::begin([
                'brandLabel' => 'CB Tracker',
                'brandUrl' => Yii::$app->homeUrl,
                'fixed' => false,
                'wrapperOptions' => [
                    'class' => 'container'
                ],
                'options' => [
                    'class' => 'navbar-nav light-blue lighten-1 waves-effect waves-light',
                ],
            ]);

            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'About', 'url' => ['/site/about']],
                ['label' => 'Graphic', 'url' => ['/site/grafico']],
                ['label' => 'Contact', 'url' => ['/site/contact']],
            ];
            if (Yii::$app->user->isGuest) {
                //$menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                //$menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
                

            } else {
                $menuItems[] = '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-flat']
                    )
                    . Html::endForm()
                    . '</li>';
            }

            echo Nav::widget([
                'options' => ['class' => 'right'],
                'items' => $menuItems,

            ]);

            NavBar::end();
            ?>
        </header>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => [
                    'class' => 'navbar-nav light-blue lighten-1',
                ],
        ]) ?>

        <?= Alert::widget() ?>

        <?= $content ?>
    </div>



<footer class="page-footer light-blue lighten-1">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Hack For Good 2017</h5>
                <p class="grey-text text-lighten-4">Sistema desarrollado el grupo W1Z4RDS.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Siguenos</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="https://twitter.com/david">David</a></li>
                  <li><a class="grey-text text-lighten-3" href="https://twitter.com/manuel">Manuel</a></li>
                  <li><a class="grey-text text-lighten-3" href="https://twitter.com/GrealiHD">Ruben</a></li>
                  <li><a class="grey-text text-lighten-3" href="https://twitter.com/RaulBG_">Raul</a></li>
                  <li><a class="grey-text text-lighten-3" href="https://twitter.com/victorsanjinez">Victor</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            &copy; CopyLeft <?= date('Y') ?>
            
            </div>
          </div>
        </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
