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
                	<div class="col-md-2">
                    <div class="form-group">
        					<label><?php echo lang('Tipe') ?>:</label>
        					<input type="number" class="form-control"onkeyup="sum();" name="tipe"id="tipe">
        				</div>
                        <!-- <div class="form-group">
                            <label><?php echo lang('account_header') ?>:</label>
                            <select class="form-control noakunheader" name="noakunheader" required></select>
                        </div> -->
                    </div>
                	<div class="col-md-2">
                    <div class="form-group">
        					<label><?php echo lang('Kelompok') ?>:</label>
        					<input type="number" class="form-control"onkeyup="sum();" name="noakunheader"id="noakunheader">
        				</div>                      
                    </div>
                    <div class="col-md-2">
                    <div class="form-group">
        					<label><?php echo lang('Jenis') ?>:</label>
        					<input type="number" class="form-control"onkeyup="sum();" name="jenis" id="jenis">
        				</div>                    
                    </div>
                </div>
                <div class="row">                	
                	<div class="col-md-3">
                    <div class="form-group">
        					<label><?php echo lang('Objek') ?>:</label>
        					<input type="number" class="form-control"onkeyup="sum();" name="objek" id="objek" >
        				</div>                      
                    </div>
                	<div class="col-md-3">
                    <div class="form-group">
        					<label><?php echo lang('Rincian') ?>:</label>
        					<input type="number" class="form-control"onkeyup="sum();" name="rincian" id="rincian" >
        				</div>                      
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
        				<div class="form-group">
        					<label><?php echo lang('name') ?>:</label>
        					<input type="hidden" readonly class="form-control" name="akunno" onkeyup="sum();" id="akunno" >
        					<input type="text" class="form-control" name="namaakun" required>
        				</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('payment_status') ?>:</label>
                            <select class="form-control stbayar" name="stbayar" required></select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('header_status') ?>:</label>
                            <select class="form-control stheader" name="stheader" required></select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('default_balance') ?>:</label>
                            <select class="form-control stdebet" name="stdebet" required></select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('Kategori Akun') ?>:</label>
                            <select class="form-control kategoriakun" name="kategoriakun" required>
                            <option value="Cash/Bank">Cash/Bank</option>
                            <option value="Other Asset">Other Asset</option>
                            <option value="Account Receivable">Account Receivable</option>
                            <option value="Revenue">Revenue</option>
                            </select>
                        </div>
                    </div>
                </div>
				<div class="text-left">
					<a href="{site_url}noakun" class="btn bg-danger"><?php echo lang('cancel') ?></a>
					<button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
				</div>
			</form>
    	</div>
    </div>
</div>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script type="text/javascript">
	var base_url = '{site_url}noakun/';
    $(document).ready(function(){
        ajax_select({ id: '.noakunheader', url: base_url + 'select2_noakunheader', selected: { id: '' } });
        $('.stbayar').select2({
            placeholder: 'Select an Option',
            data: [
                {id: '1', text: 'YA'},
                {id: '0', text: 'TIDAK'},
            ]
        }).val('1').trigger('change');
        $('.stheader').select2({
            placeholder: 'Select an Option',
            data: [
                {id: '1', text: 'YA'},
                {id: '0', text: 'TIDAK'},
            ]
        }).val('0').trigger('change');
        $('.stdebet').select2({
            placeholder: 'Select an Option',
            data: [
                {id: '1', text: 'DEBET'},
                {id: '0', text: 'KREDIT'},
            ]
        }).val('').trigger('change');
    })

    $(document).on('change','.stbayar', function() {
        if($(this).val() == '1') {
            $('.stdebet').attr('disabled',false);
        } else {
            $('.stdebet').attr('disabled',true);
        }
    })

    function sum() {
              var txtFirstNumberValue = document.getElementById('tipe').value;
              var txtSecondNumberValue = document.getElementById('noakunheader').value;
              var txtTNumberValue = document.getElementById('jenis').value;
              var txtFNumberValue = document.getElementById('objek').value;
              var txtVNumberValue = document.getElementById('rincian').value;
              var result=txtFirstNumberValue+txtSecondNumberValue+txtTNumberValue+txtFNumberValue+txtVNumberValue;
            //   var result = parseInt(txtFirstNumberValue)+parseInt(txtSecondNumberValue)+
            //   parseInt(txtTNumberValue)+parseInt(txtFNumberValue)+parseInt(txtVNumberValue);
                 document.getElementById('akunno').value = result;
            //   if (!isNaN(result)) {
            //   }
            //   else{
            //     //  document.getElementById('noakun').value = txtFirstNumberValue;
            //   }
        }
        // function isNumberKey(evt)
        // {
        // var charCode = (evt.which) ? evt.which : event.keyCode
        // if (charCode > 31 && (charCode < 48 || charCode > 57))

        // return false;
        // return true;
        // }


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