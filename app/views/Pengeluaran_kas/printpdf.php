<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<title><?php echo $title ?></title>
	<style type="text/css"> <?php echo $css ?> </style>
    <style type="text/css">
        .kwitansi {
            border: 1px solid #aaa;
            border-radius: 6px;
            padding: 20px;
        }
        .kwitansi-title {
            font-size: 16px;
            margin: 0;
            padding-left: 5px;
            margin-bottom: 10px;
        }
        .kwitansi-total {
            border: 1px solid #ddd;
            display: inline-block;
            padding: 0px 40px 0 5px;
            font-weight: bold;
            font-size: 14px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="float-left">
        <h3 class="text-danger m-1 font-weight-bold"><?php echo get_pengaturan('instansi') ?></h3>
    </div>
    <div class="clearfix"></div>
    <hr class="hr">
    <div class="float-left">
        <p class="font-weight-bold">
            <?php echo $title ?> <br>
            <?php echo formatdatemonthname($tanggalawal) ?> - <?php echo formatdatemonthname($tanggalakhir) ?>
        </p>
    </div>
    <div class="clearfix mb-3"></div>

    <div class="w-100">
        <table class="table table-sm table-border-bottom">
            <thead class="bg-light">
                <tr>
                    <th><?php echo lang('No Kwitansi') ?></th>
                    <th><?php echo lang('Keterangan') ?></th>
                    <th><?php echo lang('Tanggal') ?></th>
                    <th><?php echo lang('Peneriman') ?></th>
                    <th class="text-center"><?php echo lang('Nominal') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($get_pengeluaran): ?>
                    <?php $totalpengeluaran = 0 ?>
                    <?php foreach ($get_pengeluaran as $row): ?>
                        <?php $totalpengeluaran = $totalpengeluaran + $row['nominal'] ?>
                        <tr>
                            <td>
                                <label class="badge badge-info">
                                    <?php echo $row['notrans'] ?> 
                                </label>
                            </td>
                            <td><strong><?php echo $row['keterangan'] ?></strong></td>
                            <td><?php echo formatdatemonthname($row['tanggal']) ?></td>
                            <td><?php echo $row['penerima'] ?></td>
                            <td class="text-center"><?php echo number_format($row['nominal']) ?></td>
                        </tr>
                    <?php endforeach ?>
                    <tr class="bg-grey-300">
                        <td colspan="4">Total Pengeluaran Kas Periode <?php echo formatdatemonthname($tanggalawal) ?> - <?php echo formatdatemonthname($tanggalakhir) ?> </td>
                        <td class="text-center font-weight-bold"><?php echo number_format($totalpengeluaran) ?></td>
                    </tr>
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