<?php
$status = [
    0 => 'Belum Diverifikasi',
    1 => 'Belum Diverifikasi',
    2 => 'Sudah Diverifikasi',
    3 => 'Refisi',
];
?>
<div style="text-align:center;"><h4>LAPORAN MONEV LAPOR !</h4>
<h4>PADA KANTOR REGIONAL VI BKN PERIODE JUNI <?=  date('Y') ?></h4>
</div>
<table class="table table-bordered">
	<tbody>
		<tr>
			<td>TUJUAN</td>
			<td style="padding-left:10px;padding-right:10px;">:</td>
			<td>
				Untuk memperoleh informasi mengenai presepsi laporan pengaduan yang ditindaklanjuti terhadap layanan yang diberikan oleh Kantor Regional VI Badan Kepegawaian Negara yang terdiri dari 5 (lima) Bidang/Bagian yaitu:
				<ol>
					<li>Bagian Tata Usaha</li>
					<li>Bidang Mutasi dan Status Kepegawaian</li>
					<li>Bidang Pengangkatan dan Pensiun</li>
					<li>Bidang Pengembangan dan Supervisi Kepegawaian</li>
					<li>Bidang Informasi Kepegawaian</li>
				</ol>
			</td>
		</tr>
		<tr>
			<td>PERIODE</td>
			<td style="padding-left:10px;padding-right:10px;">:</td>
			<td>Juni <?= date('Y') ?></td>
		</tr>
		<tr>
			<td>METODE RUJUKAN</td>
			<td style="padding-left:10px;padding-right:10px;">:</td>
			<td>Layanan Aspirasi dan Pengaduan Online Rakyyat (LAPOR)</td>
		</tr>
		<tr>
			<td>JUMLAH PELAPOR</td>
			<td style="padding-left:10px;padding-right:10px;">:</td>
			<td>5 (lima) orang (terdiri dari PNS di wilayah kerja Kanreg VI BKN)</td>
		</tr>
		<tr>
			<td>Jumlah Aduan</td>
			<td style="padding-left:10px;padding-right:10px;">:</td>
			<td>5 (lima)</td>
		</tr>
		<tr>
			<td>TOPIK LAPORAN</td>
			<td style="padding-left:10px;padding-right:10px;">:</td>
			<td>
				<ol>
					<li>Reformasi Birokrasi dan Tata Kelola</li>
				</ol>
			</td>
		</tr>
	</tbody>
</table>
<br>
<strong>Mentoring</strong>
<table class="table table-bordered">
	<thead>
		<tr>
			<th style="text-align:center;">No</th>
			<th style="text-align:center;">Judul Laporan</th>
			<th style="text-align:center;">Klasifikasi</th>
			<th style="text-align:center;">Tgl Laporan</th>
			<th style="text-align:center;">Tgl Jawaban</th>
			<!-- <th style="text-align:center;">Sumber Jawaban</th> -->
			<th style="text-align:center;">Status</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$no = 1;
		foreach ($data as $key => $value):
	?>
		<tr>
			<td style="text-align:center;"><?= $no++ ?></td>
			<td><?= $value->perihal ?></td>
			<td></td>
			<td><?= $value->tanggalLapor ?><br><?= $value->timeLapor ?></td>
			<td><?= $value->tanggalJawaban ?><br><?= $value->timeJawaban ?></td>
			<!-- <td></td> -->
			<td><?= $status[$value->statusAduan] ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<br>
<strong>Evaluasi</strong>
<div>
<ol>
	<li>
		Dari hasil monitoring maka dapat dilakukan evaluasi, diantaranya sebagai berikut:
		<ol type="a">
			<li>ada 4 (empat) aduan yang masuk daalm klasifikasi pemintaan informasi mengenai konfirmasi usul kenaikan pangkat dan sudah ditindaklanjuti oleh Bidang Mutasi dan Status Kepegawaian</li>
			<li>ada 1 (satu) aduan yang masuk dalam klasifikasi pengaduan yaitu mengenai pembatalan surat Keputusan Pensiun janda an. Samueli Gulo dan pengaudan tersebut sudah dijawab oleh Bidang Pengangkatan dan Pensiun bahwa penerbitan SK Pensiun tersebut tidak menyalahi peraturan perundang-undangan yang berlaku</li>
		</ol>
	</li>
	<li>Hasil Rekapitulasi Laporan Layanan Aspirasi dan Pengaduan Online Rakyat (LAPOR) kami lampirkan sebagai bahan pertimbangan</li>
	<li>Demikian atas perhatian dan kerjasamanya diucapkan terima kasih</li>
</ol>
</div>
<br>
<div style="padding-left:500px;">
		Medan, <?= date('D,m,Y') ?><br>
		Kepala Bagian Tata Usaha<br><br><br>
		Moersito Adji, SH<br>
		NIP. 19610601 199703 001
</div>
<div>
	<strong> Tembusan</strong> disampaikan kepada Yth:
	<ol>
		<li>Kepala Kantor Regional VI BKN sebagai Laporan</li>
		<li>Kepala Bidang Mutasi dan Status Kepegawaian</li>
		<li>Kepala Bidang Pengangkatan dan Pensiun</li>
		<li>Kepala Bidang Informasi Kepegawian</li>
		<li>Kepala Bidang Pengembangan dan Supervisi Kepegawaian</li>
	</ol>
</div>