<?php

/* @var $this yii\web\View */

$this->title = 'VA Dashboard';
?>
<?php
/*if(Yii::$app->data->checkEmployeeMenuAccess(['F1'])) {
    */?><!--
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Analytics for F1
                    </h3>
                </div>
                <div class="box-body table-responsive">
                    Analytics for F1
                </div>
            </div>
        </div>
    </div>
    --><?php
/*}*/
if(Yii::$app->data->checkEmployeeMenuAccess(['F2'])) {
    ?>
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Analytics for F2
                    </h3>
                </div>
                <div class="box-body table-responsive">
                    Analytics for F2
                </div>
            </div>
        </div>
    </div>
    <?php
}
if(Yii::$app->data->checkEmployeeMenuAccess(['F3'])) {
?>
<div class="row">
    <div class="col-sm-12 col-xs-12">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Analytics for F3
                </h3>
            </div>
            <div class="box-body table-responsive">
                Analytics for F3
            </div>
        </div>
    </div>
</div>
<?php } ?>