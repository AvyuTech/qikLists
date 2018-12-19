<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Add VA';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['va-list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">

    <?= $this->render('va_form', [
        'model' => $model, 'employee' => $employee
    ]) ?>

</div>
