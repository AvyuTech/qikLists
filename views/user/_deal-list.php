<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DealDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<?php
$dataProvider = new \yii\data\ActiveDataProvider([
    'query' => $model,
    'pagination' => [
        'pageSize' => 10,
        'pageSizeParam' => 'child-per-page',
        'pageParam' => 'child-deal-page',
        /*'params' => array_merge($_GET, ['active-row' => $key]),*/
    ],
    'sort' => ['defaultOrder' => ['sl_id' => SORT_DESC]]
]);
?>
<div class="box-body table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '{items}{pager}',
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'sl_link',
                'value' => function($model) {
                    return Html::a('Store Link', $model->sl_link, ['title' => $model->sl_link, 'target' => '_blank']);
                },
                'format' => 'raw'
            ],
            'sl_last_page',
            'sl_category',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{remove-list}',
                'buttons' => [
                    'remove-list' => function($url, $model) {
                        return Html::a('<i class="glyphicon glyphicon-trash"></i>', ['remove-list', 'id' => $model->sl_id, 'type' => 'linkIdArray'], ['title' => 'Delete']);
                    }
                ]
            ],
        ],
    ]); ?>
</div>
