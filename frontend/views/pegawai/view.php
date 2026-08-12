<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Pegawai $model */

$this->title = $model->namaLengkap;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pegawai'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pegawai-view">

    <h1><?php // Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
                'attribute' => 'statusAparatur',
                'filter'=> ['1'=> 'ASN', '2'=> 'Non ASN'],
                'label' => 'status',
                'value' => function($model) {
                    return ($model->statusAparatur == 1) ? 'ASN' : 'Non ASN';
                }
            ],
            'namaLengkap',
            'nip',
            [
                'attribute' => 'eselon',
                'label' => 'Eselon',
                'value' => function($model) {
                    return $model->pegawaiEselon->nm_eselon;
                }
            ],
            [
                'attribute' => 'kodeBidang',
                'label' => 'Bidang',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->pegawaiBidang->bidang;
                }
            ],
        ],
    ]) ?>

</div>
