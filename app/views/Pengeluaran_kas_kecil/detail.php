<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-info22 mr-2"></i> <span class="font-weight-semibold">{title}</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none">
            <div class="d-flex justify-content-center">
                <div class="btn-group">
                    <!-- <a href="{site_url}pemesanan_pembelian/printpdf/{id}" target="_blank" class="btn btn-primary">
                        <?php echo lang('print') ?>
                    </a> -->
                    <a href="{site_url}pengeluaran_kas_kecil" class="btn btn-danger">
                        <?php echo lang('back') ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="card">
        <div class="card-header {bg_header}">
            <div class="header-elements-inline">
                <h5 class="card-title">{subtitle}</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6 text-left">

                </div>
                <div class="col-md-6 text-right">
                    <?php if ($status == '0'): ?>
                        <h1 class="text-danger font-weight-bold text-uppercase"><?php echo lang('pending') ?></h1>
                    <?php else: ?>
                        <h1 class="text-success font-weight-bold text-uppercase"><?php echo lang('Validasi') ?></h1>
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
                                <td class="font-weight-bold">{nokwitansi}</td>
                            </tr>
                            <tr>
                                <td><?php echo lang('date') ?></td>
                                <td class="font-weight-bold">{tanggal}</td>
                            </tr>
                            <tr>
                                <td><?php echo lang('company') ?></td>
                                <td class="font-weight-bold"><?php echo $perusahaan['nama_perusahaan'] ?></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('Departemen') ?></td>
                                <td class="font-weight-bold"><?php echo $departemen['nama'] ?></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('Nama Penerima') ?></td>
                                <td class="font-weight-bold">{pejabat}</td>
                            </tr>
                            <tr>
                                <td><?php echo lang('keterangan') ?></td>
                                <td class="font-weight-bold">{keterangan}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><?php echo lang('subtotal') ?></td>
                                <td class="text-right font-weight-bold">Rp. <?php echo number_format($subtotal,2,",",".") ?></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('discount') ?></td>
                                <td class="text-right font-weight-bold"><?php echo number_format($diskon) ?></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('ppn') ?></td>
                                <td class="text-right font-weight-bold"><?php echo number_format($ppn) ?></td>
                            </tr>
                            <tr class="bg-light">
                                <td><?php echo lang('total') ?></td>
                                <td class="text-right font-weight-bold">Rp. <?php echo number_format($total,2,",",".") ?></td>
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
                                    <th class="text-right"><?php echo lang('qty') ?></th>
                                    <th class="text-right"><?php echo lang('subtotal') ?></th>
                                    <th class="text-right"><?php echo lang('discount') ?></th>
                                    <th class="text-right"><?php echo lang('ppn') ?></th>
                                    <th class="text-right"><?php echo lang('total') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $grandtotal = 0; ?>
                                <?php foreach ($pengeluarkaskecildetail as $row): ?>
                                    <?php $grandtotal = $row['total'] + $grandtotal ?>
                                    <tr>
                                        <td><?php echo $row['nama_item'] ?></td>
                                        <td class="text-right">Rp. <?php echo number_format($row['harga'],2,",",".") ?></td>
                                        <td class="text-right"><?php echo number_format($row['jumlah']) ?></td>
                                        <td class="text-right">Rp. <?php echo number_format($row['subtotal'],2,",",".") ?></td>
                                        <td class="text-right"><?php echo number_format($row['diskon']) ?>%</td>
                                        <td class="text-right"><?php echo number_format($row['ppn']) ?>%</td>
                                        <td class="text-right">Rp.<?php echo number_format($row['total'],2,",",".") ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr class="bg-light">
                                    <td class="font-weight-bold text-right" colspan="6"><?php echo lang('grand_total') ?></td>
                                    <td class="font-weight-bold text-right">Rp. <?php echo number_format($grandtotal,2,",",".") ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>