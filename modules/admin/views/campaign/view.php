<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Campaign */

$this->title = $model->campaign_id;
$modeltitle = 'Campaign';
$this->params['breadcrumbs'][] = ['label' => 'Campaigns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

   


<section role="main" class="content-body">
					<header class="page-header">
						<h2>View <?= Html::encode($modeltitle) ?></h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?= Yii::$app->homeUrl ?>dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span><?= Html::encode($modeltitle) ?></span></li>
								<li><span>View</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>
					<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>
						
								<?= Html::a('Update', ['update', 'id' => $model->campaign_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->campaign_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
							</header>
							<div class="row">
						
						<div class="col-md-12">
   <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'campaign_id',
            'group_id',
            'brand_id',
            'campaign_name',
            'campaign_description',
            'template_body:ntext',
            'start_date',
            'end_date',
            'status',
            'created_date',
            'active',
        ],
    ]) ?>
    </div>
						<!-- col-md-6 -->
						
					</div>
</section>

