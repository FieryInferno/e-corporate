<?php defined('BASEPATH') OR exit('No direct script access allowed');

/** 
* =================================================
* @package	CGC (CODEIGNITER GENERATE CRUD)
* @author	isyanto.id@gmail.com
* @link	https://isyanto.com
* @since	Version 1.0.0
* @filesource
* ================================================= 
*/

class Generate_crud extends User_Controller {
	
	public function __construct() {
		parent::__construct();
		if(get_user('permissionid') == '2') redirect('Forbidden','refresh');
		$this->load->helper(array('file','string','html'));
	}

	public function testing() {
		echo date("Y-m-d H:i").":59";
	}

	public function index() {
		$data['title'] = lang('generate_crud');
		$data['content'] = 'Generate_crud/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function list_tables() {
		$list_tables = $this->db->list_tables();
		foreach($list_tables as $list) {
			$item = array();
			$item['id'] = $list;
			$item['text'] = $list;
			$data[] = $item;
		}
		$data = array('results' => $data);
		$this->output->set_content_type('application/json')->set_output(json_encode($data, JSON_PRETTY_PRINT));	
	}

	public function generate() {
		$nama = strtolower($this->input->post('nama'));
		$table = $this->input->post('table');

		$_generate_controller = $this->_generate_controller($nama, $table);
		if($_generate_controller) {
			$data['status'] = 'error';
			$data['message'] = 'generate controller error!';
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
			return;
		}
		$_generate_model = $this->_generate_model($nama, $table);
		if($_generate_model) {
			$data['status'] = 'error';
			$data['message'] = 'generate model error!';
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
			return;
		}
		$_generate_dir_views = $this->_generate_dir_views($nama);
		if($_generate_dir_views) {
			$data['status'] = 'error';
			$data['message'] = 'generate directory views error!';
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
			return;
		}
		$_generate_edit = $this->_generate_edit($nama);
		if($_generate_edit) {
			$data['status'] = 'error';
			$data['message'] = 'generate edit error!';
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
			return;
		}
		$_generate_index = $this->_generate_index($nama);
		if($_generate_index) {
			$data['status'] = 'error';
			$data['message'] = 'generate index error!';
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
			return;
		}
		$_generate_create = $this->_generate_create($nama);
		if($_generate_create) {
			$data['status'] = 'error';
			$data['message'] = 'generate create error!';
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
			return;
		}
		$data['status'] = 'success';
		$data['message'] = 'generate success!';
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	private function _generate_edit($nama) {
		$nama = strtolower($nama);

$txt = <<<EOT
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-info22 mr-2"></i> <span class="font-weight-semibold">{title}</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <div class="card">
        <div class="card-header {bg_header}">
            <div class="header-elements-inline">
                <h5 class="card-title">{subtitle}</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form action="javascript:save()" id="form1">
                        <div class="form-group">
                            <label><?php echo lang('name') ?>:</label>
                            <input type="text" class="form-control" name="nama" required value="{nama}">
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('select') ?>:</label>
                            <select class="form-control selectid" name="selectid" required></select>
                        </div>
                        <div class="text-right">
                            <a href="{site_url}$nama" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                            <button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script type="text/javascript">
    var base_url = '{site_url}$nama/';
    \$(document).ready(function(){
    	ajax_select({ id: '.idhakakses', url: base_url + 'select2_mpegawaihakakses', selected: { id: null } });
        \$('.jenkel').select2({
            placeholder: 'Select an Option',
            data: [
                {id: 'LAKI-LAKI', text: 'LAKI-LAKI'},
                {id: 'PEREMPUAN', text: 'PEREMPUAN'},
            ]
        }).val(null).trigger('change');
    })    
    function save() {
        var form = \$('#form1')[0];
        var formData = new FormData(form);
        \$.ajax({
            url: base_url + 'save/{id}',
            dataType: 'json',
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                pageBlock();
            },
            afterSend: function() {
                unpageBlock();
            },
            success: function(data) {
                if(data.status == 'success') {
                    NotifySuccess(data.message)
                    redirect(base_url)
                } else {
                    NotifyError(data.message)
                }
            },
            error: function() {
                NotifyError('<?php echo lang('internal_server_error') ?>');
            }
        })
    }
</script>
EOT;

		$filename = FCPATH.'app/views/'.ucfirst($nama).'/edit.php';
		$write = write_file($filename, $txt);
		chmod($filename, 0777);

	}	

	private function _generate_create($nama) {
		$nama = strtolower($nama);

$txt = <<<EOT
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-info22 mr-2"></i> <span class="font-weight-semibold">{title}</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <div class="card">
        <div class="card-header {bg_header}">
            <div class="header-elements-inline">
                <h5 class="card-title">{subtitle}</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
            	<div class="col-md-6">
    				<form action="javascript:save()" id="form1">
    					<div class="form-group">
    						<label><?php echo lang('name') ?>:</label>
    						<input type="text" class="form-control" name="nama" required>
    					</div>
                        <div class="form-group">
                            <label><?php echo lang('select') ?>:</label>
                            <select class="form-control selectid" name="selectid" required></select>
                        </div>
    					<div class="text-right">
    						<a href="{site_url}$nama" class="btn bg-danger"><?php echo lang('cancel') ?></a>
    						<button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
    					</div>
    				</form>
                </div>
            </div>
    	</div>
    </div>
</div>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script type="text/javascript">
	var base_url = '{site_url}$nama/';
    \$(document).ready(function(){
    	ajax_select({ id: '.idhakakses', url: base_url + 'select2_mpegawaihakakses', selected: { id: null } });
        \$('.jenkel').select2({
            placeholder: 'Select an Option',
            data: [
                {id: 'LAKI-LAKI', text: 'LAKI-LAKI'},
                {id: 'PEREMPUAN', text: 'PEREMPUAN'},
            ]
        }).val(null).trigger('change');
    })
    function save() {
    	var form = \$('#form1')[0];
    	var formData = new FormData(form);
    	\$.ajax({
    		url: base_url + 'save',
    		dataType: 'json',
    		method: 'post',
    		data: formData,
    		contentType: false,
    		processData: false,
    		beforeSend: function() {
    			pageBlock();
    		},
            afterSend: function() {
                unpageBlock();
            },
    		success: function(data) {
    			if(data.status == 'success') {
    				NotifySuccess(data.message)
                    redirect(base_url);
    			} else {
    				NotifyError(data.message)
    			}
    		},
    		error: function() {
    			NotifyError('<?php echo lang('internal_server_error') ?>');
    		}
    	})
    }
</script>
EOT;

		$filename = FCPATH.'app/views/'.ucfirst($nama).'/create.php';
		$write = write_file($filename, $txt);
		chmod($filename, 0777);
	}

	private function _generate_index($nama) {
		$nama = strtolower($nama);
$txt = <<<EOT
<div class="page-header page-header-light">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4><i class="icon-info22 mr-2"></i> <span class="font-weight-semibold">{title}</span></h4>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>

		<div class="header-elements d-none">
			<div class="d-flex justify-content-center">
				<a href="{site_url}$nama/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
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
					<th><?php echo lang('name') ?></th>
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
	var base_url = '{site_url}$nama/';
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
</script>
EOT;

		$filename = FCPATH.'app/views/'.ucfirst($nama).'/index.php';
		$write = write_file($filename, $txt);
		chmod($filename, 0777);
	}

	private function _generate_dir_views($nama) {
		$nama = ucfirst($nama);
		mkdir(FCPATH.'app/views/'.$nama, 0777, true);
	}

	private function _generate_model($nama, $table) {
		$namacontroller = ucfirst($nama);
		$namamodel = $namacontroller.'_model';

$txt = <<<EOT
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** 
* =================================================
* @package	CGC (CODEIGNITER GENERATE CRUD)
* @author	isyanto.id@gmail.com
* @link	https://isyanto.com
* @since	Version 1.0.0
* @filesource
* ================================================= 
*/


EOT;

$filename = FCPATH.'app/models/'.$namamodel.'.php';
$write = write_file($filename, $txt);

$txt = <<<EOT

class $namamodel extends CI_Model {

	public function save() {
		\$id = \$this->uri->segment(3);
		if(\$id) {
			foreach(\$this->input->post() as \$key => \$val) \$this->db->set(\$key,\$val);
			\$this->db->set('uby',get_user('username'));
			\$this->db->set('udate',date('Y-m-d H:i:s'));
			\$this->db->where('id', \$id);
			\$update = \$this->db->update('$table');
			if(\$update) {
				\$data['status'] = 'success';
				\$data['message'] = lang('update_success_message');
			} else {
				\$data['status'] = 'error';
				\$data['message'] = lang('update_error_message');
			}
		} else {
			foreach(\$this->input->post() as \$key => \$val) \$this->db->set(\$key,\$val);
			\$this->db->set('cby',get_user('username'));
			\$this->db->set('cdate',date('Y-m-d H:i:s'));
			\$insert = \$this->db->insert('$table');
			if(\$insert) {
				\$data['status'] = 'success';
				\$data['message'] = lang('save_success_message');
			} else {
				\$data['status'] = 'error';
				\$data['message'] = lang('save_error_message');
			}
		}
		return \$this->output->set_content_type('application/json')->set_output(json_encode(\$data));
	}

	public function delete() {
		\$id = \$this->uri->segment(3);
		\$this->db->set('stdel','1');
		\$this->db->where('id', \$id);
		\$update = \$this->db->update('$table');
		if(\$update) {
			\$data['status'] = 'success';
			\$data['message'] = lang('delete_success_message');
		} else {
			\$data['status'] = 'error';
			\$data['message'] = lang('delete_error_message');
		}
		return \$this->output->set_content_type('application/json')->set_output(json_encode(\$data));
	}
}

EOT;
		file_put_contents($filename, $txt.PHP_EOL, FILE_APPEND | LOCK_EX);
		chmod($filename, 0777);
	}

	private function _generate_controller($nama, $table) {
		$namacontroller = ucfirst($nama);
		$namamodel = $namacontroller.'_model';


$txt = <<<EOT
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** 
* =================================================
* @package	CGC (CODEIGNITER GENERATE CRUD)
* @author	isyanto.id@gmail.com
* @link	https://isyanto.com
* @since	Version 1.0.0
* @filesource
* ================================================= 
*/


EOT;

$filename = FCPATH.'app/controllers/'.$namacontroller.'.php';
$write = write_file($filename, $txt);


$txt = <<<EOT

class $namacontroller extends User_Controller {

	public function __construct() {
		parent::__construct();
		\$this->load->model('$namamodel','model');
	}

	public function index() {
		\$data['title'] = lang('$nama');
		\$data['subtitle'] = lang('list');
		\$data['content'] = '$namacontroller/index';
		\$data = array_merge(\$data,path_info());
		\$this->parser->parse('default',\$data);
	}

	public function index_datatable() {
		\$this->load->library('Datatables');
		\$this->datatables->select('$table.*');
		\$this->datatables->where('$table.stdel', '0');
		\$this->datatables->from('$table');
		return print_r(\$this->datatables->generate());
	}

	public function create() {
		\$data['title'] = lang('$nama');
		\$data['subtitle'] = lang('add_new');
		\$data['content'] = '$namacontroller/create';
		\$data = array_merge(\$data,path_info());
		\$this->parser->parse('default',\$data);
	}

	public function edit(\$id = null) {
		if(\$id) {
			\$data = get_by_id('id',\$id,'$table');
			if(\$data) {
				\$data['title'] = lang('$nama');
				\$data['subtitle'] = lang('edit');
				\$data['content'] = '$namacontroller/edit';
				\$data = array_merge(\$data,path_info());
				\$this->parser->parse('default',\$data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function save() {
		\$this->model->save();
	}

	public function delete() {
		\$this->model->delete();
	}

	// additional
	public function select2_mpegawaihakakses(\$id = null) {
		\$term = \$this->input->get('q');
		if(\$id) {
			\$this->db->select('mpegawaihakakses.id, mpegawaihakakses.nama as text');
			\$data = \$this->db->where('id', \$id)->get('mpegawaihakakses')->row_array();
			\$this->output->set_content_type('application/json')->set_output(json_encode(\$data));
		} else {
			\$this->db->select('mpegawaihakakses.id, mpegawaihakakses.nama as text');
			\$this->db->where('mpegawaihakakses.stdel', '0');
			\$this->db->limit(10);
			if(\$term) \$this->db->like('mpegawaihakakses', \$term);
			\$data = \$this->db->get('mpegawaihakakses')->result_array();
			\$this->output->set_content_type('application/json')->set_output(json_encode(\$data));
		}
	}
}

EOT;
		file_put_contents($filename, $txt.PHP_EOL, FILE_APPEND | LOCK_EX);
		chmod($filename, 0777);
	}
}

/** 
* =================================================
* @package	CGC (CODEIGNITER GENERATE CRUD)
* @author	isyanto.id@gmail.com
* @link	https://isyanto.com
* @since	Version 1.0.0
* @filesource
* ================================================= 
*/