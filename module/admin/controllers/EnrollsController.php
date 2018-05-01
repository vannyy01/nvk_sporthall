<?php
declare(strict_types=1);

namespace app\module\admin\controllers;

use app\models\affairs\Affairs;
use Yii;
use app\models\enrolls\Enrolls;
use app\models\enrolls\EnrollsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EnrollsController implements the CRUD actions for Enrolls model.
 */
class EnrollsController extends Controller
{
    use AdminTrait;


    /**
     * Lists all Enrolls models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EnrollsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Enrolls model.
     * @param integer $id
     * @param string $affairs_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $affairs_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $affairs_id),
        ]);
    }

    /**
     * Creates a new Enrolls model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Enrolls();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'affairs_id' => $model->affairs_id]);
        }

        $time = date("Y-m-d H:i:s", time());

        $affairs = Affairs::find()->where("affair_time > '$time'")->asArray()->all();

        return $this->render('create', [
            'model' => $model,
            'affairs' => $affairs,
        ]);
    }

    /**
     * Updates an existing Enrolls model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param string $affairs_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $affairs_id)
    {
        $model = $this->findModel($id, $affairs_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'affairs_id' => $model->affairs_id]);
        }

        $time = date("Y-m-d H:i:s", time());

        $affairs = Affairs::find()->where("affair_time > '$time'")->asArray()->all();

        return $this->render('update', [
            'model' => $model,
            'affairs' => $affairs,
        ]);
    }

    /**
     * Deletes an existing Enrolls model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param string $affairs_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $affairs_id)
    {
        $this->findModel($id, $affairs_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Enrolls model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param string $affairs_id
     * @return Enrolls the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $affairs_id): Enrolls
    {
        if (($model = Enrolls::findOne(['id' => $id, 'affairs_id' => $affairs_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
