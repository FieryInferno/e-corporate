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
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Satuan</th>
                                        <th>Kategori</th>
                                        <th>Masuk</th>
                                        <th>Keluar</th>
                                        <th>Stok</th>
                                        <th>Hrg Beli Terakhir</th>
                                        <th>Total Persediaan</th>
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
	var base_url = '{site_url}Persediaan/';
	var table = $('.index_datatable').DataTable({
		ajax: {
			url     : base_url + 'index_datatable',
			type    : 'post',
		},
		stateSave: true,
		autoWidth: false,
		dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"p>',
		language: {
			search: '<span></span> _INPUT_',
			searchPlaceholder: 'Type to filter...',
		},
		columns: [
			{
				data: 'kode',
				render: function(data, type, row) {
					return `<button class="btn btn-sm btn-info">${data}</button>`;
				}
			},
			{data: 'nama'},
			{data: 'satuan'},
			{data: 'kategori'},
			{
				render: function(data, type, row) {
					return 0;
				}
			}, 
			{
				render: function(data, type, row) {
					return 0;
				}
			}, 
			{data	: 'quantity'},
			{data	: 'hargabeliterakhir'},
			{
				data: 'nilaiTotal',
				render: function(data, type, row) {
					return formatRupiah(data, 'Rp. ')+',00';
				}
			}
		]
	});
</script>