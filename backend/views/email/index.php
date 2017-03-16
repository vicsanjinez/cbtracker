<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EmailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Emails';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Email', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'receivername',
            'receiveremail:email',
            'subject',
            'content',
            // 'attachment',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
