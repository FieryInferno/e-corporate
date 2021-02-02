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
          <th class="text-center">Form No.</th>
          <th class="text-center">Recv Date</th>
          <th class="text-center">Cheque No</th>
          <th class="text-center">Cheque Date</th>
          <th class="text-center">Customer Name</th>
        </tr>
        <tr class="table-active">
          <th class="text-center">Invoice No.</th>
          <th class="text-center">Inv. Date</th>
          <th class="text-center">Total Received</th>
          <th class="text-center">Received Amt</th>
          <th class="text-center">Total Disc</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($laporan as $key) { ?>
            <tr>
              <td colspan="5"></td>
            </tr>
            <tr>
              <td class="font-weight-bold"><?= $key['formNo']; ?></td>
              <td class="font-weight-bold"><?= $key['recvDate']; ?></td>
              <td colspan="2" class="font-weight-bold text-center"><?= $key['recvDate']; ?></td>
              <td class="font-weight-bold"><?= $key['namaCustomer']; ?></td>
            </tr>
            <tr>
              <td class="text-right"><?= $key['invoiceNo']; ?></td>
              <td class="text-right"><?= $key['invoiceDate']; ?></td>
              <td class="text-right"><?= $key['total']; ?></td>
              <td class="text-right"><?= $key['total']; ?></td>
              <td class="text-right">0</td>
            </tr>
          <?php }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>