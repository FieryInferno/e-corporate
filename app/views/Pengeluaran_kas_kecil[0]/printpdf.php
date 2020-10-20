<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<title><?php echo $title ?></title>
	<style type="text/css"> <?php echo $css ?> </style>
</head>
<body>
    <div class="float-left">
    	<h3 class="text-danger m-1 font-weight-bold"><?php echo get_pengaturan('instansi') ?></h3>
    </div>
    <div class="clearfix"></div>
	<hr class="hr">
    <div class="float-left">
        <p class="font-weight-bold">
            <?php echo $title ?> <br>
            <?php if ($tipe_cetak == '0'){
                        echo formatdatemonthname($_GET['tanggalawal']) ?> - <?php echo formatdatemonthname($_GET['tanggalakhir']);
                  }
            ?>
        </p>
    </div>
    <div class="clearfix mb-2"></div>


    <div class="w-100">
        <table class="table table-sm table-border-bottom">
            <thead class="bg-light">
                <tr>
                    <th><?php echo lang('No') ?></th>
                    <th><?php echo lang('no_receipt') ?></th>
                    <th><?php echo lang('information') ?></th>
                    <th><?php echo lang('date') ?></th>
                    <th><?php echo lang('company') ?></th>
                    <th><?php echo lang('Departemen') ?></th>
                    <th><?php echo lang('Status') ?></th>
                    <th><?php echo lang('nominal') ?></th>
                    
                </tr>
            </thead>
            <tbody>
                <?php if ($getdata): ?>
                    <?php $totalpengeluaran = 0 ?>
                    <?php $no=1; foreach ($getdata as $row): ?>
                    <?php $totalpengeluaran = $totalpengeluaran + $row['subtotal'] ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['nokwitansi'] ?></td>
                            <td><?php echo $row['keterangan'] ?></td>
                            <td><?php echo $row['tanggal'] ?></td>
                            <td><?php echo $row['nama_perusahaan'] ?></td>
                            <td><?php echo $row['nama'] ?></td>
                            <td><?php  if ($row['status'] == '1'){
                                echo 'Validasi';
                            } else { echo 'Menunggu';}
                            ?></td>
                            <td class="text-right"><?php echo "Rp. " .number_format($row['subtotal'], 2, ",", ".") ?></td>
                        </tr>
                    <?php endforeach ?>
                        <tr class="bg-grey-300">
                            <td colspan="6">Total Pengeluaran Kas Kecil 
                                <?php if ($tipe_cetak == '0'){ ?>
                                    Periode <?php echo formatdatemonthname($_GET['tanggalawal']) ?> - <?php echo formatdatemonthname($_GET['tanggalakhir']); }?> </td>
                            <td class="text-right font-weight-bold" colspan="2"><?php echo "Rp. " .number_format($totalpengeluaran, 2, ",", ".") ?></td>
                            <td></td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center"><?php echo lang('data_not_found') ?></td>
                        </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>

    <div class="footer"> </div>
</body>

</html>