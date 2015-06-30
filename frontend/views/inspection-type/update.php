<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InspectionType */

$this->title = 'Update Inspection Type: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Inspection Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id,'work_type_id' => $work_type_id,]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="inspection-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'work_type_id' => $work_type_id,
    ]) ?>

</div>
