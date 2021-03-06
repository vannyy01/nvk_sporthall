<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\affairs\AffairsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заняття';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="affairs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Створити заняття', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            [
                'attribute' => 'affair_time',
                "format" => ["date", "php:Y-M-d H:i"]
            ],
            'clients',
            [
                'attribute' =>  'user.name',
                'content' => function (\app\models\affairs\Affairs $value): string {
                    return $value->getFullUserName(false);
                },
                "label" => "Тренер"
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
