<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$this->registerJs('
$(document).ready(function(){
    setTimeout(function() {
      $(".alert").fadeOut("slow");
    }, 8000);
});
');

$this->registerCss("
body, p {
    color : #000000 !important;
}
.contact-item p {
    color: #72808e !important;
}
");
if (Yii::$app->controller->action->id === 'login') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {
        app\assets_b\HomeAppAsset::register($this);
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="<?= Yii::getAlias('@web')?>/favicon.ico" type="image/ico">
        <meta name="description" content="Account Dr">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title).' | Account Dr'; ?></title>
        <?php $this->head() ?>
    </head>
    <body class="">
    <?php $this->beginBody() ?>
    <?php
        if(Yii::$app->controller->action->id != 'home') {
    ?>
        <div class="wrapper">
    <?php }?>
        <!-- ==============================================
                         **PRE LOADER**
            =============================================== -->
        <div id="page-loader">
            <div class="loader-container">
                <div class="loader-logo">
                    <span>LOADING</span>
                </div>
                <div class="loader"></div>
            </div>
        </div>

        <?= $this->render(
            'home-header.php'
        ) ?>

        <?= $this->render(
            'home-content.php',
            ['content' => $content]
        ) ?>
    <?php
        if(Yii::$app->controller->action->id != 'home') {
    ?>
        </div>
    <?php } ?>
    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
