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
                            <a href="{site_url}jurnal_penyesuaian/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-xs index_datatable">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Tanggal</th>
                                            <th>Perusahaan</th>
                                            <th>Keterangan</th>
                                            <th>Debit</th>
                                            <th>Kredit</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-left"><B>Total<B></th>
                                            <th></th>
                                            <th></th>
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
  var base_url = '{site_url}jurnal_penyesuaian/';
  var table = $('.index_datatable').DataTable({
		ajax: {
			url     : base_url + 'index_datatable',
			type    : 'post',
		},
		stateSave: true,
		autoWidth: false,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"p>',
        language: {
            search: '<span></span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
        },
        columns: [
            {data : 'notrans'},
            {data : 'tanggal'},
            {data : 'nama_perusahaan'},
            {data : 'keterangan'},
            {
                data    : "totaldebet",
                render: function(data,type,row) {
                return formatRupiah(String(data)) + ',00';
                }
            },
            {
                data    : "totalkredit",
                render: function(data,type,row) {
                return formatRupiah(String(data)) + ',00';
                }
            },
            {
                data    : "idJurnalPenyesuaian",
                render: function(data, type, row) {
                var aksi = `
                    <div class="list-icons"> 
                    <div class="dropdown"> 
                        <a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href=""><i class="fas fa-pencil-alt"></i> Edit</a>
                            <form method="post" id="formHapus">
                                <input type="hidden" value="${data}" name="idJurnalPenyesuaian">
                                <a href="javascript:deleteData()" class="dropdown-item delete"><i class="fas fa-trash"></i> <?php echo lang('delete') ?></a>
                            </form>
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
                i.replace(/(Rp.|,00)/g, '')*1 :
                typeof i === 'number' ?
                    i : 0;
            };

            // Total over all pages
            totalDebit = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                return intVal(a) + intVal(b);
                }, 0 );

            totalKredit = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 4 ).footer() ).html(
                formatRupiah(String(totalDebit))+',00'
            );
            $( api.column( 5 ).footer() ).html(
                formatRupiah(String(totalKredit))+',00'
            );
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
                    var form                = new FormData($('#formHapus')[0]);
                    var idJurnalPenyesuaian = form.get('idJurnalPenyesuaian');
                    $.ajax({
                        url     : base_url + 'delete',
                        method  : 'post',
                        data    : {
                            "idJurnalPenyesuaian"   : idJurnalPenyesuaian
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