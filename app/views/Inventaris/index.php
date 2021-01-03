
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
						<div class="card-body">
							<form action="<?= base_url(); ?>inventaris" method="get">
                                <div class="row">
                                    <?php
                                        if ($this->session->userid !== '1') { ?>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Perusahaan : </label>
                                                    <input type="hidden" name="perusahaan" value="<?= $this->session->idperusahaan; ?>">
                                                    <input type="text" class="form-control" value="<?= $this->session->perusahaan; ?>" disabled>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Perusahaan : </label>
                                                    <select class="form-control" name="perusahaan" id="perusahaan"></select>
                                                </div>
                                            </div>
                                        <?php }
                                    ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="text-right">
                                            <button class="btn-block btn btn-success" type="submit"><i class="fas fa-filter"></i> Filter</button>
                                            <button class="btn-block btn btn-warning">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
						</div>
					</div>
				</div>
				<div class="col-12">         
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-xs table-striped table-borderless table-hover index_datatable">
									<thead>
										<tr class="table-active">
											<th>Perusahaan</th>
											<th>Jenis Akun</th>
											<th>Kode Barang</th>
											<th>Nama Inventaris</th>
											<th>No. Register</th>
											<th>Tahun Perolehan</th>
											<th>Tahun Penyusutan</th>
											<th>Nominal Aset</th>
											<th>Masa Manfaat</th>
											<th>Non ROR Kini</th>
											<th>Non ROR s/d Kini</th>
											<th>Nominal Pemeliharaan</th>
											<th>Tambahan Masa Manfaat</th>
											<th>ROR Kini</th>
											<th>ROR s/d Kini</th>
											<th>Akumulasi Penyusutan</th>
											<th>Nilai Buku</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$total	= 0;
											foreach ($inventaris as $key) { 
												$total	+= $key['harga']; ?>
												<tr>
													<td><?= $key['nama_perusahaan']; ?></td>
													<td><?= $key['namaakun']; ?></td>
													<td><?= $key['kodeInventaris']; ?></td>
													<td><?= $key['namaInventaris']; ?></td>
													<td><?= $key['noRegister']; ?></td>
													<td><?= $key['tanggalPembelian']; ?></td>
													<td></td>
													<td><?= number_format($key['harga'], 2, ',', '.'); ?></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
											<?php }
										?>
									</tbody>
									<tfoot>
										<tr class="table-active">
											<th colspan="7" class="text-right">Total</th>
											<th><?= number_format($total, 2, ',', '.'); ?></th>
											<th></th>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									</tfoot>
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
	var base_url	= '{site_url}inventaris/';
	var table		= $('.index_datatable').DataTable();

	$(document).ready(function () {
		ajax_select({
			id	: '#perusahaan',	
			url	: '<?= base_url(); ?>perusahaan/select2',
		});	
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
							swal("Berhasil!", "Data Berhasil Dihapus!", "success");
							setTimeout(function() { table.ajax.reload() }, 100);
						} else {
							swal("Gagal!", "Data Gagal Dihapus!", "error");
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
</script>