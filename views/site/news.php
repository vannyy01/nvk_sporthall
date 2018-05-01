<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $news app\controllers\SiteController */

$this->title = $news['header'];
$this->params['breadcrumbs']['title'] = $this->title;
$date = date_create($news['date']);
?>

<header class="masthead st-1-bl" style="background-image: url(<?=$news['image']?>)">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-heading">
                    <h1><?=Html::encode($this->title)?></h1>
                    <h2 class="subheading"><?=Html::encode($news['short_description'])?></h2>
                    <span class="meta">Posted by
                <?=Html::encode($news['author'])?>
                on <?=Html::encode(date_format($date, 'F d, Y'))?></span>
                </div>
            </div>
        </div>
    </div>
</header>


<!-- Main Content -->

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>
                <?=Html::encode($news['full_description'])?>
            </p>
        </div>
    </div>
</div>



