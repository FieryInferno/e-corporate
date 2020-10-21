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
			  <?php if($this->session->userdata( "userid" )=="1") { ?>
				<a href="{site_url}anggaran_pendapatan/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
  			<?php } ?></div>
              <div class="card-body">
                <table class="table table-bordered table-striped index_datatable">
                  <thead>
				  <tr>
					<th>ID</th>
					<th><?php echo lang('department name') ?></th>
					<th><?php echo lang('perusahaan') ?></th>
					<th><?php echo lang('nominal') ?></th>
					<th class="text-center"><?php echo lang('action') ?></th>
				</tr>
                  </thead>
                  <tbody>                          
                  </tbody>
				  <tfoot>
			<tr>
					<th></th>
					<th></th>
						<th><B><?php echo lang('Total') ?><B></th>				
					
					<th><?= "Rp " . number_format($total_nominal,2,',','.') ?></th>
					<th></th>
			</tr>
			</tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
<script type="text/javascript">
	var base_url = '{site_url}anggaran_pendapatan/';
	var table = $('.index_datatable').DataTable({
		ajax: {
			url: base_url + 'index_datatable',
			type: 'post',
		},
		pageLength: 100,
		stateSave: true,
		autoWidth: false,
		dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"p>',
		language: {
			search: '<span></span> _INPUT_',
			searchPlaceholder: 'Type to filter...',
		},
		columns: [{
				data: 'id',
				visible: false
			},
			{
				data: 'dept',
			},
			{
				data: 'nama_perusahaan'
			},
				{
					data: 'nominal', className: 'text-right', orderable: false,
				render: function(data, type, row) {
					if(data) return formatRupiah(data, 'Rp.')+',00';
					else return formatRupiah(row.nominal, 'Rp.')+',00';
				}
			},
			{
				data: 'id',
				width: 100,
				orderable: false,
				render: function(data, type, row) {
					var aksi = `
						<a class="btn btn-info btn-sm" href="`+base_url+`edit/`+data+`">
							<i class="fas fa-pencil-alt"></i>                             
						</a>
						<a class="btn btn-danger btn-sm" href="javascript:deleteData(`+data+`)">
							<i class="fas fa-trash"></i>                           
						</a>               
						`;
					return aksi;
				}
			}
		]
	});

	function deleteData(id) {
		swal("Anda yakin akan menghapus data?", {
		buttons: {
			cancel: "Batal",
			catch: {
			text: "Ya, Yakin",
			value: "ya",
			},
		},
		})
		.then((value) => {
			switch (value) {
				case "ya":
				$.ajax({
					url: base_url + 'delete/'+id,
					beforeSend: function() {
						pageBlock();
					},
					afterSend: function() {
						unpageBlock();
					},
					success: function(data) {
						if(data.status == 'success') {
							swal("Berhasil!", "Data Berhasil Dihapus!", "success");
							setTimeout(function() { table.ajax.reload() }, 100);
						} else {
							swal("Gagal!", "Pikachu was caught!", "error");
						}
					},
					error: function() {
						swal("Gagal!", "Internal Server Error!", "error");
					}
				})
				break;
			}
		});
	}
</script>