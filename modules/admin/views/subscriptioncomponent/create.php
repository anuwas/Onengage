<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SubscriptionComponent */

$this->title = 'Create Subscription Component';
$modeltitle = 'Subscription Component';
$this->params['breadcrumbs'][] = ['label' => 'Subscription Components', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section role="main" class="content-body">
					<header class="page-header">
						<h2>Add <?= Html::encode($modeltitle) ?></h2>
					
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
					<div class="row">
									<div class="col-sm-6">
										<div class="mb-md">
											<a href="/onengage/admin" class="btn btn-primary">List of <?= Html::encode($this->title) ?></a>
										</div>
                                        </div>
                                        
								</div>
					<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>
						
								<h2 class="panel-title"><?= Html::encode($this->title) ?></h2>
							</header>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</section>
