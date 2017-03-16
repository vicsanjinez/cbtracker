<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Departament */

$this->title = 'Create Departament';
$this->params['breadcrumbs'][] = ['label' => 'Departaments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departament-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
