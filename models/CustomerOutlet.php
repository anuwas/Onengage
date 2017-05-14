<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer_outlet".
 *
 * @property integer $customer_outlet_id
 * @property integer $customer_id
 * @property integer $outlet_id
 * @property integer $brand_id
 * @property string $created_date
 *
 * @property Customer $customer
 * @property Outlet $outlet
 */
class CustomerOutlet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_outlet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'outlet_id'], 'required'],
            [['customer_id', 'outlet_id', 'brand_id'], 'integer'],
            [['created_date'], 'safe'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'customer_id']],
            [['outlet_id'], 'exist', 'skipOnError' => true, 'targetClass' => Outlet::className(), 'targetAttribute' => ['outlet_id' => 'outlet_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_outlet_id' => 'Customer Outlet ID',
            'customer_id' => 'Customer ID',
            'outlet_id' => 'Outlet ID',
            'brand_id' => 'Brand ID',
            'created_date' => 'Created Date',
        ];
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
     * @inheritdoc
     * @return CustomerOutletQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerOutletQuery(get_called_class());
    }
}
