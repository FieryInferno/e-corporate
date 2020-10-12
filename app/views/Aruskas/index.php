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
		<form action="{site_url}laba_rugi/index" id="form1" method="get">
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
		<table class="table table-bordered">
			<thead class="{bg_header}">
				<tr>
					<th colspan="3" class="text-uppercase">
						<?php echo lang('report').'&nbsp;'.lang('cashflow') ?> 
						(<?php echo formatdateslash($tanggalawal) ?> - <?php echo formatdateslash($tanggalakhir) ?>)
					</th>
				</tr>
			</thead>
			<tbody>
				<tr class="bg-light">
					<td colspan="2" class="font-weight-bold text-uppercase">
						Arus Kas dari aktivitas operasi
					</td>
				</tr>
				<tr>
					<td>Laba bersih setelah pajak</td>
					<td class="text-right"><?php echo formatnumberakunting($total_laba_rugi) ?></td>
				</tr>
				<tr>
					<?php if ($nrc_persediaan > 0): ?>
						<td>Kenaikan Persediaan</td>
					<?php elseif($nrc_persediaan == 0): ?>
						<td>Persediaan</td>
					<?php else: ?>
						<td>Penurunan Persediaan</td>
					<?php endif ?>
					<td class="text-right"><?php echo formatnumberakunting($nrc_persediaan) ?></td>
				</tr>
				<tr>
					<?php if ($nrc_piutang > 0): ?>
						<td>Kenaikan Piutang Usaha</td>
					<?php elseif($nrc_piutang == 0): ?>
						<td>Piutang Usaha</td>
					<?php else: ?>
						<td>Penurunan Piutang Usaha</td>
					<?php endif ?>
					<td class="text-right"><?php echo formatnumberakunting($nrc_piutang) ?></td>
				</tr>
				<tr>
					<?php if ($nrc_utang_usaha > 0): ?>
						<td>Kenaikan Utang Usaha</td>
					<?php elseif($nrc_utang_usaha == 0): ?>
						<td>Utang Usaha</td>
					<?php else: ?>
						<td>Penurunan Utang Usaha</td>
					<?php endif ?>
					<td class="text-right"><?php echo formatnumberakunting($nrc_utang_usaha) ?></td>
				</tr>
				<tr>
					<td>Penyusutan</td>
					<td class="text-right"><?php echo formatnumberakunting($nrc_penyusutan) ?></td>
				</tr>
				<tr>
					<?php $totalkasoperasi = $total_laba_rugi+$nrc_persediaan+$nrc_piutang+$nrc_utang_usaha+$nrc_penyusutan ?>
					<td class="font-weight-bold">Kas yang diperoleh dari aktivitas operasi</td>
					<td class="text-right font-weight-bold"><?php echo formatnumberakunting($totalkasoperasi) ?></td>
				</tr>



				<!-- ================================================= INVESTASI ========================== -->

				<tr class="bg-light">
					<td colspan="2" class="font-weight-bold text-uppercase">
						Arus Kas dari aktivitas Investasi
					</td>
				</tr>
				<tr>
					<td>Mesin & Peralatan</td>
					<td class="text-right"><?php echo formatnumberakunting($atperalatan) ?></td>
				</tr>
				<tr>
					<td>Tanah</td>
					<td class="text-right"><?php echo formatnumberakunting($attanah) ?></td>
				</tr>
				<tr>
					<td>Kendaraan</td>
					<td class="text-right"><?php echo formatnumberakunting($atkendaraan) ?></td>
				</tr>
				<tr>
					<td>Bangunan</td>
					<td class="text-right"><?php echo formatnumberakunting($atbangunan) ?></td>
				</tr>
				<tr class="bg-light">
					<?php $totalkasinvestasi = $atperalatan+$attanah+$atkendaraan+$atbangunan ?>
					<td class="font-weight-bold">Kas yang diperoleh dari aktivitas investasi</td>
					<td class="text-right font-weight-bold"><?php echo formatnumberakunting($totalkasinvestasi) ?></td>
				</tr>

				<!-- ================================================= INVESTASI ========================== -->

				<tr class="bg-light">
					<td colspan="2" class="font-weight-bold text-uppercase">
						Arus Kas dari aktivitas Pendanaan
					</td>
				</tr>
				<tr>
					<td>Kenaikan Modal</td>
					<td class="text-right"><?php echo formatnumberakunting(0) ?></td>
				</tr>
				<tr>
					<td>Penambahan Prive</td>
					<td class="text-right"><?php echo formatnumberakunting(0) ?></td>
				</tr>
				<tr class="bg-light">
					<?php $totalkasinvestasi = $atperalatan+$attanah+$atkendaraan+$atbangunan ?>
					<td class="font-weight-bold">Kas yang diperoleh dari aktivitas investasi</td>
					<td class="text-right font-weight-bold"><?php echo formatnumberakunting(0) ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>