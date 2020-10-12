<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<title><?php echo $title ?></title>
	<style type="text/css"> <?php echo $css ?> </style>
    <style type="text/css">
        .kwitansi {
            border: 1px solid #aaa;
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
    <div class="kwitansi">
        <div class="w-60">
            <h3 class="font-weight-bold kwitansi-title"><?php echo $title ?></h3>
            <table class="table table-sm">
                <tbody>
                    <tr>
                        <td>Nomor Kwitansi</td>
                        <td class="font-weight-bold"> : <?php echo $notrans ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td> : <?php echo formatdatemonthname($tanggal) ?></td>
                    </tr>
                    <tr>
                        <td>Terbilang</td>
                        <td> : <?php echo penyebut($nominal) ?> Rupiah</td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td> : <?php echo $keterangan ?></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>
                            <div class="badge badge-info">
                                <?php echo number_format($nominal) ?>,-
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mb-3">&nbsp;</div>
        <div class="w-80">
            <table class="table table-sm">
                <tbody>
                    <tr>
                        <td class="text-left" width="50%">Tanda Tangan Penerima</td>
                        <td class="text-center">Disetujui</td>
                    </tr>
                    <tr>
                        <td class="text-center">&nbsp;</td>
                        <td class="text-center">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="text-center">&nbsp;</td>
                        <td class="text-center">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="text-left font-weight-bold" width="50%"><?php echo $penerima ?></td>
                        <td class="text-center font-weight-bold">Wiwin Winingsih</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>