<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subscription_package".
 *
 * @property integer $subscription_package_id
 * @property string $subscription_package_name
 * @property string $subscription_package_description
 * @property string $validto
 * @property integer $num_of_days
 * @property string $created_date
 * @property integer $active
 * @property double $price
 *
 * @property SubscriptionPackageDetail[] $subscriptionPackageDetails
 * @property SubscriptionPurchase[] $subscriptionPurchases
 */
class SubscriptionPackage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscription_package';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['validto', 'created_date'], 'safe'],
            [['num_of_days', 'active'], 'integer'],
            [['price'], 'number'],
            [['subscription_package_name', 'subscription_package_description'], 'string', 'max' => 145],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subscription_package_id' => 'Subscription Package ID',
            'subscription_package_name' => 'Subscription Package Name',
            'subscription_package_description' => 'Subscription Package Description',
            'validto' => 'Validto',
            'num_of_days' => 'Num Of Days',
            'created_date' => 'Created Date',
            'active' => 'Active',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptionPackageDetails()
    {
        return $this->hasMany(SubscriptionPackageDetail::className(), ['subscription_package_id' => 'subscription_package_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptionPurchases()
    {
        return $this->hasMany(SubscriptionPurchase::className(), ['subscription_package_id' => 'subscription_package_id']);
    }

    /**
     * @inheritdoc
     * @return SubscriptionPackageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubscriptionPackageQuery(get_called_class());
    }
}
