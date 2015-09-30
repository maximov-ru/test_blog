<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use \justinvoelker\separatedpager\LinkPager;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'SEMrush Blog';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="blog-name"><?= Html::encode($this->title) ?></h1>
<div class="row main">
    <div class="post-list col9">
<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'item'],
    'itemView' => 'view',
    'layout'=>'{items}',
    'pager'=>[
        'class'=>'\justinvoelker\separatedpager\LinkPager',
        'nextPageLabel' => false,
        // Отключаю ссылку "Предыдущий"
        'prevPageLabel' => false,
        'maxButtonCount' => 7,
    ],
]) ?>
    </div>
    <div class="ad col3">
        <img src="/i/banner.jpg" alt="Banner"/>
    </div>
</div>
<div class="row">
    <div class="col12">
        <?= LinkPager::widget([
            'pagination'=>$dataProvider->pagination,
            'nextPageLabel' => false,
            // Отключаю ссылку "Предыдущий"
            'prevPageLabel' => false,
            'maxButtonCount' => 7,
            'activePageAsLink' => false,
        ]);
?>
    </div>
</div>
