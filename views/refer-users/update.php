<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ReferUsers */

$this->title = 'Update Payout Months of Refer User: ' . (($model->user) ? $model->user->u_name : null);
$this->params['breadcrumbs'][] = ['label' => 'Refer Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="box box-info">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
