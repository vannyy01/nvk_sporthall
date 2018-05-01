<?php
declare(strict_types=1);

namespace app\module\admin;
use yii\gii\Module;

/**
 * admin module definition class
 */
class Admin extends Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\module\admin\controllers';

    /**
     * @inheritdoc
     */
    public function init():void
    {
        parent::init();

        // custom initialization code goes here
    }
}
