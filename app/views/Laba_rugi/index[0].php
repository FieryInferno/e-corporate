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
						<?php echo lang('income_statement') ?> 
						(<?php echo formatdateslash($tanggalawal) ?> - <?php echo formatdateslash($tanggalakhir) ?>)
					</th>
				</tr>
			</thead>
			<tbody>
				<tr class="bg-grey-300">
					<td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Pendapatan dari Penjualan') ?></td>
				</tr>
				<?php $totalpenjualan = 0 ?>
				<?php foreach ($penjualan as $jual): ?>
					<?php if ($jual['stdebet'] == '1'): ?>
						<?php $totalpenjualan = $totalpenjualan - $jual['saldo'] ?>
					<?php else: ?>
						<?php $totalpenjualan = $totalpenjualan + $jual['saldo'] ?>
					<?php endif ?>
					<?php if ($jual['saldo'] > 0): ?>
						<tr>
							<td colspan="2">
								<a href="{site_url}noakun/detail/<?php echo $jual['noakun'] ?>">
									(<?php echo $jual['noakun'] ?>) - <?php echo $jual['namaakun'] ?> 
								</a>
							</td>
							<td class="text-right">
								<?php if ($jual['stdebet'] == '1'): ?>
									(<?php echo formatnumberakunting($jual['saldo']) ?>) 
								<?php else: ?>
									<?php echo formatnumberakunting($jual['saldo']) ?> 
								<?php endif ?>
							</td>
						</tr>
					<?php endif ?>
				<?php endforeach ?>
				<tr class="">
					<td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Pendapatan dari Penjualan') ?></td>
					<td class="text-right font-weight-bold"><?php echo formatnumberakunting($totalpenjualan) ?></td>
				</tr>
				
				<tr class="bg-grey-300">
					<td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Harga Pokok Penjualan') ?></td>
				</tr>
				<?php $totalhpp = 0 ?>
				<?php foreach ($hpp as $h): ?>
					<?php $totalhpp = $totalhpp + $h['saldo'] ?>
					<?php if ($h['saldo'] > 0): ?>
						<tr>
							<td colspan="2">
								<a href="{site_url}noakun/detail/<?php echo $h['noakun'] ?>">
									(<?php echo $h['noakun'] ?>) - <?php echo $h['namaakun'] ?> 
								</a>
							</td>
							<td class="text-right">(<?php echo formatnumberakunting($h['saldo']) ?>)</td>
						</tr>
					<?php endif ?>
				<?php endforeach ?>
				<tr class="">
					<td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Harga Pokok Penjualan') ?></td>
					<td class="text-right font-weight-bold">(<?php echo formatnumberakunting($totalhpp) ?>)</td>
				</tr>
				<tr class="bg-light">
					<td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Laba Kotor') ?></td>
					<?php $labakotor = $totalpenjualan-$totalhpp ?>
					<td class="text-right font-weight-bold"><?php echo formatnumberakunting($labakotor) ?></td>
				</tr>

				<tr class="bg-grey-300">
					<td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Beban Operasional') ?></td>
				</tr>
				<?php $totaloperasional = 0 ?>
				<?php foreach ($operasional as $opr): ?>
					<?php $totaloperasional = $totaloperasional + $opr['saldo'] ?>
					<?php if ($opr['saldo'] > 0): ?>
						<tr>
							<td colspan="2">
								<a href="{site_url}noakun/detail/<?php echo $opr['noakun'] ?>">
									(<?php echo $opr['noakun'] ?>) - <?php echo $opr['namaakun'] ?> 
								</a>
							</td>
							<td class="text-right">(<?php echo formatnumberakunting($opr['saldo']) ?>)</td>
						</tr>
					<?php endif ?>
				<?php endforeach ?>
				<tr class="">
					<td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Biaya') ?></td>
					<td class="text-right font-weight-bold">(<?php echo formatnumberakunting($totaloperasional) ?>)</td>
				</tr>
				<tr class="bg-light">
					<td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Pendapatan Bersih Operasional') ?></td>
					<?php $pendapatanbersihoperasional = $labakotor-$totaloperasional ?>
					<td class="text-right font-weight-bold"><?php echo formatnumberakunting($pendapatanbersihoperasional) ?></td>
				</tr>

				<tr class="bg-grey-300">
					<td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Pendapatan Lainya') ?></td>
				</tr>
				<?php $totalpendapatanlainlain = 0 ?>
				<?php foreach ($pendapatanlainnya as $pl): ?>
					<?php $totalpendapatanlainlain = $totalpendapatanlainlain + $pl['saldo'] ?>
					<?php if ($pl['saldo'] > 0): ?>
						<tr>
							<td colspan="2">
								<a href="{site_url}noakun/detail/<?php echo $pl['noakun'] ?>">
									(<?php echo $pl['noakun'] ?>) - <?php echo $pl['namaakun'] ?> 
								</a>
							</td>
							<td class="text-right"><?php echo formatnumberakunting($pl['saldo']) ?></td>
						</tr>
					<?php endif ?>
				<?php endforeach ?>
				<tr class="">
					<td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Pendapatan Lainnya') ?></td>
					<td class="text-right font-weight-bold"><?php echo formatnumberakunting($totalpendapatanlainlain) ?></td>
				</tr>

				<tr class="bg-grey-300">
					<td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Beban Lainya') ?></td>
				</tr>
				<?php $totalbiayalainnya = 0 ?>
				<?php foreach ($biayalainnya as $bl): ?>
					<?php $totalbiayalainnya = $totalbiayalainnya + $bl['saldo'] ?>
					<?php if ($bl['saldo'] > 0): ?>
						<tr>
							<td colspan="2">
								<a href="{site_url}noakun/detail/<?php echo $bl['noakun'] ?>">
									(<?php echo $bl['noakun'] ?>) - <?php echo $bl['namaakun'] ?> 
								</a>
							</td>
							<td class="text-right"><?php echo formatnumberakunting($bl['saldo']) ?></td>
						</tr>
					<?php endif ?>
				<?php endforeach ?>
				<tr class="">
					<td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Beban Lainnya') ?></td>
					<td class="text-right font-weight-bold"><?php echo formatnumberakunting($totalbiayalainnya) ?></td>
				</tr>

				<tr class="bg-info">
					<td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Laba / Rugi Bersih') ?></td>
					<?php $pendapatanbersih = $pendapatanbersihoperasional+$totalpendapatanlainlain-$totalbiayalainnya ?>
					<td class="text-right font-weight-bold"><?php echo formatnumberakunting($pendapatanbersih) ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
