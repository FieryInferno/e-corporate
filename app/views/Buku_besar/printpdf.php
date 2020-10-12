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
                    <th width="20%"><?php echo lang('date') ?></th>
                    <th><?php echo lang('note') ?></th>
                    <th class="text-right" width="15%"><?php echo lang('debet') ?></th>
                    <th class="text-right" width="15%"><?php echo lang('kredit') ?></th>
                    <th class="text-right" width="15%"><?php echo lang('balance') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($get_noakun): ?>
                    <?php foreach ($get_noakun as $row): ?>
                        <?php $totaldebet = 0 ?>
                        <?php $totalkredit = 0 ?>
                        <?php $totalsaldo = 0 ?>

                        <tr class="bg-grey-300">
                            <td colspan="2">
                                <?php $date = date('d/m/Y', strtotime($row['tanggal'])) ?> 
                                <span class="font-weight-bold">(<?php echo $row['noakun'] ?>) - </span> 
                                <span class="font-weight-bold"><?php echo $row['namaakun'] ?></span> 
                            </td>
                            <?php if ($row['stdebet'] == '1'): ?>
                                <td class="text-right font-weight-bold">
                                    <?php $totaldebet = $this->model->get_jurnal_detail_saldoawal($row['noakun'], $tanggalawal) ?>
                                    <?php echo number_format($totaldebet) ?>
                                </td>
                                <td class="text-right font-weight-bold">0</td>
                            <?php else: ?>
                                <td class="text-right font-weight-bold">0</td>
                                <td class="text-right font-weight-bold">
                                    <?php $totalkredit = $this->model->get_jurnal_detail_saldoawal($row['noakun'], $tanggalawal) ?>
                                    <?php echo number_format($totalkredit) ?>
                                </td>
                            <?php endif ?>
                            <td class="text-right font-weight-bold">
                                <?php $saldo = $this->model->get_jurnal_detail_saldoawal($row['noakun'], $tanggalawal) ?>
                                <?php echo number_format($saldo) ?>
                            </td>
                        </tr>

                        <?php foreach ($this->model->get_jurnal_detail($row['noakun'], $tanggalawal, $tanggalakhir) as $det): ?>
                            <?php if ($row['stdebet'] == '1'): ?>
                                <?php $totaldebet = $totaldebet + $det['debet'] ?>
                                <?php $totalkredit = $totalkredit + $det['kredit'] ?>
                                <?php $saldo = $saldo + $det['debet'] - $det['kredit'] ?>
                            <?php else: ?>
                                <?php $totaldebet = $totaldebet + $det['debet'] ?>
                                <?php $totalkredit = $totalkredit + $det['kredit'] ?>
                                <?php $saldo = $saldo - $det['debet'] + $det['kredit'] ?>
                            <?php endif ?>
                            <?php $date = date('d/m/Y', strtotime($det['tanggal'])) ?>
                            <tr>
                                <td><?php echo $date ?></td>
                                <td><?php echo $det['keterangan'] ?></td>
                                <td class="text-right"><?php echo number_format($det['debet']) ?></td>
                                <td class="text-right"><?php echo number_format($det['kredit']) ?></td>
                                <?php if ($saldo < 0): ?>
                                    <td class="text-right">(<?php echo number_format(abs($saldo)) ?>)</td>
                                <?php else: ?>
                                    <td class="text-right"><?php echo number_format($saldo) ?></td>
                                <?php endif ?>
                            </tr>
                        <?php endforeach ?>
                        <tr class="bg-light font-weight-bold">
                            <?php $namasaldoakhir =  lang('ending_balance').' - ('.$row['noakun'].') '.$row['namaakun'] ?>
                            <td class="text-right" colspan="2"><?php echo $namasaldoakhir ?></td>
                            <td class="text-right"><?php echo number_format($totaldebet) ?></td>
                            <td class="text-right"><?php echo number_format($totalkredit) ?></td>
                            <td class="text-right">
                                <?php if ($saldo < 0): ?>
                                    (<?php echo number_format(abs($saldo)) ?>)
                                <?php else: ?>
                                    <?php echo number_format($saldo) ?>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td class="text-center" colspan="5"><?php echo lang('data_not_found') ?></td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</body>

</html>