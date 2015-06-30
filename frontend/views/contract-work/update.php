<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ContractWork */

$this->title = 'Update Inspection Category: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Contract Works', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id,'work_id' => $work_id,]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contract-work-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
         'work_id' => $work_id,
    ]) ?>

</div>
