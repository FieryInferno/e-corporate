<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{title}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{title}</li>
                    </ol>
                </div>
            </div>
            <div class="m-3">
                <form action="{site_url}utang/index" id="form1" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?php echo lang('Kontak') ?>:</label>
                                <select class="form-control kontakid" name="kontakid"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Usia Hutang : </label>
                                <select class="form-control" name="usiaHutang">
                                    <option value="kurang30">Kurang Dari 30 Hari</option>
                                    <option value="30">30 Hari</option>
                                    <option value="lebih30">Lebih Dari 30 Hari</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Perusahaan:</label>
                                <select class="form-control perusahaanid" name="perusahaanid"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><?php echo lang('start_date') ?>:</label>
                                <input type="date" class="form-control datepicker" name="tanggalawal" required value="{tanggalawal}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><?php echo lang('end_date') ?>:</label>
                                <input type="date" class="form-control datepicker" name="tanggalakhir" required value="{tanggalakhir}">
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
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">         
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-xs table-striped table-borderless table-hover">
                        <thead>
                            <tr class="table-active">
                                <th><?php echo lang('Tanggal') ?></th>
                                <th>Tgl J/T</th>
                                <th><?php echo lang('No Invoice') ?></th>
                                <th><?php echo lang('Keterangan') ?></th>
                                <th><?php echo lang('Supplier') ?></th>
                                <th class="text-center"><?php echo lang('Utang') ?></th>
                                <th class="text-center"><?php echo lang('Sudah Dibayar') ?></th>
                                <th class="text-center"><?php echo lang('Sisa Utang') ?></th>
                                <th class="text-center">Usia Hutang</th>
                                <th class="text-right"><?php echo lang('action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($get_utang): ?>
                                <?php $totalutang = 0; $grandtotaldibayar = 0; $totalsisatagihan = 0 ?>
                                <?php foreach ($get_utang as $row): ?>
                                    <?php if($row['sisatagihan'] != 0) : ?>
                                        <?php $totalutang = $totalutang + $row['total'] ?>
                                        <?php $grandtotaldibayar = $grandtotaldibayar + $row['totaldibayar'] ?>
                                        <?php $totalsisatagihan = $totalsisatagihan + $row['sisatagihan'] ?>
                                        <tr>
                                            <td><?php echo formatdatemonthname($row['tanggal']) ?></td>
                                            <td></td>
                                            <td>
                                                <a href="{site_url}faktur_pembelian/detail/<?php echo $row['idfaktur'] ?>" class="badge badge-info"><?php echo $row['notrans'] ?></a>
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
                                                    <a href="{site_url}pembayaran_pembelian/printpdf/<?php echo $pembayaran['id'] ?>" class="btn btn-sm btn-info"><i class="icon icon-printer"></i></a>
                                                <?php else: ?>
                                                    <a href="{site_url}pembayaran_pembelian/create?idfaktur=<?php echo $row['idfaktur'] ?>" class="btn btn-sm btn-primary">Pembayaran</a>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach ?>
                                <tr class="bg-grey-300">
                                    <td colspan="4">Total Utang :</td>
                                    <td class="text-center font-weight-bold"><?php echo number_format($totalutang) ?></td>
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
        </div>
      </div>
    </section>
  </div>
<script type="text/javascript">
	var base_url = '{site_url}utang/';
	ajax_select({ id: '.kontakid', url: base_url + 'select2_kontak', selected: { id: '{kontakid}' } });
    ajax_select({ 
        id          : '.perusahaanid', 
        url         : '{site_url}perusahaan/select2', 
        selected    : { 
            id: '{perusahaanid}' 
        } 
    });
</script>