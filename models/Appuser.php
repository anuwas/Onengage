<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appuser".
 *
 * @property integer $appuser_id
 * @property string $user_type
 * @property integer $ref_id
 * @property string $username
 * @property string $password
 * @property string $dept_designation
 * @property string $name
 * @property string $email
 * @property string $mobile
 * @property string $created_date
 * @property string $login_token
 * @property integer $active
 * @property string $otp
 * @property string $otp_status
 */
class Appuser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'appuser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type', 'username', 'password'], 'required'],
            [['ref_id', 'active'], 'integer'],
            [['created_date'], 'safe'],
            [['user_type', 'dept_designation', 'mobile', 'otp_status'], 'string', 'max' => 45],
            [['username', 'password', 'name', 'email', 'otp'], 'string', 'max' => 145],
            [['login_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'appuser_id' => 'Appuser ID',
            'user_type' => 'User Type',
            'ref_id' => 'Ref ID',
            'username' => 'Username',
            'password' => 'Password',
            'dept_designation' => 'Dept Designation',
            'name' => 'Name',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'created_date' => 'Created Date',
            'login_token' => 'Login Token',
            'active' => 'Active',
            'otp' => 'Otp',
            'otp_status' => 'Otp Status',
        ];
    }

    /**
     * @inheritdoc
     * @return AppuserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppuserQuery(get_called_class());
    }
}
