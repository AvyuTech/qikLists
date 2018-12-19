<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NotificationSettingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notification Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-setting-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Notification Setting', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ns_id',
            'ns_email:ntext',
            'ns_mobile_no:ntext',
            'created_at',
            'updated_at',
            // 'created_by',
            // 'updated_by',
            // 'ns_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
