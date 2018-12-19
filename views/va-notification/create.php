<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VaNotification */

$this->title = 'Create Va Notification';
$this->params['breadcrumbs'][] = ['label' => 'Va Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="va-notification-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
