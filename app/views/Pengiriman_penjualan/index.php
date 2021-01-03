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
						<li class="breadcrumb-item"><a href="<?= base_url('pemesanan_penjualan'); ?>">Penjualan</a></li>
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
						<div class="content">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-xs table-striped table-borderless table-hover index_datatable">
											<thead>
												<tr class="table-active">
													<th>ID</th>
													<th><?php echo lang('notrans') ?></th>
													<th><?php echo lang('order') ?></th>
													<th><?php echo lang('note') ?></th>
													<th><?php echo lang('date') ?> Terima</th>
													<th><?php echo lang('date') ?> PO</th>
													<th><?php echo lang('supplier') ?></th>
													<th><?php echo lang('Nomor Surat Jalan') ?></th>
													<th><?php echo lang('warehouse') ?></th>
													<th><?php echo lang('Departemen') ?></th>
													<th><?php echo lang('status') ?></th>
													<th>Setup Jurnal</th>
													<th><?php echo lang('action') ?></th>
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
			</div>
		</div>
    </section>
</div>

<script type="text/javascript">
	var base_url = '{site_url}Pengiriman_penjualan/';
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
				data: 'notrans',
				render: function(data,type,row) {
					var link =" ";
					if (row.status != '3'){
						link = base_url + 'create/' + row.id;
					}else{
						link = base_url + 'detail/' + row.id;
					}
					return '<a href="'+link+'" class="btn btn-info btn-sm">'+data+'</a>';
				}
			},
			{
				data: 'nopemesanan',
				render: function(data,type,row) {
					var link = '{site_url}pemesanan_penjualan/detail/' + row.idpemesanan;
					return '<a target="_blank" href="'+link+'" class="btn btn-info btn-sm">'+data+'</a>';
				}
			},
			{data: 'catatan', orderable: false, },
			{data: 'tanggalterima'},
			{data: 'tanggal'},
			{data: 'supplier'},
			{data: 'nomorsuratjalan'},
			{data: 'gudang'},
			{data: 'departemen'},
			{
				data: 'status',
				render: function(data,type,row) {
					if((data == '3') && (row.validasi == '2')) return '<span class="badge badge-success"><?php echo lang('done') ?></sapan>';
					else if(row.validasi == '1') return '<span class="badge badge-primary"><?php echo lang('Validasi') ?></sapan>';
					else if(data == '3') return '<span class="badge badge-success"><?php echo lang('done') ?> <br>Pengiriman</sapan>';
					else if(data == '2') return '<span class="badge badge-warning"><?php echo lang('partial') ?></sapan>';
					else  return '<span class="badge badge-danger"><?php echo lang('pending') ?></sapan>';
				}
			},
			{data	: 'kodeJurnal'},
			{
				data: 'id', width: 40, orderable: false, class: 'text-center',
				render: function(data,type,row) { 
                    var aksi = '';
                    var tombol = '';
                    if (row.validasi != '2'){
                        if (row.status == '3'){
                            if (row.validasi != '1'){
                                tombol += `
                                    <a class="dropdown-item" href="javascript:Validasi('`+data+`')"><i class="fas fa-check"></i>  Validasi</a>`; 
                            }
                            if (row.validasi == '1'){
                                tombol += `<a class="dropdown-item" href="javascript:ValidasiBatal('`+data+`')"><i class="fas fa-times"></i> Batal Validasi</a>`; 
                            }
                        }else{
                            tombol += `<a href="`+base_url+`edit/`+data+`" class="dropdown-item" title="edit"><i class="fas fa-pencil-alt"></i> Ubah</a>`;
                        }
                        aksi = `
                            <div class="list-icons"> 
                                <div class="dropdown"> 
                                    <a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
                                    <div class="dropdown-menu dropdown-menu-right">
                                        `+ tombol + `
                                        <a href="javascript:deleteData('` + data+ `')" class="dropdown-item delete"><i class="fas fa-trash"></i> Hapus</a>
                                    </div> 
                                </div> 
                            </div>`;
                    }
                    return aksi;
				}
			}
        ]
	});


	function Validasi(id) {
        $.ajax({
            url: base_url + 'validasi',
            dataType: 'json',
            method: 'post',
            data: {id : id},
            success: function(data) {
                if(data.status == 'success') {
                    swal("Berhasil!",data.message, "success");
                    redirect(base_url);
                } else {
                    swal("Gagal!",data.message, "error");
                }
            },
        })
    }
	
    function ValidasiBatal(id) {
        $.ajax({
            url: base_url + 'validasibatal',
            dataType: 'json',
            method: 'post',
            data: {id : id},
            success: function(data) {
                if(data.status == 'success') {
                    swal("Berhasil!",data.message, "success");
                    redirect(base_url);
                } else {
                    swal("Gagal!",data.message, "error");
                }
            },
        })
    }

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
</script>
