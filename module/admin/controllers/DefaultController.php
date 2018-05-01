<?php
declare(strict_types=1);

namespace app\module\admin\controllers;

use app\models\queries\UsersQuery;
use app\models\user\User;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    use AdminTrait;

    public function actionIndex()
    {
        return $this->render('index');
    }
}
