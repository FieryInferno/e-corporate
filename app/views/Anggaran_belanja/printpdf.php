<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<title><?= $title; ?></title>
	<style type="text/css"> <?php echo $css ?> </style>
</head>
<body>
    <div class="float-left">
        <h3 class="m-1 font-weight-bold">ANGGARAN BELANJA</h3>
        <h3 class="m-1 font-weight-bold">DAFTAR KEBUTUHAN OPERATIONAL</h3>
        <h3 class="m-1 font-weight-bold">TAHUN 2021</h3>
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
        for ($i=0; $i < count($anggaranbelanja); $i++) { 
          $key  = $anggaranbelanja[$i]; ?> 
          <tr>
            <td><?= $key['akunno']; ?></td>
            <td><?= $key['namaakun']; ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?= number_format($key['totalsemua'],2,',','.'); ?></td>
            <td></td>
          </tr>
          <?php for ($j=0; $j < count($key['detail']); $j++) { 
            $value  = $key['detail'][$j]; ?>
            <tr>
              <td></td>
              <td><?= $value['namabarang']; ?></td>
              <td><?= $value['volume']; ?></td>
              <td><?= number_format($value['tarif'],2,',','.'); ?></td>
              <td><?= $value['satuan']; ?></td>
              <td><?= number_format($value['total'],2,',','.'); ?></td>
              <td></td>
            </tr>
          <?php }
        }
      ?>
    </tbody>
  </table>
</body>

</html>