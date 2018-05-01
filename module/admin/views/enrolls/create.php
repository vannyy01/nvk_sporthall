<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\enrolls\Enrolls */
/* @var $affairs[] app\models\affairs\Affairs */


$this->title = 'Створити запис';
$this->params['breadcrumbs'][] = ['label' => 'Enrolls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enrolls-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'affairs' => $affairs,
    ]) ?>

</div>
