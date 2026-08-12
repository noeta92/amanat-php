<div style="text-align:center">
        <h3>  <strong> Rekapitulasi Surat Keluar  </strong></h3>
        <h4>Bappedalitbang Deli Serdang </h4>
 </div>
<hr>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>No.</th>
        <th>Tanggal Surat </th>
        <th>No Surat </th>
        <th>Tujuan</th>
        <th>Status Surat</th>
        <th>Kode Klasifikasi </th>
        <th>Perihal </th>
    </tr>
    </thead>
    <?php
     $no = 1;
     foreach ($modelSurat as $valueSurat): ?>
        <tr>
        <td><?= $no ?></td>
        <td><?php
            $tanggal = new DateTime($valueSurat->tanggalSurat);
            $tanggalSurat = $tanggal->format('d-m-Y');
            echo $tanggalSurat; ?> </td>
        <td style="width:20%"><?= $valueSurat->noSurat ; ?> </td>
        <td> <?= $valueSurat->asalTujuan; ?> </td>
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
        <td> <?=  $valueSurat->klasifikasi->klasifikasi; ?> </td>
        <td style="width:30%"><?= $valueSurat->perihal; ?> </td>
        
    </tr>
    
    <?php
    $no++; 
    endforeach; ?>
</table>