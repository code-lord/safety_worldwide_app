<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inspection Category';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-work-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Inspection Category', ['create', 'work_id' => $work_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '275'],
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Yii::$app->request->baseUrl . "/contract-work/update?id=" . $model->id . "&work_id=" . $_GET['work_id']);
                    },
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Yii::$app->request->baseUrl . "/contract-work/view?id=" . $model->id . "&work_id=" . $_GET['work_id']);
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
