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
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\web\Response;

class SiteController extends Controller
{
    public $layout = 'structure';

    /**
     * @inheritdoc
     */
    public function behaviors()
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
     * @inheritdoc
     */
    public function actions()
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
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
     * Displays these one news page.
     * @param string $id
     * @return string
     */
    public function actionView($id)
    {
        if (
            isset($id) &&
            $news = News::find()->where(['id' => $id])
                ->one()
        ) {
            $this->layout = 'structure';
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
    public function actionAllnews()
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


        // Yii::$app->session->setFlash('newsError', 'Проблема з розділом');
        //  return $this->redirect('index');


    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays gallery page.
     *
     * @return string
     */

    public function actionGallery()
    {
        return $this->render('gallery');
    }

    /**
     * Displays info about affairs from db and sing up new enroll page.
     *
     * @return string
     */
    public function actionEnroll()
    {
        $enrolls = new Enrolls();
        $list = Affairs::find()->select(['id', 'time', 'trainer'])->where('clients <5')->asArray()->all();

        if ($enrolls->load(Yii::$app->request->post())) {
            $isValid = $enrolls->validate();
            if ($isValid) {

                $message = "Ви записалися на заняття " . $_POST['Enrolls']['time'];

                $affairs = Affairs::findOne(['time' => $_POST["Enrolls"]["time"]]);
                $affairs->updateCounters(['clients' => 1]);
                Yii::$app->session->setFlash('success', $message);
                return $this->redirect('enroll');

            }

        }
        return $this->render('contact', [
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
                return $this->redirect(['admin/default']);
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
