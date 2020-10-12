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
                        <?php echo lang('Statement_of_Owner_Equity') ?> 
                        (<?php echo formatdateslash($tanggalawal) ?> - <?php echo formatdateslash($tanggalakhir) ?>)
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $awal = 0 ?>
                <tr class="bg-light">
                    <td colspan="2" class="font-weight-bold text-uppercase">
                        <?php echo lang('Modal Awal') ?> - <?php echo formatdateslash($tanggalawal) ?>
                    </td>
                    <td class="font-weight-bold text-uppercase text-right">
                        <?php echo formatnumberakunting($get_saldo_awal['totalsaldoawal']) ?>
                    </td>
                </tr>
                <?php $totalekuitas = $get_saldo_awal['totalsaldoawal'] ?>
                <?php foreach ($getekuitas as $ekuitas): ?>
                    <?php $totalekuitas = $totalekuitas + $ekuitas['saldo'] ?>
                    <?php if ($ekuitas['saldo'] > 0): ?>
                        <tr>
                            <td colspan="2">
                                <a href="{site_url}noakun/detail/<?php echo $ekuitas['noakun'] ?>">
                                    (<?php echo $ekuitas['noakun'] ?>) - <?php echo $ekuitas['namaakun'] ?> 
                                </a>
                            </td>
                            <td class="text-right"><?php echo formatnumberakunting($ekuitas['saldo']) ?></td>
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>
                <tr>
                    <td colspan="2">Laba / Rugi Bersih</td>
                    <td class="text-right"><?php echo formatnumberakunting($gettotallabarugi) ?></td>
                </tr>

                <?php $totalmodal = $totalekuitas + $gettotallabarugi ?>
                <?php $totalprive = 0 ?>
                <?php foreach ($getprive as $prive): ?>
                    <?php $totalprive = $totalprive + $prive['saldo'] ?>
                    <?php if ($prive['saldo'] > 0): ?>
                        <tr>
                            <td colspan="2">
                                (<?php echo $prive['noakun'] ?>) - <?php echo $prive['namaakun'] ?>
                            </td>
                            <td class="text-right">(<?php echo formatnumberakunting($prive['saldo']) ?>)</td>
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>
                <tr class="bg-light">
                    <td colspan="3" class="font-weight-bold text-uppercase">
                        <span class="float-left"> <?php echo lang('Modal Akhir') ?> - <?php echo formatdateslash($tanggalakhir) ?> </span>
                        <span class="float-right"><?php echo formatnumberakunting($totalmodal-$totalprive) ?></span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>