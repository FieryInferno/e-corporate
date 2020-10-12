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
            <tbody>
                <?php if ($itemid): ?>
                    <?php if ($get_faktur_pembelian): ?>
                        <?php $grandtotalpembelian = 0 ?>
                        <?php foreach ($get_faktur_pembelian as $row): ?>
                            <tr class="bg-light">
                                <td colspan="8" class="font-weight-bold">
                                    Invoice : <?php echo $row['nofaktur'] ?>  | 
                                    Tanggal : <?php echo formatdateslash($row['tanggal']) ?> | 
                                    Dari : <?php echo $row['kontak'] ?>
                                </td>
                            </tr>
                            <tr class="bg-light">
                                <td class="text-left"><?php echo lang('item') ?></td>
                                <td class="text-left"><?php echo lang('unit') ?></td>
                                <td class="text-right"><?php echo lang('price') ?></td>
                                <td class="text-right"><?php echo lang('qty') ?></td>
                                <td class="text-right"><?php echo lang('subtotal') ?></td>
                                <td class="text-right"><?php echo lang('discount') ?></td>
                                <td class="text-right"><?php echo lang('ppn') ?></td>
                                <td class="text-right"><?php echo lang('total') ?></td>
                            </tr>
                            <?php $totaldetailpembelian = 0 ?>
                            <?php foreach ($this->model->get_faktur_pembelian_detail($row['id']) as $det): ?>
                                <?php if ($itemid == $det['itemid']): ?>
                                    <?php $totaldetailpembelian = $totaldetailpembelian + $det['total'] ?>
                                    <tr>
                                        <td> <?php echo $det['item'] ?> </td>
                                        <td> <?php echo $det['satuan'] ?> </td>
                                        <td class="text-right"> <?php echo number_format($det['harga']) ?> </td>
                                        <td class="text-right"> <?php echo number_format($det['jumlah']) ?> </td>
                                        <td class="text-right"> <?php echo number_format($det['subtotal']) ?> </td>
                                        <td class="text-right"> <?php echo number_format($det['diskon']) ?>% </td>
                                        <td class="text-right"> <?php echo number_format($det['ppn']) ?>% </td>
                                        <td class="text-right"> <?php echo number_format($det['total']) ?> </td>
                                    </tr>
                                <?php endif ?>
                            <?php endforeach ?>

                            <?php $grandtotalpembelian = $grandtotalpembelian + $totaldetailpembelian ?>
                            <tr>
                                <td colspan="7" class="text-right font-weight-bold"><?php echo lang('total') ?></td>
                                <td class="text-right font-weight-bold"><?php echo number_format($totaldetailpembelian) ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8"><?php echo lang('data_not_found') ?></td>
                        </tr>
                    <?php endif ?>
                <?php else: ?>
                    <?php if ($get_faktur_pembelian): ?>
                        <?php $grandtotalpembelian = 0 ?>
                        <?php foreach ($get_faktur_pembelian as $row): ?>
                            <tr class="bg-light">
                                <td colspan="8" class="font-weight-bold">
                                    Invoice : <?php echo $row['nofaktur'] ?>  | 
                                    Tanggal : <?php echo formatdateslash($row['tanggal']) ?> | 
                                    Dari : <?php echo $row['kontak'] ?>
                                </td>
                            </tr>
                            <tr class="bg-light">
                                <td class="text-left"><?php echo lang('item') ?></td>
                                <td class="text-left"><?php echo lang('unit') ?></td>
                                <td class="text-right"><?php echo lang('price') ?></td>
                                <td class="text-right"><?php echo lang('qty') ?></td>
                                <td class="text-right"><?php echo lang('subtotal') ?></td>
                                <td class="text-right"><?php echo lang('discount') ?></td>
                                <td class="text-right"><?php echo lang('ppn') ?></td>
                                <td class="text-right"><?php echo lang('total') ?></td>
                            </tr>
                            <?php $totaldetailpembelian = 0 ?>
                            <?php foreach ($this->model->get_faktur_pembelian_detail($row['id']) as $det): ?>
                                <?php $totaldetailpembelian = $totaldetailpembelian + $det['total'] ?>
                                <tr>
                                    <td> <?php echo $det['item'] ?> </td>
                                    <td> <?php echo $det['satuan'] ?> </td>
                                    <td class="text-right"> <?php echo number_format($det['harga']) ?> </td>
                                    <td class="text-right"> <?php echo number_format($det['jumlah']) ?> </td>
                                    <td class="text-right"> <?php echo number_format($det['subtotal']) ?> </td>
                                    <td class="text-right"> <?php echo number_format($det['diskon']) ?>% </td>
                                    <td class="text-right"> <?php echo number_format($det['ppn']) ?>% </td>
                                    <td class="text-right"> <?php echo number_format($det['total']) ?> </td>
                                </tr>
                            <?php endforeach ?>

                            <?php $grandtotalpembelian = $grandtotalpembelian + $totaldetailpembelian ?>
                            <tr>
                                <td colspan="7" class="text-right font-weight-bold"><?php echo lang('total') ?></td>
                                <td class="text-right font-weight-bold"><?php echo number_format($totaldetailpembelian) ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8"><?php echo lang('data_not_found') ?></td>
                        </tr>
                    <?php endif ?>
                <?php endif ?>
            </tbody>
            <?php if ($get_faktur_pembelian): ?>
                <tfoot>
                    <tr class="bg-light">
                        <td colspan="7" class="text-right font-weight-bold"><?php echo lang('grand_total') ?></td>
                        <td class="text-right font-weight-bold"><?php echo number_format($grandtotalpembelian) ?></td>
                    </tr>
                </tfoot>
            <?php endif ?>
        </table>
    </div>
</body>

</html>