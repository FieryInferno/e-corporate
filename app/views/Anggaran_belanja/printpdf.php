<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<title><?php echo $title ?></title>
	<style type="text/css"> <?php echo $css ?> </style>
</head>
<body>
    <div class="float-left">
        <h3 class="m-1 font-weight-bold">ANGGARAN BELANJA</h3>
        <h3 class="m-1 font-weight-bold">DAFTAR KEBUTUHAN OPERATIONAL</h3>
        <h3 class="m-1 font-weight-bold">TAHUN 2020</h3>
        <h3 class="m-1 font-weight-bold">REKAPITULASI ANGGARAN ALL DIVISI</h3>
        <P class="m-1">(dalam ribuan rupiah)</P>
    </div>
    <div class="clearfix"></div>
  <table class="table" border="1">
    <thead>
      <tr class="table-warning">
        <th>No</th>
        <th>Jenis Biaya</th>
        <th>Volume</th>
        <th>Tarif</th>
        <th>Satuan</th>
        <th>Jumlah</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <tr class="bg-warning">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>NOMOR AKUN</td>
        <td>(................................................harap isi sesuai kebutuhan masing2)</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <?php

        $no = 0;
        for ($i=0; $i < count($anggaranbelanja); $i++) { ?> 
          <?php if ($i == 0 || ($anggaranbelanja[$i]['koderekening'] !== $anggaranbelanja[$no]['koderekening'])) { ?>
            <tr>
              <td><?= $anggaranbelanja[$i]['akunno']; ?></td>
              <td><?= $anggaranbelanja[$i]['namaakun']; ?></td>
              <td></td>
              <td></td>
              <td></td>
              <td><?= number_format($anggaranbelanja[$i]['totalsemua'],2,',','.'); ?></td>
              <td></td>
            </tr>
            <?php for ($j=0; $j < count($anggaranbelanja); $j++) { 
              if ($anggaranbelanja[$j]['koderekening'] == $anggaranbelanja[$i]['koderekening']) { ?>
                <tr>
                  <td></td>
                  <td><?= $anggaranbelanja[$j]['namabarang']; ?></td>
                  <td><?= $anggaranbelanja[$j]['volume']; ?></td>
                  <td><?= number_format($anggaranbelanja[$j]['tarif'],2,',','.'); ?></td>
                  <td><?= $anggaranbelanja[$j]['satuan']; ?></td>
                  <td><?= number_format($anggaranbelanja[$j]['total'],2,',','.'); ?></td>
                  <td></td>
                </tr>
              <?php }
            }
            $no = $i;
          }
        }
      ?>
    </tbody>
  </table>
</body>

</html>