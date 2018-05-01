<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\enrolls\Enrolls */

$this->title = $model->id." ".$model->name." ".$model->second_name;
$this->params['breadcrumbs'][] = ['label' => 'Enrolls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enrolls-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Усі', ['enrolls/'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Оновити', ['update', 'id' => $model->id, 'affairs_id' => $model->affairs_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id, 'affairs_id' => $model->affairs_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви впевнені, що хочете видалити цей запис?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'second_name',
            'email:email',
            'phone',
            'created_at',
            'affairs_id',
            'verifycode',
        ],
    ]) ?>

</div>
