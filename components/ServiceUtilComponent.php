<?php
namespace app\components;

use app\models\Merchant;
use Yii;
use yii\base\Component;
use app\models\Store;
use app\models\Customer;
use app\models\Brand;
use app\models\Outlet;
use app\models\Appuser;
use app\models\Coupon;

class ServiceUtilComponent extends Component{
	
	
	public function getMerchantIdByToken($token){
		Yii::info('Inside ServiceUtilComponent.getMerchantIdByToken ', 'service');
		$merchant=Merchant::findOne(['login_token'=>$token]);
		return $merchant->merchant_id;
	}
	
	public function getStoreNoByToken($token){
		Yii::info('Inside ServiceUtilComponent.getStoreNoByToken ', 'service');
		$store=Store::find()->where(['merchant_id'=>$this->getMerchantIdByToken($token)])->count();
		return $store;
	}
	
	public function getCustomerByPhoneNumber($phone,$merchantId){
		Yii::info('Inside ServiceUtilComponent.getCustomerByPhoneNumber, phone number  '.$phone.' , merchantId '.$merchantId, 'service');
		$status='';
		//$customer=Customer::find()->where(['mobile'=>$phone,'merchant_id'=>$merchantId])->count();
		$customer=Customer::find()->where(['mobile'=>$phone,'merchant_id'=>$merchantId])->count();
		if($customer>0){
			$status='duplicate';
		}else{
			$customer=Customer::find()->where(['mobile'=>$phone])->count();
			if($customer>0){
				$status='copy';
			}else{
				$status='new';
			}
		}
		
		return $status;
	}
	
	public function getBrandIdFromOutletId($outletid){
		Yii::info('Inside ServiceUtilComponent.getBrandIdFromOutletId ', 'service');
		$outlet=Outlet::findOne(['outlet_id'=>$outletid]);
		return $outlet->brand_id;
		
	}
	
	public function getCouponIdfromCouponCode($couponcode){
		Yii::info('Inside ServiceUtilComponent.getBrandIdFromOutletId ', 'service');
		$coupon=Coupon::findOne(['coupon_code'=>$couponcode]);
		return $coupon->coupon_id;
	}
}