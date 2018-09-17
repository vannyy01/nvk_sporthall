<?php

/* @var $this yii\web\View */

/* @var $page yii\web\View */

use \app\models\helpers\ImageBuffer;

$this->title = 'Фотографії';
$this->params['breadcrumbs']['title'] = $this->title;
?>
<!-- Main Content -->
<div class="container photo-block">
    <div class="row">

        <?php
        $directory = "./public/img/";    // Папка с изображениями
        $allowed_types = ["jpg", "png", "gif"];  //разрешеные типы изображений

        \app\models\helpers\OwnHelper::imagesGlob($directory, $allowed_types);
        \app\models\helpers\OwnHelper::showImages(10, $page);
        ?>
    </div>
    <ul class="pagination justify-content-center">
        <li class="page-item<?= $page !== 1 ? "" : " disabled" ?>">
            <a class="page-link" href="/admin/index/photo?page=<?= $page !== 1 ? $page - 1 : null ?>" tabindex="-1">Previous</a>
        </li>
        <? for ($i = 1; $i <= ceil(ImageBuffer::getSum() / 10); $i++): ?>
            <li class="page-item <?= $page === $i ? " active" : "" ?>"><a class="page-link"
                                                                          href="/admin/index/photo?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <? endfor; ?>
        <li class="page-item <?= $page == ceil(ImageBuffer::getSum() / 10) ? " disabled" : "" ?>">
            <a class="page-link"
               href="/admin/index/photo?page=<?= $page !== ceil(ImageBuffer::getSum() / 10) ? $page + 1 : null ?>">Next</a>
        </li>
    </ul>
</div>

<hr>
<script>
    (($) =>
        $(window).ready(() => {
                const photos = $('.photo-block');
                const navBar = $('#mainNav');
                photos.css("margin-top", navBar.height() / 2);
            }
        ))(jQuery);
</script>