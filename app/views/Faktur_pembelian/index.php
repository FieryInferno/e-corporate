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
							<a href="{site_url}faktur_pembelian/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
						</div>
						<div class="card-body">
							<table class="table table-bordered table-striped index_datatable">
								<thead>
									<tr>
										<th>ID</th>
										<th><?php echo lang('notrans') ?></th>
										<th>Perusahaan</th>
										<th><?php echo lang('date') ?></th>
										<th><?php echo lang('supplier') ?></th>
										<th><?php echo lang('warehouse') ?></th>
										<th>Biaya Pengiriman</th>
										<th>Pajak</th>
										<th><?php echo lang('total') ?></th>
										<th><?php echo lang('status') ?></th>
										<th>Setup Jurnal</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody></tbody>
								<tfoot>
									<tr>
										<th colspan="6" class="text-right">Total</th>
										<th></th>
										<th></th>
										<th></th>
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
	var base_url = '{site_url}faktur_pembelian/';
	var table = $('.index_datatable').DataTable({
		ajax: {
			url: base_url + 'index_datatable',
			type: 'post',
		},
		pageLength: 100,
		stateSave: false,
		autoWidth: false,
		order: [ [0, 'desc'] ],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"p>',
        language: {
            search: '<span></span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
        },
        columns: [
			{data: 'id', visible: false},
			{
				data: 'notrans',
				render: function(data,type,row) {
					return `
					<form action="${base_url + 'detail'}" method="post">
						<input type="hidden" name="id" value="${row.id}">
						<button type="submit" class="btn btn-info btn-sm">${data}</button>
					</form>`;
				}
			},
			{data: 'namaperusahaan'},
			{data: 'tanggal'},
			{data: 'supplier'},
			{data: 'gudang'},
			{
				data: 'biaya_pengiriman', className: 'text-right',
				render: function(data) {
					return formatRupiah(String(data)) + ',00';
				}
			},
			{
				data: 'pajak', className: 'text-right',
				render: function(data) {
					return formatRupiah(String(data)) + ',00';
				}
			},
			{
				data: 'total', className: 'text-right',
				render: function(data) {
					return formatRupiah(String(data)) + ',00';
				}
			},
			{
				data: 'status', className: 'text-center',
				render: function(data) {
					if(data == '3') return '<span class="badge badge-success"><?php echo lang('done') ?></sapan>';
					else if(data == '2') return '<span class="badge badge-warning"><?php echo lang('partial') ?></sapan>';
					else if(data == '1') return '<span class="badge badge-danger"><?php echo lang('pending') ?></sapan>';
				}
			},
			{
				data		: 'kodeJurnal',
				className	: 'text-center'
			},
			{
				data: {
					id		: 'id',
					status	: 'status'
				},
				render: function(data) {
					if (data.status == '3') {
						tombol_validasi	= `<a class="dropdown-item" href="`+base_url+`validasi/1/`+data.id+`"><i class="fas fa-times"></i> Hapus Validasi</a>`;
					} else {
						tombol_validasi	= `
							<a class="dropdown-item" href="`+base_url+`validasi/0/`+data.id+`"><i class="fas fa-check"></i> Validasi</a>
							<a href="` + base_url + `edit/` + data.id + `" class="dropdown-item"><i class="fas fa-pencil-alt"></i> <?php echo lang('edit') ?></a>`;
					}
					
					var aksi = `
						<div class="list-icons"> 
							<div class="dropdown"> 
								<a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
								<div class="dropdown-menu dropdown-menu-right">
									<a class="btn btn-success btn-sm dropdown-item" href="javascript:printData('`+data.id+`')"><i class="fas fa-print"></i> Cetak</a>` + tombol_validasi +
									`<a href="javascript:deleteData('` + data.id + `')" class="dropdown-item delete"><i class="fas fa-trash"></i> <?php echo lang('delete') ?></a>
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
				.column( 6 )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				}, 0 );
				

			// Total over this page
			totalBiayaPengiriman = api
				.column( 7, { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				}, 0 );

			totalPajak = api
				.column( 8, { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				}, 0 );

			// Update footer
			$( api.column( 6 ).footer() ).html(
				formatRupiah(String(total))+',00'
			);
			$( api.column( 7 ).footer() ).html(
				formatRupiah(String(totalBiayaPengiriman))+',00'
			);
			$( api.column( 8 ).footer() ).html(
				formatRupiah(String(totalPajak))+',00'
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
					swal("Berhasil!", data.message, "success");
					setTimeout(function() { table.ajax.reload() }, 100);
					} else {
					swal("Gagal!", data.message, "error");
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

	function printData(id) {
		swal("Pilih format?", {
			buttons: {
				cancel	: "Batal",
				pdf		: {
					text	: "PDF",
					value	: "pdf",
				},
				excel	: {
					text	: "Excel",
					value	: "excel",
				}
			},
		})
		.then((value) => {
			redirect(base_url + 'printpdf/' + value + '/' + id);
		});
	}
</script>