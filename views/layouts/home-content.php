<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

?>

<?= $content ?>

<!-- ==============================================
                     **FOOTER STARTS**
=============================================== -->
<footer id="footer" class="dark-footer">
    <div class="main-footer ptb-50">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-6 col-xs-12">
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <h3>Our Address</h3>
                    <div class="contact-widget">
                        <div class="contact-item clearfix">
                            <span class="ti-location-pin"></span>
                            <p><strong>7100 Stevenson Blvd</strong><br>Fremont, CA 94538</p>
                        </div>
                        <div class="contact-item clearfix">
                            <span class="ti-email"></span>
                            <p>quincy@accountdr.com</p>
                        </div>
                        <div class="contact-item clearfix">
                            <span class="ti-world"></span>
                            <p>www.accountdr.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12">
                    <h3>Resources</h3>
                    <ul class="footer-navigation-widget">
                        <li><a href="<?= \yii\helpers\Url::to(['/site/terms-of-use']); ?>">Terms of Use</a></li>
                    </ul>
                </div>
            </div>
        </div><!-- End Container -->
    </div><!-- End Main Footer -->
    <div class="footer-bottom ptb-20 paraxify">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12 copyright">
                    &COPY; <?= date('Y'); ?> Account Doctor. All Rights are Reserved.
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 footer-logo text-center">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 back-to-top">
                    <a href="#top" id="back-top"><span class="ti-arrow-circle-up"></span></a>
                </div>
            </div>
        </div><!-- End Container -->
    </div><!-- End Bottom Footer -->
</footer><!-- End Footer -->
