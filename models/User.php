<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\base\Security;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user".
 *
 * @property integer $u_id
 * @property string $u_name
 * @property string $u_email
 * @property string $u_password
 * @property string $u_contact_no
 * @property string $u_photo
 * @property string $u_address
 * @property integer $u_type
 * @property string $password_reset_token
 * @property string $auth_key
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $u_status
 * @property string $u_sub_plan
 * @property string $u_payment
 * @property string $u_store_name
 * @property string $u_mws_auth_token
 * @property string $u_mws_seller_id
 * @property string $csv_file
 * @property string $device_token
 * @property integer $asin_change_cron_status
 * @property integer $order_cron_status
 * @property string $u_stripe_ephemeral_key
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $u_confirm_password, $u_current_pass;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
            ],
            'blameable' => [
                'class' =>  'yii\behaviors\BlameableBehavior',
            ],

        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['u_name', 'u_email', 'u_type'], 'required'],
            [['u_type', 'created_at', 'updated_at', 'created_by', 'updated_by', 'u_status', 'order_cron_status', 'asin_change_cron_status'], 'integer'],
            [['u_name', 'u_email', 'u_store_name'], 'string', 'max' => 150],
            [['u_contact_no'], 'string', 'max' => 20],
            [['u_photo', 'u_address', 'password_reset_token', 'auth_key'], 'string', 'max' => 255],
            [['u_email'], 'email'],
            [['u_email'], 'unique'],
            ['u_confirm_password', 'compare', 'compareAttribute' => 'u_password', 'message' => "Confirm Password does not match with Password"],
            ['u_password', 'string', 'min' => 8],
            [['u_password', 'u_confirm_password'], 'required', 'on' => 'create'],
            [['u_photo'], 'file', 'extensions' => 'jpg, gif, png, jpeg'],
            [['csv_file'], 'file', 'extensions' => 'csv', 'checkExtensionByMimeType' => false, 'skipOnEmpty' => false],
            [['u_mws_seller_id', 'u_mws_auth_token'], 'safe'],
            [['device_token', 'u_stripe_ephemeral_key'], 'string'],
            //[['u_current_pass'], 'findPasswords', 'on' => 'changePwd'],
            //[['u_current_pass', 'u_password', 'u_confirm_password'], 'required', 'on' => 'changePwd'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'u_id' => 'U ID',
            'u_name' => 'Name',
            'u_email' => 'Email',
            'csv_file' => 'CSV File',
            'u_password' => 'Password',
            'u_confirm_password' => 'Confirm Password',
            'u_contact_no' => 'Contact No',
            'u_photo' => 'Photo',
            'u_address' => 'Address',
            'u_type' => 'Type',
            'u_store_name' => 'Store Name',
            'password_reset_token' => 'Password Reset Token',
            'u_mws_auth_token' => 'MWS Auth Token',
            'u_mws_seller_id' => 'MWS Seller ID',
            'auth_key' => 'Auth Key',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'u_status' => 'Status',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['u_email' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->u_password === md5($password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->u_password = md5($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['e_user_id' => 'u_id']);
    }

    /**
     * get user type
     * @param null $type
     * @return array|mixed
     */
    public static function getUserType($type = null)
    {
        $uType = ['1' => 'Super Admin', '2' => 'User',]; // '3' => 'Employee (VA)'

        if($type)
        {
            $result = $uType[$type];
        }
        else {
            $result = $uType;
        }
        return $result;
    }

    public function findPasswords($attribute, $params)
    {
        $user = User::findOne(Yii::$app->user->id);
        if ($user->u_password != md5($this->u_current_pass))
            $this->addError($attribute, 'Current password is incorrect.');
    }

    /**
     * get user list
     * @return array
     */
    public static function getUser($type = null)
    {
        if($type)
        {
            $data = self::find()->where(['u_type' => $type])->all();
        }
        else {
            $data = self::find()->all();
        }

        return ArrayHelper::map($data, 'u_id', 'u_name');
    }

    /**
     * get user image
     * @return string
     */
    public function getUserImage()
    {
        $dispImage = is_file(Yii::getAlias('@webroot').'/images/user-images/'.$this->u_photo) ? true : false;

        if($dispImage)
            return Yii::getAlias('@web')."/images/user-images/".$this->u_photo;
        else
            return Yii::getAlias('@web')."/images/user-images/user-profile.jpg";
    }

    /*
    * get Import file path
    */
    public function getImportFilePath()
    {
        return Yii::getAlias('@webroot').'/uploads/csv_template/';
    }

    /*
     * save import file
     */
    public function saveImportFile()
    {
        if ($this->validate(['csv_file'])) {
            $newName = 'csv_file' . $this->u_id . '_' . time() . '.' . $this->csv_file->extension;
            $returnResults = $this->csv_file->saveAs($this->getImportFilePath() . $this->csv_file = $newName);

            if ($returnResults) {
                return $newName;
            }
        }
        return false;
    }

    public function getFile()
    {
        return ($this->csv_file) ? $this->getImportFilePath().$this->csv_file : null;
    }
}