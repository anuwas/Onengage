<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "merchant".
 *
 * @property integer $merchant_id
 * @property string $merchant_name
 * @property string $merchant_address
 * @property string $nature_of_business
 * @property integer $outlet_no
 * @property integer $active
 * @property string $created_date
 *
 * @property Brand[] $brands
 */
class Merchant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'merchant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['merchant_name'], 'required'],
            [['merchant_address', 'nature_of_business'], 'string'],
            [['outlet_no', 'active'], 'integer'],
            [['created_date'], 'safe'],
            [['merchant_name'], 'string', 'max' => 145],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'merchant_id' => 'Merchant ID',
            'merchant_name' => 'Merchant Name',
            'merchant_address' => 'Merchant Address',
            'nature_of_business' => 'Nature Of Business',
            'outlet_no' => 'Outlet No',
            'active' => 'Active',
            'created_date' => 'Created Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrands()
    {
        return $this->hasMany(Brand::className(), ['merchant_id' => 'merchant_id']);
    }

    /**
     * @inheritdoc
     * @return MerchantQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MerchantQuery(get_called_class());
    }
}
