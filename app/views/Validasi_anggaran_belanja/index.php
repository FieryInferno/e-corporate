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
						<div class="card-body">
							<table class="table table-bordered table-striped index_datatable">
								<thead>
									<tr>
										<th>ID</th>
										<th><?php echo lang('Dept Name') ?></th>
										<th>Perusahaan</th>
										<th class="text-right"><?php echo lang('Nominal') ?></th>
										<th><?php echo lang('Status') ?></th>
										<th class="text-center"><?php echo lang('action') ?></th>
									</tr>
								</thead>
								<tbody></tbody>
								<tfoot>
									<tr>
										<th colspan="3" class="text-right"><B><?php echo lang('Total') ?><B></th>				
										<th class="text-right"><?= "Rp. " . number_format($total_nominal,2,',','.'); ?></th>
										<th></th>
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
	var base_url = '{site_url}validasi_anggaran_belanja/';
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
				data: 'dept'
			},
			{data: 'nama_perusahaan'},
			{
				data: 'nominal', className: 'text-right', orderable: false,
				render: function(data, type, row) {
					if(data) return formatRupiah(data, 'Rp. ') + ',00';
					else return formatRupiah(row.nominal, 'Rp. ') + ',00';
				}
			}, {
				data: 'status',
				render: function(data) {
					if(data == 'Validate') return '<span class="badge badge-success"><?php echo lang('Validasi') ?></sapan>';
					else return '<span class="badge badge-danger"><?php echo lang('pending') ?></sapan>';
				}
			}, 
			{
				data	: {
					id		: 'id',
					status	: 'status'
				},
				width: 50,
				orderable: false,
				render: function(data, type, row) {
					if (data.status == 'Validate') {
						var tombol_validasi	= `
							<a class="dropdown-item" href="`+base_url+`validasi/1/`+data.id+`"><i class="fas fa-times"></i> Hapus Validasi</a>`;
					} else {
						var tombol_validasi	= `
							<a class="dropdown-item" href="`+base_url+`validasi/0/`+data.id+`"><i class="fas fa-check"></i> Validasi</a>
							<a href="javascript:deleteData('` + data.id + `')" class="dropdown-item delete"><i class="fas fa-trash"></i> <?php echo lang('delete') ?></a>`;
					}
					var aksi = `
						<div class="list-icons"> 
							<div class="dropdown"> 
								<a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
								<div class="dropdown-menu dropdown-menu-right">
									<a href="`+base_url+`printpdf/`+data+`" class="dropdown-item"><i class="fas fa-print"></i> <?php echo lang('print') ?></a>` + tombol_validasi +
								`</div> 
							</div> 
						</div>`;
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