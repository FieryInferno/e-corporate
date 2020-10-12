<div class="page-header page-header-light">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4><i class="icon-info22 mr-2"></i> <span class="font-weight-semibold">{title}</span></h4>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>

		<div class="header-elements d-none">
			<div class="d-flex justify-content-center">
				<a href="{site_url}stokopname/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
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
					<th><?php echo lang('date') ?></th>
					<th><?php echo lang('code') ?></th>
					<th><?php echo lang('item') ?></th>
					<th><?php echo lang('Jumlah_Sistem') ?></th>
					<th><?php echo lang('Jumlah_Sebenarnya') ?></th>
					<th><?php echo lang('Selisih') ?></th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript">
	var base_url = '{site_url}stokopname/';
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
        columnDefs: [
        	{targets: [4,5,6], className: 'text-right'}
        ],
        columns: [
        	{data: 'id', visible: false},
        	{data: 'tanggal'},
        	{
        		data: 'kodeitem',
        		render: function(data,type,row) {
        			return '<span class="badge badge-info">'+data+'</span>';
        		}
        	},
        	{data: 'item'},
        	{data: 'jumlahsistem'},
        	{data: 'jumlahsebenarnya'},
        	{data: 'selisih'}
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