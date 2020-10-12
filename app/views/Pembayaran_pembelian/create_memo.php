<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-info22 mr-2"></i> <span class="font-weight-semibold">{title}</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none">
            <div class="d-flex justify-content-center">
                <div class="btn-group">
                    <a href="{site_url}pembayaran_pembelian/printpdf" class="btn btn-primary">
                        <?php echo lang('print') ?>
                    </a>
                    <a href="{site_url}pembayaran_pembelian" class="btn btn-danger">
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
                <div class="col-md-12 text-right">
                    <?php if ($status == '1'): ?>
                        <h1 class="text-danger font-weight-bold text-uppercase"><?php echo lang('pending') ?></h1>
                    <?php elseif ($status == '2'): ?>
                        <h1 class="text-warning font-weight-bold text-uppercase"><?php echo lang('partial') ?></h1>
                    <?php else: ?>
                        <h1 class="text-success font-weight-bold text-uppercase"><?php echo lang('done') ?></h1>
                    <?php endif ?>
                </div>
            </div>
            <div class="row mt-3 mb-3">
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
                                <?php foreach ($getfakturdetail as $row): ?>
                                    <?php $grandtotal = $row['total'] + $grandtotal ?>
                                    <tr>
                                        <td><?php echo $row['item'] ?></td>
                                        <td class="text-right"><?php echo number_format($row['harga']) ?></td>
                                        <td class="text-right"><?php echo number_format($row['jumlah']) ?></td>
                                        <td class="text-right"><?php echo number_format($row['subtotal']) ?></td>
                                        <td class="text-right"><?php echo number_format($row['diskon']) ?>%</td>
                                        <td class="text-right"><?php echo number_format($row['ppn']) ?>%</td>
                                        <td class="text-right"><?php echo number_format($row['total']) ?></td>
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
                <div class="col-md-6">
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
                            <?php if ($totalretur > 0): ?>
                                 <tr>
                                    <td><?php echo lang('Total_Retur') ?></td>
                                    <td class="text-right font-weight-bold">(<?php echo number_format($totalretur) ?>)</td>
                                </tr>
                            <?php endif ?>
                            <tr>
                                <td><?php echo lang('Sudah_Dibayar') ?></td>
                                <td class="text-right font-weight-bold">(<?php echo number_format($totaldibayar) ?>)</td>
                            </tr>
                            <tr class="bg-light">
                                <td><?php echo lang('Sisa_Tagihan') ?></td>
                                <td class="text-right font-weight-bold"><?php echo number_format($sisatagihan) ?></td>
                            </tr>
                            <?php if ($totaldebetmemo > 0): ?>
                                 <tr>
                                    <td class="font-weight-bold"><?php echo lang('Total_Debet_Memo') ?></td>
                                    <td class="text-right font-weight-bold"><?php echo number_format($totaldebetmemo) ?></td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <form action="javascript:save()" id="form1">
                <input type="hidden" name="fakturid" value="{id}">
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('date') ?>:</label>
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-calendar5"></i></span>
                                </span>
                                <input type="text" class="form-control datepicker" name="tanggal" required value="{tanggal}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('Total_Debet_Memo') ?>:</label>
                            <input type="text" class="form-control totaldebetmemo" name="totaldebetmemo" disabled value="{totaldebetmemo}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('Sisa_Tagihan') ?>:</label>
                            <input type="text" class="form-control sisatagihan" name="sisatagihan" disabled value="{sisatagihan}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('Pembayaran_Debet_Memo') ?>:</label>
                            <input type="text" class="form-control totaldibayar" name="totaldibayar" required value="0">
                        </div>
                    </div>
                </div>
                <div class="text-left">
                    <div class="btn-group">
                        <a href="{site_url}pembayaran_pembelian" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                        <button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script src="{assets_path}global/js/plugins/pickers/pickadate/picker.js"></script>
<script src="{assets_path}global/js/plugins/pickers/pickadate/picker.date.js"></script>
<script type="text/javascript">

    var base_url = '{site_url}pembayaran_pembelian/';


    $(document).ready(function(){
        $('.totaldebetmemo').val( numeral( $('.totaldebetmemo').val() ).format() );
        $('.totaldibayar').val( numeral( $('.totaldibayar').val() ).format() );
        $('.sisatagihan').val( numeral( $('.sisatagihan').val() ).format() );

        ajax_select({ id: '.noakunbayar', url: base_url + 'select2_noakunbayar', selected: { id: null } });

        $('.totaldibayar').change(function(){
            var val = numeral( $(this).val() ).value();
            var totaldebetmemo = numeral( $('.totaldebetmemo').val() ).value();
            var sisatagihan = numeral( $('.sisatagihan').val() ).value();
            if(val > totaldebetmemo || val > sisatagihan) {
                NotifyError('Debet pembayaran tidak boleh lebih besar dari debet memo!');
                $(this).val( numeral(0).format() );
                return false;
            }
        })
    })

    $(document).on('keyup','.totaldibayar',function(){
        var val = $(this).val();
        $(this).val( numeral(val).format() );
    })

    function save() {
        var form = $('#form1')[0];
        var formData = new FormData(form);

        if(formData.get('totaldibayar') <= 0) {
            NotifyError('Pembayaran tidak boleh kosong');
            return false;
        }
        
        $.ajax({
            url: base_url + 'save_memo',
            dataType: 'json',
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                pageBlock();
            },
            afterSend: function() {
                unpageBlock();
            },
            success: function(data) {
                if(data.status == 'success') {
                    NotifySuccess(data.message)
                    redirect(base_url);
                } else {
                    NotifyError(data.message)
                }
            },
            error: function() {
                NotifyError('<?php echo lang('internal_server_error') ?>');
            }
        })
    }
</script>