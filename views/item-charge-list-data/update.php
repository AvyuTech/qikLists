<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItemChargeListData */

$this->title = 'Update Item Charge List Data: ' . $model->icld_id;
$this->params['breadcrumbs'][] = ['label' => 'Item Charge List Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->icld_id, 'url' => ['view', 'id' => $model->icld_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-charge-list-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
