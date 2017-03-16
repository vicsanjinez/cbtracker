<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="login-box">
      <div class="login-logo">
        <a href="../../backend/web/index.php?r=site/login"><b>Sistema</b>2.0</a>
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>



            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username', ['options' =>[
                        'tag' => 'div',
                        'class' => 'form-group field-loginform-username has-feedback required'
                    ],
                    'template' => '{input}<span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    {error}{hint}'
                    ])->textInput(['placeholder' => 'Username']) ?>

                <?= $form->field($model, 'password', ['options' =>[
                        'tag' => 'div',
                        'class' => 'form-group field-loginform-password has-feedback required'
                    ],
                    'template' => '{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    {error}{hint}'
                    ])->passwordInput(['placeholder' => 'Password']) ?>

                <?= $form->field($model, 'rememberMe', ['options' =>[
                        'tag' => 'div',
                        'class' => 'col-xs-8'
                    ],
                    'template' => '{input}<span class="checkbox icheck"></span>'
                    ])->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
