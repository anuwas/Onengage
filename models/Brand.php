<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $brand_id
 * @property integer $merchant_id
 * @property string $brand_name
 * @property string $brand_description
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $contactperson
 * @property integer $active
 * @property string $created_date
 *
 * @property Merchant $merchant
 * @property Campaign[] $campaigns
 * @property Coupon[] $coupons
 * @property Customer[] $customers
 * @property CustomerCoupon[] $customerCoupons
 * @property Outlet[] $outlets
 * @property PromotionGroup[] $promotionGroups
 * @property SubscriptionPurchase[] $subscriptionPurchases
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['merchant_id'], 'required'],
            [['merchant_id', 'active'], 'integer'],
            [['brand_description'], 'string'],
            [['created_date'], 'safe'],
            [['brand_name', 'email', 'address', 'contactperson'], 'string', 'max' => 145],
            [['phone'], 'string', 'max' => 45],
            [['merchant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Merchant::className(), 'targetAttribute' => ['merchant_id' => 'merchant_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'brand_id' => 'Brand ID',
            'merchant_id' => 'Merchant ID',
            'brand_name' => 'Brand Name',
            'brand_description' => 'Brand Description',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'contactperson' => 'Contactperson',
            'active' => 'Active',
            'created_date' => 'Created Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMerchant()
    {
        return $this->hasOne(Merchant::className(), ['merchant_id' => 'merchant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaigns()
    {
        return $this->hasMany(Campaign::className(), ['brand_id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoupons()
    {
        return $this->hasMany(Coupon::className(), ['brand_id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['brand_id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCoupons()
    {
        return $this->hasMany(CustomerCoupon::className(), ['brand_id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOutlets()
    {
        return $this->hasMany(Outlet::className(), ['brand_id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotionGroups()
    {
        return $this->hasMany(PromotionGroup::className(), ['brand_id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptionPurchases()
    {
        return $this->hasMany(SubscriptionPurchase::className(), ['brand_id' => 'brand_id']);
    }

    /**
     * @inheritdoc
     * @return BrandQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BrandQuery(get_called_class());
    }
}
