
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
                        <li class="breadcrumb-item"><a href="{site_url}faktur_penjualan">Faktur</a></li>
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
                       <a href="{site_url}pengiriman_penjualan" class="btn btn-tool"><i class="fas fa-times"></i></a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6 text-left">
                            <a href="{site_url}jurnal_penjualan/detail/<?php echo $jurpenjualan['id'] ?>" target="_balnk" class="btn btn-outline-primary">
                            <?php echo lang('view_journal') ?>
                            </a>
                            <div class="btn-group">
                                <?php if ($this->model->getjumlahsisa($id) > 0): ?>
                                    <a href="{site_url}retur_penjualan/create?idfaktur={id}" class="btn btn-outline-primary"> 
                                        <?php echo lang('return') ?> 
                                    </a>
                                <?php endif ?>
                                <?php if ($status !== '3'): ?>
                                    <a href="{site_url}pembayaran_penjualan/create?idfaktur={id}" class="btn btn-outline-primary">
                                        <?php echo lang('payment') ?>
                                    </a>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <?php if ($status == '1'): ?>
                                <h1 class="text-danger font-weight-bold text-uppercase"><?php echo lang('pending') ?></h1>
                            <?php elseif ($status == '2'): ?>
                                <h1 class="text-warning font-weight-bold text-uppercase"><?php echo lang('partial') ?></h1>
                            <?php else: ?>
                                <h1 class="text-success font-weight-bold text-uppercase"><?php echo lang('done') ?></h1>
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
                                        <td><?php echo lang('date') ?></td>
                                        <td class="font-weight-bold">{tanggal}</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('supplier') ?></td>
                                        <td class="font-weight-bold"><?php echo $kontak['nama'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('warehouse') ?></td>
                                        <td class="font-weight-bold"><?php echo $gudang['nama'] ?></td>
                                    </tr>
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
                                    <td class="text-right font-weight-bold"><?php echo "Rp. " .number_format($diskon,0,',','.') ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('ppn') ?></td>
                                    <td class="text-right font-weight-bold"><?php echo "Rp. " .number_format($ppn,0,',','.') ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('total') ?></td>
                                    <td class="text-right font-weight-bold"><?php echo "Rp. " .number_format($total,0,',','.') ?></td>
                                </tr>
                                <?php if ($totalretur > 0): ?>
                                     <tr>
                                        <td><?php echo lang('Total_Retur') ?></td>
                                        <td class="text-right font-weight-bold">(<?php echo "Rp. " .number_format($totalretur,0,',','.') ?>)</td>
                                    </tr>
                                <?php endif ?>
                                <tr>
                                    <td><?php echo lang('Sudah_Dibayar') ?></td>
                                    <td class="text-right font-weight-bold">(<?php echo "Rp. " .number_format($totaldibayar,0,',','.') ?>)</td>
                                </tr>
                                <tr class="bg-light">
                                    <td><?php echo lang('Sisa_Tagihan') ?></td>
                                    <td class="text-right font-weight-bold"><?php echo "Rp. " .number_format($sisatagihan,0,',','.') ?></td>
                                </tr>
                                <?php if ($totalkreditmemo > 0): ?>
                                     <tr>
                                        <td class="font-weight-bold"><?php echo lang('Total_Kredit_Memo') ?></td>
                                        <td class="text-right font-weight-bold"><?php echo "Rp. " .number_format($totalkreditmemo,0,',','.') ?></td>
                                    </tr>
                                <?php endif ?>
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
                                                <td class="text-right"><?php echo "Rp. " .number_format($row['harga'],0,',','.') ?></td>
                                                <td class="text-right"><?php echo number_format($row['jumlah']) ?></td>
                                                <td class="text-right"><?php echo "Rp. " .number_format($row['subtotal'],0,',','.') ?></td>
                                                <td class="text-right"><?php echo number_format($row['diskon']) ?>%</td>
                                                <td class="text-right"><?php echo number_format($row['ppn']) ?>%</td>
                                                <td class="text-right"><?php echo "Rp. " .number_format($row['total'],0,',','.') ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                        <tr class="bg-light">
                                            <td class="font-weight-bold text-right" colspan="6"><?php echo lang('grand_total') ?></td>
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