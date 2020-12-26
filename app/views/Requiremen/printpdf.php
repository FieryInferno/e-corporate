<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<title><?php echo $title ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style type="text/css"> <?php echo $css ?></style>
    <style>
        body {
            font-size   : 10px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <table>
        <tr>
            <td rowspan="2" width="75px">&nbsp;</td>
            <td class="text-center" style="border: 1px solid;">PT. ARGA BANGUN BANGSA</td>
            <td width="150px">&nbsp;</td>
            <td rowspan="2"><h1><u>Permintaan Pembelian</u></h1></td>
        </tr>
        <tr>
            <td style="border: 1px solid;">Menara 165 Lt. 24 Jl. TB Simatupang Kav. 1 Cilandak Jakarta Selatan</td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td class="text-center">
                <table class="text-center">
                    <tr>
                        <td style="border: 1px solid;" width="200px">Vendor</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid;">Refund Peserta</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid;" rowspan="4">&nbsp;</td>
                    </tr>
                </table>
            </td>
            <td width="250px">&nbsp;</td>
            <td>
                <table class="text-center">
                    <tr>
                        <td style="border: 1px solid;" width="100px">Invoice Date</td>
                        <td style="border: 1px solid;" width="100px">Invoice No.</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid;"><?= $tanggal; ?></td>
                        <td style="border: 1px solid;"><?= $notrans; ?></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid;">Form No.</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid;">64216</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table class="table table-striped table-borderless table-hover" style="width:100%">
        <thead>
            <tr class="table-active">
                <th>Item</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Disc</th>
                <th>Tax</th>
                <th>Amount</th>
                <th>Nominal Total</th>
                <th>Departement</th>
            </tr>
        </thead>
    </table>
    <table class="table table-striped table-borderless table-hover" style="width:100%">
        <thead>
            <tr class="table-active">
                <th>Account Name</th>
                <th>Amount</th>
                <th>Note</th>
                <th>Department</th>
                <th>Project</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($pemesanandetail as $key) { ?>
                    <tr>
                        <td><?= $key['akunno'] . ' - ' . $key['namaakun']; ?></td>
                        <td class="text-right"><?= number_format($key['harga'], 2, ',', '.'); ?></td>
                        <td><?= $catatan; ?></td>
                        <td><?= $departemen; ?></td>
                        <td><?= $noEvent; ?></td>
                    </tr>
                <?php }
            ?>
        </tbody>
    </table>
    <br>
    <table class="table" style="width:100%">
        <tr class="table-active">
            <td rowspan="5" width="5px">Say</td>
            <td width="200px" style="border: 1px solid;">
                <?php 
                    function terbilang($nilai) {
                        if($nilai<0) {
                            $hasil = "minus ". trim(penyebut($nilai));
                        } else {
                            $hasil = trim(penyebut($nilai));
                        }     		
                        return $hasil;
                    }
                    echo strtoupper(terbilang($total)) . ' RUPIAH'; 
                ?>
            </td>
            <td width="10px" rowspan="5">&nbsp;</td>
            <td width="10px" style="border: 1px solid;">Subtotal : </td>
            <td width="10px" class="text-right" style="border: 1px solid;"><?= number_format($total, 2, ',', '.'); ?></td>
        </tr>
        <tr class="table-active">
            <td style="border: 1px solid;">Description</td>
            <td style="border: 1px solid;">Discount : </td>
            <td class="text-right" style="border: 1px solid;"><?= $diskon; ?> %</td>
        </tr>
        <tr class="table-active">
            <td rowspan="3" style="border: 1px solid;"><?= $catatan; ?></td>
            <td style="border: 1px solid;">Total : </td>
            <td class="text-right" style="border: 1px solid;"><?= number_format($total, 2, ',', '.'); ?></td>
        </tr>
        <tr class="table-active">
            <td style="border: 1px solid;">Payment : </td>
            <td class="text-right" style="border: 1px solid;">0</td>
        </tr>
        <tr class="table-active">
            <td style="border: 1px solid;">Balance : </td>
            <td class="text-right" style="border: 1px solid;">0</td>
        </tr>
    </table>
    <br>
    <table class="text-center" style="font-size: 12px;">
        <tr>
            <td style="border: 1px solid;" width="100px;">
                AP Staff
                <br>
                <br>
                <br>
                <br>
                <br>
                Date.
            </td>
            <td style="border: 1px solid;" width="100px;">
                Cost Control
                <br>
                <br>
                <br>
                <br>
                <br>
                Date.
            </td>
            <td style="border: 1px solid;" width="100px;">
                Accounting Head
                <br>
                <br>
                <br>
                <br>
                <br>
                Date.
            </td>
            <td style="border: 1px solid;" width="100px;">
                Finance Head
                <br>
                <br>
                <br>
                <br>
                <br>
                Date.
            </td>
            <td style="border: 1px solid;" width="100px;">
                FA Holding
                <br>
                <br>
                <br>
                <br>
                <br>
                Date.
            </td>
            <td style="border: 1px solid;" width="100px;">
                FA Director
                <br>
                <br>
                <br>
                <br>
                <br>
                Date.
            </td>
            <td style="border: 1px solid;" width="100px;">
                FA Controller
                <br>
                <br>
                <br>
                <br>
                <br>
                Date.
            </td>
        </tr>
    </table>
</body>
</html>