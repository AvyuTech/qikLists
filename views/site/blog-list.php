<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Blog';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss("
.col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, 
.col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, 
.col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, 
.col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, 
.col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, 
.col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, 
.col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, 
.col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, 
.col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, 
.col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, 
.col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, 
.col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, 
.col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
    padding-right:10px;
}

@media (min-width: 1200px) {
    .container {
        max-width: 80%;
    }
}
a {
    color: #ff4a4a;
}
");
$rBlogData = \app\models\Blog::find()->orderBy(['b_id' => SORT_DESC])->limit(10)->all();
?>
<!-- =========================
    Blog Section
============================== -->
<section class="blog blog-style-1 ptb-80">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 col-xs-offset-0">
                <?=
                \yii\widgets\ListView::widget([
                    'dataProvider' => $dataProvider,
                    'emptyText' => 'Blog not found!',
                    'options' => [
                        'tag' => false,
                        'class' => false,
                        'id' => false,
                    ],
                    'pager' => [
                        'pageCssClass' => 'page-item',
                        'linkOptions' => ['class' => 'page-link'],
                        'nextPageCssClass' => 'pagination-older',
                        'prevPageCssClass' => 'pagination-newer',
                        'firstPageLabel' => 'First',
                        'lastPageLabel' => 'Last',
                        /*'prevPageLabel' => 'previous',
                        'nextPageLabel' => 'next',
                        'maxButtonCount' => 3,*/
                    ],
                    'itemOptions' => function ($model, $key, $index, $widget) {
                        return ['class' => 'blog-post-wrapper ptb-20'];
                    },
                    'layout' => "{items}\n<div class='col-xs-12 col-sm-12'><nav class='pagination-container'>{pager}</nav></div>",
                    'itemView' => function ($model, $key, $index, $widget) {
                        return $this->render('_blog_list',['model' => $model]);
                    },
                ]);
                ?>
            </div>
        </div>
    </div><!-- End Container -->
</section>