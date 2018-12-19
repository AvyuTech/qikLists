<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\AmazonCategory */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Charge History: '.$model->u_name;
?>
<?= Html::beginForm(); ?>
<div class="modal-header">
    <h3 class="modal-title">Charge History for <?= $model->u_name; ?></h3>
    <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>-->
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <?php
                if($chargeList) {
            ?>
            <table class="table table-bordered">
                <tr>
                    <th>Charge ID</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Date & Time</th>
                </tr>
                <?php
                    foreach ($chargeList as $charge) {
                ?>
                        <tr>
                            <td><?= $charge['id']; ?></td>
                            <td><?= ($charge['amount']/100); ?></td>
                            <td><?= $charge['description']; ?></td>
                            <td><?= Yii::$app->formatter->asDatetime($charge['created']); ?></td>
                        </tr>
                <?php
                    }
                ?>
            </table>
            <?php } else { ?>
                    Charge not found.
            <?php }?>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<?= Html::endForm(); ?>