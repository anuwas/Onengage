<?php
namespace app\components;
use Yii;
use app\models\Merchant;
use app\models\Appuser;

class ServicevalidationComponent{
	
	
	public static function commonCheckParam($inputJSON,$fromAction){
		Yii::info('Inside ServicevalidationComponent.commonCheckParam', 'service');
		Yii::info('Input parameter '.$inputJSON.' From Action '.$fromAction, 'service');
		$status=true;
		$input= json_decode($inputJSON, TRUE );
		foreach ($input as $key => $value) {
			if($key=='' || $value==''){
				$status=false;
				Yii::error('Inside ServicevalidationComponent.marchantLogin. Parameter Missing '.$key.' or '.$value, 'service');
			}
		}
		return $status;
	}
	
	public static function checkUser($inputJSON,$fromAction){
		Yii::info('Inside ServicevalidationComponent.checkUser', 'service');
		Yii::info('Input parameter '.$inputJSON.' From Action '.$fromAction, 'service');
		$status=true;
		$input= json_decode($inputJSON, TRUE );
		if(!isset($input['UserId'])){
			$status=false;
		}else{
			$appuser=Appuser::findOne(['appuser_id'=>$input['UserId']]);
			if($appuser==''){
				$status=false;
			}
		}
		return $status;
	}
	
	public static function checkToken($inputJSON,$fromAction){
		Yii::info('Inside ServicevalidationComponent.commonCheckParam', 'service');
		Yii::info('Input parameter '.$inputJSON.' From Action '.$fromAction, 'service');
		$status=true;
		$input= json_decode($inputJSON, TRUE );
		if(!isset($input['token'])){
			$status=false;
		}else{
			$token=$input['token'];
			$marchent=Merchant::findOne(['merchant_id'=>$input['merchantId']]);
			if($marchent['login_token']!==$input['token']){
				$status=false;
			}
		}
		return $status;
	}
	
	public static function checkOnlyToken($inputJSON,$fromAction){
		Yii::info('Inside ServicevalidationComponent.checkOnlyToken', 'service');
		Yii::info('Input parameter '.$inputJSON.' From Action '.$fromAction, 'service');
		$status=true;
		$input= json_decode($inputJSON, TRUE );
		if(!isset($input['token'])){
			$status=false;
		}else{
			$token=$input['token'];
			$marchent=Merchant::find()->where(['login_token' =>$input['token']])->count();
			if($marchent!=1){
				$status=false;
			}
		}
		return $status;
	}
	
	public static function checkUniqueEmailMarchent($inputJSON,$fromAction){
		Yii::info('Inside ServicevalidationComponent.checkUniqueEmailMarchent', 'service');
		Yii::info('Input parameter '.$inputJSON.' From Action '.$fromAction, 'service');
		$status=true;
		$input= json_decode($inputJSON, TRUE );
		$marchent=Merchant::find()->where(['email' =>$input['email']])->count();  
		if($marchent>0){
			$status=false;
		}
		return $status;
	}
	
	public static function checkUniquePhoneMarchent($inputJSON,$fromAction){
		Yii::info('Inside ServicevalidationComponent.checkUniquePhoneMarchent', 'service');
		Yii::info('Input parameter '.$inputJSON.' From Action '.$fromAction, 'service');
		$status=true;
		$input= json_decode($inputJSON, TRUE );
		$marchent=Merchant::find()->where(['mobile' =>$input['mobile']])->count();
		if($marchent>0){
			$status=false;
		}
		return $status;
	}
	
	
}