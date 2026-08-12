<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\SuratMasuk $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Surat Masuks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="surat-masuk-view">

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
            'noSurat',
            'tanggalSurat',
            'statusSurat',
            'kodeBidang',
            'kodeKlasifikasi',
            'perihal',
            'uraianSurat:ntext',
            'isiDisposisi',
            'timeDisposisi:datetime',
            'jawabanDisposisi',
            'timeJawaban:datetime',
            'userJawab_id',
            'tanggalTerimaKirim',
            'namaTerimaKirim',
            'timeCreated:datetime',
        ],
    ]) ?>

</div>
