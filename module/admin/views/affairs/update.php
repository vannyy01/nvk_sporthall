<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\affairs\Affairs */
/* @var $trainers app\models\User */

$this->title = 'Оновити заняття';
$this->params['breadcrumbs'][] = ['label' => 'Affairs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'trainer' => $model->trainer, 'prices_id' => $model->prices_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="affairs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'trainers' => $trainers,
    ]) ?>

</div>
