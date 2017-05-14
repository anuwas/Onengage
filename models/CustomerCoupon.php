<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer_coupon".
 *
 * @property integer $customer_coupon_id
 * @property integer $coupon_id
 * @property integer $customer_id
 * @property integer $outlet_id
 * @property integer $brand_id
 * @property string $coupon_code
 * @property string $reedem_date
 * @property string $created_date
 *
 * @property Coupon $coupon
 * @property Customer $customer
 * @property Outlet $outlet
 * @property Brand $brand
 */
class CustomerCoupon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_coupon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['coupon_id', 'customer_id', 'outlet_id', 'brand_id'], 'required'],
            [['coupon_id', 'customer_id', 'outlet_id', 'brand_id'], 'integer'],
            [['reedem_date'], 'safe'],
            [['coupon_code'], 'string', 'max' => 145],
            [['created_date'], 'string', 'max' => 45],
            [['coupon_id'], 'exist', 'skipOnError' => true, 'targetClass' => Coupon::className(), 'targetAttribute' => ['coupon_id' => 'coupon_id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'customer_id']],
            [['outlet_id'], 'exist', 'skipOnError' => true, 'targetClass' => Outlet::className(), 'targetAttribute' => ['outlet_id' => 'outlet_id']],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'brand_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_coupon_id' => 'Customer Coupon ID',
            'coupon_id' => 'Coupon ID',
            'customer_id' => 'Customer ID',
            'outlet_id' => 'Outlet ID',
            'brand_id' => 'Brand ID',
            'coupon_code' => 'Coupon Code',
            'reedem_date' => 'Reedem Date',
            'created_date' => 'Created Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoupon()
    {
        return $this->hasOne(Coupon::className(), ['coupon_id' => 'coupon_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOutlet()
    {
        return $this->hasOne(Outlet::className(), ['outlet_id' => 'outlet_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['brand_id' => 'brand_id']);
    }

    /**
     * @inheritdoc
     * @return CustomerCouponQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerCouponQuery(get_called_class());
    }
}
