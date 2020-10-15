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
                    <!-- bagian button print -->
                    <div class="header-elements">
                        <div class="d-flex">
                    <!-- ini bagian search -->
                    <div class="m-3">
                        <a href="{site_url}pengeluaran_kas_kecil/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a> &nbsp;
                        <div class="btn-group">
                            <?php $currentURL = current_url(); ?>
                            <?php $params = $_SERVER['QUERY_STRING']; ?>
                            <?php $fullURL = $currentURL . '/printpdf?' . $params; ?>
                            <?php $fullURLChange = $fullURL ?>
                            <?php if ($this->uri->segment(2)): ?>
                                <?php $fullURL = $currentURL . '?' . $params; ?>
                                <?php $fullURLChange = str_replace('index', 'printpdf', $fullURL) ?>
                            <?php endif ?>
                            <a href="<?php echo $fullURLChange ?>" target="_blank" class="btn btn-warning"><?php echo lang('print') ?></a>

                                </div>
                            </div>
                        </div>
                        <form action="{site_url}pengeluaran_kas_kecil/index" id="form1" method="GET">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo lang('start_date') ?>:</label>
                                        <input type="text" class="form-control datepicker" name="tanggalawal" required value="{tanggalawal}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo lang('end_date') ?>:</label>
                                        <input type="text" class="form-control datepicker" name="tanggalakhir" required value="{tanggalakhir}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-right">
                                        <button type="submit" class="btn-block btn bg-success"><?php echo lang('search') ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
			</div>

			</div>            							
            <div class="content">
                <div class="card">
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped index_datatable">
                            <thead>
                                <tr>
                                    <th><?php echo lang('id') ?></th>
                                    <th><?php echo lang('no_receipt') ?></th>
                                    <th><?php echo lang('information') ?></th>
                                    <th><?php echo lang('date') ?></th>
                                    <th><?php echo lang('company') ?></th>
                                    <th><?php echo lang('Departemen') ?></th>
                                    <th><?php echo lang('nominal') ?></th>
                                    <th><?php echo lang('Status') ?></th>
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

  
<!-- jQuery -->
<script src="<?= base_url('adminlte')?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('adminlte')?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url('adminlte')?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('adminlte')?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('adminlte')?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('adminlte')?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- notifikasi -->

<script type="text/javascript">
	var base_url = '{site_url}Pengeluaran_kas_kecil/';

	var table = $('.index_datatable').DataTable({
		ajax: {
			url: base_url + 'index_datatable',
			type: 'post',
			data : {tanggalawal: '{tanggalawal}', tanggalakhir: '{tanggalakhir}'},
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
                data: 'nokwitansi', 
                render: function(data,type,row) {
                    var link = base_url + 'detail/' + row.id;
                    return '<a href="'+link+'" class="badge badge-info">'+data+'</a>';
                }
            },
            {data: 'keterangan'},
            {data: 'tanggal'},
            {data: 'nama_perusahaan'},
            {data: 'nama'},
            {
                data: 'subtotal',
                render: function(data,type,row) {
                    var nominal=`<div class="text-right">`+formatRupiah(data, 'Rp. ')+`,00</div>`;
                    return nominal;
                }
            },
            {
                data: 'status',
                render: function(data) {
                    if(data == '1') return '<span class="badge badge-success"><?php echo lang('Validasi') ?></sapan>';
                    else return '<span class="badge badge-danger"><?php echo lang('pending') ?></sapan>';
                }
            },
            {
                data: 'id', data: 'status', width: 100, orderable: false,
                render: function(data,type,row) {
                    if (row.status != '1')
                    {
                        aksi = `<a href="` + base_url + `validasi/` + row.id + `" class="btn btn-success btn-sm" title="validasi"><i class="fas fa-check"></i></a>
                        <a href="javascript:deleteData(`+row.id+`)" class="btn btn-danger btn-sm delete" title="hapus"><i class="fas fa-trash"></i></a>`;
                    } else{
                        aksi='';
                    }
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

	function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split           = number_string.split(','),
        sisa             = split[0].length % 3,
        rupiah             = split[0].substr(0, sisa),
        ribuan             = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka satuan ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>