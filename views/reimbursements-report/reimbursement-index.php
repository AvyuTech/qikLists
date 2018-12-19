<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReimbursementsReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reimbursement';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Reimbursement Summary</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row" style="margin-bottom: 40px;">
            <div class="col-xs-12 col-sm-12 text-center">
                <h2>Amazon forgets to reimburse sellers for many reasons</h2>
                <p style="font-size: 20px;">
                    This is what we found Amazon owes you on your account:
                </p>
                <p style="font-size: 18px;">
                    Potential Reimbursement <br/>Amazon Owes You
                </p>
                <p class="text-aqua" style="font-size: 25px;"><b><?= array_sum($reimbursedCountData); ?></b></p>
                <p style="font-size: 18px;">
                    Projected Value <br/>
                    of Reimbursements
                </p>
                <p class="text-green" style="font-size: 25px;">
                    <b>
                        <?= '$'.array_sum($reimbursedDataS); ?>
                    </b>
                </p>
            </div>
        </div>
        <?php
            if($reimbursedDataN && $reimbursedCountData)
            {
                echo \miloschuman\highcharts\Highcharts::widget([
                    'options' => [
                        'chart'=>[
                            'type'=>'column',
                        ],
                        'exporting'=>[
                            'enabled'=>false,
                        ],
                        'credits'=>[
                            'enabled'=>false,
                        ],
                        'title'=>[
                            'text'=>'',
                        ],
                        'subtitle'=>[
                            'text' => Yii::t('app', 'Reimbursement Summary'),
                            'margin' => 0,
                        ],
                        'xAxis' => [
                            'title'=>[
                                'text' => Yii::t('app', 'Type of Reimbursement'),
                            ],
                            'categories'=> array_keys($reimbursedDataN),
                        ],
                        'yAxis'=>[
                            [
                                'min' => 0,
                                'title'=>[
                                    'text'=>Yii::t('app', 'No. of Items'),
                                ],
                                //'max' => 1000,
                            ],
                            [
                                'title'=>[
                                    'text' => Yii::t('app', 'Amount ($)'),
                                ],
                                'opposite' => true
                            ],
                        ],
                        'legend' => [
                            'shadow' => false,
                        ],
                        'tooltip' => [
                            'shared' => true
                        ],
                        'plotOptions'=>[
                            'column' => [
                                'grouping' =>  false,
                                'shadow' => false,
                                'borderWidth' => 0,
                            ],
                        ],
                        'series' => [
                            [
                                'name' => 'Amount ($)',
                                'color' => 'rgba(165,170,217,1)',
                                'data' => array_values($reimbursedDataN),
                                'pointPadding' => 0.3,
                                'pointPlacement' => -0.2,
                                'yAxis' => 1
                            ],
                            [
                                'name' => 'No. of Items',
                                'color' => 'rgba(248,161,63,1)',
                                'data' => array_values($reimbursedCountData),
                                'pointPadding' => 0.3,
                                'pointPlacement' => 0.3,
                            ],
                        ],
                    ],
                ]);
            }
            else {
                echo "<div class='alert bg-yellow'><i class='fa fa-exclamation-circle'></i> No Records Found... </div>";
            }
        ?>
    </div>
    <!-- /.box-body -->
    <div class="box-footer no-padding">
    </div>
    <!-- /.footer -->
</div>