<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SiteSettingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Site Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Site Setting</h3>
        <div class="box-tools">
            <?php if(!$model) { ?>
                <?= Html::a('Add Setting', ['create'], ['class' => 'btn btn-success btn-sm']); ?>
            <?php } else {
                echo Html::a('Update Setting', ['update', 'id' => $model->ss_id], ['class' => 'btn btn-info btn-sm']);
            } ?>
        </div>
    </div>
    <div class="box-body">
        <?php
        if($model) {
            ?>
            <?= \yii\widgets\DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'ss_default_coupon_code',
                        'value' => $model->ss_default_coupon_code,
                    ],
                    [
                        'attribute' => 'ss_payout_percentage',
                        'value' => ($model->ss_payout_percentage) ? $model->ss_payout_percentage." %" : '',
                    ],
                    'ss_payout_months',
                ],
            ]); ?>
        <?php } else { ?>
            <h3 class="box-title">Setting not configured.</h3>
        <?php } ?>
    </div>
</div>
