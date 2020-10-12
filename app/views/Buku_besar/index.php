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
        <div class="header-elements d-none">
			<div class="d-flex justify-content-center">
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
        <div class="ml-3 mr-3 mt-3 mb-3">
            <form action="{site_url}buku_besar/index" id="form1" method="get">
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
                            <input type="text" class="form-control datepicker" name="tanggalawal" required value="{tanggalawal}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label><?php echo lang('end_date') ?>:</label>
                            <input type="text" class="form-control datepicker" name="tanggalakhir" required value="{tanggalakhir}">
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
                <div class="table-responsive">
                    <table class="table">
                        <thead class="{bg_header}">
                            <tr>
                                <th width="20%"><?php echo lang('date') ?></th>
                                <th><?php echo lang('note') ?></th>
                                <th class="text-right" width="15%"><?php echo lang('debet') ?></th>
                                <th class="text-right" width="15%"><?php echo lang('kredit') ?></th>
                                <th class="text-right" width="15%"><?php echo lang('balance') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($get_noakun): ?>
                                <?php foreach ($get_noakun as $row): ?>
                                    <?php $totaldebet = 0 ?>
                                    <?php $totalkredit = 0 ?>
                                    <?php $totalsaldo = 0 ?>

                                    <tr class="bg-grey-300">
                                        <td colspan="2">
                                            <?php $date = date('d/m/Y', strtotime($row['tanggal'])) ?> 
                                            <span class="font-weight-bold">(<?php echo $row['noakun'] ?>) - </span> 
                                            <span class="font-weight-bold"><?php echo $row['namaakun'] ?></span> 
                                        </td>
                                        <?php if ($row['stdebet'] == '1'): ?>
                                            <td class="text-right font-weight-bold">
                                                <?php $totaldebet = $this->model->get_jurnal_detail_saldoawal($row['noakun'], $tanggalawal) ?>
                                                <?php echo number_format($totaldebet) ?>
                                            </td>
                                            <td class="text-right font-weight-bold">0</td>
                                        <?php else: ?>
                                            <td class="text-right font-weight-bold">0</td>
                                            <td class="text-right font-weight-bold">
                                                <?php $totalkredit = $this->model->get_jurnal_detail_saldoawal($row['noakun'], $tanggalawal) ?>
                                                <?php echo number_format($totalkredit) ?>
                                            </td>
                                        <?php endif ?>
                                        <td class="text-right font-weight-bold">
                                            <?php $saldo = $this->model->get_jurnal_detail_saldoawal($row['noakun'], $tanggalawal) ?>
                                            <?php echo number_format($saldo) ?>
                                        </td>
                                    </tr>

                                    <?php foreach ($this->model->get_jurnal_detail($row['noakun'], $tanggalawal, $tanggalakhir) as $det): ?>
                                        <?php if ($row['stdebet'] == '1'): ?>
                                            <?php $totaldebet = $totaldebet + $det['debet'] ?>
                                            <?php $totalkredit = $totalkredit + $det['kredit'] ?>
                                            <?php $saldo = $saldo + $det['debet'] - $det['kredit'] ?>
                                        <?php else: ?>
                                            <?php $totaldebet = $totaldebet + $det['debet'] ?>
                                            <?php $totalkredit = $totalkredit + $det['kredit'] ?>
                                            <?php $saldo = $saldo - $det['debet'] + $det['kredit'] ?>
                                        <?php endif ?>
                                        <?php $date = date('d/m/Y', strtotime($det['tanggal'])) ?>
                                        <tr>
                                            <td><?php echo $date ?></td>
                                            <td><?php echo $det['keterangan'] ?></td>
                                            <td class="text-right"><?php echo number_format($det['debet']) ?></td>
                                            <td class="text-right"><?php echo number_format($det['kredit']) ?></td>
                                            <?php if ($saldo < 0): ?>
                                                <td class="text-right">(<?php echo number_format(abs($saldo)) ?>)</td>
                                            <?php else: ?>
                                                <td class="text-right"><?php echo number_format($saldo) ?></td>
                                            <?php endif ?>
                                        </tr>
                                    <?php endforeach ?>
                                    <tr class="bg-light font-weight-bold">
                                        <?php $namasaldoakhir =  lang('ending_balance').' - ('.$row['noakun'].') '.$row['namaakun'] ?>
                                        <td class="text-right" colspan="2"><?php echo $namasaldoakhir ?></td>
                                        <td class="text-right"><?php echo number_format($totaldebet) ?></td>
                                        <td class="text-right"><?php echo number_format($totalkredit) ?></td>
                                        <td class="text-right">
                                            <?php if ($saldo < 0): ?>
                                                (<?php echo number_format(abs($saldo)) ?>)
                                            <?php else: ?>
                                                <?php echo number_format($saldo) ?>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php else: ?>
                                <tr>
                                    <td class="text-center" colspan="5"><?php echo lang('data_not_found') ?></td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3 mb-3">
                <?php echo $pagination ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script type="text/javascript">
	var base_url = '{site_url}buku_besar/';
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
                    <a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
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
                    swal("Berhasil!", data.message, "success");
                    setTimeout(function() { table.ajax.reload() }, 100);
                    } else {
                    swal("Gagal!", data.message, "error");
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

    ajax_select({ 
        id          : '.perusahaanid', 
        url         : '{site_url}perusahaan/select2', 
        selected    : { 
            id: '{perusahaanid}' 
        } 
    });
</script>