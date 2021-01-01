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
        <h3 class="m-1 font-weight-bold">Outstanding Payable</h3>
        <h3 class="m-1">As of <?= $tanggal; ?></h3>
    </div>
    <br>
    <div class="clearfix"></div>
    <div class="table-responsive">
        <table class="table table-xs" border="1">
            <thead>
                <tr class="table-active">
                    <th class="text-center">Invoice No.</th>
                    <th class="text-center">Invoice Date</th>
                    <th class="text-center">Due Date</th>
                    <th class="text-center">Invoice Amount</th>
                    <th class="text-center">Prime Owing</th>
                    <th class="text-center">Tax Owing</th>
                    <th class="text-center">Age ft Due</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($laporan !== null) { 
                        foreach ($laporan as $key) { 
                            foreach ($key as $value) { ?>
                                <tr>
                                    <td class="text-center"><?= $value['noFaktur']; ?></td>
                                    <td class="text-center">
                                        <strong><?= $value['nama_perusahaan']; ?></strong><br/>
                                        <?= $value['tanggal']; ?>
                                    </td>
                                    <td class="text-center"><?= $value['tanggaltempo']; ?></td>
                                    <td class="text-center"><?= number_format($value['total'],2,',','.'); ?></td>
                                    <td class="text-center"><?= number_format($value['sisatagihan'],2,',','.'); ?></td>
                                    <td class="text-center"></td>
                                    <td class="text-center">
                                        <?php
                                            $tanggal            = new DateTime($value['tanggal']);
                                            $tanggalTempo       = new DateTime($value['tanggaltempo']);
                                            $tanggalSekarang    = new DateTime();
                                            $selisih            = $tanggalTempo->diff($tanggal)->days;
                                            $selisih1           = $tanggalSekarang->diff($tanggal)->days;
                                            $usiaHutang	        = $selisih1 - $selisih;
                                            echo $usiaHutang;
                                        ?>
                                    </td>
                                </tr>
                            <?php } 
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>