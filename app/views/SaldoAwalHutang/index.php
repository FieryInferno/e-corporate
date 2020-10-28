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
                            <a href="{site_url}SaldoAwalHutang/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-xs table-striped table-borderless table-hover index_datatable">
                                    <thead>
                                        <tr class="table-active">
                                            <th>Nama Pemasok</th>
                                            <th>Tanggal</th>
                                            <th>No. Invoice</th>
                                            <th>Saldo Piutang</th>
                                            <th>Aksi</th>
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
<script>
    var base_url    = '{site_url}SaldoAwalHutang/';
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
            {data   : 'namaPemasok'},
            {data   : 'tanggal'},
            {data   : 'noInvoice'},
            {
                data        : 'jumlah',
                className   : 'text-right font-weight-semibold', 
                orderable   : false,
                render      : function(data) {
                    return formatRupiah(data) + ',00';
                }
            },
            {
                data        : 'idSaldoAwalHutang', 
                orderable   : false, 
                className   : 'text-center',
                render      : function(data,type,row) {
                    var aksi = `
						<div class="list-icons"> 
							<div class="dropdown"> 
								<a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
								<div class="dropdown-menu dropdown-menu-right">
									
								</div> 
							</div> 
						</div>`;
					return aksi;
                }
            }
        ]
	});
</script>