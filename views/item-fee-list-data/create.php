<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItemFeeListData */

$this->title = 'Create Item Fee List Data';
$this->params['breadcrumbs'][] = ['label' => 'Item Fee List Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-fee-list-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
