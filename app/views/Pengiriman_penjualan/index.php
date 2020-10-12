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
								<table class="table table-bordered table-striped index_datatable">
									<thead>
										<tr>
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
											<th><?php echo lang('aksi') ?></th>
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
	var base_url = '{site_url}pengiriman_penjualan/';
	var table = $('.index_datatable').DataTable({
		ajax: {
			url: base_url + 'index_datatable',
			type: 'post',
		},
		pageLength: 100,
		stateSave: true,
		autoWidth: false,
        order: [[0,'desc']],
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
        			var link = base_url + 'detail/' + row.id;
        			return '<a href="'+link+'" class="badge badge-info">'+data+'</a>';
        		}
        	},
        	{
        		data: 'nopemesanan',
        		render: function(data,type,row) {
        			var link = '{site_url}pemesanan_penjualan/detail/' + row.idpemesanan;
        			return '<a target="_blank" href="'+link+'" class="badge badge-info">'+data+'</a>';
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
        		data: 'validasi',
        		render: function(data) {
        			if(data == '1') return '<span class="badge badge-success"><?php echo lang('Validasi') ?></sapan>';
        			else return '<span class="badge badge-danger"><?php echo lang('pending') ?></sapan>';
        		}
        	},
        	{
        		data: 'id', width: 101, orderable: false,
				render: function(data,type,row) { 
					let aksi	= ``;

					if(row.validasi != '1')
					{
						aksi += `<a href="javascript:Validasi('`+data+`')" class="btn btn-success btn-sm" title="validasi"><i class="fas fa-check"></i></a> `;
					}
                    if (row.validasi == '1'){
                        aksi += `<a href="javascript:ValidasiBatal('`+data+`')" class="btn btn-danger btn-sm" title="Batal"><i class="fas fa-times"></i></a> `;
                    }
					aksi += `<a href="javascript:deleteData('`+data+`')" class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></a>`;
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
