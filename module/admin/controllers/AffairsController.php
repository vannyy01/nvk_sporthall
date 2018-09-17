<?php
declare(strict_types=1);

namespace app\module\admin\controllers;

use app\models\prices\Prices;
use app\models\users\User;
use Yii;
use app\models\affairs\Affairs;
use app\models\affairs\AffairsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * AffairsController implements the CRUD actions for Affairs model.
 */
class AffairsController extends Controller
{
    use AdminTrait;

    /**
     * Lists all Affairs models.
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new AffairsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Affairs model.
     * @param string $id
     * @param string $trainer
     * @param string $prices_id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $trainer, $prices_id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $trainer, $prices_id),
        ]);
    }

    /**
     * Creates a new Affairs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Affairs();
        $model->affair_time = (Yii::$app->request->post())["Affairs"]["virtual_date"] . " " . (Yii::$app->request->post())["Affairs"]["virtual_time"] . ":00";
        if ($model->load(Yii::$app->request->post()) && !empty($model->affair_time) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'trainer' => $model->trainer, 'prices_id' => $model->prices_id]);
        }
        $trainerList = User::findAll(['role' => User::ROLE_TRAINER]);
        $priceList = Prices::find()->all();
        return $this->render('create', [
            'model' => $model,
            'trainers' => $trainerList,
            'prices' => $priceList
        ]);
    }

    /**
     * Updates an existing Affairs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @param string $trainer
     * @param string $prices_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $trainer, $prices_id)
    {
        $model = $this->findModel($id, $trainer, $prices_id);
        $time = $model->affair_time;
        $model->affair_time = (Yii::$app->request->post())["Affairs"]["virtual_date"] . " " . (Yii::$app->request->post())["Affairs"]["virtual_time"] . ":00";
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'trainer' => $model->trainer, 'prices_id' => $model->prices_id]);
        }
        $model->virtual_date = substr($time, 0, 10);
        $model->virtual_time = substr($time, 10, 6);
        $trainerList = User::findAll(['role' => User::ROLE_TRAINER]);
        $priceList = Prices::findAll(['status' => Prices::STATUS_ACTIVE]);
        return $this->render('create', [
            'model' => $model,
            'trainers' => $trainerList,
            'prices' => $priceList
        ]);
    }

    /**
     * Deletes an existing Affairs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @param string $trainer
     * @param string $prices_id
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $trainer, $prices_id): Response
    {
        $this->findModel($id, $trainer, $prices_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Affairs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @param string $trainer
     * @param string $prices_id
     * @return Affairs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $trainer, $prices_id): Affairs
    {
        if (($model = Affairs::findOne(['id' => $id, 'trainer' => $trainer, 'prices_id' => $prices_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
