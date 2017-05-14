<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "outlet".
 *
 * @property integer $outlet_id
 * @property integer $brand_id
 * @property string $outlet_name
 * @property string $outlet_address
 * @property string $email
 * @property string $phone
 * @property string $contactperson
 * @property string $created_date
 * @property integer $active
 *
 * @property CustomerCoupon[] $customerCoupons
 * @property CustomerOutlet[] $customerOutlets
 * @property CustomerOutletVisit[] $customerOutletVisits
 * @property Brand $brand
 * @property RedeemCoupon[] $redeemCoupons
 */
class Outlet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'outlet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_id'], 'required'],
            [['brand_id', 'active'], 'integer'],
            [['outlet_address'], 'string'],
            [['created_date'], 'safe'],
            [['outlet_name', 'email', 'contactperson'], 'string', 'max' => 145],
            [['phone'], 'string', 'max' => 45],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'brand_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'outlet_id' => 'Outlet ID',
            'brand_id' => 'Brand ID',
            'outlet_name' => 'Outlet Name',
            'outlet_address' => 'Outlet Address',
            'email' => 'Email',
            'phone' => 'Phone',
            'contactperson' => 'Contactperson',
            'created_date' => 'Created Date',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCoupons()
    {
        return $this->hasMany(CustomerCoupon::className(), ['outlet_id' => 'outlet_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerOutlets()
    {
        return $this->hasMany(CustomerOutlet::className(), ['outlet_id' => 'outlet_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerOutletVisits()
    {
        return $this->hasMany(CustomerOutletVisit::className(), ['outlet_id' => 'outlet_id']);
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
    public function getRedeemCoupons()
    {
        return $this->hasMany(RedeemCoupon::className(), ['outlet_id' => 'outlet_id']);
    }

    /**
     * @inheritdoc
     * @return OutletQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OutletQuery(get_called_class());
    }
}
