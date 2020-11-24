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
                            <a href="{site_url}project/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-xs table-striped table-borderless table-hover index_datatable">
                                    <thead>
                                        <tr class="table-active">
                                            <th>No. Event</th>
                                            <th>Kode Event</th>
                                            <th>Kelompok Usia</th>
                                            <th>Perusahaan</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Akhir</th>
                                            <th>Cabang</th>
                                            <th>Rekanan</th>
                                            <th>Gudang</th>
                                            <th>Region</th>
                                            <th>Nominal Pendapatan</th>
                                            <th>HPP</th>
                                            <th>Gross Profit</th>
                                            <th>CRO</th>
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
        </div>
    </section>
</div>

<script type="text/javascript">
    var baseUrl = '{site_url}project/';
    var table   = $('.index_datatable').DataTable({
        ajax    : {
            url     : baseUrl + 'indexDatatables'
        },
        columns : [
            {data   : 'noEvent'},
            {data   : 'kodeEvent'},
            {data   : 'kelompokUmur'},
            {data   : 'nama_perusahaan'},
            {data   : 'tanggalMulai'},
            {data   : 'tanggalSelesai'},
            {data   : 'namaCabang'},
            {data   : 'namaRekanan'},
            {data   : 'namaGudang'},
            {data   : 'region'},
            {
                data    : 'totalPendapatan',
                render  : function (data, type, row) {
                    return formatRupiah(String(data)) + ',00';
                }
            },
            {
                data    : 'totalHPP',
                render  : function (data, type, row) {
                    return formatRupiah(String(data)) + ',00';
                }
            },
            {
                data    : 'grossProfit',
                render  : function (data, type, row) {
                    return formatRupiah(String(data)) + ',00';
                }
            },
            {data   : 'namaPejabat'},
            {
                data    : 'idProject',
                render  : function (data, type, row) {
                    return `
                        <div class="list-icons"> 
							<div class="dropdown"> 
								<a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
								<div class="dropdown-menu dropdown-menu-right">
                                    <a href="${baseUrl}edit/${data}" class="dropdown-item text-primary"><i class="fas fa-pencil-alt"></i> <?php echo lang('edit') ?></a>
                                    <a href="javascript:deleteData('${data}')" class="dropdown-item delete text-danger"><i class="fas fa-trash"></i> <?php echo lang('delete') ?></a>
								</div> 
							</div> 
						</div>`;
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
					url: baseUrl + 'delete/'+id,
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