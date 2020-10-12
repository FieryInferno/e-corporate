

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
			  <a href="{site_url}kas_bank/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
			</div>
              <div class="card-body">
			  <table class="table table-striped index_datatable" onload="return data()">
                <!-- <table class="table table-bordered table-striped index_datatable"> -->
                  <thead>
				  <tr>
				  <th><?php echo lang('id') ?></th>
					<th><?php echo lang('number') ?></th>
					<th><?php echo lang('date') ?></th>
					<th><?php echo lang('reception') ?></th>
					<th><?php echo lang('spending') ?></th>
					<th><?php echo lang('Aksi') ?></th>
				</tr>
                  </thead>
                  <tbody>                          
                  </tbody>
				  <tfoot class="bg-light">
                <tr>
                    <th class="text-right" colspan="3"><?php echo lang('total') ?></th>
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
    </section>
  </div>

<script type="text/javascript">
	var base_url = '{site_url}kas_bank/';
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
				data: 'nomor_kas_bank', 
				render: function(data,type,row) {
					var link = base_url + 'detail/' + row.id;
					return '<a href="'+link+'" class="badge badge-info">'+data+'</a>';
				}
			},
			{data: 'tanggal'},
			{
				data: 'penerimaan',
				render: function(data,type,row) {
					var penerimaan=`<div class="center">`+formatRupiah(data, 'Rp. ')+`,00</div>`;
					return penerimaan;
				}
			},
			{
				data: 'pengeluaran',
				render: function(data,type,row) {
					var pengeluaran=`<div class="text-center">`+formatRupiah(data, 'Rp. ')+`,00</div>`;
					return pengeluaran;
				}
			},
			{
				data: 'id', width: 100, orderable: false,
				render: function(data,type,row) {
					var aksi = `
								<a class="btn btn-info btn-sm" href="${base_url+'edit/'+data}">
									<i class="fas fa-pencil-alt"></i>                           
								</a>
								<a class="btn btn-danger btn-sm" href="javascript:deleteData('`+data+`')">
									<i class="fas fa-trash"></i>                           
								</a>               
							`;
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

	$(document).ready(function(){
     
            $.ajax({
                url: base_url + 'get_nominal_kasbank',
                method: 'post',
                datatype: 'json',

                success: function(data) {
                	$('a1').append(formatRupiah(data.penerimaan, 'Rp. ')+',00');
                	$('a2').append(formatRupiah(data.pengeluaran, 'Rp. ')+',00');
                }
            })
    })
</script>
