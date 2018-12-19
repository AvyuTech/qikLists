<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReferUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Affiliate Stats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-default">

    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'u_name',
                [
                    'label' => 'Referred User',
                    'value' => function($model) {
                        $uCount = \app\models\ReferUsers::find()->where(['ru_refered_by' => $model->u_id])->count();

                        return $uCount;
                    }
                ],
                [
                    'header' => 'View Referred Users',
                    'value' => function($model) {
                        $uCount = \app\models\ReferUsers::find()->where(['ru_refered_by' => $model->u_id])->exists();

                        if($uCount) {
                            return Html::a("<i class='fa fa-users'></i>", ['/refer-users/get-users', 'id' => $model->u_id], ['class' => 'text-green', 'title' => 'Get Referred Users']);
                        } else {
                            return '-';
                        }
                    },
                    'format' => 'raw',
                ],
                //['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
