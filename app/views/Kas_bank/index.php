

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
							<a href="{site_url}Kas_bank/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-xs table-striped table-borderless table-hover index_datatable" onload="return data()">
									<thead>
										<tr class="table-active">
											<th><?php echo lang('id') ?></th>
											<th><?php echo lang('number') ?></th>
											<th><?php echo lang('date') ?></th>
											<th>Perusahaan</th>
											<th><?php echo lang('reception') ?></th>
											<th><?php echo lang('spending') ?></th>
											<th><?php echo lang('Aksi') ?></th>
										</tr>
									</thead>
									<tbody></tbody>
									<tfoot>
										<tr class="table-active">
											<th class="text-right" colspan="4"><?php echo lang('total') ?></th>
											<th class="text-right"><a1></a1></th>
											<th class="text-right"><a2></a2></th>
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
	var base_url = '{site_url}Kas_bank/';
	var table = $('.index_datatable').DataTable({
		ajax: {
			url: base_url + 'index_datatable',
			type: 'post',
		},
		pageLength: 100,
		stateSave: true,
		autoWidth: false,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"p>',
        language: {
            search: '<span></span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
        },
        columns: [
			{data: 'id', visible: false},
			{
				data		: 'nomor_kas_bank',
				className	: 'text-center', 
				render: function(data,type,row) {
					var link = base_url + 'detail/' + row.id;
					return '<a href="'+link+'" class="btn btn-info btn-sm">'+data+'</a>';
				}
			},
			{
				data		: 'tanggal',
				className	: 'text-center'
			},
			{
				data		: 'nama_perusahaan',
				className	: 'text-center'
			},
			{
				data: 'penerimaan',
				render: function(data,type,row) {
					var penerimaan=`<div class="text-right">`+formatRupiah(data)+`,00</div>`;
					return penerimaan;
				}
			},
			{
				data: 'pengeluaran',
				render: function(data,type,row) {
					var pengeluaran=`<div class="text-right">`+formatRupiah(data)+`,00</div>`;
					return pengeluaran;
				}
			},
			{
				data: 'id', width: 40, orderable: false, class:'text-center',
				render: function(data,type,row) {
					var aksi = `
                        <div class="list-icons"> 
                            <div class="dropdown"> 
                                <a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
								<div class="dropdown-menu dropdown-menu-right">
									<form method="post" id="formHapus">
										<input type="hidden" value="${data}" name="idKasBank">
										<a href="javascript:deleteData()" class="dropdown-item delete"><i class="fas fa-trash"></i> <?php echo lang('delete') ?></a>
									</form>
                                </div> 
                            </div> 
                        </div>`;
					return aksi;
				}
			}
        ],
        footerCallback: function ( row, data, start, end, display ) {

            var api = this.api(), data;
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\Rp.]/g, '').replace(/,00/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            total_penerimaan = api.column(3).data().reduce( function (a, b) {
                return intVal(a) + intVal(b); 
            }, 0 );
            total_pengeluaran = api.column(4).data().reduce( function (a, b) {
                return intVal(a) + intVal(b); 
            }, 0 );
           
            $('a1').html(formatRupiah(String(total_penerimaan)) + ',00');
            $('a2').html(formatRupiah(String(total_pengeluaran)) + ',00');
        }
	});

	function deleteData() {
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
					var form		= new FormData($('#formHapus')[0]);
					var idKasBank	= form.get('idKasBank');
					$.ajax({
						url		: base_url + 'delete',
						method	: 'post',
						data	: {
							"idKasBank"	: idKasBank
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
