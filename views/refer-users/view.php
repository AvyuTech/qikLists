<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ReferUsers */

$this->title = $model->ru_id;
$this->params['breadcrumbs'][] = ['label' => 'Refer Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="refer-users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ru_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ru_id], [
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
            'ru_id',
            'ru_refer_user_id',
            'ru_used_promo_code',
            'ru_plan',
            'ru_refer_date',
            'ru_refered_by',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
            'ru_status',
        ],
    ]) ?>

</div>
