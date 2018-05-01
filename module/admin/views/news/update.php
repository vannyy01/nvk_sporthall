<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\news\News */
/* @var $img app\models\news\News */
/* @var $message string */

$this->title = 'Оновити новину: '.$model->header;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'img' => $img,
    ]) ?>

</div>
