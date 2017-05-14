<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subscription_package_detail".
 *
 * @property integer $subscription_package_detail_id
 * @property integer $subscription_package_id
 * @property integer $subscription_component_id
 * @property integer $quantity
 * @property double $price
 * @property string $validto
 * @property string $created_date
 * @property string $active
 *
 * @property SubscriptionComponent $subscriptionComponent
 * @property SubscriptionPackage $subscriptionPackage
 */
class SubscriptionPackageDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscription_package_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subscription_package_id', 'subscription_component_id'], 'required'],
            [['subscription_package_id', 'subscription_component_id', 'quantity'], 'integer'],
            [['price'], 'number'],
            [['validto', 'created_date'], 'safe'],
            [['active'], 'string', 'max' => 45],
            [['subscription_component_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubscriptionComponent::className(), 'targetAttribute' => ['subscription_component_id' => 'subscription_component_id']],
            [['subscription_package_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubscriptionPackage::className(), 'targetAttribute' => ['subscription_package_id' => 'subscription_package_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subscription_package_detail_id' => 'Subscription Package Detail ID',
            'subscription_package_id' => 'Subscription Package ID',
            'subscription_component_id' => 'Subscription Component ID',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'validto' => 'Validto',
            'created_date' => 'Created Date',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptionComponent()
    {
        return $this->hasOne(SubscriptionComponent::className(), ['subscription_component_id' => 'subscription_component_id']);
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
     * @return SubscriptionPackageDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubscriptionPackageDetailQuery(get_called_class());
    }
}
