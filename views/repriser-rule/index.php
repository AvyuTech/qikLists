<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RepriserRuleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Repricer Rules';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
if(Yii::$app->request->get('s')) {
    ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        You have successfully submitted Reprice.
    </div>
    <?php
}
?>

<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Repricer Rule List</h3>
        <div class="box-tools">
            <?= Html::a('Add New Rule', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        </div>
    </div>
    <div class="box-body table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'rr_name',
                [
                    'attribute' => 'rr_goal',
                    'value' => function($model) {
                        return $model->getGoal($model->rr_goal);
                    },
                    'filter' => \app\models\RepriserRule::getGoal(),
                ],
                [
                    'attribute' => 'rr_match_action',
                    'value' => function($model) {
                        return $model->getMatchAction($model->rr_match_action);
                    },
                    'filter' => \app\models\RepriserRule::getMatchAction(),
                ],
                [
                    'attribute' => 'rr_rule_comparison',
                    'value' => function($model) {
                        return $model->getRuleComparison($model->rr_rule_comparison);
                    },
                    'filter' => \app\models\RepriserRule::getRuleComparison(),
                ],
                /*'rr_match_action',
                'rr_pricing_action',
                'rr_pricing_amount',
                'rr_pricing_percentage',
                'rr_rule_comparison',
                'rr_rule_comparison_ignore_amazon',
                'rr_raise_price',
                'rr_raise_price_action',
                'rr_raise_price_amount',
                'rr_raise_price_percentage',
                'rr_raise_price_comparison',
                'rr_raise_price_comparison_ignore_amazon',*/

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}'
                ],
            ],
        ]); ?>
    </div>
</div>
