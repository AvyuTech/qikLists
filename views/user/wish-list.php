<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\dynagrid\DynaGrid;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TodayDealsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User\'s Bulk List');
$this->params['breadcrumbs'][] = $this->title;
$this->registerCss("
.am-cats {
    padding-left: 5px;
    padding-right: 5px;
}
.selelcted-cat {
    font-weight: bold;
    color : #00a65a !important
}
");
?>
<?php if(Yii::$app->session->hasFlash('success')) : ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Success!</h4>
        <?= Yii::$app->session->getFlash('success') ;?>
    </div>
<?php endif;?>
<?php
if($wishList) {
    ?>
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Search Category</h3>
            <div class="box-tools">
                <?= Html::a(Yii::t('app', 'Clear Bulk List'), ['/site/reset-wish-list', 'ref' => ''], ['class' => 'btn bg-blue btn-sm']) ?>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 text-center" style="font-size: 20px">
                    <?= Html::a('<strong>Export All</strong>', ['user-wish-list', 'export' => 'export'], ['title' => 'Export All']); ?>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 text-center" style="font-size: 18px">
                    <?php
                        $amzCats = \app\models\ClearanceData::getAmazonCategories();
                        foreach ($amzCats as $acKey => $acValue) {
                            $selectedCat = (Yii::$app->request->get('ac_id') == $acKey) ? 'selelcted-cat' : '';
                    ?>
                            <?= Html::a($acValue, $selectedCat ? 'javascript:void(0);' : ['user-wish-list', 'ac_id' => $acKey], ['title' => $acValue, 'class' => 'am-cats '.$selectedCat ]); ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default block3" style="position: static; zoom: 1;">
                <div class="panel-heading"><i class="mdi mdi-format-paragraph fa-fw"></i> User's Clearance Bulk List
                    Deal
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <?php
                        if ($dataProvider) {
                            $dynagrid = DynaGrid::begin([
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],

                                    //'ud_category_id:text:Category',
                                    'ud_url:text:Url',
                                    'ud_name:text:Store Category',
                                    //'ud_start_page:text:Start Page',
                                    [
                                        'header' => 'Start Page',
                                        'attribute' => 'ud_start_page',
                                        'value' => function($model) {
                                            return ($model->websiteName) ? $model->websiteName->w_start_page : '';
                                        }
                                    ],
                                    'ud_last_page:text:Last Page',
                                    [
                                        'attribute' => 'ud_website',
                                        'value' => function($model) {
                                            return ($model->websiteName) ? $model->websiteName->w_name : '';
                                        }
                                    ],
                                    //'ud_amazon_category:text:Amazon Category',
                                    'ud_items:text:Items',
                                   // 'ud_category_title:text:Category Title',

                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{remove-list}',
                                        'buttons' => [
                                            'remove-list' => function($url, $model) {
                                                return Html::a('<i class="glyphicon glyphicon-trash"></i>', ['remove-list', 'id' => $model['ud_id'], 'type' => 'clearanceDeal'], ['title' => 'Delete']);
                                            }
                                        ]
                                    ],
                                ],
                                'theme' => 'panel-info',
                                'showPersonalize' => false,
                                'allowThemeSetting' => false,
                                'allowFilterSetting' => false,
                                'allowSortSetting' => false,
                                'submitButtonOptions' => ['class' => 'btn btn-success'],
                                'gridOptions' => Yii::$app->data->getGridSetting($dataProvider, $clearSearchModel, 'Clearance_Deal_List_', false, 'grid-cdL'),
                                'options' => ['id' => 'dynagrid-product-data'] // a unique identifier is important
                            ]);
                            DynaGrid::end();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default block3" style="position: static; zoom: 1;">
                <div class="panel-heading"><i class="mdi mdi-format-paragraph fa-fw"></i> User's Daily Deal Bulk List
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <?php
                        if ($dataProviderTd) {
                            $dynagrid = DynaGrid::begin([
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],

                                    [
                                        'class' => 'kartik\grid\ExpandRowColumn',
                                        'width' => '50px',
                                        'value' => function ($model, $key, $index, $column) {
                                            return \kartik\grid\GridView::ROW_COLLAPSED;
                                        },
                                        'detail' => function ($model, $key, $index, $column) {
                                            $linkIdArray = [];
                                            if(Yii::$app->session->get('uWishList'))
                                            {
                                                $linkIdArray = \yii\helpers\Json::decode(Yii::$app->session->get('uWishList'));
                                            }
                                            $linkIdLink = ($linkIdArray) ? $linkIdArray['linkIdArray'] : [];
                                            $data = \app\models\StoreLinks::find()->where(['AND', ['IN', 'sl_id', $linkIdLink], ['sl_today_deal_id' => $model->td_id]]);
                                            return Yii::$app->controller->renderPartial('_deal-list', ['model' => $data, 'key' => $key]);
                                        },
                                        'headerOptions'=>['class'=>'kartik-sheet-style-wl'],
                                        'expandOneOnly' => true
                                    ],
                                    [
                                        'attribute' => 'td_store_name',
                                        'value' => function($model) {
                                            return ($model->websiteName) ? $model->websiteName->w_name : null;
                                        },
                                    ],
                                    [
                                        'label' => 'Deal',
                                        'attribute' => 'td_deal',
                                    ],
                                    [
                                        'label' => 'Start Date',
                                        'attribute' => 'td_start_date',
                                    ],
                                    [
                                        'label' => 'End Date',
                                        'attribute' => 'td_end_date',
                                    ],
                                    [
                                        'label' => 'Cashback',
                                        'attribute' => 'td_discount',
                                    ],
                                    [
                                        'attribute' => 'td_vendor',
                                        'value' => function($model) {
                                            $vendor = \app\models\Vendor::findOne($model['td_vendor']);
                                            return ($vendor) ? Html::a($vendor->v_name, $model['td_moniter_link'], ['title' => $model['td_moniter_link'], 'target' => '_blank']) : null;
                                        },
                                        'format' => 'raw',
                                    ],
                                    /*[
                                        //'class'=>'kartik\grid\EditableColumn',
                                        'label' => 'Moniter Link',
                                        'attribute' => 'td_moniter_link',
                                        'value' => function ($model) {
                                            return ($model['td_moniter_link'] && $model['td_moniter_link'] != 'N/A') ? Html::a('Open', $model['td_moniter_link'], ['title' => $model['td_moniter_link'], 'target' => '_blank']) : null;
                                        },
                                        'format' => 'raw',
                                    ],*/

                                    [
                                        'label' => 'Extra Note',
                                        'attribute' => 'td_extra_note',
                                    ],

                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{remove-list}',
                                        'buttons' => [
                                            'remove-list' => function($url, $model) {
                                                return Html::a('<i class="glyphicon glyphicon-trash"></i>', ['remove-list', 'id' => $model['td_id'], 'type' => 'todayDeal'], ['title' => 'Delete']);
                                            }
                                        ]
                                    ],
                                ],
                                'theme' => 'panel-info',
                                'showPersonalize' => false,
                                'allowThemeSetting' => false,
                                'allowFilterSetting' => false,
                                'allowSortSetting' => false,
                                'submitButtonOptions' => ['class' => 'btn btn-success'],
                                'gridOptions' => Yii::$app->data->getGridSetting($dataProviderTd, $todaySearchModel, 'Today\'s_Deal_List_', false, 'grid-tdL'),
                                'options' => ['id' => 'dynagrid-product-data-td'] // a unique identifier is important
                            ]);
                            DynaGrid::end();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default block3" style="position: static; zoom: 1;">
                <div class="panel-heading"><i class="mdi mdi-format-paragraph fa-fw"></i> Store Bulk List
                    Deal
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <?php
                        if ($dataProviderUd) {
                            $dynagrid = DynaGrid::begin([
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],

                                    //'ud_category_id:text:Category',
                                    'ud_url:text:Url',
                                    'ud_name:text:Store Category',
                                    //'ud_start_page:text:Start Page',
                                    [
                                        'header' => 'Start Page',
                                        'attribute' => 'ud_start_page',
                                        'value' => function($model) {
                                            return ($model->websiteName) ? $model->websiteName->w_start_page : '';
                                        }
                                    ],
                                    'ud_last_page:text:Last Page',
                                    [
                                        'attribute' => 'ud_website',
                                        'value' => function($model) {
                                            return ($model->websiteName) ? $model->websiteName->w_name : '';
                                        }
                                    ],
                                    //'ud_amazon_category:text:Amazon Category',
                                    'ud_items:text:Items',
                                    // 'ud_category_title:text:Category Title',

                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{remove-list}',
                                        'buttons' => [
                                            'remove-list' => function($url, $model) {
                                                return Html::a('<i class="glyphicon glyphicon-trash"></i>', ['remove-list', 'id' => $model['ud_id'], 'type' => 'userDataDeal'], ['title' => 'Delete']);
                                            }
                                        ]
                                    ],
                                ],
                                'theme' => 'panel-info',
                                'showPersonalize' => false,
                                'allowThemeSetting' => false,
                                'allowFilterSetting' => false,
                                'allowSortSetting' => false,
                                'submitButtonOptions' => ['class' => 'btn btn-success'],
                                'gridOptions' => Yii::$app->data->getGridSetting($dataProviderUd, $userDataSearchModel, 'User_Deal_List_', false, 'grid-udL'),
                                'options' => ['id' => 'dynagrid-product-data-e'] // a unique identifier is important
                            ]);
                            DynaGrid::end();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="box box-solid">
        <div class="box-body">
            <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                Your Wish List is empty
            </h4>
        </div>
    </div>
<?php
}
    ?>