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
                        <li class="breadcrumb-item"><a href="{site_url}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{site_url}SaldoAwalHutang">{title}</a></li>
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
                        <div class="card-header">
                            <a href="{site_url}saldo_awal_inventaris/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-xs table-striped table-borderless table-hover index_datatable">
                                    <thead>
                                        <tr class="table-active">
                                            <th>Nama Perusahaan</th>
                                            <th>Kode Inventaris</th>
                                            <th>Nama Inventaris</th>
                                            <th>No. Register</th>
                                            <th>Nominal</th>
                                            <th>Tahun Perolehan</th>
                                            <th>Kelompok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-right">Total</th>
                                            <th class="text-right"></th>
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
<script>
    var base_url    = '{site_url}SaldoAwalInventaris/';
    var table = $('.index_datatable').DataTable({
		ajax: {
			url: base_url + 'indexDatatable',
			type: 'post',
		},
		stateSave: false,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"p>',
        language: {
            search: '<span></span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
        },
        columns: [
            {
                data   : 'nama_perusahaan',
                width   : '10%'
            },
            {
                data   : 'kodeInventaris',
                width   : '5%'
            },
            {
                data    : 'namaInventaris',
                width   : '15%'
            },
            {
                data    : 'noRegister',
                width   : '5%'
            },
            {
                data        : 'harga',
                width       : '10%',
                className   : 'text-right font-weight-semibold', 
                render      : function(data) {
                    return formatRupiah(String(data)) + ',00';
                }
            },
            {
                data    : 'tanggalPembelian',
                width   : '5%',
                render  : function (data, type, row) {
                    return data.substring(0, 4);
                }
            },
            {
                data   : 'namaakun',
                width   : '10%'
            },
            {
                data        : 'idSaldoAwalInventaris',
                width       : '5%', 
                className   : 'text-center',
                render      : function(data,type,row) {
                    var aksi = `
						<div class="list-icons"> 
							<div class="dropdown"> 
								<a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
								<div class="dropdown-menu dropdown-menu-right">
									<form action="SaldoAwalInventaris/edit" method="post">
                                        <input type="hidden" name="idSaldoAwalInventaris" value="${data}">
                                        <button type="submit" value="edit" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Edit</button>
                                    </form>
                                    <button onclick="deleteData(this)" class="dropdown-item" idSaldoAwalInventaris="${data}"><i class="fas fa-trash"></i> <?php echo lang('delete') ?></button>
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
                    i.replace(/[\.,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Update footer
            $( api.column( 4 ).footer() ).html(
                formatRupiah(String(total)) + ',00'
            );
        }
	});

    function deleteData(elemen) {
        var idSaldoAwalInventaris   = $(elemen).attr('idSaldoAwalInventaris');
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
					url         : base_url + 'delete',
                    dataType    : 'json',
                    method      : 'post',
                    data        : {
                        idSaldoAwalInventaris  : idSaldoAwalInventaris
                    },
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