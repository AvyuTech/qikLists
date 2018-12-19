<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Magic Repricing';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Set Magic Repricing</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12 col-sm-10">
                    <?= Html::label('Repricer Rule', ['class' => 'control-label']); ?>
                    <?php
                        $repriserRules = \app\models\RepriserRule::find()->all();
                        $rrList = \yii\helpers\ArrayHelper::map($repriserRules, 'rr_id', 'rr_name');
                    ?>
                    <?= Html::dropDownList('repriserRule', Yii::$app->request->post('repriserRule'), ['' => '--- Select Repricer Rule ---'] + $rrList, ['required' => true, 'class' => 'form-control']); ?>
                </div>
            </div>
            <div class="row" style="margin-top: 20px;">
                <div class="col-xs-12 col-sm-10">
                    <?= Html::label('SKU', ['class' => 'control-label']); ?>
                    <?= Html::textInput('asin', Yii::$app->request->post('asin'), ['required' => true, 'class' => 'form-control']); ?>
                </div>
            </div>
            <div class="row" style="margin-top: 20px;">
                <div class="col-xs-12 col-sm-4">
                    <?= Html::label('Your Offer Price', ['class' => 'control-label']); ?>
                    <?= Html::textInput('yourBuyBox', Yii::$app->request->post('yourBuyBox'), ['required' => true, 'class' => 'form-control']); ?>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <?= Html::label('Min Price', ['class' => 'control-label']); ?>
                    <?= Html::textInput('minPrice', Yii::$app->request->post('minPrice'), ['required' => true, 'class' => 'form-control']); ?>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <?= Html::label('Max Price', ['class' => 'control-label']); ?>
                    <?= Html::textInput('maxPrice', Yii::$app->request->post('maxPrice'), ['required' => true, 'class' => 'form-control']); ?>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-success']); ?>
            <?= Html::a('Reset', ['magic-repricing'], ['class' => 'btn btn-default']); ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>

<?php if($finalPrice) { ?>
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Result</h3>
        </div>
        <div class="box-body">
            <p style="font-size: 25px;">
                Your Magic Repricing Price is <b>$<?= $finalPrice; ?></b>
            </p>
        </div>
    </div>
<?php } ?>

<?php
if(Yii::$app->request->post('asin')) {
    ?>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Offers</h3>
        </div>
        <div class="box-body">
            <?php
                $searchModel = new \app\models\ProductOffersSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['po_asin' => Yii::$app->request->post('asin')]);
            ?>
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => false,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'po_asin',
                    'po_condition',
                    [
                        'attribute' => 'po_seller_feedback_rating',
                        'value' => function($model) {
                            return ($model->po_seller_feedback_rating) ? round($model->po_seller_feedback_rating, 2).'%' : null;
                        },
                    ],
                    'po_seller_feedback_count',
                    [
                        'attribute' => 'po_listing_price',
                        'value' => function($model) {
                            return ($model->po_listing_price) ? round($model->po_listing_price, 2) : null;
                        },
                    ],
                    [
                        'attribute' => 'po_shipping_cost',
                        'value' => function($model) {
                            return ($model->po_shipping_cost) ? round($model->po_shipping_cost, 2) : null;
                        },
                    ],
                    [
                        'attribute' => 'po_is_amazon_fulfillment',
                        'value' => function($model) {
                            return ($model->po_is_amazon_fulfillment) ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>';
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'po_is_buybox_winner',
                        'value' => function($model) {
                            return ($model->po_is_buybox_winner) ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>';
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'po_is_featured_merchant',
                        'value' => function($model) {
                            return ($model->po_is_featured_merchant) ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>';
                        },
                        'format' => 'raw',
                    ],
                ],
            ]); ?>
        </div>
    </div>
    <?php
}
?>
