<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ContractWork */

$this->title = 'Create Inspection Category';
$this->params['breadcrumbs'][] = ['label' => 'Inspection Category', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-work-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model, 'work_id' => $work_id,
    ])
    ?>

</div>
