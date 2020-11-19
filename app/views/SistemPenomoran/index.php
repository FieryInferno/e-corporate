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
						<li class="breadcrumb-item"><a href="#">{title}</a></li>
						<li class="breadcrumb-item active">{subtitle}</li>
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
							<form action="{site_url}SistemPenomoran" id="form1" method="GET">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label>Formulir : </label>
											<input type="text" class="form-control" name="formulir" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="text-right">
											<button type="submit" class="btn-block btn bg-success"><i class="fas fa-filter"></i> Filter</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">         
					<div class="card">
						<div class="card-header">
							<a href="{site_url}SistemPenomoran/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-xs table-striped table-borderless table-hover index_datatable" onload="return data()">
									<thead>
										<tr class="table-active">
											<th>Formulir</th>
											<th>Format Penomoran</th>
											<th><?php echo lang('Aksi') ?></th>
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
	var base_url    = '{site_url}SistemPenomoran/';
	var table       = $('.index_datatable').DataTable({
		ajax	: {
			url		: base_url + 'indexDatatable',
			type	: 'post',
			data	: {
				formulir	: '{formulir}'
			}
		},
		columns	: [
			{data	: 'formulir'},
			{data	: 'formatPenomoran'},
			{
				data	: 'idPenomoran',
				render	: function (data, type, row) {
					var aksi = `
						<div class="list-icons"> 
							<div class="dropdown"> 
								<a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
								<div class="dropdown-menu dropdown-menu-right">
									<form action="edit" method="post">
										<input type="hidden" value="${data}" name="idPenomoran">
										<button class="dropdown-item" type="submit"><i class="fas fa-pencil-alt"></i> Edit</button>
									</form>
									<a class="btn btn-danger btn-sm dropdown-item" href="javascript:deleteData('`+data+`')"><i class="fas fa-trash"></i> Hapus</a>
								</div> 
							</div> 
						</div>`;
					return aksi;
				}}
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
					url: base_url + 'delete/' + id,
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
