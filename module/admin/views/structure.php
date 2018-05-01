<?php


/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;


AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <!-- Gallery assets -->

    <!-- Custom fonts for this template -->
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet'
          type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
          rel='stylesheet' type='text/css'>

    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>


<!-- Navigation -->
<nav class="navbar  navbar-expand-lg navbar-light fixed-top" id="mainNav"
     style="  border-bottom: 1px solid #eee;
    background-color: wheat;">
    <div class="container">
        <a class="navbar-brand" href="/">NVK SPORT HALL</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            Меню
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/admin/default">Головна</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Меню адмінки
                    </a>
                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                        <li class="dropdown-item"><a href="/admin/affairs">Занняття</a></li>
                        <li class="dropdown-item"><a href="/admin/enrolls">Записи</a></li>
                        <li class="dropdown-item"><a href="/admin/news">Новини</a></li>
                        <li class="dropdown-item"><a href="/admin/prices">Ціни</a></li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item"><a href="user/">Користувачі</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/gallery">Галерея</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/enroll">Запис</a>
                </li>
                <?php
                echo !Yii::$app->user->isGuest ? (
                    '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Вийти ' . Yii::$app->user->identity->name . ' ' . Yii::$app->user->identity->second_name . '(' . Yii::$app->user->identity->user_name . ')',
                        ['class' => 'btn btn-link logout', 'style' => 'color: white']
                    )
                    . Html::endForm()
                    . '</li>'
                ) : null
                ?>
            </ul>
        </div>
    </div>
</nav>
<div style="width: 100%; height: 61px">

</div>
<div class="container-fluid">
    <!-- Content -->
    <?= $content ?>
    <!-- Footer -->
</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="https://twitter.com/">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                  </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://facebook.com">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                  </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://instagram.com">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                  </span>
                        </a>
                    </li>
                </ul>
                <p class="copyright text-muted"> &copy; NVK SPORT HALL 2017</p>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

