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
                	<div class="col-md-3">
        				<div class="form-group">
        					<label><?php echo lang('code') ?>:</label>
        					<input type="text" class="form-control" name="kode" placeholder="AUTO" pattern="[a-zA-Z0-9-#]+" maxlength="10">
        				</div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('name') ?>:</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('unit') ?>:</label>
                            <select class="form-control satuanid" name="satuanid" required></select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('category') ?>:</label>
                            <select class="form-control kategoriid" name="kategoriid" required></select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('purchase_price') ?>:</label>
                            <input type="text" class="form-control hargabeli" name="hargabeli" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('purchase_account') ?>:</label>
                            <select class="form-control noakunbeli" name="noakunbeli"></select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('sales_price') ?>:</label>
                            <input type="text" class="form-control hargajual" name="hargajual" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('sales_account') ?>:</label>
                            <select class="form-control noakunjual" name="noakunjual"></select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('inventory_account') ?>:</label>
                            <select class="form-control noakunpersediaan" name="noakunpersediaan"></select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('Image') ?>:</label>
                            <input type="file" class="form-control h-auto" name="gambar">
                        </div>
                    </div>
                </div>
				<div class="text-right">
					<a href="{site_url}item" class="btn bg-danger"><?php echo lang('cancel') ?></a>
					<button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
				</div>
			</form>
    	</div>
    </div>
</div>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script type="text/javascript">
	var base_url = '{site_url}item/';

    $(document).ready(function(){
        $('.hargajual').val( numeral( $('.hargajual').val() ).format() );
        $('.hargabeli').val( numeral( $('.hargabeli').val() ).format() );

        ajax_select({ id: '.satuanid', url: base_url + 'select2_satuanid', selected: { id: '' } });
        ajax_select({ id: '.kategoriid', url: base_url + 'select2_kategoriid', selected: { id: '' } });
        ajax_select({ id: '.noakunbeli', url: base_url + 'select2_noakunbeli', selected: { id: '' } });
        ajax_select({ id: '.noakunjual', url: base_url + 'select2_noakunjual', selected: { id: '' } });
        ajax_select({ id: '.noakunpersediaan', url: base_url + 'select2_noakunpersediaan', selected: { id: '' } });
    })

    $(document).on('keyup','.hargajual, .hargabeli',function(){
        var val = $(this).val();
        $(this).val( numeral(val).format() );
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