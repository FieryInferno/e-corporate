<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-info22 mr-2"></i> <span class="font-weight-semibold">{title}</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none">
            <div class="d-flex justify-content-center">
                <div class="btn-group">
                    <a href="{site_url}kas_bank" class="btn btn-danger">
                        <?php echo lang('back') ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="card">
        <div class="card-header {bg_header}">
            <div class="header-elements-inline">
                <h5 class="card-title">{subtitle}</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6 text-left">

                </div>
                <div class="col-md-6 text-right">
                   <a href="{site_url}kas_bank/printpdf/{id}" target="_blank" class="btn btn-primary">
                        <?php echo lang('print') ?>
                    </a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td width="200px"><?php echo lang('No Kas Bank') ?></td>
                                <td class="font-weight-bold">{nomor_kas_bank}</td>
                            </tr>
                            <tr>
                                <td><?php echo lang('date') ?></td>
                                <td class="font-weight-bold">{tanggal}</td>
                            </tr>
                            <tr>
                                <td><?php echo lang('company') ?></td>
                                <td class="font-weight-bold"><?php echo $perusahaan['nama_perusahaan'] ?></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('Departemen / Penerima') ?></td>
                                <td class="font-weight-bold"><?php echo $departemen['nama'] ?> / <?php echo $departemen['pejabat'] ?></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('Keterangan') ?></td>
                                <td class="font-weight-bold">{keterangan}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
           
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        
                        <table class="table table-bordered">
                            <thead class="{bg_header}">
                                <tr>
                                    <th><?php echo lang('No') ?></th>
                                    <th><?php echo lang('Tipe') ?></th>
                                    <th><?php echo lang('date') ?></th>
                                    <th><?php echo lang('Nomor Aktivitas') ?></th>
                                    <th><?php echo lang('Penerimaan') ?></th>
                                    <th><?php echo lang('Pengeluaran') ?></th>
                                    <th><?php echo lang('Nomor Akun') ?></th>
                                    <th><?php echo lang('Kode Unit') ?></th>
                                    <th><?php echo lang('Nama Dapartemen') ?></th>
                                    <th><?php echo lang('Sumber Dana') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; $total_penerimaan = 0; $total_pengeluaran= 0; ?>
                                <?php foreach ($kasbankdetail as $row): ?>
                                    <?php $total_penerimaan = $row['penerimaan'] + $total_penerimaan; 
                                          $total_pengeluaran = $row['pengeluaran'] + $total_pengeluaran;
                                    ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $row['tipe'] ?></td>
                                        <td><?php echo $row['tanggal'] ?></td>
                                        <td><?php echo $row['nokwitansi'] ?></td>
                                        <td class="text-right">Rp. <?php echo number_format($row['penerimaan'],2,",",".") ?></td>
                                        <td class="text-right">Rp. <?php echo number_format($row['pengeluaran'],2,",",".") ?></td>
                                        <td><?php echo $row['nama_akun'].' '.$row['nomor_akun']?></td>
                                        <td><?php echo $row['kode_perusahaan'] ?></td>
                                        <td><?php echo $row['nama_departemen'] ?></td>
                                        <td><?php echo $row['nama_bank'].' '.$row['nomor_rekening']?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr class="bg-light">
                                    <td class="font-weight-bold text-right" colspan="4"><?php echo lang('grand_total') ?></td>
                                    <td class="font-weight-bold text-right">Rp. <?php echo number_format($total_penerimaan,2,",",".") ?></td>
                                    <td class="font-weight-bold text-right">Rp. <?php echo number_format($total_pengeluaran,2,",",".") ?></td>
                                    <td colspan="4"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>