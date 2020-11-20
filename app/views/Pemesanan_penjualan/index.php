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
						<div class="card-header">
							<a href="{site_url}Pemesanan_penjualan/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-xs table-striped table-borderless table-hover index_datatable">
									<thead>
										<tr class="table-active">
											<th><?php echo lang('notrans') ?></th>
											<th>Perusahaan</th>
											<th><?php echo lang('note') ?></th>
											<th><?php echo lang('date') ?></th>
											<th><?php echo lang('supplier') ?></th>
											<th><?php echo lang('warehouse') ?></th>
											<th>Cabang</th>
											<th>Pajak</th>
											<th>Budget Event</th>
											<th>Nominal Total</th>
											<th>Cara</th>
											<th><?php echo lang('status') ?></th>
											<th><?php echo lang('Aksi') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php
											foreach ($pemesanan as $key) { ?>
												<tr>
													<td><span class="btn btn-sm btn-info"><?= $key['notrans']; ?></span></td>
													<td><?= $key['nama_perusahaan']; ?></td>
													<td><?= $key['catatan']; ?></td>
													<td><?= $key['tanggal']; ?></td>
													<td><?= $key['supplier']; ?></td>
													<td><?= $key['gudang']; ?></td>
													<td><?= $key['cabang']; ?></td>
													<td>
														<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalPajak<?= $key['id']; ?>" title="Detail Pajak">
															<i class="fas fa-balance-scale"></i>
														</button>
														<div class="modal fade" id="modalPajak<?= $key['id']; ?>">
															<div class="modal-dialog modal-xl">
																<div class="modal-content">
																	<div class="modal-header">
																		<h4 class="modal-title">Pajak</h4>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																			<span aria-hidden="true">&times;</span>
																		</button>
																	</div>
																	<form id="form_pajak" action="javascript:total_pajak('', '${no}')" enctype="multipart/form-data" method="POST">
																		<div class="modal-body">
																			<div class="table-responsive">
																				<table class="table table-xs table-striped table-borderless table-hover index_datatable" style="width:100%" id="pajak">
																					<thead>
																						<tr class="table-active">
																							<th>Nama Pajak</th>
																							<th>Kode Akun</th>
																							<th>Nama Akun</th>
																							<th>Nominal</th>
																						</tr>
																					</thead>
																					<tbody id="isi_tbody_pajak">
																						<?php
																							if ($key['pajak']) {
																								foreach ($key['pajak'] as $pajak) { ?>
																									<tr>
																										<td><?= $pajak['nama_pajak']; ?></td>
																										<td><?= $pajak['akunno']; ?></td>
																										<td><?= $pajak['namaakun']; ?></td>
																										<td>
																											<?php 
																												switch ($pajak['pengurangan']) {
																													case '0':
																														echo number_format($pajak['nominal'],2,',','.');
																														break;
																													case '1':
																														echo '-' . number_format($pajak['nominal'],2,',','.');
																														break;
																													
																													default:
																														# code...
																														break;
																												}
																											?>
																										</td>
																									</tr>
																								<?php }
																							}
																						?>
																					</tbody>
																				</table>
																			</div>
																		</div>
																	</form>
																</div>
															</div>
														</div>
													</td>
													<td>
														<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalBudgetEvent<?= $key['id']; ?>" title="Detail Pajak">
															<i class="fas fa-dollar-sign"></i>
														</button>
														<div class="modal fade" id="modalBudgetEvent<?= $key['id']; ?>">
															<div class="modal-dialog modal-xl">
																<div class="modal-content">
																	<div class="modal-header">
																		<h4 class="modal-title">Budget Event</h4>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																			<span aria-hidden="true">&times;</span>
																		</button>
																	</div>
																	<form id="form_pajak" action="javascript:total_pajak('', '${no}')" enctype="multipart/form-data" method="POST">
																		<div class="modal-body">
																			<div class="table-responsive">
																				<table class="table table-xs table-striped table-borderless table-hover index_datatable" style="width:100%" id="pajak">
																					<thead>
																						<tr class="table-active">
																							<th>No. Kwitansi</th>
																							<th>Item</th>
																							<th>Total</th>
																							<th>Rekening</th>
																						</tr>
																					</thead>
																					<tbody id="isiBudgetEvent">
																						<?php
																							if ($key['budgetEvent']) {
																								foreach ($key['budgetEvent'] as $budgetEvent) { ?>
																									<tr>
																										<td><span class="btn btn-sm btn-info"><?= $budgetEvent['nokwitansi']; ?></span></td>
																										<td><?= $budgetEvent['item']; ?></td>
																										<td><?= number_format($budgetEvent['total'], 2, ',', '.'); ?></td>
																										<td><?= $budgetEvent['rekening']; ?></td>
																									</tr>
																								<?php }
																							}
																						?>
																					</tbody>
																				</table>
																			</div>
																		</div>
																	</form>
																</div>
															</div>
														</div>
													</td>
													<td><?= number_format($key['total'], 2, ',', '.'); ?></td>
													<td><?= $key['cara_pembayaran']; ?></td>
													<td>
														<?php 
															switch ($key['status']) {
																case '2': ?>
																	<span class="badge badge-warning"><?php echo lang('partial') ?></span>
																	<?php break;
																case '3': ?>
																	<span class="badge badge-success"><?php echo lang('done') ?></span>
																	<?php break;
																case '5': ?>
																	<span class="badge badge-primary"><?php echo lang('Validasi') ?></span>
																	<?php break;
																
																default: ?>
																	<span class="badge badge-danger"><?php echo lang('pending') ?></sapan>
																	<?php break;
															} 
														?>
													</td>
													<td>
														<?php
															$tombol	= '';
															$cetak 	= '';
															$id		= "'" . $key['id'] . "'";
															switch ($key['status']) {
																case '4':
																	$tombol	.= '
																	<a class="dropdown-item" href="javascript:validasi(' . $id . ')"><i class="fas fa-check"></i> Validasi</a>
																	<a class="dropdown-item" href="' . base_url() . 'edit/' . $key['id'] . '"><i class="fas fa-pencil-alt"></i> Ubah</a>
																	<a href="javascript:deleteData(' . $id . ')" class="dropdown-item delete"><i class="fas fa-trash"></i> Hapus</a>'; 
																	break;
																case '5':
																	$tombol	.= '<a class="dropdown-item" href="javascript:batalvalidasi(' . $id . ')"><i class="fas fa-times"></i> Batal Validasi</a>'; 
																	break;
																case '3':
																	$cetak .= '<a class="dropdown-item" href="' . base_url() . 'printpdf/' . $key['id'] . '"><i class="fas fa-print"></i> Cetak</a>'; 
																	break;
																
																default:
																	# code...
																	break;
															} 
														?>
														<div class="list-icons"> 
															<div class="dropdown"> 
																<a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
																<div class="dropdown-menu dropdown-menu-right">
																	<?= $tombol . $cetak; ?>
																</div> 
															</div> 
														</div>
													</td>
												</tr>
											<?php }
										?>
									</tbody>
									<tfoot>
										<tr class="table-active">
											<th class="text-right" colspan="9">Total</th>
											<th></th>
											<th class="text-right" colspan="3"></th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
    </section>
  </div>

<script type="text/javascript">
	var base_url	= '{site_url}Pemesanan_penjualan/';
	var table		= $('.index_datatable').DataTable({
		footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\Rp.]/g, '').replace(/,00/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            total = api.column(9).data().reduce( function (a, b) {
                return intVal(a) + intVal(b); 
            }, 0 );
			$( api.column( 9 ).footer() ).html(
				formatRupiah(String(total))+',00'
			);
        }
	});

	function validasi(id) {
        $.ajax({
            url: base_url + 'validasi',
            dataType: 'json',
            method: 'post',
            data: {id : id},
            success: function(data) {
                if(data.status == 'success') {
                    swal("Berhasil!",data.message, "success");
                    redirect(base_url);
                } else {
                    swal("Gagal!",data.message, "error");
                }
            },
        })
    }

    function batalvalidasi(id) {
        $.ajax({
            url: base_url + 'batalvalidasi',
            dataType: 'json',
            method: 'post',
            data: {id : id},
            success: function(data) {
                if(data.status == 'success') {
                    swal("Berhasil!",data.message, "success");
                    redirect(base_url);
                } else {
                    swal("Gagal!",data.message, "error");
                }
            },
        })
    }

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
							redirect(base_url);
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
</script>
