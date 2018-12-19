<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blog".
 *
 * @property int $b_id
 * @property string $b_title
 * @property string $b_description
 * @property string $b_feature_image
 * @property string $b_category
 * @property string $b_tags
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 * @property int $b_status
 * @property string $slug
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog';
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
            [['b_title', 'b_description', 'slug'], 'required'],
            [['b_description', 'b_category', 'b_tags', 'slug'], 'string'],
            [['created_by', 'updated_by', 'created_at', 'updated_at', 'b_status'], 'integer'],
            [['b_title', 'b_feature_image'], 'string', 'max' => 255],
            [['b_feature_image'], 'image', 'maxWidth' => 1442, 'maxHeight' => 475, 'extensions' => 'jpg, gif, png, jpeg', 'skipOnEmpty' => false, 'on' => 'create'],
            [['slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'b_id' => 'B ID',
            'b_title' => 'Title',
            'b_description' => 'Description',
            'b_feature_image' => 'Feature Image',
            'b_category' => 'Category',
            'b_tags' => 'Tags',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'b_status' => 'B Status',
        ];
    }

    /**
     * get image
     * @return string
     */
    public function getFeatureImage()
    {
        $dispImage = is_file(Yii::getAlias('@webroot').'/images/'.$this->b_feature_image) ? true : false;

        if($dispImage)
            return Yii::getAlias('@web')."/images/".$this->b_feature_image;
        else
            return Yii::getAlias('@web')."/images/blog-image.jpg";
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['u_id' => 'created_by']);
    }

    public static function getStatus($status = null)
    {
        $data = [
          0 => 'Published',
          1 => 'Pending Review',
          2 => 'Draft',
        ];

        if($status) {
            if(key_exists($status, $data)) {
                return $data[$status];
            } else {
                return null;
            }
        } else {
            return $data;
        }
    }
}
