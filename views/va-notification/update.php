<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VaNotification */

$this->title = 'Update Va Notification: ' . $model->vn_id;
$this->params['breadcrumbs'][] = ['label' => 'Va Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->vn_id, 'url' => ['view', 'id' => $model->vn_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="va-notification-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
