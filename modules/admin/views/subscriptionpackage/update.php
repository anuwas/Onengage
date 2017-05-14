<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SubscriptionPackage */

$this->title = 'Update Subscription Package: ' . $model->subscription_package_id;
$modeltitle = 'Subscription Package';
$this->params['breadcrumbs'][] = ['label' => 'Subscription Packages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->subscription_package_id, 'url' => ['view', 'id' => $model->subscription_package_id]];
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
