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
		<form action="{site_url}neraca/index" id="form1" method="get">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label><?php echo lang('date') ?>:</label>
						<input type="text" class="form-control datepicker" name="tanggal" required value="{tanggal}">
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
		<table class="table table-bordered">
			<tbody>
				<tr class="{bg_header}">
					<td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Aset') ?></td>
				</tr>

				<tr class="bg-grey-300">
					<td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Aset Lancar') ?></td>
				</tr>
				<?php $totalasetlancar = 0 ?>
				<?php foreach ($getasetlancar as $asetlancar): ?>
					<?php $totalasetlancar = $totalasetlancar + $asetlancar['saldo'] ?>
					<?php if ($asetlancar['saldo'] != 0): ?>
						<tr>
							<td colspan="2">
								<a href="{site_url}noakun/detail/<?php echo $asetlancar['noakun'] ?>">
									(<?php echo $asetlancar['noakun'] ?>) - <?php echo $asetlancar['namaakun'] ?> 
								</a>
							</td>
							<td class="text-right">
								<?php echo formatnumberakunting($asetlancar['saldo']) ?> 
							</td>
						</tr>
					<?php endif ?>
				<?php endforeach ?>
				<tr class="">
					<td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Aset Lancar') ?></td>
					<td class="text-right font-weight-bold"><?php echo formatnumberakunting($totalasetlancar) ?></td>
				</tr>

				<tr class="bg-grey-300">
					<td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Aset Tetap') ?></td>
				</tr>
				<?php $totalasettetap = 0 ?>
				<?php foreach ($getasettetap as $asettetap): ?>
					<?php $totalasettetap = $totalasettetap + $asettetap['saldo'] ?>
					<?php if ($asettetap['saldo'] != 0): ?>
						<tr>
							<td colspan="2">
								<a href="{site_url}noakun/detail/<?php echo $asettetap['noakun'] ?>">
									(<?php echo $asettetap['noakun'] ?>) - <?php echo $asettetap['namaakun'] ?> 
								</a>
							</td>
							<td class="text-right"><?php echo formatnumberakunting($asettetap['saldo']) ?></td>
						</tr>
					<?php endif ?>
				<?php endforeach ?>
				<tr class="">
					<td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Aset Tetap') ?></td>
					<td class="text-right font-weight-bold"><?php echo formatnumberakunting($totalasettetap) ?></td>
				</tr>

				<tr class="bg-success">
					<?php $totalaset = $totalasetlancar + $totalasettetap ?>
					<td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Aset') ?></td>
					<td class="text-right font-weight-bold"><?php echo formatnumberakunting($totalaset) ?></td>
				</tr>

				<tr class="{bg_header}">
					<td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Liabilitas dan Ekuitas') ?></td>
				</tr>

				<tr class="bg-grey-300">
					<td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Liabilitas') ?></td>
				</tr>
				<?php $totalliabilitas = 0 ?>
				<?php foreach ($getliabilitas as $liabilitas): ?>
					<?php $totalliabilitas = $totalliabilitas + $liabilitas['saldo'] ?>
					<?php if ($liabilitas['saldo'] != 0): ?>
						<tr>
							<td colspan="2">
								<a href="{site_url}noakun/detail/<?php echo $liabilitas['noakun'] ?>">
									(<?php echo $liabilitas['noakun'] ?>) - <?php echo $liabilitas['namaakun'] ?> 
								</a>
							</td>
							<td class="text-right"><?php echo formatnumberakunting($liabilitas['saldo']) ?></td>
						</tr>
					<?php endif ?>
				<?php endforeach ?>
				<tr class="">
					<td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Liabilitas') ?></td>
					<td class="text-right font-weight-bold"><?php echo formatnumberakunting($totalliabilitas) ?></td>
				</tr>

				<tr class="bg-grey-300">
					<td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Ekuitas') ?></td>
				</tr>
				<?php $totalmodal = 0 ?>
				<?php foreach ($getmodal as $modal): ?>
					<?php if ($modal['stdebet'] == '1'): ?>
						<?php $totalmodal = $totalmodal - $modal['saldo'] ?>
					<?php else: ?>
						<?php $totalmodal = $totalmodal + $modal['saldo'] ?>
					<?php endif ?>
					<?php if ($modal['saldo'] != 0): ?>
						<tr>
							<td colspan="2">
								<a href="{site_url}noakun/detail/<?php echo $modal['noakun'] ?>">
									(<?php echo $modal['noakun'] ?>) - <?php echo $modal['namaakun'] ?> 
								</a>
							</td>
							<td class="text-right">
								<?php if ($modal['stdebet'] == '1'): ?>
									(<?php echo formatnumberakunting($modal['saldo']) ?>) 
								<?php else: ?>
									<?php echo formatnumberakunting($modal['saldo']) ?> 
								<?php endif ?>
							</td>
						</tr>
					<?php endif ?>
				<?php endforeach ?>
				<tr>
					<td colspan="2"> <?php echo lang("Laba / Rugi Bersih Berjalan") ?> </td>
					<td class="text-right"> <?php echo formatnumberakunting($gettotallabarugi) ?> </td>
				</tr>
				<?php $totalmodal = $totalmodal + $gettotallabarugi ?>
				<tr class="">
					<td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Ekuitas') ?></td>
					<td class="text-right font-weight-bold"><?php echo formatnumberakunting($totalmodal) ?></td>
				</tr>


				<tr class="bg-success">
					<?php $totalmodaldanliabilitas = $totalliabilitas + $totalmodal ?>
					<td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Liabilitas dan Ekuitas') ?></td>
					<td class="text-right font-weight-bold"><?php echo formatnumberakunting($totalmodaldanliabilitas) ?></td>
				</tr>

			</tbody>
		</table>
	</div>
</div>
