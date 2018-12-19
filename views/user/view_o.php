<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'View User : '.$model->u_name;
$this->params['breadcrumbs'][] = ['label' => 'Users'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        <?php if(Yii::$app->user->identity->u_type == 1) : ?>
        <div class="box-tools">
            <?= Html::a('Back', ['index'], ['class' => 'btn btn-default btn-sm']) ?>
            <?= Html::a('Update', ['update', 'id' => $model->u_id], ['class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->u_id], [
                'class' => 'btn btn-danger btn-sm',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        <?php endif; ?>
    </div>
    <div class="box-body table-responsive">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'u_name',
                'u_email:email',
                'u_contact_no',
                'u_address',
                [
                    'attribute' => 'u_type',
                    'value' =>($model->u_type) ? $model->getUserType($model->u_type) : null,
                ],
                [
                    'attribute' => 'u_photo',
                    'value' => ($model->u_photo) ? $model->getUserImage() : null,
                ],
            ],
        ]) ?>
    </div>
</div>
