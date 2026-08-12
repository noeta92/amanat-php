<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pengaduan */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="pengaduan-form">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'pelaporInternal_id',
            'jenisIdentitas_id',
            'noIdentitas',
            'namaPelapor:ntext',
            'emailPelapor:ntext',
            'handphone',
            'perihal',
            'kodeBagian',
            'instansiPelapor:ntext',
            'uraianLapor:ntext',
            'statusAduan',
            'tanggalLapor',
            'timeLapor:datetime',
            'uraianPenyelesaian',
            'tanggalJawaban',
            'timeJawaban:datetime',
            'userJawab_id',
            'tanggalPenyelesaian',
            'tanggalverifikasi',
            'timeVerifikasi:datetime',
            'userVerifikasi',
            'noTiket',
        ],
    ]) ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'statusAduan')->dropDownList($status, ['prompt'=>'Pilih Status', 'id'=> 'statusAduan'])?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>