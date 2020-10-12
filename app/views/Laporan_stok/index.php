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
		<form action="{site_url}laporan_stok/index" id="form1" method="get">
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
						<label><?php echo lang('Jenis') ?>:</label>
						<select type="text" class="form-control jenis" name="jenis"></select>
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
				<thead class="{bg_header}">
					<tr>
						<td class="text-left"><?php echo lang('date') ?></td>
						<td class="text-right"><?php echo lang('warehouse') ?></td>
						<td class="text-left"><?php echo lang('item') ?></td>
						<td class="text-right" width="10%"><?php echo lang('jumlah') ?></td>
						<td class="text-right"><?php echo lang('keterangan') ?></td>
					</tr>
				</thead>
				<tbody>
					<?php if ($getstok): ?>
						<?php $tbeli = 0; $treturbeli = 0; $tjual = 0; $treturjual = 0; $tin = 0; $tout = 0 ?>
						<?php foreach ($getstok as $row): ?>
							<?php if ($row['jenis'] == '1'): ?>
								<?php $tin = $tin + $row['jumlah'] ?>
							<?php else: ?>
								<?php $tout = $tout + $row['jumlah'] ?>
							<?php endif ?>
							<?php if ($row['jenis'] == '1' && $row['tipe'] == '1'): ?>
								<?php $tbeli = $tbeli + $row['jumlah'] ?>
							<?php endif ?>
							<?php if ($row['jenis'] == '1' && $row['tipe'] == '2'): ?>
								<?php $treturbeli = $treturbeli + $row['jumlah'] ?>
							<?php endif ?>
							<?php if ($row['jenis'] == '2' && $row['tipe'] == '1'): ?>
								<?php $tjual = $tjual + $row['jumlah'] ?>
							<?php endif ?>
							<?php if ($row['jenis'] == '2' && $row['tipe'] == '2'): ?>
								<?php $treturjual = $treturjual + $row['jumlah'] ?>
							<?php endif ?>
							<tr>
								<td><?php echo formatdateslash($row['tanggal']) ?></td>
								<td><?php echo $row['namagudang'] ?></td>
								<td><?php echo $row['namaitem'] ?></td>
								<td class="text-right"><?php echo number_format($row['jumlah']) ?></td>
								<td class="text-right">
									<?php if ($row['jenis'] == '1'): ?>
										<span class="badge badge-success"><?php echo $row['keterangan'] ?></span> 
									<?php else: ?>
										<span class="badge badge-danger"><?php echo $row['keterangan'] ?></span>  
									<?php endif ?>
								</td>
							</tr>
						<?php endforeach ?>
						<tr>
							<td colspan="5">&nbsp;</td>
						</tr>
						<tr class="font-weight-bold">
							<td colspan="4" class="text-right"><?php echo lang('Total_Jumlah_Stok_Masuk') ?></td>
							<td class="text-right"><?php echo number_format($tin) ?></td>
						</tr>
						<tr class="font-weight-bold">
							<td colspan="4" class="text-right"><?php echo lang('Total_Jumlah_Stok_Keluar') ?></td>
							<td class="text-right">(<?php echo number_format($tout) ?>)</td>
						</tr>
						<tr class="font-weight-bold bg-light">
							<td colspan="4" class="text-right"><?php echo lang('Total_Jumlah_Saat_Ini') ?></td>
							<td class="text-right"><?php echo number_format($tin-$tout) ?></td>
						</tr>
					<?php endif ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script type="text/javascript">
	var base_url = '{site_url}laporan_stok/';

    $(document).ready(function(){
	    $('.jenis').select2({
	        placeholder: 'Select an Option',
	        data: [
	            {id: '', text: 'Semua'},
	            {id: '1', text: 'Stok Masuk'},
	            {id: '2', text: 'Stok Keluar'},
	        ]
	    }).val('{jenis}').trigger('change');
        ajax_select({ id: '.kontakid', url: base_url + 'select2_kontakid', selected: { id: '{kontakid}' } });
        ajax_select({ id: '.gudangid', url: base_url + 'select2_gudangid', selected: { id: '{gudangid}' } });
        ajax_select({ id: '.itemid', url: base_url + 'select2_itemid', selected: { id: '{itemid}' } });
    })
</script>