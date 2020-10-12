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
                <div class="row">
                    <div class="col-md-6">
        				<div class="form-group">
        					<label><?php echo lang('date') ?>:</label>
        					<input type="text" class="form-control" name="tanggal" required value="{tanggal}">
        				</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('note') ?>:</label>
                            <textarea class="form-control keterangan" name="keterangan" rows="6"></textarea>
                        </div>
                    </div>                        
                </div>

                <div class="mb-3 mt-3 table-responsive">
                    <div class="mt-3 mb-3">
                        <button type="button" class="btn btn-sm btn-primary btn_add_detail"><?php echo lang('add_new') ?></button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table_detail">
                            <thead class="{bg_header}">
                                <tr>
                                    <th>ID</th>
                                    <th><?php echo lang('account_number') ?></th>
                                    <th class="text-right"><?php echo lang('debet') ?></th>
                                    <th class="text-right"><?php echo lang('kredit') ?></th>
                                    <th class="text-right"><?php echo lang('action') ?></th>
                                </tr>
                            </thead>
                            <tbody> </tbody>
                            <tfoot class="bg-light">
                                <tr>
                                    <th>ID</th>
                                    <th><?php echo lang('total') ?></th>
                                    <th class="text-right totaldebet">0</th>
                                    <th class="text-right totalkredit">0</th>
                                    <th class="text-center">&nbsp;</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <input type="hidden" name="detail_array" id="detail_array">
				<div class="text-right">
					<a href="{site_url}jurnal" class="btn bg-danger"><?php echo lang('cancel') ?></a>
					<button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
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
                                <label><?php echo lang('account_number') ?>:</label>
                                <select class="form-control noakun" name="noakun" required style="width:100%"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('debet') ?>:</label>
                                <input type="text" class="form-control decimalnumber" name="debet" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('kredit') ?>:</label>
                                <input type="text" class="form-control decimalnumber" name="kredit" required>
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
	var base_url = '{site_url}jurnal/';
    $.fn.dataTable.Api.register( 'hasValue()' , function(value) {
        return this .data() .toArray() .toString() .toLowerCase() .split(',') .indexOf(value.toString().toLowerCase())>-1
    })    

    var table_detail = $('#table_detail').DataTable({
        sort: false,
        info: false,
        searching: false,
        paging: false,
        autoWidth: false,
        columnDefs: [
            {targets: [0], visible: false},
            {targets: [2,3,4], className: 'text-right'}
        ],
        footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            totaldebet = api.column( 2 ).data().reduce( function (a, b) {
                return intVal(a) + intVal(b); 
            }, 0 );
            $( api.column( 2 ).footer() ).html( numeral(totaldebet).format() );

            totalkredit = api.column( 3 ).data().reduce( function (a, b) {
                return intVal(a) + intVal(b); 
            }, 0 );
            $( api.column( 3 ).footer() ).html( numeral(totalkredit).format() );

            $('.totaldebet').val( numeral(totaldebet).format() )
            $('.totalkredit').val( numeral(totalkredit).format() )
        }
    })

    $(document).on('click','.btn_add_detail',function(){
        $('#modal_add_detail').modal('show')
        $('input[name=rowindex]').val('');
        $('input[name=debet]').val(0);
        $('input[name=kredit]').val(0);
        ajax_select({ id: '.noakun', url: base_url + 'select2_noakun', selected: { id: '' } });
        $('.noakun').val('').trigger('change');
    })

    $('#table_detail tbody').on('click','.edit_detail',function(){
        var tr = table_detail.row($(this).parents('tr')).index();
        var noakun = table_detail.cell(tr,0).data();
        var debet = table_detail.cell(tr,2).data();
        var kredit = table_detail.cell(tr,3).data();

        $('input[name=rowindex]').val(tr);
        $('.noakun').val(noakun).trigger('change');
        $('input[name=debet]').val(debet);
        $('input[name=kredit]').val(kredit);
        $('#modal_add_detail').modal('show');
    })

    $('#table_detail tbody').on('click','.delete_detail',function(){
        table_detail.row($(this).parents('tr')).remove().draw();
        detail_array();
    })

    function save_detail() {
        var form = $('#form2')[0];
        var formData = new FormData(form);

        var noakun = $('.noakun :selected').text();
        var rowindex = formData.get('rowindex');
        if(!rowindex) {
            if(table_detail.hasValue(noakun)) {
                NotifyError('Noakun already exists!');
                return false;
            }
        }
        var debet = numeral(formData.get('debet')).value();
        var kredit = numeral(formData.get('kredit')).value();

        if(debet == kredit) {
            NotifyError('Debet dan kredit tidak boleh sama!');
            return false;
        }

        if(!rowindex) {
            table_detail.row.add([
                formData.get('noakun'),
                noakun,
                numeral(formData.get('debet')).format(),
                numeral(formData.get('kredit')).format(),
                `<a href="javascript:void(0)" class="edit_detail"><i class="icon icon-pencil"></i></a>&nbsp;
                <a href="javascript:void(0)" class="delete_detail"><i class="icon icon-trash"></i></a>`
            ]).draw( false );
        } else {
            table_detail.row(rowindex).data([
                formData.get('noakun'),
                noakun,
                numeral(formData.get('debet')).format(),
                numeral(formData.get('kredit')).format(),
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
        if(numeral($('.totaldebet').text()).value() != numeral($('.totalkredit').text()).value()) {
            NotifyError('Debet dan kredit harus sama!');
            return false;
        }


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