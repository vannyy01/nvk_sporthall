<?php
/* @var $this yii\web\View */
/* @var $news app\controllers\SiteController */

/* @var $pagination app\controllers\SiteController */


use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Усі новини';
$this->params['breadcrumbs']['title'] = $this->title;
?>
<div class="site-contact">

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('public/img_pages/news-agency.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="page-heading">
                        <h1><?= Html::encode($this->title) ?></h1>
                        <span class="subheading">Тут ви можете побачити усі новини</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div>
                    <?php if (Yii::$app->session->hasFlash('newsError')): ?>
                        <?= Yii::$app->session->getFlash('newsError') ?>
                    <?php endif; ?>
                </div>
                <?php foreach ($news as $new): ?>
                    <div class="post-preview">
                        <a href="/news/<?= Html::encode($new['id']) ?>">
                            <h2 class="post-title">
                                <?= Html::encode($new['header']) ?>
                            </h2>
                            <h3 class="post-subtitle">
                                <?= Html::encode($new['short_description']) ?>
                            </h3>
                        </a>
                        <p class="post-meta">Опубліковано
                            <strong><?= Html::encode(\app\models\users\User::getUserNameById($new['author'])) ?></strong>
                            <?= Html::encode(date_format(date_create($new['date']), 'd-m-Y')) ?>
                        </p>
                    </div>
                    <hr>
                <?php endforeach; ?>
            </div>
        </div>
        <ul class="pagination justify-content-center">
            <?= LinkPager::widget(['pagination' => $pagination]) ?>
        </ul>
