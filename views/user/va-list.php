<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage VA';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        <div class="box-tools">
            <?= Html::a('Add VA', ['create-va'], ['class' => 'btn btn-sm btn-success']) ?>
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
                //'u_contact_no',
                /*[
                    'attribute' => 'u_type',
                    'value' => function($model) {
                        return ($model->u_type) ? $model->getUserType($model->u_type) : null;
                    },
                    'filter' => \app\models\User::getUserType(),
                ],*/

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view-va} {update-va} {delete-va}',
                    'buttons' => [
                        'view-va' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                'title' => Yii::t('app', 'lead-view'),
                            ]);
                        },

                        'update-va' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('app', 'lead-update'),
                            ]);
                        },
                        'delete-va' => function($url, $model, $key) {
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