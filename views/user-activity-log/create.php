<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserActivityLog */

$this->title = 'Create User Activity Log';
$this->params['breadcrumbs'][] = ['label' => 'User Activity Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-activity-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
