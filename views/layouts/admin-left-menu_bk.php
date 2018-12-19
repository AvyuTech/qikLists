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
                'url' => '#',
                'items' => [
                    [
                        'label' => 'View users',
                        'icon' => 'users',
                        'url' => ['/user/index'],
                        'visible' => (Yii::$app->user->identity->u_type == 1)
                    ],
                    [
                        'label' => 'User Login Logs',
                        'icon' => 'history',
                        'url' => ['/user-activity-log/user'],
                        'visible' => (Yii::$app->user->identity->u_type == 1)
                    ],
                    /*[
                        'label' => 'File Permissions',
                        'icon' => 'file',
                        'url' => ['#'],
                        'visible' => (Yii::$app->user->identity->u_type == 1)
                    ],*/
                ],
                'visible' => (Yii::$app->user->identity->u_type == 1)
            ],
            /*[
                'label' => 'Store Bulk List',
                'icon' => 'cloud-upload',
                'url' => ['/user-data'],
            ],
            [
                'label' => 'Daily Deal Bulk List',
                'icon' => 'shopping-cart',
                'url' => ['/today-deals/index'],
            ],
            [
                'label' => 'Daily Deal Bulk List Analytics',
                'icon' => 'cart-plus',
                'url' => ['/today-deals/index-analytic'],
            ],
            [
                'label' => 'Clearance Bulk List',
                'icon' => 'shopping-cart',
                'url' => ['/clearance-data/index'],
            ],*/
            [
                'label' => 'VA Activity',
                'icon' => 'user-circle-o',
                'url' => '#',
                'items' => [
                    [
                        'label' => 'Add VA',
                        'icon' => 'user-circle',
                        'url' => ['/user/va-list'],
                        'visible' => (Yii::$app->user->identity->u_type == 1)
                    ],
                    [
                        'label' => 'VA Login Logs',
                        'icon' => 'history',
                        'url' => ['/user-activity-log/va'],
                        'visible' => (Yii::$app->user->identity->u_type == 1)
                    ],
                    /*[
                        'label' => 'VA File Update Log',
                        'icon' => 'file',
                        'url' => ['#'],
                        'visible' => (Yii::$app->user->identity->u_type == 1)
                    ],*/
                ],
                'visible' => (Yii::$app->user->identity->u_type == 1)
            ],
            [
                'label' => 'Reimbursements Report  &nbsp;<span data-toggle="tooltip" title="This report contains inventory that has completed the receive process at Amazon’s fulfillment Centers"> <i class="fa fa-info-circle"></i></span>',
                'icon' => 'area-chart',
                'url' => ['/amazon-report/reimbursements-report'],
                'visible' => (Yii::$app->user->identity->u_type == 1),
                'encode' => false
            ],
            [
                'label' => 'Inventory Adjustment Report',
                'icon' => 'line-chart',
                'url' => ['/amazon-report/inventory-adjustment-report'],
                'visible' => (Yii::$app->user->identity->u_type == 1),
                'encode' => false
            ],
            [
                'label' => 'Account Health Monitoring',
                'icon' => 'user-md',
                'url' => '#',
                'items' => [
                    ['label' => 'Seller Feedback Report', 'icon' => 'circle-o', 'url' => ['amazon-report/seller-feedback-report'],],
                    ['label' => 'Seller Performance Report', 'icon' => 'circle-o', 'url' => ['amazon-report/seller-performance-report'],],
                ],
            ],
            [
                'label' => 'Stranded Inventory Report',
                'icon' => 'line-chart',
                'url' => ['/amazon-report/stranded-inventory-report'],
                'visible' => (Yii::$app->user->identity->u_type == 1),
                'encode' => false
            ],
            [
                'label' => 'Suppressed Listings Report',
                'icon' => 'line-chart',
                'url' => ['/amazon-report/suppressed-listings-report'],
                'visible' => (Yii::$app->user->identity->u_type == 1),
                'encode' => false
            ],
            [
                'label' => 'Inventory Details Report',
                'icon' => 'line-chart',
                'url' => ['/amazon-report/inventory-details-report'],
                'visible' => (Yii::$app->user->identity->u_type == 1),
                'encode' => false
            ],
            [
                'label' => 'Monthly Inventory History Report',
                'icon' => 'line-chart',
                'url' => ['/amazon-report/monthly-inventory-history-report'],
                'visible' => (Yii::$app->user->identity->u_type == 1),
                'encode' => false
            ],
            [
                'label' => 'Order Removal Details Report',
                'icon' => 'line-chart',
                'url' => ['/amazon-report/order-removal-detail-report'],
                'visible' => (Yii::$app->user->identity->u_type == 1),
                'encode' => false
            ],
            [
                'label' => 'Inbound Shipment Report',
                'icon' => 'line-chart',
                'url' => ['/amazon-report/inbound-shipment-performance-report'],
                'visible' => (Yii::$app->user->identity->u_type == 1),
                'encode' => false
            ],
            [
                'label' => 'Request Reports',
                'icon' => 'bar-chart',
                'url' => ['/amazon-report/request-report'],
                'visible' => (Yii::$app->user->identity->u_type == 1),
            ],
            [
                'label' => 'Requested Reports',
                'icon' => 'pie-chart',
                'url' => ['/request-report/requested'],
                'visible' => (Yii::$app->user->identity->u_type == 1),
            ],
            [
                'label' => 'Blog',
                'icon' => 'comments',
                'url' => '#',
                'items' => [
                    ['label' => 'Manage Blog', 'icon' => 'circle-o', 'url' => ['blogs/index'],],
                    ['label' => 'Add Blog', 'icon' => 'circle-o', 'url' => ['blogs/create'],],
                ],
            ],
            [
                'label' => 'Coupon Code',
                'icon' => 'ticket',
                'url' => ['/coupons'],
                'visible' => (!Yii::$app->user->isGuest && Yii::$app->user->identity->u_type == 1)
            ],
            /*[
                'label' => 'Affiliate Program',
                'icon' => 'handshake-o',
                'url' => ['/affiliates/affiliate-user'],
                'visible' => (!Yii::$app->user->isGuest && Yii::$app->user->identity->u_type == 1)
            ],*/
            [
                'label' => 'Affiliate Program',
                'icon' => 'circle-o',
                'url' => '#',
                'items' => [
                    [
                        'label' => 'Affiliate',
                        'icon' => 'user-secret',
                        'url' => ['/affiliates'],
                        'visible' => (Yii::$app->user->identity->u_type == 1)
                    ],
                    [
                        'label' => 'Affiliate Stats',
                        'icon' => 'bar-chart',
                        'url' => ['/refer-users'],
                        'visible' => (Yii::$app->user->identity->u_type == 1)
                    ],
                    [
                        'label' => 'Affiliate Coupon Setting',
                        'icon' => 'cog',
                        'url' => ['/site-setting'],
                        'visible' => (Yii::$app->user->identity->u_type == 1)
                    ],
                    /*[
                        'label' => 'Add List',
                        'icon' => 'list',
                        'url' => ['/user-data/import'],
                        'visible' => (Yii::$app->user->identity->u_type == 1)
                    ],*/
                ],
                'visible' => (Yii::$app->user->identity->u_type == 1)
            ],
            [
                'label' => 'Reimbursement',
                'icon' => '',
                'url' => ['/reimbursements-report/reimbursement'],
               // 'visible' => false, //(Yii::$app->user->identity->u_type == 1),
                'encode' => false
            ],
            [
                'label' => 'Report',
                'icon' => '',
                'url' => ['/adjustment-inventory-report/report'],
                'visible' => false, //(Yii::$app->user->identity->u_type == 1),
                'encode' => false
            ],
            [
                'label' => 'Finance Event Data',
                'icon' => 'usd',
                'url' => ['/fba-financial-transaction/finance-event-list'],
                'encode' => false
            ],
            [
                'label' => 'Other Reports',
                'icon' => 'bar-chart',
                'url' => '#',
                'items' => [
                    /*[
                        'label' => 'Reimbursements Report  &nbsp;<span data-toggle="tooltip" title="This report contains inventory that has completed the receive process at Amazon’s fulfillment Centers"> <i class="fa fa-info-circle"></i></span>',
                        'icon' => 'area-chart',
                        'url' => ['/amazon-report/reimbursements-report'],
                        'visible' => (Yii::$app->user->identity->u_type == 1),
                        'encode' => false
                    ],*/
                    [
                        'label' => 'Inventory Report &nbsp;<span data-toggle="tooltip" title="This report contains a summary of the seller\'s product listings with the price and quantity for each SKU"> <i class="fa fa-info-circle"></i></span>',
                        'icon' => 'line-chart',
                        'url' => ['/amazon-report/inventory-report'],
                        'visible' => (Yii::$app->user->identity->u_type == 1),
                        'encode' => false
                    ],
                    /*[
                        'label' => 'Inventory Adjustment Report',
                        'icon' => 'line-chart',
                        'url' => ['/amazon-report/inventory-adjustment-report'],
                        'visible' => (Yii::$app->user->identity->u_type == 1),
                        'encode' => false
                    ],*/
                    [
                        'label' => 'Order Report &nbsp;<span data-toggle="tooltip" title="This report contains a Orders"> <i class="fa fa-info-circle"></i></span>',
                        'icon' => 'line-chart',
                        'url' => ['/amazon-report/order-report'],
                        'visible' => (Yii::$app->user->identity->u_type == 1),
                        'encode' => false
                    ],
                    [
                        'label' => 'FBA Monthly Inventory History Report',
                        'icon' => 'line-chart',
                        'url' => ['/amazon-report/fba-monthly-inventory-report'],
                        'visible' => (Yii::$app->user->identity->u_type == 1),
                        'encode' => false
                    ],
                    [
                        'label' => 'FBA Restock Report',
                        'icon' => 'line-chart',
                        'url' => ['/amazon-report/fba-restock-report'],
                        'visible' => (Yii::$app->user->identity->u_type == 1),
                        'encode' => false
                    ],
                    [
                        'label' => 'FBA Financial Transaction Report',
                        'icon' => 'line-chart',
                        'url' => ['/amazon-report/fba-financial-transaction-report'],
                        'visible' => (Yii::$app->user->identity->u_type == 1),
                        'encode' => false
                    ],
                    [
                        'label' => 'FBA Return Report',
                        'icon' => 'line-chart',
                        'url' => ['/amazon-report/fba-return-report'],
                        'visible' => (Yii::$app->user->identity->u_type == 1),
                        'encode' => false
                    ],
                    [
                        'label' => 'FBA Replacements Report',
                        'icon' => 'line-chart',
                        'url' => ['/amazon-report/fba-replacements-report'],
                        'visible' => (Yii::$app->user->identity->u_type == 1),
                        'encode' => false
                    ],
                    [
                        'label' => 'FBA Received Inventory Report',
                        'icon' => 'line-chart',
                        'url' => ['/amazon-report/fba-received-inventory-report'],
                        'visible' => (Yii::$app->user->identity->u_type == 1),
                        'encode' => false
                    ],
                    [
                        'label' => 'FBA Inbound Performance Report',
                        'icon' => 'line-chart',
                        'url' => ['/amazon-report/fba-inbound-performance-report'],
                        'visible' => (Yii::$app->user->identity->u_type == 1),
                        'encode' => false
                    ],
                    [
                        'label' => 'All Listing Report',
                        'icon' => 'line-chart',
                        'url' => ['/amazon-report/all-listing-report'],
                        'visible' => (Yii::$app->user->identity->u_type == 1),
                        'encode' => false
                    ],
                    [
                        'label' => 'Active Listing Report',
                        'icon' => 'line-chart',
                        'url' => ['/amazon-report/active-listing-report'],
                        'visible' => (Yii::$app->user->identity->u_type == 1),
                        'encode' => false
                    ],
                    [
                        'label' => 'Inactive Listing Report',
                        'icon' => 'line-chart',
                        'url' => ['/amazon-report/inactive-listing-report'],
                        'visible' => (Yii::$app->user->identity->u_type == 1),
                        'encode' => false
                    ],
                    [
                        'label' => 'Settlement Report',
                        'icon' => 'line-chart',
                        'url' => ['/amazon-report/settlement-report'],
                        'visible' => (Yii::$app->user->identity->u_type == 1),
                        'encode' => false
                    ],
                    /*[
                        'label' => 'Settlement Report V2',
                        'icon' => 'line-chart',
                        'url' => ['/amazon-report/settlement-v2-report'],
                        'visible' => (Yii::$app->user->identity->u_type == 1),
                        'encode' => false
                    ],*/
                ],
                'visible' => (Yii::$app->user->identity->u_type == 1),
            ],
            /*[
                'label' => 'Add Website',
                'icon' => 'globe',
                'url' => ['/website'],
                'visible' => (Yii::$app->user->identity->u_type == 1)
            ],
            [
                'label' => 'Add Vendor',
                'icon' => 'vcard',
                'url' => ['/vendors'],
                'visible' => (Yii::$app->user->identity->u_type == 1)
            ],
            [
                'label' => 'Add Amazon Category',
                'icon' => 'amazon',
                'url' => ['/amazon-category'],
                'visible' => (Yii::$app->user->identity->u_type == 1)
            ],
            [
                'label' => 'Get No. of Product',
                'icon' => 'product-hunt',
                'url' => ['/site/get-product-no'],
                'visible' => (Yii::$app->user->identity->u_type == 1)
            ],
            [
                'label' => 'Deal Link Report',
                'icon' => 'flag',
                'url' => ['/report-link/index'],
                'visible' => (Yii::$app->user->identity->u_type == 1)
            ],*/
            [
                'label' => 'Setting',
                'icon' => 'cog',
                'url' => '#',
                'items' => [
                    /*[
                        'label' => 'Add List Group',
                        'icon' => 'list-alt',
                        'url' => ['/list-group'],
                        'visible' => (Yii::$app->user->identity->u_type == 1)
                    ],*/
                    /*[
                        'label' => 'Add List',
                        'icon' => 'list',
                        'url' => ['/user-data/import'],
                        'visible' => (Yii::$app->user->identity->u_type == 1)
                    ],*/
                ],
                'visible' => false //(Yii::$app->user->identity->u_type == 1)
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
