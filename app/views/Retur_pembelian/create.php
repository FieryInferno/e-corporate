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
                    <div class="mt-3 mb-3">
                        <button type="button" class="btn btn-sm btn-primary btn_add_detail"><?php echo lang('add_new') ?></button>
                    </div>
                    <table class="table table-bordered" id="table_detail">
                        <thead class="{bg_header}">
                            <tr>
                                <th>ID</th>
                                <th><?php echo lang('item') ?></th>
                                <th class="text-right"><?php echo lang('qty_return') ?></th>
                                <th class="text-left"><?php echo lang('return_reason') ?></th>
                                <th class="text-right"><?php echo lang('action') ?></th>
                            </tr>
                        </thead>
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
<div id="modal_add_detail" class="modal fade">
    <div class="modal-dialog">
        <form action="javascript:save_detail()" id="form2">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title"><?php echo lang('add_new') ?></h5>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="rowindex">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo lang('item') ?>:</label>
                                <select class="form-control itemid" name="itemid" required style="width:100%"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('price') ?>:</label>
                                <input type="text" class="form-control decimalnumber" name="harga" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('qty_residual') ?>:</label>
                                <input type="text" class="form-control decimalnumber" name="jumlahsisa" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('discount') ?>:</label>
                                <input type="text" class="form-control decimalnumber" name="diskon" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('ppn') ?>:</label>
                                <input type="text" class="form-control decimalnumber" name="ppn" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('qty_return') ?>:</label>
                                <input type="text" class="form-control decimalnumber" name="jumlahretur" min="1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo lang('return_reason') ?>:</label>
                                <textarea class="form-control alasan" name="alasan" rows="6"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo lang('cancel') ?></button>
                        <button type="submit" class="btn btn-success"><?php echo lang('save') ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script src="{assets_path}global/js/plugins/tables/datatables/datatables.min.js"></script>
<script src="{assets_path}global/js/plugins/pickers/pickadate/picker.js"></script>
<script src="{assets_path}global/js/plugins/pickers/pickadate/picker.date.js"></script>
<script type="text/javascript">
    var base_url = '{site_url}retur_pembelian/';
    $.fn.dataTable.Api.register( 'hasValue()' , function(value) {
        return this .data() .toArray() .toString() .toLowerCase() .split(',') .indexOf(value.toString().toLowerCase())>-1
    })
    var table_detail = $('#table_detail').DataTable({
        sort: false,
        info: false,
        autoWidth: false,
        searching: false,
        paging: false,
        columnDefs: [
            {targets: [0], visible: false},
            {targets: [2,4], className: 'text-right'}
        ]
    })

    $('#table_detail tbody').on('click','.delete_detail',function(){
        table_detail.row($(this).parents('tr')).remove().draw();
        detail_array();
    })

    $('#table_detail tbody').on('click','.edit_detail',function(){
        var tr = table_detail.row($(this).parents('tr')).index();
        var itemid = table_detail.cell(tr,0).data();
        var jumlahretur = table_detail.cell(tr,2).data();
        var alasan = table_detail.cell(tr,3).data();


        $('input[name=rowindex]').val(tr);
        $('.itemid').val(itemid).trigger('change');
        $('input[name=jumlahretur]').val(jumlahretur);
        $('textarea[name=alasan]').val(alasan);
        $('#modal_add_detail').modal('show');
    })

    $(document).on('click','.btn_add_detail',function(){
        $('#modal_add_detail').modal('show')
        $('input[name=rowindex]').val(null);
        $('input[name=jumlahretur]').val(0);
        $('textarea[name=alasan]').val(null);

        ajax_select({ 
            id: '.itemid', 
            url: base_url + 'select2_item', 
            selected: { id: '' }, 
            data: { idfaktur: '{id}' } 
        });
        $('.itemid').val('').trigger('change');
    })
    
    $(document).on('change','input[name=jumlahretur]',function(){
        var jumlahretur = numeral( $(this).val() ).value();
        var jumlahsisa = numeral( $('input[name=jumlahsisa]').val() ).value();
        if(jumlahretur > jumlahsisa) {
            NotifyError('Jumlah retur tidak boleh lebih besar dari jumlah sisa');
            $(this).val(0);
            return false;
        }
    })

    $(document).on('change','.itemid',function(){
        var rowindex = $('input[name=rowindex]').val();
        var itemid = $(this).val();
        if(!rowindex) {
            if(itemid) {
                $.ajax({
                    url: base_url + 'get_detail_item_faktur',
                    method: 'post',
                    datatype: 'json',
                    data: {
                        itemid: itemid,
                        idfaktur: '{id}',
                    },
                    success: function(data) {
                        $('input[name=harga]').val( numeral(data.harga).format() );
                        $('input[name=jumlahsisa]').val(data.jumlahsisa);
                        $('input[name=diskon]').val(data.diskon);
                        $('input[name=ppn]').val(data.ppn);
                    }
                })
            }
        }
    })

    $(document).ready(function(){
        ajax_select({ id: '.kontakid', url: base_url + 'select2_kontak', selected: { id: '{kontakid}' } });
        ajax_select({ id: '.gudangid', url: base_url + 'select2_gudang', selected: { id: '{gudangid}' } });
    })

    function save_detail() {
        var form = $('#form2')[0];
        var formData = new FormData(form);
        if(formData.get('jumlahretur') < 1) {
            NotifyError('Jumlah retur harus lebih dari 0');
            return false;
        }
        var item = $('.itemid :selected').text();
        var rowindex = formData.get('rowindex');
        if(!rowindex) {
            if(table_detail.hasValue(item)) {
                NotifyError('Item already exists!');
                return false;
            }        
        }

        var alasan = formData.get('alasan');
        if(!rowindex) {
            table_detail.row.add([
                formData.get('itemid'),
                item,
                formData.get('jumlahretur'),
                alasan,
                `<a href="javascript:void(0)" class="edit_detail"><i class="icon icon-pencil"></i></a>&nbsp;
                <a href="javascript:void(0)" class="delete_detail"><i class="icon icon-trash"></i></a>`
            ]).draw( false );
        } else {
            table_detail.row(rowindex).data([
                formData.get('itemid'),
                item,
                formData.get('jumlahretur'),
                alasan,
                `<a href="javascript:void(0)" class="edit_detail"><i class="icon icon-pencil"></i></a>&nbsp;
                <a href="javascript:void(0)" class="delete_detail"><i class="icon icon-trash"></i></a>`
            ]).draw( false );
        }



        $('#modal_add_detail').modal('hide')
        detail_array()
    }

    function detail_array() {
        var arr = table_detail.data().toArray();
        $('#detail_array').val( JSON.stringify(arr) );
    }

    function save() {
        var form = $('#form1')[0];
        var formData = new FormData(form);

        detail = formData.get('detail_array');
        if(detail.length < 10) {
            NotifyError('Silahkan isi detail terlebih dulu!');
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