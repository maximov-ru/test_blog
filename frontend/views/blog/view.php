<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

?>

<div class="post row">
    <div class="post-date col12"><?= Html::encode(date('F j, Y',strtotime($model->public_from))) ?></div>
    <div class="post-name col12">
        <a href="<?= '/blog/'.$model->slug;?>" class="h2"><?= Html::encode($model->title) ?></a>
        <div class="post-author">by <?= $model->owner->username?></div>
    </div>
    <div class="post-content">
        <div class="post-img col4">
            <img src="<?= \Yii::getAlias('@web').'/post_images/'.$model->image_medium?>" alt="Post #1"/>
        </div>
        <div class="post-short-text col8">
            <?= $model->postPreview?>
        </div>
    </div>
</div>
