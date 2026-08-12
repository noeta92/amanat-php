<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pengaduan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pengaduans', 'url' => ['harian']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengaduan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

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
            // 'tanggalJawaban',
            'timeJawaban:datetime',
            'userJawab_id',
            'tanggalPenyelesaian',
            'tanggalverifikasi',
            'timeVerifikasi:datetime',
            'userVerifikasi',
            'noTiket',
        ],
    ]) ?>

</div>
