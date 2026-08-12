<?php

use yii\helpers\Html;
?>
<div class="box box-warning">
    <div class="box-body">
		<div class="pengaduan-update">
			<div class="col-md-10">
		    <table width="100%" style="border-collapse: collapse">
			    <thead>

				</thead>

				<tbody>
   				<tr>
   					<th style="text-align:center "><img width="80px" src="../../frontend/web/img/logoGaruda.png"></th>
   				</tr>
   				<tr><th style="text-align:center ">BADAN KEPEGAWAIAN NEGARA </th></tr>
   				<tr><th style="text-align:center ">KANTOR REGIONAL VI </th> </tr>
   				<tr><th> <br> </th></tr>
   				<tr> <th><?php
			    if ($model->statusAduan == 0) {
			    	echo "<strong style='font-size: 12px'>Status: </strong> <strong style='font-size: 12px' color='red'> Belum Dijawab ! </strong>";
			    }
			    elseif ($model->statusAduan == 1) {
			    	echo "<strong style='font-size: 12px'>Status: </strong>
			    		  <strong style='font-size: 12px'color='green'> Sudah Dijawab </strong>
			    		  <strong style='font-size: 12px'><br>
			    				  Status Verifikasi:  </strong> <strong style='font-size: 12px'color='red'> Belum Diverifikasi </strong>";
			    }
			    elseif ($model->statusAduan == 2) {
			    	echo "<strong style='font-size: 12px' >Status: </strong><strong style='font-size: 12px' color='green'> Sudah Dijawab </strong> <br>
			    				 <strong style='font-size: 12px' > Status Verifikasi: </strong> <strong style='font-size: 12px' color='green'> Sudah Diverifikasi </strong>";
			    } else {

			    	echo "<strong style='font-size: 12px'>Status: </strong>
			    		  <strong style='font-size: 12px' color='green'></strong>
			    		  <strong style='font-size: 12px> Sudah Dijawab </strong> <br>
			    		  <strong style='font-size: 12px'> Status Verifikasi: </strong>
			    		  <strong style='font-size: 12px'  color='red'> Revisi Penyelesaian !</strong>";
			    }
			    ?>
				</th>
				<tr><th> <br> </th></tr>
   				</tbody>

   			</table>
   			<table class="table table-striped table-bordered" id="sample_1">
   				<thead></thead>
   				<tbody>


   				<tr>
   					<th style="font-size: 12px">No Tiket: </th><th style="font-size: 12px"> <?=$model->noTiket ?></th>
   				</tr>
			    <tr>
			    	<th style="font-size: 12px"> Id Pelapor: </th> <th style="font-size: 12px"> <?= $model->noIdentitas ?> </th>
			    </tr>
			    <tr>
			    	<th style="font-size: 12px"> Jenis Identitas: </th> <th style="font-size: 12px"> <?= $model->jenisIdentitas->jenisIndentitas ?> </th>
			    </tr>

			    <tr>
			    	<th style="font-size: 12px"> Perihal: </th> <th style="font-size: 12px"> <?= $model->perihal ?> </th>
			    </tr>
			    <tr>
			    	<th style="font-size: 12px"> Uraian: </th>  <th style="font-size: 12px"> <?= $model->uraianLapor ?></th>
			    </tr>
			    <tr>
			    	<th style="font-size: 12px"> Uraian Penyelesaian: </th> <th style="font-size: 12px"> <?= isset($model->uraianPenyelesaian) ? ($model->uraianPenyelesaian) : 'Belum Diselesaikan' ?> </th>
			    </tr>
			    <tr>
			    	<th style="font-size: 12px"> Tanggal Penyelesaian: </th> <th style="font-size: 12px">
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
			    	<th style="font-size: 12px"> Tanggal Dijawab: </th> <th style="font-size: 12px">
			    	<?php

			    	if (isset($model->timeJawaban)) {
			    	echo Yii::$app->formatter->asDate($model->timeJawaban, 'd-M-Y / H:i:s');
			    	} else {
			    	echo "Belum Dijawab";
			    	}

			    	?> </th>
			    </tr>

          <tr>
            <td></td>

            <td>
              <br>
              <br>


            		Medan, <?= date('d M Y') ?><br>
            		Kepala Bagian Tata Usaha<br><br><br>
            		Moersito Adji, SH<br>
            		NIP. 19610601 199703 001


          </td>

          </tr>



				</tbody>
			</table>
		    </div>
		</div>
	</div>
</div>
