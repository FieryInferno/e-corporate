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
      <div class="row">
        <div class="col-12">         
          <div class="card">
            <div class="card-header">
              <form action="{site_url}jurnal">
                <div class="row">
                  <div class="col-2">
                    <select name="tipe" id="tipe" class="form-control">
                      <option value="" disabled selected>-- Semua Jenis --</option>
                      <option value="saldoAwal">Saldo Awal</option>
                      <option value="fakturPenjualan">Faktur Penjualan</option>
                      <option value="fakturPembelian">Faktur Pembelian</option>
                      <option value="kasBank">Kas Bank</option>
                      <option value="penerimaanBarang">Penerimaan Barang</option>
                      <option value="pengirimanBarang">Pengiriman Barang</option>
                      <option value="jurnalPenyesuaian">Jurnal Penyesuaian</option>
                      <option value="kasKecil">Kas Kecil</option>
                    </select>
                  </div>
                  <div class="col-2">
                    <input type="date" name="tglMulai" placeholder="Tanggal Mulai" class="form-control">
                  </div>
                  <div class="col-2">
                    <input type="date" name="tglSampai" placeholder="Tanggal Sampai" class="form-control">
                  </div>
                  <div class="col-2">
                    <input type="text" name="kodeAkun" placeholder="Kode Akun" class="form-control">
                  </div>
                  <div class="col-2">
                    <button class="btn btn-info" type="submit">Filter</button>
                    <button class="btn btn-danger">Reset</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-xs index_datatable">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Tipe</th>
                      <th>No Trans</th>
                      <th>Departemen</th>
                      <th>Nama Perusahaan</th>
                      <th>Nomor Akun</th>
                      <th>Nama Akun</th>
                      <th>Debit</th>
                      <th>Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // print_r($jurnalUmum);
                      foreach ($jurnalUmum as $key => $value) { ?>
                          <tr>
                            <td><?= $value['tanggal']; ?></td>
                            <td><?= $value['formulir']; ?></td>
                            <td><?= $value['noTrans']; ?></td>
                            <td><?= $value['departemen']; ?></td>
                            <td><?= $value['nama_perusahaan']; ?></td>
                            <td><?= $value['akunno']; ?></td>
                            <td><?= $value['namaakun']; ?></td>
                            <?php  
                                switch ($value['jenis']) {
                                  case 'debit': ?>
                                    <td>Rp. <?= number_format($value['total'],2,',','.'); ?></td>
                                    <td>Rp. <?= number_format(0,2,',','.'); ?></td>
                                    <?php break;
                                  case 'kredit': ?>
                                    <td>Rp. <?= number_format(0,2,',','.'); ?></td>
                                    <td>Rp. <?= number_format($value['total'],2,',','.'); ?></td>
                                    <?php break;
                                  default: ?>
                                    <td>Rp. <?= number_format($value['totalDebit'],2,',','.'); ?></td>
                                    <td>Rp. <?= number_format($value['totalKredit'],2,',','.'); ?></td>
                                    <?php break;
                                } ?>
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
<script>
  var table     = $('.index_datatable').DataTable(); 
</script>