<div class="page-header page-header-light">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4><i class="icon-info22 mr-2"></i> <span class="font-weight-semibold">{title}</span></h4>
		</div>
	</div>
	<hr>
	<div class="m-3">
		<form action="{site_url}laporan_pembelian/index" id="form1" method="get">
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
						<label><?php echo lang('status') ?>:</label>
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
			<table class="table table-xs table-bordered">
				<thead class="{bg_header}">
					<tr>
						<th width="10%" rowspan="2"><?php echo lang('Nopo') ?></th>
						<th class="text-center" width="10%" rowspan="2"><?php echo lang('Nodo') ?></th>
						<th class="text-center" width="10%" rowspan="2"><?php echo lang('invoice') ?></th>
						<th class="text-center" width="10%" rowspan="2"><?php echo lang('supplier') ?></th>
						<th class="text-center" width="10%" rowspan="2"><?php echo lang('warehouse') ?></th>
						<th class="text-center" colspan="8"><?php echo lang('item') ?></th>
					</tr>
					<tr>
						<td class="text-left" width="30%"><?php echo lang('name') ?></td>
						<td class="text-left" width="5%"><?php echo lang('unit') ?></td>
						<td class="text-right" width="5%"><?php echo lang('price') ?></td>
						<td class="text-right" width="5%"><?php echo lang('qty') ?></td>
						<td class="text-right" width="5%"><?php echo lang('subtotal') ?></td>
						<td class="text-right" width="5%"><?php echo lang('discount') ?></td>
						<td class="text-right" width="5%"><?php echo lang('ppn') ?></td>
						<td class="text-right" width="5%"><?php echo lang('total') ?></td>
					</tr>
				</thead>
				<tbody>
					<?php $totalpembelian = 0 ?>
					<?php if ($this->input->get('itemid')): ?>
						<?php foreach ($get_faktur_pembelian as $row): ?>
							<?php $countdetail = $row['countdetail'] ?>
							<tr>
								<td rowspan="<?php echo $countdetail ?>">
									
								</td>
								<td rowspan="<?php echo $countdetail ?>">
									<?php echo $row['nopengiriman'] ?>
								</td>
								<td rowspan="<?php echo $row['countdetail'] ?>">
									<?php echo $row['nofaktur'] ?> 
								</td>
								<td rowspan="<?php echo $row['countdetail'] ?>">
									<?php echo $row['kontak'] ?> 
								</td>
								<td rowspan="<?php echo $row['countdetail'] ?>">
									<?php echo $row['gudang'] ?> 
								</td>
								<?php foreach ($this->model->get_faktur_pembelian_detail($row['id']) as $det): ?>
									<?php if ($det['itemid'] == $this->input->get('itemid')): ?>
										<?php $totalpembelian = $totalpembelian + $det['total'] ?>
										<td> <?php echo $det['item'] ?> </td>
										<td> <?php echo $det['jumlah'] ?> </td>
										<td class="text-right"> <?php echo number_format($det['harga']) ?> </td>
										<td class="text-right"> <?php echo number_format($det['jumlah']) ?> </td>
										<td class="text-right"> <?php echo number_format($det['subtotal']) ?> </td>
										<td class="text-right"> <?php echo number_format($det['diskon']) ?> </td>
										<td class="text-right"> <?php echo number_format($det['ppn']) ?> </td>
										<td class="text-right"> <?php echo number_format($det['total']) ?> </td>
									<?php endif ?>
								<?php endforeach ?>
							</tr>
						<?php endforeach ?>
					<?php else: ?>
						<?php foreach ($get_faktur_pembelian as $row): ?>
							<?php $countdetail = $row['countdetail'] ?>
							<tr>
								<td rowspan="<?php echo $countdetail ?>">
									<?php echo $row['nopemesanan'] ?>
								</td>
								<td rowspan="<?php echo $countdetail ?>">
									<?php echo $row['nopengiriman'] ?>
								</td>
								<td rowspan="<?php echo $row['countdetail'] ?>">
									<?php echo $row['nofaktur'] ?> 
								</td>
								<td rowspan="<?php echo $row['countdetail'] ?>">
									<?php echo $row['kontak'] ?> 
								</td>
								<td rowspan="<?php echo $row['countdetail'] ?>">
									<?php echo $row['gudang'] ?> 
								</td>
								<?php $nodetail = 0 ?>
								<?php foreach ($this->model->get_faktur_pembelian_detail($row['id']) as $det): ?>
									<?php if ($nodetail == 0): ?>
										<?php $totalpembelian = $totalpembelian + $det['total'] ?>

										<td> <?php echo $det['item'] ?> </td>
										<td> <?php echo $det['jumlah'] ?> </td>
										<td class="text-right"> <?php echo number_format($det['harga']) ?> </td>
										<td class="text-right"> <?php echo number_format($det['jumlah']) ?> </td>
										<td class="text-right"> <?php echo number_format($det['subtotal']) ?> </td>
										<td class="text-right"> <?php echo number_format($det['diskon']) ?> </td>
										<td class="text-right"> <?php echo number_format($det['ppn']) ?> </td>
										<td class="text-right"> <?php echo number_format($det['total']) ?> </td>
									<?php endif ?>
									<?php $nodetail++ ?>
									
								<?php endforeach ?>
							</tr>
							<?php $nodetail = 0 ?>
							<?php foreach ($this->model->get_faktur_pembelian_detail($row['id']) as $det): ?>
								<?php if ($nodetail > 0): ?>
									<tr>
										<?php $totalpembelian = $totalpembelian + $det['total'] ?>
										<td> <?php echo $det['item'] ?> </td>
										<td> <?php echo $det['jumlah'] ?> </td>
										<td class="text-right"> <?php echo number_format($det['harga']) ?> </td>
										<td class="text-right"> <?php echo number_format($det['jumlah']) ?> </td>
										<td class="text-right"> <?php echo number_format($det['subtotal']) ?> </td>
										<td class="text-right"> <?php echo number_format($det['diskon']) ?> </td>
										<td class="text-right"> <?php echo number_format($det['ppn']) ?> </td>
										<td class="text-right"> <?php echo number_format($det['total']) ?> </td>
									</tr>
								<?php endif ?>
								<?php $nodetail++ ?>
							<?php endforeach ?>
						<?php endforeach ?>
					<?php endif ?>
				</tbody>
				<tfoot class="bg-light">
					<td colspan="12" class="text-right font-weight-semibold">Total Pembelian</td>
					<td class="text-right font-weight-semibold"><?php echo number_format($totalpembelian) ?></td>
				</tfoot>
			</table>
		</div>
	</div>
</div>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script type="text/javascript">
	var base_url = '{site_url}laporan_pembelian/';

    $(document).ready(function(){
	    $('.status').select2({
	        placeholder: 'Select an Option',
	        data: [
	            {id: '', text: 'Semua'},
	            {id: '2', text: 'Proses'},
	            {id: '3', text: 'Selesai'},
	        ]
	    }).val('{status}').trigger('change');	
        ajax_select({ id: '.kontakid', url: base_url + 'select2_kontakid', selected: { id: '{kontakid}' } });
        ajax_select({ id: '.gudangid', url: base_url + 'select2_gudangid', selected: { id: '{gudangid}' } });
        ajax_select({ id: '.itemid', url: base_url + 'select2_itemid', selected: { id: '{itemid}' } });
    })
</script>