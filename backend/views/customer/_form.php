<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Location;


/* @var $this yii\web\View */
/* @var $model backend\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'zipcode')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Location::find()->all(),'id','zipcode'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a zipcode ...', 'id' => 'zipCode'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'province')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
$('#zipCode').change(function(){
	//alert('camibio');
	var idZipCode = $(this).val();


	$.get('index.php?r=location/get-city-province',{idZipCode : idZipCode}, function(data){
		//alert(data);
		var data = $.parseJSON(data);
		$('#customer-city').attr('value', data.city);
		$('#customer-province').attr('value', data.province);

		});
});
JS;
$this->registerJs($script);
?>