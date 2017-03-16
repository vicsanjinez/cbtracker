<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use backend\models\Company;

use kartik\select2\Select2;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Branch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branch-form">

    <?php $form = ActiveForm::begin([
        'id' => $model->formName(),
        'enableAjaxValidation' => true,
        'validationUrl' => Url::toRoute('branch/validation'),
        ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?php
        /* 
        echo $form->field($model, 'idcompany')->dropDownList(
    	   ArrayHelper::map(Company::find()->all(),'id','name'),
    	   ['prompt'=>'Select Company']
    	) 
        */
    ?>

    
    <?php echo $form->field($model, 'idcompany')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Company::find()->all(),'id','name'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS

    $('form#{$model->formName()}').on('beforeSubmit', function(e)
    {
        var \$form = $(this);
        $.post(
            \$form.attr("action"),
            \$form.serialize()
            )
            
            .done(function(result){
                //console.log(result);
                if(result == 1)
                {
                    $(document).find('#modal').modal('hide');
                    $(\$form).trigger("reset");
                    $.pjax.reload({container:'#branch-grid'});
                }
                else
                {
                    $("#message").html(result);
                }
            }).fail(function(){
                console.log("server error");
            });
        return false;    
    });
JS;
$this->registerJs($script);
?>