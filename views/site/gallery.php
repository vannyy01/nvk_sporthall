<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Галерея';
$this->params['breadcrumbs']['title'] = $this->title;
?>
<!-- Page Header -->

<header class="masthead" style="background-image: url('./public/img/woman.jpg')">
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
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div id="gallery" style="">

                <?php
                $directory = "./public/gallery";    // Папка с изображениями
                $allowed_types = ["jpg", "png", "gif"];  //разрешеные типы изображений
                $file_parts = [];
                $ext = "";
                $title = "";
                $i = 0;
                //пробуем открыть папку
                $dir_handle = @opendir($directory) or die("Ошибка при открытии папки !!!");
                while ($file = readdir($dir_handle))    //поиск по файлам
                {
                    if ($file == "." || $file == "..") continue;  //пропустить ссылки на другие папки
                    $file_parts = explode(".", $file);          //разделить имя файла и поместить его в массив
                    $ext = strtolower(array_pop($file_parts));   //последний элеменет - это расширение


                    if (in_array($ext, $allowed_types)) {
                        echo '<img src="' . $directory . '/' . $file . '" class="pimg" alt="'.strstr($file,'.',true).'"  data-image="'.$directory.'/' . $file . '" /> ';
                        $i++;
                    }

                }
                closedir($dir_handle);
                ?>
            </div>
        </div>
    </div>
</div>

<hr>

<script type="text/javascript">

    jQuery(document).ready(function(){
        jQuery("#gallery").unitegallery({
            theme_enable_preloader: true,
            gallery_theme: "tiles"
        });
    });

</script>