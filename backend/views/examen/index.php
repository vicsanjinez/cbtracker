<?php

use yii\helpers\Html;
//use yii\grid\GridView;

use kartik\grid\GridView;

use backend\models\PreguntaSearch;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ExamenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Examens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="examen-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Examen', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function($model, $key, $index, $column){
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function($model, $key, $index, $column){
                    $searchModel = new PreguntaSearch();
                    $searchModel->idexamen = $model->id;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                    return Yii::$app->controller->renderPartial('_preguntas', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                        ]);
                }
            ],

            'descripcion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
