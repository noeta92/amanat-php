<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pengaduan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengaduan-form">


    <?php //echo  DetailView::widget([
    //     'model' => $model,
    //     'attributes' => [
    //         'id',
    //         'pelaporInternal_id',
    //         'jenisIdentitas.jenisIndentitas',
    //         'noIdentitas',
    //         'namaPelapor:ntext',
    //         'emailPelapor:ntext',
    //         'handphone',
    //         'perihal',
    //         'kodeBagian0.bagian',
    //         'uraianLapor:ntext',
    //         'statusAduan',
    //         'tanggalLapor',
    //         'timeLapor:datetime',
    //         'uraianPenyelesaian',
    //         //'tanggalJawaban',
    //         'timeJawaban:datetime',
    //         'userJawab_id',
    //         'tanggalPenyelesaian',
    //         'tanggalverifikasi',
    //         'timeVerifikasi:datetime',
    //     ],
    // ]) ?>

    <div class="col-md-6">
        <div class="alert alert-success">
            Untuk Verifikasi aduan Silahkan Isi dibawah ini!
        </div>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'statusAduan')->dropDownList($status, ['prompt'=>'Pilih Status', 'id'=> 'statusAduan'])?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>

</div>
