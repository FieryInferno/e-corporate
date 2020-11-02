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
            <div class="m-3">
                <form action="{site_url}utang/index" id="form1" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?php echo lang('Kontak') ?>:</label>
                                <select class="form-control kontakid" name="kontakid"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Usia Hutang : </label>
                                <select class="form-control" name="usiaHutang">
                                    <option value="" disabled selected>Pilih Usia Utang</option>
                                    <option value="kurang30">Kurang Dari 30 Hari</option>
                                    <option value="30">30 Hari</option>
                                    <option value="lebih30">Lebih Dari 30 Hari</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Perusahaan:</label>
                                <select class="form-control perusahaanid" name="perusahaanid"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><?php echo lang('start_date') ?>:</label>
                                <input type="date" class="form-control datepicker" name="tanggalawal">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><?php echo lang('end_date') ?>:</label>
                                <input type="date" class="form-control datepicker" name="tanggalakhir">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-right">
                                <button type="submit" class="btn-block btn bg-success"><?php echo lang('search') ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">         
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-xs table-striped table-borderless table-hover index_datatable">
                                    <thead>
                                        <tr class="table-active">
                                            <th><?php echo lang('Tanggal') ?></th>
                                            <th>Tgl J/T</th>
                                            <th><?php echo lang('No Invoice') ?></th>
                                            <th><?php echo lang('Keterangan') ?></th>
                                            <th><?php echo lang('Supplier') ?></th>
                                            <th class="text-center"><?php echo lang('Utang') ?></th>
                                            <th class="text-center"><?php echo lang('Sudah Dibayar') ?></th>
                                            <th class="text-center"><?php echo lang('Sisa Utang') ?></th>
                                            <th class="text-center">Usia Hutang</th>
                                            <th class="text-right"><?php echo lang('action') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($utang as $key => $value) {
                                                foreach ($value as $key) { ?>
                                                    <tr>
                                                        <td><?= $key['tanggal']; ?></td>
                                                        <td><?= $key['tanggaltempo']; ?></td>
                                                        <td><?= $key['notrans']; ?></td>
                                                        <td><?= $key['catatan']; ?></td>
                                                        <td><?= $key['rekanan']; ?></td>
                                                        <td><?= number_format($key['total'],2,',','.'); ?></td>
                                                        <td><?= isset($key['totaldibayar']) ? number_format($key['totaldibayar'],2,',','.') : '' ; ?></td>
                                                        <td><?= isset($key['sisaUtang']) ? number_format($key['sisaUtang'],2,',','.') : '' ; ?></td>
                                                        <td></td>
                                                        <td>
                                                            <div class="list-icons"> 
                                                                <div class="dropdown"> 
                                                                    <a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
                                                                    <div class="dropdown-menu dropdown-menu-right">

                                                                    </div> 
                                                                </div> 
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
	var base_url = '{site_url}utang/';
	ajax_select({ id: '.kontakid', url: base_url + 'select2_kontak', selected: { id: '{kontakid}' } });
    ajax_select({ 
        id          : '.perusahaanid', 
        url         : '{site_url}perusahaan/select2', 
        selected    : { 
            id: '{perusahaanid}' 
        } 
    });
    $('.index_datatable').DataTable();
    // var table = $('.index_datatable').DataTable({
	// 	ajax: {
	// 		url: base_url + 'index_datatable',
	// 		type: 'post',
	// 	},
	// 	autoWidth: false,
	// 	dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"p>',
	// 	language: {
	// 		search: '<span></span> _INPUT_',
	// 		searchPlaceholder: 'Type to filter...',
	// 	},
	// 	columns: [
	// 		{data   : 'tanggal'},
	// 		{data   : 'tanggaltempo'},
	// 		{data   : 'notrans'}, 
    //         {data   : 'catatan'}, 
	// 		{data	: 'rekanan'},
    //         {
    //             data	    : 'total',
    //             className   : 'text-right',
    //             render      : function (data, type, row) {
    //                 return formatRupiah(String(data)) + ',00';
    //             }
    //         },
    //         {
    //             data	    : 'totaldibayar',
    //             className   : 'text-right',
    //             render      : function (data, type, row) {
    //                 return formatRupiah(String(data)) + ',00';
    //             }
    //         },
    //         {
    //             data	    : 'sisaUtang',
    //             className   : 'text-right',
    //             render      : function (data, type, row) {
    //                 return formatRupiah(String(data)) + ',00';
    //             }
    //         },
    //         {data	: 'tanggaltempo'},
    //         {
    //             data	    : 'id',
    //             className   : 'text-center',
    //             render      : function (data, type, row) {
    //                 return `<div class="list-icons"> 
    //                             <div class="dropdown"> 
    //                                 <a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
    //                                 <div class="dropdown-menu dropdown-menu-right">

    //                                 </div> 
    //                             </div> 
    //                         </div>`;
    //             }
    //         },
	// 	]
	// });
</script>