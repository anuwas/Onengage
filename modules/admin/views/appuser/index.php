<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AppuserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Appusers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appuser-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Appuser', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'appuser_id',
            'user_type',
            'ref_id',
            'username',
            'password',
            // 'dept_designation',
            // 'name',
            // 'email:email',
            // 'mobile',
            // 'created_date',
            // 'login_token',
            // 'active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
