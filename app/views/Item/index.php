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
					<th>ID</th>
					<th><?php echo lang('Image') ?></th>
					<th><?php echo lang('code') ?></th>
					<th><?php echo lang('name') ?></th>
					<th><?php echo lang('unit') ?></th>
					<th><?php echo lang('category') ?></th>
					<th><?php echo lang('stock') ?></th>
					<th><?php echo lang('Hrg Beli Terakhir') ?></th>
					<th><?php echo lang('Total Persediaan') ?></th>
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
	var base_url = '{site_url}item/';
	var table = $('.index_datatable').DataTable({
		ajax: {
			url: base_url + 'index_datatable',
			type: 'post',
		},
		paging:true,
		pageLength: 1000,
		stateSave: true,
		autoWidth: false,
		responsive: true,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"p>',
        language: {
            search: '<span></span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
        },
        columns: [
        	{data: 'id', visible: false},
        	{
        		data: 'gambar',
        		render: function(data) {
        			if(data) return '<img src="{base_url}uploads/item/'+data+'" width="60" height="60">';
        			else return '<img src="{base_url}uploads/default.png" width="60" height="60">';
        		}
        	},
        	{
        		data: 'kode',
        		render: function(data,type,row) {
        			var link = base_url + 'detail/' + row.id;
        			return '<span class="badge badge-info">'+data+'</span>';
        		}
        	},
        	{data: 'nama'},
        	{data: 'satuan'},
        	{data: 'kategori'},
        	{data: 'stok', className: 'text-right', orderable: false},
        	{
        		data: 'hargabeliterakhir', className: 'text-right', orderable: false,
        		render: function(data, type, row) {
        			if(data > 0) return numeral(data).format();
        			else return numeral(row.hargabeli).format();
        		}
        	},
        	{
        		data: 'totalpersediaan', className: 'text-right', orderable: false,
        		render: function(data, type, row) {
        			if(data) return numeral(data).format();
        			else return numeral(row.hargabeli).format();
        		}
        	},
        	{
        		data: 'id', width: 100, orderable: false, className: 'text-center',
        		render: function(data,type,row) {
        			var aksi = `
                          <a class="btn btn-info btn-sm" href="`+base_url+`edit/`+data+`">
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