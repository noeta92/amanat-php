<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\SuratKeluar $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Isi Bukti Kirim';
$this->params['breadcrumbs'][] = ['label' => 'Surat Keluar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="surat-keluar-form">
    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'namaFile')->textarea(['rows' => 1])->label('Diterima oleh: ') ?>

    <?= $form->field($model, 'file')->fileInput()->label('Berkas:') ?>

    


    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

