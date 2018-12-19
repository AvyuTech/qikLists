<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Update VA: ' . $model->u_name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['va-list']];
$this->params['breadcrumbs'][] = ['label' => $model->u_name, 'url' => ['view', 'id' => $model->u_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="box box-info">
    <?= $this->render('va_form', [
        'model' => $model, 'employee' => $employee
    ]) ?>

</div>
