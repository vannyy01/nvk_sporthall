<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'extensions' => 'png, jpg'],
        ];
    }


    /**
     * @return bool
     */
    public function upload(): bool
    {
        if ($this->validate()) {
            if (isset($this->imageFile) &&
                $this->imageFile->saveAs('public/img/news/' . $this->imageFile->baseName . '.' . $this->imageFile->extension)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return string
     */
    public function getImageName():string
    {
        return '/public/img/news/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
    }

}
/**
 * Created by PhpStorm.
 * User: vanny
 * Date: 12.11.2017
 * Time: 16:28
 */