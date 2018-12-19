<?= dmstr\widgets\Menu::widget(
    [
        'options' => ['class' => 'sidebar-menu'],
        'items' => [
            ['label' => 'Menu', 'options' => ['class' => 'header']],
            [
                'label' => 'Dashboard',
                'icon' => 'dashboard',
                'url' => ['/site/index'],
                'visible' => (Yii::$app->user->identity->u_type == 1)
            ],
            [
                'label' => 'Manage Users',
                'icon' => 'users',
                'url' => ['/user/index'],
                'visible' => (Yii::$app->user->identity->u_type == 1)
            ],
            [
                'label' => 'Repricing Rule',
                'icon' => '',
                'url' => ['/repriser-rule'],
                'visible' => (Yii::$app->user->identity->u_type == 1),
                'encode' => false
            ],
            [
                'label' => 'Magic Repricing',
                'icon' => '',
                'url' => ['/site/magic-repricing'],
                'visible' => (Yii::$app->user->identity->u_type == 1),
                'encode' => false
            ],
            [
                'label' => 'Active ASIN',
                'icon' => '',
                'url' => ['/fba-all-listing-data/index'],
                'visible' => (Yii::$app->user->identity->u_type == 1),
                'encode' => false
            ],
            [
                'label' => 'Orders',
                'icon' => '',
                'url' => ['/all-ordes-list'],
                'encode' => false
            ],
            [
                'label' => 'Setting',
                'icon' => 'cog',
                'url' => '#',
                'items' => [
                    /*['label' => 'Notification Setting', 'icon' => '', 'url' => ['/user/notification-setting'],],*/
                    ['label' => 'Amazon Credentials Setting', 'icon' => '', 'url' => ['/user/seller-credentials'],],
                ],
            ],
            /*[
                'label' => 'Setting',
                'icon' => 'cogs',
                'url' => '#',
                'visible' => (Yii::$app->user->identity->u_type == 1)
            ],*/
        ],
    ]
) ?>
