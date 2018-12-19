<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_file".
 *
 * @property integer $uf_id
 * @property integer $uf_user_id
 * @property string $uf_file_name
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $uf_status
 */
class UserFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_file';
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
            [['uf_user_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'uf_status'], 'integer'],
            [['uf_website', 'uf_list_group'], 'required'],
            [['uf_file_name'], 'file', 'extensions' => 'xlsx, csv', 'skipOnEmpty' => false, 'checkExtensionByMimeType'=>false, 'uploadRequired' => Yii::t('app', 'Please select file')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uf_id' => Yii::t('app', 'Uf ID'),
            'uf_user_id' => Yii::t('app', 'Uf User ID'),
            'uf_file_name' => Yii::t('app', 'File Name'),
            'uf_list_group' => 'Group',
            'uf_website' => Yii::t('app', 'Website'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'uf_status' => Yii::t('app', 'Uf Status'),
        ];
    }

    /*
* get Import file path
*/
    public function getImportFilePath()
    {
        return Yii::getAlias('@webroot').'/uploads/import_files/user_files/';
    }

    /*
     * save import file
     */
    public function saveImportFile()
    {
        if ($this->validate(['uf_file_name'])) {
            $newName = 'user_'.\Yii::$app->user->id.'_'.time().'.'.$this->uf_file_name->extension;
            $returnResults = $this->uf_file_name->saveAs($this->getImportFilePath().$this->uf_file_name = $newName);

            if($returnResults) {
                return $newName;
            }
        }
        return false;
    }

    public function getFile()
    {
        return ($this->uf_file_name) ? $this->getImportFilePath().$this->uf_file_name : null;
    }

    public function getGroup()
    {
        return $this->hasOne(ListGroup::className(), ['lg_id' => 'uf_list_group']);
    }
}
