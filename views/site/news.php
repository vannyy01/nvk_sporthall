<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $news app\controllers\SiteController */

$this->title = $news['header'];
$this->params['breadcrumbs']['title'] = $this->title;
$date = date_create($news['date']);
?>

<header class="masthead st-1-bl news" style="background-image: url(<?= $news['image'] ?>)">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-heading">
                    <h1><?= Html::encode($this->title) ?></h1>
                    <h2 class="subheading"><?= Html::encode($news['short_description']) ?></h2>
                    <span class="meta">Posted by
                        <?= Html::encode($news['author']) ?>
                        on <?= Html::encode(date_format($date, 'F d, Y')) ?></span>
                </div>
            </div>
        </div>
    </div>
</header>


<!-- Main Content -->

<div class="container">
    <div class="row">
        <div class="col-md-8 blog-main">
            <div class="blog-post">
                <p>
                    <?= nl2br($news['full_description']) ?>
                </p>
            </div>
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = 'https://connect.facebook.net/uk_UA/sdk.js#xfbml=1&version=v3.0';
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
            <div class="fb-comments" data-href="https://http://nvk-sporthall.com/" data-numposts="5"></div>
        </div>
    </div>
</div>



