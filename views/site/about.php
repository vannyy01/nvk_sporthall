<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Про нас';
$this->params['breadcrumbs']['title'] = $this->title;
?>
<!-- Page Header -->
<header class="masthead" style="background-image: url('./public/img/about.png')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="page-heading">
                    <h1>Як потрапити</h1>
                    <span class="subheading">Як потрапити?!</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <h1 class="head-about">Наше розташування</h1>
            <div id="map"></div>
        </div>
    </div>
</div>

<hr>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3z13tAyV8A6OCCWeyjHss5_QfS5GB7p0&callback=initMap">
</script>