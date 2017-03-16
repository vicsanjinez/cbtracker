<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DepartamentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departaments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departament-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Departament', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'datecreated',
            'status',
            //'company.name',
            [
                'attribute' => 'idcompany',
                'value' => 'company.name'
            ],
            //'branch.name',
            [
                'attribute' => 'idbranch',
                'value' => 'branch.name'
            ],
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
