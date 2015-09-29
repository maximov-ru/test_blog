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
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu" />
    <link rel="stylesheet" type="text/css" href="/css/site.css" />
</head>
<body>
    <header>
        <div class="grid">
            <div class="row">
                <div class="col11">
                    <a class="logo" href="/">
                        <img src="/i/logo-lg.png" alt="Blog"/>
                    </a>
                </div>
                <div class="col1 rss">RSS</div>
            </div>
        </div>
    </header>
    <div class="content grid">
        <h1 class="blog-name">Blog</h1>
        <div class="row">
            <div class="post-list col9">
                <div class="post row">
                    <div class="post-date col12">July 5, 2015</div>
                    <div class="post-name col12">
                        <h2>Cómo aumentar tu tráfico web de 4.000 a 40.000 visitas en solo 11 meses</h2>
                        <div class="post-author">by Yulia Shevardenkova</div>
                    </div>
                    <div class="post-img col4">
                        <img src="/i/test-post-img.jpg" alt="Post #1"/>
                    </div>
                    <div class="post-short-text col8">
                        If you run a small or new website, one thing you will always struggle with is the crawl rate within Google. If you add your 10 page website to Google with a few targeted keywords within the title tags and some cleverly placed variations within the content, you’re going to rank well, right? Well, that’s not always the case.
                    </div>
                </div>
            </div>
            <div class="ad col3">
                <img src="/i/test-post-img.jpg" alt="Banner"/>
            </div>
        </div>
    </div>
    <footer>
        <div class="grid">
            <div class="row">
                <div class="col3">
                    <img class="logo" src="/i/logo-lg.png" alt="Blog"/>
                </div>
                <div class="col9 copy">&copy; 2008–2015 SEMrush. All rights reserved.</div>
            </div>
        </div>
    </footer>
</body>
</html>