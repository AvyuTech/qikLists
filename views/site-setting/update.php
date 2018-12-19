<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SiteSetting */

$this->title = 'Update Site Setting';
$this->params['breadcrumbs'][] = ['label' => 'Manage Site Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="box box-info">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
