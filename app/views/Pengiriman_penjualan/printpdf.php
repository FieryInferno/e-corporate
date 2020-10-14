<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <title><?php echo $title ?></title>
    <style type="text/css"> <?php echo $css ?> </style>
    <style type="text/css">
        .box-title {
            border: 1px solid #ddd;
            padding: 10px;
            background: #eee;
        }
    </style>
</head>
<body>
    <div class="header-logo">
        <img src="./uploads/bintang-teknologi.jpeg">
    </div>
    <div class="header-map">
        <h3 class="text-left">CV. BINTANG TEKNOLOGI</h3>
        <p class="text-left">Jl. Sukawinatan No.5623, Sukajaya, Sukarame, Palembang 30151 Telp. 085366725222/08117817374</p>
    </div>
    <div class="clearfix"></div>
    <hr class="hr">
    <div class="float-left">
        <div class="w-30">
            <p>Palembang, <?php echo formatdatemonthname($tanggal) ?></p>
            <p>Nomor : <?php echo $notrans ?></p>
            <div class="mb-3">&nbsp;</div>
            <p>Kepada YTH</p>
            <p><?php echo $kontak ?></p>
            <p>di - <?php echo $alamat ?></p>
            <p>UP : <?php echo $cp ?></p>
        </div>
    </div>
    <div class="float-right">
        <div class="font-weight-bold box-title">
            <?php echo $title ?> 
        </div>
    </div>
    <div class="clearfix mb-5"></div>


    <div class="w-100">
        <table class="table table-sm table-border-bottom">
            <thead class="bg-light">
                <tr>
                    <th width="5%"><?php echo lang('NO') ?></th>
                    <th><?php echo lang('item') ?></th>
                    <th class="text-right"><?php echo lang('Satuan') ?></th>
                    <th class="text-right"><?php echo lang('qty') ?></th>
                    <th width="30%" class="text-right">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php $grandtotal = 0; $no = 1; ?>
                <?php foreach ($pengirimandetail as $row): ?>
                    <?php $grandtotal = $row['total'] + $grandtotal ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $row['item'] ?></td>
                        <td class="text-right"><?php echo $row['satuan'] ?></td>
                        <td class="text-right"><?php echo number_format($row['jumlah']) ?></td>
                        <td class="text-right"></td>
                    </tr>
                    <?php $no++ ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="clearfix mb-5">&nbsp;</div>

    <div class="float-left w-100">
        <p>Catatan : <?php echo $catatan ?></p>
    </div>
    <div class="clearfix mb-5"></div>

    <div class="text-center float-left w-50">
        <p>Tanda Terima</p>
        <br>
        <br>
        <br>
        <br>
        <p>----------------</p>
    </div>
    <div class="text-center float-right w-50">
        <p>Hormat Kami</p>
        <br>
        <br>
        <br>
        <br>
        <p class="font-weight-bold">Heru Sukoco, S.Kom.</p>
    </div>

</body>

</html>