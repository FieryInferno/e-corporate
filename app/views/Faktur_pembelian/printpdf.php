<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<title><?php echo $title ?></title>
	<style type="text/css"> <?php echo $css ?> </style>
    <style>
        body {
            font-size   : 12px;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td>
                <div class="header-logo">
                    <img src="<?= base_url(); ?>/uploads/bintang-teknologi.jpeg">
                </div>
            </td>
            <td>
                <table style="width:100%;">
                    <tr>
                        <th style="border-style:solid;border-width:1px;width:200px;" class="text-center"><?= $faktur['namaperusahaan']; ?></th>
                    </tr>
                    <tr>
                        <td style="border-style:solid;border-width:1px;word-wrap:break-word;width:200px;" class="text-left">
                            <?= $faktur['alamat']; ?>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="width:150px;">&nbsp;</td>
            <td class="text-center" style="width:150px;font-size:20px;">
                Purchase Invoice
                <hr>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td style="border-style:solid;border-width:1px;width:200px;" class="text-center">Vendor</td>
            <td style="width:300px;">&nbsp;</td>
            <td style="border-style:solid;border-width:1px;width:75px;" class="text-center">Invoice Date</td>
            <td style="border-style:solid;border-width:1px;width:75px;" class="text-center">invoice No</td>
        </tr>
        <tr>
            <td style="border-style:solid;border-width:1px;width:200px;" class="text-center">Refund Peserta</td>
            <td style="width:300px;">&nbsp;</td>
            <td style="border-style:solid;border-width:1px;width:75px;" class="text-center"><?= $faktur['tanggal']; ?></td>
            <td style="border-style:solid;border-width:1px;width:75px;" class="text-center"><?= $faktur['notrans']; ?></td>
        </tr>
        <tr>
            <td style="border-style:solid;border-width:1px;width:200px;" rowspan="3">&nbsp;</td>
            <td style="width:300px;">&nbsp;</td>
            <td style="border-style:solid;border-width:1px;width:75px;" class="text-center">Form No.</td>
        </tr>
        <tr>
            <td style="width:300px;">&nbsp;</td>
            <td style="border-style:solid;border-width:1px;width:75px;" class="text-center">64216</td>
        </tr>
    </table>
    <br>
    <table align="center" width="100%">
        <tr>
            <td>
                <table border="1" align="center" width="100%">
                    <tr>
                        <th class="text-center">Item</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">Unit Price</th>
                        <th class="text-center">Disc</th>
                        <th class="text-center">Tax</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Department</th>
                    </tr>
                </table>
                <table border="1" align="center" width="100%">
                    <tr>
                        <th class="text-center" style="width:200px;">Account Name</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center" style="width:200px;">Notes</th>
                        <th class="text-center">Department</th>
                        <th class="text-center">Project</th>
                    </tr>
                    <?php
                        $subtotal   = 0;
                        $diskon     = 0;
                        foreach ($faktur['detail'] as $key) { 
                            $subtotal   += (integer) $key['subtotal']; 
                            $diskon     += (integer) $key['diskon']; ?>
                            <tr>
                                <td><?= $key['namaakun']; ?></td>
                                <td>Rp. <?= number_format($key['total'],2,',','.'); ?></td>
                                <td><?= $key['catatan']; ?></td>
                                <td><?= $key['departemen']; ?></td>
                                <td></td>
                            </tr>
                        <?php }
                    ?>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td>Say</td>
            <td rowspan="2" style="border:1px solid #000000;width:485px;"><?= penyebut($subtotal); ?> Rupiah</td>
            <td class="text-right" style="border:1px solid #000000;width:100px;">Subtotal</td>
            <td class="text-right" style="border:1px solid #000000;width:85px;">Rp. <?= number_format($subtotal,2,',','.'); ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="text-right" style="border:1px solid #000000;">Discount</td>
            <td class="text-right" style="border:1px solid #000000;">Rp. <?= number_format($diskon,2,',','.'); ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td style="border:1px solid #000000;">Description</td>
            <td class="text-right" style="border:1px solid #000000;">:</td>
            <td class="text-right" style="border:1px solid #000000;">Rp. 0,00</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td rowspan="3" style="border:1px solid #000000;"></td>
            <td class="text-right" style="border:1px solid #000000;">Total</td>
            <td class="text-right" style="border:1px solid #000000;">Rp. <?= number_format(($subtotal + $diskon),2,',','.'); ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="text-right" style="border:1px solid #000000;">Payment</td>
            <td class="text-right" style="border:1px solid #000000;">Rp. 0,00</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="text-right" style="border:1px solid #000000;">Balance</td>
            <td class="text-right" style="border:1px solid #000000;">Rp. 0,00</td>
        </tr>
    </table>
    <br>
    <table align="center" width="100%">
        <tr>
            <td class="text-center" style="border:1px solid #000000;width:14%">
                <br>AP Staff,<br/>
                <br>
                <br>
                <br>
                <br>
                <br>
                <hr>
                Date:
            </td>
            <td class="text-center" style="border:1px solid #000000;width:14%">
                <br>Cost Control,<br/>
                <br>
                <br>
                <br>
                <br>
                <br>
                <hr>
                Date:
            </td>
            <td class="text-center" style="border:1px solid #000000;width:14%">
                <br>Accounting Head,<br/>
                <br>
                <br>
                <br>
                <br>
                <br>
                <hr>
                Date:
            </td>
            <td class="text-center" style="border:1px solid #000000;width:14%">
                <br>Finance Head,<br/>
                <br>
                <br>
                <br>
                <br>
                <br>
                <hr>
                Date:
            </td>
            <td class="text-center" style="border:1px solid #000000;width:14%">
                <br>FA Holding,<br/>
                <br>
                <br>
                <br>
                <br>
                <br>
                <hr>
                Date:
            </td>
            <td class="text-center" style="border:1px solid #000000;width:14%">
                <br>FA Director,<br/>
                <br>
                <br>
                <br>
                <br>
                <br>
                <hr>
                Date:
            </td>
            <td class="text-center" style="border:1px solid #000000;width:14%">
                <br>FA Controller,<br/>
                <br>
                <br>
                <br>
                <br>
                <br>
                <hr>
                Date:
            </td>
        </tr>
    </table>
</body>

</html>