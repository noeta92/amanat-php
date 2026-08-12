<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SuratKeluar $model */

// $this->title = Yii::t('app', 'Ubah Surat Keluar: {name}', [
//     'name' => $model->id,
// ]);

$this->title = Yii::t('app', 'Ubah Surat Keluar: ', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Surat Keluar'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Ubah');
?>
<div class="surat-keluar-update">


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

</div>
