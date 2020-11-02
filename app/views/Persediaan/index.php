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
							<div class="table-responsive">
                                <table class="table table-xs table-striped table-borderless table-hover index_datatable">
                                    <thead>
                                        <tr class="table-active">
											<th>Kode</th>
											<th>Nama</th>
											<th>Satuan</th>
											<th>Kategori</th>
											<th>Saldo Awal</th>
											<th>Masuk</th>
											<th>Keluar</th>
											<th>Stok</th>
											<th>Hrg Beli Terakhir</th>
											<th>Total Persediaan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											foreach ($persediaan as $key) { ?>
												<tr>
													<td><?= $key['kode']; ?></td>
													<td><?= $key['nama']; ?></td>
													<td><?= $key['satuan']; ?></td>
													<td><?= $key['kategori']; ?></td>
													<td><?= $key['quantity']; ?></td>
													<td><?= $key['masuk'] !== null ? $key['masuk'] : '0' ; ?></td>
													<td><?= $key['keluar'] !== null ? $key['keluar'] : '0' ; ?></td>
													<td><?= $key['stok'] !== null ? $key['stok'] : '0' ; ?></td>
													<td><?= number_format($key['hargabeliterakhir'],2,',','.'); ?></td>
													<td><?= number_format($key['stok'] * $key['hargabeliterakhir'],2,',','.'); ?></td>
												</tr>
											<?php }
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
	var base_url = '{site_url}Persediaan/';
	$('.index_datatable').DataTable();
</script>