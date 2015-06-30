<?php

namespace frontend\controllers;

use Yii;
use app\models\ContractWork;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContractWorkController implements the CRUD actions for ContractWork model.
 */
class ContractWorkController extends Controller
{
    public function behaviors()
    {
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
     * Lists all ContractWork models.
     * @return mixed
     */
    public function actionIndex($work_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ContractWork::find()->where(['work_contract_type'=>$work_id]),
        ]);
//        echo var_dump($dataProvider);
//        Yii::$app->end();
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'work_id' => $work_id
        ]);
    }

    /**
     * Displays a single ContractWork model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id,$work_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
             'work_id' => $work_id,
        ]);
    }

    /**
     * Creates a new ContractWork model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($work_id)
    {
        $model = new ContractWork();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id,'work_id' => $work_id]);
        } else {
            return $this->render('create', [
                'model' => $model,'work_id' => $work_id,
            ]);
        }
    }

    /**
     * Updates an existing ContractWork model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$work_id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id,'work_id' => $work_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'work_id' => $work_id,
            ]);
        }
    }

    /**
     * Deletes an existing ContractWork model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$work_id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ContractWork model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContractWork the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContractWork::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
