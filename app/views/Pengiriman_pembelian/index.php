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
								<th><?php echo lang('notrans') ?></th>
								<th><?php echo lang('order') ?></th>
								<th><?php echo lang('note') ?></th>
								<th>Perusahaan</th>
								<th>Departemen</th>
								<th><?php echo lang('date') ?></th>
								<th style="text-align:right">Nominal Pemesanan</th>
								<th><?php echo lang('supplier') ?></th>
								<th style="text-align:right">Nominal Penerimaan</th>
								<th><?php echo lang('warehouse') ?></th>
								<th><?php echo lang('status') ?></th>
								<th>Setup Jurnal</th>
								<th><?php echo lang('action') ?></th>
							</tr>
						</thead>
						<tbody></tbody>
						<tfoot>
							<tr>
								<th colspan="7" style="text-align:right">Total :</th>
								<th style="text-align:right"></th>
								<th style="text-align:right">Total :</th>
								<th style="text-align:right"></th>
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
	var base_url = '{site_url}pengiriman_pembelian/';
	var table = $('.index_datatable').DataTable({
		ajax: {
			url: base_url + 'index_datatable',
			type: 'post',
		},
		pageLength: 100,
		stateSave: true,
		autoWidth: false,
		order: [[0,'DESC']],
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
					var link = base_url + 'create/' + row.id;
					console.log(row);
					return '<a href="'+link+'" class="btn btn-sm btn-info">'+data+'</a>';
				}
			},
			{
				data: 'nopemesanan',
				render: function(data,type,row) {
					var link = '{site_url}pemesanan_pembelian/detail/' + row.idpemesanan;
					return '<a target="_blank" href="'+link+'" class="btn btn-sm btn-info">'+data+'</a>';
				}
			},
			{data: 'catatan', orderable: false, width: '200px'},
			{data: 'nama_perusahaan'},
			{data: 'departemen'},
			{data: 'tanggal'},
			{
				data: 'nominal_pemesanan',
				render: function(data,type,row) {
					return formatRupiah(data) + ',00';
				}
			},
			{data: 'supplier'},
			{
				data: 'nominal_penerimaan',
				render: function(data,type,row) {
					return formatRupiah(data) + ',00';
				}
			},
			{data: 'gudang'},
			{
				data: 'status',
				render: function(data) {
					if(data == '3') return '<span class="badge badge-success"><?php echo lang('done') ?></span>';
					else if(data == '2') return '<span class="badge badge-warning"><?php echo lang('partial') ?></span>';
					else if(data == '1') return '<span class="badge badge-danger"><?php echo lang('pending') ?></span>';
				}
			},
			{
				render: function(data) {
					return '';
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
					if (data.status == '3') {
						tombol_validasi	= `
						<a class="dropdown-item" href="`+base_url+`validasi/1/`+data.id+`"><i class="fas fa-times"></i> Hapus Validasi</a>`;
					} else {
						tombol_validasi	= `
						<a class="dropdown-item" href="`+base_url+`validasi/0/`+data.id+`"><i class="fas fa-check"></i> Validasi</a>
						<a href="` + base_url + `edit/` + data.id + `" class="dropdown-item"><i class="fas fa-pencil-alt"></i> <?php echo lang('edit') ?></a>
						`;
					}
					
					var aksi = `
						<div class="list-icons"> 
							<div class="dropdown"> 
								<a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
								<div class="dropdown-menu dropdown-menu-right">
									<a href="`+base_url+`printpdf/`+data.id+`" class="dropdown-item"><i class="fas fa-print"></i> <?php echo lang('print') ?></a>` + tombol_validasi + 
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
				.column( 7 )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				}, 0 );
				

			// Total over this page
			pageTotal = api
				.column( 7, { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				}, 0 );

			pageTotal0 = api
				.column( 9, { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				}, 0 );

			// Update footer
			$( api.column( 7 ).footer() ).html(
				formatRupiah(String(pageTotal))+',00'
			);
			$( api.column( 9 ).footer() ).html(
				formatRupiah(String(pageTotal0))+',00'
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
