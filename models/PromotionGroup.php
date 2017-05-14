<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "promotion_group".
 *
 * @property integer $group_id
 * @property string $group_name
 * @property string $group_description
 * @property integer $brand_id
 * @property integer $outlet_id
 * @property string $created_date
 * @property integer $active
 *
 * @property Campaign[] $campaigns
 * @property GroupDetail[] $groupDetails
 * @property Brand $brand
 */
class PromotionGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promotion_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_id'], 'required'],
            [['brand_id', 'outlet_id', 'active'], 'integer'],
            [['created_date'], 'safe'],
            [['group_name'], 'string', 'max' => 45],
            [['group_description'], 'string', 'max' => 145],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'brand_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'group_id' => 'Group ID',
            'group_name' => 'Group Name',
            'group_description' => 'Group Description',
            'brand_id' => 'Brand ID',
            'outlet_id' => 'Outlet ID',
            'created_date' => 'Created Date',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaigns()
    {
        return $this->hasMany(Campaign::className(), ['group_id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupDetails()
    {
        return $this->hasMany(GroupDetail::className(), ['group_id' => 'group_id']);
    }
    
    public function getGroupDetailsCustomer()
    {
    	return $this->hasMany(GroupDetail::className(), ['group_id' => 'group_id'])->with('customer');
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
     * @return PromotionGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PromotionGroupQuery(get_called_class());
    }
}
