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
        <p class="font-weight-bold"><?php echo $title ?></p>

    </div>
    <div class="float-right">
        <div class="w-25">
        </div>
    </div>
    <div class="clearfix mb-2">
        
    </div>
    <div class="w-25">
        <table class="table table-sm">
            <tbody>
                <tr>
                    <td width="100px"><?php echo lang('No Kas Bank') ?></td>
                    <td class="font-weight-bold" width="200px"><?php echo $nomor_kas_bank ?></td>
                </tr>
                <tr>
                    <td><?php echo lang('date') ?></td>
                    <td class="font-weight-bold"><?php echo $tanggal ?></td>
                </tr>
                <tr>
                    <td><?php echo lang('company') ?></td>
                    <td class="font-weight-bold"><?php echo $perusahaan['nama_perusahaan'] ?></td>
                </tr>
                <tr>
                    <td><?php echo lang('Departemen / Penerima') ?></td>
                    <td class="font-weight-bold"><?php echo $departemen['nama'] ?> / <?php echo $departemen['pejabat'] ?></td>
                </tr>
                <tr>
                    <td><?php echo lang('Keterangan') ?></td>
                    <td class="font-weight-bold"><?php echo $keterangan ?></td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="w-100">
        <table class="table table-sm table-border-bottom">
            <thead class="bg-light">
                <tr>
                    <th><?php echo lang('No') ?></th>
                    <th><?php echo lang('Tipe') ?></th>
                    <th><?php echo lang('date') ?></th>
                    <th><?php echo lang('Nomor Aktivitas') ?></th>
                    <th width="100px"><?php echo lang('Penerimaan') ?></th>
                    <th width="100px"><?php echo lang('Pengeluaran') ?></th>
                    <th><?php echo lang('Nomor Akun') ?></th>
                    <th><?php echo lang('Kode Unit') ?></th>
                    <th><?php echo lang('Nama Dapartemen') ?></th>
                    <th><?php echo lang('Sumber Dana') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; $total_penerimaan = 0; $total_pengeluaran= 0; ?>
                <?php foreach ($kasbankdetail as $row): ?>
                    <?php $total_penerimaan = $row['penerimaan'] + $total_penerimaan; 
                        $total_pengeluaran = $row['pengeluaran'] + $total_pengeluaran;
                    ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['tipe'] ?></td>
                            <td><?php echo $row['tanggal'] ?></td>
                            <td><?php echo $row['nokwitansi'] ?></td>
                            <td class="text-right">Rp. <?php echo number_format($row['penerimaan'],2,",",".") ?></td>
                            <td class="text-right">Rp. <?php echo number_format($row['pengeluaran'],2,",",".") ?></td>
                            <td><?php echo $row['nama_akun'].' '.$row['nomor_akun']?></td>
                            <td><?php echo $row['kode_perusahaan'] ?></td>
                            <td><?php echo $row['nama_departemen'] ?></td>
                            <td><?php echo $row['nama_bank'].' '.$row['nomor_rekening']?></td>
                        </tr>
                <?php endforeach ?>
                        <tr class="bg-light">
                            <td class="font-weight-bold text-right" colspan="4"><?php echo lang('grand_total') ?></td>
                            <td class="font-weight-bold text-right">Rp. <?php echo number_format($total_penerimaan,2,",",".") ?></td>
                            <td class="font-weight-bold text-right">Rp. <?php echo number_format($total_pengeluaran,2,",",".") ?></td>
                            <td colspan="4"></td>
                        </tr>
            </tbody>
        </table>
    </div>
    <div class="footer"> </div>
</body>

</html>