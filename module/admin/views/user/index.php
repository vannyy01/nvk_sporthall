<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\users\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Користувачі';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Показано <b>{begin}- {end}</b> з <b>{totalCount}</b> записів",
        'columns' => [

            'id',
            'user_name',
            'email:email',
            'pass_hash',
            [
                'attribute' => 'role',
                'content' => function (\app\models\users\User $value): string {
                    switch ($value->role) {
                        case 10:
                            return "Moderator " . $value->role;
                        case 20:
                            return "Admin " . $value->role;
                    }
                    return "Banned " . $value->role;
                }
            ],

            'name',
            'second_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
