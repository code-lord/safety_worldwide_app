<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\ContractMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-master-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
//    DatePicker::widget([
//        'name' => 'start_date',
//        'options' => ['placeholder' => 'Select Cotntract Start sdate ...'],
//        'pluginOptions' => [
//            'format' => 'dd-M-yyyy',
//            'todayHighlight' => true
//        ]
//    ]);
    ?>

    <?php
    //use app\models\Country;
    $ContractTypes = app\models\ContractType::find()->all();


    $listData = \yii\helpers\ArrayHelper::map($ContractTypes, 'id', 'name');
    ?>

    <?= $form->field($model, 'contract_type')->dropDownList($listData, ['prompt' => 'Select...']); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
