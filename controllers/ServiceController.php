<?php

namespace app\controllers;
use Yii;
use yii\filters\Cors;

class ServiceController extends \yii\web\Controller
{
	public function behaviors()
	{
		return array_merge([
				'cors' => [
						'class' => Cors::className(),
						#special rules for particular action
						'actions' => [
								'index' => [
										#web-servers which you alllow cross-domain access
										'Origin' => ['*'],
										'Access-Control-Request-Method' => ['POST'],
										'Access-Control-Request-Headers' => ['*'],
										'Access-Control-Allow-Credentials' => null,
										'Access-Control-Max-Age' => 86400,
										'Access-Control-Expose-Headers' => [],
								],
								'call' => [
										#web-servers which you alllow cross-domain access
										'Origin' => ['*'],
										'Access-Control-Request-Method' => ['POST'],
										'Access-Control-Request-Headers' => ['*'],
										'Access-Control-Allow-Credentials' => null,
										'Access-Control-Max-Age' => 86400,
										'Access-Control-Expose-Headers' => [],
								],
						],
						#common rules
						'cors' => [
								'Origin' => [],
								'Access-Control-Request-Method' => [],
								'Access-Control-Request-Headers' => [],
								'Access-Control-Allow-Credentials' => null,
								'Access-Control-Max-Age' => 0,
								'Access-Control-Expose-Headers' => [],
						]
				],
		], parent::behaviors());
	}
	
	public function beforeAction($action)
	{
		
		if ($action->id == 'index') {
			$this->enableCsrfValidation = false;
		}
	
		return parent::beforeAction($action);
	}
	
	public function actionCall()
	{
		$input=array();
		Yii::$app->serviceendpointcomp->registerMarchant($input);
	}
	
	public function actionTest(){
		$marchant = Merchant::find()->where('emailid > :emailid', [':userid' => 'biswas@gmail.com'])->one();
	}
	
    public function actionIndex()
    {
    	Yii::info('Inside ServiceController.actionCall', 'service');
    	header('Content-type: application/json');
    	Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    	
    	$inputJSON = file_get_contents('php://input');
    	$input= json_decode( $inputJSON, TRUE );
    	
    	switch($input['action']){
    		case 'Login':
    			Yii::$app->serviceendpointcomp->Login($inputJSON);
    			break;
    		case 'RegisterCustomer':
    			Yii::$app->serviceendpointcomp->registerCustomer($inputJSON);
    			break;
    		case 'GetCustomerByPhoneEmail':
    			Yii::$app->serviceendpointcomp->GetCustomerByPhoneEmail($inputJSON);
    			break;
    		case 'EnrollCustomer':
    			Yii::$app->serviceendpointcomp->EnrollCustomer($inputJSON);
    			break;
    		case 'MatchOTP':
    			Yii::$app->serviceendpointcomp->MatchOTP($inputJSON);
    			break;
    		case 'RegisterBrand':
    			Yii::$app->serviceendpointcomp->RegisterBrand($inputJSON);
    			break;
    		case 'RegisterOutlet':
    			Yii::$app->serviceendpointcomp->RegisterOutlet($inputJSON);
    			break;
    		case 'RegisterUser':
    			Yii::$app->serviceendpointcomp->RegisterUser($inputJSON);
    			break;
    		case 'CreateCoupon':
    			Yii::$app->serviceendpointcomp->CreateCoupon($inputJSON);
    			break;
    		case 'RedeemCoupon':
    			Yii::$app->serviceendpointcomp->RedeemCoupon($inputJSON);
    			break;
    		case 'PutUserPurchase':
    			Yii::$app->serviceendpointcomp->PutUserPurchase($inputJSON);
    			break;
    		case 'ListOutlet':
    			Yii::$app->serviceendpointcomp->ListOutlet($inputJSON);
    			break;
    		case 'ListCustomerByOutletId':
    			Yii::$app->serviceendpointcomp->ListCustomerByOutletId($inputJSON);
    			break;
    		case 'GetCouponListByCustomer':
    			Yii::$app->serviceendpointcomp->GetCouponListByCustomer($inputJSON);
    			break;
    		case 'GetSubscriptionList':
    			Yii::$app->serviceendpointcomp->GetSubscriptionList($inputJSON);
    			break;
    		case 'BuySubscription':
    			Yii::$app->serviceendpointcomp->BuySubscription($inputJSON);
    			break;
    		case 'PaymentSuccess':
    			Yii::$app->serviceendpointcomp->PaymentSuccess($inputJSON);
    			break;
    		case 'CreateCustomGroup':
    			Yii::$app->serviceendpointcomp->CreateCustomGroup($inputJSON);
    			break;
    		case 'CreateCustomGroupByCustomerId':
    			Yii::$app->serviceendpointcomp->CreateCustomGroupByCustomerId($inputJSON);
    			break;
    		case 'AddCustomerToGroup':
    			Yii::$app->serviceendpointcomp->AddCustomerToGroup($inputJSON);
    			break;
    		case 'RemoveCustomerFromGroup':
    			Yii::$app->serviceendpointcomp->RemoveCustomerFromGroup($inputJSON);
    			break;
    		case 'GetGroupCustomerList':
    			Yii::$app->serviceendpointcomp->GetGroupCustomerList($inputJSON);
    			break;
    		case 'GetGroupListByBrand':
    			Yii::$app->serviceendpointcomp->GetGroupListByBrand($inputJSON);
    			break;
    		case 'CreateCustomerGroupByVisitCount':
    			Yii::$app->serviceendpointcomp->CreateCustomerGroupByVisitCount($inputJSON);
    			break;
    		case 'CreateCustomerGroupByPurchaseAmount':
    			Yii::$app->serviceendpointcomp->CreateCustomerGroupByPurchaseAmount($inputJSON);
    			break;
    		case 'CreateCampaignByBrand':
    			Yii::$app->serviceendpointcomp->CreateCampaignByBrand($inputJSON);
    			break;
    		case 'GetTemplateBodyById':
    			Yii::$app->serviceendpointcomp->GetTemplateBodyById($inputJSON);
    			break;
    		case 'GetRawTemplateList':
    			Yii::$app->serviceendpointcomp->GetRawTemplateList($inputJSON);
    			break;
    		case 'GetTemplateListByBrand':
    			Yii::$app->serviceendpointcomp->GetTemplateListByBrand($inputJSON);
    			break;
    		case 'ScheduleCampaign':
    			Yii::$app->serviceendpointcomp->ScheduleCampaign($inputJSON);
    			break;
    		case 'GetCampaignListByBrand':
    			Yii::$app->serviceendpointcomp->GetCampaignListByBrand($inputJSON);
    			break;
    		case 'GetCampaignDetails':
    			Yii::$app->serviceendpointcomp->GetCampaignDetails($inputJSON);
    			break;
    		case 'ListBrand':
    			Yii::$app->serviceendpointcomp->ListBrand($inputJSON);
    			break;
    		case 'GetCurrentSubscriptionByBrand':
    			Yii::$app->serviceendpointcomp->GetCurrentSubscriptionByBrand($inputJSON);
    			break;
    		case 'GetCouponsByBrand':
    			Yii::$app->serviceendpointcomp->GetCouponsByBrand($inputJSON);
    			break;
    			
    			
    			
    		case 'registerMerchant':
    			Yii::$app->serviceendpointcomp->registerMarchant($inputJSON);
    			break;
    		case 'merchantLogin':
    			Yii::$app->serviceendpointcomp->marchantLogin($inputJSON);
    			break;
    		case 'customerList':
    			Yii::$app->serviceendpointcomp->customerList($inputJSON);
    			break;
    		case 'customerListDateRange':
    			Yii::$app->serviceendpointcomp->customerListDateRange($inputJSON);
    			break;
    		case 'addStore':
    			Yii::$app->serviceendpointcomp->addStore($inputJSON);
    			break;
    		case 'storeList':
    			Yii::$app->serviceendpointcomp->storeList($inputJSON);
    			break;
    		case 'copyCustomer':
    				Yii::$app->serviceendpointcomp->copyCustomer($inputJSON);
    				break;
    		default:
    			echo json_encode('Action Not Found');
    		
    	}
    	
    }

}
