<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>{title}</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">{title}</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">         
					<div class="card">
						<div class="card-header">
							<a href="{site_url}item/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
						</div>
						<div class="card-body">
							<form action="javascript:save()" id="form1">
								<div class="m-5">
									<div class="form-group">
										<label>Pilih Akses:</label>
										<select class="form-control permissionid" name="permissionid" required></select>
									</div>
								</div>

								<div class="m-5">
									<div id="content-menu"></div>
								</div>

								<div class="m-5">
									<div class="text-center">
										<button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
</div>

<script type="text/javascript">
	var base_url = '{site_url}user_hak_akses/';
    $(document).ready(function(){
        ajax_select({ id: '.permissionid', url: base_url + 'select2_permissionid', selected: { id: '<?php echo $this->input->get('permissionid') ?>' } });
    });

    $(document).on('change','.permissionid',function(){
        permissionid = $(this).val();
        if(permissionid) {
            $.ajax({
                url: base_url + 'menu/'+permissionid,
                success: function(data) {
                    $('#content-menu').html(data);
                }
            })
        }
    });

    $(document).on('click', '#checkAll', function(){
        $(".menu").prop('checked', $(this).prop('checked'));
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
				if (data.status == 'success') {
					swal("Berhasil!", "Berhasil Menambah Data", "success");
					redirect(base_url);
				} else {
					swal("Gagal!", "Gagal Menambah Data", "error");
				}
			},
			error: function() {
				swal("Gagal!", "Internal Server Error", "error");
			}
		})
    }
</script>