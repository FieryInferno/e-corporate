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
                            <input type="text" class="form-control tanggal datepicker" name="tanggal" required value="{tanggal}">
                        </div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('item') ?>:</label>
                            <select class="form-control itemid" name="itemid" required></select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('warehouse') ?>:</label>
                            <select class="form-control gudangid" name="gudangid" required></select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('category') ?>:</label>
                            <select class="form-control kategori" name="kategori" required></select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('Akun_Penyesuaian') ?>:</label>
                            <input type="text" class="form-control noakunpenyesuaian_text" name="noakunpenyesuaian_text" disabled>
                            <input type="hidden" class="form-control noakunpenyesuaian" name="noakunpenyesuaian" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label><?php echo lang('Jumlah_Sistem') ?>:</label>
                            <input type="text" class="form-control jumlahsistem" name="jumlahsistem" required readonly value="0">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label><?php echo lang('Jumlah_Sebenarnya') ?>:</label>
                            <input type="text" class="form-control jumlahsebenarnya" name="jumlahsebenarnya" required value="0">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label><?php echo lang('Penyesuaian') ?>:</label>
                            <input type="text" class="form-control selisih" name="selisih" required readonly value="0">
                        </div>
                    </div>
                </div>
				<div class="text-left mt-3">
					<a href="{site_url}stokopname" class="btn bg-danger"><?php echo lang('cancel') ?></a>
					<button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
				</div>
			</form>
    	</div>
    </div>
</div>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script type="text/javascript">
	var base_url = '{site_url}stokopname/';
    $(document).ready(function(){
    	ajax_select({ id: '.itemid', url: base_url + 'select2_item', selected: { id: '' } });
        ajax_select({ id: '.gudangid', url: base_url + 'select2_gudang', selected: { id: '' } });
        $('.kategori').select2({
            placeholder: 'Select an Option',
            data: [
                {id: '1', text: 'UMUM'},
                {id: '2', text: 'RUSAK'},
                {id: '3', text: 'STOK AWAL'},
            ]
        }).val('').trigger('change');
    })

    $(document).on('change','.kategori',function(){
        kategori = $(this).val();
        if(kategori) {
            $.ajax({
                url: base_url + 'noakunpenyesuaian/'+kategori,
                method: 'post',
                dataType: 'json',
                data: {
                    itemid: $('.itemid').val()
                },
                success: function(data) {
                    if(data.status == 'success') {
                        namaakun = data.res.noakun + ' - ' + data.res.namaakun;
                        $('.noakunpenyesuaian_text').val(namaakun);
                        $('.noakunpenyesuaian').val(data.res.noakun);
                    } else {
                        $('.kategori').val('').trigger('change');
                        NotifyError(data.message);
                    }
                }
            })
        }
    })
    $(document).on('change','.itemid, .gudangid',function(){
        $('.jumlahsistem').val(0);
        
        itemid = $('.itemid').val();
        gudangid = $('.gudangid').val();

        $.ajax({
            url: base_url + 'getstoksistem/',
            method: 'post',
            dataType: 'json',
            data: {
                itemid: itemid, gudangid: gudangid,
            },
            success: function(data) {
                jumlahsistem = $('.jumlahsistem');
                jumlahsebenarnya = $('.jumlahsebenarnya');
                selisih = $('.selisih');

                if(data.stok == null) {
                    jumlahsistem.val(0);
                } else {
                    jumlahsistem.val(data.stok);
                    selisih.val( parseInt(jumlahsebenarnya.val())-parseInt(jumlahsistem.val()) )
                }
            }
        })
    })
    $(document).on('keyup','.jumlahsebenarnya',function(){
        jumlahsistem = $('.jumlahsistem');
        jumlahsebenarnya = $('.jumlahsebenarnya');
        selisih = $('.selisih');
        penyesuaian = parseInt(jumlahsebenarnya.val())-parseInt(jumlahsistem.val());
        if(isNaN(penyesuaian)) selisih.val(0);
        else selisih.val( penyesuaian );
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