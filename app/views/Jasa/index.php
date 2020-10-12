<div class="page-header page-header-light">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4><i class="icon-info22 mr-2"></i> <span class="font-weight-semibold">{title}</span></h4>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>

		<div class="header-elements d-none">
			<div class="d-flex justify-content-center">
				<a href="{site_url}jasa/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
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
					<th>Kode</th>
					<th>Nama</th>
					<th class="text-center">Aksi</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript">
	var base_url = '{site_url}jasa/';
	var table = $('.index_datatable').DataTable({
		ajax: {
			url: base_url + 'index_datatable',
			type: 'post',
		},
		pageLength: 100,
		stateSave: false,
		autoWidth: false,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"p>',
        language: {
            search: '<span></span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
        },
        order: [[0, 'DESC']],
        columns: [
        	{data: 'id', visible: false},
        	{
                data: 'kode',
        		render: function(data,type,row) {
        			return '<label class="badge badge-info">'+data+'</label>';
        		}
            },
        	{data: 'nama'},
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
	        title: 'Apakah Anda Yakin?',
	        text: '<p>Data yang sudah dihapus tidak dapat dikembalikan.</p>',
	        hide: false,
	        type: 'warning',
	        confirm: {
	            confirm: true,
	            buttons: [
	                { text: 'Ya, Hapus', addClass: 'btn btn-sm btn-primary' },
	                { text: 'Tidak', addClass: 'btn btn-sm btn-danger' },
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