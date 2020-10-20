

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
            <div class="card">
              <div class="card-header">
			 	<a href="{site_url}Faktur_penjualan/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
			  </div>
          <div class="card-body">
            <div class="table-responsive">
      			  <table class="table table-striped index_datatable" onload="return data()">
                      <!-- <table class="table table-bordered table-striped index_datatable"> -->
                        	<thead class="">
      						<tr>
      							<th>ID</th>
      							<th><?php echo lang('notrans') ?></th>
                    <th><?php echo lang('Surat Jalan') ?></th>
      							<th><?php echo lang('note') ?></th>
                    <th><?php echo lang('Departemen') ?></th>
      							<th><?php echo lang('date') ?></th>
                    <th><?php echo lang('date') ?>J/T</th>
      							<th><?php echo lang('supplier') ?></th>
                    <th><?php echo lang('Cara Bayar') ?></th>
      							<th><?php echo lang('warehouse') ?></th>
      							<th><?php echo lang('total') ?></th>
      							<th><?php echo lang('status') ?></th>
                    <th><?php echo lang('Aksi') ?></th>
      						</tr>
      					</thead>
      					<tbody></tbody>
                <tfoot class="bg-light">
                  <tr>
                    <th>ID</th>
                      <th colspan="6">&nbsp;</th>
                      <th colspan="3" class="text-right"><?php echo lang('Total Faktur Penjualan') ?></th>
                      <th class="text-center"><div id="total"></div></th>
                      <th class="text-center"></th>
                      <th class="text-center"></th>
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
	var base_url = '{site_url}Faktur_penjualan/';
	var table = $('.index_datatable').DataTable({
		ajax: {
			url: base_url + 'index_datatable',
			type: 'post',
		},
		pageLength: 100,
		stateSave: false,
		autoWidth: false,
		order: [ [0, 'desc'] ],
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
          {data: 'nomorsuratjalan'},
        	{data: 'catatan', orderable: false},
          {data: 'namadepartemen'},
        	{data: 'tanggal'},
          {data: 'tanggaltempo'},
        	{data: 'supplier'},
          {data: 'carabayar'},
        	{data: 'gudang'},
        	{
        		data: 'total', className: 'text-right',
        		render: function(data) {
        			return formatRupiah(data, 'Rp. ');
        		}
        	},
        	{
        		data: 'status', className: 'text-center',
        		render: function(data) {
        			if(data == '3') return '<span class="badge badge-success"><?php echo lang('done') ?></sapan>';
        			else if(data == '2') return '<span class="badge badge-warning"><?php echo lang('partial') ?></sapan>';
        			else if(data == '1') return '<span class="badge badge-danger"><?php echo lang('pending') ?></sapan>';
        		}
        	},
          {
            data: 'id', width: 40, orderable: false,
            render: function(data,type,row) { 
              var tombol = '';
           
              if (row.stts_kas != 1){
                  tombol += ` <a href="`+base_url+`edit/`+data+`" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Ubah</a>
                        <a href="javascript:deleteData('` + data+ `')" class="dropdown-item delete"><i class="fas fa-trash"></i> Hapus</a>`;
              }

              var aksi = `
                  <div class="list-icons"> 
                    <div class="dropdown"> 
                      <a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
                      <div class="dropdown-menu dropdown-menu-right">
                        `+tombol+`
                        <a class="dropdown-item" href="`+base_url+`printpdf/`+data+`"><i class="fas fa-print"></i> Cetak</a>
                      </div> 
                    </div> 
                  </div>`;
              return aksi;
            }
          },

        ],
        footerCallback: function ( row, data, start, end, display ) {

            var api = this.api(), data;
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\Rp.]/g, '').replace(/,00/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            total = api.column(10).data().reduce( function (a, b) {
                return intVal(a) + intVal(b); 
            }, 0 );
           
            $('#total').html(formatRupiah(String(total), 'Rp. '));
        }
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
