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
		<form action="{site_url}piutang/index" id="form1" method="get">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label><?php echo lang('Kontak') ?>:</label>
						<select class="form-control kontakid" name="kontakid"></select>
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
</div>
<div class="content">
	<div class="card">
		<div class="table-responsive">
			<table class="table table-xs">
				<thead class="{bg_header}">
					<tr>
						<th><?php echo lang('Tanggal') ?></th>
						<th><?php echo lang('No Invoice') ?></th>
						<th><?php echo lang('Keterangan') ?></th>
						<th><?php echo lang('Supplier') ?></th>
						<th class="text-center"><?php echo lang('piutang') ?></th>
						<th class="text-center"><?php echo lang('Sudah Dibayar') ?></th>
						<th class="text-center"><?php echo lang('Sisa piutang') ?></th>
						<th class="text-center"><?php echo lang('Status') ?></th>
						<th class="text-right"><?php echo lang('action') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if ($get_piutang): ?>
						<?php $totalpiutang = 0; $grandtotaldibayar = 0; $totalsisatagihan = 0 ?>
						<?php foreach ($get_piutang as $row): ?>
							<?php if($row['sisatagihan'] != 0) : ?>
								<?php $totalpiutang = $totalpiutang + $row['total'] ?>
								<?php $grandtotaldibayar = $grandtotaldibayar + $row['totaldibayar'] ?>
								<?php $totalsisatagihan = $totalsisatagihan + $row['sisatagihan'] ?>
								<tr>
									<td><?php echo formatdatemonthname($row['tanggal']) ?></td>
									<td>
										<a href="{site_url}faktur_penjualan/detail/<?php echo $row['idfaktur'] ?>" class="badge badge-info"><?php echo $row['notrans'] ?></a>
									</td>
									<td><strong><?php echo $row['namaakun'] ?></strong></td>
									<td><strong><?php echo $row['kontak'] ?></strong></td>
									<td class="text-center"><?php echo number_format($row['total']) ?></td>
									<td class="text-center"><?php echo number_format($row['totaldibayar']) ?></td>
									<td class="text-center"><?php echo number_format($row['sisatagihan']) ?></td>
									<td class="text-center">
										<?php if ($row['status'] == '3'): ?>
											<label class="badge badge-success">Lunas</label>
										<?php else: ?>
											<label class="badge badge-warning">Belum Lunas</label>
										<?php endif ?>
									</td>
									<td class="text-right">
										<?php if ($row['status'] == '3'): ?>
											<?php $pembayaran = get_by_id('fakturid',$row['idfaktur'],'tpembayaran'); ?>
											<a href="{site_url}pembayaran_penjualan/printpdf/<?php echo $row['idfaktur'] ?>" class="btn btn-sm btn-info"><i class="icon icon-printer"></i></a>
										<?php else: ?>
											<a href="{site_url}pembayaran_penjualan/create?idfaktur=<?php echo $row['idfaktur'] ?>" class="btn btn-sm btn-primary">Pembayaran</a>
										<?php endif ?>
									</td>
								</tr>
							<?php endif; ?>
						<?php endforeach ?>
						<tr class="bg-grey-300">
							<td colspan="4">Total piutang :</td>
							<td class="text-center font-weight-bold"><?php echo number_format($totalpiutang) ?></td>
							<td class="text-center font-weight-bold"><?php echo number_format($grandtotaldibayar) ?></td>
							<td class="text-center font-weight-bold"><?php echo number_format($totalsisatagihan) ?></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					<?php else: ?>
						<tr>
							<td class="text-center" colspan="8"><?php echo lang('data_not_found') ?></td>
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

<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script src="{assets_path}global/js/plugins/tables/datatables/datatables.min.js"></script>
<script src="{assets_path}global/js/plugins/pickers/pickadate/picker.js"></script>
<script src="{assets_path}global/js/plugins/pickers/pickadate/picker.date.js"></script>

<script type="text/javascript">
	var base_url = '{site_url}piutang/';
	ajax_select({ id: '.kontakid', url: base_url + 'select2_kontak', selected: { id: '{kontakid}' } });
</script>
