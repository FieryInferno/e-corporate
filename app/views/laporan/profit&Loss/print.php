<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<title><?php echo $title ?></title>
	<style type="text/css"> <?php echo $css ?> </style>
</head>
<body>
  <div class="text-center">
    <h3 class="m-1 font-weight-bold"><?= $perusahaan['nama_perusahaan']; ?></h3>
    <h3 class="m-1 font-weight-bold"><?= $title; ?></h3>
    <h3 class="m-1">From <?= $tanggalAwal; ?> to <?= $tanggalAkhir; ?></h3>
  </div>
  <br>
  <div class="clearfix"></div>
  <div class="table-responsive">
    <table class="table table-xs" border="1">
      <thead>
        <tr class="table-active">
          <th class="text-center">Nomor Akun</th>
          <th class="text-center">Description</th>
          <th class="text-center">Nominal</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if ($laporan !== null) { 
            foreach ($laporan as $key) { ?>
              <tr>
                <td><?= $key['akunno']; ?></td>
                <td><?= $key['namaAkun']; ?></td>
                <td><?= $key['total']; ?></td>
              </tr>
            <?php }
          }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>