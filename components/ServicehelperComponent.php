<?php
namespace app\components;
use yii\base\Component;
use yii\db\Query;
use app\models\Merchant;
use Yii;
use app\models\Customer;
use app\models\Store;
use app\models\Appuser;
use app\models\Outlet;
use app\models\CustomerOutlet;
use app\models\Coupon;
use app\models\CustomerCoupon;
use app\models\CustomerOutletVisit;
use app\models\Brand;
use app\models\SubscriptionPackage;
use app\models\SubscriptionPurchase;
use app\models\PromotionGroup;
use app\models\GroupDetail;
use app\models\Campaign;
use app\models\Template;

class ServicehelperComponent extends Component
{
	private $serviceUitl;
	public function __construct(){
		$this->serviceUitl=new ServiceUtilComponent();
	}

	function LoginHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.LoginHelper ', 'service');
		$status=array();
		try {
			$input= json_decode($inputJSON, TRUE );
			$username=$input['UserName'];
			$password=$input['Password'];
			$appuser=Appuser::find()->where('username = :username', [':username' => $username])->one();
			if(isset($appuser)){
				if($appuser->password==$password){
					$token=base64_encode($appuser->email.'-'.$appuser->appuser_id.'-'.date('Y-m-d-h-m-s'));
					$appuser->login_token=$token;
					$appuser->save();
					$status=array('status'=>'Success','msg'=>'Successfully Login, Please collect the login token','token'=>$token,'UserId'=>$appuser->appuser_id,'UserType'=>$appuser->user_type,'RefId'=>$appuser->ref_id,'Email'=>$appuser->email,'Mobile'=>$appuser->mobile,'Name'=>$appuser->name);
				}else{
					$status=array('status'=>'Fail','msg'=>'Invalid Credential, Password');
				}
			}else{
				$status=array('status'=>'Fail','msg'=>'Invalid Credential, UserName');
			}
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.LoginHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	function registerCustomerHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.registerCustomerHelper ', 'service');
		$status=array();
		try {
				
			$input= json_decode($inputJSON, TRUE );
			$customer = new Customer();
			$outletcustomer = new CustomerOutlet();
				
			$customer->customer_name=$input['CustomerName'];
			$customer->emailid=$input['EmailId'];
			$customer->mobile=$input['Mobile'];
			$customer->dob=$input['Dob'];
			$customer->aniversary_date=$input['AniversaryDate'];
			$customer->sex=$input['Sex'];
			$customer->brand_id=$this->serviceUitl->getBrandIdFromOutletId($input['OutletId']);
			 if($customer->save()){
			 	$outletcustomer->customer_id=$customer->customer_id;
			 	$outletcustomer->outlet_id=$input['OutletId'];
			 	
			 	if($outletcustomer->save()){
			 		$status=array('status'=>'Success','msg'=>'Successfully Registger','CustomerId'=>$customer->customer_id);
			 	}else{
			 		$status=array('status'=>'Fail','msg'=>'Not Registger In outlet');
			 	}
			}else{
				$status=array('status'=>'Fail','msg'=>'Not Registger');
			} 	
				
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.registerCustomerHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
	
		return $status;
	}
	
	function GetCustomerByPhoneEmailHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.GetCustomerByPhoneEmailHelper ', 'service');
		$status=array();
		try{
			$input= json_decode($inputJSON, TRUE );
			if($input['Mobile']!=''){
				$customer=Customer::findOne(['mobile'=>$input['Mobile']]);
				
				if($customer!=''){
					$brandstatus=true;
					$outletstatus=false;
					$customerOutlet=CustomerOutlet::find()->where(['customer_id'=>$customer->customer_id])->count();
					if($customer['brand_id']!=$this->serviceUitl->getBrandIdFromOutletId($input['OutletId'])){
						$brandstatus=false;
					}
					if($customerOutlet > 0){
						$outletstatus=true;
					}
					$status=array('CustomerName'=>$customer->customer_name,'EmailId'=>$customer->emailid,'Mobile'=>$customer->mobile,'Dob'=>$customer->dob,'AniversaryDate'=>$customer->aniversary_date,'Sex'=>$customer->sex,'CustomerId'=>$customer->customer_id,'ThisBrand'=>$brandstatus,'ThisOutlet'=>$outletstatus);
				}else{
					$status=array('CustomerName'=>'','EmailId'=>'','Mobile'=>'','Dob'=>'','AniversaryDate'=>'','Sex'=>'','CustomerId'=>'','ThisBrand'=>false,'ThisOutlet'=>false);
				}
								
			}
			
			if($input['Email']!=''){
				 $customer=Customer::findOne(['emailid'=>$input['Email']]);
				 if($customer!=''){
				 	$brandstatus=true;
				 	$outletstatus=false;
				 	$customerOutlet=CustomerOutlet::find()->where(['customer_id'=>$customer->customer_id])->count();
				 	
				 	if($customer['brand_id']!=$this->serviceUitl->getBrandIdFromOutletId($input['OutletId'])){
				 		$brandstatus=false;
				 	}
				 	if($customerOutlet > 0){
				 		$outletstatus=true;
				 	}
				 	$status=array('CustomerName'=>$customer->customer_name,'EmailId'=>$customer->emailid,'Mobile'=>$customer->mobile,'Dob'=>$customer->dob,'AniversaryDate'=>$customer->aniversary_date,'Sex'=>$customer->sex,'CustomerId'=>$customer->customer_id,'ThisBrand'=>$brandstatus,'ThisOutlet'=>$outletstatus);
				 }
				 else{
				 	$status=array('CustomerName'=>'','EmailId'=>'','Mobile'=>'','Dob'=>'','AniversaryDate'=>'','Sex'=>'','CustomerId'=>'','ThisBrand'=>false,'ThisOutlet'=>false);
				 }
				
							
			}
			
		}catch(Exception $ex){
			Yii::error('Inside ServicehelperComponent.GetCustomerByPhoneEmailHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		
		
		return $status;
	}
	
	function EnrollCustomerHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.EnrollCustomerHelper ', 'service');
		$status=array();
		try {
			$input= json_decode($inputJSON, TRUE );
			$outletcustomer = new CustomerOutlet();
			$outletcustomer->customer_id=$input['CustomerId'];
			$outletcustomer->outlet_id=$input['OutletId'];
				
			if($outletcustomer->save()){
				$status=array('status'=>'Success','msg'=>'Successfully Enrolled');
				}else{
					$status=array('status'=>'Fail','msg'=>'Not Enrolled');
				}
		
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.registerCustomerHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		
		return $status;
	}
	
	public function MatchOTPHelper(){
		Yii::info('Inside ServicehelperComponent.MatchOTPHelper ', 'service');
		$status=array();
		try {
			$input= json_decode($inputJSON, TRUE );
			$outletcustomer = new CustomerOutlet();
			$outletcustomer->customer_id=$input['CustomerId'];
			$outletcustomer->outlet_id=$input['OutletId'];
		
			if($outletcustomer->save()){
				$status=array('status'=>'Success','msg'=>'Successfully Enrolled');
			}else{
				$status=array('status'=>'Fail','msg'=>'Not Enrolled');
			}
		
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.registerCustomerHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		
		return $status;
	}
	
	
	public function RegisterBrandHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.RegisterOutletHelper ', 'service');
		$status=array();
		try {
	
			$input= json_decode($inputJSON, TRUE );
			$brand = new Brand();
				
			$brand->brand_name=$input['BrandName'];
			$brand->email=$input['EmailId'];
			$brand->phone=$input['Mobile'];
			$brand->address=$input['Address'];
			$brand->contactperson=$input['ContactPersonName'];
			$brand->merchant_id=$input['MerchantId'];
				
			if($brand->save()){
				$status=array('status'=>'Success','msg'=>'Successfully Registger','BrandId'=>$brand->brand_id);
			}else{
				$status=array('status'=>'Fail','msg'=>'Not Registger');
			}
				
				
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.registerCustomerHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
	
		return $status;
	
	}
	
	public function RegisterOutletHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.RegisterOutletHelper ', 'service');
		$status=array();
		try {
		
			$input= json_decode($inputJSON, TRUE );
			$outlet = new Outlet();
			
			$outlet->outlet_name=$input['OutletName'];
			$outlet->brand_id=$input['BrandId'];
			$outlet->outlet_address=$input['Address'];
			$outlet->email=$input['EmailId'];
			$outlet->phone=$input['Mobile'];
			$outlet->contactperson=$input['ContactPersonName'];
			
			if($outlet->save()){
				$status=array('status'=>'Success','msg'=>'Successfully Registger','OutletId'=>$outlet->outlet_id);
			}else{
				$status=array('status'=>'Fail','msg'=>'Not Registger');
			}
			
			
		
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.registerCustomerHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		
		return $status;
		
	}
	
	public function RegisterUserHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.RegisterUserHelper ', 'service');
		$status=array();
		try {
	
			$input= json_decode($inputJSON, TRUE );
			$appuser = new Appuser();
				
			$appuser->name=$input['Name'];
			$appuser->username=$input['UserName'];
			$appuser->password=$input['Password'];
			$appuser->user_type=$input['Type'];
			$appuser->ref_id=$input['RefId'];
				
			if($appuser->save()){
				$status=array('status'=>'Success','msg'=>'Successfully Registger','UserId'=>$appuser->appuser_id);
			}else{
				$status=array('status'=>'Fail','msg'=>'Not Registger');
			}
			
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.registerCustomerHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
	
		return $status;
	
	}
	
	function CreateCouponHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.CreateCouponHelper ', 'service');
		$status=array();
		try {
			$input= json_decode($inputJSON, TRUE );
			$checkCoupon= Coupon::find()->where(['coupon_code'=>$input['CouponCode']])->count();
			if($checkCoupon>0){
				$status=array('status'=>'Fail','msg'=>'Duplicate');
			}else{
				
				$coupon = new Coupon();
				$coupon->coupon_description=$input['Description'];
				$coupon->coupon_code=$input['CouponCode'];
				$coupon->brand_id=$input['BrandId'];
				
				if($coupon->save()){
					$status=array('status'=>'Success','msg'=>'Successfully Created','CouponId'=>$coupon->coupon_id);
				}else{
					$status=array('status'=>'Fail','msg'=>'Not Created');
				}
			}
		
			
				
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.CreateCouponHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	function RedeemCouponHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.RedeemCouponHelper ', 'service');
		$status=array();
		try {
		
			$input= json_decode($inputJSON, TRUE );
			$customercoupon = new CustomerCoupon();
			$customercoupon->customer_id=$input['CustomerId'];
			$customercoupon->coupon_code=$input['CouponCode'];
			$customercoupon->outlet_id=$input['OutletId'];
			$customercoupon->brand_id=$this->serviceUitl->getBrandIdFromOutletId($input['OutletId']);
			$customercoupon->coupon_id=$this->serviceUitl->getCouponIdfromCouponCode($input['CouponCode']);
		
			if($customercoupon->save()){
				$status=array('status'=>'Success','msg'=>'Successfully Redeem');
			}else{
				$status=array('status'=>'Fail','msg'=>'Not Redeem');
			}
		
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.CreateCouponHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	
	public function PutUserPurchaseHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.PutUserPurchaseHelper ', 'service');
		$status=array();
		try {
		
			$input= json_decode($inputJSON, TRUE );
			
			$customervisit = new CustomerOutletVisit();
			$customervisit->customer_id=$input['CustomerId'];
			$customervisit->purchase_amount=$input['Amount'];
			$customervisit->visiting_date=$input['Date'];
			$customervisit->remark=$input['Remarks'];
			$customervisit->outlet_id=$input['OutletId'];
			$customervisit->brand_id=$this->serviceUitl->getBrandIdFromOutletId($input['OutletId']);
		
			if($customervisit->save()){
				$status=array('status'=>'Success','msg'=>'Successfully Visited');
			}else{
				$status=array('status'=>'Fail','msg'=>'Not Visited');
			}
		
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	public function ListOutletHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.ListOutletHelper ', 'service');
		$status=array();
		$usersarr=array();
		try {
		
			$input= json_decode($inputJSON, TRUE );
			$brandid=$input['BrandId'];	
			$outlets=Outlet::find()->where(['brand_id'=>$brandid])->all();
			
			foreach ($outlets as $values){
				$users=Appuser::find()->where(['user_type'=>'outlet','ref_id'=>$values->outlet_id])->all();
				
				$status[]=array('OutletName'=>$values->outlet_name, 'EmailId'=>$users[0]->email, 'Mobile'=>$users[0]->mobile, 'Address'=>$values->outlet_address, 'ContactPersonName'=>$users[0]->name, 'UserName'=>$users[0]->username, 'OutletId'=>$values->outlet_id);
			}
		
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		
		return $status;
	}
	
	public function ListCustomerByOutletIdHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.ListCustomerByOutletIdHelper ', 'service');
		$status=array();
		$usersarr=array();
		try {
		
			$input= json_decode($inputJSON, TRUE );
			$outletid=$input['OutletId'];
			$customers= Customer::find()->joinWith('customerOutlets')->where(['customer_outlet.outlet_id'=>$outletid])->all();
				
			foreach ($customers as $value) {
				$status[]=array('CustomerName'=>$value->customer_name, 'EmailId'=>$value->emailid, 'Mobile'=>$value->mobile, 'Dob'=>$value->mobile, 'AniversaryDate'=>$value->aniversary_date, 'Sex'=>$value->sex, 'CustomerId'=>$value->customer_id);
			}
		
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		
		return $status;
	}
	
	public function GetCouponListByCustomerHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.GetCouponListByCustomerHelper ', 'service');
		$status=array();
		try {
			$input= json_decode($inputJSON, TRUE );
			
			$coupon=CustomerCoupon::find()->joinWith('coupon')->filterWhere(['customer_coupon.coupon_code'=>$input['CouponCode'],'customer_coupon.customer_id'=>$input['CustomerId'],'customer_coupon.outlet_id'=>$input['OutletId'],'customer_coupon.brand_id'=>$input['BrandId']])->all();
			foreach($coupon as $values){
				$status[]=array('CouponCode'=>$values->coupon->coupon_code,'CouponDescription'=>$values->coupon->coupon_description);
			}
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	public function GetSubscriptionListHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.GetCouponListByCustomerHelper ', 'service');
		$status=array();
		$packdeial=array();
		try {
			$input= json_decode($inputJSON, TRUE );
			
			$subscriptionpack=SubscriptionPackage::find()->joinWith('subscriptionPackageDetails')->all();
			foreach ($subscriptionpack as $values){
				foreach ($values->subscriptionPackageDetails as $packvalues){
					$packdeial[]=array($packvalues->subscriptionComponent->component_name=>$packvalues->quantity,'price'=>$packvalues->price);
				}
				$status[]=array($values->subscription_package_name=>$packdeial);
			}
			
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	public function BuySubscriptionHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.GetCouponListByCustomerHelper ', 'service');
		$status=array();
		$packdeial=array();
		try {
			
			$input= json_decode($inputJSON, TRUE );
			$buysubscription = new SubscriptionPurchase();
			$buysubscription->subscription_package_id=$input['SubscriptionId'];
			$buysubscription->brand_id=$input['BrandId'];
			$buysubscription->transaction_id=uniqid();
			
			
			if($buysubscription->save()){
				$status=array('status'=>'Success','msg'=>'Successfully Purchase','TransactionId'=>$buysubscription->transaction_id);
			}else{
				$status=array('status'=>'Fail','msg'=>'Not Registger');
			}
			
				
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	public function PaymentSuccessHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.PaymentSuccessHelper ', 'service');
		$status=array();
		$packdeial=array();
		try {
				
			$input= json_decode($inputJSON, TRUE );
			$buysubscription = SubscriptionPurchase::findOne(['transaction_id'=>$input['TranscationId']]);
			$buysubscription->amount=$input['PaidAmount'];
			$buysubscription->payment_status=1;
				
				
			if($buysubscription->save()){
				$status=array('status'=>'Success','msg'=>'Successfully Paid','TransactionId'=>$buysubscription->transaction_id);
			}else{
				$status=array('status'=>'Fail','msg'=>'Not Registger');
			}
				
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	public function CreateCustomGroupHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.PaymentSuccessHelper ', 'service');
		$status=array();
		$packdeial=array();
		try {
	
			$input= json_decode($inputJSON, TRUE );
			$group = new PromotionGroup();
			
			$group->group_name=$input['GroupName'];
			$group->brand_id=$input['BrandId'];
	
			if($group->save()){
				$status=array('status'=>'Success','msg'=>'Successfully Group Created','GroupId'=>$group->group_id);
			}else{
				$status=array('status'=>'Fail','msg'=>'Not Registger');
			}
	
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	public function CreateCustomGroupByCustomerIdHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.PaymentSuccessHelper ', 'service');
		$status=array();
		$packdeial=array();
		try {
	
			$input= json_decode($inputJSON, TRUE );
			$group = new PromotionGroup();
				
			$group->group_name=$input['GroupName'];
			$group->brand_id=$input['BrandId'];
			
			$customerarr=$input['CustomerId'];
			
			
			
			if($group->save()){
				foreach ($customerarr as $values){
					$customergroup= new GroupDetail();
					$customergroup->customer_id=$values;
					$customergroup->group_id=$group->group_id;
					$customergroup->save();
				}
				$status=array('status'=>'Success','msg'=>'Successfully Group Created','GroupId'=>$group->group_id);
			}else{
				$status=array('status'=>'Fail','msg'=>'Not Registger');
			}
	
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	public function AddCustomerToGroupHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.PaymentSuccessHelper ', 'service');
		$status=array();
		$packdeial=array();
		try {
	
			$input= json_decode($inputJSON, TRUE );
			$groupdetail = new GroupDetail();
				
			$groupdetail->group_id=$input['GroupId'];
			$groupdetail->customer_id=$input['CustomerId'];
	
			if($groupdetail->save()){
				$status=array('status'=>'Success','msg'=>'Successfully Added to group');
			}else{
				$status=array('status'=>'Fail','msg'=>'Not Registger');
			}
	
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	public function RemoveCustomerFromGroupHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.PaymentSuccessHelper ', 'service');
		$status=array();
		$packdeial=array();
		try {
	
			$input= json_decode($inputJSON, TRUE );
			$groupdetail = GroupDetail::findOne(['group_id'=>$input['GroupId'],'customer_id'=>$input['CustomerId']])->delete();
			$status=array('status'=>'Success','msg'=>'Successfully Removed from group');
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	public function GetGroupCustomerListHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.PaymentSuccessHelper ', 'service');
		$status=array();
		$packdeial=array();
		try {
	
			$input= json_decode($inputJSON, TRUE );
			$group = PromotionGroup::find()->joinWith('groupDetails')->where(['promotion_group.group_id'=>$input['GroupId']])->all();
			foreach ($group as $values){
    			foreach ($values->groupDetails as $detailvalue){
    				$status[]=array('CustomerId'=>$detailvalue->customer_id, 'CustomerName'=>$detailvalue->customer->customer_name, 'CustomerPhone'=>$detailvalue->customer->mobile, 'CustomerEmail'=>$detailvalue->customer->emailid);
    			
    			}
				
			}
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	public function GetGroupListByBrandHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.PaymentSuccessHelper ', 'service');
		$status=array();
		try {
			$input= json_decode($inputJSON, TRUE );
			$group = PromotionGroup::find()->where(['brand_id'=>$input['BrandId']])->all();
			foreach ($group as $values){
				$status[]=array('GroupName'=>$values->group_name, 'GroupId'=>$values->group_id);
			}
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	public function CreateCustomerGroupByVisitCountHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.PaymentSuccessHelper ', 'service');
		$status=array();
		try {
			$input= json_decode($inputJSON, TRUE );
			
			$group = new PromotionGroup();
			$group->group_name=$input['GroupName'];
			$group->brand_id=$input['BrandId'];
			if($group->save()){
				
				$connection = \Yii::$app->db;
				$list= $connection
				->createCommand('select count(*) as cnt,customer_id from customer_outlet_visit where brand_id=:brand and visiting_date >=:mindate and visiting_date <=:maxdate group by customer_id  ')
				->bindValue('brand',$input['BrandId'])
				->bindValue('mindate',$input['FromDate'])
				->bindValue('maxdate',$input['ToDate'])
				->queryAll();
				
				foreach($list as $values){
					if($values['cnt']>=$input['VisitCountMin'] && $values['cnt']<=$input['VisitCountMax']){
						$connection->createCommand('insert into group_detail (group_id,customer_id)values('.$group->group_id.','.$values['customer_id'].')')->query();
					}
				}
				$status=array('status'=>'Success','msg'=>'Successfully Created','GroupId'=>$group->group_id);
			}else{
				$status=array('status'=>'Fail','msg'=>'Exception Occured');
			}
			
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	public function CreateCustomerGroupByPurchaseAmountHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.PaymentSuccessHelper ', 'service');
		$status=array();
		try {
			$input= json_decode($inputJSON, TRUE );
				
			$group = new PromotionGroup();
			$group->group_name=$input['GroupName'];
			$group->brand_id=$input['BrandId'];
			if($group->save()){
	
				$connection = \Yii::$app->db;
				$list= $connection
				->createCommand('select count(*) as cnt,sum(purchase_amount) as totamt,customer_id from customer_outlet_visit where brand_id=:brand and visiting_date >=:mindate and visiting_date <=:maxdate group by customer_id  ')
				->bindValue('brand',$input['BrandId'])
				->bindValue('mindate',$input['FromDate'])
				->bindValue('maxdate',$input['ToDate'])
				->queryAll();
	
				foreach($list as $values){
					if($values['totamt']>=$input['PurchaseAmountMin'] && $values['totamt']<=$input['PurchaseAmountMax']){
						$connection->createCommand('insert into group_detail (group_id,customer_id)values('.$group->group_id.','.$values['customer_id'].')')->query();
					}
				}
				$status=array('status'=>'Success','msg'=>'Successfully Created','GroupId'=>$group->group_id);
			}else{
				$status=array('status'=>'Fail','msg'=>'Exception Occured');
			}
				
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	public function CreateCampaignByBrandHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.PaymentSuccessHelper ', 'service');
		$status=array();
		try {
			$input= json_decode($inputJSON, TRUE );
	
			$campaign = new Campaign();
			$campaign->campaign_name=$input['CampaignName'];
			$campaign->template_body=$input['TemplateBody'];
			$campaign->brand_id=$input['BrandId'];
			$campaign->group_id=$input['GroupId'];
			if($campaign->save()){
				$status=array('status'=>'Success','msg'=>'Successfully Campaign Created','CampaignId'=>$campaign->campaign_id);
			}else{
				$status=array('status'=>'Fail','msg'=>'Exception Occured InSave');
			}
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	public function GetTemplateBodyByIdHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.PaymentSuccessHelper ', 'service');
		$status=array();
		try {
			$input= json_decode($inputJSON, TRUE );
			$templateid=$input['TemplateId'];
	
			$template = Template::findOne($templateid);
			$status=array('status'=>'Success','TemplateBody'=>$template->template_body);
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	public function GetRawTemplateListHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.PaymentSuccessHelper ', 'service');
		$status=array();
		try {
			$input= json_decode($inputJSON, TRUE );
	
			$templates = Template::find()->all();
			foreach ($templates as $value){
				$status[]=array('TemplateId'=>$value->template_id,'TemplateName'=>$value->template_name,'TemplateBody'=>$value->template_body);
			}
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	public function GetTemplateListByBrandHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.PaymentSuccessHelper ', 'service');
		$status=array();
		try {
			$input= json_decode($inputJSON, TRUE );
			$brandid=$input['BrandId'];
	
			$templates = Campaign::find()->where(['brand_id'=>$brandid])->all();
			foreach ($templates as $value){
				$status[]=array('CampaignName'=>$value->campaign_name,'CampaignDescription'=>$value->campaign_description,'TemplateBody'=>$value->template_body);
			}
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	public function ScheduleCampaignHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.PaymentSuccessHelper ', 'service');
		$status=array();
		try {
			$input= json_decode($inputJSON, TRUE );
			$CampaignId=$input['CampaignId'];
	
			$campaign = Campaign::findOne(['campaign_id'=>$CampaignId]);
			$campaign->start_date=$input['StartTime'];
			
			if($campaign->save()){
				$status=array('status'=>'Success','msg'=>'Successfully Secheduled');
			}else{
				$status=array('status'=>'Fail','msg'=>'Exception Occured');
			}
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	public function GetCampaignListByBrandHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.PaymentSuccessHelper ', 'service');
		$status=array();
		try {
			$input= json_decode($inputJSON, TRUE );
	
			$campaign = Campaign::find()->filterWhere(['campaign_id'=>$input['CampaignId'],'campaign_name'=>$input['CampaignName'],'status'=>$input['CampaignStatus']])->all();
			
			foreach ($campaign as $value) {
				$status[]=array('CampaignId'=>$value->campaign_id,'GroupId'=>$value->group_id,'BrandId'=>$value->brand_id,'CampaignName'=>$value->campaign_name,'CampaignDescription'=>$value->campaign_description,'TemplateBody'=>$value->template_body,'DtartDate'=>$value->template_body,'EndDate'=>$value->end_date,'Status'=>$value->status);
			}
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	public function GetCampaignDetailsHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.PaymentSuccessHelper ', 'service');
		$status=array();
		$customerarr=array();
		try {
			$input= json_decode($inputJSON, TRUE );
	
			$campaoin=Campaign::find()->joinWith('groupDetail')->where(['campaign_id'=>$input['CampaignId']])->all();
				
		 foreach($campaoin as $values){
		 		foreach ($values->groupDetail->groupDetailsCustomer as $groupDetailCustomer) {
    			$customerarr[]=array('CustomerId'=>$groupDetailCustomer->customer->customer_id,'CustomerName'=>$groupDetailCustomer->customer->customer_name,'SentStatus'=>null,'SentTime'=>null,'CustomerPhone'=>$groupDetailCustomer->customer->mobile,'CustomerEmail'=>$groupDetailCustomer->customer->emailid);
    		}  
    		$status[]=array('CampaignName'=>$values->campaign_name,'GroupName'=>$values->groupDetail->group_name,'CampaignStatus'=>$values->status,'Customers'=>$customerarr);
    	} 
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	public function ListBrandHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.PaymentSuccessHelper ', 'service');
		$status=array();
		$outlets=array();
		try {
			$input= json_decode($inputJSON, TRUE );
			$brands=Brand::find()->joinWith('outlets')->where(['merchant_id'=>$input['MerchantId']])->all();
			foreach($brands as $values){
				foreach ($values->outlets as $outletvalues) {
					$outlets[]=array('OutletId'=>$outletvalues->outlet_id,'OutletName'=>$outletvalues->outlet_name,'Address'=>$outletvalues->outlet_address,'Email'=>$outletvalues->email,'Mobile'=>$outletvalues->phone,'Contactperson'=>$outletvalues->contactperson);
				}
				$status[]=array('BrandName'=>$values->brand_name,'EmailId'=>$values->email,'Mobile'=>$values->phone,'Address'=>$values->address,'ContactPersonName'=>$values->contactperson,'Outlets'=>$outlets);
				
			}
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	public function GetCurrentSubscriptionByBrandHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.PaymentSuccessHelper ', 'service');
		$status=array();
		$outlets=array();
		try {
			$input= json_decode($inputJSON, TRUE );
			$subscription=SubscriptionPurchase::find()->joinWith('subscriptionPackage')->where(['brand_id'=>$input['BrandId'],'service_status'=>1])->one();
			$status=array('SubscriptionId'=>$subscription->subscription_purchase_id,'PackageId'=>$subscription->subscription_package_id,
						'SubscriptionName'=>$subscription->subscriptionPackage->subscription_package_name,'ExpDate'=>$subscription->exp_date,
						'BuyingDate'=>$subscription->buying_date,'RemainingEmail'=>null,'RemainingSMS'=>null);
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	public function GetCouponsByBrandHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.PaymentSuccessHelper ', 'service');
		$status=array();
		$outlets=array();
		try {
			$input= json_decode($inputJSON, TRUE );
			$coupons=Coupon::find()->where(['active'=>1])->all();
			foreach ($coupons as $values){
				$status[]=array('CouponId'=>$values->coupon_id,'CouponName'=>$values->coupon_name,'CouponDescription'=>$values->coupon_description,'CouponCode'=>$values->coupon_code);
			}
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.PutUserPurchaseHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	
	
	function registerMarchantHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.registerMarchantHelper ', 'service');
		$status=array();
		try {
			$input= json_decode($inputJSON, TRUE );
			$marchant = new Merchant();
			$marchant->merchant_name=$input['merchantName'];
			$marchant->contact_person_name=$input['contactPersonName'];
			$marchant->email=$input['email'];
			$marchant->mobile=$input['mobile'];
			$marchant->dept_designation=$input['deptDesignation'];
			$marchant->merchant_address=$input['merchantAddress'];
			$marchant->nature_of_business=$input['natureOfBusiness'];
			$marchant->outlet_no=0;
			$marchant->password=md5($input['password']);
			if($marchant->save()){
				$status=array('status'=>'Success','msg'=>'Successfully Registger');
			}else{
				$status=array('status'=>'Fail','msg'=>'Not Registger');
			}
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.registerMarchantHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		
		return $status;
	}
	
	/*
	function registerCustomerHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.registerCustomerHelper ', 'service');
		$status=array();
		try {
			
			
			$input= json_decode($inputJSON, TRUE );
			$customer = new Customer();
			
			$checkCustomer=$this->serviceUitl->getCustomerByPhoneNumber($input['mobile'],$input['merchantId']);
			switch($checkCustomer){
				case 'duplicate':
					$status=array('status'=>'Fail','msg'=>'Customer Already Exist');
					break;
				case 'copy':
					$status=array('status'=>'Fail','msg'=>'Need Copy');
					break;
				case 'new':
					$customer->merchant_id=$input['merchantId'];
					$customer->store_id=$input['storeId'];
					$customer->customer_name=$input['customerName'];
					$customer->emailid=$input['emailId'];
					$customer->mobile=$input['mobile'];
					$customer->aniversary_date=$input['aniversaryDate'];
					$customer->dob=$input['dob'];
					$customer->sex=$input['sex'];
					if($customer->save()){
						$status=array('status'=>'Success','msg'=>'Successfully Registger');
					}else{
						$status=array('status'=>'Fail','msg'=>'Not Registger');
					}
					break;
			}
			
			
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.registerCustomerHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
	
		return $status;
	}
	*/
	function marchantLoginHelper($inputJSON){
		Yii::info('Inside ServicehelperComponent.marchantLoginHelper ', 'service');
		$status=array();
		try {
			$input= json_decode($inputJSON, TRUE );
			$email=$input['email'];
			$password=$input['password'];
			$marchant='';
			$marchant = Merchant::find()->where('email = :email', [':email' => $email])->one();
			if(isset($marchant)){
				if($marchant->password==md5($password)){
					$token=base64_encode($marchant->email.'-'.$marchant->merchant_id.'-'.date('Y-m-d-h-m-s'));
					$marchant->login_token=$token;
					$marchant->save();
					$stores=$this->serviceUitl->getStoreNoByToken($token);
					$status=array('status'=>'Success','msg'=>'Successfully Login, Please collect the login token','token'=>$token,'merchantId'=>$marchant->merchant_id,'stores'=>$stores);
				}else{
					$status=array('status'=>'Fail','msg'=>'Invalid Credential, Password');
				} 
			}else{
				$status=array('status'=>'Fail','msg'=>'Invalid Credential, Email');
			}
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.marchantLoginHelper, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	function customerList($inputJSON){
		Yii::info('Inside ServicehelperComponent.customerList ', 'service');
		
		$status=array();
		try {
			$input= json_decode($inputJSON, TRUE );
			$customers=Customer::find(['merchant_id'=>$input['merchantId']])->with('store')->all();
			//$customers=Customer::findAll(['merchant_id'=>$input['merchantId']]);
			
			foreach ($customers as $values){
				$status[]=array('customerId'=>$values->customer_id,'customerName'=>$values->customer_name,'emailId'=>$values->emailid,'mobileNo'=>$values->mobile,'dateOfBirth'=>$values->dob,'anniversaryDate'=>$values->aniversary_date,'sex'=>$values->sex,'storeId'=>$values->store_id,'storeName'=>$values->store->store_name);
			}
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.customerList, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	function customerListDateRange($inputJSON){
		Yii::info('Inside ServicehelperComponent.customerList ', 'service');
		$status=array();
		try {
			$input= json_decode($inputJSON, TRUE );
			
			$customers = Customer::find()->with('store')->where(['between', 'created_date', $input['startDate'].' 00:00:00', $input['endDate'].' 22:00:00' ])
			->andWhere(['merchant_id'=> $input['merchantId']])->all();
				
			foreach ($customers as $values){
				$status[]=array('customerId'=>$values->customer_id,'customerName'=>$values->customer_name,'emailId'=>$values->emailid,'mobileNo'=>$values->mobile,'dateOfBirth'=>$values->dob,'anniversaryDate'=>$values->aniversary_date,'sex'=>$values->sex,'createdDate'=>$values->created_date,'storeId'=>$values->store_id,'storeName'=>$values->store->store_name);
			}
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.customerList, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	function addStore($inputJSON){
		Yii::info('Inside ServicehelperComponent.addStore ', 'service');
		$status=array();
		try {
			
			$input= json_decode($inputJSON, TRUE );
			$store=new Store();
			$store->merchant_id=$this->serviceUitl->getMerchantIdByToken($input['token']);
			$store->store_name=$input['storeName'];
			$store->store_address=$input['storeAddress'];
			if($store->save()){
				$status=array('status'=>'Success','msg'=>'Successfully Addes');
			}else{
				$status=array('status'=>'Fail','msg'=>'Not Saved');
			}
			
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.customerList, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	function storeList($inputJSON){
		Yii::info('Inside ServicehelperComponent.storeList ', 'service');
		$status=array();
		try {
				
			$input= json_decode($inputJSON, TRUE );
			
			$merchant_id=$this->serviceUitl->getMerchantIdByToken($input['token']);
			$store=Store::find(['merchant_id'=>$merchant_id])->all();
			foreach ($store as $values){
				$status[]=array('storeName'=>$values->store_name,'storeAddress'=>$values->store_address);
			}
			
				
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.storeList, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
	function copyCustomer($inputJSON){
		Yii::info('Inside ServicehelperComponent.copyCustomer ', 'service');
		$status=array();
		try {
			$input= json_decode($inputJSON, TRUE );
			$merchant_id=$this->serviceUitl->getMerchantIdByToken($input['token']);
			$storeId=$input['storeId'];
			
			$previousCustomer=Customer::findOne(['mobile'=>$input['mobile']]);
			$customer=new Customer();
			$customer->merchant_id=$merchant_id;
			$customer->store_id=$storeId;
			$customer->customer_name=$previousCustomer['customer_name'];
			$customer->emailid=$previousCustomer['emailid'];
			$customer->mobile=$input['mobile'];
			$customer->aniversary_date=$previousCustomer['aniversary_date'];
			$customer->dob=$previousCustomer['dob'];
			$customer->sex=$previousCustomer['sex'];
			if($customer->save()){
				
				$status=array('status'=>'Success','msg'=>'Customer copied','customerId'=>$customer->customer_id,'customerNmae'=>$previousCustomer['customer_name'],
						'emailid'=>$previousCustomer['emailid'],'mobile'=>$input['mobile'],'aniversaryDate'=>$previousCustomer['aniversary_date'],
						'dob'=>$previousCustomer['dob'],'sex'=>$previousCustomer['sex']);
			}else{
				$status=array('status'=>'Fail','msg'=>'Not Copied');
				}
	
		}catch (Exception $ex){
			Yii::error('Inside ServicehelperComponent.copyCustomer, Exception Occured '.$ex, 'service');
			$status=array('status'=>'Fail','msg'=>'Exception Occured');
		}
		return $status;
	}
	
}