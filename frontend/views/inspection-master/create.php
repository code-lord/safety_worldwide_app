<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InspectionMaster */

$this->title = 'Create Inspection Master';
$this->params['breadcrumbs'][] = ['label' => 'Inspection Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inspection-master-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
