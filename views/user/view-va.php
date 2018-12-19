<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'View VA : '.$model->u_name;
$this->params['breadcrumbs'][] = ['label' => 'Manage VA'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        <?php if(Yii::$app->user->identity->u_type == 1) : ?>
            <div class="box-tools">
                <?= Html::a('Back', ['va-list'], ['class' => 'btn btn-default btn-sm']) ?>
                <?= Html::a('Update', ['update-va', 'id' => $model->u_id], ['class' => 'btn btn-primary btn-sm']) ?>
                <?php if(Yii::$app->user->identity->u_type != 1) : ?>
                    <?= Html::a('Delete', ['delete-va', 'id' => $model->u_id], [
                        'class' => 'btn btn-danger btn-sm',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="<?= $model->getUserImage(); ?>" alt="User profile picture">

        <h3 class="profile-username text-center"><?= $model->u_name; ?></h3>

        <p class="text-muted text-center"><?= $model->u_email; ?></p>

        <ul class="list-group list-group-unbordered">
            <!--<li class="list-group-item row" style="margin-left:0px; margin-right: 0px">
                <div class="col-sm-6 col-xs-12">
                    <b><?php /*= $model->getAttributeLabel('u_contact_no'); */?></b> <a class="pull-right"><?/*= $model->u_contact_no; */?></a>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <b><?php /*= $model->getAttributeLabel('u_address'); */?></b> <a class="pull-right"><?/*= $model->u_address; */?></a>
                </div>
            </li>-->
            <li class="list-group-item row" style="margin-left:0px; margin-right: 0px">
                <div class="col-sm-6 col-xs-12">
                    <b><?= $model->getAttributeLabel('u_type');?></b> <a class="pull-right"><?= ($model->u_type) ? $model->getUserType($model->u_type) : null; ?></a>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <b><?= 'Permission'; ?></b> <a class="pull-right"><?= ($model->employee) ? $model->employee->e_roles : null; ?></a>
                </div>
            </li>
        </ul>
    </div>
    <!-- /.box-body -->
</div>