<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $customer_id
 * @property integer $brand_id
 * @property string $customer_name
 * @property string $emailid
 * @property string $mobile
 * @property string $dob
 * @property string $aniversary_date
 * @property string $sex
 * @property integer $active
 * @property string $otp_status
 * @property string $otp
 * @property string $opted
 * @property string $created_date
 * @property string $first_name
 * @property string $last_name
 * @property string $salutation
 * @property string $pincode
 * @property string $cty
 * @property string $state
 * @property string $country
 * @property string $address
 * @property string $workplace
 * @property string $profession
 * @property integer $marital_status
 * @property string $father_name
 * @property string $mother_name
 * @property string $religion
 * @property string $land_line_number
 * @property string $language
 *
 * @property Brand $brand
 * @property CustomerCoupon[] $customerCoupons
 * @property CustomerOutlet[] $customerOutlets
 * @property CustomerOutletVisit[] $customerOutletVisits
 * @property GroupDetail[] $groupDetails
 * @property RedeemCoupon[] $redeemCoupons
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_id'], 'required'],
            [['brand_id', 'active', 'marital_status'], 'integer'],
            [['dob', 'aniversary_date', 'created_date'], 'safe'],
            [['customer_name', 'emailid', 'otp', 'first_name', 'last_name', 'salutation', 'address', 'workplace', 'father_name', 'mother_name'], 'string', 'max' => 145],
            [['mobile', 'otp_status', 'opted', 'pincode', 'cty', 'state', 'country', 'profession', 'religion', 'land_line_number', 'language'], 'string', 'max' => 45],
            [['sex'], 'string', 'max' => 10],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'brand_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'Customer ID',
            'brand_id' => 'Brand ID',
            'customer_name' => 'Customer Name',
            'emailid' => 'Emailid',
            'mobile' => 'Mobile',
            'dob' => 'Dob',
            'aniversary_date' => 'Aniversary Date',
            'sex' => 'Sex',
            'active' => 'Active',
            'otp_status' => 'Otp Status',
            'otp' => 'Otp',
            'opted' => 'Opted',
            'created_date' => 'Created Date',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'salutation' => 'Salutation',
            'pincode' => 'Pincode',
            'cty' => 'Cty',
            'state' => 'State',
            'country' => 'Country',
            'address' => 'Address',
            'workplace' => 'Workplace',
            'profession' => 'Profession',
            'marital_status' => 'Marital Status',
            'father_name' => 'Father Name',
            'mother_name' => 'Mother Name',
            'religion' => 'Religion',
            'land_line_number' => 'Land Line Number',
            'language' => 'Language',
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
    public function getCustomerCoupons()
    {
        return $this->hasMany(CustomerCoupon::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerOutlets()
    {
        return $this->hasMany(CustomerOutlet::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerOutletVisits()
    {
        return $this->hasMany(CustomerOutletVisit::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupDetails()
    {
        return $this->hasMany(GroupDetail::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRedeemCoupons()
    {
        return $this->hasMany(RedeemCoupon::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * @inheritdoc
     * @return CustomerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerQuery(get_called_class());
    }
}
