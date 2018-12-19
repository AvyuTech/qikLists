<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AllOrdesList */

$this->title = 'Create All Ordes List';
$this->params['breadcrumbs'][] = ['label' => 'All Ordes Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="all-ordes-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
