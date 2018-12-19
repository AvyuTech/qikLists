<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\NotificationSetting */

$this->title = $model->ns_id;
$this->params['breadcrumbs'][] = ['label' => 'Notification Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-setting-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ns_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ns_id], [
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
            'ns_id',
            'ns_email:ntext',
            'ns_mobile_no:ntext',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'ns_status',
        ],
    ]) ?>

</div>
