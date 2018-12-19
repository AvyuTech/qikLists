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
                'label' => 'Lost/Damaged/Destroyed',
                'icon' => '',
                'url' => ['/adjustment-inventory-report/report'],
               // 'visible' => (Yii::$app->data->checkEmployeeMenuAccess(['FileCase'])),
                'encode' => false
            ],
            [
                'label' => 'Notifications',
                'icon' => '',
                'url' => ['/va-notification/all-notification'],
            ],
        ],
    ]
) ?>
