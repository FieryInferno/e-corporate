<div class="mb-3">
    <a href="{site_url}mcategories/create" class="btn bg-pink"><?php echo lang('add_new') ?></a>
</div>
<div class="card">
	<div class="card-header header-elements-inline bg-indigo">
		<h5 class="card-title">{subtitle}</h5>
	</div>
	<table class="table table-striped index_datatable " id="index_datatable">
		<thead class="bg-indigo">
			<tr>
				<th>ID</th>
				<th>NO</th>
				<th><?php echo lang('code') ?></th>
				<th><?php echo lang('name') ?></th>
				<th class="text-center"><?php echo lang('action') ?></th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript">
	var base_url = '{site_url}mcategories/';
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
        	{data: 'nomor', orderable: false},
        	{
        		data: 'code',
        		render: function(data) {
        			return '<span class="badge bg-pink">'+data+'</span>';
        		}
        	},
        	{data: 'name'},
        	{
        		data: 'id',
        		render: function(data,type,row) {
        			var aksi = `<div class="list-icons"> 
        			<div class="dropdown"> 
        			<a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="icon-menu9"></i> </a> 
        			<div class="dropdown-menu dropdown-menu-right"> 
        			<a href="`+base_url+`edit/`+data+`" class="dropdown-item edit"><i class="icon-pencil"></i> Edit</a> 
        			<a href="javascript:deleteData(`+data+`)" class="dropdown-item delete"><i class="icon-trash"></i> Delete</a>`;
        			aksi += `</div> </div> </div>`;
        			return aksi;
        		}
        	}
        ],
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        	var index = iDisplayIndex + 1;
        	$('td:eq(0)',nRow).html(index);
        	return nRow;
        }
	});

	function deleteData(id) {
	    var notice = new PNotify({
	        title: 'Confirmation',
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