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
          <th class="text-center" style="border-bottom: 1px solid black">Invoice No.</th>
          <th class="text-center" style="border-bottom: 1px solid black">Inv. Date</th>
          <th class="text-center" style="border-bottom: 1px solid black">Total Paid</th>
          <th class="text-center" style="border-bottom: 1px solid black">Payment Amount</th>
          <th class="text-center" style="border-bottom: 1px solid black">Total Disc</th>
          <th class="text-center" style="border-bottom: 1px solid black">Disc. (DP) Accnt</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan="5"></td>
        </tr>
        <?php
          foreach ($laporan as $key) { ?>
            <tr>
              <td class="font-weight-bold"><?= $key['formNo']; ?></td>
              <td class="font-weight-bold"><?= $key['recvDate']; ?></td>
              <td colspan="2" class="font-weight-bold text-center"><?= $key['recvDate']; ?></td>
              <td class="font-weight-bold"><?= $key['namaCustomer']; ?></td>
              <td class="font-weight-bold"><?= $key['rekening']; ?></td>
            </tr>
            <tr>
              <td class="text-right"><?= $key['invoiceNo']; ?></td>
              <td class="text-right"><?= $key['invoiceDate']; ?></td>
              <td class="text-right" style="border-bottom: 1px solid black"><?= $key['total']; ?></td>
              <td class="text-right" style="border-bottom: 1px solid black"><?= $key['total']; ?></td>
              <td class="text-right" style="border-bottom: 1px solid black"><?= $key['diskon']; ?></td>
              <td class="text-right"></td>
            </tr>
            <tr>
              <td class="text-right"></td>
              <td class="text-right"></td>
              <td class="text-right text-primary"><?= $key['total']; ?></td>
              <td class="text-right text-primary"><?= $key['total']; ?></td>
              <td class="text-right text-primary"><?= $key['diskon']; ?></td>
              <td class="text-right"></td>
            </tr>
          <?php }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>