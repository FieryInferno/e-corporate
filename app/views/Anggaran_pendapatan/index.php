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
							<a href="{site_url}anggaran_pendapatan/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-xs table-striped table-borderless table-hover index_datatable">
									<thead>
										<tr class="table-active">
											<th>ID</th>
											<th><?php echo lang('department name') ?></th>
											<th><?php echo lang('perusahaan') ?></th>
											<th><?php echo lang('nominal') ?></th>
											<th class="text-center"><?php echo lang('action') ?></th>
										</tr>
									</thead>
									<tbody></tbody>
									<tfoot>
										<tr class="table-active">
											<th colspan="3"><B><?php echo lang('Total') ?><B></th>	
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
		</div>
  </section>
</div>
<script type="text/javascript">
	let base_url  = '{site_url}anggaran_pendapatan/';
	let table     = $('.index_datatable').DataTable({
		ajax  : {
			url   : base_url + 'index_datatable',
			type  : 'post',
		},
		pageLength  : 100,
		stateSave   : true,
		autoWidth   : false,
		dom         : '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"p>',
		language    : {
			search            : '<span></span> _INPUT_',
			searchPlaceholder : 'Type to filter...',
		},
		columns : [{
				data    : 'id',
				visible : false
			},
			{data : 'dept'},
			{data : 'nama_perusahaan'},
			{
        data      : 'nominal', 
        className : 'text-right', 
        orderable : false,
				render    : function(data, type, row) {
					if(data) return formatRupiah(data)+',00';
					else return formatRupiah(row.nominal)+',00';
				}
			},
			{
				data      : 'id',
				width     : 100,
				orderable : false,
        className : 'text-center', 
				render    : function(data, type, row) {
          let aksi = `
						<div class="list-icons"> 
							<div class="dropdown"> 
								<a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
								<div class="dropdown-menu dropdown-menu-right">
                  <a class="btn btn-danger btn-sm dropdown-item" href="`+base_url+`edit/`+data+`"><i class="fas fa-pencil-alt"></i> Edit</a>
									<a class="btn btn-danger btn-sm dropdown-item" href="javascript:deleteData('`+data+`')"><i class="fas fa-trash"></i> Hapus</a>
									<a class="btn btn-success btn-sm dropdown-item" href="javascript:printData('`+data+`')"><i class="fas fa-print"></i> Cetak</a>
								</div> 
							</div> 
						</div>`;
          return aksi;
				}
			}
		],
		"footerCallback": function ( row, data, start, end, display ) {
			var api = this.api(), data;

			// Remove the formatting to get integer data for summation
			var intVal = function ( i ) {
				return typeof i === 'string' ?
					i.replace(/(Rp.|,00)/g, '')*1 :
					typeof i === 'number' ?
						i : 0;
			};

			// Total over all pages
			total = api
				.column( 3 )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				}, 0 );
				

			// Total over this page
			pageTotal = api
				.column( 3, { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				}, 0 );

			// Update footer
			$( api.column( 3 ).footer() ).html(
				formatRupiah(String(total))+',00'
			);
		}
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