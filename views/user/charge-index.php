<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Custom Charges';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= \dmstr\widgets\Alert::widget(); ?>
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        <div class="box-tools">
            <?php // Html::a('Add User', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
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
                'u_contact_no',
                [
                    'header' => 'Action',
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{custom-charge} {customer-history}',
                    'buttons' => [
                        'custom-charge' => function($url, $model, $key) {
                            return Html::a('<i class="glyphicon glyphicon-credit-card"></i>', $url, [
                                'title' => 'Make Charge',
                                'class' => 'chargePopUp',
                                ]);
                        },
                        'customer-history' => function($url, $model, $key) {
                            return Html::a('<i class="glyphicon glyphicon-time"></i>', $url, [
                                'title' => 'Charge History',
                                'class' => 'chargePopUp',
                            ]);
                        }
                    ],
                    'contentOptions' => ['class' => 'text-center'],
                    'headerOptions' => ['class' => 'text-center'],
                ],
            ],
        ]); ?>
    </div>
</div>

<?php
yii\bootstrap\Modal::begin(['id' =>'modal', 'header' => 'Loading....', 'size' => \yii\bootstrap\Modal::SIZE_DEFAULT]);
?>
    <div class="row">
        <div class="col-sm-12 col-xs-12 text-center">
            <i class="fa fa-spinner fa-spin fa-2x"></i>
        </div>
    </div>
<?php
yii\bootstrap\Modal::end();
?>
<?php
$this->registerJs("$(function() {
   $('.chargePopUp').click(function(e) {
     e.preventDefault();
     $('#modal').modal('show').find('.modal-content')
     .load($(this).attr('href'));
   });
   
    $('.modal').on('hidden.bs.modal', function(){ 
        $('.modal-body').html('<i class=\"fa fa-spinner fa-spin fa-2x\"></i> Please Wait...');
        $('.modal-title').html('Loading....');
        $('.calculateBtn').hide();
    });
});
");
?>