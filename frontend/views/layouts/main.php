<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="<?= Yii::$app->charset ?>">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu" />
    <link rel="stylesheet" type="text/css" href="/css/site.css" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>
<body>
<div class="container">
    <header>
        <div class="grid logo">
            <div class="row">
                <div class="col11">
                    <a href="/">
                        <img src="/i/logo-lg.png" alt="Blog"/>
                    </a>
                </div>
                <a class="col1 rss" href="/blog/rss">RSS</a>
            </div>
        </div>
    </header>
    <div class="content grid">
        <?= $content ?>

    </div>
    <div class="clearer"></div>
    <footer>
        <div class="grid">
            <div class="row">
                <div class="col3">
                    <div class="logo-wrap">
                        <img class="logo" src="/i/logo-lg.png" alt="Blog"/>
                    </div>
                </div>
                <div class="col9 copy">&copy; 2008–2015 SEMrush. All rights reserved.</div>
            </div>
        </div>
    </footer>
</div>
</body>
</html>