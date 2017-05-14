<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SubscriptionPackage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
						
						<div class="col-md-12">

    <?php $form = ActiveForm::begin(); ?>
<section class="panel">
									
									<div class="panel-body">
        <?= $form->field($model, 'subscription_package_name')->textInput(['maxlength' => true]) ?>

        
                <?= $form->field($model, 'subscription_package_description')->textInput(['maxlength' => true]) ?>

        
                <?= $form->field($model, 'validto')->textInput() ?>

        
                

        
            <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>
</section>
    <?php ActiveForm::end(); ?>

</div>
						<!-- col-md-6 -->
						
					</div>
