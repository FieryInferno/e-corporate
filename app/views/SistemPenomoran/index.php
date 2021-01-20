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
			<div class="row">
				<div class="col-12">         
					<div class="card">
						<div class="card-header">
							<a href="{site_url}sistem_penomoran/tambah" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
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
	let base_url    = '{site_url}SistemPenomoran/';
	let table       = $('.index_datatable').DataTable({
		ajax	: {
			url		: base_url + 'indexDatatable',
			type	: 'post',
			data	: {
				formulir	: '{formulir}'
			}
		},
		columns	: [
			{
        data	  : 'formulir',
        render  : function (data, type, row) {
          switch (data) {
            case 'permintaanPembelian':
              return 'Permintaan Pembelian';
              break;
            case 'pemesananPembelian':
              return 'Pemesanan Pembelian';
              break;
            case 'fakturPembelian':
              return 'Faktur Pembelian';
              break;
            case 'penerimaanBarang':
              return 'Penerimaan Barang';
              break;
            case 'pesananPenjualan':
              return 'Pesanan Penjualan';
              break;
            case 'pengirimanBarang':
              return 'Pengiriman Barang';
              break;
            case 'fakturPenjualan':
              return 'Faktur Penjualan';
              break;
            case 'kasBank':
              return 'Kas Bank';
              break;
            case 'pengeluaranKasKecil':
              return 'Pengeluaran Kas Kecil';
              break;
            case 'pemindahbukuan':
              return 'Pemindahbukuan';
              break;
            case 'pengajuanKasKecil':
              return 'Pengajuan Kas Kecil';
              break;
            case 'setorKasKecil':
              return 'Setor Kas Kecil';
              break;
          
            default:
              break;
          }
        }
      },
			{data	: 'formatPenomoran'},
			{
				data	: 'idPenomoran',
				render	: function (data, type, row) {
					let aksi = `
						<div class="list-icons"> 
							<div class="dropdown"> 
								<a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
								<div class="dropdown-menu dropdown-menu-right">
                  <a class="btn btn-success btn-sm dropdown-item text-success" href="{site_url}sistem_penomoran/edit/${data}"><i class="fas fa-pencil-alt"></i> Edit</a>
									<a class="btn btn-danger btn-sm dropdown-item text-danger" href="javascript:deleteData('`+data+`')"><i class="fas fa-trash"></i> Hapus</a>
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
