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
          if ($laporan !== null) { ?>
            <tr>
              <td></td>
              <td class="font-weight-bold">OPERATING REVENUE</td>
              <td></td>
            </tr>
            <?php 
            $totalOperatingRevenue  = 0;
            foreach ($laporan as $key) { 
              if (substr($key['akunno'], 0, 1) == 4) { ?>
                <tr>
                  <td><?= $key['akunno']; ?></td>
                  <?php
                    $arrayNoAkun  = explode('.', $key['akunno']);
                    switch (count($arrayNoAkun)) {
                      case '1': 
                        $totalOperatingRevenue  += $key['total']; ?>
                        <td class="font-weight-bold"><?= $key['namaAkun']; ?></td>
                        <?php break;
                      case '2': ?>
                        <td class="font-weight-bold"><?= $key['namaAkun']; ?></td>
                        <?php break;
                      case '3':?>
                        <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaAkun']; ?></td>
                        <?php break;
                      case '4':?>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaAkun']; ?></td>
                        <?php break;
                      
                      default:
                        # code...
                        break;
                    } ?>
                  <td><?= $key['total']; ?></td>
                </tr>
              <?php }
            } ?>
            <tr>
              <td></td>
              <td class="font-weight-bold">Total OPERATING REVENUE</td>
              <td><?= $totalOperatingRevenue; ?></td>
            </tr>
            <tr>
              <td></td>
              <td class="font-weight-bold">Cost of Goods Sold</td>
              <td></td>
            </tr>
            <?php 
            $totalCost  = 0;
            foreach ($laporan as $key) { 
              if (substr($key['akunno'], 0, 1) == 5) { ?>
                <tr>
                  <td><?= $key['akunno']; ?></td>
                  <?php
                    $arrayNoAkun  = explode('.', $key['akunno']);
                    switch (count($arrayNoAkun)) {
                      case '1': 
                        $totalCost  += $key['total']; ?>
                        <td class="font-weight-bold"><?= $key['namaAkun']; ?></td>
                        <?php break;
                      case '2': ?>
                        <td class="font-weight-bold"><?= $key['namaAkun']; ?></td>
                        <?php break;
                      case '3':?>
                        <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaAkun']; ?></td>
                        <?php break;
                      case '4':?>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaAkun']; ?></td>
                        <?php break;
                      
                      default:
                        # code...
                        break;
                    } ?>
                  <td><?= $key['total']; ?></td>
                </tr>
              <?php }
            }?>
            <tr>
              <td></td>
              <td class="font-weight-bold">Total Cost of Goods Sold</td>
              <td><?= $totalCost; ?></td>
            </tr>
            <tr>
              <td></td>
              <td class="font-weight-bold">GROSS PROFIT</td>
              <td></td>
            </tr>
            <?php 
            $totalGross  = 0;
            foreach ($laporan as $key) { 
              if (substr($key['akunno'], 0, 1) == 6) { ?>
                <tr>
                  <td><?= $key['akunno']; ?></td>
                  <?php
                    $arrayNoAkun  = explode('.', $key['akunno']);
                    switch (count($arrayNoAkun)) {
                      case '1': 
                        $totalGross  += $key['total']; ?>
                        <td class="font-weight-bold"><?= $key['namaAkun']; ?></td>
                        <?php break;
                      case '2': ?>
                        <td class="font-weight-bold"><?= $key['namaAkun']; ?></td>
                        <?php break;
                      case '3':?>
                        <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaAkun']; ?></td>
                        <?php break;
                      case '4':?>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaAkun']; ?></td>
                        <?php break;
                      
                      default:
                        # code...
                        break;
                    } ?>
                  <td><?= $key['total']; ?></td>
                </tr>
              <?php }
            }?>
            <tr>
              <td></td>
              <td class="font-weight-bold">Total GROSS PROFIT</td>
              <td><?= $totalGross; ?></td>
            </tr>
            <tr>
              <td></td>
              <td class="font-weight-bold">INCOME FROM OPERATION</td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td class="font-weight-bold">Other Income and Expenses</td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;Other Income</td>
              <td></td>
            </tr>
            <?php 
            $totalIncome  = 0;
            foreach ($laporan as $key) { 
              if (substr($key['akunno'], 0, 1) == 7) { ?>
                <tr>
                  <td><?= $key['akunno']; ?></td>
                  <?php
                    $arrayNoAkun  = explode('.', $key['akunno']);
                    switch (count($arrayNoAkun)) {
                      case '1': 
                        $totalIncome  += $key['total']; ?>
                        <td class="font-weight-bold"><?= $key['namaAkun']; ?></td>
                        <?php break;
                      case '2': ?>
                        <td class="font-weight-bold"><?= $key['namaAkun']; ?></td>
                        <?php break;
                      case '3':?>
                        <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaAkun']; ?></td>
                        <?php break;
                      case '4':?>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaAkun']; ?></td>
                        <?php break;
                      
                      default:
                        # code...
                        break;
                    } ?>
                  <td><?= $key['total']; ?></td>
                </tr>
              <?php }
            }?>
            <tr>
              <td></td>
              <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;Total Income</td>
              <td><?= $totalIncome; ?></td>
            </tr>
            <tr>
              <td></td>
              <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;Other Expenses</td>
              <td></td>
            </tr>
            <?php 
            $totalExpenses  = 0;
            foreach ($laporan as $key) { 
              if (substr($key['akunno'], 0, 1) == 8 || substr($key['akunno'], 0, 1) == 9) { ?>
                <tr>
                  <td><?= $key['akunno']; ?></td>
                  <?php
                    $arrayNoAkun  = explode('.', $key['akunno']);
                    switch (count($arrayNoAkun)) {
                      case '1': 
                        $totalExpenses  += $key['total']; ?>
                        <td class="font-weight-bold"><?= $key['namaAkun']; ?></td>
                        <?php break;
                      case '2': ?>
                        <td class="font-weight-bold"><?= $key['namaAkun']; ?></td>
                        <?php break;
                      case '3':?>
                        <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaAkun']; ?></td>
                        <?php break;
                      case '4':?>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $key['namaAkun']; ?></td>
                        <?php break;
                      
                      default:
                        # code...
                        break;
                    } ?>
                  <td><?= $key['total']; ?></td>
                </tr>
              <?php }
            }?>
            <tr>
              <td></td>
              <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;Total Expenses</td>
              <td><?= $totalExpenses; ?></td>
            </tr>
            <tr>
              <td></td>
              <td class="font-weight-bold">&nbsp;&nbsp;&nbsp;&nbsp;Total Income and Expenses</td>
              <td><?= $totalIncome + $totalExpenses; ?></td>
            </tr>
          <?php }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>