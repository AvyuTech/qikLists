<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NotificationSetting */

$this->title = 'Update Notification Setting: ' . $model->ns_id;
$this->params['breadcrumbs'][] = ['label' => 'Notification Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ns_id, 'url' => ['view', 'id' => $model->ns_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="notification-setting-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
