<div class="page-header page-header-light">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4><i class="icon-info22 mr-2"></i> <span class="font-weight-semibold">{title}</span></h4>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
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
	</div>
	<hr>
	<div class="m-3">
		<form action="{site_url}laporan_retur_pembelian/index" id="form1" method="get">
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
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo lang('contact') ?>:</label>
						<select type="text" class="form-control kontakid" name="kontakid"></select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo lang('warehouse') ?>:</label>
						<select type="text" class="form-control gudangid" name="gudangid"></select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo lang('type') ?>:</label>
						<select type="text" class="form-control status" name="status"></select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label><?php echo lang('item') ?>:</label>
						<select type="text" class="form-control itemid" name="itemid"></select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
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
			<table class="table table-bordered">
				<tbody>
					<?php if ($itemid): ?>
						<?php if ($get_retur_pembelian): ?>
							<?php $grandtotalpembelian = 0 ?>
							<?php foreach ($get_retur_pembelian as $row): ?>
								<tr class="{bg_header}">
	                                <td colspan="9" class="font-weight-bold">
	                                    No Retur : <?php echo $row['noretur'] ?>  | 
	                                    No Faktur : <?php echo $row['nofaktur'] ?>  | 
	                                    Tanggal : <?php echo formatdateslash($row['tanggal']) ?> | 
	                                    Kepada : <?php echo $row['kontak'] ?>
	                                </td>
	                            </tr>
								<tr class="bg-light">
									<td class="text-left"><?php echo lang('item') ?></td>
									<td class="text-left"><?php echo lang('unit') ?></td>
									<td class="text-left"><?php echo lang('return_reason') ?></td>
									<td class="text-right"><?php echo lang('price') ?></td>
									<td class="text-right"><?php echo lang('qty') ?></td>
									<td class="text-right"><?php echo lang('subtotal') ?></td>
									<td class="text-right"><?php echo lang('discount') ?></td>
									<td class="text-right"><?php echo lang('ppn') ?></td>
									<td class="text-right"><?php echo lang('total') ?></td>
								</tr>
								<?php $totaldetailpembelian = 0 ?>
								<?php foreach ($this->model->get_retur_pembelian_detail($row['id']) as $det): ?>
									<?php if ($itemid == $det['itemid']): ?>
										<?php $totaldetailpembelian = $totaldetailpembelian + $det['total'] ?>
										<tr>
											<td> <?php echo $det['item'] ?> </td>
											<td> <?php echo $det['satuan'] ?> </td>
											<td> <?php echo $det['alasan'] ?> </td>
											<td class="text-right"> <?php echo number_format($det['harga']) ?> </td>
											<td class="text-right"> <?php echo number_format($det['jumlah']) ?> </td>
											<td class="text-right"> <?php echo number_format($det['subtotal']) ?> </td>
											<td class="text-right"> <?php echo number_format($det['diskon']) ?>% </td>
											<td class="text-right"> <?php echo number_format($det['ppn']) ?>% </td>
											<td class="text-right"> <?php echo number_format($det['total']) ?> </td>
										</tr>
									<?php endif ?>
								<?php endforeach ?>

								<?php $grandtotalpembelian = $grandtotalpembelian + $totaldetailpembelian ?>
								<tr class="bg-light">
									<td colspan="8" class="text-right font-weight-semibold"><?php echo lang('total') ?></td>
									<td class="text-right font-weight-semibold bg-warning"><?php echo number_format($totaldetailpembelian) ?></td>
								</tr>
							<?php endforeach ?>
						<?php else: ?>
							<tr>
								<td colspan="9"><?php echo lang('data_not_found') ?></td>
							</tr>
						<?php endif ?>
					<?php else: ?>
						<?php if ($get_retur_pembelian): ?>
							<?php $grandtotalpembelian = 0 ?>
							<?php foreach ($get_retur_pembelian as $row): ?>
								<tr class="{bg_header}">
	                                <td colspan="9" class="font-weight-bold">
	                                    No Retur : <?php echo $row['noretur'] ?>  | 
	                                    No Faktur : <?php echo $row['nofaktur'] ?>  | 
	                                    Tanggal : <?php echo formatdateslash($row['tanggal']) ?> | 
	                                    Kepada : <?php echo $row['kontak'] ?>
	                                </td>
	                            </tr>
								<tr class="bg-light">
									<td class="text-left"><?php echo lang('item') ?></td>
									<td class="text-left"><?php echo lang('unit') ?></td>
									<td class="text-left"><?php echo lang('return_reason') ?></td>
									<td class="text-right"><?php echo lang('price') ?></td>
									<td class="text-right"><?php echo lang('qty') ?></td>
									<td class="text-right"><?php echo lang('subtotal') ?></td>
									<td class="text-right"><?php echo lang('discount') ?></td>
									<td class="text-right"><?php echo lang('ppn') ?></td>
									<td class="text-right"><?php echo lang('total') ?></td>
								</tr>
								<?php $totaldetailpembelian = 0 ?>
								<?php foreach ($this->model->get_retur_pembelian_detail($row['id']) as $det): ?>
									<?php $totaldetailpembelian = $totaldetailpembelian + $det['total'] ?>
									<tr>
										<td> <?php echo $det['item'] ?> </td>
										<td> <?php echo $det['satuan'] ?> </td>
										<td> <?php echo $det['alasan'] ?> </td>
										<td class="text-right"> <?php echo number_format($det['harga']) ?> </td>
										<td class="text-right"> <?php echo number_format($det['jumlah']) ?> </td>
										<td class="text-right"> <?php echo number_format($det['subtotal']) ?> </td>
										<td class="text-right"> <?php echo number_format($det['diskon']) ?>% </td>
										<td class="text-right"> <?php echo number_format($det['ppn']) ?>% </td>
										<td class="text-right"> <?php echo number_format($det['total']) ?> </td>
									</tr>
								<?php endforeach ?>

								<?php $grandtotalpembelian = $grandtotalpembelian + $totaldetailpembelian ?>
								<tr class="bg-light">
									<td colspan="8" class="text-right font-weight-semibold"><?php echo lang('total') ?></td>
									<td class="text-right font-weight-semibold bg-warning"><?php echo number_format($totaldetailpembelian) ?></td>
								</tr>
							<?php endforeach ?>
						<?php else: ?>
							<tr>
								<td colspan="9"><?php echo lang('data_not_found') ?></td>
							</tr>
						<?php endif ?>
					<?php endif ?>
				</tbody>
				<?php if ($get_retur_pembelian): ?>
					<tfoot>
						<tr class="bg-success">
							<td colspan="8" class="text-right font-weight-semibold"><?php echo lang('grand_total') ?></td>
							<td class="text-right font-weight-semibold bg-success"><?php echo number_format($grandtotalpembelian) ?></td>
						</tr>
					</tfoot>
				<?php endif ?>
			</table>
		</div>
	</div>
</div>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script type="text/javascript">
	var base_url = '{site_url}laporan_retur_pembelian/';

    $(document).ready(function(){
	    $('.status').select2({
	        placeholder: 'Select an Option',
	        data: [
	            {id: '', text: 'Semua'},
	            {id: '1', text: 'Pembelian'},
	            {id: '2', text: 'Penjualan'},
	        ]
	    }).val('{status}').trigger('change');	
        ajax_select({ id: '.kontakid', url: base_url + 'select2_kontakid', selected: { id: '{kontakid}' } });
        ajax_select({ id: '.gudangid', url: base_url + 'select2_gudangid', selected: { id: '{gudangid}' } });
        ajax_select({ id: '.itemid', url: base_url + 'select2_itemid', selected: { id: '{itemid}' } });
    })
</script>