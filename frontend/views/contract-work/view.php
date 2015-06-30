<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ContractWork */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Contract Works', 'url' => ['index','work_id' => $work_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-work-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id,'work_id' => $work_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        
         <?= Html::a('Inspection Type', ['/inspection-type', 'work_type_id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'work_contract_type',
        ],
    ]) ?>

</div>
