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
            <form action="javascript:save()" id="form1">
                <input type="hidden" name="fakturid" value="{id}">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('notrans') ?>:</label>
                            <input type="text" class="form-control" name="notrans" placeholder="AUTO">
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('supplier') ?>:</label>
                            <select class="form-control kontakid" name="kontakid" disabled></select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('date') ?>:</label>
                            <div class="input-group"> 
                                <input type="text" class="form-control datepicker" name="tanggal" required value="{tanggal}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('warehouse') ?>:</label>
                            <select class="form-control gudangid" name="gudangid" disabled></select>
                        </div>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
                <div class="mb-3 mt-3 table-responsive">
                    <table class="table table-bordered" id="table_detail">
                        <thead class="{bg_header}">
                            <tr>
                                <th><?php echo lang('item') ?></th>
                                <th class="text-right"><?php echo lang('price') ?></th>
                                <th class="text-right"><?php echo lang('available_quantity') ?></th>
                                <th class="text-right"><?php echo lang('qty_return') ?></th>
                                <th class="text-right"><?php echo lang('subtotal') ?></th>
                                <th class="text-right"><?php echo lang('discount') ?></th>
                                <th class="text-right"><?php echo lang('ppn') ?></th>
                                <th class="text-right"><?php echo lang('total') ?></th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php $no = 0; $grandtotal = 0; ?>
                            <?php foreach ($fakturdetail as $row): ?>
                                <?php 

                                    $grandtotal = $grandtotal + $row['total'];
                                    $subtotal = $row['harga']*$row['jumlahsisa'];
                                    $total = $row['total'];
                                    if($row['diskon'] > 0) {
                                        $nominaldiskon = ($row['diskon']*$subtotal/100);
                                        $total = $subtotal - $nominaldiskon;
                                    }
                                    if($row['ppn'] > 0) {
                                        $nominalppn = ($row['ppn']*$subtotal/100);
                                        $total = $subtotal + $nominalppn;
                                    }
                                ?>
                                <tr>
                                    <input class="no" type="hidden" name="no[]" value="<?php echo $no ?>">
                                    <input class="itemid" type="hidden" name="itemid[]" value="<?php echo $row['itemid'] ?>">
                                    <td><?php echo $row['item'] ?></td>
                                    <td class="text-right" width="12%">
                                        <input type="text" class="form-control harga" value="<?php echo number_format($row['harga']) ?>" disabled>
                                    </td>
                                    <?php $sisa = $this->model->getjumlahsisa($row['idfaktur']) ?>
                                    <td class="text-right" width="12%">
                                        <input type="text" class="form-control jumlahfaktur" value="<?php echo number_format($sisa) ?>" disabled name="jumlahfaktur[]">
                                    </td>
                                    <td class="text-right" width="12%">
                                        <?php if ($sisa < 1): ?>
                                            <input type="text" class="form-control jumlah text-right" value="0" disabled>
                                        <?php else: ?>
                                            <input type="text" class="form-control jumlah text-right" value="0" name="jumlah[]">
                                        <?php endif ?>
                                    </td>
                                    <td class="text-right" width="12%">
                                        <input type="text" class="form-control subtotal" value="0" disabled>
                                    </td>
                                    <td class="text-right" width="12%">
                                        <input type="text" class="form-control diskon" value="<?php echo number_format($row['diskon']) ?>" disabled>
                                    </td>
                                    <td class="text-right" width="12%">
                                        <input type="text" class="form-control ppn" value="<?php echo number_format($row['ppn']) ?>" disabled>
                                    </td>
                                    <td class="text-right" width="12%">
                                        <input type="text" class="form-control total" value="0" disabled>
                                    </td>
                                </tr>
                                <?php $no++ ?>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <th colspan="7" class="text-right"><?php echo lang('grand_total') ?></th>
                                <th class="text-right totalfooter">0</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('note') ?>:</label>
                            <textarea class="form-control catatan" name="catatan" rows="6"></textarea>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="detail_array" id="detail_array">
                <div class="text-left">
                    <div class="btn-group">
                        <a href="{site_url}retur_pembelian" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                        <button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script src="{assets_path}global/js/plugins/tables/datatables/datatables.min.js"></script>
<script src="{assets_path}global/js/plugins/pickers/pickadate/picker.js"></script>
<script src="{assets_path}global/js/plugins/pickers/pickadate/picker.date.js"></script>
<script type="text/javascript">
    var base_url = '{site_url}retur_pembelian/';

    $('#table_detail tbody').on('change','.jumlah',function(){
        var itemid, harga, jumlah, subtotal, 
        diskon, ppn, total, nominaldiskon, nominalppn, jumlahsisa, jumlahfaktur = null;
        var row = $(this).closest('tr');
        row.find('input.jumlah').each(function() { jumlah = numeral(this.value).value() });
        row.find('input.jumlahfaktur').each(function() { jumlahfaktur = numeral(this.value).value() });
        row.find('input.subtotal').each(function() { itemid = this.value });
        row.find('input.harga').each(function() { harga = numeral(this.value).value() });
        row.find('input.diskon').each(function() { diskon = numeral(this.value).value() });
        row.find('input.ppn').each(function() { ppn = numeral(this.value).value() });
        row.find('input.jumlahsisa').each(function() { jumlahsisa = numeral(this.value).value() });

        if(jumlah > jumlahfaktur) {
            NotifyError('Jumlah retur tidak boleh melebihi jumlah yang tersedia!');
            row.find('input.jumlah').val( 0 );
            return false;
        }

        subtotal = harga*jumlah;
        row.find('input.subtotal').val( numeral(subtotal).format() );
        
        if(diskon > 0) {
            nominaldiskon = (diskon*subtotal/100);
            subtotal = subtotal - nominaldiskon;
        }

        if(ppn > 0) {
            nominalppn = (ppn*subtotal/100);
            subtotal = subtotal + nominalppn;
        }

        row.find('input.total').val( numeral(subtotal).format() );
        
        var totalfooter = 0;
        $('#table_detail tbody').find('input.total').each(function() { totalfooter += numeral(this.value).value() });
        $('.totalfooter').text( numeral(totalfooter).format() );

    })

    $(document).ready(function(){
        ajax_select({ id: '.kontakid', url: base_url + 'select2_kontak', selected: { id: '{kontakid}' } });
        ajax_select({ id: '.gudangid', url: base_url + 'select2_gudang', selected: { id: '{gudangid}' } });
    })

    function save() {
        var form = $('#form1')[0];
        var formData = new FormData(form);
        
        $.ajax({
            url: base_url + 'save',
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
                // alert(JSON.stringify(data))
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