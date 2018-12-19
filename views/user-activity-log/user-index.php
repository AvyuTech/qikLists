<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserActivityLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Activity Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Search Filter </h3>
    </div>
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-3 col-xs-12">
                <?php echo $form->field($searchModel, 'ual_user_id')->dropDownList(\app\models\User::getUser(2), ['prompt' => '--- Select User ---']); ?>
            </div>
            <div class="col-sm-3 col-xs-12">
                <?= $form->field($searchModel, 'ual_time_spent')->textInput(['placeholder' => 'Enter value like Operator,Value. (E.g: >,50)']) ?>
            </div>
            <div class="col-sm-3 col-xs-12">
                <?php echo $form->field($searchModel, 'start_date')->widget(\yii\jui\DatePicker::classname(), ['options' => ['class' => 'form-control']]) ?>
            </div>
            <div class="col-sm-3 col-xs-12">
                <?= $form->field($searchModel, 'end_date')->widget(\yii\jui\DatePicker::classname(), ['options' => ['class' => 'form-control']]) ?>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-default']); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
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
           // 'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'ual_user_id',
                    'value' => function($model) {
                        return ($model->userName) ? $model->userName->u_name : null;
                    },
                    'filter' => false
                ],
                [
                    'attribute' => 'ual_user_ip',
                    'value' => function($model) {
                        return ($model->ual_user_ip) ? $model->ual_user_ip : null;
                    },
                    'filter' => false
                ],
                [
                    'attribute' => 'ual_login_at',
                    'value' => function($model) {
                        return ($model->ual_login_at) ? $model->ual_login_at : null;
                    },
                    'format' => 'datetime',
                    'filter' => false
                ],
                [
                    'attribute' => 'ual_logout_at',
                    'value' => function($model) {
                        return ($model->ual_logout_at) ? Yii::$app->formatter->asDatetime($model->ual_logout_at).(($model->ual_is_auto_logout) ? ' <span class="label label-warning">Auto Logout</span>' : null) : null;
                    },
                    'format' => 'raw',
                    'filter' => false
                ],
                [
                    'attribute' => 'ual_time_spent',
                    'value' => function($model) {
                        return ($model->ual_time_spent) ? $model->ual_time_spent : null;
                    },
                    'filter' => false
                ],
            ],
        ]); ?>
    </div>
</div>