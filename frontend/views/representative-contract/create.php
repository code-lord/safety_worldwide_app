<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RepresentativeContract */

$this->title = 'Create Representative Contract';
$this->params['breadcrumbs'][] = ['label' => 'Representative Contracts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="representative-contract-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
