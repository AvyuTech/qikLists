<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\NotificationSetting */

$this->title = 'Create Notification Setting';
$this->params['breadcrumbs'][] = ['label' => 'Notification Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-setting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
