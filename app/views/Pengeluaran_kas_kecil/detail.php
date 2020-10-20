
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
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">{title}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <a href="{site_url}Pengeluaran_kas_kecil" class="btn btn-tool"><i class="fas fa-times"></i></a>
       
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6 text-left">

                </div>
                <div class="col-md-6 text-right">
                    <?php if ($status == '0'): ?>
                        <h1 class="text-danger font-weight-bold text-uppercase"><?php echo lang('pending') ?></h1>
                    <?php else: ?>
                        <h1 class="text-success font-weight-bold text-uppercase"><?php echo lang('Validasi') ?></h1>
                    <?php endif ?>
                </div>
            </div>
  
            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><?php echo lang('notrans') ?></td>
                                <td class="font-weight-bold">{nokwitansi}</td>
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
                                <td><?php echo lang('Departemen') ?></td>
                                <td class="font-weight-bold"><?php echo $departemen['nama'] ?></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('Nama Penerima') ?></td>
                                <td class="font-weight-bold">{pejabat}</td>
                            </tr>
                            <tr>
                                <td><?php echo lang('keterangan') ?></td>
                                <td class="font-weight-bold">{keterangan}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><?php echo lang('subtotal') ?></td>
                                <td class="text-right font-weight-bold">Rp. <?php echo number_format($subtotal,2,",",".") ?></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('discount') ?></td>
                                <td class="text-right font-weight-bold">Rp. <?php echo number_format($diskon,2,",",".") ?></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('Pajak') ?></td>
                                <td class="text-right font-weight-bold">Rp. <?php echo number_format($pajak,2,",",".") ?></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('Biaya Pengiriman') ?></td>
                                <td class="text-right font-weight-bold">Rp. <?php echo number_format($biaya_pengiriman,2,",",".") ?></td>
                            </tr>
                            <tr class="bg-light">
                                <td><?php echo lang('total') ?></td>
                                <td class="text-right font-weight-bold">Rp. <?php echo number_format($total,2,",",".") ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="table-responsive">
                        
                        <table class="table table-bordered">
                            <thead class="{bg_header}">
                                <tr>
                                    <th><?php echo lang('item') ?></th>
                                    <th class="text-right"><?php echo lang('price') ?></th>
                                    <th class="text-right"><?php echo lang('qty') ?></th>
                                    <th class="text-right"><?php echo lang('subtotal') ?></th>
                                    <th class="text-right"><?php echo lang('discount') ?></th>
                                    <th class="text-right"><?php echo lang('Pajak') ?></th>
                                    <th class="text-right"><?php echo lang('Biaya Pengiriman') ?></th>
                                    <th class="text-right"><?php echo lang('total') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $grandtotal = 0; ?>
                                <?php foreach ($pengeluarkaskecildetail as $row): ?>
                                    <?php $grandtotal = $row['total'] + $grandtotal ?>
                                    <tr>
                                        <td><?php echo $row['nama_item'] ?></td>
                                        <td class="text-right">Rp. <?php echo number_format($row['harga'],2,",",".") ?></td>
                                        <td class="text-right"><?php echo number_format($row['jumlah']) ?></td>
                                        <td class="text-right">Rp. <?php echo number_format($row['subtotal'],2,",",".") ?></td>
                                        <td class="text-right"><?php echo number_format($row['diskon']) ?>%</td>
                                        <td class="text-right">Rp.<?php echo number_format($row['pajak'],2,",",".") ?></td>
                                        <td class="text-right">Rp.<?php echo number_format($row['biaya_pengiriman'],2,",",".") ?></td>
                                        <td class="text-right">Rp.<?php echo number_format($row['total'],2,",",".") ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr class="bg-light">
                                    <td class="font-weight-bold text-right" colspan="7"><?php echo lang('grand_total') ?></td>
                                    <td class="font-weight-bold text-right">Rp. <?php echo number_format($grandtotal,2,",",".") ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
          
          </div>
        </div>
      </div>
    </section>
  </div>

