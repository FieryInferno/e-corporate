<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-info22 mr-2"></i> <span class="font-weight-semibold">{title}</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none">
            <div class="d-flex justify-content-center">
                <div class="btn-group">
                    <a href="{site_url}retur_penjualan/printpdf/{id}" target="_blank" class="btn btn-primary">
                        <?php echo lang('print') ?>
                    </a>
                    <a href="{site_url}retur_penjualan" class="btn btn-danger">
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
                <div class="col-md-6">
                    <a href="{site_url}jurnal/detail/<?php echo get_idjurnal('6',$id) ?>" target="_balnk" class="btn btn-outline-primary">
                        <?php echo lang('view_journal') ?>
                    </a>
                </div>
                <div class="col-md-6 text-right">
                    <h1 class="text-success font-weight-bold text-uppercase"><?php echo lang('done') ?></h1>
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
                                    <td class="font-weight-bold">{kontak}</td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('warehouse') ?></td>
                                    <td class="font-weight-bold">{gudang}</td>
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
                                    <td class="text-right font-weight-bold"><?php echo number_format($subtotal) ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('discount') ?></td>
                                    <td class="text-right font-weight-bold"><?php echo number_format($diskon) ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('ppn') ?></td>
                                    <td class="text-right font-weight-bold"><?php echo number_format($ppn) ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('total') ?></td>
                                    <td class="text-right font-weight-bold"><?php echo number_format($total) ?></td>
                                </tr>
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
                            <thead class="{bg_header}">
                                <tr>
                                    <th><?php echo lang('item') ?></th>
                                    <th><?php echo lang('return_reason') ?></th>
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
                                <?php foreach ($returdetail as $row): ?>
                                    <?php $grandtotal = $row['total'] + $grandtotal ?>
                                    <tr>
                                        <td><?php echo $row['item'] ?></td>
                                        <td><?php echo $row['alasan'] ?></td>
                                        <td class="text-right"><?php echo number_format($row['harga']) ?></td>
                                        <td class="text-right"><?php echo number_format($row['jumlah']) ?></td>
                                        <td class="text-right"><?php echo number_format($row['subtotal']) ?></td>
                                        <td class="text-right"><?php echo number_format($row['diskon']) ?>%</td>
                                        <td class="text-right"><?php echo number_format($row['ppn']) ?>%</td>
                                        <td class="text-right"><?php echo number_format($row['total']) ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr class="bg-light">
                                    <td class="font-weight-bold text-right" colspan="7"><?php echo lang('grand_total') ?></td>
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