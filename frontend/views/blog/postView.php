<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
$this->title = $model->title;
$this->registerMetaTag(['name'=>'description','content' => $model->desc]);
$this->registerMetaTag(['name'=>'keywords','content' => $model->keywords]);
$this->registerMetaTag(['property'=>'og:type','content' => 'article']);
$this->registerMetaTag(['property'=>'og:url','content' => 'http://test.danechka.com/blog/'.$model->slug.'/']);
$this->registerMetaTag(['property'=>'og:title','content' => $model->title]);
$this->registerMetaTag(['property'=>'og:description','content' => $model->desc]);

?>
<h1 class="blog-name"><?= Html::encode($model->title) ?></h1>
<div class="post main article">
    <div class="col12"><div class="author-ava"><img src="<?= \Yii::getAlias('@web').'/avatars/'.$model->owner->avatar?>" /></div><div class="post-author">by <?= $model->owner->username?></div><div class="post-date"><?= Html::encode(date('F j, Y',strtotime($model->public_from))) ?></div></div>
    <div class="post-content">
        <div class="post-short-text col12">
            <?= $model->post?>
        </div>
    </div>

</div>
<a href="/" class="back-to-list">&larr; Back to the article list</a>