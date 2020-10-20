<div class="page-header page-header-light">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4><i class="icon-info22 mr-2"></i> <span class="font-weight-semibold">{title}</span></h4>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
		<div class="header-elements d-none">
			<div class="d-flex justify-content-center">
				<div class="btn-group">
					<a href="{site_url}Pengeluaran_kas_kecil/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a> &nbsp;
					<div class="btn-group"> 
						<?php $currentURL = current_url(); ?>
						<?php $params = $_SERVER['QUERY_STRING']; ?>
						<?php $fullURL = $currentURL . '/printpdf?' . $params; ?>
						<?php $fullURLChange = $fullURL ?>
						<?php if ($this->uri->segment(2)): ?>
							<?php $fullURL = $currentURL . '?' . $params; ?>
							<?php $fullURLChange = str_replace('index', 'printpdf', $fullURL) ?>
						<?php endif ?>
						<a href="<?php echo $fullURLChange ?>" target="_blank" class="btn btn-warning"><?php echo lang('print') ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="m-3">
		<form action="{site_url}Pengeluaran_kas_kecil/index" id="form1" method="GET">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo lang('start_date') ?>:</label>
						<input type="text" class="form-control datepicker" name="tanggalawal" required value="{tanggalawal}">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo lang('end_date') ?>:</label>
						<input type="text" class="form-control datepicker" name="tanggalakhir" required value="{tanggalakhir}">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="text-right">
						<button type="submit" class="btn-block btn bg-success"><?php echo lang('search') ?></button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="content">
		<div class="card">
			<div class="table-responsive">
				<table class="table table-striped index_datatable">
					<thead class="{bg_header}">
						<tr>
							<th><?php echo lang('id') ?></th>
							<th><?php echo lang('no_receipt') ?></th>
							<th><?php echo lang('information') ?></th>
							<th><?php echo lang('date') ?></th>
							<th><?php echo lang('company') ?></th>
							<th><?php echo lang('Departemen') ?></th>
							<th><?php echo lang('nominal') ?></th>
							<th><?php echo lang('Status') ?></th>
							<th><?php echo lang('action') ?></th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
</div>

<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script src="{assets_path}global/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript">
	var base_url = '{site_url}Pengeluaran_kas_kecil/';

	var table = $('.index_datatable').DataTable({
		ajax: {
			url: base_url + 'index_datatable',
			type: 'post',
			data : {tanggalawal: '{tanggalawal}', tanggalakhir: '{tanggalakhir}'},
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
        		data: 'nokwitansi', 
        		render: function(data,type,row) {
        			var link = base_url + 'detail/' + row.id;
        			return '<a href="'+link+'" class="badge badge-info">'+data+'</a>';
        		}
        	},
        	{data: 'keterangan'},
        	{data: 'tanggal'},
        	{data: 'nama_perusahaan'},
        	{data: 'nama'},
        	{
        		data: 'subtotal',
        		render: function(data,type,row) {
        			var nominal=`<div class="text-right">`+formatRupiah(data, 'Rp. ')+`,00</div>`;
        			return nominal;
        		}
        	},
        	{
				data: 'status',
        		render: function(data) {
        			if(data == '1') return '<span class="badge badge-success"><?php echo lang('Validasi') ?></sapan>';
        			else return '<span class="badge badge-danger"><?php echo lang('pending') ?></sapan>';
        		}
			},
        	{
        		data: 'id', data: 'status', width: 100, orderable: false,
        		render: function(data,type,row) {
        			if (row.status != '1')
        			{
        				var aksi = `<div class="list-icons"> 
        					<div class="dropdown"> 
        					<a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="icon-menu9"></i> </a> 
        					<div class="dropdown-menu dropdown-menu-right">`;
        				aksi += `<a href="` + base_url + `validasi/` + row.id + `" class="dropdown-item"><i class="icon-check"></i> <?php echo lang('Validasi') ?></a>
        				<a href="javascript:deleteData(`+row.id+`)" class="dropdown-item delete"><i class="icon-trash"></i> <?php echo lang('delete') ?></a>`;
        				aksi += `</div> </div> </div>`;
        			} else{
        				aksi='';
        			}

        			
        			return aksi;
        		}
        	}
        ]
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

	function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split           = number_string.split(','),
            sisa             = split[0].length % 3,
            rupiah             = split[0].substr(0, sisa),
            ribuan             = split[0].substr(sisa).match(/\d{3}/gi);
 
            // tambahkan titik jika yang di input sudah menjadi angka satuan ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
 
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
</script>