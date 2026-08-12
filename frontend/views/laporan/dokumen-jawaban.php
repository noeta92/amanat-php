<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;
// use kartik\widgets\FileInput;
use kartik\file\FileInput;

$this->registerCssFile(
        '@web/css/sistem/lingkungan_style.css', ['depends' => [\yii\web\JqueryAsset::className()]]
);

/* @var $this yii\web\View */
/* @var $model app\models\Jabatans */

$this->title = 'Tambah Dokumen';
$this->params['subtitle'] = 'Dokumen';
$this->params['breadcrumbs'][] = ['label' => 'Pengaduan', 'url' => ['laporan/harian']];
$this->params['breadcrumbs'][] = $this->title;

$ZULjs = '$(document).click(function(event){
			var data = event.target.getAttribute("data");
			var ext = event.target.getAttribute("ext");
			var style = "width:550px;height:500px";
			var data2 = "";
			//if (ext == "mp4"){
				//alert(ext);
				//data2 = "<video src=" + data + " style= " + style + "></video>";
			//}else{
				data2 = "<iframe src="+ data + " style= " + style + "></iframe>";
			//}
			
			document.getElementById("isi").innerHTML = data2;
		});
	
';

$this->registerJs($ZULjs);
?>
<div class="box box-warning">
    <div class="box-body">
    
    <h2>Dokumen Penyelesaian</h2> 
    <hr>  
                    

    <div class="ta-forum-lingkungan-media-index">
    <?php if (Yii::$app->request->get('pesan') == "berhasil"): ?>
    	<div class="alert alert-success">
    		Berhasil mengunggah data ke server!
      </div>
    <?php endif; ?>

        <div class="col-md-10">
            <div class="pengaduan-create">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <div class="form-group">
                    <?=
                    $form->field($model, 'pdfFile[]')->widget(FileInput::className(), ['options' => [
                            'multiple' => true], 'pluginOptions' => ['maxFileCount' => 50]])
                    ?>
                </div>
                <div class="form-group">   
                    <?php
                    echo $form->field($model, 'imageFile[]')->widget(FileInput::className(), ['options' => [
                            'multiple' => true], 'pluginOptions' => ['maxFileCount' => 50]])
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    echo $form->field($model, 'videoFile[]')->widget(FileInput::className(), ['options' => [
                            'multiple' => true], 'pluginOptions' => ['maxFileCount' => 5]])
                    ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>

    <?php Pjax::begin(); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'Nama Berkas',
                    'format' => 'raw',
                    'value' => function($model, $key, $index) {
                        return '<h5>' . $model->namaFile . '</h5>';
                    },
                ],
                [
                    'attribute' => 'type',
                    'format' => 'raw',
                    'value' => function($model, $key, $index) {
                        return '<p>' . $model->type . '</p>';
                    },
                ],
        ],
    ]);
    ?>
            <?php Pjax::end(); ?>

         <h2><?= Html::a('Selesai', ['laporan/harian', 'id' => $id], ['class' => 'btn btn-warning']) ?></h2>
    </div>
    </div>
</div>  