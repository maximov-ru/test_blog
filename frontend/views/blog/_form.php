<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'tltle') ?>
<?= $form->field($model, 'slug') ?>
<?= $form->field($model, 'owner_id') ?>
<?= $form->field($model, 'post') ?>
<?= $form->field($model, 'public_from') ?>
<?= $form->field($model, 'create_time') ?>
<?= $form->field($model, 'update_time') ?>
<?= $form->field($model, 'image') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>