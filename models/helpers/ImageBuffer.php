<?php
/**
 * Created by PhpStorm.
 * User: vanny
 * Date: 18.06.2018
 * Time: 20:43
 */

namespace app\models\helpers;


class ImageBuffer
{
    private static $sum = 0;
    private static $images = [];

    /**
     * @return array
     */
    public static function getImages(): array
    {
        return self::$images;
    }

    /**
     * @param int $i
     * @return string
     */
    public static function getImage(int $i): string
    {
        return self::$images[$i];
    }

    /**
     * @param string $image
     */
    public static function setImages(string $image)
    {
        self::$images[] = $image;
    }

    /**
     * @return int
     */
    public static function getSum(): int
    {
        return self::$sum;
    }

    /**
     * @param int $sum
     */
    public static function setSum(int $sum)
    {
        self::$sum = $sum;
    }

    public static function unsetSum()
    {
        self::$sum = 0;
    }

    public static function unsetImages()
    {
        self::$images = [];
    }
}