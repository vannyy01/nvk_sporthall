<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\affairs\Affairs */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Affairs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="affairs-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'trainer' => $model->trainer, 'prices_id' => $model->prices_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'trainer' => $model->trainer, 'prices_id' => $model->prices_id], [
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
            'time',
            'clients',
            'trainer',
            'prices_id',
        ],
    ]) ?>

</div>
