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
    <table class="table table-xs">
      <thead>
        <tr class="table-active">
          <th class="text-center">Nomor Akun</th>
          <th class="text-center">Description</th>
          <th class="text-center"><?= $tanggalAwal; ?></th>
          <th class="text-center"><?= $tanggalAkhir; ?></th>
          <th class="text-center">Variance</th>
          <th class="text-center">% Var.</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td class="font-weight-bold">OPERATING REVENUE</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <?php
          $totalOperatingRevenue0 = 0;
          $totalOperatingRevenue1 = 0;
          $totalVariance            = 0;
          $totalVar                 = 0;
          foreach ($laporan as $key) { 
            if (substr($key['akunno'], 0, 1) == 4) { 
              $variance = (integer) $key['total'][1] - (integer) $key['total'][0]; 
              if ($key['total'][0] !== 0) {
                $var  = $variance / (integer) $key['total'][0] * 100;
              } else {
                $var  = 100;
              }
              ?>
              <tr>
                <td><?= $key['akunno']; ?></td>
                <?php
                  $arrayNoAkun  = explode('.', $key['akunno']);
                  switch (count($arrayNoAkun)) {
                    case '1':
                      $totalOperatingRevenue0 += (integer) $key['total'][0]; 
                      $totalOperatingRevenue1 += (integer) $key['total'][1]; 
                      $totalVariance            += $variance; 
                      $totalVar                 += $var; ?>
                      <td class="font-weight-bold"><?= $key['namaakun']; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][0]; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][1]; ?></td>
                      <td class="font-weight-bold"><?= $variance; ?></td>
                      <td class="font-weight-bold"><?= $var; ?> %</td>
                      <?php break;
                    case '2': ?>
                      <td class="font-weight-bold"><?= $key['namaakun']; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][0]; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][1]; ?></td>
                      <td class="font-weight-bold"><?= $variance; ?></td>
                      <td class="font-weight-bold"><?= $var; ?> %</td>
                      <?php break;
                    case '3':?>
                      <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaakun']; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][0]; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][1]; ?></td>
                      <td class="font-weight-bold"><?= $variance; ?></td>
                      <td class="font-weight-bold"><?= $var; ?> %</td>
                      <?php break;
                    case '4':?>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaakun']; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][0]; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][1]; ?></td>
                      <td class="font-weight-bold"><?= $variance; ?></td>
                      <td class="font-weight-bold"><?= $var; ?> %</td>
                      <?php break;
                    
                    default:
                      # code...
                      break;
                  } ?>
              </tr>
            <?php }
          }
        ?>
        <tr>
          <td></td>
          <td class="font-weight-bold">Total OPERATING REVENUE</td>
          <td class="font-weight-bold"><?= $totalOperatingRevenue0; ?></td>
          <td class="font-weight-bold"><?= $totalOperatingRevenue1; ?></td>
          <td class="font-weight-bold"><?= $totalVariance; ?></td>
          <td class="font-weight-bold"><?= $totalVar; ?></td>
        </tr>
        <tr>
          <td></td>
          <td class="font-weight-bold">Cost of Goods Sold</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <?php
          $totalCost0   = 0;
          $totalCost1   = 0;
          $totalVariance  = 0;
          $totalVar       = 0;
          foreach ($laporan as $key) { 
            if (substr($key['akunno'], 0, 1) == 5) { 
              $variance = (integer) $key['total'][1] - (integer) $key['total'][0]; 
              if ($key['total'][0] !== 0) {
                $var  = $variance / (integer) $key['total'][0] * 100;
              } else {
                $var  = 100;
              } ?>
              <tr>
                <td><?= $key['akunno']; ?></td>
                <?php
                  $arrayNoAkun  = explode('.', $key['akunno']);
                  switch (count($arrayNoAkun)) {
                    case '1':
                      $totalCost0   += (integer) $key['total'][0]; 
                      $totalCost1   += (integer) $key['total'][1]; 
                      $totalVariance  += $variance; 
                      $totalVar       += $var; ?>
                      <td class="font-weight-bold"><?= $key['namaakun']; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][0]; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][1]; ?></td>
                      <td class="font-weight-bold"><?= $variance; ?></td>
                      <td class="font-weight-bold"><?= $var; ?> %</td>
                      <?php break;
                    case '2': ?>
                      <td class="font-weight-bold"><?= $key['namaakun']; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][0]; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][1]; ?></td>
                      <td class="font-weight-bold"><?= $variance; ?></td>
                      <td class="font-weight-bold"><?= $var; ?> %</td>
                      <?php break;
                    case '3':?>
                      <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaakun']; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][0]; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][1]; ?></td>
                      <td class="font-weight-bold"><?= $variance; ?></td>
                      <td class="font-weight-bold"><?= $var; ?> %</td>
                      <?php break;
                    case '4':?>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaakun']; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][0]; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][1]; ?></td>
                      <td class="font-weight-bold"><?= $variance; ?></td>
                      <td class="font-weight-bold"><?= $var; ?> %</td>
                      <?php break;
                    
                    default:
                      # code...
                      break;
                  } ?>
              </tr>
            <?php }
          }
        ?>
        <tr>
          <td></td>
          <td class="font-weight-bold">Total Cost of Goods Sold</td>
          <td class="font-weight-bold"><?= $totalCost0; ?></td>
          <td class="font-weight-bold"><?= $totalCost1; ?></td>
          <td class="font-weight-bold"><?= $totalVariance; ?></td>
          <td class="font-weight-bold"><?= $totalVar; ?></td>
        </tr>
        <tr>
          <td></td>
          <td class="font-weight-bold">GROSS PROFIT</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <?php
          $totalGross0  = 0;
          $totalGross1  = 0;
          $totalVariance  = 0;
          $totalVar       = 0;
          foreach ($laporan as $key) { 
            if (substr($key['akunno'], 0, 1) == 6) { 
              $variance = (integer) $key['total'][1] - (integer) $key['total'][0]; 
              if ($key['total'][0] !== 0) {
                $var  = $variance / (integer) $key['total'][0] * 100;
              } else {
                $var  = 100;
              } ?>
              <tr>
                <td><?= $key['akunno']; ?></td>
                <?php
                  $arrayNoAkun  = explode('.', $key['akunno']);
                  switch (count($arrayNoAkun)) {
                    case '1':
                      $totalGross0  += (integer) $key['total'][0]; 
                      $totalGross1  += (integer) $key['total'][1]; 
                      $totalVariance  += $variance; 
                      $totalVar       += $var; ?>
                      <td class="font-weight-bold"><?= $key['namaakun']; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][0]; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][1]; ?></td>
                      <td class="font-weight-bold"><?= $variance; ?></td>
                      <td class="font-weight-bold"><?= $var; ?> %</td>
                      <?php break;
                    case '2': ?>
                      <td class="font-weight-bold"><?= $key['namaakun']; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][0]; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][1]; ?></td>
                      <td class="font-weight-bold"><?= $variance; ?></td>
                      <td class="font-weight-bold"><?= $var; ?> %</td>
                      <?php break;
                    case '3':?>
                      <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaakun']; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][0]; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][1]; ?></td>
                      <td class="font-weight-bold"><?= $variance; ?></td>
                      <td class="font-weight-bold"><?= $var; ?> %</td>
                      <?php break;
                    case '4':?>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaakun']; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][0]; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][1]; ?></td>
                      <td class="font-weight-bold"><?= $variance; ?></td>
                      <td class="font-weight-bold"><?= $var; ?> %</td>
                      <?php break;
                    
                    default:
                      # code...
                      break;
                  } ?>
              </tr>
            <?php }
          }
        ?>
        <tr>
          <td></td>
          <td class="font-weight-bold">Total GROSS PROFIT</td>
          <td class="font-weight-bold"><?= $totalGross0; ?></td>
          <td class="font-weight-bold"><?= $totalGross1; ?></td>
          <td class="font-weight-bold"><?= $totalVariance; ?></td>
          <td class="font-weight-bold"><?= $totalVar; ?></td>
        </tr>
        <tr>
          <td></td>
          <td class="font-weight-bold">INCOME FROM OPERATION</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td class="font-weight-bold">Other Income and Expenses</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;Other Income</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <?php
          $totalIncome0 = 0;
          $totalIncome1 = 0;
          $totalVariance  = 0;
          $totalVar       = 0;
          foreach ($laporan as $key) { 
            if (substr($key['akunno'], 0, 1) == 7) { 
              $variance = (integer) $key['total'][1] - (integer) $key['total'][0]; 
              if ($key['total'][0] !== 0) {
                $var  = $variance / (integer) $key['total'][0] * 100;
              } else {
                $var  = 100;
              } ?>
              <tr>
                <td><?= $key['akunno']; ?></td>
                <?php
                  $arrayNoAkun  = explode('.', $key['akunno']);
                  switch (count($arrayNoAkun)) {
                    case '1':
                      $totalIncome0 += (integer) $key['total'][0]; 
                      $totalIncome1 += (integer) $key['total'][1]; 
                      $totalVariance  += $variance; 
                      $totalVar       += $var; ?>
                      <td class="font-weight-bold"><?= $key['namaakun']; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][0]; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][1]; ?></td>
                      <td class="font-weight-bold"><?= $variance; ?></td>
                      <td class="font-weight-bold"><?= $var; ?> %</td>
                      <?php break;
                    case '2': ?>
                      <td class="font-weight-bold"><?= $key['namaakun']; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][0]; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][1]; ?></td>
                      <td class="font-weight-bold"><?= $variance; ?></td>
                      <td class="font-weight-bold"><?= $var; ?> %</td>
                      <?php break;
                    case '3':?>
                      <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaakun']; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][0]; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][1]; ?></td>
                      <td class="font-weight-bold"><?= $variance; ?></td>
                      <td class="font-weight-bold"><?= $var; ?> %</td>
                      <?php break;
                    case '4':?>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaakun']; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][0]; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][1]; ?></td>
                      <td class="font-weight-bold"><?= $variance; ?></td>
                      <td class="font-weight-bold"><?= $var; ?> %</td>
                      <?php break;
                    
                    default:
                      # code...
                      break;
                  } ?>
              </tr>
            <?php }
          }
        ?>
        <tr>
          <td></td>
          <td class="font-weight-bold">Total Income</td>
          <td class="font-weight-bold"><?= $totalIncome0; ?></td>
          <td class="font-weight-bold"><?= $totalIncome1; ?></td>
          <td class="font-weight-bold"><?= $totalVariance; ?></td>
          <td class="font-weight-bold"><?= $totalVar; ?></td>
        </tr>
        <tr>
          <td></td>
          <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;Other Expenses</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <?php
          $totalExpenses0 = 0;
          $totalExpenses1 = 0;
          $totalVariance    = 0;
          $totalVar         = 0;
          foreach ($laporan as $key) { 
            if (substr($key['akunno'], 0, 1) == 8 || substr($key['akunno'], 0, 1) == 9) { 
              $variance = (integer) $key['total'][1] - (integer) $key['total'][0]; 
              if ($key['total'][0] !== 0) {
                $var  = $variance / (integer) $key['total'][0] * 100;
              } else {
                $var  = 100;
              } ?>
              <tr>
                <td><?= $key['akunno']; ?></td>
                <?php
                  $arrayNoAkun  = explode('.', $key['akunno']);
                  switch (count($arrayNoAkun)) {
                    case '1':
                      $totalExpenses0 += (integer) $key['total'][0]; 
                      $totalExpenses1 += (integer) $key['total'][1]; 
                      $totalVariance    += $variance; 
                      $totalVar         += $var; ?>
                      <td class="font-weight-bold"><?= $key['namaakun']; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][0]; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][1]; ?></td>
                      <td class="font-weight-bold"><?= $variance; ?></td>
                      <td class="font-weight-bold"><?= $var; ?> %</td>
                      <?php break;
                    case '2': ?>
                      <td class="font-weight-bold"><?= $key['namaakun']; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][0]; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][1]; ?></td>
                      <td class="font-weight-bold"><?= $variance; ?></td>
                      <td class="font-weight-bold"><?= $var; ?> %</td>
                      <?php break;
                    case '3':?>
                      <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaakun']; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][0]; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][1]; ?></td>
                      <td class="font-weight-bold"><?= $variance; ?></td>
                      <td class="font-weight-bold"><?= $var; ?> %</td>
                      <?php break;
                    case '4':?>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaakun']; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][0]; ?></td>
                      <td class="font-weight-bold"><?= $key['total'][1]; ?></td>
                      <td class="font-weight-bold"><?= $variance; ?></td>
                      <td class="font-weight-bold"><?= $var; ?> %</td>
                      <?php break;
                    
                    default:
                      # code...
                      break;
                  } ?>
              </tr>
            <?php }
          }
        ?>
        <tr>
          <td></td>
          <td class="font-weight-bold">Total Expenses</td>
          <td class="font-weight-bold"><?= $totalExpenses0; ?></td>
          <td class="font-weight-bold"><?= $totalExpenses1; ?></td>
          <td class="font-weight-bold"><?= $totalVariance; ?></td>
          <td class="font-weight-bold"><?= $totalVar; ?></td>
        </tr>
        <tr>
          <td></td>
          <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;Total Income and Expenses</td>
          <td class="font-weight-bold"><?= $totalIncome0 + $totalExpenses0; ?></td>
          <td class="font-weight-bold"><?= $totalIncome1 + $totalExpenses1; ?></td>
          <td class="font-weight-bold"><?= ($totalIncome1 + $totalExpenses1) - ($totalIncome0 + $totalExpenses0); ?></td>
          <td class="font-weight-bold"><?= ($totalIncome1 + $totalExpenses1) - ($totalIncome0 + $totalExpenses0) / ($totalIncome0 + $totalExpenses0) * 100; ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</body>

</html>