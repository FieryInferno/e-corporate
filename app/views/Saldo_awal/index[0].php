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
		<div class="card-body">
			<div class="ml-3 mr-3 mt-3 mb-3">
				<form action="javascript:save()" id="form1">
					<div class="row">
						<div class="col-md-6">
							<p>Silahkan masukkan tanggal mulai pencatatan menggunakan aplikasi ini</p>
							<div class="form-group">
								<label><?php echo lang('date') ?>:</label>
								<input type="text" class="form-control datepicker" name="tanggal" required value="{tanggal}">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<button type="submit" class="btn-block btn bg-success"><?php echo lang('conversion') ?></button>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-md-6">
							<h6><span class="icon-help"></span> Bagaimana tanggal mulai akan mempengaruhi akun Jurnal Anda?</h6>
							<ul class="list">
								<li>Anda akan dapat memasukkan transaksi sebelum tanggal konversi dan transaksi tersebut tidak akan mempengaruhi saldo sekarang Anda (saldo setelah tanggal konversi) </li>
								<li>Transaksi untuk tanggal sebelum tanggal mulai secara otomatis akan dihapus </li>
							</ul>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script type="text/javascript">
	var base_url = '{site_url}saldo_awal/';
    function save() {
    	var form = $('#form1')[0];
    	var formData = new FormData(form);
    	$.ajax({
    		url: base_url + 'savehead',
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
                    redirect(base_url + '/' + data.redir);
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