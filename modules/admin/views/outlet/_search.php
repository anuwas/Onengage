<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OutletSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="outlet-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'outlet_id') ?>

    <?= $form->field($model, 'brand_id') ?>

    <?= $form->field($model, 'outlet_name') ?>

    <?= $form->field($model, 'outlet_address') ?>

    <?= $form->field($model, 'outlet_email') ?>

    <?php // echo $form->field($model, 'outlet_mobile') ?>

    <?php // echo $form->field($model, 'outlet_contactperson') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'active') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
