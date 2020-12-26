<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    
    <div class="row mt-2" style="justify-content: center;">
        <div class="mt-2">
            <div class="row">
                <div class="col-12">
                    <div class="card" style="border: none;">
                        <div class="card-body">
                            <center>
                            <h3 class="card-title mb-4 text-center"><?= $nama_perusahaan ?></h3>
                            <h2 class="card-title mb-4 text-center"><?= $title ?></h2>
                            <h3 class="card-title mb-4 text-center"><?= $title2 ?></h3>
                            <table class="table table-striped table-bordered">
                                <tbody>
                                    <tr class="{bg_header}">
                                        <th class="font-weight-bold text-uppercase" style="width: 50%;"><?php echo lang('Aset') ?></th>
                                        <th class="font-weight-bold text-uppercase text-right">Balance</th>
                                    </tr>
                                    <tr class="bg-grey-300">
                                        <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Aset Lancar') ?></td>
                                    </tr>
                                    <?php
                                        $totalAsetLancarPeriodeKini = 0;
                                        $totalAsetLancar            = 0;
                                        if ($getasetlancar) {
                                            foreach ($getasetlancar as $key) { ?>
                                                <tr class="table-active">
                                                    <td><?= $key['namaakun']; ?></td>
                                                    <td class="text-right"><?= number_format($key['debetPeriodeKini'],2,',','.'); ?></td>
                                                </tr>
                                            <?php 
                                                $totalAsetLancarPeriodeKini += $key['debetPeriodeKini'];
                                            }
                                        } 
                                    ?>
                                    <tr class="">
                                        <td class="font-weight-bold text-uppercase"><?php echo lang('Total Aset Lancar') ?></td>
                                        <td class="text-right font-weight-bold"><?= number_format($totalAsetLancarPeriodeKini,2,',','.'); ?></td>
                                    </tr>
                                    <tr class="bg-grey-300">
                                        <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Aset Tetap') ?></td>
                                    </tr>
                                    <tr class="">
                                        <td class="font-weight-bold text-uppercase"><?php echo lang('Total Aset Tetap') ?></td>
                                        <td class="text-right font-weight-bold"></td>
                                    </tr>

                                    <tr class="bg-success">
                                        <td class="font-weight-bold text-uppercase"><?php echo lang('Total Aset') ?></td>
                                        <td class="text-right font-weight-bold"></td>
                                    </tr>
                                    <tr class="{bg_header}">
                                        <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Liabilitas dan Ekuitas') ?></td>
                                    </tr>
                                    <tr class="bg-grey-300">
                                        <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Liabilitas') ?></td>
                                    </tr>
                                    <?php
                                        $totalLiabilitas    = 0;
                                        if ($getliabilitas) {
                                            foreach ($getliabilitas as $key) { ?>
                                                <tr class="table-active">
                                                    <td><?= $key['namaakun']; ?></td>
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
                                    </tr>
                                    <tr class="bg-grey-300">
                                        <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Ekuitas') ?></td>
                                    </tr>
                                    <?php
                                        $totalEkuitas    = 0;
                                        if ($ekuitas) {
                                            foreach ($ekuitas as $key) { ?>
                                                <tr class="table-active">
                                                    <td><?= $key['namaakun']; ?></td>
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
                                        
                                    </tr>
                                    <tr class="">
                                        <td class="font-weight-bold text-uppercase"><?php echo lang('Total Ekuitas') ?></td>
                                        <td class="text-right font-weight-bold"><?= number_format($totalEkuitas + $gettotallabarugi,2,',','.'); ?></td>
                                        
                                    </tr>
                                    <tr class="bg-success">
                                        <td class="font-weight-bold text-uppercase"><?php echo lang('Total Liabilitas dan Ekuitas') ?></td>
                                        <td class="text-right font-weight-bold"><?= number_format(($totalEkuitas + $gettotallabarugi + $totalLiabilitas),2,',','.'); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    window.print();
</script>
</html>
