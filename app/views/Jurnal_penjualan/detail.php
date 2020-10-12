
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{title}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{site_url}pemesanan_penjualan">Penjualan</a></li>
                        <li class="breadcrumb-item"><a href="{site_url}pengiriman_penjualan">Pengiriman</a></li>
                        <li class="breadcrumb-item active">{title}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Detail {title}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                       <a href="{site_url}pengiriman_penjualan" class="btn btn-tool"><i class="fas fa-times"></i></a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><?php echo lang('notrans') ?></td>
                                        <td class="font-weight-bold">{notrans}</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('date') ?></td>
                                        <td class="font-weight-bold">{tanggal}</td>
                                    </tr>
                                    <?php if ($tipe_jurnal == 'penjualan') :?>
                                        <tr>
                                            <td><?php echo lang('Departemen') ?></td>
                                            <td class="font-weight-bold">
                                                <?php foreach ($get_pemesanan_pengiriman as $row): ?>
                                                    <?php echo $row['namadepartemen'] ?>
                                                <?php endforeach ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <td><?php echo lang('note') ?></td>
                                        <td class="font-weight-bold">{keterangan}</td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            
                        </div>
                        <div class="col-md-6">
                             <table class="table">
                                <tbody>
                                    <tr>
                                        <td><?php echo lang('total_debet') ?></td>
                                        <td class="font-weight-bold text-right"><?php echo "Rp. " .number_format($totaldebet,0,',','.') ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('total_kredit') ?></td>
                                        <td class="font-weight-bold text-right"><?php echo "Rp. " .number_format($totalkredit,0,',','.') ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('Type') ?></td>
                                        <td class="font-weight-bold text-right">
                                            <?php if ($stauto == '1'): ?>
                                                Auto Post Jurnal
                                            <?php else: ?>
                                                Jurnal Manual
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                
                                <table class="table table-bordered">
                                    <thead class="{bg_header}">
                                        <tr>
                                            <th><?php echo lang('account_number') ?></th>
                                            <th class="text-right"><?php echo lang('debet') ?></th>
                                            <th class="text-right"><?php echo lang('kredit') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total = 0 ?>
                                        <?php if ($tipe_jurnal == 'penjualan') : ?>
                                             <?php foreach ($get_jurnal_detail as $row): ?>
                                                <?php $total = $row['kredit'] + $total ?>
                                                <tr>
                                                    <td>
                                                        <?php if ($row['kredit'] == 0): ?>
                                                            <?php 
                                                                if (($row['tipe'] == 'jasa') || ($row['tipe'] == 'budgetevent') || ($row['tipe'] == 'inventaris')){
                                                                    echo $row['lain_lain'];
                                                                } else if ($row['tipe'] == 'barang'){
                                                                    echo $row['namaitem'];

                                                                } else {
                                                                    echo $row['namapengaturan'];
                                                                }
                                                            ?> 
                                                        <?php else: ?>
                                                            <?php 
                                                                if (($row['tipe'] == 'jasa') || ($row['tipe'] == 'budgetevent') || ($row['tipe'] == 'inventaris')){
                                                                    echo str_repeat('&nbsp;', 10). $row['lain_lain'];
                                                                } else if ($row['tipe'] == 'barang'){
                                                                    echo str_repeat('&nbsp;', 10). $row['namaitem'];

                                                                } else {
                                                                    echo str_repeat('&nbsp;', 10). $row['namapengaturan'];
                                                                }
                                                            ?> 
                                                           
                                                        <?php endif ?>
                                                    </td>
                                                    <td class="text-right"><?php echo "Rp. " .number_format($row['debet'],0,',','.') ?></td>
                                                    <td class="text-right"><?php echo "Rp. " .number_format($row['kredit'],0,',','.') ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php else : ?>
                                            <?php foreach ($get_jurnal_detail as $row): ?>
                                                <?php $total = $row['kredit'] + $total ?>
                                                <tr>
                                                    <td>
                                                        <?php if ($row['kredit'] == 0): ?>
                                                            <?php echo $row['namaakun'] ?> 
                                                        <?php else: ?>
                                                            <?php echo str_repeat('&nbsp;', 10).$row['namaakun'] ?> 
                                                        <?php endif ?>
                                                    </td>
                                                    <td class="text-right"><?php echo "Rp. " .number_format($row['debet'],0,',','.') ?></td>
                                                    <td class="text-right"><?php echo "Rp. " .number_format($row['kredit'],0,',','.') ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php endif; ?>
                                        <tr class="bg-light font-weight-bold">
                                           <td class="text-right"><?php echo lang('total') ?></td> 
                                           <td class="text-right"><?php echo "Rp. " .number_format($total,0,',','.') ?></td> 
                                           <td class="text-right"><?php echo "Rp. " .number_format($total,0,',','.') ?></td> 
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
</div>