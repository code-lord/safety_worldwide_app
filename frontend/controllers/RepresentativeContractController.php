<?php

namespace frontend\controllers;

use Yii;
use app\models\RepresentativeContract;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * RepresentativeContractController implements the CRUD actions for RepresentativeContract model.
 */
class RepresentativeContractController extends Controller {
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['post'],
//                ],
//            ],
//        ];
//    }

    /**
     * Lists all RepresentativeContract models.
     * @return mixed
     */
    public function actionIndex($id_contract) {
        $dataProvider = new ActiveDataProvider([
            'query' => RepresentativeContract::find()->where(["contract_master" => $id_contract]),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RepresentativeContract model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RepresentativeContract model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new RepresentativeContract();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function actionAssign($id_contract) {
        if (Yii::$app->request->post()) {

            $representativ_list = $_POST["selection"];

            $representetiveContract = RepresentativeContract::deleteAll(["contract_master" => $_POST["contract_id"]]);
            for ($index = 0; $index < count($representativ_list); $index++) {
                $representetiveContract = new RepresentativeContract;
                $representetiveContract->contract_master = $_POST["contract_id"];
                $representetiveContract->representative_master = $representativ_list[$index];
                $representetiveContract->save();
            }
            return $this->redirect(['index', 'id_contract' => $_POST["contract_id"]]);
        }
        $model = new RepresentativeContract();

        $dataProvider = new ActiveDataProvider([
            'query' => \app\models\RepresentativeMaster::find()->where(['type' => 1])
        ]);

        return $this->render('assign', ['model' => $model, 'dataProvider' => $dataProvider, 'id_contract' => $id_contract]);
    }

    /**
     * Updates an existing RepresentativeContract model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RepresentativeContract model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RepresentativeContract model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RepresentativeContract the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = RepresentativeContract::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

}
