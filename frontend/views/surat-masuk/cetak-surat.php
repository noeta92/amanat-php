<div style="text-align:center">
        <h3>  <strong> Rekapitulasi Surat Masuk  </strong></h3>
        <h4>Bappedalitbang Deli Serdang </h4>
 </div>
<hr>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>No.</th>
        <th>No Surat </th>
        <th> Asal </th>
        <th>Tanggal Surat </th>
        <th> Status Surat </th>
        <th>Kode Klasifikasi </th>
        <th>Perihal </th>
        <th>Tanggal Diteruskan </th>
    </tr>
    </thead>
    <?php
     $no = 1;
     foreach ($modelSurat as $valueSurat): ?>
        <tr>
        <td><?= $no ?></td>
        <td style="width:10%"><?= $valueSurat->noSurat ; ?> </td>
        <td> <?= $valueSurat->asalTujuan; ?> </td>
        <td><?php
            $tanggal = new DateTime($valueSurat->tanggalSurat);
            $tanggalSurat = $tanggal->format('d-m-Y');
            echo $tanggalSurat; ?> </td>
        <td> <?php
            $status = $valueSurat->statusSurat;
            if ($status == 0) {
                echo "-";    
            } elseif ($status == 1) {
                echo "Biasa";
                
            } elseif ($status == 2) {
                echo "Penting";
            } else {
                
                echo "Segera";
            }
            ?>
        </td>
        <td> <?=  $valueSurat->klasifikasi->klasifikasi.':'.$valueSurat->klasifikasi->Keterangan; ?> </td>
        <td style="width:30%"><?= $valueSurat->perihal; ?> </td>
        <td><?php 
            $tanggalTeruskan = new DateTime($valueSurat->tanggalTerimaKirim);
            $tanggalDiteruskan = $tanggalTeruskan->format('d-m-Y');
            echo $tanggalDiteruskan; ?> </td>
    </tr>
    
    <?php
    $no++; 
    endforeach; ?>
</table>