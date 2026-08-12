<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model common\models\Dokumen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="daftar-file">

    <table class="table">

    <tr>
        <th>Nama File</th>
        <th>File </th>
        <th>Status </th>
        <th>Aksi</th>
    <tr>
    <?php foreach ($model as $value): ?> 
    <tr>
        <td> <?= ($value->namaFile !=NULL) ? $value->namaFile : "?";
         ?>
        <td><?php $file= $value->file; 
            echo $nama =  mb_strimwidth($file, 0, 50, ".."); ?></td>
        <td><?php if($value->jenisSurat == 2) {
                echo '<i class="fas fa-check"></i> Final'; }?> </td>    
        <td><?= Html::a('<span class="fa fa-eye"></span> Lihat', ['view-file', 'idDok'=>$value->id], ['class' => 'btn btn-sm btn-primary', 'target' => '_blank']); ?>
            <?php
            $buttonHapus = Html::a('<span class="fas fa-trash"></span> Hapus', ['delete-file-verified', 'id'=>$value->id], ['class' => 'btn btn-sm btn-link', 
                        'data-confirm' => Yii::t('yii', 'Yakin hapus dokumen ini?'),
                        'data-method' => 'post', 'data-pjax' => '0']); 

            $checkHapus = Helper::checkRoute('surat-keluar/delete-file-verified') ? $buttonHapus : '';
            echo ($modelCheck->statusKirim == 1) ? $checkHapus : '';
            ?>
        </td>
    </tr>
        <?php endforeach;?>

</div>
