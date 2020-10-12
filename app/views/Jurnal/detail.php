<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-info22 mr-2"></i> <span class="font-weight-semibold">{title}</span></h4>
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
                                <td class="font-weight-bold text-right">{totaldebet}</td>
                            </tr>
                            <tr>
                                <td><?php echo lang('total_kredit') ?></td>
                                <td class="font-weight-bold text-right">{totalkredit}</td>
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
            <div class="row mt-5">
                <div class="col-md-12">
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
                                    <td class="text-right"><?php echo number_format($row['debet']) ?></td>
                                    <td class="text-right"><?php echo number_format($row['kredit']) ?></td>
                                </tr>
                            <?php endforeach ?>
                            <tr class="bg-light font-weight-bold">
                               <td class="text-right"><?php echo lang('total') ?></td> 
                               <td class="text-right"><?php echo number_format($total) ?></td> 
                               <td class="text-right"><?php echo number_format($total) ?></td> 
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
</div>