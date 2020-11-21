<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<title><?php echo $title ?></title>
	<style type="text/css"> <?php echo $css ?> </style>
</head>
<body>
    <div class="text-center">
        <h3 class="m-1 font-weight-bold">BUKU KAS BANK</h3>
        <h3 class="m-1 font-weight-bold">
            <?php 
                $data   = $this->db->get_where('mperusahaan', [
                    'idperusahaan'    => $perusahaan
                ])->row_array(); 
                echo $data['nama_perusahaan'];
            ?>
        </h3>
        <h3 class="m-1">Tanggal : <?= $tanggal; ?></h3>
    </div>
    <br>
    <h5 class="m-1 font-weight-bold"> Nama Rekening Bank :
        <?php
            $data   = $this->db->get_where('mrekening', [
                'id'    => $rekening
            ])->row_array();
            echo $data['nama'] . ' - ' . $data['norek'];
        ?>
    </h5>
    <h5 class="m-1">
        Tahun Anggaran  : 2020<br>
        Halaman         : 1
    </h5>
    <div class="clearfix"></div>
    <div class="table-responsive">
        <table class="table table-xs" border="1">
            <thead>
                <tr class="table-active">
                    <th class="text-center">No Kas</th>
                    <th class="text-center">Uraian</th>
                    <th class="text-center">Penerimaan</th>
                    <th class="text-center">Pengeluaran</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($laporan !== null) { 
                        $jumlahDebet    = 0;
                        $jumlahKredit   = 0; 

                        function terbilang($nilai) {
                            if($nilai<0) {
                                $hasil = "minus ". trim(penyebut($nilai));
                            } else {
                                $hasil = trim(penyebut($nilai));
                            }     		
                            return $hasil;
                        }
                        ?>
                        <tr>
                            <td></td>
                            <td class="text-center"><strong>Jumlah Sampai dengan Tanggal <?= $tanggal; ?></strong></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php foreach ($laporan as $key) {
                            foreach ($key as $value) { ?>
                                <tr>
                                    <td class="text-center"><?= $value['no']; ?></td>
                                    <td class="text-center"><?= $value['keterangan']; ?></td>
                                    <td class="text-center"><?= number_format($value['debet'],2,',','.'); ?></td>
                                    <td class="text-center"><?= number_format($value['kredit'],2,',','.'); ?></td>
                                </tr>
                            <?php 
                                $jumlahDebet    += $value['debet'];
                                $jumlahKredit   += $value['kredit'];
                            }
                        } ?>
                        <tr>
                            <td class="text-center" colspan="2"><strong>Jumlah Tanggal <?= $tanggal; ?></strong></td>
                            <td class="text-center"><strong><?= number_format($jumlahDebet,2,',','.'); ?></strong></td>
                            <td class="text-center"><strong><?= number_format($jumlahKredit,2,',','.'); ?></strong></td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2"><strong>Jumlah Sampai dengan Tanggal <?= $tanggalAwal; ?></strong></td>
                            <td class="text-center"><strong><?= number_format($jumlahDebetAwal,2,',','.'); ?></strong></td>
                            <td class="text-center"><strong><?= number_format($jumlahKreditAwal,2,',','.'); ?></strong></td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2"><strong>Jumlah Sampai dengan Tanggal <?= $tanggal; ?></strong></td>
                            <td class="text-center"><strong><?= number_format(($jumlahDebetAwal + $jumlahDebet),2,',','.'); ?></strong></td>
                            <td class="text-center"><strong><?= number_format(($jumlahKreditAwal + $jumlahKredit),2,',','.'); ?></strong></td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2"><strong>Saldo Hari ini Tanggal <?= $tanggal; ?></strong></td>
                            <td class="text-center"></td>
                            <td class="text-center"><strong><?= number_format((($jumlahDebetAwal + $jumlahDebet) - ($jumlahKreditAwal + $jumlahKredit)),2,',','.'); ?></strong></td>
                        </tr>
                        <tr>
                            <td colspan="4"><strong>Sisa dengan huruf : <?= strtoupper(terbilang((($jumlahDebetAwal + $jumlahDebet) - ($jumlahKreditAwal + $jumlahKredit)))) . ' RUPIAH'; ?></strong></td>
                        </tr>
                    <?php }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>