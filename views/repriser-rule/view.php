<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RepriserRule */

$this->title = $model->rr_id;
$this->params['breadcrumbs'][] = ['label' => 'Repricer Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repriser-rule-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->rr_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->rr_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'rr_id',
            'rr_name',
            'rr_goal',
            'rr_match_action',
            'rr_pricing_action',
            'rr_pricing_amount',
            'rr_pricing_percentage',
            'rr_rule_comparison',
            'rr_rule_comparison_ignore_amazon',
            'rr_raise_price',
            'rr_raise_price_action',
            'rr_raise_price_amount',
            'rr_raise_price_percentage',
            'rr_raise_price_comparison',
            'rr_raise_price_comparison_ignore_amazon',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'rr_status',
        ],
    ]) ?>

</div>
