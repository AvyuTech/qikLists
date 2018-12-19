<?= dmstr\widgets\Menu::widget(
    [
        'options' => ['class' => 'sidebar-menu'],
        'items' => [
            ['label' => 'Menu', 'options' => ['class' => 'header']],
            [
                'label' => 'Dashboard',
                'icon' => 'dashboard',
                'url' => ['/site/index'],
            ],
            [
                'label' => 'Active ASIN',
                'icon' => '',
                'url' => ['/fba-all-listing-data/index'],
                'visible' => (Yii::$app->user->identity->u_type == 2),
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
                    ['label' => 'Request Min/Max/Cost Email', 'icon' => '', 'url' => ['/site/request-min-max-cost'],],
                ],
            ],
        ],
    ]
) ?>
