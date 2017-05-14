<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "template".
 *
 * @property integer $template_id
 * @property string $template_name
 * @property string $template_description
 * @property string $template_body
 * @property string $created_date
 * @property integer $active
 */
class Template extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['template_name'], 'required'],
            [['template_body'], 'string'],
            [['created_date'], 'safe'],
            [['active'], 'integer'],
            [['template_name', 'template_description'], 'string', 'max' => 145],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'template_id' => 'Template ID',
            'template_name' => 'Template Name',
            'template_description' => 'Template Description',
            'template_body' => 'Template Body',
            'created_date' => 'Created Date',
            'active' => 'Active',
        ];
    }

    /**
     * @inheritdoc
     * @return TemplateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TemplateQuery(get_called_class());
    }
}
