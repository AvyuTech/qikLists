<?php

use yii\helpers\Html;
use yii\grid\GridView;
use unclead\multipleinput\MultipleInput;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NotificationSettingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notification Settings';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs('
$(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
    //console.log("beforeInsert");
    //$(".maskInput").inputmask("+1 999-999-9999");
});

/*
$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    console.log("afterInsert");
});*/

/*$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
    if (! confirm("Are you sure you want to delete this item?")) {
        return false;
    }
    return true;
});*/

/*$(".dynamicform_wrapper").on("afterDelete", function(e) {
    console.log("Deleted item!");
});*/

$(".dynamicform_wrapper").on("limitReached", function(e, item) {
    alert("Limit reached");
});
');
?>

<?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="panel panel-default">
        <div class="panel-heading"><h4> Add/Update Notification Setting</h4></div>
        <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 5, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $models[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'ns_email',
                    'ns_mobile_no',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
                <?php foreach ($models as $i => $model): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left"></h3>
                            <div class="pull-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                                // necessary for update action.
                                if (! $model->isNewRecord) {
                                    echo Html::activeHiddenInput($model, "[{$i}]ns_id");
                                }
                            ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= $form->field($model, "[{$i}]ns_email")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($model, "[{$i}]ns_mobile_no")->textInput(['maxlength' => true]) ?>
                                    <?php /*= $form->field($model, "[{$i}]ns_mobile_no")->widget(\yii\widgets\MaskedInput::className(), [
                                        'mask' => '+1 999-999-9999',
                                        'clientOptions' => ['class' => 'maskInput']
                                    ]) */?>
                                </div>
                            </div><!-- .row -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
        <div class="panel-footer">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>
