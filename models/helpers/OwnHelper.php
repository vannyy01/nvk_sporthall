<?php
/**
 * Created by PhpStorm.
 * User: vanny
 * Date: 09.04.2018
 * Time: 13:54
 */
declare(strict_types=1);

namespace app\models\helpers;


use yii\base\InvalidParamException;

class OwnHelper
{
    /**
     * @param array $models
     * @param string $keyField
     * @param array $fields
     * @return array
     */
    public static function concatObjectFieldsToArray(array $models, string $keyField, array $fields): array
    {
        if (!empty($models) && !empty($keyField) && !empty($fields)) {
            $array = [];
            $concat = "";
            foreach ($models as $model) {
                foreach ($model as $key => $value) {
                    foreach ($fields as $field) {
                        if ($field === $key) {
                            $concat .= $value . " ";
                        }
                    }
                }
                if (!empty($concat)) {
                    foreach ($model as $key => $value) {
                        if ($key === $keyField) {
                            $concat = trim($concat);
                            $array[$value] = $concat;
                            $concat = "";
                        }
                    }
                }
            }
            return $array;
        }
        throw new InvalidParamException("Check input params");
    }

    /**
     * @param string $directory
     * @param array $allowed_types
     */
    public static function imagesGlob(string $directory, array $allowed_types)
    {
        $images = scandir($directory);
        foreach ($images as $key => $image) {
            //if (ImageBuffer::getSum() != 0 && ImageBuffer::getSum() % $count == 0) break;
            if ($image == "." || $image == "..") continue;//пропустить ссылки на другие папки
            $text = stristr($image, ".", true);
            if ($text == false)
                self::imagesGlob($directory . $image, $allowed_types);

            $file_parts = explode(".", $image);          //разделить имя файла и поместить его в массив
            $ext = strtolower(array_pop($file_parts));   //последний элеменет - это расширение
            if (in_array($ext, $allowed_types)) {
                ImageBuffer::setImages($directory . "/" . $image);
                $tmp = ImageBuffer::getSum();
                ImageBuffer::setSum(++$tmp);
            }
        }
    }

    /**
     * @param int $count
     * @param int $page
     */
    public static function showImages(int $count, int $page)
    {
        for ($i = $count * ($page - 1); $i < ImageBuffer::getSum() && $i < ($count * $page); $i++) {
            $image = ImageBuffer::getImage($i);
            echo '
                    <div class="col photo-wrapper">
                    <div>
                        <img  style="width: 200px; height: 150px" class="sport-photos rounded" src="' . '../../' . $image . '" alt="' .
                strstr($image, '.', true) . '"  data-image="' . '../../' . $image . '" /> 
                    </div >
                       <button data-method = "post" data-confirm = "Ви впевнені, що хочете видалити цей запис?"  
                       href="/admin/index/deletephoto?filename=' . $image . '&page=' . $page . '" type="button" class="btn btn-danger photo-button float-left" > Видалити</button >
                       </div>
                       ';
        }
    }

    public static function showImage(array $allowed_types, string $directory, bool $other = false)
    {
        $dir_handle = (@(opendir($directory))) or die("Ошибка при открытии папки !!!");
        while (false !== ($file = readdir($dir_handle)))    //поиск по файлам
        {
            if ($file == "." || $file == "..") continue;//пропустить ссылки на другие папки
            if ($other && stristr($file, ".", true)) {
                self::showImage($allowed_types, $directory . "/" . $file);
            }

            $file_parts = explode(".", $file);          //разделить имя файла и поместить его в массив
            $ext = strtolower(array_pop($file_parts));   //последний элеменет - это расширение

            if (in_array($ext, $allowed_types)) {
                echo '<img src="' . $directory . '/' . $file . '" class="pimg" alt="' . strstr($file, '.', true) . '"  data-image="' . $directory . '/' . $file . '" /> ';
            }
        }
        closedir($dir_handle);
    }

}