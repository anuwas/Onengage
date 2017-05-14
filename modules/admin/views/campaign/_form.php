<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Campaign */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
						
						<div class="col-md-12">

    <?php $form = ActiveForm::begin(); ?>
<section class="panel">
									
									<div class="panel-body">
        <?= $form->field($model, 'group_id')->textInput() ?>

        
                <?= $form->field($model, 'brand_id')->textInput() ?>

        
                <?= $form->field($model, 'campaign_name')->textInput(['maxlength' => true]) ?>

        
                <?= $form->field($model, 'campaign_description')->textInput(['maxlength' => true]) ?>

        
                <?= $form->field($model, 'template_body')->textarea(['rows' => 6]) ?>

        
                <?= $form->field($model, 'start_date')->textInput() ?>

        
                <?= $form->field($model, 'end_date')->textInput() ?>

        
                <?= $form->field($model, 'status')->textInput() ?>

        
                <?= $form->field($model, 'created_date')->textInput() ?>

        
                <?= $form->field($model, 'active')->textInput() ?>

        
            <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>
</section>
    <?php ActiveForm::end(); ?>

</div>
						<!-- col-md-6 -->
						
					</div>
