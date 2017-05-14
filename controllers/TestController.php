<?php

namespace app\controllers;

use yii\db\Query;
use app\models\Merchant;
use app\models\SubscriptionPackage;
use app\models\PromotionGroup;
use app\models\CustomerOutletVisit;
use app\models\Campaign;
use app\models\SubscriptionPurchase;

class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	
    	
    	/* $date=new \DateTime();
    	$dt=date('Y-m-d-h-m-s');
    	echo $dt;
    	echo base64_decode('Ymlzd2FzQGdtYWlsLmNvbS0xLTIwMTctMDMtMTEtMDQtMDMtNDk='); */
    	$status=array();
    	/* $leadsCount = Lead::find()
    	->select(['COUNT(*) AS cnt'])
    	->where('approved = 1')
    	->groupBy(['promoter_location_id', 'lead_type_id'])
    	->all(); */
    	
    	//$connection = \Yii::$app->db;
    	//$list= $connection->createCommand('select count(*) as cnt,sum(purchase_amount) as totamt,customer_id from onengage.customer_outlet_visit where brand_id=:brand group by customer_id')->bindValue('brand',1)->queryAll();
    	
    	$status=array();
    	$customerarr=array();
    		$subscriptionpack=SubscriptionPackage::find()->joinWith('subscriptionPackageDetails')->all();
    		foreach ($subscriptionpack as $values){
    			foreach ($values->subscriptionPackageDetails as $packvalues){
    				$customerarr[]=array('component'=>$packvalues->subscriptionComponent->component_name,'quantity'=>$packvalues->quantity);
    			}
    			//$status[]=array($values->subscription_package_name=>$packdeial);
    		}
    	print_r($status);
    }

}
