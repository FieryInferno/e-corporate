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
    <div class="float-right">
        <div class="w-25">
            <table class="table table-sm">
                <tbody>
                    <tr>
                        <td><?php echo lang('notrans') ?></td>
                        <td class="font-weight-bold text-right"><?php echo $notrans ?></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('date') ?></td>
                        <td class="font-weight-bold text-right"><?php echo formatdateslash($tanggal) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="clearfix mb-5"></div>
    <div class="w-25">
        <table class="table table-sm">
            <tbody>
                <tr>
                    <td><?php echo lang('from') ?></td>
                    <td class="font-weight-bold"><?php echo $kontak ?></td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="w-100">
        <table class="table table-sm table-border-bottom">
            <thead class="bg-light">
                <tr>
                    <th><?php echo lang('item') ?></th>
                    <th><?php echo lang('return_reason') ?></th>
                    <th class="text-right"><?php echo lang('price') ?></th>
                    <th class="text-right"><?php echo lang('qty') ?></th>
                    <th class="text-right"><?php echo lang('subtotal') ?></th>
                    <th class="text-right"><?php echo lang('discount') ?></th>
                    <th class="text-right"><?php echo lang('ppn') ?></th>
                    <th class="text-right"><?php echo lang('total') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $grandtotal = 0; ?>
                <?php foreach ($returdetail as $row): ?>
                    <?php $grandtotal = $row['total'] + $grandtotal ?>
                    <tr>
                        <td><?php echo $row['item'] ?></td>
                        <td><?php echo $row['alasan'] ?></td>
                        <td class="text-right"><?php echo number_format($row['harga']) ?></td>
                        <td class="text-right"><?php echo number_format($row['jumlah']) ?></td>
                        <td class="text-right"><?php echo number_format($row['subtotal']) ?></td>
                        <td class="text-right"><?php echo number_format($row['diskon']) ?>%</td>
                        <td class="text-right"><?php echo number_format($row['ppn']) ?>%</td>
                        <td class="text-right"><?php echo number_format($row['total']) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <div class="float-right w-25">
        <table class="table table-sm">
            <tbody>
                <tr>
                    <td><?php echo lang('subtotal') ?></td>
                    <td class="text-right font-weight-bold"><?php echo number_format($subtotal) ?></td>
                </tr>
                <tr>
                    <td><?php echo lang('discount') ?></td>
                    <td class="text-right font-weight-bold"><?php echo number_format($diskon) ?></td>
                </tr>
                <tr>
                    <td><?php echo lang('ppn') ?></td>
                    <td class="text-right font-weight-bold"><?php echo number_format($ppn) ?></td>
                </tr>
                <tr>
                    <td><?php echo lang('total') ?></td>
                    <td class="text-right font-weight-bold"><?php echo number_format($total) ?></td>
                </tr>
            </tbody>
        </table>    
    </div>

    <div class="footer"> </div>
</body>

</html>