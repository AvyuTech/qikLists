<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaDiscountFileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$clearListData = $dataProvider->getModels();
$userDataListData = $dataProviderUd->getModels();
$todayDealData = $dataProviderTd->getModels();
$storeLinkData = $dataProviderL->getModels();
$website = $startPage = null;
?>
<table style="width: 100%" border="1">
    <tr>
        <th>Url</th>
        <th>Start Page</th>
        <th>Last Page</th>
        <th>Domain</th>
    </tr>
    <?php
        if ($dataProviderL->getCount() > 0) {
            foreach ($storeLinkData as $sl) {
                $todayDeal = \app\models\TodayDeals::findOne($sl->sl_today_deal_id);
                if($todayDeal) {
                    if($todayDeal->td_store_name) {
                        $websiteData = \app\models\Website::findOne(['w_id' => $todayDeal->td_store_name]);
                        $website = ($websiteData) ? $websiteData->w_name : null;
                        $startPage = ($websiteData) ? $websiteData->w_start_page : null;
                    }
                }
    ?>
        <tr>
            <td><?= ($sl->sl_link) ? $sl->sl_link : null; ?></td>
            <td><?= $startPage; ?></td>
            <td><?= ($sl->sl_last_page) ? $sl->sl_last_page : null; ?></td>
            <td><?= $website; ?></td>
        </tr>
    <?php }
        } ?>
    <?php
    if ($dataProvider->getCount() > 0) {
        foreach ($clearListData as $cl) {
            if($cl->ud_website) {
                $websiteData = \app\models\Website::findOne(['w_id' => $cl->ud_website]);
                $website = ($websiteData) ? $websiteData->w_name : null;
                $startPage = ($websiteData) ? $websiteData->w_start_page : null;
            }
    ?>
            <tr>
                <td><?= ($cl->ud_url) ? $cl->ud_url : null; ?></td>
                <td><?= $startPage; ?></td>
                <td><?= ($cl->ud_last_page) ? $cl->ud_last_page : null; ?></td>
                <td><?= $website; ?></td>
            </tr>
        <?php }
    } ?>
    <?php
    if ($dataProviderUd->getCount() > 0) {
        foreach ($userDataListData as $cl) {
            if($cl->ud_website) {
                $websiteData = \app\models\Website::findOne(['w_id' => $cl->ud_website]);
                $website = ($websiteData) ? $websiteData->w_name : null;
                $startPage = ($websiteData) ? $websiteData->w_start_page : null;
            }
            ?>
            <tr>
                <td><?= ($cl->ud_url) ? $cl->ud_url : null; ?></td>
                <td><?= $startPage; ?></td>
                <td><?= ($cl->ud_last_page) ? $cl->ud_last_page : null; ?></td>
                <td><?= $website; ?></td>
            </tr>
        <?php }
    } ?>
</table>
