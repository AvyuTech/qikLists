<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SiteSetting */

$this->title = 'Add Site Setting';
$this->params['breadcrumbs'][] = ['label' => 'Manage Site Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
