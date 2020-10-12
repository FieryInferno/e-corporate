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
            <div class="card-header {bg_header}">
            <!-- <div class="header-elements-inline">
                <h5 class="card-title">{subtitle}</h5>
            </div> -->
        </div>
        <div class="card-body">
            <form action="javascript:save()" id="form1">
                <h3 class="mb-3 mt-3"><?php echo lang('sales') ?></h3>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo lang('Piutang Belum Ditagih') ?>:</label>
                                <select class="form-control piutang_belum_ditagih" name="piutang_belum_ditagih" multiselect="multiselect" required></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo lang('Pajak Penjualan') ?>:</label>
                                <select class="form-control pajak_penjualan" name="pajak_penjualan" required></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo lang('Pendapatan Penjualan') ?>:</label>
                                <select class="form-control pendapatan_penjualan" name="pendapatan_penjualan" required></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo lang('Pendapatan Belum Ditagih') ?>:</label>
                                <select class="form-control retur_penjualan" name="retur_penjualan" required></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo lang('Retur Penjualan') ?>:</label>
                                <select class="form-control penjualan_belum_ditagih" name="penjualan_belum_ditagih" required></select>
                            </div>
                        </div>
                    </div>

                    <h3 class="mb-3 mt-3"><?php echo lang('purchasing') ?></h3>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo lang('Pajak Pembelian') ?>:</label>
                                <select class="form-control pajak_pembelian" name="pajak_pembelian" required></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo lang('Hutang Belum Ditagih') ?>:</label>
                                <select class="form-control hutang_belum_ditagih" name="hutang_belum_ditagih" required></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo lang('Pembelian') ?>:</label>
                                <select class="form-control pembelian" name="pembelian" required></select>
                            </div>
                        </div>
                    </div>

                    <h3 class="mb-3 mt-3"><?php echo lang('Utang dan Piutang') ?></h3>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo lang('Piutang Usaha') ?>:</label>
                                <select class="form-control piutang_usaha" name="piutang_usaha" required></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo lang('Hutang Usaha') ?>:</label>
                                <select class="form-control hutang_usaha" name="hutang_usaha" required></select>
                            </div>
                        </div>
                    </div>

                    <h3 class="mb-3 mt-3"><?php echo lang('Persediaan') ?></h3>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo lang('Persediaan') ?>:</label>
                                <select class="form-control persediaan" name="persediaan" required></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo lang('Persediaan Produksi') ?>:</label>
                                <select class="form-control persediaan_produksi" name="persediaan_produksi" required></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo lang('Persediaan Rusak') ?>:</label>
                                <select class="form-control persediaan_rusak" name="persediaan_rusak" required></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo lang('Persediaan Umum') ?>:</label>
                                <select class="form-control persediaan_umum" name="persediaan_umum" required></select>
                            </div>
                        </div>
                    </div>

                    <h3 class="mb-3 mt-3"><?php echo lang('Persediaan') ?></h3>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo lang('Modal') ?>:</label>
                                <select class="form-control ekuitas_saldo_awal" name="ekuitas_saldo_awal" required></select>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <a href="{site_url}item" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                        <button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
                    </div>
                </form>
            </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Pilih Rekening</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
                <form action="javascript:import_data()" method="post" enctype="multipart/form-data" id="form_import">
                    <div class="form-row pt-3">
                        <div class="col-sm-12">
                            <label for="input-file-now">Input File</label>
                            <input type="file" name="file" placeholder="Masukan File Excel" id="input-file-now" class="dropify">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
		</div>
	</div>
</div>
  
<!-- jQuery -->
<!-- <script src="<?= base_url('adminlte')?>/plugins/jquery/jquery.min.js"></script> -->
<!-- Bootstrap 4 -->
<!-- <script src="<?= base_url('adminlte')?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<!-- DataTables -->
<script src="<?= base_url('adminlte')?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('adminlte')?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('adminlte')?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('adminlte')?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- notifikasi -->
<!-- <script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script> -->

<script type="text/javascript">
	var base_url = '{site_url}noakun/';
	var table = $('.index_datatable').DataTable({
		ajax: {
			url: base_url + 'index_datatable',
			type: 'post',
		},
		pageLength: 100,
		stateSave: false,
		autoWidth: false,
		order: [[5,'ASC']],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"p>',
        language: {
            search: '<span></span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
        },
        columns: [
        	{data: 'noakun', visible: false},
        	{
        		data: 'noakuntop', width: '100px', orderable: false,
        		render: function(data, type, row) {
        			if(row.stdefault == '1') return '<span class="icon-lock"></span>';
        			else if(row.stdefault == '0' && row.stkunci == '1') return '<span class="icon-plus2"></span>';
        			else return '<span>-</span>';
        		}
        	},
        	{
        		data: 'akunno', width: '100px',
        		render: function(data) {
        			return '<span class="badge badge-info">'+data+'</span>';
        		}
        	},
        	{
        		data: 'namaakun',
        		render: function(data,type,row) {
        			return '<a href="'+base_url+'detail/'+row.noakun+'">'+data+'</a>';
        		}
        	},
        	{
        		data: 'kategoriakun'
        	},
        	{
        		data: 'saldoakun', width: '150px', className: 'text-right font-weight-semibold', orderable: false,
        		render: function(data) {
        			return numeral(data).format();
        		}
        	},
        	{
        		data: 'akunno', width: 100, orderable: false, className: 'text-center',
        		render: function(data,type,row) {
        			var aksi = `<div class="list-icons"> 
        			<div class="dropdown"> 
        			<a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="icon-menu9"></i> </a> 
        			<div class="dropdown-menu dropdown-menu-right"> `;
        			if(row.stdefault != '1' && row.stkunci != '1') {
        				aksi += `<a href="javascript:deleteData(`+data+`)" class="dropdown-item delete"><i class="icon-trash"></i> <?php echo lang('delete') ?></a>`;
        			}
        			// aksi += `<a href="`+base_url+`edit/`+data+`" class="dropdown-item"><i class="icon-pencil"></i> <?php echo lang('edit') ?></a>`;
        			aksi += `</div> </div> </div>`;
        			return aksi;
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
    
    function import_data() {
        var formData    = new FormData($('#form_import')[0]);
        console.log(formData.get('file'));
        $.ajax({
			url         : base_url + 'import_data',
			method      : 'post',
			data        : formData,
			contentType : false,
			processData : false,
			beforeSend  : function() {
				pageBlock();
			},
			afterSend   : function() {
				unpageBlock();
			},
			success     : function(response) {
				if (response.status == 'success') {
					swal("Berhasil!", "Berhasil Import Data", "success");
					setTimeout(function() { table.ajax.reload() }, 100);
				} else {
					swal("Gagal!", "Gagal Import Data", "error");
				}
			},
			error       : function() {
				swal("Gagal!", "Internal Server Error", "error");
			}
		})
    }
</script>