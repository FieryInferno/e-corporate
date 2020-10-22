
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
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{title}</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6 text-left">

                </div>
                <div class="col-md-6 text-right">
                    <a href="{site_url}Kas_bank/printpdf/{id}" target="_blank" class="btn btn-primary">
                        <?php echo lang('print') ?>
                    </a>
                </div>
            </div>
  
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
                            <tr><td></td><td></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead">
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
                                        <td><?php echo $row['noakun'] ?></td>
                                        <td><?php echo $row['kodeunit'] ?></td>
                                        <td><?php echo $row['departemen'] ?></td>
                                        <td><?php echo $row['sumberdana'] ?></td>
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
    </section>
  </div>

