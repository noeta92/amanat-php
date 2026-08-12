<?php
/* @var $this yii\web\View */
use miloschuman\highcharts\Highcharts;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Aplikasi Manajemen Administrasi';
?>
<!-- Surat boxes -->
<div class="row">
    <!-- Left col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fas fa-folder"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total Surat</span>
                <span class="info-box-number"><?= $surat_semua ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
        <!-- </div class="clearfix visible-sm-block"></> -->

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fas fa-inbox"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Surat Masuk</span>
                <span class="info-box-number"><?= $surat_masuk ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-teal"><i class="fas fa-paper-plane"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Surat Keluar</span>
                <span class="info-box-number"><?= $surat_keluar ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-md-3">
        <!-- MAP & BOX PANE -->
        
        </div>
</div>


<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <div class="col-md-12">
        <!-- MAP & BOX PANE -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Statistik Surat Diteruskan Bidang</h3>

                <div class="box-tools pull-right">
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <div class="row">
                    <div class="col-md-9 col-sm-8">
                        <div class="pad">
                            <!-- Map will be created here -->
                            <?php

                            echo  Highcharts::widget([
                                'options' => [
                                    'chart' => ['type' => 'column'],
                                    'title' => false,
                                    'xAxis' => [
                                        'categories' => $bidang_chart['kategori'],
                                    ],
                                    'yAxis' => [
                                        'title' => ['text' => 'Jumlah Surat']
                                    ],
                                    'series' => [
                                        ['name' => 'Surat Masuk', 'data' => $bidang_chart['masuk'], 'color' => '#4FA847'],
                                        ['name' => 'Surat Keluar', 'data' => $bidang_chart['keluar'], 'color' => '#5DCA97'],
                                    ],
                                    'credits' => FALSE,
                                ]
                            ]);
                            ?>

                        </div>
                    </div>
                    <!-- /.col -->
                        <div class="col-md-3 col-sm-2">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                    <i class="fas fa-calendar-day mr-1"></i>
                                    <?php if ($item_name == 'Kabid') : ?> 
                                        Surat Bidang Hari ini 
                                        <?php else : ?>
                                            Surat Hari ini
                                            <?php endif;  ?> 
                                    </h3>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content p-0">
                                    <!-- Morris chart - Sales -->
                                    <h5 class="description-header"><?= $masuk_today ?></h5>
                                        <span class="description-text">Surat masuk</span>

                                        <h5 class="description-header"><?= $keluar_today ?></h5>
                                        <span class="description-text">Surat Keluar</span>
                                    </div>
                                </div><!-- /.card-body -->    
                            </div>

                            <div class="card">
                            <div class ="card-body">

                            <?php $form = ActiveForm::begin([
                            'method' => 'post',
                            'action' => ['site/index'],
                            ]); ?>

                            <strong>Dari</strong>
                            <?php

                            if ($start == null) { ?>

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

                            <br> <strong>Sampai Dengan</strong>;

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
                            <br> <?= Html::submitButton('Hitung', ['class' => 'btn btn-outline-primary']) ?>
                            <?php ActiveForm::end();  ?>  
                            </div>
                            </div>
                        
         
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <h3 class="box-title">Statistik Perjalanan Dinas, Lembur, Honorarium pegawai per bidang</h3>
                    <div class="col-md-9 col-sm-8">  
                        <div class="pad">
                        <?php

                            echo  Highcharts::widget([
                                'options' => [
                                    'chart' => ['type' => 'bar'],
                                    'title' => false,
                                    'xAxis' => [
                                        'categories' => $monitoring_chart['kategori'],
                                    ],
                                    'yAxis' => [
                                        'title' => ['text' => 'Jumlah perjadin / lembur / honorarium']
                                    ],
                                    'series' => [
                                        ['name' => 'Perjalanan Dinas', 'data' => $monitoring_chart['perjadin'], 'color' => '#047AFB'],
                                        ['name' => 'Lembur', 'data' => $monitoring_chart['lembur'], 'color' => '#42A3B9'],
                                        ['name' => 'Honorarium', 'data' => $monitoring_chart['honor'], 'color' => '#021F40'],
                                    ],
                                    'credits' => FALSE,
                                ]
                            ]);
                        ?>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-2">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary"><i class="fas fa-suitcase-rolling"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Perjadin</span>
                                <span class="info-box-number"><?= $totalPerjadin ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <div class="info-box">
                            <span class="info-box-icon bg-lightblue"><i class="fas fa-cloud-moon"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Lembur</span>
                                <span class="info-box-number"><?= $totalLembur ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <div class="info-box">
                            <span class="info-box-icon bg-navy"><i class="fas fa-coins"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Honorarium</span>
                                <span class="info-box-number"><?= $totalHonor ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>    
                </div>

            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
<!-- /.row -->

                  

