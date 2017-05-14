<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campaign".
 *
 * @property integer $campaign_id
 * @property integer $group_id
 * @property integer $brand_id
 * @property string $campaign_name
 * @property string $campaign_description
 * @property string $template_body
 * @property string $start_date
 * @property string $end_date
 * @property integer $status
 * @property string $created_date
 * @property integer $active
 *
 * @property PromotionGroup $group
 * @property Brand $brand
 */
class Campaign extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campaign';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'brand_id'], 'required'],
            [['group_id', 'brand_id', 'status', 'active'], 'integer'],
            [['template_body'], 'string'],
            [['start_date', 'end_date', 'created_date'], 'safe'],
            [['campaign_name', 'campaign_description'], 'string', 'max' => 145],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => PromotionGroup::className(), 'targetAttribute' => ['group_id' => 'group_id']],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'brand_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'campaign_id' => 'Campaign ID',
            'group_id' => 'Group ID',
            'brand_id' => 'Brand ID',
            'campaign_name' => 'Campaign Name',
            'campaign_description' => 'Campaign Description',
            'template_body' => 'Template Body',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'status' => 'Status',
            'created_date' => 'Created Date',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(PromotionGroup::className(), ['group_id' => 'group_id']);
    }
    
    public function getGroupDetail()
    {
    	return $this->hasOne(PromotionGroup::className(), ['group_id' => 'group_id'])->with('groupDetailsCustomer');
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
     * @return CampaignQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CampaignQuery(get_called_class());
    }
}
