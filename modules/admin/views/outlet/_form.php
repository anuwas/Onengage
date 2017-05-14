<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Outlet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="outlet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'brand_id')->textInput() ?>

    <?= $form->field($model, 'outlet_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'outlet_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'outlet_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'outlet_mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'outlet_contactperson')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
