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
    <div class="w-25">
        <table class="table table-sm">
            <tbody>
                <tr>
                    <td><?php echo lang('Periode') ?> :</td>
                    <td class="font-weight-bold"><?php echo $tanggalawal ?> s/d <?php echo $tanggalakhir ?></td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="w-100">
        <table class="table table-sm table-border-bottom">
            <thead class="bg-light">
                <tr>
                    <th rowspan="2"><?php echo lang('account') ?></th>
                    <th colspan="2" width="25%" class="text-center"><?php echo lang('beginning_balance') ?></th>
                    <th colspan="2" width="25%" class="text-center"><?php echo lang('Pergerakan') ?></th>
                    <th colspan="2" width="25%" class="text-center"><?php echo lang('ending_balance') ?></th>
                </tr>
                <tr>
                    <th class="text-center"><?php echo lang('debet') ?></th>
                    <th class="text-center"><?php echo lang('kredit') ?></th>
                    <th class="text-center"><?php echo lang('debet') ?></th>
                    <th class="text-center"><?php echo lang('kredit') ?></th>
                    <th class="text-center"><?php echo lang('debet') ?></th>
                    <th class="text-center"><?php echo lang('kredit') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $totalawal = 0; ?>
                <?php $totalgerak = 0; ?>
                <?php $totalakhir = 0; ?>
                <?php $totalakhirdebet = 0; ?>
                <?php $totalakhirkredit = 0; ?>
                <?php foreach ($saldo_detail_noakun as $noakun): ?>
                    <tr>
                        <td>
                            (<?php echo $noakun['noakun'] ?>) - <?php echo $noakun['namaakun'] ?>
                        </td>
                        <?php foreach ($this->model->get_neraca_saldo_detail_awal($tanggalawal, $noakun['noakun']) as $awal): ?>
                            <?php $totalawal = $totalawal + $awal['debet'] ?>
                            <td class="text-right"><?php echo number_format($awal['debet']) ?></td>
                            <td class="text-right"><?php echo number_format($awal['kredit']) ?></td>
                        <?php endforeach ?>
                        <?php $pergerakan = $this->model->get_neraca_saldo_detail_pergerakan($tanggalawal, $tanggalakhir, $noakun['noakun']) ?>
                        <?php foreach ($pergerakan as $gerak): ?>
                            <?php $totalgerak = $totalgerak + $gerak['debet'] ?>
                            <td class="text-right"><?php echo number_format($gerak['debet']) ?></td>
                            <td class="text-right"><?php echo number_format($gerak['kredit']) ?></td>
                        <?php endforeach ?>
                        <?php $akhir = $this->model->get_neraca_saldo_detail_akhir($tanggalakhir, $noakun['noakun']) ?>
                        <?php foreach ($akhir as $akhr): ?>
                            <?php if ($noakun['stdebet'] == '1'): ?>
                                <td class="text-right"><?php echo number_format($akhr['debet']-$akhr['kredit']) ?></td>
                                <td class="text-right">0</td>
                                <?php $totalakhirdebet = $totalakhirdebet + ($akhr['debet']-$akhr['kredit']) ?>
                            <?php else: ?>
                                <td class="text-right">0</td>
                                <td class="text-right"><?php echo number_format($akhr['kredit']-$akhr['debet']) ?></td>
                                <?php $totalakhirkredit = $totalakhirkredit + ($akhr['kredit']-$akhr['debet']) ?>
                            <?php endif ?>
                        <?php endforeach ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot class="bg-light">
                <tr>
                    <th class="text-center">&nbsp;</th>
                    <th class="text-right"><?php echo number_format($totalawal) ?></th>
                    <th class="text-right"><?php echo number_format($totalawal) ?></th>
                    <th class="text-right"><?php echo number_format($totalgerak) ?></th>
                    <th class="text-right"><?php echo number_format($totalgerak) ?></th>
                    <th class="text-right"><?php echo number_format($totalakhirdebet) ?></th>
                    <th class="text-right"><?php echo number_format($totalakhirkredit) ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>