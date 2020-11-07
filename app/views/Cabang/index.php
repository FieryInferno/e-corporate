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
							<a href="{site_url}cabang/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-xs table-striped table-borderless table-hover index_datatable">
									<thead>
										<tr class="table-active">
											<th>ID</th>
											<th>Kode</th>
											<th>Nama</th>
											<th>Alamat</th>
											<th class="text-center">Aksi</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
					</div>
			</div>
			</div>
		</div>
    </section>
</div>
<script type="text/javascript">
	var base_url = '{site_url}cabang/';
	var table = $('.index_datatable').DataTable({
		ajax: {
			url: base_url + 'index_datatable',
			type: 'post',
		},
		stateSave: false,
		autoWidth: false,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"p>',
        language: {
            search: '<span></span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
        },
        order: [[0, 'DESC']],
        columns: [
			{data: 'id', visible: false},
			{
				data: 'kode',
				render: function(data,type,row) {
					return '<label class="btn btn-sm btn-info">'+data+'</label>';
				}
			},
			{data: 'nama'},
			{data: 'alamat'},
			{
				data: 'id', width: 100, orderable: false,
				render: function(data,type,row) {
					var aksi = `
						<div class="list-icons"> 
							<div class="dropdown"> 
								<a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
								<div class="dropdown-menu dropdown-menu-right">
									<a href="`+base_url+`edit/`+data+`" class="dropdown-item"><i class="icon-pencil"></i> <?php echo lang('edit') ?></a>
									<a href="javascript:deleteData(`+data+`)" class="dropdown-item delete"><i class="icon-trash"></i> <?php echo lang('delete') ?></a>
								</div> 
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