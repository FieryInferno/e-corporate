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
    <div class="clearfix mb-5"></div>
    <div class="w-50">
        <table class="table table-sm">
            <tbody>
                <tr>
                    <td><?php echo lang('Periode') ?> :</td>
                    <td class="font-weight-bold"><?php echo $tanggal ?></td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="w-100">
        <table class="table table-sm table-border-bottom">
            <tbody>
                <tr class="{bg_header}">
                    <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Aset') ?></td>
                </tr>

                <tr class="bg-grey-300">
                    <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Aset Lancar') ?></td>
                </tr>
                <?php $totalasetlancar = 0 ?>
                <?php foreach ($getasetlancar as $asetlancar): ?>
                    <?php $totalasetlancar = $totalasetlancar + $asetlancar['saldo'] ?>
                    <?php if ($asetlancar['saldo'] != 0): ?>
                        <tr>
                            <td colspan="2">
                                (<?php echo $asetlancar['noakun'] ?>) - <?php echo $asetlancar['namaakun'] ?> 
                            </td>
                            <td class="text-right">
                                <?php echo formatnumberakunting($asetlancar['saldo']) ?> 
                            </td>
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>
                <tr class="">
                    <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Aset Lancar') ?></td>
                    <td class="text-right font-weight-bold"><?php echo formatnumberakunting($totalasetlancar) ?></td>
                </tr>

                <tr class="bg-grey-300">
                    <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Aset Tetap') ?></td>
                </tr>
                <?php $totalasettetap = 0 ?>
                <?php foreach ($getasettetap as $asettetap): ?>
                    <?php $totalasettetap = $totalasettetap + $asettetap['saldo'] ?>
                    <?php if ($asettetap['saldo'] != 0): ?>
                        <tr>
                            <td colspan="2">
                                (<?php echo $asettetap['noakun'] ?>) - <?php echo $asettetap['namaakun'] ?> 
                            </td>
                            <td class="text-right"><?php echo formatnumberakunting($asettetap['saldo']) ?></td>
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>
                <tr class="">
                    <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Aset Tetap') ?></td>
                    <td class="text-right font-weight-bold"><?php echo formatnumberakunting($totalasettetap) ?></td>
                </tr>

                <tr class="bg-success">
                    <?php $totalaset = $totalasetlancar + $totalasettetap ?>
                    <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Aset') ?></td>
                    <td class="text-right font-weight-bold"><?php echo formatnumberakunting($totalaset) ?></td>
                </tr>

                <tr class="{bg_header}">
                    <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Liabilitas dan Ekuitas') ?></td>
                </tr>

                <tr class="bg-grey-300">
                    <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Liabilitas') ?></td>
                </tr>
                <?php $totalliabilitas = 0 ?>
                <?php foreach ($getliabilitas as $liabilitas): ?>
                    <?php $totalliabilitas = $totalliabilitas + $liabilitas['saldo'] ?>
                    <?php if ($liabilitas['saldo'] != 0): ?>
                        <tr>
                            <td colspan="2">
                                (<?php echo $liabilitas['noakun'] ?>) - <?php echo $liabilitas['namaakun'] ?> 
                            </td>
                            <td class="text-right"><?php echo formatnumberakunting($liabilitas['saldo']) ?></td>
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>
                <tr class="">
                    <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Liabilitas') ?></td>
                    <td class="text-right font-weight-bold"><?php echo formatnumberakunting($totalliabilitas) ?></td>
                </tr>

                <tr class="bg-grey-300">
                    <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Ekuitas') ?></td>
                </tr>
                <?php $totalmodal = 0 ?>
                <?php foreach ($getmodal as $modal): ?>
                    <?php if ($modal['stdebet'] == '1'): ?>
                        <?php $totalmodal = $totalmodal - $modal['saldo'] ?>
                    <?php else: ?>
                        <?php $totalmodal = $totalmodal + $modal['saldo'] ?>
                    <?php endif ?>
                    <?php if ($modal['saldo'] != 0): ?>
                        <tr>
                            <td colspan="2">
                                (<?php echo $modal['noakun'] ?>) - <?php echo $modal['namaakun'] ?> 
                            </td>
                            <td class="text-right">
                                <?php if ($modal['stdebet'] == '1'): ?>
                                    (<?php echo formatnumberakunting($modal['saldo']) ?>) 
                                <?php else: ?>
                                    <?php echo formatnumberakunting($modal['saldo']) ?> 
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>
                <tr>
                    <td colspan="2"> <?php echo lang("Laba / Rugi Bersih Berjalan") ?> </td>
                    <td class="text-right"> <?php echo formatnumberakunting($gettotallabarugi) ?> </td>
                </tr>
                <?php $totalmodal = $totalmodal + $gettotallabarugi ?>
                <tr class="">
                    <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Ekuitas') ?></td>
                    <td class="text-right font-weight-bold"><?php echo formatnumberakunting($totalmodal) ?></td>
                </tr>


                <tr class="bg-success">
                    <?php $totalmodaldanliabilitas = $totalliabilitas + $totalmodal ?>
                    <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Liabilitas dan Ekuitas') ?></td>
                    <td class="text-right font-weight-bold"><?php echo formatnumberakunting($totalmodaldanliabilitas) ?></td>
                </tr>

            </tbody>
        </table>
    </div>
</body>

</html>