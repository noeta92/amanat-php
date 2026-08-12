<?php

use common\models\Pegawai;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\search\PegawaiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Pegawai');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-index">

    <h1><?php // Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Tambah Pegawai'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => ['class' => \yii\bootstrap5\LinkPager::class],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
                'filter'=> $eselon,
                'label' => 'Eselon',
                'value' => function($model) {
                    return $model->pegawaiEselon->nm_eselon;
                }
            ],
            //'bidang',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Pegawai $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
