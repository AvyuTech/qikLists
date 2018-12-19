<?php

namespace app\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "asin_change".
 *
 * @property integer $id
 * @property string $sku
 * @property string $asin
 * @property string $new_value
 * @property string $old_value
 * @property string $amazon_account
 * @property string $picture
 * @property string $date
 * @property string $old_array
 * @property string $new_array
 * @property integer $diff_status
 * @property string $start_date
 * @property string $end_date
 * @property integer $ac_status
 */
class AsinChange extends \yii\db\ActiveRecord
{
    public $start_date, $end_date, $changeCount;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asin_change';
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
            /*'blameable' => [
                'class' =>  'yii\behaviors\BlameableBehavior',
            ],*/

        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['asin'], 'required'],
            [['ac_status', 'new_value', 'old_value', 'new_array', 'old_array', 'start_date', 'end_date'], 'string'],
            [['date', 'diff_status', 'created_at', 'updated_at', 'changeCount'], 'safe'],
            [['sku', 'asin', 'amazon_account', 'picture'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sku' => 'Sku',
            'asin' => 'Asin',
            'new_value' => 'New Value',
            'old_value' => 'Old Value',
            'amazon_account' => 'Amazon Account',
            'picture' => 'Picture',
            'date' => 'Date',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'ac_status' => 'Status',
            'changeCount' => 'Changed Attribute',
        ];
    }

    /**
     * get Fine Difference between two string
     * @return string
     */
    public function getStringFineDiff()
    {
        $granularity = new \cogpowered\FineDiff\Granularity\Word;
        $diff        = new \cogpowered\FineDiff\Diff($granularity);

        /*$oldArray = Json::decode($this->old_array);
        $newArray = Json::decode($this->new_array);

        $changeArrayResult = array_diff_assoc($oldArray, $newArray);
        if($changeArrayResult) {
            $diffKey = array_keys($changeArrayResult);

        }*/

        return $diff->render($this->old_value, $this->new_value);
    }

    public static function getUserStatus()
    {
        return [
            2 => 'Investigation Needed',
            1 => 'Harmless',
            0 => 'To be reviewed',
        ];
    }

    public static function getAsinAttribute($attr)
    {
        $data = [
            'AttributeSets ItemAttributes Binding' => 'Binding',
            'AttributeSets ItemAttributes Brand' => 'Brand',
            'AttributeSets ItemAttributes Color' => 'Color',
            'AttributeSets ItemAttributes Department' => 'Department',
            'AttributeSets ItemAttributes ItemDimensions Height' => 'Item Height',
            'AttributeSets ItemAttributes ItemDimensions Length' => 'Item Length',
            'AttributeSets ItemAttributes ItemDimensions Width' => 'Item Width',
            'AttributeSets ItemAttributes ItemDimensions Weight' => 'Item Weight',
            'AttributeSets ItemAttributes Label' => 'Label',
            'AttributeSets ItemAttributes ListPrice' => 'ListPrice',
            'AttributeSets ItemAttributes Manufacturer' => 'Manufacturer',
            'AttributeSets ItemAttributes MaterialType' => 'MaterialType',
            'AttributeSets ItemAttributes Model' => 'Model',
            'AttributeSets ItemAttributes PackageQuantity' => 'PackageQuantity',
            'AttributeSets ItemAttributes PartNumber' => 'PartNumber',
            'AttributeSets ItemAttributes ProductGroup' => 'ProductGroup',
            'AttributeSets ItemAttributes ProductTypeName' => 'ProductTypeName',
            'AttributeSets ItemAttributes Publisher' => 'Publisher',
            'AttributeSets ItemAttributes Size' => 'Size',
            'AttributeSets ItemAttributes Studio' => 'Studio',
            'AttributeSets ItemAttributes Title' => 'Title',
            'AttributeSets ItemAttributes PackageDimensions Height' => 'Package Height',
            'AttributeSets ItemAttributes PackageDimensions Length' => 'Package Length',
            'AttributeSets ItemAttributes PackageDimensions Width' => 'Package Width',
            'AttributeSets ItemAttributes PackageDimensions Weight' => 'Package Weight',
        ];

        return $data[$attr];
    }

    public static function getChangeValue()
    {
        $modelData = self::find()->andFilterWhere(['diff_status' => 1])->all();
        $changeData = $changedKeys = $ckKeys = [];

        foreach ($modelData as $model) {
            $newArray = Json::decode($model->new_array);
            $oldArray = Json::decode($model->old_array);
            $changeArrayResult = array_diff_assoc($oldArray, $newArray);

            $changedKeys[] = array_keys($changeArrayResult);
            if($changeArrayResult) {
                $changeData[]  = $changeArrayResult;
            }
        }

        if($changeData) {
            foreach ($changedKeys as $cka) {
                foreach ($cka as $ck) {
                    $ckKeys[$ck] = $ck.' ('.count(array_column($changeData, $ck)).')';
                }
            }
        }

        return $ckKeys;
    }
}
