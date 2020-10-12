<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header bg-indigo">
				<div class="row">
					<div class="col-md-10 offset-md-1">
						<div class="header-elements-inline">
							<h5 class="card-title">{subtitle}</h5>
	                	</div>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-10 offset-md-1">
						<form action="javascript:save()" id="form1">
							<div class="form-group">
								<label><?php echo lang('name') ?>:</label>
								<input type="text" class="form-control" name="name" required>
							</div>
							<div class="text-right">
								<a href="{site_url}mcategories" class="btn bg-pink"><?php echo lang('cancel') ?></a>
								<button type="submit" class="btn bg-indigo"><?php echo lang('save') ?> <i class="icon-paperplane ml-2"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script type="text/javascript">
	var base_url = '{site_url}mcategories/';
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
    		success: function(data) {
    			if(data.status == 'success') {
    				NotifySuccess(data.message)
    				redirect(base_url)
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