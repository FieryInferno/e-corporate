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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah">
                                + <?php echo lang('add_new') ?>
                            </button>

                            <!-- Modal -->
                            <div id="modal_tambah" class="modal fade">
                                <div class="modal-dialog modal-lg">
                                    <form action="javascript:simpanPemetaan('tambah')" id="formTambahPemetaan">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"><?php echo lang('add_new') ?></h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Kode Akun</label>
                                                    <select class="kode_akun" name="kode_akun" style="width: 100%" required></select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kode Pemetaan Akun 1</label>
                                                    <select class="kode_akun_1" name="kode_akun_1" style="width: 100%" required></select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kode Pemetaan Akun 2</label>
                                                    <select class="kode_akun_2" name="kode_akun_2" style="width: 100%" required></select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kode Pemetaan Akun 3</label>
                                                    <select class="kode_akun_3" name="kode_akun_3" style="width: 100%" required></select>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo lang('cancel') ?></button>
                                                    <button type="submit" class="btn btn-success"><?php echo lang('save') ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
								<table class="table table-xs table-striped table-borderless table-hover index_datatable">
									<thead>
										<tr class="table-active">
                                            <th>ID</th>
                                            <th>Kode Akun</th>
                                            <th>Nama Akun</th>
                                            <th>Akun 1</th>
                                            <th>Akun 2</th>
                                            <th>Akun 3</th>
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

<div id="modalEdit" class="modal fade">
    <div class="modal-dialog modal-lg">
        <form action="javascript:simpanPemetaan('edit')" id="formEditPemetaan">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Akun</label>
                        <input type="hidden" name="idPemetaanAkun" id="idPemetaanAkun">
                        <select name="kode_akun" style="width: 100%" required id="kodeAkunEdit"></select>
                    </div>
                    <div class="form-group">
                        <label>Kode Pemetaan Akun 1</label>
                        <select name="kode_akun_1" style="width: 100%" required id="kodeAkun1Edit"></select>
                    </div>
                    <div class="form-group">
                        <label>Kode Pemetaan Akun 2</label>
                        <select name="kode_akun_2" style="width: 100%" required id="kodeAkun2Edit"></select>
                    </div>
                    <div class="form-group">
                        <label>Kode Pemetaan Akun 3</label>
                        <select name="kode_akun_3" style="width: 100%" required id="kodeAkun3Edit"></select>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo lang('cancel') ?></button>
                        <button type="submit" class="btn btn-success"><?php echo lang('save') ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
	var base_url = '{site_url}metaakun/';
    ajax_select({
        id  : '.kode_akun',	
        url : '{site_url}noakun/select2_noakun',
    });
    ajax_select({
        id  : '.kode_akun_1',	
        url : '{site_url}noakun/select2_noakun',
    });
    ajax_select({
        id  : '.kode_akun_2',	
        url : '{site_url}noakun/select2_noakun',
    });
    ajax_select({
        id  : '.kode_akun_3',	
        url : '{site_url}noakun/select2_noakun',
    });
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
            {data: 'idPemetaanAkun', visible: false},
            {
                data        : 'akunno', 
                width       : '30%', 
                orderable   : false,
            },
            {
                data: 'namaakun', 
                width: '30%',
            },
            {
                data    : 'akun1',
                width   : '8%',
            },
            {
                data    : 'akun2',
                width   : '8%'
            },
            {
                data        : 'akun3', 
                width       : '8%',
            },
            {
                data    : 'idPemetaanAkun', 
                width   : '5%', 
                orderable: false, 
                className: 'text-center',
                render: function(data,type,row) {
					var aksi = `
						<div class="list-icons"> 
							<div class="dropdown"> 
								<a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
								<div class="dropdown-menu dropdown-menu-right">
									<a href="javascript:editData('${row.idPemetaanAkun}', '${row.kodeAkun}', '${row.kodeAkun1}', '${row.kodeAkun2}', '${row.kodeAkun3}')" class="dropdown-item"><i class="fas fa-pencil-alt"></i> <?php echo lang('edit') ?></a>
									<a href="javascript:deleteData('` + data + `')" class="dropdown-item delete"><i class="fas fa-trash"></i> <?php echo lang('delete') ?></a>
								</div> 
							</div> 
						</div>`;
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

    function simpanPemetaan(jenis) {
        switch (jenis) {
            case 'tambah':
                formData    = new FormData($('#formTambahPemetaan')[0]);
                break;
            case 'edit':
                formData    = new FormData($('#formEditPemetaan')[0]);
                break;
        
            default:
                break;
        }
        $.ajax({
            url: base_url + 'save',
            dataType: 'json',
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                switch (jenis) {
                    case 'tambah':
                        $('#modal_tambah').modal('hide');
                        break;
                    case 'edit':
                        $('#modalEdit').modal('hide');
                        break;
                
                    default:
                        break;
                }
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
                    swal("Gagal!", "Gagal Menambah Data", "error");
                }
            },
            error: function() {
                swal("Gagal!", "Internal Server Error", "error");
            }
        })
    }

    function editData(id, kodeAkun, kodeAkun1, kodeAkun2, kodeAkun3) {
        $('#idPemetaanAkun').val(id);
        ajax_select({
            id          : '#kodeAkunEdit',	
            url         : '{site_url}noakun/select2_noakun/145',
            selected    : {
                id  : kodeAkun,
            }
        });
        ajax_select({
            id          : '#kodeAkun1Edit',	
            url         : '{site_url}noakun/select2_noakun',
            selected    : {
                id  : kodeAkun1,
            }
        });
        ajax_select({
            id          : '#kodeAkun2Edit',	
            url         : '{site_url}noakun/select2_noakun',
            selected    : {
                id  : kodeAkun2,
            }
        });
        ajax_select({
            id          : '#kodeAkun3Edit',	
            url         : '{site_url}noakun/select2_noakun',
            selected    : {
                id  : kodeAkun3,
            }
        });
        $('#modalEdit').modal('show');
    }
</script>