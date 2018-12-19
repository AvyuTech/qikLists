<?php
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Home';
$this->registerCss("
section.pricing .price li, section.pricing .price li {
    padding: 2px;
    font-size: 13px;
}
section.pricing .price .header, section.pricing .price .gray {
    padding:25px !important; 
}
.iconbox-center {
    padding:15px;
}
section.testimonials .testimonials-holder figcaption:before {
    border-color: transparent transparent transparent #fff;
}
section.testimonials .testimonials-holder figcaption {
    background-color: #fff;    
}
");

if(Yii::$app->request->get('status')) {
    $this->registerJs('alert("Thank you for contacting for Customized services plan. After reviewing your needs we will contact you.")');
}
$disCoupon = (\Yii::$app->request->get('coupon') || Yii::$app->request->cookies['idevId']) ? \Yii::$app->request->get('coupon') : null;
$iDevId = (\Yii::$app->request->get('idev_id')) ?  \Yii::$app->request->get('idev_id') : ((Yii::$app->request->cookies['idevId']) ? (string)Yii::$app->request->cookies['idevId'] : null);
$affId = (\Yii::$app->request->get('affId')) ?  \Yii::$app->request->get('affId') : ((Yii::$app->request->cookies['affId']) ? (string)Yii::$app->request->cookies['affId'] : null);
$btnTitle = (!Yii::$app->user->isGuest) ? 'Switch' : 'Select';
?>

<section class="about-introduction bg-gray ptb-50" id="about-us">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <?= \dmstr\widgets\Alert::widget(); ?>
            </div>
        </div>
        <div class="row">
            <div class="super-title">
                <h2>Meet The Team</h2>
                <div class="seperator"></div>
                <p></p>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <p>
                    Quincy and Scott were first introduced by one of the original FBA Community sages, Bob Wiley. Bob had helped Quincy launch his shoe sourcing list service.
                    Scott signed up for one of Quincy's shoe lists and got to see qualify of Quincy's training and other Seller services. During that same time period, Scott was consulting and serving Amazon Sellers through FeedbackRepair.com.
                </p>
                <!--<div class="about-image ptb-10">
                    <img src="<?php /*= Yii::getAlias('@web'); */?>/images/about.jpg" class="img-responsive" alt="image">
                </div>-->
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="featured-content">
                    <p>
                        During Q4 of 2016, when Quincy's Seller account was suspended, he reached out to Scott for help with the reinstatement. That was the catalyst behind further conversations about helping other Sellers avoid suspensions. They created a full suite of essential services for account maintenance and account health.
                        AccountDr was born to bring account management best practices to Sellers. We look forward to helping you grow and maintain your account.
                    </p>
                </div>
            </div>
        </div>
    </div><!-- End Container -->
</section>

<section class="testimonials bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <figure class="testimonials-holder">
                    <figcaption><img src="<?= Yii::getAlias('@web'); ?>/images/quincy.png" alt="profile" class="profile">
                        <blockquote style="font-style: normal;">
                            Like many Amazon 3rd party Sellers, Quincy started selling on Amazon on the side while holding down a demanding full-time job.
                            After 18 years as a hardware engineer at tech companies in Silicon Valley, Quincy decided to leave the corporate world in April of 2014 to go full-time into Amazon FBA.
                            By March of 2015, Quincy expanded from selling to begin serving Amazon Sellers. He launched his well-known shoe sourcing service, GatedList.com.
                            Quincy has since built multiple software tools and services to deliver additional sourcing efficiencies. Among them are QikFlips.com,
                            a fully automated sourcing tool for Amazon to Amazon flips. Another app, QikBulk.com, helps Sellers quickly build lists of profitable leads.
                            Quincy is passionate about business efficiency, software automation, building teams, and serving customers.
                            &nbsp;&nbsp;
                        </blockquote>
                    </figcaption>
                    <h3>QUINCY LIN<span>Co-Founder</span></h3>
                </figure>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <figure class="testimonials-holder">
                    <figcaption><img src="<?= Yii::getAlias('@web'); ?>/images/scott.jpg" alt="profile" class="profile">
                        <blockquote style="font-style: normal;">
                            Scott began his career working on a Congressional staff on Capitol Hill. After that, he managed the daily operations of a small company of 40 employees, becoming the COO.
                            Like Quincy and many other Amazon Sellers, Scott began selling on Amazon for the part-time revenue stream, starting in 2012. In 2012 and 2013, he was in the top 25% of Amazon sellers for Q4 and in the top 10% for Q4 of 2014.
                            By the end of 2014, Scott left his job of 15 years, heading to sell online full-time. He also began providing consulting and other services via Feedbackrepair.com, SourcingIntel.com, CategoryUngating.com, and EcomSellerTools.com.
                            His passion is in helping others and in guiding them through the unique challenges and opportunities of the ecommerce landscape.
                            <br/>
                            <br/>
                        </blockquote>
                    </figcaption>
                    <h3>SCOTT MARGOLIUS<span>Co-Founder</span></h3>
                </figure>
            </div>
        </div>
    </div><!-- End Container -->
</section><!-- End Section -->


<section class="ptb-100 pricing bg-white" id="pricing">
    <div class="container" style="width: 95%">
        <div class="row">
            <div class="super-title">
                <h2>Pricing Plans</h2>
                <div class="seperator"></div>
                <p>Choose your plan</p>
            </div>
            <div class="col-sm-2" style="padding-right: 5px;">
                <ul class="price">
                    <li class="header"><h4>Reimbursement Calculator</h4></li>
                    <li style="padding: 14px">&nbsp;</li>
                    <li style="padding: 14px">&nbsp;</li>
                    <li class="grey"><span>Free</span> </li>
                    <li>No Credit Card Needed</li>
                    <li>Free Registration Required</li>
                    <li>Retro up to 18 Months</li>
                    <li>Replace Manual Data Analysis</li>
                    <li>Accurate & Comprehensive</li>
                    <li>New Reimbursement Alerts</li>
                    <li>Total Reimbursements in Summary Report Format</li>
                    <li><b>Reimbursements Cover:</b></li>
                    <li>Lost / Damaged / Destroyed Inventory</li>
                    <li>Refunded Items Never Return To Inventory</li>
                    <li>Inbound FBA Shipments Discrepancy</li>
                    <li>Extra Customer Concessions</li>
                    <li>Returns Over 30 days</li>
                    <li>Exchange & Replacement Double Dips</li>
                    <li>Non-compliant Customer Returns</li>
                    <li>Referral Fees Discrepancy</li>
                    <li>Shipping Fees Overcharges</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li class="no-hover" style="padding: 8px;">
                        <?php
                        if(!Yii::$app->user->isGuest && (Yii::$app->user->identity->u_sub_plan == 'free' || empty(Yii::$app->user->identity->u_cust_id))) {
                            echo Html::a('Current Plan', '#', ['class' => 'btn btn-primary']);
                        } else {
                            echo Html::a($btnTitle, (!Yii::$app->user->isGuest) ? ['/user/upgrade-sub', 'id' => Yii::$app->user->identity->u_id, 'discount' => $disCoupon] : ['/site/get-plan', 'affiltId' => $iDevId, 'affId' => $affId, 'plan' => 'free', 'price' => '0'], [
                                'class' => 'btn btn-primary',
                            ]);
                        } ?>
                    </li>
                </ul>
            </div>
            <div class="col-sm-4" style="padding-right: 5px;">
                <ul class="price">
                    <li class="header"><h4>Reimbursement <br/>Maximizer</h4></li>
                </ul>
                <div class="col-sm-6" style="padding-left: 0;padding-right: 1px;">
                    <ul class="price">
                        <li class="" style="padding: 20px;border-bottom: 1px solid #eee;"><h5><b>Do-It-Yourself (DIY)</b></h5></li>
                        <li style="padding: 14px">&nbsp;</li>
                        <li class="grey"><span>15%</span> </li>
                        <li>Only on Recovered Reimbursements Using Our Software</li>
                        <li>Our Software Identifies All Reimbursements</li>
                        <li>Retro up to 18 Months</li>
                        <li>Instructions on Opening Reimbursement Cases</li>
                        <li>Clients Manually Open & Follow Through All Reimbursement Cases</li>
                        <li>VA Access Management</li>
                        <li>Reports</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li style="padding: 6px;">&nbsp;</li>
                        <li class="no-hover" style="padding: 8px;">
                            <?php
                            if(!Yii::$app->user->isGuest && (Yii::$app->user->identity->u_sub_plan == 'free' || empty(Yii::$app->user->identity->u_cust_id))) {
                                echo Html::a('Current Plan', '#', ['class' => 'btn btn-primary']);
                            } else {
                                echo Html::a($btnTitle, (!Yii::$app->user->isGuest) ? ['/user/upgrade-sub', 'id' => Yii::$app->user->identity->u_id, 'discount' => $disCoupon] : ['/site/get-plan', 'affiltId' => $iDevId, 'affId' => $affId, 'plan' => 'free', 'price' => '0'], [
                                    'class' => 'btn btn-primary',
                                ]);
                            } ?>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6" style="padding-right: 0;padding-left: 1px;">
                    <ul class="price">
                        <li class="" style="padding: 20px;border-bottom: 1px solid #eee;"><h5><b>Done-For-You (DFY)</b></h5></li>
                        <li style="padding: 14px">&nbsp;</li>
                        <li class="grey"><span>25%</span> </li>
                        <li>Only on Recovered Reimbursements Using Our Software</li>
                        <li>Our Software Identifies All Reimbursements</li>
                        <li>Dedicated Account Manager</li>
                        <li>We Manually Open & Follow Through All Reimbursement Cases</li>
                        <li>We Work with Clients to Obtain Documentations Deem Necessary for Reimbursements</li>
                        <li>Reports</li>
                        <li><b>Plus:</b></li>
                        <li>Account Monitor Subscription Included</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li style="padding: 9px">&nbsp;</li>
                        <li class="no-hover" style="padding: 8px;">
                            <?php
                            if(!Yii::$app->user->isGuest && (Yii::$app->user->identity->u_sub_plan == 'free' || empty(Yii::$app->user->identity->u_cust_id))) {
                                echo Html::a('Current Plan', '#', ['class' => 'btn btn-primary']);
                            } else {
                                echo Html::a($btnTitle, (!Yii::$app->user->isGuest) ? ['/user/upgrade-sub', 'id' => Yii::$app->user->identity->u_id, 'discount' => $disCoupon] : ['/site/get-plan', 'affiltId' => $iDevId, 'affId' => $affId, 'plan' => 'free', 'price' => '0'], [
                                    'class' => 'btn btn-primary',
                                ]);
                            } ?>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-2" style="padding-right: 5px;">
                <ul class="price">
                    <li class="header"><h4>ACCOUNT MONITORING</h4></li>
                    <li style="padding: 14px">&nbsp;</li>
                    <li style="padding: 12px">
                        <?= Html::dropDownList('am_tier', null, ['' => '--- Please Select ---', '2148' => 'Average 3-month sales up to $100K: $2148/yr ($179 /mo)'], ['class' => 'form-control']); ?>
                    </li>
                    <li class="grey"><span>$179</span></li>
                    <li>Yearly Only</li>
                    <li>One-month Free Trial</li>
                    <li>Monitor All Active SKUs, 24x7</li>
                    <li>Database for All Notifications</li>
                    <li><b>Receive Email Alerts on:</b></li>
                    <li>ASIN Changes Notifications</li>
                    <li>Performance Notifications</li>
                    <li>Account Health Metrics Notifications</li>
                    <li>Negative Seller Feedback Notifications</li>
                    <li>Suppressed Inventory Notifications</li>
                    <li>Stranded Inventory Notifications</li>
                    <li>Inbound Shipment Discrepancy Notifications</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li class="no-hover" style="padding: 8px;">
                        <?php
                        if(!Yii::$app->user->isGuest && (Yii::$app->user->identity->u_sub_plan == 'free' || empty(Yii::$app->user->identity->u_cust_id))) {
                            echo Html::a('Current Plan', '#', ['class' => 'btn btn-primary']);
                        } else {
                            echo Html::a($btnTitle, (!Yii::$app->user->isGuest) ? ['/user/upgrade-sub', 'id' => Yii::$app->user->identity->u_id, 'discount' => $disCoupon] : ['/site/get-plan', 'affiltId' => $iDevId, 'affId' => $affId, 'plan' => 'ACCOUNT-MONITORING', 'price' => '12'], [
                                'class' => 'btn btn-primary',
                            ]);
                        } ?>
                    </li>
                </ul>
            </div>
            <div class="col-sm-2" style="padding-right: 5px;">
                <ul class="price">
                    <li class="header"><h4>COMPREHENSIVE SERVICES </h4></li>
                    <li class="" style="padding: 20px"><h5><b>Monthly | Yearly</b></h5></li>
                    <li style="padding: 12px">
                        <?= Html::dropDownList('am_tier', null, ['' => '--- Please Select ---', '4788' => 'Average 3-month sales up to $100K: $4788/yr ($399 /mo)'], ['class' => 'form-control']); ?>
                    </li>
                    <li class="grey"><span>$399 | $3990</span></li>
                    <li>Up to $100K in Monthly Sales</li>
                    <li>Account Health Checkup Overview ($250 value)</li>
                    <li>Account Monitor Subscription Included</li>
                    <li>Dedicated Account Manager</li>
                    <li>ASIN Changes Notifications Monitoring & Resolution</li>
                    <li>Performance Notifications Monitoring & Management</li>
                    <li>FBA Customer Returns (Deep Dive Analysis)</li>
                    <li>Negative Seller Feedback Removal</li>
                    <li>Suppressed Listings Resolution</li>
                    <li>Stranded Inventory Management</li>
                    <li>Unfulfillable Inventory Disposition Management</li>
                    <li>FBA Customer Returns Comments Assessment (Keyword Monitoring)</li>
                    <li>FBA Customer Inquiries Management</li>
                    <li>25% Discount on ASIN / Account Reinstatement (after 3 Months)</li>
                    <li>"Two Months Free" for <b>Yearly plan</b></li>
                    <li><b>Reimbursement Discounts:</b></li>
                    <li>DIY Plan: 10% (vs. 15%)</li>
                    <li>DFY Plan: 20% (vs. 25%)</li>
                    <li style="height: 27px;">&nbsp;</li>
                    <li class="no-hover" style="padding: 8px;">
                        <?php
                        if(!Yii::$app->user->isGuest && (Yii::$app->user->identity->u_sub_plan == 'free' || empty(Yii::$app->user->identity->u_cust_id))) {
                            echo Html::a('Current Plan', '#', ['class' => 'btn btn-primary']);
                        } else {
                            echo Html::a($btnTitle, (!Yii::$app->user->isGuest) ? ['/user/upgrade-sub', 'id' => Yii::$app->user->identity->u_id, 'discount' => $disCoupon] : ['/site/get-plan', 'affiltId' => $iDevId, 'affId' => $affId, 'plan' => 'COMPREHENSIVE-SERVICES', 'price' => '399'], [
                                'class' => 'btn btn-primary',
                            ]);
                        } ?>
                    </li>
                </ul>
            </div>
            <div class="col-sm-2">
                <ul class="price">
                    <li class="header"><h4>Customized Services</h4></li>
                    <li style="padding: 14px">&nbsp;</li>
                    <li style="padding: 14px">&nbsp;</li>
                    <li class="grey"><span>Contact Us</span> </li>
                    <li>Custom Quotes</li>
                    <li>FULL Account Health Assessment</li>
                    <li>Seller-At-Fault Negative Feedback Resolution</li>
                    <li>ASIN Suspension Reinstatement</li>
                    <li>Account Suspension Reinstatement</li>
                    <li>IP & Trademark Rights Holder Infringement Claims Resolution</li>
                    <li>Safety & Inauthentic Complaints</li>
                    <li>Category Ungating</li>
                    <li>Brand Registry</li>
                    <li>MAP Management</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li style="padding: 5px;">&nbsp;</li>
                    <li class="no-hover" style="padding: 8px;">
                        <?php
                            echo Html::a('Contact Us', ['/site/custom-services'], ['class' => 'btn btn-info popupCpModal']);
                        /*if(!Yii::$app->user->isGuest && (Yii::$app->user->identity->u_sub_plan == 'free' || empty(Yii::$app->user->identity->u_cust_id))) {
                            echo Html::a('Current Plan', '#', ['class' => 'btn btn-primary']);
                        } else {
                            echo Html::a($btnTitle, (!Yii::$app->user->isGuest) ? ['/user/upgrade-sub', 'id' => Yii::$app->user->identity->u_id, 'discount' => $disCoupon] : ['/site/get-plan', 'affiltId' => $iDevId, 'affId' => $affId, 'plan' => 'RISK-MINIMIZER', 'price' => '149'], [
                                'class' => 'btn btn-primary',
                            ]);
                        }*/ ?>
                    </li>
                </ul>
            </div>
        </div>
    </div><!-- End Container -->
</section><!-- End Section -->

<!-- ==============================================
             **TESTIMONIALS**
=============================================== -->
<section class="block-style-comment ptb-80" id="testimonials">
    <div class="container">
        <div class="row">
            <div class="super-title">
                <h2>Testimonials</h2>
                <div class="seperator"></div>
                <p>What Clients are Saying</p>
            </div>
        </div>
        <div class="row ptb-20">
            <div class="col-md-2 col-sm-3 col-xs-12">
                <img src="<?= Yii::getAlias('@web'); ?>/images/person1.png" class="img-responsive img-circle" alt="image">
            </div>
            <div class="col-md-10 col-sm-9 col-xs-12">
                <blockquote>
                    <p>AccountDr takes the hassle out of needing to chase down reimbursements, feedback removal and other account maintenance chores. Best of all, reporting is simple and easy to review to ensure you know results fast. </p>
                    <footer>RYAN YAPLE</footer>
                </blockquote>
            </div>
        </div>
        <div class="row ptb-20">
            <div class="col-md-2 col-sm-3 col-xs-12">
                <img src="<?= Yii::getAlias('@web'); ?>/images/person2.png" class="img-responsive img-circle" alt="image">
            </div>
            <div class="col-md-10 col-sm-9 col-xs-12">
                <blockquote>
                    <p>I had been using few similar services in the past, but none comes close to the level of service offered by AccountDr. Their all-in-one service is something that no one else out there provides. Thank you so much for the exceptional services. </p>
                    <footer>ANDRIE LESMANA</footer>
                </blockquote>
            </div>
        </div>
        <div class="row ptb-20">
            <div class="col-md-2 col-sm-3 col-xs-12">
                <img src="<?= Yii::getAlias('@web'); ?>/images/person3.png" class="img-responsive img-circle" alt="image">
            </div>
            <div class="col-md-10 col-sm-9 col-xs-12">
                <blockquote>
                    <p>Account Dr's service is a must for any seller. It's AWESOME to have professionals always monitoring reviews, ensuring Amazon isn't stealing my inventory, and monitoring my inventory. I LOVE that Quincy and Scott are actual AZ sellers. This ensures that they know what is happening in the AZ marketplace. If you value your time and selling on AZ, then you need Account Dr. </p>
                    <footer>TREVOR GERE</footer>
                </blockquote>
            </div>
        </div>
    </div><!-- End Container -->
</section>
<!-- ==============================================
             **SERVICES**
=============================================== -->
<section class="about-features ptb-100 bg-gray" id="services">
    <div class="container">
        <div class="row">
            <div class="super-title">
                <h2>Our services</h2>
                <div class="seperator"></div>
                <p>Anything you don’t see listed? Ask about consulting and services tailored to your needs.</p>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="iconbox-center">
                        <div class="icon">
                            <span class="ti-agenda"></span>
                        </div>
                        <h4>Negative and Neutral Feedback Removal</h4>
                        <p class="text-left">In partnership with the experts at Feedbackrepair.com, feedback is reviewed and cases for removal are created. Appeals will be sent if Amazon denies the initial removal request.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="iconbox-center">
                        <div class="icon">
                            <span class="ti-cloud"></span>
                        </div>
                        <h4>Monitoring Customer Returns and Refunds</h4>
                        <p class="text-left">We manually file for all reimbursements. We keep particular record of buyer refunds issued by Amazon when the items are never received back to Inventory. Additionally, we monitor product categories for Health, Beauty and Grocery items that should not be eligible for returns.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="iconbox-center">
                        <div class="icon">
                            <span class="ti-support"></span>
                        </div>
                        <h4>Lost/Damaged/Destroyed items Reconciliation</h4>
                        <p class="text-left">We manually open cases and facilitate reimbursements for lost, damaged and destroyed.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="iconbox-center">
                        <div class="icon">
                            <span class="ti-agenda"></span>
                        </div>
                        <h4>Suppressed Listings Resolution</h4>
                        <p class="text-left">We resolve Suppressed ASIN’s to ensure items are available for sale (ensuring items meet Amazon’s required standards). Possible steps included: image editing, image uploading, adding product description and bullet points, researching and completing required product details which were missing when the listing was created/uploaded, etc.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="iconbox-center">
                        <div class="icon">
                            <span class="ti-cloud"></span>
                        </div>
                        <h4>Fixing Stranded Inventory</h4>
                        <p class="text-left">Our team makes listings active. As appropriate, we may also: create removal orders, convert to FBA, create new listings, etc. Usually these steps are related to the reasons an ASIN was stranded as well as a client’s specific preferences and instructions.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="iconbox-center">
                        <div class="icon">
                            <span class="ti-support"></span>
                        </div>
                        <h4>Reconciliation of Shipping Queue</h4>
                        <p class="text-left">We create cases for shipment reconciliation. Our goal is to ensure items lost during inbound receiving are found or your account is properly credited. We identify discrepancies and attempt to secure reimbursements or inventory adjustments.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="iconbox-center">
                        <div class="icon">
                            <span class="ti-agenda"></span>
                        </div>
                        <h4>Removing Unfulfillable Inventory</h4>
                        <p class="text-left">We open cases for Defective items, Customer Damaged or Expired items removal. These steps are customized to the preferences and instructions of each client. We also secure reimbursements for Warehouse Damaged, Carrier Damaged and Distributor Damaged items.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="iconbox-center">
                        <div class="icon">
                            <span class="ti-cloud"></span>
                        </div>
                        <h4>Monitoring Partially Reimbursed "Customer Refunds"</h4>
                        <p class="text-left">We request reimbursement for the discrepancies.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="iconbox-center">
                        <div class="icon">
                            <span class="ti-support"></span>
                        </div>
                        <h4>Monthly Summary Reporting</h4>
                        <p class="text-left">In addition to the Weekly Summaries, AccountDr clients receive reports reflecting Customer Returns and Partial Returns, Lost/Damaged/Destroyed, Total Reimbursements and Feedback Removal reports.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="iconbox-center">
                        <div class="icon">
                            <span class="ti-cloud"></span>
                        </div>
                        <h4>Weekly Summary Reporting</h4>
                        <p class="text-left">AccountDr clients receive reports reflecting Shipping Queues, Stranded items and Unfulfillable Inventory details.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                </div>
            </div>
        </div>
    </div><!-- End Container -->
</section><!-- End Section -->

<?php
yii\bootstrap\Modal::begin(['id' =>'modalCp', 'header' => 'Loading....', 'size' => \yii\bootstrap\Modal::SIZE_DEFAULT]);
?>
    <div class="row">
        <div class="col-sm-12 col-xs-12 text-center">
            <i class="fa fa-spinner fa-spin fa-2x"></i>
        </div>
    </div>
<?php
yii\bootstrap\Modal::end();
?>
<?php
$this->registerJs("$(function() {
   $('.popupCpModal').click(function(e) {
     e.preventDefault();
     $('#modalCp').modal('show').find('.modal-content')
     .load($(this).attr('href'));
   });
   
    $('.modal').on('hidden.bs.modal', function(){ 
        $('.modal-body').html('<i class=\"fa fa-spinner fa-spin fa-2x\"></i>');
    });
});
");
?>