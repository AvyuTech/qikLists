<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        <div class="box-tools">
            <?= Html::a('Add User', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
        </div>
    </div>
    <div class="box-body table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'u_photo',
                    'value' => function($model) {
                        return Html::img($model->getUserImage(), ['width' => '40']);
                    },
                    'format' => 'raw',
                    'filter' => false,
                ],
                'u_name',
                'u_email:email',
                'u_store_name',
                'u_contact_no',
                /*[
                    'attribute' => 'u_type',
                    'value' => function($model) {
                        return ($model->u_type) ? $model->getUserType($model->u_type) : null;
                    },
                    'filter' => \app\models\User::getUserType(),
                ],*/
                [
                    'label' => 'Switch User',
                    'value' => function($model) {
                        return ($model->u_type != 1) ? Html::a('<i class="fa fa-sign-in fa-lg"></i>', ['/user/switch-user', 'id' => $model->u_id], [
                            'title' => 'Switch to User : '.$model->u_name,
                            'class' => 'text-blue',
                            'data' => ['method' => 'post'],
                        ]) : '';
                    },
                    'format' => 'raw',
                    'contentOptions' => ['class' => 'text-center'],
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'delete' => function($url, $model, $key) {
                            return ($model->u_type != 1) ? Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, [
                                'title' => 'Delete',
                                'data-confirm' => \Yii::t('yii', 'Are you sure to delete this user?'),
                                'data-method' => 'post',
                                ]) : null;
                        }
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>