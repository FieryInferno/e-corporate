<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<title><?php echo $title ?></title>
	<style type="text/css"> <?php echo $css ?> </style>
</head>
<body>
  <div class="text-center">
    <h3 class="card-title mb-4 text-center"><?= $nama_perusahaan ?></h3>
    <h2 class="card-title mb-4 text-center"><?= $title ?></h2>
    <h3 class="card-title mb-4 text-center"><?= $title2 ?></h3>
  </div>
  <br>
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
        <tbody>
            <tr class="table-active">
                <th class="font-weight-bold text-uppercase" style="width: 50%;"><?php echo lang('Aset') ?></th>
                <th class="font-weight-bold text-uppercase text-right"><?= $periode_ini?></th>
                <th class="font-weight-bold text-uppercase text-right"><?= $periode_lalu?></th>
            </tr>
            <tr>
                <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Aset Lancar') ?></td>
            </tr>
            <?php
                $totalAsetLancarPeriodeKini = 0;
                $totalAsetLancar            = 0;
                if ($getasetlancar) {
                    foreach ($getasetlancar as $key) { ?>
                        <tr>
                            <td><?= $key['namaakun']; ?></td>
                            <td class="text-right"><?= number_format($key['debetPeriodeKini'],2,',','.'); ?></td>
                            <td class="text-right"><?= number_format($key['debet'],2,',','.'); ?></td>
                        </tr>
                    <?php 
                        $totalAsetLancarPeriodeKini += $key['debetPeriodeKini'];
                        $totalAsetLancar            += $key['debet'];
                    }
                } 
            ?>
            <tr>
                <td class="font-weight-bold text-uppercase"><?php echo lang('Total Aset Lancar') ?></td>
                <td class="text-right font-weight-bold"><?= number_format($totalAsetLancarPeriodeKini,2,',','.'); ?></td>
                <td class="text-right font-weight-bold"><?= number_format($totalAsetLancar,2,',','.'); ?></td>
            </tr>
            <tr>
                <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Aset Tetap') ?></td>
            </tr>
            <tr class="">
                <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Aset Tetap') ?></td>
                <td class="text-right font-weight-bold"></td>
            </tr>

            <tr>
                <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Aset') ?></td>
                <td class="text-right font-weight-bold"></td>
            </tr>
            <tr>
                <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Liabilitas dan Ekuitas') ?></td>
            </tr>
            <tr>
                <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Liabilitas') ?></td>
            </tr>
            <?php
                $totalLiabilitas    = 0;
                if ($getliabilitas) {
                    foreach ($getliabilitas as $key) { ?>
                        <tr>
                            <td><?= $key['namaakun']; ?></td>
                            <td class="text-right"><?= number_format($key['kredit'],2,',','.'); ?></td>
                            <td class="text-right"><?= number_format($key['kredit'],2,',','.'); ?></td>
                        </tr>
                    <?php 
                        $totalLiabilitas    += $key['kredit'];
                    }
                } 
            ?>
            <tr class="">
                <td class="font-weight-bold text-uppercase"><?php echo lang('Total Liabilitas') ?></td>
                <td class="text-right font-weight-bold"><?= number_format($totalLiabilitas,2,',','.'); ?></td>
                <td class="text-right font-weight-bold"><?= number_format($totalLiabilitas,2,',','.'); ?></td>
            </tr>
            <tr>
                <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Ekuitas') ?></td>
            </tr>
            <?php
                $totalEkuitas    = 0;
                if ($ekuitas) {
                    foreach ($ekuitas as $key) { ?>
                        <tr>
                            <td><?= $key['namaakun']; ?></td>
                            <td class="text-right"><?= number_format($key['kredit'],2,',','.'); ?></td>
                            <td class="text-right"><?= number_format($key['kredit'],2,',','.'); ?></td>
                        </tr>
                    <?php 
                        $totalEkuitas    += $key['kredit'];
                    }
                } 
            ?>
            <tr>
                <td> <?php echo lang("Laba / Rugi Bersih Berjalan") ?> </td>
                <td class="text-right"><?= number_format($gettotallabarugi,2,',','.'); ?></td>
                <td></td>
            </tr>
            <tr class="">
                <td class="font-weight-bold text-uppercase"><?php echo lang('Total Ekuitas') ?></td>
                <td class="text-right font-weight-bold"><?= number_format($totalEkuitas + $gettotallabarugi,2,',','.'); ?></td>
                <td class="text-right font-weight-bold"><?= number_format($totalEkuitas,2,',','.'); ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold text-uppercase"><?php echo lang('Total Liabilitas dan Ekuitas') ?></td>
                <td class="text-right font-weight-bold"><?= number_format(($totalEkuitas + $gettotallabarugi + $totalLiabilitas),2,',','.'); ?></td>
                <td class="text-right font-weight-bold"><?= number_format(($totalEkuitas + $totalLiabilitas),2,',','.'); ?></td>
            </tr>
        </tbody>
    </table>
  </div>
</body>

</html>