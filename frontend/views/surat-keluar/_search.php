<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\SuratMasukSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="surat-keluar-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'noSurat') ?>

    <?= $form->field($model, 'tanggalSurat') ?>

    <?= $form->field($model, 'statusSurat') ?>

    <?= $form->field($model, 'kodeBidang') ?>

    <?php // echo $form->field($model, 'kodeKlasifikasi') ?>

    <?php // echo $form->field($model, 'perihal') ?>

    <?php // echo $form->field($model, 'uraianSurat') ?>

    <?php // echo $form->field($model, 'isiDisposisi') ?>

    <?php // echo $form->field($model, 'timeDisposisi') ?>

    <?php // echo $form->field($model, 'jawabanDisposisi') ?>

    <?php // echo $form->field($model, 'timeJawaban') ?>

    <?php // echo $form->field($model, 'userJawab_id') ?>

    <?php // echo $form->field($model, 'tanggalTerimaKirim') ?>

    <?php // echo $form->field($model, 'namaTerimaKirim') ?>

    <?php // echo $form->field($model, 'timeCreated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
