<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Get No. of Product';

?>
<div class="box box-success">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <?= \yii\helpers\Html::label('Enter Url'); ?>
                <?php
                    $value = Yii::$app->request->post('url');
                ?>
                <?= \yii\helpers\Html::textInput('url', $value, ['class' => 'form-control', 'placeholder' => 'Enter only 6pm website url'])?>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset', ['get-product-no'], ['class' => 'btn btn-default'])?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php if(!is_null($count)) { ?>
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Total Product Count</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <span style="font-size: 20px"><?= $count; ?></span>
            </div>
        </div>
    </div>
</div>
<?php } ?>