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
                        <li class="breadcrumb-item"><a href="#">{title}</a></li>
                        <li class="breadcrumb-item active">{subtitle}</li>
                    </ol>
                </div>  
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="m-3">
                        <form action="" id="form1" method="get">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Perusahaan:</label>
                                        <select class="form-control" name="perusahaan" id="perusahaan" required></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Rekening : </label>
                                        <select class="form-control" name="rekening" id="rekening" required></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tanggal : </label>
                                        <input type="date" class="form-control" name="tanggal" placeholder="Tanggal" required>
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
                        <div class="card-body">
                            <div class="table-responsive">
								<table class="table table-xs table-striped table-borderless table-hover index_datatable">
									<thead>
										<tr class="table-active">
                                            <th class="text-center">No Kas</th>
                                            <th class="text-center">Uraian</th>
                                            <th class="text-center">Penerimaan</th>
                                            <th class="text-center">Pengeluaran</th>
										</tr>
									</thead>
									<tbody>
                                        <?php
                                            if ($laporan !== null) { ?>
                                                <tr>
                                                    <td></td>
                                                    <td class="text-center"><strong>Jumlah Sampai dengan Tanggal {tanggal}</strong></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <?php foreach ($laporan as $key) {
                                                    foreach ($key as $value) { ?>
                                                        <tr>
                                                            <td class="text-center"><?= $value['no']; ?></td>
                                                            <td class="text-center"><?= $value['keterangan']; ?></td>
                                                            <td class="text-center"><?= number_format($value['debet'],2,',','.'); ?></td>
                                                            <td class="text-center"><?= number_format($value['kredit'],2,',','.'); ?></td>
                                                        </tr>
                                                    <?php }
                                                }
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
    $(document).ready(function () {
        ajax_select({
            id: '#perusahaan',
            url: '{site_url}perusahaan/select2'
        });
        $('#perusahaan').change(function(e) {
			var perusahaan  = $('#perusahaan').children('option:selected').val();
            ajax_select({
				id  : '#rekening',
				url : '{site_url}rekening/select2/' + perusahaan,
			});
		})
    })
</script>