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
                    <th width="60%"><?php echo lang('account') ?></th>
                    <th class="text-right" width="20%"><?php echo lang('debet') ?></th>
                    <th class="text-right" width="20%"><?php echo lang('kredit') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($get_jurnal): ?>
                    <?php foreach ($get_jurnal as $row): ?>
                        <tr class="bg-grey-300">
                            <td class="font-weight-bold">
                                <?php $date = date('d/m/Y', strtotime($row['tanggal'])) ?>
                                <?php echo $row['keterangan'] ?> - ( <?php echo $date ?> ) 
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <?php $totaldebet = 0 ?>
                        <?php $totalkredit = 0 ?>
                        <?php foreach ($this->model->get_jurnal_detail($row['id']) as $det): ?>
                            <?php $totaldebet = $totaldebet + $det['debet'] ?>
                            <?php $totalkredit = $totalkredit + $det['kredit'] ?>
                            <tr>
                                <td>
                                    <?php if ($det['debet'] == 0): ?>
                                        <?php echo str_repeat('&nbsp;', 20).'('.$det['noakun'] ?>) - <?php echo $det['namaakun'] ?> 
                                    <?php else: ?>
                                        (<?php echo $det['noakun'] ?>) - <?php echo $det['namaakun'] ?> 
                                    <?php endif ?>
                                </td>
                                <td class="text-right"><?php echo number_format($det['debet']) ?></td>
                                <td class="text-right"><?php echo number_format($det['kredit']) ?></td>
                            </tr>
                        <?php endforeach ?>
                        <tr class="bg-light font-weight-bold">
                            <td class="text-right">Total</td>
                            <td class="text-right"><?php echo number_format($totaldebet) ?></td>
                            <td class="text-right"><?php echo number_format($totalkredit) ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td class="text-center" colspan="3"><?php echo lang('data_not_found') ?></td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</body>

</html>