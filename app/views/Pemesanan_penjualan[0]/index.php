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
			  <a href="{site_url}pemesanan_penjualan/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
			</div>
              <div class="card-body">
                <table class="table table-bordered table-striped index_datatable">
                  <thead>
				  <tr>
				  <th>ID</th>
					<th><?php echo lang('notrans') ?></th>
					<th><?php echo lang('note') ?></th>
					<th><?php echo lang('date') ?></th>
					<th><?php echo lang('supplier') ?></th>
					<th><?php echo lang('warehouse') ?></th>
					<th>Nominal Total</th>
					<th><?php echo lang('status') ?></th>
					<th><?php echo lang('Aksi') ?></th>
				</tr>
                  </thead>
                  <tbody>                          
                  </tbody>
                  <tfoot>                 
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<script type="text/javascript">
	var base_url = '{site_url}pemesanan_penjualan/';
	var table = $('.index_datatable').DataTable({
		ajax: {
			url: base_url + 'index_datatable',
			type: 'post',
		},
		pageLength: 100,
		stateSave: false,
		autoWidth: false,
		order: [[0,'desc'],[7,'desc']],
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
			{data: 'catatan', orderable: false, width: '200px'},
			{data: 'tanggal'},
			{data: 'supplier'},
			{data: 'gudang'},
			{	
				data: 'total',
				render: function(data,type,row) {
					var total=`<div class="text-right">`+formatRupiah(data, 'Rp. ')+`</div>`;
					return total;
				}
			},
			{
				data: 'status',
				render: function(data) {
					if(data == '3') return '<span class="badge badge-success"><?php echo lang('done') ?></sapan>';
					else if(data == '2') return '<span class="badge badge-warning"><?php echo lang('partial') ?></sapan>';
					else  return '<span class="badge badge-danger"><?php echo lang('pending') ?></sapan>';
				}
			},
			{
				data: 'id', width: 101, orderable: false,
				render: function(data,type,row) { 
					let aksi	= ``;
					if (row.status == '4'){
						aksi += `<a href="`+base_url+`edit/`+data+`" class="btn btn-info btn-sm" title="edit"><i class="fas fa-pencil-alt"></i></a>`; 
					}
					aksi += ` <a href="javascript:deleteData('`+data+`')" class="btn btn-danger btn-sm" title="hapus"><i class="fas fa-trash"></i></a> <a href="javascript:cetakdata('`+data+`')" class="btn btn-success btn-sm" title="cetak"><i class="fas fa-print"></i></a>`;
					return aksi;
				}
			},
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
