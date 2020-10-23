
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
                        <li class="breadcrumb-item"><a href="{site_url}Faktur_penjualan">{title}</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail {title}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6 text-left">
                            <a href="" target="_balnk" class="btn btn-outline-primary">
                                <?php echo lang('view_journal') ?>
                            </a>
                            <div class="btn-group">
                                <?php if ($this->model->getjumlahsisa($id) > 0): ?>
                                    <a href="{site_url}retur_pembelian/create?idfaktur={id}" class="btn btn-outline-primary"> 
                                        <?php echo lang('return') ?> 
                                    </a>
                                <?php endif ?>
                                <?php if ($status !== '3'): ?>
                                    <a href="{site_url}pembayaran_pembelian/create?idfaktur={id}" class="btn btn-outline-primary">
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
                            <div class="table-responsive">
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
                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><?php echo lang('subtotal') ?></td>
                                            <td class="text-right font-weight-bold"><?php echo number_format($subtotal, 2, ',','.') ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo lang('discount') ?></td>
                                            <td class="text-right font-weight-bold"><?php echo number_format($diskon, 2, ',','.') ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo lang('ppn') ?></td>
                                            <td class="text-right font-weight-bold"><?php echo number_format($ppn, 2, ',','.') ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo lang('total') ?></td>
                                            <td class="text-right font-weight-bold"><?php echo number_format($total, 2, ',','.') ?></td>
                                        </tr>
                                        <?php if ($totalretur > 0): ?>
                                            <tr>
                                                <td><?php echo lang('Total_Retur') ?></td>
                                                <td class="text-right font-weight-bold">(<?php echo number_format($totalretur, 2, ',','.') ?>)</td>
                                            </tr>
                                        <?php endif ?>
                                        <tr>
                                            <td><?php echo lang('Sudah_Dibayar') ?></td>
                                            <td class="text-right font-weight-bold">(<?php echo number_format($totaldibayar, 2, ',','.') ?>)</td>
                                        </tr>
                                        <tr class="bg-light">
                                            <td><?php echo lang('Sisa_Tagihan') ?></td>
                                            <td class="text-right font-weight-bold"><?php echo number_format($sisatagihan, 2, ',','.') ?></td>
                                        </tr>
                                        <?php if ($totaldebetmemo > 0): ?>
                                            <tr>
                                                <td class="font-weight-bold"><?php echo lang('Total_Debet_Memo') ?></td>
                                                <td class="text-right font-weight-bold"><?php echo number_format($totaldebetmemo, 2, ',','.') ?></td>
                                            </tr>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
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
                                                <td class="text-right"><?php echo number_format($row['harga'], 2, ',','.') ?></td>
                                                <td class="text-right"><?= $row['jumlah']; ?></td>
                                                <td class="text-right"><?php echo number_format($row['subtotal'], 2, ',','.') ?></td>
                                                <td class="text-right"><?php echo number_format($row['diskon']) ?>%</td>
                                                <td class="text-right"><?php echo number_format($row['ppn'], 2, ',','.') ?></td>
                                                <td class="text-right"><?php echo number_format($row['total'], 2, ',','.') ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                        <tr class="bg-light">
                                            <td class="font-weight-bold text-right" colspan="6"><?php echo lang('grand_total') ?></td>
                                            <td class="font-weight-bold text-right"><?php echo number_format($grandtotal) ?></td>
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