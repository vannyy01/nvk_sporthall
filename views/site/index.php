<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $news app\controllers\SiteController */

$this->title = "NVK SPORT HALL";
$this->params['breadcrumbs']['title'] = $this->title;

?>

<header class="masthead st-1-bl" style="background-image: url('./public/img_pages/new-shad.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1><?=Html::encode($this->title)?></h1>
                    <span class="subheading">Ваш час зайнятись спортом!</span>
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
                <a href="/news/<?=Html::encode($new['id'])?>">
                    <h2 class="post-title">
                        <?=Html::encode($new['header'])?>
                    </h2>
                    <h3 class="post-subtitle">
                        <?=Html::encode($new['short_description'])?>
                    </h3>
                </a>
                <p class="post-meta">Posted by
                    <a href="#"><?=Html::encode($new['author'])?></a>
                    on <?=Html::encode($new['date'])?>
                </p>
            </div>
            <hr>
            <?php endforeach;?>

            <!-- Pager -->
            <div class="clearfix">
                <a class="btn btn-secondary float-right" href="/allnews">Усі новини &rarr;</a>
            </div>
        </div>

    </div>
</div>