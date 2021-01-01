<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<title><?php echo $title ?></title>
	<style type="text/css"> <?php echo $css ?> </style>
</head>
<body>
    <div class="text-center">
        <h3 class="m-1 font-weight-bold">
            <?php 
                $data   = $this->db->get_where('mperusahaan', [
                    'idperusahaan'    => $perusahaan
                ])->row_array(); 
                echo $data['nama_perusahaan'];
            ?>
        </h3>
        <h3 class="m-1 font-weight-bold">Project List</h3>
        <h3 class="m-1">From <?= $tanggalAwal; ?> to <?= $tanggalAkhir; ?></h3>
    </div>
    <br>
    <div class="clearfix"></div>
    <div class="table-responsive">
        <table class="table table-xs" border="1">
            <thead>
                <tr class="table-active">
                    <th class="text-center">Nomor Event</th>
                    <th class="text-center">Nama Event</th>
                    <th class="text-center">Region</th>
                    <th class="text-center">Cabang</th>
                    <th class="text-center">Pendapatan</th>
                    <th class="text-center">HPP</th>
                    <th class="text-center">Kode Event</th>
                    <th class="text-center">Kategori Usia</th>
                    <th class="text-center">Tgl Mulai</th>
                    <th class="text-center">Tgl Selesai</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    function tgl_indo($tanggal){
                        $bulan = array (
                            1 =>   'Januari',
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
                        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                    }

                    if ($laporan !== null) {  
                        foreach ($laporan as $value) { ?>
                            <tr>
                                <td class="text-center"><?= $value['noEvent']; ?></td>
                                <td class="text-center"><?= $value['deskripsi']; ?></td>
                                <td class="text-center"><?= $value['region']; ?></td>
                                <td class="text-center"><?= $value['cabang']; ?></td>
                                <td class="text-center"><?= number_format($value['totalPendapatan'],2,',','.'); ?></td>
                                <td class="text-center"><?= number_format($value['totalHPP'],2,',','.'); ?></td>
                                <td class="text-center"><?= $value['kodeEvent']; ?></td>
                                <td class="text-center"><?= $value['kelompokUmur']; ?></td>
                                <td class="text-center"><?= tgl_indo($value['tanggalMulai']); ?></td>
                                <td class="text-center"><?= tgl_indo($value['tanggalSelesai']); ?></td>
                            </tr>
                        <?php } 
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>