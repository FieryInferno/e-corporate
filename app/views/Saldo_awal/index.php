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
              <a href="{site_url}saldo_awal/tambah" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
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
  var base_url = '{site_url}saldo_awal/';
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
            {data : 'no'},
            {data : 'tanggal'},
            {data : 'nama_perusahaan'},
            {data : 'keterangan'},
            {
              data  : "debit",
              render: function(data,type,row) {
                return formatRupiah(row.debit, 'Rp. ') + ',00';
              }
            },
            {
              data  : "kredit",
              render: function(data,type,row) {
                return formatRupiah(row.kredit, 'Rp. ') + ',00';
              }
            },
            {
              render: function(data, type, row) {
                var aksi = `
                  <div class="list-icons"> 
                    <div class="dropdown"> 
                      <a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href=""><i class="fas fa-pencil-alt"></i> Edit</a>
                        <a href="javascript:deleteData('` + row.idSaldoAwal + `')" class="dropdown-item delete"><i class="fas fa-trash"></i> <?php echo lang('delete') ?></a>
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
            

          // Total over this page
          // pageTotal = api
          // 	.column( 3, { page: 'current'} )
          // 	.data()
          // 	.reduce( function (a, b) {
          // 		return intVal(a) + intVal(b);
          // 	}, 0 );

          // Update footer
          $( api.column( 4 ).footer() ).html(
            formatRupiah(String(totalDebit), 'Rp.')+',00'
          );
          $( api.column( 5 ).footer() ).html(
            formatRupiah(String(totalKredit), 'Rp.')+',00'
          );
        }
      });
</script>