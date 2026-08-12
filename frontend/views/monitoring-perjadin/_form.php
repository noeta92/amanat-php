<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var common\models\MonitoringPerjadin $model */
/** @var yii\widgets\ActiveForm $form */


$script = <<< JS
      $("#jenis").on("change", function() {
        var dataJenis = $('input:radio[name="MonitoringPerjadin[jenisSurat]"]:checked').val()
        $.post("index.php?r=monitoring-perjadin/get-surat&jenis="+dataJenis, function(data){
            $("#dataSurat").html(data);
            });   
    }); 
JS;
$this->registerJs($script);

?>

<div class="monitoring-perjadin-form">

    <div class="card">
        <div class ="card-body">
        <?php $form = ActiveForm::begin(); ?>

        <div class = "row">
        
            <?= $form->field($model, 'idPegawai')->widget(Select2::classname(), [
                        'data' => $pegawai,
                        'options' => ['placeholder' => 'Pilih Pegawai'],
                        'pluginOptions' => [
                            'allowClear' => true],
                    ])->label('Pilih Pegawai'); ?>

            <?php // $form->field($model, 'jenisSurat')->textInput() ?>

            <?= $form->field($model, 'jenisSurat')->radioList( [0=>'Surat Keluar', 1 => 'Surat Masuk'], 
            ['id'=>'jenis']); ?>

            <?= $form->field($model, 'idSurat')->widget(Select2::classname(), [
                        'data' => $surat,
                        'options' => ['placeholder' => 'Pilih Surat', 'id' => 'dataSurat'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Dasar Surat'); ?>

            <?= $form->field($model, 'jenisPerjalanan')->radioList( [0=>'Dalam Daerah', 1 => 'Luar Daerah Dalam Prop.', 2 => 'Luar Daerah Luar Prop.'], ['unselect' => null] ); ?>

            <?= $form->field($model, 'perihal')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'tempat')->textInput(['maxlength' => true]) ?>

        
            </div>

            <div class="row">
                <div class ="col-md-6">

                    <?= '<label class="form-label">Tanggal</label>' ?>

                    <?= DatePicker::widget([
                                'model' => $model, 
                                'attribute' => 'tanggal_awal',
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'options' => ['placeholder' => 'Pililh Tanggal', 'autocomplete' => 'off'],
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd',
                                    'todayHighlight' => true
                                ],
                            ]); ?>
                    <br>
                    
            
                </div>

                <div class ="col-md-6"> 
                <?= '<label class="form-label">Jika lebih dari 1 hari, pilih tanggal akhir: </label>' ?>
            
                <?= DatePicker::widget([
                    'model' => $model, 
                    'attribute' => 'tanggal_akhir',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'options' => ['placeholder' => 'Tanggal Akhir', 'autocomplete' => 'off'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ],
                ]); ?>

                </div>
            </div>

        <?php // $form->field($model, 'statusVerifikasi')->textInput() ?>

        <?php // $form->field($model, 'verifikasiBy')->textInput() ?>

        <?php // $form->field($model, 'createdOn')->textInput() ?>

        <br> 
        <div class="form-group">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>

<script>  
</script>
