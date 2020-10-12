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


    <div class="w-100">
        <table class="table table-sm table-border-bottom">
            <thead class="bg-light">
                <tr>
                    <th><?php echo lang('Kode') ?></th>
                    <th><?php echo lang('Nama') ?></th>
                    <th><?php echo lang('Satuan') ?></th>
                    <th><?php echo lang('Kategori') ?></th>
                    <th class="text-right"><?php echo lang('Stok') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($getstok): ?>
                    <?php foreach ($getstok as $row): ?>
                        <tr>
                            <td><?php echo $row['kode'] ?></td>
                            <td><?php echo $row['nama'] ?></td>
                            <td><?php echo $row['satuan'] ?></td>
                            <td><?php echo $row['kategori'] ?></td>
                            <td class="text-right"><?php echo number_format($row['stok']) ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>

    <div class="footer"> </div>
</body>

</html>