<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subscription_component".
 *
 * @property integer $subscription_component_id
 * @property string $component_name
 * @property string $component_description
 * @property string $created_date
 * @property integer $active
 *
 * @property SubscriptionPackageDetail[] $subscriptionPackageDetails
 */
class SubscriptionComponent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscription_component';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_date'], 'safe'],
            [['active'], 'integer'],
            [['component_name', 'component_description'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subscription_component_id' => 'Subscription Component ID',
            'component_name' => 'Component Name',
            'component_description' => 'Component Description',
            'created_date' => 'Created Date',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptionPackageDetails()
    {
        return $this->hasMany(SubscriptionPackageDetail::className(), ['subscription_component_id' => 'subscription_component_id']);
    }

    /**
     * @inheritdoc
     * @return SubscriptionComponentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubscriptionComponentQuery(get_called_class());
    }
}
