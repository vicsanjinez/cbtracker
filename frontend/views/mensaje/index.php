<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MensajeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mensajes';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="mensaje-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mensaje', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
            if($model->estado  == 1)
            {
                return ['class' => 'warning'];
            }
            else if ($model->estado  == 2)
            {
                return ['class' => 'danger'];
            }
            else 
            {
                return ['class' => 'striped'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'idusuario',
                'value' => 'usuario.nombre'
            ],
            'contenido:ntext',
            'fechaevaluacion',
            'estado',
            //'idusuario',
            // 'idusuariodestino',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
