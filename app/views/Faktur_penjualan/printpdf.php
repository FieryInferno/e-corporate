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
            <td class="text-center" style="border: 1px solid;"><?= $namaperusahaan; ?></td>
        </tr>
        <tr>
            <td style="border: 1px solid;">Menara 165 Lt. 24 Jl. TB Simatupang Kav. 1 Cilandak Jakarta Selatan</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>
                <table>
                    <tr>
                        <td class="text-left">Kepada Yth.</td>
                        <td rowspan="8" width="75px">&nbsp;</td>
                        <td colspan="2"><h1><u>INVOICE</u></h1></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid;" width="400px" class="text-left" rowspan="8"><strong><?= $kontak; ?></strong></td>
                        <td style="border: 1px solid;" width="25px">No.</td>
                        <td style="border: 1px solid;" width="100px"><?= $nomorsuratjalan; ?></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid;">Tgl</td>
                        <td style="border: 1px solid;"><?= $tanggal; ?></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid;">Terms</td>
                        <td style="border: 1px solid;"><?= $catatan; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table class="table table-striped table-borderless table-hover" style="width:100%">
        <thead>
            <tr class="table-active">
                <th>Kode</th>
                <th width="507px">Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($fakturdetail as $key) { ?>
                    <tr>
                        <td><?= $key['akunno']; ?></td>
                        <td>
                            <?php
                                switch ($jenis_pembelian) {
                                    case 'jasa': 
                                        echo $key['namaakun'];
                                        break;
                                    case 'jasa': 
                                        echo $key['item'];
                                        break;
                                    
                                    default:
                                        # code...
                                        break;
                                }
                            ?>    
                        </td>
                        <td class="text-right"><?= number_format($key['total'], 2, ',', '.'); ?></td>
                    </tr>
                <?php }
            ?>
        </tbody>
    </table>
    <br>
    <table class="table" style="width:100%">
        <tr class="table-active">
            <td style="border: 1px solid;" width="500px">Description</td>
            <td style="border: 1px solid;">Subtotal : </td>
            <td class="text-right" style="border: 1px solid;"><?= number_format($subtotal, 2, ',', '.'); ?></td>
        </tr>
        <tr class="table-active">
            <td style="border: 1px solid;" rowspan="2"><?= $catatan; ?></td>
            <td style="border: 1px solid;">Total : </td>
            <td class="text-right" style="border: 1px solid;"><?= number_format($total, 2, ',', '.'); ?></td>
        </tr>
    </table>
    <table class="table">
        <tr>
            <td style="border: 1px solid;" width="500px" class="table-active">Say</td>
            <td width="500px">&nbsp;</td>
        </tr>
        <tr class="table-active">
            <td style="border: 1px solid;">
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
        </tr>
    </table>
    <p>
        Pembayaran dapat ditransfer ke rekening : <br>
        MANDIRI 101.000.6655.110 | BCA 679.030.5190 | A/N : PT. ARGA BANGUN BANGSA
    </p>
    <table class="table" style="width:100%">
        <tr class="table-active">
            <td style="border: 1px solid;">
                Perhatian : <br>
                <ol>
                    <li>Training yang kami selenggarakan " Bebas PPN " sesuai SK Kepala KPP Jakarta Kebayoran Lama No. S-431/PJ.02/2010, Tgl. 23 April 2010, Perihal "Keterangan Tidak Dikenakan PPN".</li>
                    <li>Mohon dengan segera, "Bukti Potong PPH 23" yang asli di kirimkan ke Alamat : Menara 165, Jl TB Simatupang Lantai 24 Up Bagian Pajak ESQ Telp : 021-29406969</li>
                </ol>
            </td>
        </tr>
    </table>
    <table class="text-center" style="font-size: 12px;">
        <tr>
            <td width="100px;">&nbsp;</td>
            <td width="150px;">
                Prepared By
                <br>
                <br>
                <br>
                <br>
                <br>
                <u>Lukita Btari Puspowati</u><br>
                Billing
            </td>
            <td width="100px;">&nbsp;</td>
            <td width="100px;">&nbsp;</td>
            <td width="100px;">&nbsp;</td>
            <td width="100px;">
                Approved By
                <br>
                <br>
                <br>
                <br>
                <br>
                <u>Dina Sabrina</u><br>
                Head of Finance
            </td>
            <td width="100px;">&nbsp;</td>
        </tr>
    </table>
</body>
</html>