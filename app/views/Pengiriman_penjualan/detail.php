
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
                        <li class="breadcrumb-item"><a href="{site_url}Pemesanan_penjualan">Penjualan</a></li>
                        <li class="breadcrumb-item"><a href="{site_url}Pengiriman_penjualan">Pengiriman</a></li>
                        <li class="breadcrumb-item active">Detail{title}</li>
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
                       <a href="{site_url}Pengiriman_penjualan" class="btn btn-tool"><i class="fas fa-times"></i></a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6 text-left">
                            
                        </div>
                        <div class="col-md-6 text-right">
                            <?php if ($validasi == '1'): ?>
                                <h1 class="text-primary font-weight-bold text-uppercase"><?php echo lang('Validasi') ?></h1>
                            <?php elseif($status == '3'): ?>
                                <h1 class="text-success font-weight-bold text-uppercase"><?php echo lang('done') ?></h1>
                            <?php elseif($status == '2'): ?>
                                <h1 class="text-warning font-weight-bold text-uppercase"><?php echo lang('partial') ?></h1>
                            <?php else: ?>
                                <h1 class="text-danger font-weight-bold text-uppercase"><?php echo lang('partial') ?></h1>
                            <?php endif ?>
                        </div>
                    </div>
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
                                        <td><?php echo lang('date') ?> PO</td>
                                        <td class="font-weight-bold">{tanggal}</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('date') ?> Terima</td>
                                        <td class="font-weight-bold">{tanggalterima}</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('No. surat jalan') ?></td>
                                        <td class="font-weight-bold">{nomorsuratjalan}</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('supplier') ?></td>
                                        <td class="font-weight-bold"><?php echo $kontak['nama'] ?></td>
                                    </tr>
                                    <?php if ($gudang['nama']!='') : ?>
                                    <tr>
                                        <td><?php echo lang('warehouse') ?></td>
                                        <td class="font-weight-bold"><?php echo $gudang['nama'] ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <td><?php echo lang('note') ?></td>
                                        <td class="font-weight-bold">{catatan}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                             <table class="table">
                                <tbody>
                                    <tr>
                                        <td><?php echo lang('subtotal') ?></td>
                                        <td class="text-right font-weight-bold"><?php echo "Rp. " .number_format($subtotal,0,',','.') ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('discount') ?></td>
                                        <?Php 
                                            $hasil_diskon = $subtotal;
                                            if ($diskon > 0){
                                                $nominaldiskon = ($diskon * $subtotal / 100);
                                                $hasil_diskon = $hasil_diskon - $nominaldiskon;
                                            }else{
                                                $nominaldiskon = 0;
                                                $hasil_diskon = $hasil_diskon - $nominaldiskon;
                                            }
                                        ?>
                                        <td class="text-right font-weight-bold"><?php echo "Rp. " .number_format($hasil_diskon,0,',','.') ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('ppn') ?></td>
                                        <td class="text-right font-weight-bold"><?php echo "Rp. " .number_format($ppn,0,',','.') ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('Biaya Pengiriman') ?></td>
                                        <td class="text-right font-weight-bold"><?php echo "Rp. " .number_format($biaya_pengiriman,0,',','.') ?></td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td><?php echo lang('total') ?></td>
                                        <td class="text-right font-weight-bold"><?php echo "Rp. " .number_format($total,0,',','.') ?></td>
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
                                            <th><?php echo lang('item') ?></th>
                                            <th class="text-right"><?php echo lang('price') ?></th>
                                            <th class="text-right"><?php echo lang('qty_received') ?></th>
                                            <th class="text-right"><?php echo lang('subtotal') ?></th>
                                            <th class="text-right"><?php echo lang('discount') ?></th>
                                            <th class="text-right"><?php echo lang('ppn') ?></th>
                                            <th class="text-right"><?php echo lang('Biaya Pengiriman') ?></th>
                                            <th class="text-right"><?php echo lang('total') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $grandtotal = 0; ?>
                                        <?php foreach ($pengirimandetail as $row): ?>
                                            <?php $grandtotal = $row['total'] + $grandtotal ?>
                                            <tr>
                                                <td><?php 
                                                    if ($row['tipe']=='barang'){
                                                        echo $row['item']; 
                                                    }else{
                                                        echo $row['lain_lain'];
                                                    }
                                                    ?>
                                                
                                                </td>
                                                <td class="text-right"><?php echo "Rp. " .number_format($row['harga'],0,',','.') ?></td>
                                                <td class="text-right"><?php echo number_format($row['jumlah']) ?></td>
                                                <td class="text-right"><?php echo "Rp. " .number_format($row['subtotal'],0,',','.') ?></td>
                                                <td class="text-right"><?php echo number_format($row['diskon']) ?>%</td>
                                                <td class="text-right"><?php echo "Rp. " .number_format($row['ppn'],0,',','.') ?></td>
                                                <td class="text-right"><?php echo "Rp. " .number_format($row['biaya_pengiriman'],0,',','.') ?></td>
                                                <td class="text-right"><?php echo "Rp. " .number_format($row['total'],0,',','.') ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                        <tr class="bg-light">
                                            <td class="font-weight-bold text-right" colspan="7"><?php echo lang('grand_total') ?></td>
                                            <td class="font-weight-bold text-right"><?php echo "Rp. " .number_format($grandtotal,0,',','.') ?></td>
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