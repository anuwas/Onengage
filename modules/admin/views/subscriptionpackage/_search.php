<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SubscriptionPackageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subscription-package-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'subscription_package_id') ?>

    <?= $form->field($model, 'subscription_package_name') ?>

    <?= $form->field($model, 'subscription_package_description') ?>

    <?= $form->field($model, 'validto') ?>

    <?= $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'active') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
