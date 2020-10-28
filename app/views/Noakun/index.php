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
              <a href="{site_url}pajak/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  + Import
              </button>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-xs table-striped table-borderless table-hover index_datatable">
                  <thead>
                    <tr class="table-active">
                      <th>ID</th>
                      <th><?php echo lang('code') ?></th>
                      <th><?php echo lang('name') ?></th>
                      <th><?php echo lang('Kategori Akun') ?></th>
                      <th><?php echo lang('balance') ?></th>
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

<script type="text/javascript">
	var base_url = '{site_url}noakun/';
	var table = $('.index_datatable').DataTable({
		ajax: {
			url: base_url + 'index_datatable',
			type: 'post',
		},
		stateSave: false,
		order: [[5,'ASC']],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"p>',
        language: {
            search: '<span></span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
        },
        columns: [
          {data: 'noakun', visible: false},
          {
            data: 'akunno', width: '100px',
            render: function(data) {
              return '<span class="btn btn-sm btn-info">'+data+'</span>';
            }
          },
          {
            data: 'namaakun',
            render: function(data,type,row) {
              return '<a href="'+base_url+'detail/'+row.idakun+'">'+data+'</a>';
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