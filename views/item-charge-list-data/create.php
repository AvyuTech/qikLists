<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItemChargeListData */

$this->title = 'Create Item Charge List Data';
$this->params['breadcrumbs'][] = ['label' => 'Item Charge List Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-charge-list-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
