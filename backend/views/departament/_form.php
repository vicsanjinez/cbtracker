<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use backend\models\Company;
use backend\models\Branch;

/* @var $this yii\web\View */
/* @var $model backend\models\Departament */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departament-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'idcompany')->dropDownList(
        	ArrayHelper::map(Company::find()->all(),'id','name'),
        	[
                'prompt'=>'Select Company',
                'onchange'=>'
                    $.post("index.php?r=branch/lists&id='.'"+$(this).val(), function(data){
                        $("select#departament-idbranch").html(data);
                    });'
            ]) 
    ?>

    <?= $form->field($model, 'idbranch')->dropDownList(
    	ArrayHelper::map(Branch::find()->all(),'id','name'),
    	['prompt'=>'Select Branch']
    	) 
    ?>
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
