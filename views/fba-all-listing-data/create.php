<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FbaAllListingData */

$this->title = 'Create Fba All Listing Data';
$this->params['breadcrumbs'][] = ['label' => 'Fba All Listing Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fba-all-listing-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
