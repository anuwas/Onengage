<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OutletSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Outlets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outlet-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Outlet', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'outlet_id',
            'brand_id',
            'outlet_name',
            'outlet_address:ntext',
            'outlet_email:email',
            // 'outlet_mobile',
            // 'outlet_contactperson',
            // 'created_date',
            // 'active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
