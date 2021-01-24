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
          <th class="text-center">Description</th>
          <th class="text-center">Nominal</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if ($laporan !== null) { 
            $rekeningKakek  = [];
            $rekeningAyah   = [];
            $rekeningAnak   = [];

            foreach ($laporan as $key) { 
              $arrayAkunno    = explode('.', $key['akunno']);
              if (!in_array($arrayAkunno['0'], $rekeningKakek)) array_push($rekeningKakek, $arrayAkunno['0']); 
              if (!in_array($arrayAkunno['0'] . '.' . $arrayAkunno['1'], $rekeningAyah)) array_push($rekeningAyah, $arrayAkunno['0'] . '.' . $arrayAkunno['1']);
              if (!in_array($key['akunno'], $rekeningAnak)) array_push($rekeningAnak, $key['akunno']);
            }

            foreach ($rekeningKakek as $key) { 
              $noakun = $this->db->get_where('mnoakun', [
                'akunno'  => $key
              ])->row_array(); 
              if ($noakun) { ?> 
                <tr>
                  <td><?= $key; ?></td>
                  <td><?php print_r($noakun); ?></td>
                </tr>
              <?php 
              }
              foreach ($rekeningAyah as $value) {
                $arrayRekeningAyah  = explode('.', $value);
                if ($arrayRekeningAyah[0] == $key) {
                  $noakunAyah = $this->db->get_where('mnoakun', [
                    'akunno'  => $value
                  ])->row_array(); 
                  if ($noakunAyah) { ?>
                    <tr>
                      <td><?= $noakunAyah['namaakun']; ?></td>
                      <td></td>
                    </tr>
                  <?php 
                  }
                  foreach ($laporan as $anak) {
                    $arrayRekeningAnak  = explode('.', $anak['akunno']);
                    if ($arrayRekeningAnak[0] . '.' . $arrayRekeningAnak[1] == $value) { ?>
                      <tr>
                        <td><?= $anak['namaakun']; ?></td>
                        <td><?= $anak['saldo']; ?></td>
                      </tr>
                    <?php 
                    }
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