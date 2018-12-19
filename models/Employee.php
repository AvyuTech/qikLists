<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property integer $e_id
 * @property string $e_name
 * @property string $e_email
 * @property string $e_roles
 * @property integer $e_user_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $e_status
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
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
            [['e_name', 'e_email', 'e_user_id', 'e_roles'], 'required'],
            [['e_user_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'e_status'], 'integer'],
            [['e_name', 'e_roles'], 'string', 'max' => 100],
            [['e_email'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'e_id' => Yii::t('app', 'E ID'),
            'e_name' => Yii::t('app', 'Name'),
            'e_email' => Yii::t('app', 'Email'),
            'e_roles' => Yii::t('app', 'Permission'),
            'e_user_id' => Yii::t('app', 'E User ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'e_status' => Yii::t('app', 'E Status'),
        ];
    }

    /**
     * get employee permission
     * @param $permission
     * @return array|mixed
     */
    public static function getEmployeePermission($permission = null)
    {
        $data = [
            'FileCase' => 'File Case',
            'ViewAllVa' => 'View All VA',
        ];

        if($permission)
        {
            $result = $data[$permission];
        }
        else {
            $result = $data;
        }

        return $result;
    }
}
