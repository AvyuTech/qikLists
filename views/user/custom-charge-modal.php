<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\AmazonCategory */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Custom Charge';
?>
<?= Html::beginForm(); ?>
<div class="modal-header">
    <h3 class="modal-title">Charge for <?= $model->u_name; ?></h3>
    <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>-->
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <?= Html::label('Charge Amount'); ?>
            <?= Html::textInput('chargeAmount', null, ['class' => 'form-control', 'required' => true, 'type' => 'number', 'step' => '0.001']); ?>
        </div>
        <div class="col-xs-12 col-sm-12">
            <?= Html::label('Comment'); ?>
            <?= Html::textarea('chargeComment', null, ['class' => 'form-control', 'required' => true]); ?>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary pull-left calculateBtn">Charge</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<?= Html::endForm(); ?>