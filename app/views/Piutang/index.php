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
                <form action="{site_url}piutang/index" id="form1" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?php echo lang('Kontak') ?>:</label>
                                <select class="form-control kontakid" name="kontakid"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Usia Piutang : </label>
                                <select class="form-control" name="usiaHutang">
                                    <option value="">Pilih Usia Hutang</option>
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
                                <input type="text" class="form-control datepicker" name="tanggalawal" placeholder="Tanggal Awal">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><?php echo lang('end_date') ?>:</label>
                                <input type="text" class="form-control datepicker" name="tanggalakhir" placeholder="Tanggal Akhir">
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
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-xs table-striped table-borderless table-hover" id="tabelPiutang">
                                    <thead>
                                        <tr class="table-active">
                                            <th>Tgl Inv</th>
                                            <th>Tgl J/T</th>
                                            <th><?php echo lang('No Invoice') ?></th>
                                            <th>Nama Perusahaan</th>
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
                                        <?php
                                            foreach ($piutang as $key) { ?>
                                                <tr>
                                                    <td><?= $key['tanggal']; ?></td>
                                                    <td><?= $key['tanggalTempo']; ?></td>
                                                    <td><?= $key['noInvoice']; ?></td>
                                                    <td><?= $key['nama_perusahaan']; ?></td>
                                                    <td><?= $key['deskripsi']; ?></td>
                                                    <td><?= $key['namaPelanggan']; ?></td>
                                                    <td><?= number_format($key['primeOwing'],2,',','.'); ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <div class="list-icons"> 
                                                            <div class="dropdown"> 
                                                                <a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
                                                                <div class="dropdown-menu dropdown-menu-right">

                                                                </div> 
                                                            </div> 
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </div>
<script type="text/javascript">
	var base_url = '{site_url}piutang/';
	ajax_select({ id: '.kontakid', url: base_url + 'select2_kontak', selected: { id: '{kontakid}' } });
    ajax_select({ 
        id          : '.perusahaanid', 
        url         : '{site_url}perusahaan/select2', 
        selected    : { 
            id: '{perusahaanid}' 
        } 
    });
    $('#tabelPiutang').DataTable();
</script>