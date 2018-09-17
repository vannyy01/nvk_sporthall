<?php

use yii\helpers\Html;
use \yii\widgets\ActiveForm;

$this->title = 'Завантажити зображення';
$this->params['breadcrumbs'][] = ['label' => 'Create Photo', 'url' => ['index/createphoto']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-create">
    <? if (!empty($message)): ?>
        <?= $message ?>
    <? endif; ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="news-form">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($img, 'directory')->dropDownList(["./public/img/" => "За замовчуванням",
            "./public/img/gallery/" => "Галерея", "./public/img/news/" => "Новини"],[  'style' => 'width: 200px '])->label("Розділ"); ?>

        <?= $form->field($img, 'imageFile')->fileInput()->label("Вибрати зображення") ?>

        <div class="form-group">
            <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
