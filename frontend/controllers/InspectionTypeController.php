<?php

namespace frontend\controllers;

use Yii;
use app\models\InspectionType;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InspectionTypeController implements the CRUD actions for InspectionType model.
 */
class InspectionTypeController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all InspectionType models.
     * @return mixed
     */
    public function actionIndex($work_type_id) {
        $dataProvider = new ActiveDataProvider([
            'query' => InspectionType::find()->where(["contract_work" => $work_type_id]),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'work_type_id' => $work_type_id,
        ]);
    }

    /**
     * Displays a single InspectionType model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $work_type_id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'work_type_id' => $work_type_id,
        ]);
    }

    /**
     * Creates a new InspectionType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($work_type_id) {
        $model = new InspectionType();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'work_type_id' => $work_type_id,]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'work_type_id' => $work_type_id,
            ]);
        }
    }

    /**
     * Updates an existing InspectionType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $work_type_id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'work_type_id' => $work_type_id,]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'work_type_id' => $work_type_id,
            ]);
        }
    }

    /**
     * Deletes an existing InspectionType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the InspectionType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InspectionType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = InspectionType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
