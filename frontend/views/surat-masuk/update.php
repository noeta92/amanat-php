<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SuratMasuk $model */

$this->title = 'Update Surat Masuk: ' . $model->noSurat;
$this->params['breadcrumbs'][] = ['label' => 'Surat Masuk', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="surat-masuk-update">

    <?= $this->render('_form', [
        'model' => $model,
        'bidang' => $bidang,
        'klasifikasi' => $klasifikasi,
    ]) ?>

</div>
