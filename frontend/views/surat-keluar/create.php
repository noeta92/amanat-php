<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SuratKeluar $model */

$this->title = 'Tambah Surat Keluar';
$this->params['breadcrumbs'][] = ['label' => 'Surat Keluar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?php
    if ($item_name == 'Kabid'){
        echo $this->render('_form', [
        'model' => $model,
        'arrayBidang' => $arrayBidang,
        'klasifikasi' => $klasifikasi
        ]);
    } else {
        echo $this->render('_form-admin', [
            'model' => $model,
            'arrayBidang' => $arrayBidang,
            'klasifikasi' => $klasifikasi
        ]);
    }
     ?>


