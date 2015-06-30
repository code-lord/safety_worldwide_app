<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InspectionType */

$this->title = 'Create Inspection Type';
$this->params['breadcrumbs'][] = ['label' => 'Inspection Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inspection-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'work_type_id' => $work_type_id,
    ]) ?>

</div>
