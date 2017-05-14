<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Outlet */

$this->title = 'Update Outlet: ' . $model->outlet_id;
$this->params['breadcrumbs'][] = ['label' => 'Outlets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->outlet_id, 'url' => ['view', 'id' => $model->outlet_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="outlet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
