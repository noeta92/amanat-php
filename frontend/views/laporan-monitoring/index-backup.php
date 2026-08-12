<?php

use common\models\Pegawai;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\PegawaiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Laporan Monitoring');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-index">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php $urutPerjadin = Html::a('<span class="fas fa-arrow-alt-circle-up"></span> Urutkan', ['perjadin'], ['class' => 'btn btn-xs btn-outline-primary']); ?>
    
    <div class ="card">
        <div class="card-body">
            <div class = "row">
                <div class = "col-md-6">
                    <?php $form = ActiveForm::begin([
                    'method' => 'post',
                    'action' => ['laporan-monitoring/index'],
                    ]); ?>

                    <strong>Mulai</strong>

                    <?= DatePicker::widget([
                        'name' => 'start',
                            'options' => ['placeholder' => 'Dari Tanggal'],
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'todayHighlight' => true
                            ]
                    ]); ?>
                    <strong>Sampai Dengan</strong>

                    <?= DatePicker::widget([
                        'name' => 'end',
                        'value' => date('Y-m-d'),
                        'options' => ['placeholder' => 'Sampai Tanggal'],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true
                        ]
                    ]); ?>

                    
                    <br> <?= Html::submitButton('Hitung', ['class' => 'btn btn-outline-primary']) ?> 
                    <?php ActiveForm::end();  ?> 
                </div> 
                <hr>
            </div>
            
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pager' => ['class' => \yii\bootstrap5\LinkPager::class],
                'showHeader' => true,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'id',
                    'namaLengkap',
                    [
                        //'attribute' => 'statusSurat',
                        'header' => 'Perjalanan Dinas'.' '.$urutPerjadin ,
                        'format' => "raw",
                        'headerOptions' => ['style' => 'color:#047bfb'],
                        'value' => function ($model) {

                            $perjadin = $model->getMonitoringPerjadins()->count();
                            return $perjadin;
                            
                        }
                    ],

                    [
                        //'attribute' => 'statusSurat',
                        'label' => 'Lembur',
                        'format' => "raw",
                        'headerOptions' => ['style' => 'color:#047bfb'],
                        'value' => function ($model) {

                            $perjadin = $model->getMonitoringLemburs()->count();
                            return $perjadin;
                            
                        }
                    ],

                    [
                        //'attribute' => 'statusSurat',
                        'label' => 'Honorarium',
                        'format' => "raw",
                        'headerOptions' => ['style' => 'color:#047bfb'],
                        'value' => function ($model) {

                            $perjadin = $model->getMonitoringHonoraria()->count();
                            return $perjadin;
                            
                        }
                    ],   
                ],
            ]); ?>
            
        </div>
    </div>

    <?php Pjax::end(); ?>

</div>
