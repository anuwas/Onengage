<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Template */

$this->title = 'Update Template: ' . $model->template_id;
$modeltitle = 'Template';
$this->params['breadcrumbs'][] = ['label' => 'Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->template_id, 'url' => ['view', 'id' => $model->template_id]];
$this->params['breadcrumbs'][] = 'Update {modelClass}';
?>


<section role="main" class="content-body">
					<header class="page-header">
						<h2><?= Html::encode($this->title) ?></h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?= Yii::$app->homeUrl ?>dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span><?= Html::encode($modeltitle) ?></span></li>
								<li><span><?= Html::encode($this->title) ?></span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</section>
