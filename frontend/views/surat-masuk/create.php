<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SuratMasuk $model */

$this->title = 'Tambah Surat Masuk';
$this->params['breadcrumbs'][] = ['label' => 'Surat Masuk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
        'bidang' => $bidang,
        'klasifikasi' => $klasifikasi
    ]) ?>

