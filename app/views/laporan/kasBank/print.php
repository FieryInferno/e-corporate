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
        <h3 class="m-1 font-weight-bold">Buku Bank</h3>
        <h3 class="m-1">From <?= $tanggalAwal; ?> to <?= $tanggalAkhir; ?></h3>
    </div>
    <br>
    <h5 class="m-1 font-weight-bold"> Nama Bank :
        <?php
            $data   = $this->db->get_where('mrekening', [
                'id'    => $rekening
            ])->row_array();
            echo $data['nama'] . ' - ' . $data['norek'];
        ?>
    </h5>
    <div class="clearfix"></div>
    <div class="table-responsive">
        <table class="table table-xs" border="1">
            <thead>
                <tr class="table-active">
                    <th class="text-center">Date</th>
                    <th class="text-center">Source No.</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Increase</th>
                    <th class="text-center">Decrease</th>
                    <th class="text-center">Balance</th>
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
                        foreach ($laporan as $key) {
                            foreach ($key as $value) { ?>
                              <tr>
                                <td class="text-center"><?= $value['tanggal']; ?></td>
                                <td class="text-center"><?= $value['no']; ?></td>
                                <td class="text-center"><?= $value['keterangan']; ?></td>
                                <td class="text-center"><?= number_format($value['debet'],2,',','.'); ?></td>
                                <td class="text-center"><?= number_format($value['kredit'],2,',','.'); ?></td>
                                <td class="text-center"><?= number_format(($value['debet'] - $value['kredit']),2,',','.'); ?></td>
                              </tr>
                            <?php 
                            }
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>