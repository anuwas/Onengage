<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subscription_purchase".
 *
 * @property integer $subscription_purchase_id
 * @property integer $subscription_package_id
 * @property string $transaction_id
 * @property integer $brand_id
 * @property integer $transaction_status
 * @property string $created_date
 * @property double $amount
 * @property string $buying_date
 * @property string $exp_date
 * @property integer $service_status
 * @property integer $payment_status
 *
 * @property Brand $brand
 * @property SubscriptionPackage $subscriptionPackage
 */
class SubscriptionPurchase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscription_purchase';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subscription_package_id', 'transaction_id', 'brand_id'], 'required'],
            [['subscription_package_id', 'brand_id', 'transaction_status', 'service_status', 'payment_status'], 'integer'],
            [['created_date', 'buying_date', 'exp_date'], 'safe'],
            [['amount'], 'number'],
            [['transaction_id'], 'string', 'max' => 55],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'brand_id']],
            [['subscription_package_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubscriptionPackage::className(), 'targetAttribute' => ['subscription_package_id' => 'subscription_package_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subscription_purchase_id' => 'Subscription Purchase ID',
            'subscription_package_id' => 'Subscription Package ID',
            'transaction_id' => 'Transaction ID',
            'brand_id' => 'Brand ID',
            'transaction_status' => 'Transaction Status',
            'created_date' => 'Created Date',
            'amount' => 'Amount',
            'buying_date' => 'Buying Date',
            'exp_date' => 'Exp Date',
            'service_status' => 'Service Status',
            'payment_status' => 'Payment Status',
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
    public function getSubscriptionPackage()
    {
        return $this->hasOne(SubscriptionPackage::className(), ['subscription_package_id' => 'subscription_package_id']);
    }

    /**
     * @inheritdoc
     * @return SubscriptionPurchaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubscriptionPurchaseQuery(get_called_class());
    }
}
