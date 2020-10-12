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
		<form action="{site_url}neraca_saldo_penyesuaian/index" id="form1" method="get">
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
			<table class="table table-bordered">
				<thead class="{bg_header}">
					<tr>
						<th rowspan="2"><?php echo lang('account') ?></th>
						<th colspan="2" width="25%" class="text-center"><?php echo lang('beginning_balance') ?></th>
						<th colspan="2" width="25%" class="text-center"><?php echo lang('Pergerakan') ?></th>
						<th colspan="2" width="25%" class="text-center"><?php echo lang('ending_balance') ?></th>
					</tr>
					<tr>
						<th class="text-center"><?php echo lang('debet') ?></th>
						<th class="text-center"><?php echo lang('kredit') ?></th>
						<th class="text-center"><?php echo lang('debet') ?></th>
						<th class="text-center"><?php echo lang('kredit') ?></th>
						<th class="text-center"><?php echo lang('debet') ?></th>
						<th class="text-center"><?php echo lang('kredit') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $totalawal = 0; ?>
					<?php $totalgerak = 0; ?>
					<?php $totalakhir = 0; ?>
					<?php $totalakhirdebet = 0; ?>
					<?php $totalakhirkredit = 0; ?>
					<?php foreach ($saldo_detail_noakun as $noakun): ?>
						<tr>
							<td>
								<a href="{site_url}noakun/detail/<?php echo $noakun['noakun'] ?>">
									(<?php echo $noakun['noakun'] ?>) - <?php echo $noakun['namaakun'] ?> 
								</a>
							</td>
							<?php foreach ($this->model->get_neraca_saldo_detail_awal($tanggalawal, $noakun['noakun']) as $awal): ?>
								<?php $totalawal = $totalawal + $awal['debet'] ?>
								<td class="text-right"><?php echo number_format($awal['debet']) ?></td>
								<td class="text-right"><?php echo number_format($awal['kredit']) ?></td>
							<?php endforeach ?>
							<?php $pergerakan = $this->model->get_neraca_saldo_detail_pergerakan($tanggalawal, $tanggalakhir, $noakun['noakun']) ?>
							<?php foreach ($pergerakan as $gerak): ?>
								<?php $totalgerak = $totalgerak + $gerak['debet'] ?>
								<td class="text-right"><?php echo number_format($gerak['debet']) ?></td>
								<td class="text-right"><?php echo number_format($gerak['kredit']) ?></td>
							<?php endforeach ?>
							<?php $akhir = $this->model->get_neraca_saldo_detail_akhir($tanggalakhir, $noakun['noakun']) ?>
							<?php foreach ($akhir as $akhr): ?>
								<?php if ($noakun['stdebet'] == '1'): ?>
									<td class="text-right"><?php echo number_format($akhr['debet']-$akhr['kredit']) ?></td>
									<td class="text-right">0</td>
									<?php $totalakhirdebet = $totalakhirdebet + ($akhr['debet']-$akhr['kredit']) ?>
								<?php else: ?>
									<td class="text-right">0</td>
									<td class="text-right"><?php echo number_format($akhr['kredit']-$akhr['debet']) ?></td>
									<?php $totalakhirkredit = $totalakhirkredit + ($akhr['kredit']-$akhr['debet']) ?>
								<?php endif ?>
							<?php endforeach ?>
						</tr>
					<?php endforeach ?>
				</tbody>
				<thead class="{bg_header}">
					<tr>
						<th class="text-center">&nbsp;</th>
						<th class="text-right"><?php echo number_format($totalawal) ?></th>
						<th class="text-right"><?php echo number_format($totalawal) ?></th>
						<th class="text-right"><?php echo number_format($totalgerak) ?></th>
						<th class="text-right"><?php echo number_format($totalgerak) ?></th>
						<th class="text-right"><?php echo number_format($totalakhirdebet) ?></th>
						<th class="text-right"><?php echo number_format($totalakhirkredit) ?></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>
