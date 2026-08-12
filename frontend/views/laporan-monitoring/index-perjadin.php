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

    <?php 
    $urutBatal = Html::a('<span class="fas fa-times"></span> Batalkan', ['index'], ['class' => 'btn btn-xs btn-outline-danger']);

    if ($start == NULL) {
        $urutLembur = Html::a('<span class="fas fas fa-arrow-alt-circle-up"></span> Urutkan', ['lembur'], ['class' => 'btn btn-xs btn-outline-primary']);
        $urutHonor = Html::a('<span class="fas fas fa-arrow-alt-circle-up"></span> Urutkan', ['honor'], ['class' => 'btn btn-xs btn-outline-primary']); 
    } else {
        $urutLembur = Html::a('<span class="fas fas fa-arrow-alt-circle-up"></span> Urutkan', ['lembur', 'start'=> $start, 'end'=>$end], ['class' => 'btn btn-xs btn-outline-primary']);
        $urutHonor = Html::a('<span class="fas fas fa-arrow-alt-circle-up"></span> Urutkan', ['honor', 'start'=> $start, 'end'=>$end], ['class' => 'btn btn-xs btn-outline-primary']);     
    }
    ?>
    
    

    <div class ="card">
        <div class="card-body">
            <div class = "col-md-6">
            <?php $form = ActiveForm::begin([
            'method' => 'post',
            'action' => ['laporan-monitoring/perjadin'],
            ]); ?>

            <strong>Mulai</strong>
            <?php if ($start == null) { ?>

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

                <?php } else {

                echo DatePicker::widget([
                    'name' => 'start',
                        'value' =>  $start,
                        'options' => ['placeholder' => 'Dari Tanggal'],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true
                        ]
                ]); ?>
                <strong>Sampai Dengan</strong>

                <?= DatePicker::widget([
                    'name' => 'end',
                    'value' => $end,
                    'options' => ['placeholder' => 'Sampai Tanggal'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);
                } ?>
                <br> <?= Html::submitButton('Hitung Perjadin', ['class' => 'btn btn-outline-primary']) ?>
                <?php ActiveForm::end();  ?>  
            </div> 
            <hr>
            <table class = "table table-responsive table-bordered table-hover">
            <?php if ($start != NULL) : ?>
                    <div class="alert alert-light" role="alert">
                        <span class="fas fa-chart-line"> </span> <strong> Urutan perjadin </strong> dari tanggal <strong> <?= $start ?> </strong> <strong> sampai dengan <?= $end ?> </strong>
                    </div>    
                <?php elseif  ($start == NULL) : ?>
                    <div class="alert alert-light" role="alert">
                        <span class="fas fa-chart-line"> </span> <strong> Urutan Perjadin </strong> Keseluruhan    
                <?php endif; ?>
                <tr> 
                    <th style="color:#047bfb">Nama Pegawai</th>
                    <th style="color:#047bfb">Perjalanan Dinas <?= $urutBatal ?></th>
                    <th style="color:#047bfb">Lembur <?=$urutLembur ?></th>
                    <th style="color:#047bfb">Honorarium <?= $urutHonor ?></th>

                </tr>
                <?php
                if ($modelPegawai == NULL) { ?>
                    <div class="alert alert-danger" role="alert">
                        <strong> Data tidak tersedia! </strong>
                    </div> 
                <?php }  foreach ($modelPegawai as $keyPegawai => $valuePegawai) : ?>
            
                <tr>
                    <td>
                        <?= $valuePegawai->namaLengkap; ?>
                    </td>
                    <td>
                        <?php if ($start == NULL) { echo $valuePegawai->getMonitoringPerjadins()->count(); } 
                                else { echo $valuePegawai->getMonitoringPerjadins()->andWhere(['between', 'tanggal_awal', $start, $end])->count(); } ?>
                    </td>
                    <td>
                        <?= $valuePegawai->getMonitoringLemburs()->count(); ?>
                    </td>
                    <td>
                        <?= $valuePegawai->getMonitoringHonoraria()->count(); ?>
                    </td>

                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <?php Pjax::end(); ?>

</div>
