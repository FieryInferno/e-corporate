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

            foreach ($laporan[0]['total'] as $key => $value) { ?>
              <th class="font-weight-bold"><?= tgl_indo($key); ?></th>
            <?php }
          ?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td class="font-weight-bold">OPERATING REVENUE</td>
          <?php
            foreach ($laporan[0]['total'] as $key) { ?>
              <td></td>
            <?php }
          ?>
        </tr>
        <?php
          $totalOperatingRevenue = []; 
          foreach ($laporan[0]['total'] as $key) { 
            array_push($totalOperatingRevenue, 0);
          }
          foreach ($laporan as $key) { 
            if (substr($key['akunno'], 0, 1) == 4) { ?>
              <tr>
                <td><?= $key['akunno']; ?></td>
                <?php
                  $arrayNoAkun  = explode('.', $key['akunno']);
                  switch (count($arrayNoAkun)) {
                    case '1':
                      $periode  = 0; 
                      foreach ($key['total'] as $tot) {
                        $totalOperatingRevenue[$periode]  += (integer) $tot;
                        $periode++;
                      } ?>
                      <td class="font-weight-bold"><?= $key['namaakun']; ?></td>
                      <?php break;
                    case '2': ?>
                        <td class="font-weight-bold"><?= $key['namaakun']; ?></td>
                      <?php break;
                    case '3':?>
                        <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaakun']; ?></td>
                      <?php break;
                    case '4':?>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaakun']; ?></td>
                      <?php break;
                    
                    default:
                      # code...
                      break;
                  }
                  $periode  = 0;
                  foreach ($key['total'] as $value) { ?>
                    <td><?= $value; ?></td>
                  <?php }
                ?>
              </tr>
            <?php }
          }
        ?>
        <tr>
          <td></td>
          <td class="font-weight-bold">Total OPERATING REVENUE</td>
          <?php
            foreach ($totalOperatingRevenue as $tot) { ?>
              <td><?= $tot; ?></td>
            <?php }
          ?> 
        </tr>
        <tr>
          <td></td>
          <td class="font-weight-bold">Cost of Goods Sold</td>
          <?php
            foreach ($laporan[0]['total'] as $key) { ?>
              <td></td>
            <?php }
          ?>
        </tr>
        <?php
          $totalCost = []; 
          foreach ($laporan[0]['total'] as $key) { 
            array_push($totalCost, 0);
          }
          foreach ($laporan as $key) { 
            if (substr($key['akunno'], 0, 1) == 5) { ?>
              <tr>
                <td><?= $key['akunno']; ?></td>
                <?php
                  $arrayNoAkun  = explode('.', $key['akunno']);
                  switch (count($arrayNoAkun)) {
                    case '1':
                      $periode  = 0; 
                      foreach ($key['total'] as $tot) {
                        $totalCost[$periode]  += (integer) $tot;
                        $periode++;
                      } ?>
                      <td class="font-weight-bold"><?= $key['namaakun']; ?></td>
                      <?php break;
                    case '2': ?>
                        <td class="font-weight-bold"><?= $key['namaakun']; ?></td>
                      <?php break;
                    case '3':?>
                        <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaakun']; ?></td>
                      <?php break;
                    case '4':?>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaakun']; ?></td>
                      <?php break;
                    
                    default:
                      # code...
                      break;
                  }
                  $periode  = 0;
                  foreach ($key['total'] as $value) { ?>
                    <td><?= $value; ?></td>
                  <?php }
                ?>
              </tr>
            <?php }
          }
        ?>
        <tr>
          <td></td>
          <td class="font-weight-bold">Total Cost of Goods Sold</td>
          <?php
            foreach ($totalCost as $tot) { ?>
              <td><?= $tot; ?></td>
            <?php }
          ?> 
        </tr>
        <tr>
          <td></td>
          <td class="font-weight-bold">GROSS PROFIT</td>
          <?php
            foreach ($laporan[0]['total'] as $key) { ?>
              <td></td>
            <?php }
          ?>
        </tr>
        <?php
          $totalGross = []; 
          foreach ($laporan[0]['total'] as $key) { 
            array_push($totalGross, 0);
          }
          foreach ($laporan as $key) { 
            if (substr($key['akunno'], 0, 1) == 6) { ?>
              <tr>
                <td><?= $key['akunno']; ?></td>
                <?php
                  $arrayNoAkun  = explode('.', $key['akunno']);
                  switch (count($arrayNoAkun)) {
                    case '1':
                      $periode  = 0; 
                      foreach ($key['total'] as $tot) {
                        $totalGross[$periode]  += (integer) $tot;
                        $periode++;
                      } ?>
                      <td class="font-weight-bold"><?= $key['namaakun']; ?></td>
                      <?php break;
                    case '2': ?>
                        <td class="font-weight-bold"><?= $key['namaakun']; ?></td>
                      <?php break;
                    case '3':?>
                        <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaakun']; ?></td>
                      <?php break;
                    case '4':?>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaakun']; ?></td>
                      <?php break;
                    
                    default:
                      # code...
                      break;
                  }
                  $periode  = 0;
                  foreach ($key['total'] as $value) { ?>
                    <td><?= $value; ?></td>
                  <?php }
                ?>
              </tr>
            <?php }
          }
        ?>
        <tr>
          <td></td>
          <td class="font-weight-bold">Total GROSS PROFIT</td>
          <?php
            foreach ($totalGross as $tot) { ?>
              <td><?= $tot; ?></td>
            <?php }
          ?> 
        </tr>
        <tr>
          <td></td>
          <td class="font-weight-bold">INCOME FROM OPERATION</td>
          <?php
            foreach ($laporan[0]['total'] as $key) { ?>
              <td></td>
            <?php }
          ?>
        </tr>
        <tr>
          <td></td>
          <td class="font-weight-bold">Other Income and Expenses</td>
          <?php
            foreach ($laporan[0]['total'] as $key) { ?>
              <td></td>
            <?php }
          ?>
        </tr>
        <tr>
          <td></td>
              <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;Other Income</td>
          <?php
            foreach ($laporan[0]['total'] as $key) { ?>
              <td></td>
            <?php }
          ?>
        </tr>
        <?php
          $totalIncome = []; 
          foreach ($laporan[0]['total'] as $key) { 
            array_push($totalIncome, 0);
          }
          foreach ($laporan as $key) { 
            if (substr($key['akunno'], 0, 1) == 7) { ?>
              <tr>
                <td><?= $key['akunno']; ?></td>
                <?php
                  $arrayNoAkun  = explode('.', $key['akunno']);
                  switch (count($arrayNoAkun)) {
                    case '1':
                      $periode  = 0; 
                      foreach ($key['total'] as $tot) {
                        $totalIncome[$periode]  += (integer) $tot;
                        $periode++;
                      } ?>
                      <td class="font-weight-bold"><?= $key['namaakun']; ?></td>
                      <?php break;
                    case '2': ?>
                        <td class="font-weight-bold"><?= $key['namaakun']; ?></td>
                      <?php break;
                    case '3':?>
                        <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaakun']; ?></td>
                      <?php break;
                    case '4':?>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaakun']; ?></td>
                      <?php break;
                    
                    default:
                      # code...
                      break;
                  }
                  $periode  = 0;
                  foreach ($key['total'] as $value) { ?>
                    <td><?= $value; ?></td>
                  <?php }
                ?>
              </tr>
            <?php }
          }
        ?>
        <tr>
          <td></td>
          <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;Total Income</td>
          <?php
            foreach ($totalIncome as $tot) { ?>
              <td><?= $tot; ?></td>
            <?php }
          ?> 
        </tr>
        <tr>
          <td></td>
          <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;Other Expenses</td>
          <?php
            foreach ($laporan[0]['total'] as $key) { ?>
              <td></td>
            <?php }
          ?>
        </tr>
        <?php
          $totalExpenses = []; 
          foreach ($laporan[0]['total'] as $key) { 
            array_push($totalExpenses, 0);
          }
          foreach ($laporan as $key) { 
            if (substr($key['akunno'], 0, 1) == 8 || substr($key['akunno'], 0, 1) == 9) { ?>
              <tr>
                <td><?= $key['akunno']; ?></td>
                <?php
                  $arrayNoAkun  = explode('.', $key['akunno']);
                  switch (count($arrayNoAkun)) {
                    case '1':
                      $periode  = 0; 
                      foreach ($key['total'] as $tot) {
                        $totalExpenses[$periode]  += (integer) $tot;
                        $periode++;
                      } ?>
                      <td class="font-weight-bold"><?= $key['namaakun']; ?></td>
                      <?php break;
                    case '2': ?>
                        <td class="font-weight-bold"><?= $key['namaakun']; ?></td>
                      <?php break;
                    case '3':?>
                        <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaakun']; ?></td>
                      <?php break;
                    case '4':?>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaakun']; ?></td>
                      <?php break;
                    
                    default:
                      # code...
                      break;
                  }
                  $periode  = 0;
                  foreach ($key['total'] as $value) { ?>
                    <td><?= $value; ?></td>
                  <?php }
                ?>
              </tr>
            <?php }
          }
        ?>
        <tr>
          <td></td>
          <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;Total Expenses</td>
          <?php
            foreach ($totalExpenses as $tot) { ?>
              <td><?= $tot; ?></td>
            <?php }
          ?> 
        </tr>
        <tr>
          <td></td>
          <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;Total Income and Expenses</td>
          <?php
            for ($i=0; $i < count($totalIncome); $i++) { ?>
              <td><?= $totalIncome[$i] + $totalExpenses[$i]; ?></td>
            <?php }
          ?> 
        </tr>
      </tbody>
    </table>
  </div>
</body>

</html>