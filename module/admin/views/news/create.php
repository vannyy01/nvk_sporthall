<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\news\News */
/* @var $img app\models\news\News */
/* @var $message string */

$this->title = 'Створити новину';
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-create">
    <? if (!empty($message)): ?>
        <?= $message ?>
    <? endif; ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'img' => $img,
    ]) ?>

</div>
