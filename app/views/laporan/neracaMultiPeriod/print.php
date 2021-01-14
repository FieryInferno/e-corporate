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
    <h3 class="m-1">Period <?= $tanggalAwal; ?> to <?= $tanggalAkhir; ?></h3>
  </div>
  <br>
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead>
        <tr class="table-active">
          <th class="font-weight-bold" style="width: 35%;">Description</th>
            <?php
              function tgl_indo($tanggal){
                $bulan = array (
                  1 => 'Januari',
                  'Februari',
                  'Maret',
                  'April',
                  'Mei',
                  'Juni',
                  'Juli',
                  'Agustus',
                  'September',
                  'Oktober',
                  'November',
                  'Desember'
                );
                $pecahkan = explode('-', $tanggal);
                return $bulan[(integer)$pecahkan[0] ] . ' ' . $pecahkan[1];
              }

              foreach ($laporan as $key => $value) { ?>
                <th class="font-weight-bold"><?= tgl_indo($key); ?></th>
              <?php }
            ?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="font-weight-bold" colspan="<?= count($laporan) + 1; ?>">Aset Lancar</td>
        </tr>
        <?php
          $asetLancar = [];
          foreach ($laporan as $key => $value) { 
            foreach ($value as $k => $v) {
              if ($k == 'asetLancar' && $v !== null) {
                foreach ($v as $a => $b) { 
                  if (!in_array($b['noakun'], $asetLancar)) { ?>
                    <tr>
                      <td><?= $b['namaakun']; ?></td>
                      <?php 
                        foreach ($laporan as $c => $d) { ?>
                          <td>
                            <?php 
                              foreach ($d as $e => $f) {
                                if ($e == 'asetLancar') {
                                  if ($f) {
                                    foreach ($f as $g => $h) { 
                                      if ($b['noakun'] == $h['noakun']) { 
                                        echo $h['debet'];
                                      }
                                    }
                                  } else {
                                    echo '0,00';
                                  }
                                }
                              }
                            ?>
                          </td>
                        <?php }
                      ?>
                    </tr>
                  <?php 
                    array_push($asetLancar, $b['noakun']);
                  }
                }
              }
            }
          }
        ?>
        <tr>
          <td class="font-weight-bold" colspan="<?= count($laporan) + 1; ?>">Liabilitas</td>
        </tr>
        <?php
          $liabilitas = [];
          foreach ($laporan as $key => $value) { 
            foreach ($value as $k => $v) {
              if ($k == 'liabilitas' && $v !== null) {
                foreach ($v as $a => $b) {
                  if (!in_array($b['noakun'], $liabilitas)) { ?>
                    <tr>
                      <td><?= $b['namaakun']; ?></td>
                      <?php 
                        foreach ($laporan as $c => $d) { ?>
                          <td>
                            <?php 
                              foreach ($d as $e => $f) {
                                if ($e == 'liabilitas') {
                                  if ($f) {
                                    foreach ($f as $g => $h) { 
                                      if ($b['noakun'] == $h['noakun']) { 
                                        echo $h['kredit'];
                                      }
                                    }
                                  } else {
                                    echo '0,00';
                                  }
                                }
                              }
                            ?>
                          </td>
                        <?php }
                      ?>
                    </tr>
                  <?php 
                    array_push($liabilitas, $b['noakun']);
                  }
                }
              }
            }
          }
        ?>
        <tr>
          <td class="font-weight-bold" colspan="<?= count($laporan) + 1; ?>">Ekuitas</td>
        </tr>
        <?php
          $ekuitas  = [];
          foreach ($laporan as $key => $value) { 
            foreach ($value as $k => $v) {
              if ($k == 'ekuitas' && $v !== null) {
                foreach ($v as $a => $b) {
                  if (!in_array($b['noakun'], $ekuitas)) { ?>
                    <tr>
                      <td><?= $b['namaakun']; ?></td>
                      <?php 
                        foreach ($laporan as $c => $d) { ?>
                          <td>
                            <?php 
                              foreach ($d as $e => $f) {
                                if ($e == 'ekuitas') {
                                  if ($f) {
                                    foreach ($f as $g => $h) { 
                                      if ($b['noakun'] == $h['noakun']) { 
                                        echo $h['kredit'];
                                      }
                                    }
                                  } else {
                                    echo '0,00';
                                  }
                                }
                              }
                            ?>
                          </td>
                        <?php }
                      ?>
                    </tr>
                  <?php 
                    array_push($ekuitas, $b['noakun']);
                  }
                }
              }
            }
          }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>