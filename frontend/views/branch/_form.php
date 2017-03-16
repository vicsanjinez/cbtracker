<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Branch */
/* @var $form yii\widgets\ActiveForm */

use macgyer\yii2materializecss\widgets\form\DatePicker;
?>

<div class="branch-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'datecreated')->textInput(); ?>

    <?= DatePicker::widget([
        'name' => 'datepicker_example',
        'options' => ['placeholder' => 'Select date'],
        'clientOptions' => [
            'format' => 'yyyy-mm-dd'
    ]
]); ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'idcompany')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
