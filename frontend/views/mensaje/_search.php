<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MensajeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mensaje-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'contenido') ?>

    <?= $form->field($model, 'fechaevaluacion') ?>

    <?= $form->field($model, 'estado') ?>

    <?= $form->field($model, 'idusuario') ?>

    <?php // echo $form->field($model, 'idusuariodestino') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
