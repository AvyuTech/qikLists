<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Upload Modified CSV File');
$this->registerJs("(function($) {
      $('#amazonModal').modal();
  })(jQuery);", yii\web\View::POS_END, 'amazon');
$this->registerJsFile(Yii::getAlias('@web').'/js/disable-submit-buttons.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCss("
.modal-body {
    padding: 0px 15px;
}
/*.successBtn {
    padding: 12px 10px;
}*/
");
?>

<?php $form = ActiveForm::begin(); ?>
<?php
yii\bootstrap\Modal::begin([
    'id' => 'amazonModal',
    'size' => \yii\bootstrap\Modal::SIZE_LARGE,
    'header' => "<h4 class=\"modal-title\">".Html::encode('Upload Min Max Cost CSV')."</h4>",
    'footer' => Html::a(Yii::t('app', 'Login'), ['/site/login'], ['class' => 'btn btn-default pull-left']),
    //'footer' => false,
    'closeButton' => false,
    'options' => ['data-backdrop' => 'static', 'data-keyboard' => 'false']
]);
?>
<div class="row">
    <div class="col-sm-12 col-xs-12" style="padding: 15px;">
        <div class="col-sm-12 col-xs-12">
            <?= $form->field($model, 'csv_file')->fileInput(['class' => 'form-control']); ?>
        </div>
        <div class="col-sm-12 col-xs-12">
            <?= Html::submitButton(Yii::t('app', '<b>Submit</b>'), ['class' => 'btn btn-block successBtn btn-info pull-left']);  ?>
        </div>
    </div>
</div>
<?php yii\bootstrap\Modal::end(); ?>
<?php ActiveForm::end(); ?>


