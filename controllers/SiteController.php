<?php
declare(strict_types=1);

namespace app\controllers;

use app\models\affairs\Affairs;
use app\models\SignUp;
use app\models\enrolls\Enrolls;
use app\models\Login;
use app\models\news\News;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\web\Response;

class SiteController extends Controller
{
    public $layout = 'structure';

    /**
     * @return array
     */
    public function behaviors():array
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function actions():array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex():string
    {

        $news = News::find();

        $pagination = new Pagination([
                'defaultPageSize' => 4,
                'totalCount' => $news->count(),
            ]
        );

        $news = $news->offset($pagination->offset)
            ->limit($pagination->limit)->asArray()
            ->all();

        return $this->render('index', [
            'news' => $news
        ]);
    }

    /**
     * @param $id
     * @return string|Response
     */
    public function actionView($id)
    {
        if (
            isset($id) &&
            $news = News::find()->where(['id' => $id])
                ->one()
        ) {
            return $this->render('news', [
                'news' => $news,
            ]);
        }
        Yii::$app->session->setFlash('newsError', 'Новина не знайдена.');
        return $this->redirect('index');

    }

    /**
     * @return string
     */
    public function actionAllnews():string
    {
        $news = News::find();

        $pagination = new Pagination([
                'defaultPageSize' => 10,
                'totalCount' => $news->count(),
            ]
        );

        $news = $news->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('allnews', [
            'news' => $news,
            'pagination' => $pagination,
        ]);
    }

    /**
     * @return string
     */
    public function actionAbout():string
    {
        return $this->render('about');
    }

    /**
     * @return string
     */
    public function actionGallery():string
    {
        return $this->render('gallery');
    }

    /**
     * @return string|Response
     */
    public function actionEnroll()
    {
        $enrolls = new Enrolls();
        $list = Affairs::find()->select(['id', 'affair_time', 'trainer'])->where('clients < 5')->andWhere("affair_time <".time())->all();
        foreach ($list as $value) {
            $value->trainer = $value->getFullUserName(false);
        }
        $list = ArrayHelper::toArray($list);
        $list = ArrayHelper::map($list, 'id', "affair_time", "trainer");
        $enrolls->verifycode = md5("fdf".rand(1,1000));
        if ($enrolls->load(Yii::$app->request->post())) {
            $enrolls->name = htmlspecialchars(trim($enrolls->name));
            $enrolls->second_name = htmlspecialchars(trim($enrolls->second_name));
            $enrolls->email = htmlspecialchars(trim($enrolls->email));
            $enrolls->phone = htmlspecialchars(trim($enrolls->phone));
            $enrolls->verifycode = htmlspecialchars(trim($enrolls->verifycode));
            if ($enrolls->validate() && $enrolls->save()) {
                $affairs = $enrolls->getAffairs()->one();
                $message = "Ви записалися на заняття " . $affairs->affair_time;
                $affairs->updateCounters(['clients' => 1]);
                Yii::$app->session->setFlash('success', $message);
                return $this->redirect('enroll');
            }
        }
        return $this->render('enroll', [
            'enrolls' => $enrolls,
            'list' => $list,
        ]);

    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        $this->layout = 'start-page';
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }
        $login_model = new Login();
        if ($login_model->load(Yii::$app->request->post(), 'Login')) {
            if ($login_model->validate() && $login_model->isUserBanned()) {
                Yii::$app->user->login($login_model->getUser());
                return $this->redirect(['admin/index']);
            }
        }
        return $this->render('login', ['model' => $login_model]);
    }

    /**
     * @return Response
     */
    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionSignup()
    {
        $this->layout = 'start-page';
        $model = new SignUp();
        if ($model->load(Yii::$app->request->post(), 'SignUp')) {
            if ($model->validate()) {
                if ($model->SignUp()) {
                    return $this->redirect(['login']);
                }
            }
            if (empty(Yii::$app->session->getFlash("passError"))) {
                Yii::$app->session->setFlash("passError", "Перевірте введені дані.");
            }
        }
        return $this->render('signup', ['model' => $model]);
    }
}
