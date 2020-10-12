<div class="card">
	<div class="card-header header-elements-inline bg-indigo">
		<h5 class="card-title">{subtitle}</h5>
	</div>
	<div class="card-body">
		<ul class="nav nav-tabs nav-tabs-bottom border-bottom-0">
			<li class="nav-item">
				<a href="#bottom-divided-tab1" class="nav-link active show" data-toggle="tab">
					<?php echo lang('general') ?> 
				</a>
			</li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane fade active show" id="bottom-divided-tab1">
				<div class="row">
					<div class="col-md-6">
						<form action="javascript:save()" id="form1">
							<div class="form-group">
								<label><?php echo lang('app_name') ?>:</label>
								<input type="text" class="form-control" name="app_name" required value="<?php echo get_setting('app_name') ?>">
							</div>
							<div class="form-group">
								<label><?php echo lang('language') ?>:</label>
								<select class="form-control language" name="language"></select>
							</div>
							<div class="form-group">
								<label><?php echo lang('logo') ?>:</label>
								<input type="file" name="logo">
							</div>
							<div class="form-group">
								<label><?php echo lang('logo_login') ?>:</label>
								<input type="file" name="logo_login">
							</div>
							<div class="text-left">
								<button type="submit" class="btn bg-indigo">
									Submit <i class="icon-paperplane ml-2"></i>
								</button>
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

	var base_url = '{site_url}Pengaturan/';

    $(document).ready(function(){

        $('.language').select2({
            placeholder: 'Select an Option',
            data: [
                {id: 'english', text: 'English'},
                {id: 'indonesian', text: 'Indonesian'},
            ]
        }).val('<?php echo get_setting('language') ?>').trigger('change');
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
    		success: function(data) {
    			if(data.status == 'success') {
    				NotifySuccess(data.message)
    				setTimeout(function() { location.reload() }, 1000);
    			} else {
    				NotifyError(data.message)
    			}
    		}
    	})
    }
</script>