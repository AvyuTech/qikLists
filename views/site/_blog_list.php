<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->registerCss("
.recente-product-content a {
    font-size:15px;
}
.discount-percent {
    font-size: 15px;
}
.deal-atime {
    font-size:12px;
}
");
$auther = ($model->user) ? $model->user->u_name : null;
$datetime = Yii::$app->formatter->asDatetime($model->created_at);
?>

<div class="blog-post">
    <figure class="blog-post-image">
        <img src="<?= $model->getFeatureImage(); ?>" title="<?= $model->b_title; ?>" alt="image">
    </figure>
    <div class="blog-post-description">
        <a href="<?= \yii\helpers\Url::to(['/site/blog-single', 'slug' => $model->slug]); ?>" title="<?= $model->b_title; ?>"><h4 class="blog-title"><?= substr($model->b_title, 0, 50).'...'; ?></h4></a>
        <p><?= substr(strip_tags($model->b_description), 0, 200).'...'; ?></p>
        <a href="<?= \yii\helpers\Url::to(['/site/blog-single', 'slug' => $model->slug]); ?>" title="<?= $model->b_title; ?>" class="btn btn-theme-color">Read More</a>
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
</div>