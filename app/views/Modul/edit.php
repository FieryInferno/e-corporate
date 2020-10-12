<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header bg-indigo">
				<div class="header-elements-inline">
					<h5 class="card-title">{subtitle}</h5>
            	</div>
			</div>

			<div class="card-body">
				<form action="javascript:save()" id="form1">
					<div class="form-group">
						<label><?php echo lang('name') ?> EN:</label>
						<input type="text" class="form-control" name="name" placeholder="Nama" required value="{name}">
					</div>
					<div class="form-group">
						<label><?php echo lang('name') ?> ID:</label>
						<input type="text" class="form-control" name="nama" placeholder="Name" required value="{nama}">
					</div>
					<div class="form-group">
						<label>URL:</label>
						<input type="text" class="form-control" name="url" placeholder="URL" required value="{url}">
					</div>
					<div class="form-group">
						<label><?php echo lang('position') ?>:</label>
						<input type="text" class="form-control" name="posisi" placeholder="Posisi" value="{posisi}">
					</div>

					<div class="text-right">
						<a href="{site_url}Modul" class="btn bg-pink js-link back">Cancel</a>
						<button type="submit" class="btn bg-indigo">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script type="text/javascript">

	var base_url = '{site_url}Modul/';

    function save() {
    	var form = $('#form1')[0];
    	var formData = new FormData(form);
    	
    	$.ajax({
    		url: base_url + 'save/{id}',
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
    				$('.back').click()
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