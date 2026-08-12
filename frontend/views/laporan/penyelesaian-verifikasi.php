<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pengaduan */

$this->title = 'Update Pengaduan';
$this->params['breadcrumbs'][] = ['label' => 'Pengaduan', 'url' => ['harian-verifikasi']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengaduan-update">
	<div class="box box-warning">
	    <div class="box-body">
			<div class="pengaduan-update">
				<div class="col-md-10">
			    <h3> No Tiket: <?= $model->noTiket ?></h3>
				<hr>
			    <table class="table table-striped table-bordered" id="sample_1">
				    <thead>
				    <p><?php
				    if ($model->statusAduan == 0) {
				    	echo "<strong>Status: <font color= 'red'> Belum Dijawab ! </font></strong>";
				    }
				    elseif ($model->statusAduan == 1) {
				    	echo "<strong>Status: <font color= 'green'> Sudah Dijawab </font> <br>
				    				  Status Verifikasi: <font color= 'red'> Belum Diverifikasi </font></strong>";
				    }
				    elseif ($model->statusAduan == 2) {
				    	echo "<strong>Status: <font color= 'green'> Sudah Dijawab </font> <br>
				    				  Status Verifikasi: <font color= 'green'> Sudah Diverifikasi </font></strong>";
				    } else {

				    	echo "<strong>Status: <font color= 'green'> Sudah Dijawab </font> <br>
				    				  Status Verifikasi: <font color= 'red'> Revisi Penyelesaian !</font></strong>";
				    }
				    ?>
					</p>

				    <?php

				    ?>

				    <tr>
				    	<th> Id Pelapor: </th> <th> <?= $model->noIdentitas ?> </th>
				    </tr>
				    <tr>
				    	<th> Jenis Identitas: </th> <th> <?= $model->jenisIdentitas->jenisIndentitas ?> </th>
				    </tr>

				    <tr>
				    	<th> Perihal: </th> <th> <?= $model->perihal ?> </th>
				    </tr>
				    <tr>
				    	<th> Uraian: </th>  <th> <?= $model->uraianLapor ?></th>
				    </tr>
				    <tr>
				    	<th> Uraian Penyelesaian: </th> <th> <?= isset($model->uraianPenyelesaian) ? ($model->uraianPenyelesaian) : 'Belum Diselesaikan' ?> </th>
				    </tr>
				    <tr>
				    	<th> Tanggal Penyelesaian: </th> <th>
				    	<?php

				    	if (isset($model->tanggalPenyelesaian)) {
				    	echo Yii::$app->formatter->asDate($model->tanggalPenyelesaian, 'd-M-Y');
				    	} else {
				    	echo "Belum Diselesaikan";
				    	}

				    	?>
				    	</th>
				    </tr>
				    <tr>
				    	<th> Tanggal Dijawab: </th> <th>
				    	<?php

				    	if (isset($model->timeJawaban)) {
				    	echo Yii::$app->formatter->asDate($model->timeJawaban, 'd-M-Y / H:i:s');
				    	} else {
				    	echo "Belum Dijawab";
				    	}

				    	?> </th>
				    </tr>
				    <tr>
				    	<th> Dokumen : </th>
				    	<th> <?php

				    		$tombols ='';

	                        $foto = $model->getMedia()->all();

	                        foreach ($foto as $value) {


	                           $namaFile = $value->namaFile;

	                           $tombols .= Html::a("Lihat", ["lihat-file","nama_file"=>$namaFile], ['role'=>'modal-remote', 'class'=>"btn bg-navy", 'target'=>'_blank']).'<br>';
	                        }

	                        echo $tombols;

				    		?>
				    	</th>
				    </tr>
				    <tr>

				    </tr>

					</thead>
				</table>
			    </div>

			    <?php
			    if ($model->statusAduan == 1 OR $model->statusAduan == 3) : ?>

			     <?= $this->render('_form-verifikasi', [
			        'model' => $model,
			        'identitas' => $identitas,
			        'status' => $status,
			    ]) ?>

			<?php endif ?>
			</div>
		</div>
	</div>
</div>
