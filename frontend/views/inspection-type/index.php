<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inspection Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inspection-type-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Inspection Type', ['create', 'work_type_id' => $work_type_id,], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'contract_work',
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '275'],
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Yii::$app->request->baseUrl . "/inspection-type/update?id=" . $model->id . "&work_type_id=" . $_GET['work_type_id']);
                    },
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Yii::$app->request->baseUrl . "/inspection-type/view?id=" . $model->id . "&work_type_id=" . $_GET['work_type_id']);
                    },
//                    'delete' => function ($url, $model, $key) {
//                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Yii::$app->request->baseUrl . "/dispatchreport/update?id=" . $model->id . "&&lr_id=" . $model->LR_id);
//            },
                ],
            ],
        ],
    ]);
    ?>

</div>
