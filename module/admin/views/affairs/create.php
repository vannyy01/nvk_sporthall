<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\affairs\Affairs */
/* @var $trainers app\models\User */
/* @var $prices app\models\prices\Prices */

$this->title = 'Створити заняття';
$this->params['breadcrumbs'][] = ['label' => 'Affairs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="affairs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'trainers' => $trainers,
        'prices' => $prices
    ]) ?>

</div>
