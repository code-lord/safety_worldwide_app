<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InspectionMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inspection-master-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'shift')->textInput() ?>

    <?= $form->field($model, 'inspection_location')->textInput() ?>

    <?= $form->field($model, 'inspection_representative_master')->textInput() ?>

    <?= $form->field($model, 'inspection_contract_master')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
