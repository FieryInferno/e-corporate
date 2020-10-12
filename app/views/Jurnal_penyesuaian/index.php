<div class="page-header page-header-light">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4><i class="icon-info22 mr-2"></i> <span class="font-weight-semibold">{title}</span></h4>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
		<div class="header-elements d-none">
			<div class="d-flex justify-content-center">
				<div class="btn-group">
					<a href="{site_url}jurnal_penyesuaian/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
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
		<form action="{site_url}jurnal_penyesuaian/index" id="form1" method="get">
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
		<table class="table">
			<thead class="{bg_header}">
				<tr>
					<th><?php echo lang('account') ?></th>
					<th class="text-right" width="20%"><?php echo lang('debet') ?></th>
					<th class="text-right" width="20%"><?php echo lang('kredit') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php if ($get_jurnal): ?>
					<?php foreach ($get_jurnal as $row): ?>
						<tr class="bg-grey-300">
							<td>
								<?php $date = date('d/m/Y', strtotime($row['tanggal'])) ?>
								<span class="font-weight-bold"><?php echo $row['keterangan'] ?> - </span> 
								<span class="font-weight-bold">( <?php echo $date ?> )</span> 
							</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<?php $totaldebet = 0 ?>
						<?php $totalkredit = 0 ?>
						<?php foreach ($this->model->get_jurnal_detail($row['id']) as $det): ?>
							<?php $totaldebet = $totaldebet + $det['debet'] ?>
							<?php $totalkredit = $totalkredit + $det['kredit'] ?>
							<tr>
								<td>
									<a href="{site_url}noakun/detail/<?php echo $det['noakun'] ?>">
										<?php if ($det['debet'] == 0): ?>
											<?php echo str_repeat('&nbsp;', 20).'('.$det['noakun'] ?>) - <?php echo $det['namaakun'] ?> 
										<?php else: ?>
											(<?php echo $det['noakun'] ?>) - <?php echo $det['namaakun'] ?> 
										<?php endif ?>
									</a>
								</td>
								<td class="text-right"><?php echo number_format($det['debet']) ?></td>
								<td class="text-right"><?php echo number_format($det['kredit']) ?></td>
							</tr>
						<?php endforeach ?>
						<tr class="bg-light font-weight-bold">
							<td class="text-right">Total</td>
							<td class="text-right"><?php echo number_format($totaldebet) ?></td>
							<td class="text-right"><?php echo number_format($totalkredit) ?></td>
						</tr>
					<?php endforeach ?>
				<?php else: ?>
					<tr>
						<td class="text-center" colspan="3"><?php echo lang('data_not_found') ?></td>
					</tr>
				<?php endif ?>
			</tbody>
		</table>
	</div>
	<div class="d-flex justify-content-center mt-3 mb-3">
		<?php echo $pagination ?>
	</div>
</div>
