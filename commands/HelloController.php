<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\components\GetApiData;
use app\components\SendMail;
use app\models\AdjustmentInventoryReport;
use app\models\AllOrdesList;
use app\models\AllProductDetails;
use app\models\AmazonSubCategory;
use app\models\AppliedRepriserRule;
use app\models\Asin;
use app\models\AsinChange;
use app\models\AsinChangeLog;
use app\models\CustomizedServicesUser;
use app\models\DataLastFetchDatetime;
use app\models\FbaAllListingData;
use app\models\FbaCustomerReturnData;
use app\models\FbaDailyInventoryData;
use app\models\FbaReceivedInventoryData;
use app\models\FbaRestockData;
use app\models\FbaSellerFeedbackReportData;
use app\models\FbaShipmentReportData;
use app\models\FbaStrandedInventoryReportData;
use app\models\FetchedReportData;
use app\models\ItemChargeListData;
use app\models\ItemFeeListData;
use app\models\NotificationSetting;
use app\models\OrderAdjustmentEventData;
use app\models\OrderAdjustmentItemListData;
use app\models\OrderDataLog;
use app\models\OrderItemsAsin;
use app\models\ReimbursementsReport;
use app\models\RequestedReport;
use app\models\ServiceFeeData;
use app\models\ShipmentRefundEventData;
use app\models\User;
use app\models\UserData;
use app\models\UserFetchedReportDataStatus;
use app\models\VaNotification;
use MCS\MWSClient;
use Stripe\Invoice;
use Stripe\Stripe;
use yii\console\Controller;
use yii\helpers\Json;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * Get all Active Listings
     */
    public function actionAllActiveListing($id=null)
    {
        $time = strtotime("-1 months", time());
        $startDate = date("Y-m-d", $time);
        $endDate = date('Y-m-d');

        try {
            $userData = User::find()->andFilterWhere(['u_id' => $id])->andWhere(['IS NOT', 'u_mws_seller_id', null])->all();

            foreach ($userData as $user) {
                \Yii::$app->data->getMwsDetails($user->u_mws_seller_id, $user->u_mws_auth_token);

                $rr = \Yii::$app->api->getActiveListingReportList(true);

                if ($rr) {
                    $rrData = \Yii::$app->api->getActiveListingReport($rr[0]['ReportId']);

                    $remove = "\n";
                    $split = explode($remove, $rrData['data']);
                    $array[] = null;
                    $tab = "\t";

                    foreach ($split as $string) {
                        $row = explode($tab, $string);
                        array_push($array, $row);
                    }
                    $array = array_filter($array);
                    unset($array[1]);

                    foreach ($array as $line) {
                        if (!array_filter($line))
                            continue;

                        if($line[28] != 'Active') {
                            continue;
                        }

                        $modelR = FbaAllListingData::find()->andWhere(['asin1' => $line[16]])->andWhere(['created_by' => $user->u_id])->one();
                        if (!$modelR) {
                            $modelR = new FbaAllListingData();
                        }
                        $modelR->item_name = utf8_encode($line[0]);
                        $modelR->item_description = (key_exists(1, $line)) ? $line[1] : null;
                        $modelR->listing_id = (key_exists(2, $line)) ? $line[2] : null;
                        $modelR->seller_sku = (key_exists(3, $line)) ? $line[3] : null;
                        $modelR->price = (key_exists(4, $line)) ? $line[4] : null;
                        $modelR->quantity = (key_exists(5, $line)) ? $line[5] : null;
                        $modelR->open_date = (key_exists(6, $line)) ? $line[6] : null;
                        $modelR->image_url = (key_exists(7, $line)) ? $line[7] : null;
                        $modelR->item_is_marketplace = (key_exists(8, $line)) ? $line[8] : null;
                        $modelR->product_id_type = (key_exists(9, $line)) ? $line[9] : null;
                        $modelR->zshop_shipping_fee = (key_exists(10, $line)) ? $line[10] : null;
                        $modelR->item_note = (key_exists(11, $line)) ? $line[11] : null;
                        $modelR->item_condition = (key_exists(12, $line)) ? $line[12] : null;
                        $modelR->zshop_category1 = (key_exists(13, $line)) ? $line[13] : null;
                        $modelR->zshop_browse_path = (key_exists(14, $line)) ? $line[14] : null;
                        $modelR->zshop_storefront_feature = (key_exists(15, $line)) ? $line[15] : null;
                        $modelR->asin1 = (key_exists(16, $line)) ? $line[16] : null;
                        $modelR->asin2 = (key_exists(17, $line)) ? $line[17] : null;
                        $modelR->asin3 = (key_exists(18, $line)) ? $line[18] : null;
                        $modelR->will_ship_internationally = (key_exists(19, $line)) ? $line[19] : null;
                        $modelR->expedited_shipping = (key_exists(20, $line)) ? $line[20] : null;
                        $modelR->zshop_boldface = (key_exists(21, $line)) ? $line[21] : null;
                        $modelR->product_id = (key_exists(22, $line)) ? $line[22] : null;
                        $modelR->bid_for_featured_placement = (key_exists(23, $line)) ? $line[23] : null;
                        $modelR->add_delete = (key_exists(24, $line)) ? $line[24] : null;
                        $modelR->pending_quantity = (key_exists(25, $line)) ? $line[25] : null;
                        $modelR->fulfillment_channel = (key_exists(26, $line)) ? $line[26] : null;
                        $modelR->merchant_shipping_group = (key_exists(27, $line)) ? $line[27] : null;
                        $modelR->status = (key_exists(28, $line)) ? $line[28] : null;
                        $modelR->fald_date = date('Y-m-d');
                        $modelR->created_by = $user->u_id;

                        $fbaCommFees = $fbaFees = null;
                        $fees = \Yii::$app->api->mwsFeesEstimate($modelR->asin1, $modelR->price, 'USD', 'ASIN');
                        if ($fees) {
                            $fbaCommFees = $fees['ReferralFee'];
                            $fbaFees = $fees['TotalFeesEstimate'];
                        }

                        $modelR->commission_fees = $fbaCommFees;
                        $modelR->fba_fees = $fbaFees;

                        $productDetails = \Yii::$app->api->getProductDimensions($modelR->asin1, true);
                        if ($productDetails) {
                            $modelR->image_url = (key_exists('SmallImage', $productDetails)) ? str_replace('._SL75_', '', $productDetails['SmallImage']['URL']) : null;
                            sleep(1);
                            $productDetails = \Yii::$app->api->getProductCompetitivePrice($modelR->seller_sku);
                            if ($productDetails) {
                                $modelR->buybox_price = $productDetails;
                            }
                        }

                        if ($modelR->save(false)) {
                            echo "Listing Report Saved. ";
                        }
                        sleep(2);
                    }
                } else {
                    echo "Report Not Generated";
                }

                if($id) {
                    $user->asin_change_cron_status = 1;
                    $user->save(false);
                }
                //exit();
            }

            echo "Done!";
            if($id) {
                $this->getDailyOrdersData($id);

                $userOrderData = AllOrdesList::find()->asArray()->all();
                foreach ($userOrderData as $uo) {
                    $this->getOrderShipmentData($uo['aol_amazon_order_id'], $id);

                    $this->getOrderRefundData($uo['aol_amazon_order_id'], $id);

                    $this->getOrderServiceFeeData($uo['aol_amazon_order_id'], $id);

                    $this->getOrderAdjustmentData($uo['aol_amazon_order_id'], $id);

                    $this->getOrderAsinData($uo['aol_amazon_order_id'], $id);
                }

                $this->getDailyInventory($id);
                $this->getReceivedInventoryData($id);
				$uData = User::findOne($id);
                if($uData) {
                    $uData->order_cron_status = 1;
                    $uData->save(false);
                }
				$token = ($uData && $uData->device_token) ? $uData->device_token : null;
                $title = 'Congratulations! Your Amazon listing and order data are configured';
                $body = 'Your amazon listing and order data configured in your account. Now you can access your data from Price Genius.';
				if($token) {
					\Yii::$app->data->sendPushNotification($token, $title, $body);
				}
            }
        } catch (\Exception $e) {
            // Something else happened, completely unrelated to Stripe
            echo "Something went wrong. ".$e->getMessage();
        }
    }

    /**
     * Not in Use
     */
    public function actionAllActiveListingOld()
    {
        $time = strtotime("-1 months", time());
        $startDate = date("Y-m-d", $time);
        $endDate = date('Y-m-d');

        $checkData = RequestedReport::find()->andWhere(['rr_report_type' => '_GET_MERCHANT_LISTINGS_ALL_DATA_'])->orderBy(['rr_id' => SORT_DESC])->one();

        if ($checkData) {
            try {
                $rru = \Yii::$app->api->getRequestedReports($checkData->rr_report_request_id);
                if ($rru) {
                    $rrUModel = RequestedReport::findOne($checkData->rr_id);
                    $rrUModel->rr_report_id = ($rru['reportId']) ? $rru['reportId'] : null;
                    $rrUModel->rr_report_current_status = ($rru['reportStatus']) ? $rru['reportStatus'] : null;
                    $rrUModel->rr_report_processing_status = $rru['reportStatus'];
                    if ($rrUModel->save(false)) {
                        sleep(4);
                        if ($rrUModel->rr_report_id) {
                            $rrData = \Yii::$app->api->getAllListingReport($rrUModel->rr_report_id);
                            $remove = "\n";
                            $split = explode($remove, $rrData['data']);
                            $array[] = null;
                            $tab = "\t";

                            foreach ($split as $string) {
                                $row = explode($tab, $string);
                                array_push($array, $row);
                            }
                            $array = array_filter($array);
                            unset($array[1]);

                            foreach ($array as $line) {
                                if (!array_filter($line))
                                    continue;

                                $checkAsin = FbaAllListingData::find()->andWhere(['asin1' => $line[16]])->exists();
                                if ($checkAsin) {
                                    continue;
                                }

                                $modelR = new FbaAllListingData();
                                $modelR->item_name = utf8_encode($line[0]);
                                $modelR->item_description = (key_exists(1, $line)) ? $line[1] : null;
                                $modelR->listing_id = (key_exists(2, $line)) ? $line[2] : null;
                                $modelR->seller_sku = (key_exists(3, $line)) ? $line[3] : null;
                                $modelR->price = (key_exists(4, $line)) ? $line[4] : null;
                                $modelR->quantity = (key_exists(5, $line)) ? $line[5] : null;
                                $modelR->open_date = (key_exists(6, $line)) ? $line[6] : null;
                                $modelR->image_url = (key_exists(7, $line)) ? $line[7] : null;
                                $modelR->item_is_marketplace = (key_exists(8, $line)) ? $line[8] : null;
                                $modelR->product_id_type = (key_exists(9, $line)) ? $line[9] : null;
                                $modelR->zshop_shipping_fee = (key_exists(10, $line)) ? $line[10] : null;
                                $modelR->item_note = (key_exists(11, $line)) ? $line[11] : null;
                                $modelR->item_condition = (key_exists(12, $line)) ? $line[12] : null;
                                $modelR->zshop_category1 = (key_exists(13, $line)) ? $line[13] : null;
                                $modelR->zshop_browse_path = (key_exists(14, $line)) ? $line[14] : null;
                                $modelR->zshop_storefront_feature = (key_exists(15, $line)) ? $line[15] : null;
                                $modelR->asin1 = (key_exists(16, $line)) ? $line[16] : null;
                                $modelR->asin2 = (key_exists(17, $line)) ? $line[17] : null;
                                $modelR->asin3 = (key_exists(18, $line)) ? $line[18] : null;
                                $modelR->will_ship_internationally = (key_exists(19, $line)) ? $line[19] : null;
                                $modelR->expedited_shipping = (key_exists(20, $line)) ? $line[20] : null;
                                $modelR->zshop_boldface = (key_exists(21, $line)) ? $line[21] : null;
                                $modelR->product_id = (key_exists(22, $line)) ? $line[22] : null;
                                $modelR->bid_for_featured_placement = (key_exists(23, $line)) ? $line[23] : null;
                                $modelR->add_delete = (key_exists(24, $line)) ? $line[24] : null;
                                $modelR->pending_quantity = (key_exists(25, $line)) ? $line[25] : null;
                                $modelR->fulfillment_channel = (key_exists(26, $line)) ? $line[26] : null;
                                $modelR->merchant_shipping_group = (key_exists(27, $line)) ? $line[27] : null;
                                $modelR->status = (key_exists(28, $line)) ? $line[28] : null;
                                $modelR->fald_date = date('Y-m-d');

                                $fees = \Yii::$app->api->mwsFeesEstimate($modelR->asin1, $modelR->price);
                                $fbaCommFees = $fbaFees = null;
                                if ($fees) {
                                    $fbaCommFees = $fees['ReferralFee'];
                                    $fbaFees = ($fees['VariableClosingFee'] + $fees['PerItemFee'] + $fees['FBAWeightHandling'] + $fees['FBAOrderHandling'] + $fees['FBAPickAndPack']);
                                }

                                $modelR->commission_fees = $fbaCommFees;
                                $modelR->fba_fees = $fbaFees;
                                if ($modelR->save(false)) {
                                    echo "All Listing Report Saved. ";
                                }
                                sleep(1);
                            }
                        } else {
                            echo "Report Not Generated";
                        }
                    }
                }
            } catch (\Exception $e) {
                // Something else happened, completely unrelated to Stripe
                echo "Something went wrong.";
            }
        } else {
            $rr = \Yii::$app->api->requestReport('_GET_MERCHANT_LISTINGS_ALL_DATA_', $startDate, $endDate);

            if ($rr) {
                $rrModel = new RequestedReport();
                $rrModel->rr_report_request_id = $rr['ReportRequestId'];
                $rrModel->rr_report_type = $rr['ReportType'];
                $rrModel->rr_start_date = $rr['StartDate'];
                $rrModel->rr_end_date = $rr['EndDate'];
                $rrModel->rr_scheduled = $rr['Scheduled'];
                $rrModel->rr_submitted_date = $rr['SubmittedDate'];
                $rrModel->rr_report_processing_status = $rr['ReportProcessingStatus'];
                if ($rrModel->save(false)) {
                    sleep(30);
                    try {
                        $rru = \Yii::$app->api->getRequestedReports($rrModel->rr_report_request_id);
                        if ($rru) {
                            $rrUModel = RequestedReport::findOne($rrModel->rr_id);
                            $rrUModel->rr_report_id = ($rru['reportId']) ? $rru['reportId'] : null;
                            $rrUModel->rr_report_current_status = ($rru['reportStatus']) ? $rru['reportStatus'] : null;
                            $rrUModel->rr_report_processing_status = $rru['reportStatus'];
                            if ($rrUModel->save(false)) {
                                sleep(4);
                                if ($rrUModel->rr_report_id) {
                                    $rrData = \Yii::$app->api->getAllListingReport($rrUModel->rr_report_id);
                                    $remove = "\n";
                                    $split = explode($remove, $rrData['data']);
                                    $array[] = null;
                                    $tab = "\t";

                                    foreach ($split as $string) {
                                        $row = explode($tab, $string);
                                        array_push($array, $row);
                                    }
                                    $array = array_filter($array);
                                    unset($array[1]);

                                    foreach ($array as $line) {
                                        if (!array_filter($line))
                                            continue;

                                        $checkAsin = FbaAllListingData::find()->andWhere(['asin1' => $line[16]])->exists();
                                        if ($checkAsin) {
                                            continue;
                                        }
                                        $modelR = new FbaAllListingData();
                                        $modelR->item_name = utf8_encode($line[0]);
                                        $modelR->item_description = (key_exists(1, $line)) ? $line[1] : null;
                                        $modelR->listing_id = (key_exists(2, $line)) ? $line[2] : null;
                                        $modelR->seller_sku = (key_exists(3, $line)) ? $line[3] : null;
                                        $modelR->price = (key_exists(4, $line)) ? $line[4] : null;
                                        $modelR->quantity = (key_exists(5, $line)) ? $line[5] : null;
                                        $modelR->open_date = (key_exists(6, $line)) ? $line[6] : null;
                                        $modelR->image_url = (key_exists(7, $line)) ? $line[7] : null;
                                        $modelR->item_is_marketplace = (key_exists(8, $line)) ? $line[8] : null;
                                        $modelR->product_id_type = (key_exists(9, $line)) ? $line[9] : null;
                                        $modelR->zshop_shipping_fee = (key_exists(10, $line)) ? $line[10] : null;
                                        $modelR->item_note = (key_exists(11, $line)) ? $line[11] : null;
                                        $modelR->item_condition = (key_exists(12, $line)) ? $line[12] : null;
                                        $modelR->zshop_category1 = (key_exists(13, $line)) ? $line[13] : null;
                                        $modelR->zshop_browse_path = (key_exists(14, $line)) ? $line[14] : null;
                                        $modelR->zshop_storefront_feature = (key_exists(15, $line)) ? $line[15] : null;
                                        $modelR->asin1 = (key_exists(16, $line)) ? $line[16] : null;
                                        $modelR->asin2 = (key_exists(17, $line)) ? $line[17] : null;
                                        $modelR->asin3 = (key_exists(18, $line)) ? $line[18] : null;
                                        $modelR->will_ship_internationally = (key_exists(19, $line)) ? $line[19] : null;
                                        $modelR->expedited_shipping = (key_exists(20, $line)) ? $line[20] : null;
                                        $modelR->zshop_boldface = (key_exists(21, $line)) ? $line[21] : null;
                                        $modelR->product_id = (key_exists(22, $line)) ? $line[22] : null;
                                        $modelR->bid_for_featured_placement = (key_exists(23, $line)) ? $line[23] : null;
                                        $modelR->add_delete = (key_exists(24, $line)) ? $line[24] : null;
                                        $modelR->pending_quantity = (key_exists(25, $line)) ? $line[25] : null;
                                        $modelR->fulfillment_channel = (key_exists(26, $line)) ? $line[26] : null;
                                        $modelR->merchant_shipping_group = (key_exists(27, $line)) ? $line[27] : null;
                                        $modelR->status = (key_exists(28, $line)) ? $line[28] : null;
                                        $modelR->fald_date = date('Y-m-d');

                                        $fees = \Yii::$app->api->mwsFeesEstimate($modelR->asin1, $modelR->price);
                                        $fbaCommFees = $fbaFees = null;
                                        if ($fees) {
                                            $fbaCommFees = $fees['ReferralFee'];
                                            $fbaFees = ($fees['VariableClosingFee'] + $fees['PerItemFee'] + $fees['FBAWeightHandling'] + $fees['FBAOrderHandling'] + $fees['FBAPickAndPack']);
                                        }

                                        $modelR->commission_fees = $fbaCommFees;
                                        $modelR->fba_fees = $fbaFees;
                                        if ($modelR->save(false)) {
                                            echo "All Listing Report Saved. ";
                                        }
                                        sleep(1);
                                    }
                                } else {
                                    echo "Report Not Generated";
                                }
                            }
                        }
                    } catch (\Exception $e) {
                        // Something else happened, completely unrelated to Stripe
                        echo "Something went wrong.";
                    }
                }
            }
        }
    }

    /**
     * Get Daily Order
     */
    public function actionGetDailyOrders($id=null)
    {
        $startDate = date("Y-m-d H:i:s", strtotime('-1 month', time()));
        $endDate = date('Y-m-d H:i:s');

        $userData = User::find()->andFilterWhere(['u_id' => $id])->andWhere(['IS NOT', 'u_mws_seller_id', null])->all();

        foreach ($userData as $user) {
            \Yii::$app->data->getMwsDetails($user->u_mws_seller_id, $user->u_mws_auth_token);

            $orderList = \Yii::$app->api->getOrdersList('Created', $startDate, $endDate);
            foreach ($orderList as $order) {
                $order = (array)$order;
                $order = array_shift($order);
                if ($order) {

                    $model = AllOrdesList::findOne(['aol_amazon_order_id' => $order['AmazonOrderId'], 'aol_user_id' => $user->u_id]);
                    if (!$model) {
                        $model = new AllOrdesList();
                    }
                    $model->aol_amazon_order_id = (key_exists('AmazonOrderId', $order)) ? $order['AmazonOrderId'] : null;
                    $model->aol_seller_order_id = (key_exists('SellerOrderId', $order)) ? $order['SellerOrderId'] : null;
                    $model->aol_purchase_date = (key_exists('PurchaseDate', $order)) ? $order['PurchaseDate'] : null;
                    $model->aol_last_updated_date = (key_exists('LastUpdateDate', $order)) ? $order['LastUpdateDate'] : null;
                    $model->aol_order_status = (key_exists('OrderStatus', $order)) ? $order['OrderStatus'] : null;
                    $model->aol_fulfilment_channel = (key_exists('FulfillmentChannel', $order)) ? $order['FulfillmentChannel'] : null;
                    $model->aol_sales_channel = (key_exists('SalesChannel', $order)) ? $order['SalesChannel'] : null;
                    $model->aol_ship_service = (key_exists('ShipServiceLevel', $order)) ? $order['ShipServiceLevel'] : null;
                    $model->aol_order_total = (key_exists('OrderTotal', $order)) ? $order['OrderTotal']['Amount'] : 0;
                    $model->aol_shipped_items = (key_exists('NumberOfItemsShipped', $order)) ? $order['NumberOfItemsShipped'] : null;
                    $model->aol_unshipped_items = (key_exists('NumberOfItemsUnshipped', $order)) ? $order['NumberOfItemsUnshipped'] : null;
                    $model->aol_user_id = $user->u_id;
                    if($model->save(false)) {
                        echo $model->aol_amazon_order_id." is Saved. ";
                    }



                    $model = AllOrdesList::findOne($model->aol_amazon_order_id);
                    //foreach ($orderList as $model) {
                    sleep(2);
                    /**
                     * Get Finance Event Data
                     */
                    $financeEventData = \Yii::$app->api->getFinanceEventList($model->aol_amazon_order_id);
                    $amazonOrderId = $sellerOrderId = $shipmentRefundId = null;

                    if ($financeEventData) {
                        // print_r($financeEventData); exit();
                        /**
                         * Store Shipment Event Data 111-8188019-0760241
                         */
                        if ($shipmentData = $financeEventData['shipmentEventData']) {
                            foreach ($shipmentData as $sVal) {
                                $modelSR = new ShipmentRefundEventData();
                                $modelSR->sred_amazon_order_id = $amazonOrderId = $sVal['AmazonOrderId'];
                                $modelSR->sred_seller_order_id = $sellerOrderId = $sVal['SellerOrderId'];
                                $modelSR->sred_marketplace_name = $sVal['MarketplaceName'];
                                $modelSR->sred_shipment_posted_date = $sVal['PostedDate'];
                                $modelSR->sred_event_type = 'Order';

                                if ($modelSR->save(false)) {
                                    $shipmentRefundId = $modelSR->sred_id;
                                    if (key_exists('ShipmentItemList', $sVal) && is_array($sVal['ShipmentItemList']) && $shipmentItemData = $sVal['ShipmentItemList']) {
                                        foreach ($shipmentItemData as $sItem) {
                                            $sellerSku = $sItem['SellerSKU'];
                                            $orderItemId = $sItem['OrderItemId'];
                                            $shippedQuantity = $sItem['QuantityShipped'];

                                            if (key_exists('ItemChargeList', $sItem) && is_array($sItem['ItemChargeList']) && $itemChargeData = $sItem['ItemChargeList']) {
                                                foreach ($itemChargeData as $iData) {
                                                    $itemModel = new ItemChargeListData();
                                                    $itemModel->icld_quantity_shipped = $shippedQuantity;
                                                    $itemModel->icld_seller_sku = $sellerSku;
                                                    $itemModel->icld_order_item_id = $orderItemId;
                                                    $itemModel->icld_amazon_order_id = $modelSR->sred_amazon_order_id;
                                                    $itemModel->icld_seller_order_id = $modelSR->sred_seller_order_id;
                                                    $itemModel->icld_item_charge_type = $iData['ChargeType'];
                                                    $itemModel->icld_charge_amount = $iData['Amount'];
                                                    $itemModel->icld_currency = $iData['CurrencyCode'];
                                                    $itemModel->icld_transaction_type = 'Order';
                                                    $itemModel->icld_item_type = 'Shipment';
                                                    $itemModel->icld_shipment_refund_event_data_id = $modelSR->sred_id;
                                                    if ($itemModel->save(false)) {
                                                        echo "Item Charge Saved.";
                                                    }
                                                } //$itemChargeData
                                            }

                                            if (key_exists('ItemFeeList', $sItem) && is_array($sItem['ItemFeeList']) && $itemFeeChargeData = $sItem['ItemFeeList']) {
                                                foreach ($itemFeeChargeData as $ifData) {
                                                    $feeModel = new ItemFeeListData();
                                                    $feeModel->ifld_quantity_shipped = $shippedQuantity;
                                                    $feeModel->ifld_seller_sku = $sellerSku;
                                                    $feeModel->ifld_order_item_id = $orderItemId;
                                                    $feeModel->ifld_amazon_order_id = $modelSR->sred_amazon_order_id;
                                                    $feeModel->ifld_seller_order_id = $modelSR->sred_seller_order_id;
                                                    $feeModel->ifld_fee_type = $ifData['FeeType'];
                                                    $feeModel->ifld_fee_amount = $ifData['Amount'];
                                                    $feeModel->ifld_currency = $ifData['CurrencyCode'];
                                                    $feeModel->ifld_transaction_type = 'Order';
                                                    $feeModel->ifld_item_type = 'Shipment';
                                                    $feeModel->ifld_shipment_refund_event_id = $modelSR->sred_id;
                                                    if ($feeModel->save(false)) {
                                                        echo "Item Fee Saved.";
                                                    }
                                                } // $itemFeeChargeData
                                            }
                                        } // $shipmentItemData
                                    }
                                }
                            } //$shipmentData
                        } // if : $shipmentData

                        /**
                         * Store Refund Event Data
                         */
                        if ($refundData = $financeEventData['refundEventData']) {
                            foreach ($refundData as $rValue) {
                                $modelSR = new ShipmentRefundEventData();
                                $modelSR->sred_amazon_order_id = $rValue['AmazonOrderId'];
                                $modelSR->sred_seller_order_id = $rValue['SellerOrderId'];
                                $modelSR->sred_marketplace_name = $rValue['MarketplaceName'];
                                $modelSR->sred_refund_posted_date = $rValue['PostedDate'];
                                $modelSR->sred_event_type = 'Refund';

                                if ($model->save(false)) {
                                    /*$vnModel = new VaNotification();
                                    $vnModel->vn_amazon_order_id = $modelSR->sred_amazon_order_id;
                                    $vnModel->vn_refund_posted_date = $modelSR->sred_refund_posted_date;
                                    $vnModel->vn_shipment_refund_event_data_id = $modelSR->sred_id;
                                    $vnModel->save(false);*/

                                    if (key_exists('ShipmentItemAdjustmentList', $rValue) && is_array($rValue['ShipmentItemAdjustmentList']) && $shipmentItemData = $rValue['ShipmentItemAdjustmentList']) {
                                        foreach ($shipmentItemData as $sItem) {
                                            $sellerSku = $sItem['SellerSKU'];
                                            $orderItemId = (key_exists('OrderAdjustmentItemId', $sItem)) ? $sItem['OrderAdjustmentItemId'] : null;
                                            $shippedQuantity = (key_exists('QuantityShipped', $sItem)) ? $sItem['QuantityShipped'] : null;

                                            if (key_exists('ItemChargeAdjustmentList', $sItem) && is_array($sItem['ItemChargeAdjustmentList']) && $itemChargeData = $sItem['ItemChargeAdjustmentList']) {
                                                foreach ($itemChargeData as $iData) {
                                                    $itemModel = new ItemChargeListData();
                                                    $itemModel->icld_quantity_shipped = $shippedQuantity;
                                                    $itemModel->icld_seller_sku = $sellerSku;
                                                    $itemModel->icld_order_adjustment_item_id = $orderItemId;
                                                    $itemModel->icld_amazon_order_id = $modelSR->sred_amazon_order_id;
                                                    $itemModel->icld_seller_order_id = $modelSR->sred_seller_order_id;
                                                    $itemModel->icld_item_charge_type = $iData['ChargeType'];
                                                    $itemModel->icld_charge_amount = $iData['Amount'];
                                                    $itemModel->icld_currency = $iData['CurrencyCode'];
                                                    $itemModel->icld_transaction_type = 'Refund';
                                                    $itemModel->icld_item_type = 'Refund';
                                                    $itemModel->icld_shipment_refund_event_data_id = $modelSR->sred_id;
                                                    if ($itemModel->save(false)) {
                                                        echo "Refund Item Charge Saved.";
                                                    }
                                                } //$itemChargeData
                                            }

                                            if (key_exists('ItemFeeAdjustmentList', $sItem) && is_array($sItem['ItemFeeAdjustmentList']) && $itemFeeChargeData = $sItem['ItemFeeAdjustmentList']) {
                                                foreach ($itemFeeChargeData as $ifData) {
                                                    $feeModel = new ItemFeeListData();
                                                    $feeModel->ifld_quantity_shipped = $shippedQuantity;
                                                    $feeModel->ifld_seller_sku = $sellerSku;
                                                    $feeModel->ifld_order_adjustment_item_id = $orderItemId;
                                                    $feeModel->ifld_amazon_order_id = $modelSR->sred_amazon_order_id;
                                                    $feeModel->ifld_seller_order_id = $modelSR->sred_seller_order_id;
                                                    $feeModel->ifld_fee_type = $ifData['FeeType'];
                                                    $feeModel->ifld_fee_amount = $ifData['Amount'];
                                                    $feeModel->ifld_currency = $ifData['CurrencyCode'];
                                                    $feeModel->ifld_transaction_type = 'Refund';
                                                    $feeModel->ifld_item_type = 'Refund';
                                                    $feeModel->ifld_shipment_refund_event_id = $modelSR->sred_id;
                                                    if ($feeModel->save(false)) {
                                                        echo "Refund Item Fee Saved.";
                                                    }
                                                } // $itemFeeChargeData
                                            }
                                        } // $shipmentItemData
                                    }
                                }
                            }
                        } // if : Refund Event

                        /*
                         * Store Service Fee Event Data
                         */
                        if ($serviceFeeEventData = $financeEventData['serviceFeeEventData']) {
                            foreach ($serviceFeeEventData as $rValue) {
                                $aOrderId = $rValue['AmazonOrderId'];
                                $feeReason = $rValue['FeeReason'];
                                $sellerSku = $rValue['SellerSKU'];
                                $fnSku = $rValue['FnSKU'];
                                $feeDesc = $rValue['FeeDescription'];
                                $asin = $rValue['ASIN'];

                                if (key_exists('FeeList', $rValue) && is_array($rValue['FeeList']) && $itemChargeData = $rValue['FeeList']) {
                                    foreach ($itemChargeData as $iData) {
                                        $sModel = new ServiceFeeData();
                                        $sModel->sfd_amazon_order_id = $aOrderId;
                                        $sModel->sfd_seller_order_id = $sellerOrderId;
                                        $sModel->sfd_fee_reason = $feeReason;
                                        $sModel->sfd_seller_sku = $sellerSku;
                                        $sModel->sfd_fnsku = $fnSku;
                                        $sModel->sfd_fee_description = $feeDesc;
                                        $sModel->sfd_asin = $asin;
                                        $sModel->sfd_fee_type = $iData['FeeType'];
                                        $sModel->sfd_fee_amount = $iData['Amount'];
                                        $sModel->sfd_currency = $iData['CurrencyCode'];
                                        $sModel->sfd_shipment_refund_event_data_id = $shipmentRefundId;
                                        if ($sModel->save(false)) {
                                            echo "Service Fee Data Saved.";
                                        }
                                    }
                                }
                            }
                        } // if : service Fee Event

                        /**
                         * Adjustment Event Data
                         */
                        if ($adjustmentEventData = $financeEventData['adjustmentEventData']) {
                            foreach ($adjustmentEventData as $raValue) {
                                $adModel = new OrderAdjustmentEventData();
                                $adModel->oaed_amazon_order_id = $amazonOrderId;
                                $adModel->oaed_seller_order_id = $sellerOrderId;
                                $adModel->oaed_adjustment_type = $raValue['AdjustmentType'];
                                $adModel->oaed_amount = $raValue['Amount'];
                                $adModel->oaed_currency = $raValue['CurrencyCode'];

                                if ($adModel->save(false)) {
                                    if (key_exists('AdjustmentItemList', $raValue) && is_array($raValue['AdjustmentItemList']) && $AdjustmentItemList = $raValue['AdjustmentItemList']) {
                                        foreach ($AdjustmentItemList as $siItem) {
                                            $adIModel = new OrderAdjustmentItemListData();
                                            $adIModel->oaild_amazon_order_id = $amazonOrderId;
                                            $adIModel->oaild_seller_order_id = $sellerOrderId;
                                            $adIModel->oaild_quantity = $siItem['Quantity'];
                                            $adIModel->oaild_per_unit_amount = $siItem['PerUnitAmount']['Amount'];
                                            $adIModel->oaild_total_amount = $siItem['TotalAmount']['Amount'];
                                            $adIModel->oaild_currency = $siItem['TotalAmount']['CurrencyCode'];
                                            $adIModel->oaild_seller_sku = $siItem['SellerSKU'];
                                            $adIModel->oaild_fnsku = $siItem['FnSKU'];
                                            $adIModel->oaild_product_description = $siItem['ProductDescription'];
                                            $adIModel->oaild_asin = $siItem['ASIN'];
                                            $adIModel->order_adjustment_event_data_id = $adModel->oaed_id;
                                            $adIModel->oaild_shipment_refund_event_data_id = $shipmentRefundId;
                                            if ($adIModel->save(false)) {
                                                echo "Adjustment Item Data Saved.";
                                            }
                                        }
                                    }
                                }
                            }
                        } // if : adjustment Event Data

                    } // main if : $financeEventData

                    //$model = AllOrdesList::findOne(['aol_amazon_order_id' => $model->aol_amazon_order_id]);
                    $model->aol_status = 1; // Finance Event Data Pulled.
                    if ($model->save(false)) {
                        echo "Finance Event Data of Order No: " . $model->aol_amazon_order_id . " is Saved.";
                    }
                    sleep(3);

                    /**
                     * Get Shipped Order Details
                     */
                    //$model = AllOrdesList::findOne(['aol_amazon_order_id' => $model->aol_amazon_order_id]);
                    if ($model->aol_order_status == 'Shipped') {
                        $orderDetails = \Yii::$app->api->getOrderDetails($model->aol_amazon_order_id);
                        $orderItemAsin = \Yii::$app->api->getOrderItems($model->aol_amazon_order_id);
                        if ($orderDetails) {
                            $model->aol_shipping_username = key_exists('Name', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['Name'] : null;
                            $model->aol_shipping_address_1 = key_exists('AddressLine1', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['AddressLine1'] : null;
                            $model->aol_shipping_address_2 = key_exists('AddressLine2', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['AddressLine2'] : null;
                            $model->aol_shipping_address_3 = key_exists('AddressLine3', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['AddressLine3'] : null;
                            $model->aol_city = key_exists('City', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['City'] : null;
                            $model->aol_country = key_exists('County', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['County'] : null;
                            $model->aol_district = key_exists('District', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['District'] : null;
                            $model->aol_state_or_region = key_exists('StateOrRegion', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['StateOrRegion'] : null;
                            $model->aol_postal_code = key_exists('PostalCode', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['PostalCode'] : null;
                            $model->aol_country_code = key_exists('CountryCode', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['CountryCode'] : null;
                            $model->aol_phone = key_exists('Phone', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['Phone'] : null;
                            $model->aol_buyer_name = key_exists('BuyerName', $orderDetails) ? $orderDetails['BuyerName'] : null;
                            $model->aol_buyer_email = key_exists('BuyerEmail', $orderDetails) ? $orderDetails['BuyerEmail'] : null;
                            $model->aol_asin = $orderItemAsin;
                            $model->aol_shipped_status = 1; //Order Details Pulled
                            if ($model->save(false))
                                echo $model->aol_amazon_order_id . " Details Saved.";
                        }
                        sleep(3);

                        /**
                         * Get All ASIN for Order
                         */
                        $orderItemAsinData = \Yii::$app->api->getOrderItems($model->aol_amazon_order_id, true);
                        if ($orderItemAsinData) {
                            foreach ($orderItemAsinData as $asinData) {
                                $modelOI = OrderItemsAsin::findOne(['oia_order_id' => $model->aol_amazon_order_id]);
                                if (!$modelOI) {
                                    $modelOI = new OrderItemsAsin();
                                }
                                $modelOI->oia_order_id = $model->aol_amazon_order_id;
                                $modelOI->oia_asin = $asinData['ASIN'];
                                $catData = ($modelOI->oia_asin) ? \Yii::$app->api->getProductCategory($modelOI->oia_asin) : null;
                                if ($catData) {
                                    $modelP = FbaAllListingData::findOne(['asin1' => $modelOI->oia_asin]);
                                    $sPrice = ($modelP) ? $modelP->price : 0;
                                    $fees = GetApiData::mwsFeesEstimate($modelOI->oia_asin, $sPrice);
                                    $referralFee = ($fees) ? $fees['ReferralFee'] : 0;

                                    $modelOI->oia_referral_fee = $referralFee;
                                    $modelOI->oia_category = $catData;
                                    $modelOI->oia_purchase_date = $model->aol_purchase_date;

                                    $productDimensionData = \Yii::$app->api->getProductDimensions($modelOI->oia_asin);
                                    if ($productDimensionData) {
                                        $modelOI->oia_item_height = $productDimensionData['ItemHeight'];
                                        $modelOI->oia_item_length = $productDimensionData['ItemLength'];
                                        $modelOI->oia_item_weight = $productDimensionData['ItemWeight'];
                                        $modelOI->oia_item_width = $productDimensionData['ItemWidth'];
                                        $modelOI->oia_package_height = $productDimensionData['PackageHeight'];
                                        $modelOI->oia_package_length = $productDimensionData['PackageLength'];
                                        $modelOI->oia_package_weight = $productDimensionData['PackageWeight'];
                                        $modelOI->oia_package_width = $productDimensionData['PackageWidth'];
                                    }
                                }
                                if ($modelOI->save(false)) {
                                    echo "ASIN Saved.";
                                }
                                sleep(3);
                            }
                        }
                    }
                }
            }

            if($id) {
                $user->order_cron_status = 1;
                $user->save(false);
            }
        }
        echo "Done...";
        // Save last call time
        //$lastOrderFetch->dlfd_last_orders_time = $endDate;
        //$lastOrderFetch->save(false);

    }

    /***
     * Get Order data (Method) New
     * @param null $id
     */
    public function getDailyOrdersData($id=null)
    {
        $startDate = date("Y-m-d H:i:s", strtotime('-7 day', time()));
        $endDate = date('Y-m-d H:i:s');

        $userData = User::find()->andFilterWhere(['u_id' => $id, 'u_type' => 2])->andWhere(['IS NOT', 'u_mws_seller_id', null])->all();

        foreach ($userData as $user) {
            \Yii::$app->data->getMwsDetails($user->u_mws_seller_id, $user->u_mws_auth_token);
            $orderList = \Yii::$app->api->getOrdersList('Created', $startDate, $endDate);
            foreach ($orderList as $order) {
                $orderDetail = false;
                $order = (array)$order;
                $order = array_shift($order);
                if($order) {
                    $model = AllOrdesList::findOne(['aol_amazon_order_id' => $order['AmazonOrderId'], 'aol_user_id' => $user->u_id]);
                    if (!$model) {
                        $model = new AllOrdesList();
                    }
                    $model->aol_amazon_order_id = (key_exists('AmazonOrderId', $order)) ? $order['AmazonOrderId'] : null;
                    $model->aol_seller_order_id = (key_exists('SellerOrderId', $order)) ? $order['SellerOrderId'] : null;
                    $model->aol_purchase_date = (key_exists('PurchaseDate', $order)) ? $order['PurchaseDate'] : null;
                    $model->aol_last_updated_date = (key_exists('LastUpdateDate', $order)) ? $order['LastUpdateDate'] : null;
                    $model->aol_order_status = (key_exists('OrderStatus', $order)) ? $order['OrderStatus'] : null;
                    $model->aol_fulfilment_channel = (key_exists('FulfillmentChannel', $order)) ? $order['FulfillmentChannel'] : null;
                    $model->aol_sales_channel = (key_exists('SalesChannel', $order)) ? $order['SalesChannel'] : null;
                    $model->aol_ship_service = (key_exists('ShipServiceLevel', $order)) ? $order['ShipServiceLevel'] : null;
                    $model->aol_order_total = (key_exists('OrderTotal', $order)) ? $order['OrderTotal']['Amount'] : 0;
                    $model->aol_shipped_items = (key_exists('NumberOfItemsShipped', $order)) ? $order['NumberOfItemsShipped'] : null;
                    $model->aol_unshipped_items = (key_exists('NumberOfItemsUnshipped', $order)) ? $order['NumberOfItemsUnshipped'] : null;
                    if($model->aol_order_status == 'Shipped') {
                        $model->aol_shipping_username = (key_exists('ShippingAddress', $order)) ? $order['ShippingAddress']['Name'] : null;
                        $model->aol_shipping_address_1 = (key_exists('ShippingAddress', $order)) ? $order['ShippingAddress']['AddressLine1'] : null;
                        $model->aol_shipping_address_2 = (key_exists('ShippingAddress', $order)) ? $order['ShippingAddress']['AddressLine2'] : null;
                        $model->aol_shipping_address_3 = (key_exists('ShippingAddress', $order)) ? $order['ShippingAddress']['AddressLine3'] : null;
                        $model->aol_city = (key_exists('ShippingAddress', $order)) ? $order['ShippingAddress']['City'] : null;
                        $model->aol_country = (key_exists('ShippingAddress', $order)) ? $order['ShippingAddress']['County'] : null;
                        $model->aol_district = (key_exists('ShippingAddress', $order)) ? $order['ShippingAddress']['District'] : null;
                        $model->aol_state_or_region = (key_exists('ShippingAddress', $order)) ? $order['ShippingAddress']['StateOrRegion'] : null;
                        $model->aol_postal_code = (key_exists('ShippingAddress', $order)) ? $order['ShippingAddress']['PostalCode'] : null;
                        $model->aol_country_code =(key_exists('ShippingAddress', $order)) ? $order['ShippingAddress']['CountryCode'] : null;
                        $model->aol_phone = (key_exists('ShippingAddress', $order)) ? $order['ShippingAddress']['Phone'] : null;
                        $model->aol_buyer_name = key_exists('BuyerName', $order) ? $order['BuyerName'] : null;
                        $model->aol_buyer_email = key_exists('BuyerEmail', $order) ? $order['BuyerEmail'] : null;
                        $orderDetail = true;
                    }
                    $model->aol_user_id = $user->u_id;
                    if($model->save(false)) {
                        $olModel = OrderDataLog::findOne(['odl_order_id' => $model->aol_amazon_order_id, 'odl_user_id' => $user->u_id]);
                        if (!$olModel) {
                            $olModel = new OrderDataLog();
                            $olModel->odl_order_id = $model->aol_amazon_order_id;
                            $olModel->odl_user_id = $user->u_id;
                            if($orderDetail) {
                                $olModel->odl_shipped_order_data = 1;
                            }
                            if($olModel->save(false)) {
                                echo $model->aol_amazon_order_id." Log is Saved. ";
                            }
                        }
                        echo $model->aol_amazon_order_id." is Saved. ";
                    }
                }
            }
            echo "Done..";
        }
    }

    public function getOrderShipmentData($orderId, $userId)
    {
        $orderData = \Yii::$app->orderData->getFinanceEventList($orderId);
        $shipmentData = $orderData['shipmentEventData'];
        if ($shipmentData) {
            foreach ($shipmentData as $sVal) {
                $modelSR = new ShipmentRefundEventData();
                $modelSR->sred_amazon_order_id = $sVal['AmazonOrderId'];
                $modelSR->sred_seller_order_id = $sVal['SellerOrderId'];
                $modelSR->sred_marketplace_name = $sVal['MarketplaceName'];
                $modelSR->sred_shipment_posted_date = $sVal['PostedDate'];
                $modelSR->sred_event_type = 'Order';
                $modelSR->created_by = $userId;
                $modelSR->updated_by = $userId;

                if ($modelSR->save(false)) {
                    $shipmentRefundId = $modelSR->sred_id;
                    if (key_exists('ShipmentItemList', $sVal) && is_array($sVal['ShipmentItemList']) && $shipmentItemData = $sVal['ShipmentItemList']) {
                        foreach ($shipmentItemData as $sItem) {
                            $sellerSku = $sItem['SellerSKU'];
                            $orderItemId = $sItem['OrderItemId'];
                            $shippedQuantity = $sItem['QuantityShipped'];

                            if (key_exists('ItemChargeList', $sItem) && is_array($sItem['ItemChargeList']) && $itemChargeData = $sItem['ItemChargeList']) {
                                foreach ($itemChargeData as $iData) {
                                    $itemModel = new ItemChargeListData();
                                    $itemModel->icld_quantity_shipped = $shippedQuantity;
                                    $itemModel->icld_seller_sku = $sellerSku;
                                    $itemModel->icld_order_item_id = $orderItemId;
                                    $itemModel->icld_amazon_order_id = $modelSR->sred_amazon_order_id;
                                    $itemModel->icld_seller_order_id = $modelSR->sred_seller_order_id;
                                    $itemModel->icld_item_charge_type = $iData['ChargeType'];
                                    $itemModel->icld_charge_amount = $iData['Amount'];
                                    $itemModel->icld_currency = $iData['CurrencyCode'];
                                    $itemModel->icld_transaction_type = 'Order';
                                    $itemModel->icld_item_type = 'Shipment';
                                    $itemModel->icld_shipment_refund_event_data_id = $modelSR->sred_id;
                                    $itemModel->created_by = $userId;
                                    $itemModel->updated_by = $userId;
                                    if ($itemModel->save(false)) {
                                        echo "Item Charge Saved.";
                                    }
                                } //$itemChargeData
                            }

                            if (key_exists('ItemFeeList', $sItem) && is_array($sItem['ItemFeeList']) && $itemFeeChargeData = $sItem['ItemFeeList']) {
                                foreach ($itemFeeChargeData as $ifData) {
                                    $feeModel = new ItemFeeListData();
                                    $feeModel->ifld_quantity_shipped = $shippedQuantity;
                                    $feeModel->ifld_seller_sku = $sellerSku;
                                    $feeModel->ifld_order_item_id = $orderItemId;
                                    $feeModel->ifld_amazon_order_id = $modelSR->sred_amazon_order_id;
                                    $feeModel->ifld_seller_order_id = $modelSR->sred_seller_order_id;
                                    $feeModel->ifld_fee_type = $ifData['FeeType'];
                                    $feeModel->ifld_fee_amount = $ifData['Amount'];
                                    $feeModel->ifld_currency = $ifData['CurrencyCode'];
                                    $feeModel->ifld_transaction_type = 'Order';
                                    $feeModel->ifld_item_type = 'Shipment';
                                    $feeModel->ifld_shipment_refund_event_id = $modelSR->sred_id;
                                    $feeModel->created_by = $userId;
                                    $feeModel->updated_by = $userId;
                                    if ($feeModel->save(false)) {
                                        echo "Item Fee Saved.";
                                    }
                                } // $itemFeeChargeData
                            }
                        } // $shipmentItemData
                    }

                    $olModel = OrderDataLog::findOne(['odl_order_id' => $orderId, 'odl_user_id' => $userId]);
                    if($olModel) {
                        $olModel->odl_shipment_data = 1;
                        $olModel->save(false);
                    }
                }
            } //$shipmentData
        } // if : $shipmentData
        sleep(1);
    }

    public function getOrderRefundData($orderId, $userId)
    {
        $orderData = \Yii::$app->orderData->getFinanceEventList($orderId);
        $refundData = $orderData['refundEventData'];

        if ($refundData) {
            foreach ($refundData as $rValue) {
                $modelSR = new ShipmentRefundEventData();
                $modelSR->sred_amazon_order_id = $rValue['AmazonOrderId'];
                $modelSR->sred_seller_order_id = $rValue['SellerOrderId'];
                $modelSR->sred_marketplace_name = $rValue['MarketplaceName'];
                $modelSR->sred_refund_posted_date = $rValue['PostedDate'];
                $modelSR->sred_event_type = 'Refund';
                $modelSR->created_by = $userId;
                $modelSR->updated_by = $userId;

                if ($modelSR->save(false)) {
                    if (key_exists('ShipmentItemAdjustmentList', $rValue) && is_array($rValue['ShipmentItemAdjustmentList']) && $shipmentItemData = $rValue['ShipmentItemAdjustmentList']) {
                        foreach ($shipmentItemData as $sItem) {
                            $sellerSku = $sItem['SellerSKU'];
                            $orderItemId = (key_exists('OrderAdjustmentItemId', $sItem)) ? $sItem['OrderAdjustmentItemId'] : null;
                            $shippedQuantity = (key_exists('QuantityShipped', $sItem)) ? $sItem['QuantityShipped'] : null;

                            if (key_exists('ItemChargeAdjustmentList', $sItem) && is_array($sItem['ItemChargeAdjustmentList']) && $itemChargeData = $sItem['ItemChargeAdjustmentList']) {
                                foreach ($itemChargeData as $iData) {
                                    $itemModel = new ItemChargeListData();
                                    $itemModel->icld_quantity_shipped = $shippedQuantity;
                                    $itemModel->icld_seller_sku = $sellerSku;
                                    $itemModel->icld_order_adjustment_item_id = $orderItemId;
                                    $itemModel->icld_amazon_order_id = $modelSR->sred_amazon_order_id;
                                    $itemModel->icld_seller_order_id = $modelSR->sred_seller_order_id;
                                    $itemModel->icld_item_charge_type = $iData['ChargeType'];
                                    $itemModel->icld_charge_amount = $iData['Amount'];
                                    $itemModel->icld_currency = $iData['CurrencyCode'];
                                    $itemModel->icld_transaction_type = 'Refund';
                                    $itemModel->icld_item_type = 'Refund';
                                    $itemModel->icld_shipment_refund_event_data_id = $modelSR->sred_id;
                                    $itemModel->created_by = $userId;
                                    $itemModel->updated_by = $userId;
                                    if ($itemModel->save(false)) {
                                        echo "Refund Item Charge Saved.";
                                    }
                                } //$itemChargeData
                            }

                            if (key_exists('ItemFeeAdjustmentList', $sItem) && is_array($sItem['ItemFeeAdjustmentList']) && $itemFeeChargeData = $sItem['ItemFeeAdjustmentList']) {
                                foreach ($itemFeeChargeData as $ifData) {
                                    $feeModel = new ItemFeeListData();
                                    $feeModel->ifld_quantity_shipped = $shippedQuantity;
                                    $feeModel->ifld_seller_sku = $sellerSku;
                                    $feeModel->ifld_order_adjustment_item_id = $orderItemId;
                                    $feeModel->ifld_amazon_order_id = $modelSR->sred_amazon_order_id;
                                    $feeModel->ifld_seller_order_id = $modelSR->sred_seller_order_id;
                                    $feeModel->ifld_fee_type = $ifData['FeeType'];
                                    $feeModel->ifld_fee_amount = $ifData['Amount'];
                                    $feeModel->ifld_currency = $ifData['CurrencyCode'];
                                    $feeModel->ifld_transaction_type = 'Refund';
                                    $feeModel->ifld_item_type = 'Refund';
                                    $feeModel->ifld_shipment_refund_event_id = $modelSR->sred_id;
                                    $feeModel->created_by = $userId;
                                    $feeModel->updated_by = $userId;
                                    if ($feeModel->save(false)) {
                                        echo "Refund Item Fee Saved.";
                                    }
                                } // $itemFeeChargeData
                            }
                        } // $shipmentItemData
                    }

                    $olModel = OrderDataLog::findOne(['odl_order_id' => $orderId, 'odl_user_id' => $userId]);
                    if($olModel) {
                        $olModel->odl_refund_data = 1;
                        $olModel->save(false);
                    }
                }
            }
        } // if : Refund Event
        sleep(1);
    }

    public function getOrderServiceFeeData($orderId, $userId)
    {
        $orderData = \Yii::$app->orderData->getFinanceEventList($orderId);
        $serviceFeeEventData = $orderData['serviceFeeEventData'];

        if ($serviceFeeEventData) {
            foreach ($serviceFeeEventData as $rValue) {
                $aOrderId = $rValue['AmazonOrderId'];
                $feeReason = $rValue['FeeReason'];
                $sellerSku = $rValue['SellerSKU'];
                $fnSku = $rValue['FnSKU'];
                $feeDesc = $rValue['FeeDescription'];
                $asin = $rValue['ASIN'];

                if (key_exists('FeeList', $rValue) && is_array($rValue['FeeList']) && $itemChargeData = $rValue['FeeList']) {
                    foreach ($itemChargeData as $iData) {
                        $sModel = new ServiceFeeData();
                        $sModel->sfd_amazon_order_id = $aOrderId;
                        $sModel->sfd_seller_order_id = $orderId;
                        $sModel->sfd_fee_reason = $feeReason;
                        $sModel->sfd_seller_sku = $sellerSku;
                        $sModel->sfd_fnsku = $fnSku;
                        $sModel->sfd_fee_description = $feeDesc;
                        $sModel->sfd_asin = $asin;
                        $sModel->sfd_fee_type = $iData['FeeType'];
                        $sModel->sfd_fee_amount = $iData['Amount'];
                        $sModel->sfd_currency = $iData['CurrencyCode'];
                        $sModel->sfd_shipment_refund_event_data_id = null;
                        $sModel->created_by = $userId;
                        $sModel->updated_by = $userId;
                        if ($sModel->save(false)) {
                            echo "Service Fee Data Saved.";
                        }
                    }

                    $olModel = OrderDataLog::findOne(['odl_order_id' => $orderId, 'odl_user_id' => $userId]);
                    if($olModel) {
                        $olModel->odl_service_fee_data = 1;
                        $olModel->save(false);
                    }
                }
            }
        } // if : service Fee Event
        sleep(1);
    }

    public function getOrderAdjustmentData($orderId, $userId)
    {
        $orderData = \Yii::$app->orderData->getFinanceEventList($orderId);
        $adjustmentEventData = $orderData['adjustmentEventData'];

        if ($adjustmentEventData) {
            foreach ($adjustmentEventData as $raValue) {
                $adModel = new OrderAdjustmentEventData();
                $adModel->oaed_amazon_order_id = $orderId;
                $adModel->oaed_seller_order_id = $orderId;
                $adModel->oaed_adjustment_type = $raValue['AdjustmentType'];
                $adModel->oaed_amount = $raValue['Amount'];
                $adModel->oaed_currency = $raValue['CurrencyCode'];
                $adModel->created_by = $userId;
                $adModel->updated_by = $userId;

                if ($adModel->save(false)) {
                    if (key_exists('AdjustmentItemList', $raValue) && is_array($raValue['AdjustmentItemList']) && $AdjustmentItemList = $raValue['AdjustmentItemList']) {
                        foreach ($AdjustmentItemList as $siItem) {
                            $adIModel = new OrderAdjustmentItemListData();
                            $adIModel->oaild_amazon_order_id = $orderId;
                            $adIModel->oaild_seller_order_id = $orderId;
                            $adIModel->oaild_quantity = $siItem['Quantity'];
                            $adIModel->oaild_per_unit_amount = $siItem['PerUnitAmount']['Amount'];
                            $adIModel->oaild_total_amount = $siItem['TotalAmount']['Amount'];
                            $adIModel->oaild_currency = $siItem['TotalAmount']['CurrencyCode'];
                            $adIModel->oaild_seller_sku = $siItem['SellerSKU'];
                            $adIModel->oaild_fnsku = $siItem['FnSKU'];
                            $adIModel->oaild_product_description = $siItem['ProductDescription'];
                            $adIModel->oaild_asin = $siItem['ASIN'];
                            $adIModel->order_adjustment_event_data_id = $adModel->oaed_id;
                            $adIModel->oaild_shipment_refund_event_data_id = null;
                            $adIModel->created_by = $userId;
                            $adIModel->updated_by = $userId;
                            if ($adIModel->save(false)) {
                                echo "Adjustment Item Data Saved.";
                            }
                        }
                    }

                    $olModel = OrderDataLog::findOne(['odl_order_id' => $orderId, 'odl_user_id' => $userId]);
                    if($olModel) {
                        $olModel->odl_adjustment_data = 1;
                        $olModel->save(false);
                    }
                }
            }
        } // if : adjustment Event Data
        sleep(1);
    }

    public function getOrderAsinData($orderId, $userId)
    {
        $orderItemAsinData = \Yii::$app->api->getOrderItems($orderId, true);
        if ($orderItemAsinData) {
            foreach ($orderItemAsinData as $asinData) {
                $modelOI = OrderItemsAsin::findOne(['oia_order_id' => $orderId]);
                if (!$modelOI) {
                    $modelOI = new OrderItemsAsin();
                }
                $modelOI->oia_order_id = $orderId;
                $modelOI->oia_asin = $asinData['ASIN'];
                /*$catData = ($modelOI->oia_asin) ? \Yii::$app->api->getProductCategory($modelOI->oia_asin) : null;
                if ($catData) {
                    $modelP = FbaAllListingData::findOne(['asin1' => $modelOI->oia_asin]);
                    $sPrice = ($modelP) ? $modelP->price : 0;
                    $fees = GetApiData::mwsFeesEstimate($modelOI->oia_asin, $sPrice);
                    $referralFee = ($fees) ? $fees['ReferralFee'] : 0;

                    $modelOI->oia_referral_fee = $referralFee;
                    $modelOI->oia_category = $catData;
                    $modelOI->oia_purchase_date = $orderId;

                    $productDimensionData = \Yii::$app->api->getProductDimensions($modelOI->oia_asin);
                    if ($productDimensionData) {
                        $modelOI->oia_item_height = $productDimensionData['ItemHeight'];
                        $modelOI->oia_item_length = $productDimensionData['ItemLength'];
                        $modelOI->oia_item_weight = $productDimensionData['ItemWeight'];
                        $modelOI->oia_item_width = $productDimensionData['ItemWidth'];
                        $modelOI->oia_package_height = $productDimensionData['PackageHeight'];
                        $modelOI->oia_package_length = $productDimensionData['PackageLength'];
                        $modelOI->oia_package_weight = $productDimensionData['PackageWeight'];
                        $modelOI->oia_package_width = $productDimensionData['PackageWidth'];
                    }
                }*/

                if ($modelOI->save(false)) {
                    echo "ASIN Saved.";

                    $oModel = AllOrdesList::findOne(['aol_amazon_order_id' => $orderId]);
                    if($oModel) {
                        $oModel->aol_asin = $modelOI->oia_asin;
                        $oModel->save(false);
                    }

                    $olModel = OrderDataLog::findOne(['odl_order_id' => $orderId, 'odl_user_id' => $userId]);
                    if($olModel) {
                        $olModel->odl_all_asin_data = 1;
                        $olModel->save(false);
                    }
                }
                //sleep(1);
            }
        }
        sleep(1);
    }


    /**
     * Get Daily Order (Method) Old
     */
    public function getDailyOrders($id=null)
    {
        $startDate = date("Y-m-d H:i:s", strtotime('-1 month', time()));
        $endDate = date('Y-m-d H:i:s');

        $userData = User::find()->andFilterWhere(['u_id' => $id])->andWhere(['IS NOT', 'u_mws_seller_id', null])->all();

        foreach ($userData as $user) {
            \Yii::$app->data->getMwsDetails($user->u_mws_seller_id, $user->u_mws_auth_token);

            $orderList = \Yii::$app->api->getOrdersList('Created', $startDate, $endDate);
            foreach ($orderList as $order) {
                $order = (array)$order;
                $order = array_shift($order);
                if ($order) {

                    $model = AllOrdesList::findOne(['aol_amazon_order_id' => $order['AmazonOrderId'], 'aol_user_id' => $user->u_id]);
                    if (!$model) {
                        $model = new AllOrdesList();
                    }
                    $model->aol_amazon_order_id = (key_exists('AmazonOrderId', $order)) ? $order['AmazonOrderId'] : null;
                    $model->aol_seller_order_id = (key_exists('SellerOrderId', $order)) ? $order['SellerOrderId'] : null;
                    $model->aol_purchase_date = (key_exists('PurchaseDate', $order)) ? $order['PurchaseDate'] : null;
                    $model->aol_last_updated_date = (key_exists('LastUpdateDate', $order)) ? $order['LastUpdateDate'] : null;
                    $model->aol_order_status = (key_exists('OrderStatus', $order)) ? $order['OrderStatus'] : null;
                    $model->aol_fulfilment_channel = (key_exists('FulfillmentChannel', $order)) ? $order['FulfillmentChannel'] : null;
                    $model->aol_sales_channel = (key_exists('SalesChannel', $order)) ? $order['SalesChannel'] : null;
                    $model->aol_ship_service = (key_exists('ShipServiceLevel', $order)) ? $order['ShipServiceLevel'] : null;
                    $model->aol_order_total = (key_exists('OrderTotal', $order)) ? $order['OrderTotal']['Amount'] : 0;
                    $model->aol_shipped_items = (key_exists('NumberOfItemsShipped', $order)) ? $order['NumberOfItemsShipped'] : null;
                    $model->aol_unshipped_items = (key_exists('NumberOfItemsUnshipped', $order)) ? $order['NumberOfItemsUnshipped'] : null;
                    $model->aol_user_id = $user->u_id;
                    if($model->save(false)) {
                        echo $model->aol_amazon_order_id." is Saved. ";
                    }

                    $model = AllOrdesList::findOne($model->aol_amazon_order_id);
                    if($model) {
                        sleep(2);
                        /**
                         * Get Finance Event Data
                         */
                        $financeEventData = \Yii::$app->api->getFinanceEventList($model->aol_amazon_order_id);
                        $amazonOrderId = $sellerOrderId = $shipmentRefundId = null;

                        if ($financeEventData) {
                            // print_r($financeEventData); exit();
                            /**
                             * Store Shipment Event Data 111-8188019-0760241
                             */
                            if ($shipmentData = $financeEventData['shipmentEventData']) {
                                foreach ($shipmentData as $sVal) {
                                    $modelSR = new ShipmentRefundEventData();
                                    $modelSR->sred_amazon_order_id = $amazonOrderId = $sVal['AmazonOrderId'];
                                    $modelSR->sred_seller_order_id = $sellerOrderId = $sVal['SellerOrderId'];
                                    $modelSR->sred_marketplace_name = $sVal['MarketplaceName'];
                                    $modelSR->sred_shipment_posted_date = $sVal['PostedDate'];
                                    $modelSR->sred_event_type = 'Order';

                                    if ($modelSR->save(false)) {
                                        $shipmentRefundId = $modelSR->sred_id;
                                        if (key_exists('ShipmentItemList', $sVal) && is_array($sVal['ShipmentItemList']) && $shipmentItemData = $sVal['ShipmentItemList']) {
                                            foreach ($shipmentItemData as $sItem) {
                                                $sellerSku = $sItem['SellerSKU'];
                                                $orderItemId = $sItem['OrderItemId'];
                                                $shippedQuantity = $sItem['QuantityShipped'];

                                                if (key_exists('ItemChargeList', $sItem) && is_array($sItem['ItemChargeList']) && $itemChargeData = $sItem['ItemChargeList']) {
                                                    foreach ($itemChargeData as $iData) {
                                                        $itemModel = new ItemChargeListData();
                                                        $itemModel->icld_quantity_shipped = $shippedQuantity;
                                                        $itemModel->icld_seller_sku = $sellerSku;
                                                        $itemModel->icld_order_item_id = $orderItemId;
                                                        $itemModel->icld_amazon_order_id = $modelSR->sred_amazon_order_id;
                                                        $itemModel->icld_seller_order_id = $modelSR->sred_seller_order_id;
                                                        $itemModel->icld_item_charge_type = $iData['ChargeType'];
                                                        $itemModel->icld_charge_amount = $iData['Amount'];
                                                        $itemModel->icld_currency = $iData['CurrencyCode'];
                                                        $itemModel->icld_transaction_type = 'Order';
                                                        $itemModel->icld_item_type = 'Shipment';
                                                        $itemModel->icld_shipment_refund_event_data_id = $modelSR->sred_id;
                                                        if ($itemModel->save(false)) {
                                                            echo "Item Charge Saved.";
                                                        }
                                                    } //$itemChargeData
                                                }

                                                if (key_exists('ItemFeeList', $sItem) && is_array($sItem['ItemFeeList']) && $itemFeeChargeData = $sItem['ItemFeeList']) {
                                                    foreach ($itemFeeChargeData as $ifData) {
                                                        $feeModel = new ItemFeeListData();
                                                        $feeModel->ifld_quantity_shipped = $shippedQuantity;
                                                        $feeModel->ifld_seller_sku = $sellerSku;
                                                        $feeModel->ifld_order_item_id = $orderItemId;
                                                        $feeModel->ifld_amazon_order_id = $modelSR->sred_amazon_order_id;
                                                        $feeModel->ifld_seller_order_id = $modelSR->sred_seller_order_id;
                                                        $feeModel->ifld_fee_type = $ifData['FeeType'];
                                                        $feeModel->ifld_fee_amount = $ifData['Amount'];
                                                        $feeModel->ifld_currency = $ifData['CurrencyCode'];
                                                        $feeModel->ifld_transaction_type = 'Order';
                                                        $feeModel->ifld_item_type = 'Shipment';
                                                        $feeModel->ifld_shipment_refund_event_id = $modelSR->sred_id;
                                                        if ($feeModel->save(false)) {
                                                            echo "Item Fee Saved.";
                                                        }
                                                    } // $itemFeeChargeData
                                                }
                                            } // $shipmentItemData
                                        }
                                    }
                                } //$shipmentData
                            } // if : $shipmentData

                            /**
                             * Store Refund Event Data
                             */
                            if ($refundData = $financeEventData['refundEventData']) {
                                foreach ($refundData as $rValue) {
                                    $modelSR = new ShipmentRefundEventData();
                                    $modelSR->sred_amazon_order_id = $rValue['AmazonOrderId'];
                                    $modelSR->sred_seller_order_id = $rValue['SellerOrderId'];
                                    $modelSR->sred_marketplace_name = $rValue['MarketplaceName'];
                                    $modelSR->sred_refund_posted_date = $rValue['PostedDate'];
                                    $modelSR->sred_event_type = 'Refund';

                                    if ($model->save(false)) {
                                        /*$vnModel = new VaNotification();
                                        $vnModel->vn_amazon_order_id = $modelSR->sred_amazon_order_id;
                                        $vnModel->vn_refund_posted_date = $modelSR->sred_refund_posted_date;
                                        $vnModel->vn_shipment_refund_event_data_id = $modelSR->sred_id;
                                        $vnModel->save(false);*/

                                        if (key_exists('ShipmentItemAdjustmentList', $rValue) && is_array($rValue['ShipmentItemAdjustmentList']) && $shipmentItemData = $rValue['ShipmentItemAdjustmentList']) {
                                            foreach ($shipmentItemData as $sItem) {
                                                $sellerSku = $sItem['SellerSKU'];
                                                $orderItemId = (key_exists('OrderAdjustmentItemId', $sItem)) ? $sItem['OrderAdjustmentItemId'] : null;
                                                $shippedQuantity = (key_exists('QuantityShipped', $sItem)) ? $sItem['QuantityShipped'] : null;

                                                if (key_exists('ItemChargeAdjustmentList', $sItem) && is_array($sItem['ItemChargeAdjustmentList']) && $itemChargeData = $sItem['ItemChargeAdjustmentList']) {
                                                    foreach ($itemChargeData as $iData) {
                                                        $itemModel = new ItemChargeListData();
                                                        $itemModel->icld_quantity_shipped = $shippedQuantity;
                                                        $itemModel->icld_seller_sku = $sellerSku;
                                                        $itemModel->icld_order_adjustment_item_id = $orderItemId;
                                                        $itemModel->icld_amazon_order_id = $modelSR->sred_amazon_order_id;
                                                        $itemModel->icld_seller_order_id = $modelSR->sred_seller_order_id;
                                                        $itemModel->icld_item_charge_type = $iData['ChargeType'];
                                                        $itemModel->icld_charge_amount = $iData['Amount'];
                                                        $itemModel->icld_currency = $iData['CurrencyCode'];
                                                        $itemModel->icld_transaction_type = 'Refund';
                                                        $itemModel->icld_item_type = 'Refund';
                                                        $itemModel->icld_shipment_refund_event_data_id = $modelSR->sred_id;
                                                        if ($itemModel->save(false)) {
                                                            echo "Refund Item Charge Saved.";
                                                        }
                                                    } //$itemChargeData
                                                }

                                                if (key_exists('ItemFeeAdjustmentList', $sItem) && is_array($sItem['ItemFeeAdjustmentList']) && $itemFeeChargeData = $sItem['ItemFeeAdjustmentList']) {
                                                    foreach ($itemFeeChargeData as $ifData) {
                                                        $feeModel = new ItemFeeListData();
                                                        $feeModel->ifld_quantity_shipped = $shippedQuantity;
                                                        $feeModel->ifld_seller_sku = $sellerSku;
                                                        $feeModel->ifld_order_adjustment_item_id = $orderItemId;
                                                        $feeModel->ifld_amazon_order_id = $modelSR->sred_amazon_order_id;
                                                        $feeModel->ifld_seller_order_id = $modelSR->sred_seller_order_id;
                                                        $feeModel->ifld_fee_type = $ifData['FeeType'];
                                                        $feeModel->ifld_fee_amount = $ifData['Amount'];
                                                        $feeModel->ifld_currency = $ifData['CurrencyCode'];
                                                        $feeModel->ifld_transaction_type = 'Refund';
                                                        $feeModel->ifld_item_type = 'Refund';
                                                        $feeModel->ifld_shipment_refund_event_id = $modelSR->sred_id;
                                                        if ($feeModel->save(false)) {
                                                            echo "Refund Item Fee Saved.";
                                                        }
                                                    } // $itemFeeChargeData
                                                }
                                            } // $shipmentItemData
                                        }
                                    }
                                }
                            } // if : Refund Event

                            /*
                             * Store Service Fee Event Data
                             */
                            if ($serviceFeeEventData = $financeEventData['serviceFeeEventData']) {
                                foreach ($serviceFeeEventData as $rValue) {
                                    $aOrderId = $rValue['AmazonOrderId'];
                                    $feeReason = $rValue['FeeReason'];
                                    $sellerSku = $rValue['SellerSKU'];
                                    $fnSku = $rValue['FnSKU'];
                                    $feeDesc = $rValue['FeeDescription'];
                                    $asin = $rValue['ASIN'];

                                    if (key_exists('FeeList', $rValue) && is_array($rValue['FeeList']) && $itemChargeData = $rValue['FeeList']) {
                                        foreach ($itemChargeData as $iData) {
                                            $sModel = new ServiceFeeData();
                                            $sModel->sfd_amazon_order_id = $aOrderId;
                                            $sModel->sfd_seller_order_id = $sellerOrderId;
                                            $sModel->sfd_fee_reason = $feeReason;
                                            $sModel->sfd_seller_sku = $sellerSku;
                                            $sModel->sfd_fnsku = $fnSku;
                                            $sModel->sfd_fee_description = $feeDesc;
                                            $sModel->sfd_asin = $asin;
                                            $sModel->sfd_fee_type = $iData['FeeType'];
                                            $sModel->sfd_fee_amount = $iData['Amount'];
                                            $sModel->sfd_currency = $iData['CurrencyCode'];
                                            $sModel->sfd_shipment_refund_event_data_id = $shipmentRefundId;
                                            if ($sModel->save(false)) {
                                                echo "Service Fee Data Saved.";
                                            }
                                        }
                                    }
                                }
                            } // if : service Fee Event

                            /**
                             * Adjustment Event Data
                             */
                            if ($adjustmentEventData = $financeEventData['adjustmentEventData']) {
                                foreach ($adjustmentEventData as $raValue) {
                                    $adModel = new OrderAdjustmentEventData();
                                    $adModel->oaed_amazon_order_id = $amazonOrderId;
                                    $adModel->oaed_seller_order_id = $sellerOrderId;
                                    $adModel->oaed_adjustment_type = $raValue['AdjustmentType'];
                                    $adModel->oaed_amount = $raValue['Amount'];
                                    $adModel->oaed_currency = $raValue['CurrencyCode'];

                                    if ($adModel->save(false)) {
                                        if (key_exists('AdjustmentItemList', $raValue) && is_array($raValue['AdjustmentItemList']) && $AdjustmentItemList = $raValue['AdjustmentItemList']) {
                                            foreach ($AdjustmentItemList as $siItem) {
                                                $adIModel = new OrderAdjustmentItemListData();
                                                $adIModel->oaild_amazon_order_id = $amazonOrderId;
                                                $adIModel->oaild_seller_order_id = $sellerOrderId;
                                                $adIModel->oaild_quantity = $siItem['Quantity'];
                                                $adIModel->oaild_per_unit_amount = $siItem['PerUnitAmount']['Amount'];
                                                $adIModel->oaild_total_amount = $siItem['TotalAmount']['Amount'];
                                                $adIModel->oaild_currency = $siItem['TotalAmount']['CurrencyCode'];
                                                $adIModel->oaild_seller_sku = $siItem['SellerSKU'];
                                                $adIModel->oaild_fnsku = $siItem['FnSKU'];
                                                $adIModel->oaild_product_description = $siItem['ProductDescription'];
                                                $adIModel->oaild_asin = $siItem['ASIN'];
                                                $adIModel->order_adjustment_event_data_id = $adModel->oaed_id;
                                                $adIModel->oaild_shipment_refund_event_data_id = $shipmentRefundId;
                                                if ($adIModel->save(false)) {
                                                    echo "Adjustment Item Data Saved.";
                                                }
                                            }
                                        }
                                    }
                                }
                            } // if : adjustment Event Data

                        } // main if : $financeEventData

                        $model = AllOrdesList::findOne(['aol_amazon_order_id' => $amazonOrderId]);
                        if($model) {
                            $model->aol_status = 1; // Finance Event Data Pulled.
                            if ($model->save(false)) {
                                echo "Finance Event Data of Order No: " . $model->aol_amazon_order_id . " is Saved.";
                            }
                        }
                        sleep(3);

                        /**
                         * Get Shipped Order Details
                         */
                        $model = AllOrdesList::findOne(['aol_amazon_order_id' => $model->aol_amazon_order_id]);
                        if ($model && $model->aol_order_status == 'Shipped') {
                            $orderDetails = \Yii::$app->api->getOrderDetails($model->aol_amazon_order_id);
                            $orderItemAsin = \Yii::$app->api->getOrderItems($model->aol_amazon_order_id);
                            if ($orderDetails) {
                                $model->aol_shipping_username = key_exists('Name', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['Name'] : null;
                                $model->aol_shipping_address_1 = key_exists('AddressLine1', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['AddressLine1'] : null;
                                $model->aol_shipping_address_2 = key_exists('AddressLine2', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['AddressLine2'] : null;
                                $model->aol_shipping_address_3 = key_exists('AddressLine3', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['AddressLine3'] : null;
                                $model->aol_city = key_exists('City', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['City'] : null;
                                $model->aol_country = key_exists('County', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['County'] : null;
                                $model->aol_district = key_exists('District', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['District'] : null;
                                $model->aol_state_or_region = key_exists('StateOrRegion', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['StateOrRegion'] : null;
                                $model->aol_postal_code = key_exists('PostalCode', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['PostalCode'] : null;
                                $model->aol_country_code = key_exists('CountryCode', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['CountryCode'] : null;
                                $model->aol_phone = key_exists('Phone', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['Phone'] : null;
                                $model->aol_buyer_name = key_exists('BuyerName', $orderDetails) ? $orderDetails['BuyerName'] : null;
                                $model->aol_buyer_email = key_exists('BuyerEmail', $orderDetails) ? $orderDetails['BuyerEmail'] : null;
                                $model->aol_asin = $orderItemAsin;
                                $model->aol_shipped_status = 1; //Order Details Pulled
                                if ($model->save(false))
                                    echo $model->aol_amazon_order_id . " Details Saved.";
                            }
                            sleep(3);

                            /**
                             * Get All ASIN for Order
                             */
                            $orderItemAsinData = \Yii::$app->api->getOrderItems($model->aol_amazon_order_id, true);
                            if ($orderItemAsinData) {
                                foreach ($orderItemAsinData as $asinData) {
                                    $modelOI = OrderItemsAsin::findOne(['oia_order_id' => $model->aol_amazon_order_id]);
                                    if (!$modelOI) {
                                        $modelOI = new OrderItemsAsin();
                                    }
                                    $modelOI->oia_order_id = $model->aol_amazon_order_id;
                                    $modelOI->oia_asin = $asinData['ASIN'];
                                    $catData = ($modelOI->oia_asin) ? \Yii::$app->api->getProductCategory($modelOI->oia_asin) : null;
                                    if ($catData) {
                                        $modelP = FbaAllListingData::findOne(['asin1' => $modelOI->oia_asin]);
                                        $sPrice = ($modelP) ? $modelP->price : 0;
                                        $fees = GetApiData::mwsFeesEstimate($modelOI->oia_asin, $sPrice);
                                        $referralFee = ($fees) ? $fees['ReferralFee'] : 0;

                                        $modelOI->oia_referral_fee = $referralFee;
                                        $modelOI->oia_category = $catData;
                                        $modelOI->oia_purchase_date = $model->aol_purchase_date;

                                        $productDimensionData = \Yii::$app->api->getProductDimensions($modelOI->oia_asin);
                                        if ($productDimensionData) {
                                            $modelOI->oia_item_height = $productDimensionData['ItemHeight'];
                                            $modelOI->oia_item_length = $productDimensionData['ItemLength'];
                                            $modelOI->oia_item_weight = $productDimensionData['ItemWeight'];
                                            $modelOI->oia_item_width = $productDimensionData['ItemWidth'];
                                            $modelOI->oia_package_height = $productDimensionData['PackageHeight'];
                                            $modelOI->oia_package_length = $productDimensionData['PackageLength'];
                                            $modelOI->oia_package_weight = $productDimensionData['PackageWeight'];
                                            $modelOI->oia_package_width = $productDimensionData['PackageWidth'];
                                        }
                                    }
                                    if ($modelOI->save(false)) {
                                        echo "ASIN Saved.";
                                    }
                                    sleep(3);
                                }
                            }
                        }
                    }
                }
            }

            /*if($id) {
                $user->order_cron_status = 1;
                $user->save(false);
            }*/
        }
        echo "Done..";
    }

    public function actionGetDailyOrdersEvent($id=null)
    {
        $userData = User::find()->andFilterWhere(['u_id' => $id])->andWhere(['IS NOT', 'u_mws_seller_id', null])->all();

        foreach ($userData as $user) {
            $orderList = AllOrdesList::find()->andWhere(['aol_status' => 0, 'aol_user_id' => $user->u_id])->all();
            \Yii::$app->data->getMwsDetails($user->u_mws_seller_id, $user->u_mws_auth_token);
            foreach ($orderList as $model) {
                sleep(3);
                /**
                 * Get Finance Event Data
                 */
                $financeEventData = \Yii::$app->api->getFinanceEventList($model->aol_amazon_order_id);
                $amazonOrderId = $sellerOrderId = $shipmentRefundId = null;

                if ($financeEventData) {
                    // print_r($financeEventData); exit();
                    /**
                     * Store Shipment Event Data 111-8188019-0760241
                     */
                    if ($shipmentData = $financeEventData['shipmentEventData']) {
                        foreach ($shipmentData as $sVal) {
                            $modelSR = new ShipmentRefundEventData();
                            $modelSR->sred_amazon_order_id = $amazonOrderId = $sVal['AmazonOrderId'];
                            $modelSR->sred_seller_order_id = $sellerOrderId = $sVal['SellerOrderId'];
                            $modelSR->sred_marketplace_name = $sVal['MarketplaceName'];
                            $modelSR->sred_shipment_posted_date = $sVal['PostedDate'];
                            $modelSR->sred_event_type = 'Order';

                            if ($modelSR->save(false)) {
                                $shipmentRefundId = $modelSR->sred_id;
                                if (key_exists('ShipmentItemList', $sVal) && is_array($sVal['ShipmentItemList']) && $shipmentItemData = $sVal['ShipmentItemList']) {
                                    foreach ($shipmentItemData as $sItem) {
                                        $sellerSku = $sItem['SellerSKU'];
                                        $orderItemId = $sItem['OrderItemId'];
                                        $shippedQuantity = $sItem['QuantityShipped'];

                                        if (key_exists('ItemChargeList', $sItem) && is_array($sItem['ItemChargeList']) && $itemChargeData = $sItem['ItemChargeList']) {
                                            foreach ($itemChargeData as $iData) {
                                                $itemModel = new ItemChargeListData();
                                                $itemModel->icld_quantity_shipped = $shippedQuantity;
                                                $itemModel->icld_seller_sku = $sellerSku;
                                                $itemModel->icld_order_item_id = $orderItemId;
                                                $itemModel->icld_amazon_order_id = $modelSR->sred_amazon_order_id;
                                                $itemModel->icld_seller_order_id = $modelSR->sred_seller_order_id;
                                                $itemModel->icld_item_charge_type = $iData['ChargeType'];
                                                $itemModel->icld_charge_amount = $iData['Amount'];
                                                $itemModel->icld_currency = $iData['CurrencyCode'];
                                                $itemModel->icld_transaction_type = 'Order';
                                                $itemModel->icld_item_type = 'Shipment';
                                                $itemModel->icld_shipment_refund_event_data_id = $modelSR->sred_id;
                                                if ($itemModel->save(false)) {
                                                    echo "Item Charge Saved.";
                                                }
                                            } //$itemChargeData
                                        }

                                        if (key_exists('ItemFeeList', $sItem) && is_array($sItem['ItemFeeList']) && $itemFeeChargeData = $sItem['ItemFeeList']) {
                                            foreach ($itemFeeChargeData as $ifData) {
                                                $feeModel = new ItemFeeListData();
                                                $feeModel->ifld_quantity_shipped = $shippedQuantity;
                                                $feeModel->ifld_seller_sku = $sellerSku;
                                                $feeModel->ifld_order_item_id = $orderItemId;
                                                $feeModel->ifld_amazon_order_id = $modelSR->sred_amazon_order_id;
                                                $feeModel->ifld_seller_order_id = $modelSR->sred_seller_order_id;
                                                $feeModel->ifld_fee_type = $ifData['FeeType'];
                                                $feeModel->ifld_fee_amount = $ifData['Amount'];
                                                $feeModel->ifld_currency = $ifData['CurrencyCode'];
                                                $feeModel->ifld_transaction_type = 'Order';
                                                $feeModel->ifld_item_type = 'Shipment';
                                                $feeModel->ifld_shipment_refund_event_id = $modelSR->sred_id;
                                                if ($feeModel->save(false)) {
                                                    echo "Item Fee Saved.";
                                                }
                                            } // $itemFeeChargeData
                                        }
                                    } // $shipmentItemData
                                }
                            }
                        } //$shipmentData
                    } // if : $shipmentData

                    /**
                     * Store Refund Event Data
                     */
                    if ($refundData = $financeEventData['refundEventData']) {
                        foreach ($refundData as $rValue) {
                            $modelSR = new ShipmentRefundEventData();
                            $modelSR->sred_amazon_order_id = $rValue['AmazonOrderId'];
                            $modelSR->sred_seller_order_id = $rValue['SellerOrderId'];
                            $modelSR->sred_marketplace_name = $rValue['MarketplaceName'];
                            $modelSR->sred_refund_posted_date = $rValue['PostedDate'];
                            $modelSR->sred_event_type = 'Refund';

                            if ($model->save(false)) {
                                /*$vnModel = new VaNotification();
                                $vnModel->vn_amazon_order_id = $modelSR->sred_amazon_order_id;
                                $vnModel->vn_refund_posted_date = $modelSR->sred_refund_posted_date;
                                $vnModel->vn_shipment_refund_event_data_id = $modelSR->sred_id;
                                $vnModel->save(false);*/

                                if (key_exists('ShipmentItemAdjustmentList', $rValue) && is_array($rValue['ShipmentItemAdjustmentList']) && $shipmentItemData = $rValue['ShipmentItemAdjustmentList']) {
                                    foreach ($shipmentItemData as $sItem) {
                                        $sellerSku = $sItem['SellerSKU'];
                                        $orderItemId = (key_exists('OrderAdjustmentItemId', $sItem)) ? $sItem['OrderAdjustmentItemId'] : null;
                                        $shippedQuantity = (key_exists('QuantityShipped', $sItem)) ? $sItem['QuantityShipped'] : null;

                                        if (key_exists('ItemChargeAdjustmentList', $sItem) && is_array($sItem['ItemChargeAdjustmentList']) && $itemChargeData = $sItem['ItemChargeAdjustmentList']) {
                                            foreach ($itemChargeData as $iData) {
                                                $itemModel = new ItemChargeListData();
                                                $itemModel->icld_quantity_shipped = $shippedQuantity;
                                                $itemModel->icld_seller_sku = $sellerSku;
                                                $itemModel->icld_order_adjustment_item_id = $orderItemId;
                                                $itemModel->icld_amazon_order_id = $modelSR->sred_amazon_order_id;
                                                $itemModel->icld_seller_order_id = $modelSR->sred_seller_order_id;
                                                $itemModel->icld_item_charge_type = $iData['ChargeType'];
                                                $itemModel->icld_charge_amount = $iData['Amount'];
                                                $itemModel->icld_currency = $iData['CurrencyCode'];
                                                $itemModel->icld_transaction_type = 'Refund';
                                                $itemModel->icld_item_type = 'Refund';
                                                $itemModel->icld_shipment_refund_event_data_id = $modelSR->sred_id;
                                                if ($itemModel->save(false)) {
                                                    echo "Refund Item Charge Saved.";
                                                }
                                            } //$itemChargeData
                                        }

                                        if (key_exists('ItemFeeAdjustmentList', $sItem) && is_array($sItem['ItemFeeAdjustmentList']) && $itemFeeChargeData = $sItem['ItemFeeAdjustmentList']) {
                                            foreach ($itemFeeChargeData as $ifData) {
                                                $feeModel = new ItemFeeListData();
                                                $feeModel->ifld_quantity_shipped = $shippedQuantity;
                                                $feeModel->ifld_seller_sku = $sellerSku;
                                                $feeModel->ifld_order_adjustment_item_id = $orderItemId;
                                                $feeModel->ifld_amazon_order_id = $modelSR->sred_amazon_order_id;
                                                $feeModel->ifld_seller_order_id = $modelSR->sred_seller_order_id;
                                                $feeModel->ifld_fee_type = $ifData['FeeType'];
                                                $feeModel->ifld_fee_amount = $ifData['Amount'];
                                                $feeModel->ifld_currency = $ifData['CurrencyCode'];
                                                $feeModel->ifld_transaction_type = 'Refund';
                                                $feeModel->ifld_item_type = 'Refund';
                                                $feeModel->ifld_shipment_refund_event_id = $modelSR->sred_id;
                                                if ($feeModel->save(false)) {
                                                    echo "Refund Item Fee Saved.";
                                                }
                                            } // $itemFeeChargeData
                                        }
                                    } // $shipmentItemData
                                }
                            }
                        }
                    } // if : Refund Event

                    /*
                     * Store Service Fee Event Data
                     */
                    if ($serviceFeeEventData = $financeEventData['serviceFeeEventData']) {
                        foreach ($serviceFeeEventData as $rValue) {
                            $aOrderId = $rValue['AmazonOrderId'];
                            $feeReason = $rValue['FeeReason'];
                            $sellerSku = $rValue['SellerSKU'];
                            $fnSku = $rValue['FnSKU'];
                            $feeDesc = $rValue['FeeDescription'];
                            $asin = $rValue['ASIN'];

                            if (key_exists('FeeList', $rValue) && is_array($rValue['FeeList']) && $itemChargeData = $rValue['FeeList']) {
                                foreach ($itemChargeData as $iData) {
                                    $sModel = new ServiceFeeData();
                                    $sModel->sfd_amazon_order_id = $aOrderId;
                                    $sModel->sfd_seller_order_id = $sellerOrderId;
                                    $sModel->sfd_fee_reason = $feeReason;
                                    $sModel->sfd_seller_sku = $sellerSku;
                                    $sModel->sfd_fnsku = $fnSku;
                                    $sModel->sfd_fee_description = $feeDesc;
                                    $sModel->sfd_asin = $asin;
                                    $sModel->sfd_fee_type = $iData['FeeType'];
                                    $sModel->sfd_fee_amount = $iData['Amount'];
                                    $sModel->sfd_currency = $iData['CurrencyCode'];
                                    $sModel->sfd_shipment_refund_event_data_id = $shipmentRefundId;
                                    if ($sModel->save(false)) {
                                        echo "Service Fee Data Saved.";
                                    }
                                }
                            }
                        }
                    } // if : service Fee Event

                    /**
                     * Adjustment Event Data
                     */
                    if ($adjustmentEventData = $financeEventData['adjustmentEventData']) {
                        foreach ($adjustmentEventData as $raValue) {
                            $adModel = new OrderAdjustmentEventData();
                            $adModel->oaed_amazon_order_id = $amazonOrderId;
                            $adModel->oaed_seller_order_id = $sellerOrderId;
                            $adModel->oaed_adjustment_type = $raValue['AdjustmentType'];
                            $adModel->oaed_amount = $raValue['Amount'];
                            $adModel->oaed_currency = $raValue['CurrencyCode'];

                            if ($adModel->save(false)) {
                                if (key_exists('AdjustmentItemList', $raValue) && is_array($raValue['AdjustmentItemList']) && $AdjustmentItemList = $raValue['AdjustmentItemList']) {
                                    foreach ($AdjustmentItemList as $siItem) {
                                        $adIModel = new OrderAdjustmentItemListData();
                                        $adIModel->oaild_amazon_order_id = $amazonOrderId;
                                        $adIModel->oaild_seller_order_id = $sellerOrderId;
                                        $adIModel->oaild_quantity = $siItem['Quantity'];
                                        $adIModel->oaild_per_unit_amount = $siItem['PerUnitAmount']['Amount'];
                                        $adIModel->oaild_total_amount = $siItem['TotalAmount']['Amount'];
                                        $adIModel->oaild_currency = $siItem['TotalAmount']['CurrencyCode'];
                                        $adIModel->oaild_seller_sku = $siItem['SellerSKU'];
                                        $adIModel->oaild_fnsku = $siItem['FnSKU'];
                                        $adIModel->oaild_product_description = $siItem['ProductDescription'];
                                        $adIModel->oaild_asin = $siItem['ASIN'];
                                        $adIModel->order_adjustment_event_data_id = $adModel->oaed_id;
                                        $adIModel->oaild_shipment_refund_event_data_id = $shipmentRefundId;
                                        if ($adIModel->save(false)) {
                                            echo "Adjustment Item Data Saved.";
                                        }
                                    }
                                }
                            }
                        }
                    } // if : adjustment Event Data

                } // main if : $financeEventData

                //$model = AllOrdesList::findOne(['aol_amazon_order_id' => $model->aol_amazon_order_id]);
                $model->aol_status = 1; // Finance Event Data Pulled.
                if ($model->save(false)) {
                    echo "Finance Event Data of Order No: " . $model->aol_amazon_order_id . " is Saved.";
                }
                sleep(3);

                /**
                 * Get Shipped Order Details
                 */
                //$model = AllOrdesList::findOne(['aol_amazon_order_id' => $model->aol_amazon_order_id]);
                if ($model->aol_order_status == 'Shipped') {
                    $orderDetails = \Yii::$app->api->getOrderDetails($model->aol_amazon_order_id);
                    $orderItemAsin = \Yii::$app->api->getOrderItems($model->aol_amazon_order_id);
                    if ($orderDetails) {
                        $model->aol_shipping_username = key_exists('Name', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['Name'] : null;
                        $model->aol_shipping_address_1 = key_exists('AddressLine1', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['AddressLine1'] : null;
                        $model->aol_shipping_address_2 = key_exists('AddressLine2', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['AddressLine2'] : null;
                        $model->aol_shipping_address_3 = key_exists('AddressLine3', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['AddressLine3'] : null;
                        $model->aol_city = key_exists('City', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['City'] : null;
                        $model->aol_country = key_exists('County', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['County'] : null;
                        $model->aol_district = key_exists('District', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['District'] : null;
                        $model->aol_state_or_region = key_exists('StateOrRegion', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['StateOrRegion'] : null;
                        $model->aol_postal_code = key_exists('PostalCode', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['PostalCode'] : null;
                        $model->aol_country_code = key_exists('CountryCode', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['CountryCode'] : null;
                        $model->aol_phone = key_exists('Phone', $orderDetails['ShippingAddress']) ? $orderDetails['ShippingAddress']['Phone'] : null;
                        $model->aol_buyer_name = key_exists('BuyerName', $orderDetails) ? $orderDetails['BuyerName'] : null;
                        $model->aol_buyer_email = key_exists('BuyerEmail', $orderDetails) ? $orderDetails['BuyerEmail'] : null;
                        $model->aol_asin = $orderItemAsin;
                        $model->aol_shipped_status = 1; //Order Details Pulled
                        if ($model->save(false))
                            echo $model->aol_amazon_order_id . " Details Saved.";
                    }
                    sleep(3);

                    /**
                     * Get All ASIN for Order
                     */
                    $orderItemAsinData = \Yii::$app->api->getOrderItems($model->aol_amazon_order_id, true);
                    if ($orderItemAsinData) {
                        foreach ($orderItemAsinData as $asinData) {
                            $modelOI = OrderItemsAsin::findOne(['oia_order_id' => $model->aol_amazon_order_id]);
                            if (!$modelOI) {
                                $modelOI = new OrderItemsAsin();
                            }
                            $modelOI->oia_order_id = $model->aol_amazon_order_id;
                            $modelOI->oia_asin = $asinData['ASIN'];
                            $catData = ($modelOI->oia_asin) ? \Yii::$app->api->getProductCategory($modelOI->oia_asin) : null;
                            if ($catData) {
                                $modelP = FbaAllListingData::findOne(['asin1' => $modelOI->oia_asin]);
                                $sPrice = ($modelP) ? $modelP->price : 0;
                                $fees = GetApiData::mwsFeesEstimate($modelOI->oia_asin, $sPrice);
                                $referralFee = ($fees) ? $fees['ReferralFee'] : 0;

                                $modelOI->oia_referral_fee = $referralFee;
                                $modelOI->oia_category = $catData;
                                $modelOI->oia_purchase_date = $model->aol_purchase_date;

                                $productDimensionData = \Yii::$app->api->getProductDimensions($modelOI->oia_asin);
                                if ($productDimensionData) {
                                    $modelOI->oia_item_height = $productDimensionData['ItemHeight'];
                                    $modelOI->oia_item_length = $productDimensionData['ItemLength'];
                                    $modelOI->oia_item_weight = $productDimensionData['ItemWeight'];
                                    $modelOI->oia_item_width = $productDimensionData['ItemWidth'];
                                    $modelOI->oia_package_height = $productDimensionData['PackageHeight'];
                                    $modelOI->oia_package_length = $productDimensionData['PackageLength'];
                                    $modelOI->oia_package_weight = $productDimensionData['PackageWeight'];
                                    $modelOI->oia_package_width = $productDimensionData['PackageWidth'];
                                }
                            }
                            if ($modelOI->save(false)) {
                                echo "ASIN Saved.";
                            }
                            sleep(3);
                        }
                    }
                }
            }
        }
    }

    /**
     * Get Product Details (currently images)
     */
    public function actionGetProductDetails($id=null)
    {

        $userData = User::find()->andFilterWhere(['u_id' => $id])->andWhere(['IS NOT', 'u_mws_seller_id', null])->all();

        foreach ($userData as $user) {
            \Yii::$app->data->getMwsDetails($user->u_mws_seller_id, $user->u_mws_auth_token);

            $models = FbaAllListingData::find()->andWhere(['created_by' => $user->u_id])->all(); //->andWhere(['status' => 'Active'])

            foreach ($models as $model) {
                if ($model->asin1) {
                    $productDetails = \Yii::$app->api->getProductDimensions($model->asin1, true);
                    if ($productDetails) {
                        $model->image_url = (key_exists('SmallImage', $productDetails)) ? str_replace('._SL75_', '', $productDetails['SmallImage']['URL']) : null;
                        /*if(key_exists('ListPrice', $productDetails)) {
                            $model->buybox_price = (key_exists('Amount', $productDetails['ListPrice'])) ? $productDetails['ListPrice']['Amount'] : null;
                        }*/

                        if ($model->save(false)) {
                            echo $model->asin1 . " is Updated.";
                        }
                    }
                }
                sleep(3);
            }
        }
    }

    /**
     * Get Order's Item Details
     */
    public function actionGetAllAsinItem($id=null)
    {
        $userData = User::find()->andFilterWhere(['u_id' => $id])->andWhere(['IS NOT', 'u_mws_seller_id', null])->all();

        foreach ($userData as $user) {
            \Yii::$app->data->getMwsDetails($user->u_mws_seller_id, $user->u_mws_auth_token);
            $oModels = AllOrdesList::find()->andWhere(['aol_user_id' => $user->u_id])->all();

            foreach ($oModels as $model) {
                $orderItemAsinData = \Yii::$app->api->getOrderItems($model->aol_amazon_order_id, true);
                if ($orderItemAsinData) {
                    foreach ($orderItemAsinData as $asinData) {
                        $modelOI = OrderItemsAsin::findOne(['oia_order_id' => $model->aol_amazon_order_id]);
                        if (!$modelOI) {
                            $modelOI = new OrderItemsAsin();
                        }
                        $modelOI->oia_order_id = $model->aol_amazon_order_id;
                        $modelOI->oia_asin = $asinData['ASIN'];
                        $catData = ($modelOI->oia_asin) ? \Yii::$app->api->getProductCategory($modelOI->oia_asin) : null;
                        if ($catData) {
                            $modelP = FbaAllListingData::findOne(['asin1' => $modelOI->oia_asin]);
                            $sPrice = ($modelP) ? $modelP->price : 0;
                            $fees = GetApiData::mwsFeesEstimate($modelOI->oia_asin, $sPrice);
                            $referralFee = ($fees) ? $fees['ReferralFee'] : 0;

                            $modelOI->oia_referral_fee = $referralFee;
                            $modelOI->oia_category = $catData;
                            $modelOI->oia_purchase_date = $model->aol_purchase_date;

                            $productDimensionData = \Yii::$app->api->getProductDimensions($modelOI->oia_asin);
                            if ($productDimensionData) {
                                $modelOI->oia_item_height = $productDimensionData['ItemHeight'];
                                $modelOI->oia_item_length = $productDimensionData['ItemLength'];
                                $modelOI->oia_item_weight = $productDimensionData['ItemWeight'];
                                $modelOI->oia_item_width = $productDimensionData['ItemWidth'];
                                $modelOI->oia_package_height = $productDimensionData['PackageHeight'];
                                $modelOI->oia_package_length = $productDimensionData['PackageLength'];
                                $modelOI->oia_package_weight = $productDimensionData['PackageWeight'];
                                $modelOI->oia_package_width = $productDimensionData['PackageWidth'];
                            }
                        }
                        if ($modelOI->save(false)) {
                            echo "ASIN Saved.";
                        }
                        sleep(3);
                    }
                }
            }
        }
    }

    /**
     * Temp.
     * Get Updated Buy box price
     */
    public function actionGetProductPrice($id=null)
    {
        $userData = User::find()->andFilterWhere(['u_id' => $id])->andWhere(['IS NOT', 'u_mws_seller_id', null])->all();

        foreach ($userData as $user) {
            \Yii::$app->data->getMwsDetails($user->u_mws_seller_id, $user->u_mws_auth_token);
            $models = FbaAllListingData::find()->andWhere(['created_by' => $user->u_id])->all(); //->andWhere(['status' => 'Active'])

            foreach ($models as $model) {
                if ($model->seller_sku) {
                    $productDetails = \Yii::$app->api->getProductCompetitivePrice($model->seller_sku);
                    if ($productDetails) {
                        $model->buybox_price = $productDetails;
                        if ($model->save(false)) {
                            echo $model->asin1 . " is Updated.";
                        }
                    }
                }
                sleep(3);
            }
        }
    }

    /**
     * Update all Product Buy box price also repriser cost
     */
    public function actionUpdateProductBuyBoxPrice()
    {
        $userData = User::find()->andWhere(['IS NOT', 'u_mws_seller_id', null])->all();

        foreach ($userData as $user) {
            $productData = FbaAllListingData::find()->andWhere(['created_by' => $user->u_id])->all();
            $skuData = AppliedRepriserRule::find()->select(['arr_sku'])->where(['arr_user_id' => $userData->u_id])->column();

            foreach ($productData as $product) {
                $productBuyBox = \Yii::$app->api->getProductCompetitivePrice($product->seller_sku);
                $product->buybox_price = $productBuyBox;

                if(in_array($product->seller_sku, $skuData)) {
                    $magicPrice = \Yii::$app->api->getMagicRepricerPrice($product->seller_sku, $productBuyBox, $product->repricing_min_price, $product->repricing_max_price, $product->repricing_rule_id);
                    if($magicPrice) {
                        $product->repricing_cost_price = $magicPrice;
                    }
                }

                if ($product->save(false)) {
                    echo $product->asin1 . " is Updated.";
                }
                sleep(2);
            }
            sleep(1);
        }
    }

    public function actionSendPush()
    {
        $token = 'c2M61dmEkr4:APA91bH4lpEKegqxPIr07_sW6SDT4ArQPDgQeCu0Bb5GSrr57YUzvJ9Br697JuCEj1LjivlGzaANqUjc4Ld98U8W-9kILHnQlACUPL0S-ZcxrvruEUl24zmxpghOrI2wCW1wWuRDKBvD';
        $title = 'Congratulations! Your Amazon listing and order data are configured';
        $body = 'Your amazon listing and order data configured in your account. Now you can access your data from Price Genius.';
        if($token) {
            \Yii::$app->data->sendPushNotification($token, $title, $body);
        }
    }

    public function actionRequestDailyInventoryReport($id=null)
    {
        $time = strtotime("-5 day", time());
        $startDate = date("Y-m-d", $time);
        $endDate = date('Y-m-d');
        $userData = User::find()->andFilterWhere(['u_id' => $id])->andWhere(['IS NOT', 'u_mws_seller_id', null])->all();

        foreach ($userData as $user) {
            \Yii::$app->data->getMwsDetails($user->u_mws_seller_id, $user->u_mws_auth_token);

            $rr = \Yii::$app->api->requestReport('_GET_FBA_FULFILLMENT_CURRENT_INVENTORY_DATA_', $startDate, $endDate);
            if ($rr) {
                $model = new RequestedReport();
                $model->rr_report_request_id = $rr['ReportRequestId'];
                $model->rr_report_type = $rr['ReportType'];
                $model->rr_start_date = $rr['StartDate'];
                $model->rr_end_date = $rr['EndDate'];
                $model->rr_scheduled = $rr['Scheduled'];
                $model->rr_submitted_date = $rr['SubmittedDate'];
                $model->rr_report_processing_status = $rr['ReportProcessingStatus'];
                $model->created_by = $user->u_id;
                if ($model->save(false)) {
                    echo "Report Requested.";
                }
            }
            sleep(3);
        }
    }

    public function actionCheckStatus($id=null)
    {
        $userData = User::find()->andFilterWhere(['u_id' => $id])->andWhere(['IS NOT', 'u_mws_seller_id', null])->all();

        foreach ($userData as $user) {
            \Yii::$app->data->getMwsDetails($user->u_mws_seller_id, $user->u_mws_auth_token);

            $data = RequestedReport::find()->where(['IS', 'rr_report_id', null])->andWhere(['created_by' => $user->u_id])->all();

            foreach ($data as $r) {
                try {
                    $rr = \Yii::$app->api->getRequestedReports($r->rr_report_request_id);
                    if ($rr) {
                        $model = RequestedReport::findOne($r->rr_id);
                        $model->rr_report_id = ($rr['reportId']) ? $rr['reportId'] : null;
                        $model->rr_report_current_status = ($rr['reportStatus']) ? $rr['reportStatus'] : null;
                        $model->rr_report_processing_status = $rr['reportStatus'];
                        if ($model->save(false)) {
                            echo "Report Checked.";
                        }
                    }
                    sleep(3);
                } catch (\Exception $e) {
                    // Something else happened, completely unrelated to Stripe
                    echo $e->getMessage();
                }
            }
        }
    }

    public function actionGetDailyInventory($id=null)
    {
        $userData = User::find()->andFilterWhere(['u_id' => $id])->andWhere(['IS NOT', 'u_mws_seller_id', null])->all();

        foreach ($userData as $user) {
            \Yii::$app->data->getMwsDetails($user->u_mws_seller_id, $user->u_mws_auth_token);
            $modelData = RequestedReport::find()->where(['AND', ['IS NOT', 'rr_report_id', null], ['rr_report_type' => '_GET_FBA_FULFILLMENT_CURRENT_INVENTORY_DATA_'], ['rr_status' => 0], ['created_by' => $user->u_id]])->one();
            $reportId = ($modelData) ? $modelData->rr_report_id : null;
            if ($reportId) {
                $rr = \Yii::$app->api->getSettlementReport($reportId); //12246351550017854

                $remove = "\n";
                $split = explode($remove, $rr['data']);
                //$split = explode($remove, $rr);

                $array[] = null;
                $tab = "\t";

                foreach ($split as $string) {
                    $row = explode($tab, $string);
                    array_push($array, $row);
                }
                $array = array_filter($array);
                $tHead = $array[1];
                unset($array[1]);

                foreach ($array as $line) {
                    if (!array_filter($line))
                        continue;

                    $model = FbaDailyInventoryData::find()->andWhere(['sku' => $line[2], 'snapshot_date' => $line[0]])->one();
                    if (!$model) {
                        $model = new FbaDailyInventoryData();
                    }
                    $model->snapshot_date = utf8_encode($line[0]);
                    $model->fnsku = (key_exists(1, $line)) ? $line[1] : null;
                    $model->sku = (key_exists(2, $line)) ? $line[2] : null;
                    $model->product_name = (key_exists(3, $line)) ? $line[3] : null;
                    $model->quantity = (key_exists(4, $line)) ? $line[4] : null;
                    $model->fulfillment_center_id = (key_exists(5, $line)) ? $line[5] : null;
                    $model->detailed_disposition = (key_exists(6, $line)) ? $line[6] : null;
                    $model->country = (key_exists(7, $line)) ? $line[7] : null;
                    $model->fdid_date = date('Y-m-d');
                    $model->created_by = $user->u_id;
                    $model->updated_by = $user->u_id;
                    $model->created_at = time();
                    $model->updated_at = time();
                    $model->save(false);
                }

                $modelData->rr_status = 1;
                $modelData->save(false);
            }
        }
    }

    /**
     * Get Daily Inventory Data (Method)
     */
    public function getDailyInventory($id=null)
    {
        $userData = User::find()->andWhere(['u_id' => $id])->andWhere(['IS NOT', 'u_mws_seller_id', null])->all();

        foreach ($userData as $user) {
            \Yii::$app->data->getMwsDetails($user->u_mws_seller_id, $user->u_mws_auth_token);

            $reportIdData = \Yii::$app->api->getDailyInventoryReportList(true);
            $reportId = ($reportIdData) ? $reportIdData[0]['ReportId'] : null;

            if ($reportId) {
                $rr = \Yii::$app->api->getDailyInventoryReport($reportId); //12246351550017854

                $remove = "\n";
                $split = explode($remove, $rr['data']);
                //$split = explode($remove, $rr);

                $array[] = null;
                $tab = "\t";

                foreach ($split as $string) {
                    $row = explode($tab, $string);
                    array_push($array, $row);
                }
                $array = array_filter($array);
                $tHead = $array[1];
                unset($array[1]);

                foreach ($array as $line) {
                    if (!array_filter($line))
                        continue;

                    $model = FbaDailyInventoryData::find()->andWhere(['created_by' => $user->u_id, 'sku' => $line[2], 'snapshot_date' => $line[0]])->one();
                    if (!$model) {
                        $model = new FbaDailyInventoryData();
                    }
                    $model->snapshot_date = utf8_encode($line[0]);
                    $model->fnsku = (key_exists(1, $line)) ? $line[1] : null;
                    $model->sku = (key_exists(2, $line)) ? $line[2] : null;
                    $model->product_name = (key_exists(3, $line)) ? $line[3] : null;
                    $model->quantity = (key_exists(4, $line)) ? $line[4] : null;
                    $model->fulfillment_center_id = (key_exists(5, $line)) ? $line[5] : null;
                    $model->detailed_disposition = (key_exists(6, $line)) ? $line[6] : null;
                    $model->country = (key_exists(7, $line)) ? $line[7] : null;
                    $model->fdid_date = date('Y-m-d');
                    $model->created_by = $user->u_id;
                    $model->save(false);
                }
            }
        }
    }

    public function actionGetReceivedInventoryData()
    {
        $reportIdData = \Yii::$app->api->getReceivedInventoryReportList(true);
        $reportId = ($reportIdData) ? $reportIdData[0]['ReportId'] : null;

        if($reportId) {
            $rr = \Yii::$app->api->getReceivedInventoryReport($reportId); //12246351550017854

            $remove = "\n";
            $split = explode($remove, $rr['data']);
            //$split = explode($remove, $rr);

            $array[] = null;
            $tab = "\t";

            foreach ($split as $string) {
                $row = explode($tab, $string);
                array_push($array, $row);
            }
            $array = array_filter($array);
            $tHead = $array[1];
            unset($array[1]);

            foreach ($array as $line) {
                if (!array_filter($line))
                    continue;

                $model = FbaReceivedInventoryData::find()->andWhere(['sku' => $line[2], 'received_date' => $line[0]])->one();
                if(!$model) {
                    $model = new FbaReceivedInventoryData();
                }

                $model->received_date = $line[0];
                $model->fnsku = (key_exists(1, $line)) ? $line[1] : null;
                $model->sku = (key_exists(2, $line)) ? $line[2] : null;
                $model->product_name = (key_exists(3, $line)) ? utf8_encode($line[3]) : null;
                $model->quantity = (key_exists(4, $line)) ? utf8_encode($line[4]) : null;
                $model->fba_shipment_id = (key_exists(5, $line)) ? $line[5] : null;
                $model->fulfillment_center_id = (key_exists(6, $line)) ? $line[6] : null;
                $model->frid_date = date('Y-m-d');
                if($model->save(false)) {
                    echo "Received Inventory Data Saved.";
                }
            }
        }
    }

    /**
     * Get Received Inventory Data (Method)
     */
    public function getReceivedInventoryData($id=null)
    {
        $userData = User::find()->andWhere(['u_id' => $id])->andWhere(['IS NOT', 'u_mws_seller_id', null])->all();

        foreach ($userData as $user) {
            \Yii::$app->data->getMwsDetails($user->u_mws_seller_id, $user->u_mws_auth_token);

            $reportIdData = \Yii::$app->api->getReceivedInventoryReportList(true);
            $reportId = ($reportIdData) ? $reportIdData[0]['ReportId'] : null;

            if ($reportId) {
                $rr = \Yii::$app->api->getReceivedInventoryReport($reportId); //12246351550017854

                $remove = "\n";
                $split = explode($remove, $rr['data']);
                //$split = explode($remove, $rr);

                $array[] = null;
                $tab = "\t";

                foreach ($split as $string) {
                    $row = explode($tab, $string);
                    array_push($array, $row);
                }
                $array = array_filter($array);
                $tHead = $array[1];
                unset($array[1]);

                foreach ($array as $line) {
                    if (!array_filter($line))
                        continue;

                    $model = FbaReceivedInventoryData::find()->andWhere(['created_by' => $user->u_id, 'sku' => $line[2], 'received_date' => $line[0]])->one();
                    if (!$model) {
                        $model = new FbaReceivedInventoryData();
                    }

                    $model->received_date = $line[0];
                    $model->fnsku = (key_exists(1, $line)) ? $line[1] : null;
                    $model->sku = (key_exists(2, $line)) ? $line[2] : null;
                    $model->product_name = (key_exists(3, $line)) ? utf8_encode($line[3]) : null;
                    $model->quantity = (key_exists(4, $line)) ? utf8_encode($line[4]) : null;
                    $model->fba_shipment_id = (key_exists(5, $line)) ? $line[5] : null;
                    $model->fulfillment_center_id = (key_exists(6, $line)) ? $line[6] : null;
                    $model->frid_date = date('Y-m-d');
                    $model->created_by = $user->u_id;
                    if ($model->save(false)) {
                        echo "Received Inventory Data Saved.";
                    }
                }
            }
        }
    }

    public function actionSetDate()
    {
        $models = ItemChargeListData::find()->all();

        foreach ($models as $model) {
            $orderData = ShipmentRefundEventData::find()->andWhere(['sred_amazon_order_id' => $model->icld_amazon_order_id])->one();
            if($orderData) {
                $model->icld_shipment_date = $orderData->sred_shipment_posted_date;
                $model->icld_refund_date = $orderData->sred_refund_posted_date;
                if($model->save(false))
                    echo 'Saved.';
            }
        }
    }

    protected function trim_value(&$value)
    {
        $value = trim($value);
        $value = preg_replace('/\s+/', ' ', $value);

        return $value;
    }
}
