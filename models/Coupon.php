<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "coupon".
 *
 * @property integer $coupon_id
 * @property integer $brand_id
 * @property integer $outlet_id
 * @property string $coupon_name
 * @property string $coupon_description
 * @property string $coupon_code
 * @property string $start_date
 * @property string $end_date
 * @property string $created_date
 * @property integer $active
 *
 * @property Brand $brand
 * @property CustomerCoupon[] $customerCoupons
 */
class Coupon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coupon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_id'], 'required'],
            [['brand_id', 'outlet_id', 'active'], 'integer'],
            [['coupon_description'], 'string'],
            [['start_date', 'end_date', 'created_date'], 'safe'],
            [['coupon_name', 'coupon_code'], 'string', 'max' => 145],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'brand_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'coupon_id' => 'Coupon ID',
            'brand_id' => 'Brand ID',
            'outlet_id' => 'Outlet ID',
            'coupon_name' => 'Coupon Name',
            'coupon_description' => 'Coupon Description',
            'coupon_code' => 'Coupon Code',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'created_date' => 'Created Date',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['brand_id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCoupons()
    {
        return $this->hasMany(CustomerCoupon::className(), ['coupon_id' => 'coupon_id']);
    }

    /**
     * @inheritdoc
     * @return CouponQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CouponQuery(get_called_class());
    }
}
