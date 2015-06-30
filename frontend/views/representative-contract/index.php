<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Representative Contracts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="representative-contract-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Assign Representative', ['/representative-contract/assign', 'id_contract' => $_GET["id_contract"]], ['class' => 'btn btn-primary']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'RepresentativeName',
            'RepresentativePhone',
            'RepresentativeEmail',
            'created_at',
        // 'soft_delete',
        ],
    ]);
    ?>
    <?= Html::a('View Contract', ['/contract-master/view', 'id' => $_GET["id_contract"]], ['class' => 'btn btn-primary']) ?>
</div>
