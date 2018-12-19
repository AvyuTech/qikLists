<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = $model->b_title;
$this->params['breadcrumbs'][] = $this->title;
//$this->registerCss('');
$auther = ($model->user) ? $model->user->u_name : null;
$datetime = Yii::$app->formatter->asDatetime($model->created_at);
$this->registerCss("
.blog-section .blog-single .single-blog-mata-area {
    margin-top: 25px;
}
");
?>
<!-- =========================
    Blog Section
============================== -->

<section class="blog blog-style-1 ptb-80">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 col-xs-offset-0">
                <div class="blog-post-wrapper ptb-20">
                    <div class="blog-post">
                        <figure class="blog-post-image">
                            <img src="<?= $model->getFeatureImage(); ?>" title="<?= $model->b_title; ?>" alt="image">
                        </figure>
                        <div class="blog-post-description">
                            <h4><?= $model->b_title; ?></h4>
                            <?= $model->b_description; ?>
                        </div>
                        <div class="blog-post-tools">
                            <i class="icon">
                                <i class="ti-user"></i>
                                <span><?= $auther; ?></span>
                            </i>
                            <i class="icon">
                                <i class="ti-time"></i>
                                <span><?= $datetime; ?></span>
                            </i>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- End Container -->
</section>