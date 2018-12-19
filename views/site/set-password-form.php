<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Set Password');
$this->registerJs("(function($) {
      $('#passModal').modal();
  })(jQuery);", yii\web\View::POS_END, 'lang');
?>
<?php
if($affltId) {
?>
<script language="JavaScript" type="text/javascript" src="https://www.qikflips.com/affiliate/sale.php?profile=72198&idev_saleamt=<?= $billAmt; ?>&idev_ordernum=<?= $orderNo; ?>&affiliate_id=<?= $affltId; ?>"></script>
<?php } ?>

<?php $form = ActiveForm::begin(); ?>
<?php
yii\bootstrap\Modal::begin([
    'id' => 'passModal',
    'header' => "<h4 class=\"modal-title\">".Html::encode('Set Password')."</h4>",
    'footer' => Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-success pull-left']),
    'closeButton' => false,
    'options' => ['data-backdrop' => 'static', 'data-keyboard' => 'false']
]);
?>
<div class="modal-body">
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <?php $model->u_password = null; ?>
            <?= $form->field($model, 'u_password')->passwordInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6 col-xs-12">
            <?= $form->field($model, 'u_confirm_password')->passwordInput(['maxlength' => true]) ?>
        </div>
    </div>
</div>
<?php yii\bootstrap\Modal::end(); ?>
<?php ActiveForm::end(); ?>


