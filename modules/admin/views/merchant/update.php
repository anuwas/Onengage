<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Merchant */

$this->title = 'Update Merchant: ' . $model->merchant_id;
$this->params['breadcrumbs'][] = ['label' => 'Merchants', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->merchant_id, 'url' => ['view', 'id' => $model->merchant_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="merchant-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
