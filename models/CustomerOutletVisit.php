<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer_outlet_visit".
 *
 * @property integer $customer_outlet_visit_id
 * @property integer $customer_id
 * @property integer $outlet_id
 * @property integer $brand_id
 * @property double $purchase_amount
 * @property string $visiting_date
 * @property string $remark
 * @property string $created_date
 *
 * @property Customer $customer
 * @property Outlet $outlet
 */
class CustomerOutletVisit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_outlet_visit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'outlet_id', 'brand_id'], 'integer'],
            [['purchase_amount'], 'required'],
            [['purchase_amount'], 'number'],
            [['visiting_date', 'created_date'], 'safe'],
            [['remark'], 'string'],
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
            'customer_outlet_visit_id' => 'Customer Outlet Visit ID',
            'customer_id' => 'Customer ID',
            'outlet_id' => 'Outlet ID',
            'brand_id' => 'Brand ID',
            'purchase_amount' => 'Purchase Amount',
            'visiting_date' => 'Visiting Date',
            'remark' => 'Remark',
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
     * @return CustomerOutletVisitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerOutletVisitQuery(get_called_class());
    }
}
