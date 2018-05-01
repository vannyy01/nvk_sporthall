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
    public static function concatObjectFieldsToArray(array $models, string $keyField, array $fields):array
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
}