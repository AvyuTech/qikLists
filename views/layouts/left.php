<?php

$this->registerCss("
@media (min-width: 768px) {
    .sidebar-mini.sidebar-collapse .switch-admin {
        display: none !important;
        -webkit-transform: translateZ(0);
    }
}
");
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= Yii::$app->data->getLoginUserPhoto(); ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->u_name; ?></p>
                <span><?= Yii::$app->user->identity->u_email; ?></span>
            </div>
        </div>

        <?php $toSwitch = Yii::$app->session->get('user.idbeforeswitch'); ?>
        <?php if(!empty($toSwitch)) : ?>
            <div class="user-panel">
                <p><?= \yii\helpers\Html::a('<i class="fa fa-user-secret"></i> <span class="switch-admin">Switch To Admin</span>', ['/site/switch-back'], ['title' => 'Switch to Admin', 'class' => 'btn btn-warning col-sm-12', 'style' => 'color:#fff']) ?></p>
            </div>
        <?php endif; ?>

        <?php
            if(Yii::$app->user->identity->u_type == 1)
            {
                echo $this->render('admin-left-menu');
            } else if (Yii::$app->user->identity->u_type == 3) {
                echo $this->render('employee-left-menu');
            } else {
                echo $this->render('user-left-menu');
            }
        ?>

    </section>

</aside>
