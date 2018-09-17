<?php

/* @var $this yii\web\View */

$this->title = 'Галерея';
$this->params['breadcrumbs']['title'] = $this->title;
?>
<!-- Page Header -->

<header class="masthead" style="background-image: url('./public/img_pages/woman.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="page-heading">
                    <h1>Галерея</h1>
                    <span class="subheading">Ваші фото</span>
                </div>
            </div>
        </div>
    </div>
</header>


<!-- Main Content -->
<div class="container" style="margin-top: 50px">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div id="gallery" style="">
                <?php
                $directory = "./public/img/gallery";    // Папка с изображениями
                $allowed_types = ["jpg", "png", "gif"];  //разрешеные типы изображений

                \app\models\helpers\OwnHelper::showImage($allowed_types, $directory);
                ?>
            </div>
        </div>
    </div>
</div>

<hr>
