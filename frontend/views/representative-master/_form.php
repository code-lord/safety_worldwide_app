<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RepresentativeMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="representative-master-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php $item = ["1" => "Representative", "2" => "Superviser", "3" => "Contractor"]; ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput()->dropDownList($item, ['prompt' => 'Select...']) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, "type" => "number"]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, "type" => "email"]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
