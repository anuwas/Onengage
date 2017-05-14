<?php
namespace app\models;

use Yii;
use app\models\SubscriptionPackage;

class SubscriptionPackageCustom extends SubscriptionPackage{
	
	public function getSubscriptionPackageDetailsComponent()
	{
		return $this->hasMany(SubscriptionPackageDetail::className(), ['subscription_package_id' => 'subscription_package_id'])->with('subscriptionComponent');
	}
	
}