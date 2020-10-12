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
                    <td class="font-weight-bold"><?php echo $tanggalawal ?> s/d <?php echo $tanggalakhir ?></td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="w-100">
        <table class="table table-sm table-border-bottom">
            <thead class="bg-light">
                <tr>
                    <th colspan="3" class="text-uppercase">
                        <?php echo lang('income_statement') ?> 
                        (<?php echo formatdateslash($tanggalawal) ?> - <?php echo formatdateslash($tanggalakhir) ?>)
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-grey-300">
                    <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Pendapatan dari Penjualan') ?></td>
                </tr>
                <?php $totalpenjualan = 0 ?>
                <?php foreach ($penjualan as $jual): ?>
                    <?php if ($jual['stdebet'] == '1'): ?>
                        <?php $totalpenjualan = $totalpenjualan - $jual['saldo'] ?>
                    <?php else: ?>
                        <?php $totalpenjualan = $totalpenjualan + $jual['saldo'] ?>
                    <?php endif ?>
                    <?php if ($jual['saldo'] > 0): ?>
                        <tr>
                            <td colspan="2">
                                (<?php echo $jual['noakun'] ?>) - <?php echo $jual['namaakun'] ?>
                            </td>
                            <td class="text-right">
                                <?php if ($jual['stdebet'] == '1'): ?>
                                    (<?php echo formatnumberakunting($jual['saldo']) ?>) 
                                <?php else: ?>
                                    <?php echo formatnumberakunting($jual['saldo']) ?> 
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>
                <tr class="">
                    <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Pendapatan dari Penjualan') ?></td>
                    <td class="text-right font-weight-bold"><?php echo formatnumberakunting($totalpenjualan) ?></td>
                </tr>
                
                <tr class="bg-grey-300">
                    <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Harga Pokok Penjualan') ?></td>
                </tr>
                <?php $totalhpp = 0 ?>
                <?php foreach ($hpp as $h): ?>
                    <?php $totalhpp = $totalhpp + $h['saldo'] ?>
                    <?php if ($h['saldo'] > 0): ?>
                        <tr>
                            <td colspan="2">
                                (<?php echo $h['noakun'] ?>) - <?php echo $h['namaakun'] ?>
                            </td>
                            <td class="text-right">(<?php echo formatnumberakunting($h['saldo']) ?>)</td>
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>
                <tr class="">
                    <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Harga Pokok Penjualan') ?></td>
                    <td class="text-right font-weight-bold">(<?php echo formatnumberakunting($totalhpp) ?>)</td>
                </tr>
                <tr class="bg-light">
                    <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Laba Kotor') ?></td>
                    <?php $labakotor = $totalpenjualan-$totalhpp ?>
                    <td class="text-right font-weight-bold"><?php echo formatnumberakunting($labakotor) ?></td>
                </tr>

                <tr class="bg-grey-300">
                    <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Beban Operasional') ?></td>
                </tr>
                <?php $totaloperasional = 0 ?>
                <?php foreach ($operasional as $opr): ?>
                    <?php $totaloperasional = $totaloperasional + $opr['saldo'] ?>
                    <?php if ($opr['saldo'] > 0): ?>
                        <tr>
                            <td colspan="2">
                                (<?php echo $opr['noakun'] ?>) - <?php echo $opr['namaakun'] ?>
                            </td>
                            <td class="text-right">(<?php echo formatnumberakunting($opr['saldo']) ?>)</td>
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>
                <tr class="">
                    <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Biaya') ?></td>
                    <td class="text-right font-weight-bold">(<?php echo formatnumberakunting($totaloperasional) ?>)</td>
                </tr>
                <tr class="bg-light">
                    <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Pendapatan Bersih Operasional') ?></td>
                    <?php $pendapatanbersihoperasional = $labakotor-$totaloperasional ?>
                    <td class="text-right font-weight-bold"><?php echo formatnumberakunting($pendapatanbersihoperasional) ?></td>
                </tr>

                <tr class="bg-grey-300">
                    <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Pendapatan Lainya') ?></td>
                </tr>
                <?php $totalpendapatanlainlain = 0 ?>
                <?php foreach ($pendapatanlainnya as $pl): ?>
                    <?php $totalpendapatanlainlain = $totalpendapatanlainlain + $pl['saldo'] ?>
                    <?php if ($pl['saldo'] > 0): ?>
                        <tr>
                            <td colspan="2">
                                (<?php echo $pl['noakun'] ?>) - <?php echo $pl['namaakun'] ?>
                            </td>
                            <td class="text-right"><?php echo formatnumberakunting($pl['saldo']) ?></td>
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>
                <tr class="">
                    <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Pendapatan Lainnya') ?></td>
                    <td class="text-right font-weight-bold"><?php echo formatnumberakunting($totalpendapatanlainlain) ?></td>
                </tr>

                <tr class="bg-grey-300">
                    <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Beban Lainya') ?></td>
                </tr>
                <?php $totalbiayalainnya = 0 ?>
                <?php foreach ($biayalainnya as $bl): ?>
                    <?php $totalbiayalainnya = $totalbiayalainnya + $bl['saldo'] ?>
                    <?php if ($bl['saldo'] > 0): ?>
                        <tr>
                            <td colspan="2">
                                (<?php echo $bl['noakun'] ?>) - <?php echo $bl['namaakun'] ?> 
                            </td>
                            <td class="text-right"><?php echo formatnumberakunting($bl['saldo']) ?></td>
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>
                <tr class="">
                    <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Beban Lainnya') ?></td>
                    <td class="text-right font-weight-bold">(<?php echo formatnumberakunting($totalbiayalainnya) ?>)</td>
                </tr>

                <tr class="bg-info">
                    <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Laba / Rugi Bersih') ?></td>
                    <?php $pendapatanbersih = $pendapatanbersihoperasional+$totalpendapatanlainlain-$totalbiayalainnya ?>
                    <td class="text-right font-weight-bold"><?php echo formatnumberakunting($pendapatanbersih) ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>