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
							<table class="table table-bordered table-striped index_datatable">
								<thead>
									<tr>
										<th>ID</th>
										<th><?php echo lang('code') ?></th>
										<th><?php echo lang('name') ?></th>
										<th><?php echo lang('unit') ?></th>
										<th><?php echo lang('category') ?></th>
										<!-- <th><?php echo lang('stock') ?></th> -->
										<th><?php echo lang('Hrg Beli Terakhir') ?></th>
										<!-- <th><?php echo lang('Total Persediaan') ?></th> -->
										<th class="text-center"><?php echo lang('action') ?></th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
  </div>

  <script type="text/javascript">
	var base_url = '{site_url}item/';
	var table = $('.index_datatable').DataTable({
		ajax: {
			url: base_url + 'index_datatable',
			type: 'post',
		},
		paging:true,
		stateSave: true,
		autoWidth: false,
		responsive: true,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"p>',
        language: {
            search: '<span></span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
        },
        columns: [
			{data: 'id', visible: false},
			{
				data: 'kode',
				render: function(data,type,row) {
					var link = base_url + 'detail/' + row.id;
					return '<span class="btn btn-sm btn-info">'+data+'</span>';
				}
			},
			{data: 'nama'},
			{data: 'satuan'},
			{data: 'kategori'},
			// {data: 'stok', className: 'text-right', orderable: false},
			{
				data: 'hargabeliterakhir', className: 'text-right', orderable: false,
				render: function(data, type, row) {
					if(data > 0) return formatRupiah(data) + ',00';
					else return formatRupiah(String(row.hargabeliterakhir)) + ',00';
				}
			},
			// {
			// 	data: 'totalpersediaan', className: 'text-right', orderable: false,
			// 	render: function(data, type, row) {
			// 		if(data) return formatRupiah(data) + ',00';
			// 		else return formatRupiah(row.hargabeli) + ',00';
			// 	}
			// },
			{
				data: 'id', width: 100, orderable: false, className: 'text-center',
				render: function(data,type,row) {
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