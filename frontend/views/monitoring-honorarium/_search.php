<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\MonitoringHonorariumSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="monitoring-honorarium-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idHonor') ?>

    <?= $form->field($model, 'idPegawai') ?>

    <?= $form->field($model, 'jenisSurat') ?>

    <?= $form->field($model, 'idSurat') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?php // echo $form->field($model, 'tujuan') ?>

    <?php // echo $form->field($model, 'tempat') ?>

    <?php // echo $form->field($model, 'statusVerifikasi') ?>

    <?php // echo $form->field($model, 'verifikasiBy') ?>

    <?php // echo $form->field($model, 'createdOn') ?>

    <?php // echo $form->field($model, 'createdBy') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
