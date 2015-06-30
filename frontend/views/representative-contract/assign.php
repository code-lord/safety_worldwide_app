<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


$contract = \app\models\ContractMaster::findOne($id_contract);


$this->title = $contract->name;
$this->params['breadcrumbs'][] = $this->title;
$repre = '';
?>
<div class="representative-master-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-info">
        <p> <strong>Note:</strong>  This will override previous settings for assign representatives.</p>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <input type="hidden" value="<?= $_GET['id_contract'] ?>" name="contract_id" />
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
            [
                'attribute' => 'id',
                'value' => 'id',
            ],
            'first_name',
            'last_name',
            //'type',
            'phone',
            'email:email',
        // 'created_at',
        // 'updated_at',
//            ['class' => 'yii\grid\CheckboxColumn',
//                'checkboxOptions' => function ($model, $key, $index, $column) {
//                    return ['value' => 'id'];
//                },
//                    ],
        ],
    ]);
    ?>
    <div class="form-group">
        <?=
        Html::submitButton($model->isNewRecord ? 'Assign' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            '$id_contract' => $id_contract])
        ?>
        <?= Html::a('Cancel', ['/contract-master/view', 'id' => $_GET["id_contract"]], ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>