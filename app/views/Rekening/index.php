

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
				<a href="{site_url}item/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
			</div>
              <div class="card-body">
                <table class="table table-bordered table-striped index_datatable">
                  <thead>
				  <tr>
				  <tr>
                  <th>ID</th>
                <th><?php echo lang('Perusahaan') ?></th>
                <th><?php echo lang('Nama Bank') ?></th>
                <th><?php echo lang('Rek Bank') ?></th>
                <th><?php echo lang('No Akun') ?></th>
                <th class="text-center"><?php echo lang('action') ?></th>
				</tr>
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
<!-- <script type="text/javascript">
var base_url = '{site_url}perusahaan/';
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
        {data: 'idperusahaan', visible: false},
        {data: 'kode'},
        {data: 'nama_perusahaan'},
        {
            data: 'idperusahaan', width: 100, orderable: false,
            render: function(data,type,row) {
                var aksi = ` <a class="btn btn-info btn-sm" href="`+base_url+`edit/`+data+`">
                              <i class="fas fa-pencil-alt"></i>                             
                          </a>
                          <a class="btn btn-danger btn-sm" href="javascript:deleteData(`+data+`)">
                              <i class="fas fa-trash"></i>                           
                          </a>               
							`;
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

<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript">
var base_url = '{site_url}rekening/';
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
        {data: 'nama_perusahaan'},
        {data: 'nama'},
        {data: 'norek'},
        {data: 'akunno'},
        {
            data: 'id', width: 100, orderable: false,
            render: function(data,type,row) {
                var aksi = ` <a class="btn btn-info btn-sm" href="`+base_url+`edit/`+data+`">
                              <i class="fas fa-pencil-alt"></i>                             
                          </a>
                          <a class="btn btn-danger btn-sm" href="javascript:deleteData(`+data+`)">
                              <i class="fas fa-trash"></i>                           
                          </a>               
							`;
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
</script>