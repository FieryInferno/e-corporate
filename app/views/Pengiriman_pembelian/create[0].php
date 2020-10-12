<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-info22 mr-2"></i> <span class="font-weight-semibold">{title}</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
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
                <input type="hidden" name="pemesananid" value="{id}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('date') ?>:</label>
                            <div class="input-group"> 
                                <input type="text" class="form-control datepicker" name="tanggal" required value="{tanggal}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">&nbsp;</div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('supplier') ?>:</label>
                            <select class="form-control kontakid" name="kontakid" disabled></select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('warehouse') ?>:</label>
                            <select class="form-control gudangid" name="gudangid" disabled></select>
                        </div>
                    </div>
                    <div class="col-md-6">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('note') ?>:</label>
                            <textarea class="form-control catatan" name="catatan" rows="6"></textarea>
                        </div>
                    </div>
                </div>
                <div class="mb-3 mt-3 table-responsive">
                    <table class="table table-bordered" id="table_detail">
                        <thead class="{bg_header}">
                            <tr>
                                <th><?php echo lang('item') ?></th>
                                <th class="text-right"><?php echo lang('qty_residual') ?></th>
                                <th class="text-right"><?php echo lang('qty_received') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            <?php foreach ($pemesanandetail as $row): ?>
                                <tr>
                                    <input class="no" type="hidden" name="no[]" value="<?php echo $no ?>">
                                    <input class="itemid" type="hidden" name="itemid[]" value="<?php echo $row['itemid'] ?>">
                                    <td><?php echo $row['item'] ?></td>
                                    <td class="text-right" width="20%"><?php echo $row['jumlahsisa'] ?></td>
                                    <td class="text-right" width="20%">
                                        <input type="number" min="0" name="jumlah[]" class="form-control jumlah text-right" value="<?php echo $row['jumlahsisa'] ?>">
                                    </td>
                                </tr>
                                <?php $no++ ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-left">
                    <div class="btn-group">
                        <a href="{site_url}pemesanan_pembelian" class="btn bg-danger"><?php echo lang('cancel') ?></a>
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
    var base_url = '{site_url}pengiriman_pembelian/';

    $(document).ready(function(){
        ajax_select({ id: '.kontakid', url: base_url + 'select2_kontak', selected: { id: '{kontakid}' } });
        ajax_select({ id: '.gudangid', url: base_url + 'select2_gudang', selected: { id: '{gudangid}' } });
    })

    $('#table_detail tbody').on('change','.jumlah',function(){
        var itemid = null;
        var jumlah = null;
        var row = $(this).closest('tr');
        row.find('input.itemid').each(function() { itemid = this.value });
        row.find('input.jumlah').each(function() { jumlah = this.value });

        $.ajax({
            url: base_url + 'cekjumlahinput',
            dataType: 'json',
            method: 'post',
            data: { 
                itemid: itemid,
                idpemesanan: '{id}'
            },
            success: function(data) {
                jumlah = parseInt(jumlah);
                if(jumlah > data.jumlahsisa) {
                    NotifyError('Kesalahan mengisi jumlah!')
                    row.find('input.jumlah').val( data.jumlahsisa );
                    location.reload()
                }
                if(jumlah < 0) {
                    location.reload()
                }
            }
        })
    })

    function save() {
        var form = $('#form1')[0];
        var formData = new FormData(form);

        var sum = 0;
        $('#table_detail tbody .jumlah').each(function() {
            var value = numeral($(this).val()).value();
            if(!isNaN(value) && value.length != 0) {
                sum += parseFloat(value);
            }
        });
        if(sum <= 0) {
            NotifyError('Silahkan isi jumlah penerimaan!');
            return false;
        }
        
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