<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="row mt-2">
        <div class="mt-2">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title mb-4 text-center"><?= $nama_perusahaan ?></h3>
                            <h2 class="card-title mb-4 text-center"><?= $title ?></h2>
                            <h3 class="card-title mb-4 text-center"><?= $title2 ?></h3>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 110px;">Invoice No.</th>
                                        <th class="text-center" style="width: 130px;">Invoice Date</th>
                                        <th class="text-center" style="width: 140px;">Total Prime Curr</th>
                                        <th class="text-center" style="width: 100px;">Not Yet</th>
                                        <th class="text-center" style="width: 100px;">1-30</th>
                                        <th class="text-center" style="width: 100px;">31-60</th>
                                        <th class="text-center" style="width: 100px;">61-90</th>
                                        <th class="text-center" style="width: 100px;">91-120</th>
                                        <th class="text-center" style="width: 100px;">>120</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($piutang): ?>
                                        <?php 
                                        $no = 1; 
                                        $total=0;
                                        $not_yet=0;
                                        $_130=0;
                                        $_3160=0;
                                        $_6190=0;
                                        $_91120=0;
                                        $_120=0;

                                        foreach($piutang as $u):
                                            $total += $u['jml_utang'];
                                            $tanggal = new DateTime($tanggal_skg);
                                            $tempo = new DateTime($u['tempo']);
                                            $h = $tempo->diff($tanggal)->days + 1;
                                            if($h == 0 ){
                                                $not_yet += $u['jml_utang'];
                                            } else {
                                                $not_yet += 0;
                                            } 
                                            
                                            if($h > 30 && $h <= 60){
                                                $_130 += $u['jml_utang'];
                                            } else {
                                                $_130 += 0;
                                            } 

                                            if($h > 30 && $h <= 60){
                                                $_3160 += $u['jml_utang'];
                                            } else {
                                                $_3160 += 0;
                                            } 

                                            if($h > 60 && $h <= 90){
                                                $_6190 += $u['jml_utang'];
                                            } else {
                                                $_6190 += 0;
                                            } 

                                            if($h > 90 && $h <= 120){
                                                $_91120 += $u['jml_utang'];
                                            } else {
                                                $_91120 += 0;
                                            } 

                                            if($h > 120){
                                                $_120 += $u['jml_utang'];
                                            } else {
                                                $_120 += 0;
                                            } 
                                            ?>
                                            <tr>
                                              <td style="text-align: center;"><?= $u['no_invoice'];?></td>
                                              <td style="text-align: center;"><?= date('d F Y', strtotime($u['tanggal']));?></td>
                                              <td style="text-align: center;">
                                                <?php echo number_format($u['jml_utang'], 0, ',', '.'); ?> 
                                              </td>
                                              <td style="text-align: center;">
                                                <?php if($h == 0 ){
                                                    echo number_format($u['jml_utang'], 0, ',', '.');
                                                } else {
                                                    echo '0';
                                                } 
                                                ?> 
                                              </td>
                                              <td style="text-align: center;">
                                                <?php if($h > 0 && $h <= 30){
                                                    echo number_format($u['jml_utang'], 0, ',', '.');
                                                } else {
                                                    echo '0';
                                                } 
                                                ?> 
                                              </td>
                                              <td style="text-align: center;">
                                                <?php if($h > 30 && $h <= 60){
                                                    echo number_format($u['jml_utang'], 0, ',', '.');
                                                } else {
                                                    echo '0';
                                                } 
                                                ?> 
                                              </td>
                                              <td style="text-align: center;">
                                                <?php if($h > 60 && $h <= 90){
                                                    echo number_format($u['jml_utang'], 0, ',', '.');
                                                } else {
                                                    echo '0';
                                                } 
                                                ?> 
                                              </td>
                                              <td style="text-align: center;">
                                                <?php if($h > 90 && $h <= 120){
                                                    echo number_format($u['jml_utang'], 0, ',', '.');
                                                } else {
                                                    echo '0';
                                                } 
                                                ?> 
                                              </td>
                                              <td style="text-align: center;">
                                                <?php if($h > 120){
                                                    echo number_format($u['jml_utang'], 0, ',', '.');
                                                } else {
                                                    echo '0';
                                                } 
                                                ?> 
                                              </td>

                                            </tr>
                                            <?php endforeach;?>
                                            <tr>
                                              <td style="text-align: center;"></td>
                                              <td style="text-align: center;"></td>
                                              <td style="text-align: center;">
                                                <?php echo number_format($total, 0, ',', '.'); ?> 
                                              </td>
                                              <td style="text-align: center;">
                                                <?php 
                                                    echo number_format($not_yet, 0, ',', '.');
                                             
                                                ?> 
                                              </td>
                                              <td style="text-align: center;">
                                                <?php 
                                                    echo number_format($_130, 0, ',', '.');
                                            
                                                ?> 
                                              </td>
                                              <td style="text-align: center;">
                                                <?php 
                                                    echo number_format($_3160, 0, ',', '.');
                                            
                                                ?> 
                                              </td>
                                              <td style="text-align: center;">
                                                <?php 
                                                    echo number_format($_6190, 0, ',', '.');
                                               
                                                ?> 
                                              </td>
                                              <td style="text-align: center;">
                                                <?php 
                                                    echo number_format($_91120, 0, ',', '.');
                                               
                                                ?> 
                                              </td>
                                              <td style="text-align: center;">
                                                <?php 
                                                    echo number_format($_120, 0, ',', '.');
                                               
                                                ?> 
                                              </td>

                                            </tr>
                                    <?php else: ?>
                                        <tr>
                                            <td class="bg-light" colspan="7">Tidak ada data izin</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    window.print();
</script>
</html>
