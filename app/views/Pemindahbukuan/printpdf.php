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
                    <th><?php echo lang('No Kas Bank') ?></th>
                    <th><?php echo lang('company') ?></th>
                    <th><?php echo lang('information') ?></th>
                    <th><?php echo lang('date') ?></th>
                    <!-- <th><?php echo lang('Akun Kas Kecil') ?></th> -->
                    <th><?php echo lang('nominal') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($getdata): ?>
                    <?php $total = 0 ?>
                    <?php $no=1; foreach ($getdata as $row): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['nomor_kas_bank'] ?></td>
                            <td><?php echo $row['nama_perusahaan'] ?></td>
                            <td><?php echo $row['keterangan'] ?></td>
                            <td><?php echo $row['tanggal'] ?></td>
                            <!-- <td><?php echo $row['nomor_akun'] ?></td> -->
                            <?php $nominal = $row['penerimaan'] - $row['pengeluaran']; ?>
                            <?php $total = $total + $nominal ?>
                            <td class="text-right"><?php echo "Rp. " .number_format($nominal, 2, ",", ".") ?></td>
                        </tr>
                    <?php endforeach ?>
                     <tr class="bg-grey-300">
                        <td colspan="5">Total Pemindahbukuan
                        <?php if ($tipe_cetak == '0'){ ?> Periode <?php echo formatdatemonthname($_GET['tanggalawal']) ?> - <?php echo formatdatemonthname($_GET['tanggalakhir']); }?> </td>
                        <td class="text-right font-weight-bold"><?php echo "Rp. " .number_format($total, 2, ",", ".") ?></td>
                    </tr>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center"><?php echo lang('data_not_found') ?></td>
                        </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>

    <div class="footer"> </div>
</body>

</html>