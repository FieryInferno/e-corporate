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
						<label><?php echo lang('name') ?>:</label>
						<input type="text" class="form-control" name="nama">
					</div>

					<div class="form-group" hidden>
						<textarea class="form-control" name="modul" id="modul" required></textarea>
					</div>

					<div class="text-right">
						<a href="{site_url}Hakakses" class="btn bg-pink js-link back">Cancel</a>
						<button type="submit" class="btn bg-indigo">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header bg-indigo">
				<div class="row">
					<div class="col-md-10 offset-md-1">
						<div class="header-elements-inline">
							<h5 class="card-title"><?php echo lang('permission_access') ?></h5>
	                	</div>
					</div>
				</div>
			</div>			
			<div class="card-body">
				<div class="row">
					<?php if ($modul): ?>
						<?php foreach ($modul as $row): ?>
							<div class="col-md-6">
								<div class="form-check mb-3">
									<label class="form-check-label">
										<div class="uniform-checker">
											<input name="idmodul" type="checkbox" value="<?php echo $row['id'] ?>" class="form-check-input-styled">
										</div>
										<?php echo $row['nama'] ?>
									</label>
								</div>
							</div>
						<?php endforeach ?>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="{assets_path}global/js/plugins/forms/styling/uniform.min.js"></script>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script type="text/javascript">

	var base_url = '{site_url}Hakakses/';

	$(document).ready(function(){
		$('.form-check-input-styled').uniform();
		checkboxArr();
	})

	$(document).on('click','input[name=idmodul]',function(){
		checkboxArr();
	})

    function save() {
    	var form = $('#form1')[0];
    	var formData = new FormData(form);
    	
    	$.ajax({
    		url: base_url + 'save/',
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
    		}
    	})
    }

    function checkboxArr() {
    	var checkboxArr = $("input:checkbox:checked").map(function(){
    		return $(this).val();
    	}).get();
    	return $('#modul').val( checkboxArr )
    }
</script>