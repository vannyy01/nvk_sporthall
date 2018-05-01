<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\enrolls\Enrolls */
/* @var $affairs[] app\models\affairs\Affairs */

$this->title = 'Оновити запис: '.$model->id." ".$model->name." ".$model->second_name;
$this->params['breadcrumbs'][] = ['label' => 'Enrolls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'affairs_id' => $model->affairs_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="enrolls-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'affairs' => $affairs,
    ]) ?>

</div>
