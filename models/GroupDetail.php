<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group_detail".
 *
 * @property integer $group_detail_id
 * @property integer $group_id
 * @property integer $customer_id
 * @property integer $status
 * @property string $created_date
 *
 * @property PromotionGroup $group
 * @property Customer $customer
 */
class GroupDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'customer_id'], 'required'],
            [['group_id', 'customer_id', 'status'], 'integer'],
            [['created_date'], 'safe'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => PromotionGroup::className(), 'targetAttribute' => ['group_id' => 'group_id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'customer_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'group_detail_id' => 'Group Detail ID',
            'group_id' => 'Group ID',
            'customer_id' => 'Customer ID',
            'status' => 'Status',
            'created_date' => 'Created Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(PromotionGroup::className(), ['group_id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * @inheritdoc
     * @return GroupDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GroupDetailQuery(get_called_class());
    }
}
