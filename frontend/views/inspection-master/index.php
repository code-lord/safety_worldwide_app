<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inspection Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inspection-master-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Inspection Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'shift',
            'created_at',
            'updated_at',
            'inspection_location',
            // 'inspection_representative_master',
            // 'inspection_contract_master',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
