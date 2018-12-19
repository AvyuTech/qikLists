<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ReferUsers */

$this->title = 'Create Refer Users';
$this->params['breadcrumbs'][] = ['label' => 'Refer Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="refer-users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
