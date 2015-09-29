<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">


    <div class="public_date"><?= Html::encode(date('F j, Y',strtotime($model->public_from))) ?></div>
    <div class="post_title"><h1><?= Html::encode($model->title) ?></h1><span class="post_by">by <?= $model->owner->username?></span></div>
    <div class="post_image"><img src="<?= \Yii::getAlias('@web').'/post_images/'.$model->image_medium?>" /></div>
    <div class="post_text"><?= $model->post?></div>

</div>