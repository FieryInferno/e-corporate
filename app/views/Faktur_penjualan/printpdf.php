<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <title><?php echo $title ?></title>
    <style type="text/css"> <?php echo $css ?> </style>
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
        <h3 class="font-weight-bold"><?php echo $title ?></h3>
    </div>
    <div class="clearfix"></div>

    
    <div class="float-left">
        <div class="w-40">
            <table class="table table-sm">
                <tbody>
                    <tr>
                        <td><?php echo lang('No Faktur') ?></td>
                        <td class="font-weight-bold">: <?php echo $notrans ?></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('Tanggal Faktur') ?></td>
                        <td class="font-weight-bold">: <?php echo formatdatemonthname($tanggal) ?></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('Tanggal Tempo') ?></td>
                        <td class="font-weight-bold">: <?php echo formatdatemonthname($tanggaltempo) ?></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('Surat Jalan') ?></td>
                        <td class="font-weight-bold">: <?php echo $nosj ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="float-right">
        <div class="w-40">
            <table class="table table-sm">
                <tbody>
                    <tr>
                        <td><?php echo lang('Kepada') ?></td>
                        <td class="font-weight-bold">: <?php echo $kontak ?></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('Alamat') ?></td>
                        <td class="font-weight-bold">: <?php echo $alamat ?></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('Telepon') ?></td>
                        <td class="font-weight-bold">: <?php echo $telepon ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="clearfix mb-5"></div>


    <div class="w-100">
        <table class="table table-sm table-border-bottom">
            <thead class="bg-light">
                <tr>
                    <th><?php echo lang('item') ?></th>
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
                <?php foreach ($fakturdetail as $row): ?>
                    <?php $grandtotal = $row['total'] + $grandtotal ?>
                    <tr>
                        <td><?php echo $row['item'] ?></td>
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


    <div class="float-left w-60">
        <div class="box-penyebut">
            <h3 class="text-center font-weight-bold">
                <u><?php echo penyebut($total) ?> Rupiah</u>
            </h3>
        </div>
    </div>
    <div class="float-right w-40">
        <table class="table table-sm">
            <tbody>
                <tr class="bg-light">
                    <td><?php echo lang('subtotal') ?></td>
                    <td class="text-right font-weight-bold"><?php echo number_format($subtotal) ?></td>
                </tr>
                <tr class="bg-light">
                    <td><?php echo lang('discount') ?></td>
                    <td class="text-right font-weight-bold"><?php echo number_format($diskon) ?></td>
                </tr>
                <tr class="bg-light">
                    <td><?php echo lang('ppn') ?></td>
                    <td class="text-right font-weight-bold"><?php echo number_format($ppn) ?></td>
                </tr>
                <tr class="bg-light">
                    <td><?php echo lang('total') ?></td>
                    <td class="text-right font-weight-bold"><?php echo number_format($total) ?></td>
                </tr>
                <?php if ($totalretur > 0): ?>
                     <tr class="bg-light">
                        <td><?php echo lang('Total_Retur') ?></td>
                        <td class="text-right font-weight-bold">(<?php echo number_format($totalretur) ?>)</td>
                    </tr>
                <?php endif ?>
                <tr class="bg-light">
                    <td><?php echo lang('Sudah_Dibayar') ?></td>
                    <td class="text-right font-weight-bold">(<?php echo number_format($totaldibayar) ?>)</td>
                </tr>
                <tr class="bg-light">
                    <td><?php echo lang('Sisa_Tagihan') ?></td>
                    <td class="text-right font-weight-bold"><?php echo number_format($sisatagihan) ?></td>
                </tr>
                <?php if ($totaldebetmemo > 0): ?>
                     <tr>
                        <td class="font-weight-bold"><?php echo lang('Total_Debet_Memo') ?></td>
                        <td class="text-right font-weight-bold"><?php echo number_format($totaldebetmemo) ?></td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>    
    </div>

    <div class="clearfix mb-5"></div>

    <div class="float-left">
        <div class="w-70">
            <table class="table table-sm">
                <tbody>
                    <tr>
                        <td><?php echo lang('Cara Bayar') ?></td>
                        <?php if($carabayar == '1'): ?>
                            <td class="font-weight-bold">: Tunai</td>
                        <?php else: ?>
                            <td class="font-weight-bold">: Kredit</td>
                        <?php endif ?>
                    </tr>
                    <tr>
                        <td><?php echo lang('Bank') ?></td>
                        <td class="font-weight-bold">: <?php echo $bank ?></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('Rekening') ?></td>
                        <td class="font-weight-bold">: <?php echo $norek ?></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('Atas Nama') ?></td>
                        <td class="font-weight-bold">: <?php echo $atasnama ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="float-right">
        <div class="w-30">
            <table class="table table-sm">
                <tbody>
                    <tr>
                        <td class="text-center">Hormat Kami</td>
                    </tr>
                    <tr> <td class="text-center">&nbsp;</td> </tr>
                    <tr> <td class="text-center">&nbsp;</td> </tr>
                    <tr>
                        <td class="text-center font-weight-bold">Heru Sukoco, S.Kom.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="clearfix mb-5"></div>

    <div class="footer-note">
        <p class="blue"> Harap Dicantumkan No. Invoice Dalam Payment Transfer </p>
        <p class="font-weight-bold"> SPECIALIST IDENTITY OF PATIENTS & PVC CARD PRINTING </p>
        <p class="small">
            *** Hospital/Patient Card, Patient Wirstband, Labels Stiker & Ribbons, Thermal Desktop Printer (Label & ID), SIMRS etc *** <br>
            ***Member Card, Discount Card, ID Card, Gift Card, Keycard Room, Parking Card, student Card etc*** 
        </p>
    </div>

</body>

</html>