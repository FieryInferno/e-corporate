<!-- <div class="page-header page-header-light">
<div class="page-header-content header-elements-md-inline">
    <div class="page-title d-flex">
        <h4><i class="icon-info22 mr-2"></i> <span class="font-weight-semibold">{title}</span></h4>
        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
    </div>

    <div class="header-elements d-none">
        <div class="d-flex justify-content-center">
            <a href="{site_url}departemen/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
        </div>
    </div>
</div>
</div>
<div class="content">
<div class="card">
    <div class="card-header {bg_header}">
        <h5 class="card-title">{subtitle}</h5>
    </div>
    <table class="table table-striped index_datatable">
        <thead class="{bg_header}">
            <tr>
                <th>ID</th>
                <th><?php echo lang('') ?></th>
                <th><?php echo lang('perusahaan') ?></th>
                <th><?php echo lang('Nama Departemen') ?></th>
                <th><?php echo lang('Pejabat') ?></th>
                <th><?php echo lang('Jabatan') ?></th>
                <th class="text-center"><?php echo lang('action') ?></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
</div>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript">
var base_url = '{site_url}departemen/';
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
        {data: 'id_perusahaan', visible: false},
        {data: 'nama_perusahaan'},
        {data: 'nama'},
        {data: 'pejabat'},
        {data: 'jabatan'},
        {
            data: 'id', width: 100, orderable: false,
            render: function(data,type,row) {
                var aksi = `<div class="list-icons"> 
                <div class="dropdown"> 
                <a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="icon-menu9"></i> </a> 
                <div class="dropdown-menu dropdown-menu-right"> 
                <a href="`+base_url+`edit/`+data+`" class="dropdown-item"><i class="icon-pencil"></i> <?php echo lang('edit') ?></a> 
                <a href="javascript:deleteData(`+data+`)" class="dropdown-item delete"><i class="icon-trash"></i> <?php echo lang('delete') ?></a>`;
                aksi += `</div> </div> </div>`;
                return aksi;
            }
        }
    ]
});

function deleteData(id) {
    var notice = new PNotify({
        title: '<?php echo lang('confirm') ?>',
        text: '<p><?php echo lang('confirm_delete') ?></p>',
        hide: false,
        type: 'warning',
        confirm: {
            confirm: true,
            buttons: [
                { text: 'Yes', addClass: 'btn btn-sm btn-primary' },
                { addClass: 'btn btn-sm btn-link' }
            ]
        },
        buttons: { closer: false, sticker: false }
    })
    notice.get().on('pnotify.confirm', function() {
        $.ajax({ url: base_url + 'delete/'+id })
        setTimeout(function() { table.ajax.reload() }, 100);
    })
}
</script> -->

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
			  <a href="{site_url}departemen/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
			</div>
              <div class="card-body">
                <table class="table table-bordered table-striped index_datatable">
                  <thead>
				  <tr>
				  <th>ID</th>
					<th><?php echo lang('name') ?></th>
					<th class="text-center"><?php echo lang('action') ?></th>
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
<!-- <script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script> -->

<script type="text/javascript">
	var base_url = '{site_url}kategori/';
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
        	{data: 'nama'},
        	{
        		data: 'id', width: 100, orderable: false,
        		render: function(data,type,row) {
        			var aksi = `   <a class="btn btn-info btn-sm" href="`+base_url+`edit/`+data+`">
                              <i class="fas fa-pencil-alt"></i>                             
                          </a>
                          <a class="btn btn-danger btn-sm" href="javascript:deleteData(`+data+`)">
                              <i class="fas fa-trash"></i>                           
                          </a>       `;
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
</script>