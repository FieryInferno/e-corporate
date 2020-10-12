<div class="page-header page-header-light">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4><i class="icon-info22 mr-2"></i> <span class="font-weight-semibold">{title}</span></h4>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>

		<div class="header-elements d-none">
			<div class="d-flex justify-content-center">
				<div class="btn-group">
					<a href="{site_url}pengeluaran_kas/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
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
		<form action="{site_url}pengeluaran_kas/index" id="form1" method="get">
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
						<th><?php echo lang('No Kwitansi') ?></th>
						<th><?php echo lang('Keterangan') ?></th>
						<th><?php echo lang('Tanggal') ?></th>
						<th><?php echo lang('Peneriman') ?></th>
						<th class="text-center"><?php echo lang('Nominal') ?></th>
						<th class="text-right"><?php echo lang('action') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if ($get_pengeluaran): ?>
						<?php $totalpengeluaran = 0 ?>
						<?php foreach ($get_pengeluaran as $row): ?>
							<?php $totalpengeluaran = $totalpengeluaran + $row['nominal'] ?>
							<tr>
								<td>
									<label class="badge badge-info">
										<?php echo $row['notrans'] ?> 
									</label>
								</td>
								<td><strong><?php echo $row['keterangan'] ?></strong></td>
								<td><?php echo formatdatemonthname($row['tanggal']) ?></td>
								<td><?php echo $row['penerima'] ?></td>
								<td class="text-center"><?php echo number_format($row['nominal']) ?></td>
								<td class="text-right">
									<a href="{site_url}pengeluaran_kas/kwitansipdf/<?php echo $row['id'] ?>" class="btn btn-sm btn-info"><i class="icon icon-printer"></i> Print Kwitansi</a>
								</td>
							</tr>
						<?php endforeach ?>
						<tr class="bg-grey-300">
							<td colspan="4">Total Pengeluaran Kas Periode Ini :</td>
							<td class="text-center font-weight-bold"><?php echo number_format($totalpengeluaran) ?></td>
							<td>&nbsp;</td>
						</tr>
					<?php else: ?>
						<tr>
							<td class="text-center" colspan="3"><?php echo lang('data_not_found') ?></td>
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
