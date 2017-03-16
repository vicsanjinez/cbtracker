<?php

use yii\helpers\Html;
//use yii\grid\GridView;

use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\grid\GridView;

use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BranchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branch-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <p>
        <?= Html::button('Create Branch',['value' => Url::to('index.php?r=branch/create'),'class' => 'btn btn-success', 'id'=>'modalButton']) ?>
    </p>

    <?php
        Modal::begin(
                [
                    'header' => '<h4>Branch</h4>',
                    'id' => 'modal',
                    'size' => 'modal-lg',
                ]
            );

        echo "<div id='modalContent'></div>";

        Modal::end();
    ?>

<?php 
    $this->params['test'] = 'esta es una prueba';
    $this->beginBlock('advertisment');
?>
<h3>esta es una preuba de blocks</h3>
<?php
    $this->endBlock();
 ?>

    <?php
        $gridColumns = [
            'name',
            'address',
            'datecreated',
            'status',
        ];

        echo ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns,
            ]);
    ?>
    
    <?= GridView::widget([
        'id' => 'branch-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'export' => false,
        'rowOptions' => function($model){
            if($model->status  == 0)
            {
                return ['class' => 'danger'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'idcompany',
                'value' => 'company.name'
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'name',
            ],
            'address',
            'datecreated',
            'status',
            //'idcompany',
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
</div>
