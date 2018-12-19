<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Manage Notification Setting';
$this->registerCss('
.setDiv {
    margin:10px;
}
label {
    margin-left: 15px;
}
');
?>
<?php $form = ActiveForm::begin(); ?>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Set Notification Setting</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="col-sm-12 col-xs-12">
                    <h4>ASIN Change Notification</h4>
                </div>
                <div class="col-sm-12 col-xs-12 setDiv">
                    <?= Html::label('Notification Type : ').Html::checkboxList('notificationType', null, ['1' => 'Summery', 2 => 'Detailed'], ['style' => 'display:inline-block;']) ?>
                </div>
                <div class="col-sm-12 col-xs-12 setDiv">
                    <?= Html::label('Notification Frequency : ').Html::radioList('notificationFrequency', null, ['1' => 'Once/Day', 2 => '2 Times/Day', 3 => '4 Times/Day'], ['style' => 'display:inline-block;']); ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="col-sm-12 col-xs-12">
                    <h4>Performance Notification</h4>
                </div>
                <div class="col-sm-12 col-xs-12 setDiv">
                    <?= Html::label('Notification Type : ').Html::checkboxList('notificationType', null, ['1' => 'Summery', 2 => 'Detailed'], ['style' => 'display:inline-block;']) ?>
                </div>
                <div class="col-sm-12 col-xs-12 setDiv">
                    <?= Html::label('Notification Frequency : ').Html::radioList('notificationFrequency', null, ['1' => 'Once/Day', 2 => '2 Times/Day', 3 => '4 Times/Day'], ['style' => 'display:inline-block;']); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="col-sm-12 col-xs-12">
                    <h4>Negative Feedback Notification</h4>
                </div>
                <div class="col-sm-12 col-xs-12 setDiv">
                    <?= Html::label('Notification Type : ').Html::checkboxList('notificationType', null, ['1' => 'Summery', 2 => 'Detailed'], ['style' => 'display:inline-block;']) ?>
                </div>
                <div class="col-sm-12 col-xs-12 setDiv">
                    <?= Html::label('Notification Frequency : ').Html::radioList('notificationFrequency', null, ['1' => 'Once/Day', 2 => '2 Times/Day', 3 => '4 Times/Day'], ['style' => 'display:inline-block;']); ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="col-sm-12 col-xs-12">
                    <h4>Stranded Inventory Notification</h4>
                </div>
                <div class="col-sm-12 col-xs-12 setDiv">
                    <?= Html::label('Notification Type : ').Html::checkboxList('notificationType', null, ['1' => 'Summery', 2 => 'Detailed'], ['style' => 'display:inline-block;']) ?>
                </div>
                <div class="col-sm-12 col-xs-12 setDiv">
                    <?= Html::label('Notification Frequency : ').Html::radioList('notificationFrequency', null, ['1' => 'Once/Day', 2 => '2 Times/Day', 3 => '4 Times/Day'], ['style' => 'display:inline-block;']); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="col-sm-12 col-xs-12">
                    <h4>Suppressed Inventory Notification</h4>
                </div>
                <div class="col-sm-12 col-xs-12 setDiv">
                    <?= Html::label('Notification Type : ').Html::checkboxList('notificationType', null, ['1' => 'Summery', 2 => 'Detailed'], ['style' => 'display:inline-block;']) ?>
                </div>
                <div class="col-sm-12 col-xs-12 setDiv">
                    <?= Html::label('Notification Frequency : ').Html::radioList('notificationFrequency', null, ['1' => 'Once/Day', 2 => '2 Times/Day', 3 => '4 Times/Day'], ['style' => 'display:inline-block;']); ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="col-sm-12 col-xs-12">
                    <h4>Performance Metrics</h4>
                </div>
                <div class="col-sm-12 col-xs-12 setDiv">
                    <?= Html::label('Notification Type : ').Html::checkboxList('notificationType', null, ['1' => 'Summery', 2 => 'Detailed'], ['style' => 'display:inline-block;']) ?>
                </div>
                <div class="col-sm-12 col-xs-12 setDiv">
                    <?= Html::label('Notification Frequency : ').Html::radioList('notificationFrequency', null, ['1' => 'Once/Day', 2 => '2 Times/Day', 3 => '4 Times/Day'], ['style' => 'display:inline-block;']); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Submit' : 'Submit', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>