<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use \justinvoelker\separatedpager\LinkPager;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => 'view',
        'pager'=>null,
    ]) ?>
    <?= LinkPager::widget([
        'pagination' => $dataProvider->pagination,
        // Отключаю ссылку "Следующий"
        'nextPageLabel' => false,
        // Отключаю ссылку "Предыдущий"
        'prevPageLabel' => false,
        'maxButtonCount' => 7,
    ]);?>

</div>