<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\InspectionType */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Inspection Types', 'url' => ['index','work_type_id' => $work_type_id,]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inspection-type-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id,'work_type_id' => $work_type_id,], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'created_at',
            'updated_at',
            'contract_work',
        ],
    ]) ?>

</div>
