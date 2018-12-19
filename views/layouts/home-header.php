<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this \yii\web\View */
/* @var $content string */

$this->registerJs('
   $(document).ready(function(){
        $("a.page-scroll").click(function(e) {
            e.preventDefault();
            var targetDiv = $(this).attr(\'href\');
            $(\'html, body\').animate({
                scrollTop: $(targetDiv).offset().top
            }, 2000);
        });
        
        $(\'.video-bg\').vide("'.Yii::getAlias("@web").'/videos/videobg.webm");
   });
');
$this->registerCss('
header.video-bg, header.slider-bg {
    background-color: rgba(1, 1, 1, 0);
}
');
$actionArray = ['blog', 'get-plan'];

/*
 *
 * <div class="video-wrap" style="">
        <video id="bg-vd" loop autoplay muted preload="auto" poster="<?= Yii::getAlias('@web');?>/videos/poster.png" style="margin: auto; position: absolute; z-index: -1; top: 0%; left: 0%; transform: translate(0%, 0%); visibility: visible; opacity: 1; width: 1840px; height: auto;">
            <source src="<?= Yii::getAlias('@web');?>/videos/videobg.mp4" type="video/mp4">
            <source src="<?= Yii::getAlias('@web');?>/videos/videobg.webm" type="video/webm">
            <source src="<?= Yii::getAlias('@web');?>/videos/videobg.ogv" type="video/ogg">
        </video>
    </div>
 * */
?>
<!-- ==============================================
                     **MAIN HEADER**
        =============================================== -->
<!--<header class="header-wrapper slider-bg">-->
<header class="header-wrapper video-bg" data-vide-bg="mp4: <?= Yii::getAlias('@web'); ?>/videos/videobg.mp4, webm: <?= Yii::getAlias('@web'); ?>/videos/videobg.webm, ogv: <?= Yii::getAlias('@web'); ?>/videos/videobg.ogv, poster: <?= Yii::getAlias('@web'); ?>/videos/poster.jpg" data-vide-options="loop: true, muted: false, position: 0% 0%">
    <nav class="navbar navbar-default navbar-fixed white bootsnav"> <!-- no-background -->
        <!-- Start Top Search -->
        <div class="top-search">
            <div class="container">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                </div>
            </div>
        </div>
        <!-- End Top Search -->
        <div class="container-fluid">
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="<?= Yii::$app->homeUrl; ?>">
                    <img src="<?= Yii::getAlias('@web'); ?>/images/logo.png" class="logo logo-display" alt="">
                    <img src="<?= Yii::getAlias('@web'); ?>/images/logo.png" class="logo logo-scrolled" alt="">
                </a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">

                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">

                    <li><a href="<?= Yii::$app->homeUrl; ?>" >Home</a></li>
                    <li>
                        <?php
                            if(in_array($this->context->action->id, $actionArray)) {
                        ?>
                                <a href="<?= Url::to(['/#about-us']); ?>" class="no-page-scroll">About Us</a>
                        <?php } else { ?>
                                <a href="#about-us" class="page-scroll">About Us</a>
                        <?php } ?>
                    </li>
                    <li>
                        <?php
                        if(in_array($this->context->action->id, $actionArray)) {
                            ?>
                            <a href="<?= Url::to(['/#pricing']); ?>" class="no-page-scroll">Pricing</a>
                        <?php } else { ?>
                            <a href="#pricing" class="page-scroll">Pricing</a>
                        <?php } ?>
                    </li>
                    <li>
                        <?php
                        if(in_array($this->context->action->id, $actionArray)) {
                            ?>
                            <a href="<?= Url::to(['/#testimonials']); ?>" class="no-page-scroll">Testimonials</a>
                        <?php } else { ?>
                            <a href="#testimonials" class="page-scroll">Testimonials</a>
                        <?php } ?>
                    </li>
                    <li>
                        <?php
                        if(in_array($this->context->action->id, $actionArray)) {
                            ?>
                            <a href="<?= Url::to(['/#services']); ?>" class="no-page-scroll">Services</a>
                        <?php } else { ?>
                            <a href="#services" class="page-scroll">Services</a>
                        <?php } ?>
                    </li>
                    <li><a href="https://accountdr.freshdesk.com/">Support</a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['/site/blog']); ?>">Blog</a></li>
                    <?php if(Yii::$app->user->isGuest) { ?>
                        <li><a href="#">SignUp</a></li>
                        <li><?= Html::a('Sign in', ['/site/login'], ['class' => '']);?></li>
                    <?php } else { ?>
                        <li><?= Html::a('<strong>Dashboard</strong> ( '.Yii::$app->user->identity->u_name.' )', ['/site/index'], ['class' => '', 'title' => 'Go to Dashboard']);?></li>
                        <li><?= Html::a('Logout', ['/site/logout'], ['data-method' => 'post', 'class' => '', 'title' => 'Logout']); ?></li>
                    <?php }?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- End Container-->
    </nav>
    <!-- End Navigation -->

    <?php
        if(Yii::$app->controller->action->id == 'home') {
    ?>
        <div class="container-fluid" style="height: 820px;">
            <div class="row banner-content">
                <div class="banner-meta">
                    <h1></h1>
                    <p class="lead"></p>
                </div>
                <span class="banner-image">
                    <!--<img src="<?/*= Yii::getAlias('@web'); */?>/images/web-app.png" alt="image" class="img-responsive">-->
                </span>
            </div>
        </div><!-- End Container -->
    <?php } ?>
</header><!-- End Header -->

<?php
if(Yii::$app->controller->action->id != 'home') {
?>
<section class="main-banner paraxify banner-image-1 ptb-100" style="background-position: center -67.2px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-banner-content text-center">
                    <h2><?= $this->title; ?></h2>
                    <p></p>
                </div>
            </div>
        </div>
    </div><!-- End Container -->
</section>
<?php } ?>