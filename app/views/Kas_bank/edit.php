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
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tambah {title}</h3>
        </div>
        <div class="card-body">
          <form action="javascript:save()" id="form1">
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label><?php echo lang('number') ?>:</label>
                  <div class="row">
                    <div class="col-md-6">
                      <input type="text" class="form-control" name="nomor_kas_bank" id="nomor" placeholder="AUTO" readonly value="<?= $kas_bank['nomor_kas_bank']; ?>">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label><?php echo lang('date') ?>:</label>
                  <div class="input-group">
                    <input type="date" id="tanggal" class="form-control datepicker" name="tanggal" required value="<?= $kas_bank['tanggal']; ?>">
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label><?php echo lang('company') ?>:</label>
                  <?php
                    if ($this->session->userid !== '1') { ?>
                      <input type="hidden" name="perusahaan" value="<?= $this->session->idperusahaan; ?>" id="id_perusahaan">
                      <input type="text" class="form-control" value="<?= $this->session->perusahaan; ?>" disabled>
                    <?php } else { ?>
                      <select class="form-control id_perusahaan" name="perusahaan" style="width: 100%;" id="id_perusahaan" required></select>
                    <?php }
                  ?>
                </div>
                <div class="form-group">
                  <label>PIC :</label>    
                  <select id="pejabat" class="form-control" name="pejabat" required></select>
                </div>
                <div class="form-group">
                  <label><?php echo lang('information') ?>:</label>
                  <textarea class="form-control" name="keterangan" rows="3"><?= $kas_bank['keterangan']; ?></textarea>
                </div>
                <input type="hidden" name="detail_array" id="detail_array">
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="custom-tabs-rincian-buku-kas-umum-tab" data-toggle="pill" href="#rincian_buku_kas_umum" role="tab" aria-controls="custom-tabs-RBKU" aria-selected="true"><?php echo lang('Rincian Buku Kas Umum') ?></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-saldo-sumber-dana-tab" data-toggle="pill" href="#saldo_sumber_dana" role="tab" aria-controls="custom-tabs-SSD" aria-selected="false"><?php echo lang('Saldo Sumber Dana') ?></a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane fade active show" id="rincian_buku_kas_umum" role="tabpanel" aria-labelledby="custom-tabs-rincian-buku-kas-umump-tab">
                      <div class="text-center">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#piutang">Piutang</button>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#hutang">Hutang</button>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Penjualan">Penjualan</button>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Pembelian">Pembelian</button>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#BudgetEvent">Budget Event</button>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#RewardSales">Reward Sales</button>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#SetorPajak">Setor Pajak</button>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#PengajuanKasKecil">Kas Kecil</button>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#SetorKasKecil">Stor Kas Kecil</button>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ReturJual">Retur Jual</button>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ReturBeli">Retur Beli</button>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Deposito">Deposito</button>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pindahBuku">Pindah Buku</button>
                      </div>
                      <div class="mb-3 mt-3 table-responsive">
                        <div class="table-responsive">
                          <table class="table table-xs table-striped table-borderless table-hover index_datatable" id="table_detail_rincian_buku_kas_umum">
                            <thead>
                              <tr class="table-active">
                                <th><?php echo lang('ID') ?></th>
                                <th><?php echo lang('') ?></th>
                                <th><?php echo lang('Tipe') ?></th>
                                <th><?php echo lang('date') ?></th>
                                <th><?php echo lang('Nomor Aktivitas') ?></th>
                                <th><?php echo lang('Penerimaan') ?></th>
                                <th><?php echo lang('Pengeluaran') ?></th>
                                <th><?php echo lang('Nomor Akun') ?></th>
                                <th><?php echo lang('Kode Unit') ?></th>
                                <th><?php echo lang('Nama Dapartemen') ?></th>
                                <th><?php echo lang('Sumber Dana') ?></th>
                                <th><?php echo lang('Cara Bayar') ?></th>
                                <th><?php echo lang('Setup Jurnal') ?></th>
                              </tr>
                            </thead>
                            <tbody id="isitabel"></tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="saldo_sumber_dana" role="tabpanel" aria-labelledby="custom-saldo-sumber-dana-tab">
                      <div class="mb-3 mt-3 table-responsive">
                        <div class="table-responsive">
                          <table class="table table-xs table-striped table-borderless table-hover" id="table_detail_rincian_saldo_sumber_dana" width="100%">
                            <thead id="atastabel" >
                              <tr class="table-active">
                                <th><?php echo lang('ID') ?></th>
                                <th><?php echo lang('Nama Rekening Bank') ?></th>
                                <th><?php echo lang('Saldo Awal') ?></th>
                                <th><?php echo lang('Penerimaan') ?></th>
                                <th><?php echo lang('Pengeluaran') ?></th>
                                <th><?php echo lang('Saldo Akhir') ?></th>
                              </tr>
                            </thead>
                            <tbody id="isitabel">
                            </tbody>
                            <tfoot>
                              <tr class="table-active">
                                <td> ID</td>
                                <td> Total</td>
                                <td><div id="tot_saldo_awal"></div></td>
                                <td><div id="tot_penerimaan"></div></td>
                                <td><div id="tot_pengeluaran"></div></td>
                                <td><div id="tot_saldo_akhir"></div></td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-2 text-right" style="margin-top: 1%">Total Penerimaan</div>
              <div class="col-md-3">
                <input type="text" id="penerimaan" class="form-control decimalnumber text-right" name="penerimaan" readonly>
              </div>
              <div class="col-md-2 text-right" style="margin-top: 1%">Total Pengeluaran</div>
              <div class="col-md-3">
                <input type="text" id="pengeluaran" class="form-control decimalnumber text-right" name="pengeluaran" readonly>
              </div>
              <input type="hidden" id="pengeluaran_pemindahbukuan" class="form-control decimalnumber text-right" name="pengeluaran_pemindahbukuan" readonly>
              <div class="col-md-3"></div>
            </div>
            <br>
            <div class="text-right">
              <div class="btn-group">
                <a href="{site_url}Kas_bank" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                &nbsp;<button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Start: Modal Penjualan -->
<div class="modal fade" id="Penjualan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-xs table-striped table-borderless table-hover" id="tabelpenjualan">
                        <thead>
                            <tr class="table-active">
                                <th>&nbsp;</th>
                                <th>Nominal Bayar</th>
                                <th>Keterangan</th>
                                <th>Nomor Faktur</th>
                                <th>Kontak</th>
                                <th>Nama Pelanggan</th>
                                <th>Tanggal</th>
                                <th>Nominal</th>
                                <th>Nama Rekening Bank</th>
                            </tr>
                        </thead>
                        <tbody id='list_penjualan'></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>
<!-- End: Modal -->

<!-- Start: Modal Pembelian -->
<div class="modal fade" id="Pembelian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Pembelian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-xs table-striped table-borderless table-hover" id="tabelpembelian">
                        <thead>
                            <tr class="table-active">
                                <th>&nbsp;</th>
                                <th>Nominal Bayar</th>
                                <th>keterangan</th>
                                <th>Nomor Faktur</th>
                                <th>Kontak</th>
                                <th>Tanggal</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody id='list_pembelian'></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>
<!-- End: Modal -->

<!-- Start: Modal budget event -->
<div class="modal fade" id="BudgetEvent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Budget Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-xs table-striped table-borderless table-hover" id="tabelbudgetevent">
                        <thead>
                            <tr class="table-active">
                                <th>&nbsp;</th>
                                <th>Kode Kwitansi</th>
                                <th>Keterangan</th>
                                <th>Departemen</th>
                                <th>Tanggal</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody id='list_budgetevent'></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>
<!-- End: Modal -->

<!-- Start: Modal RewardSales -->
<div class="modal fade" id="RewardSales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Reward Sales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table" id="tabelrewardsales">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Kode Kwitansi</th>
                            <th>Kontak</th>
                            <th>Keterangan</th>
                            <th>Departemen</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody id='list_rewardsales'>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>
<!-- End: Modal -->

<!-- Start: Modal SetorPajak -->
<div class="modal fade" id="SetorPajak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Setor Pajak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-xs table-striped table-borderless table-hover" id="tabelsetorpajak">
                        <thead>
                            <tr class="table-active">
                                <th>&nbsp;</th>
                                <th>Kode Kwitansi</th>
                                <th>Departemen</th>
                                <th>Tanggal</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody id='list_setorpajak'></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>
<!-- End: Modal -->

<!-- Start: Modal Pengajuan Kas Kecil -->
<div class="modal fade" id="PengajuanKasKecil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Kas Kecil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-xs table-striped table-borderless table-hover" id="tabelkaskecil">
                        <thead>
                            <tr class="table-active">
                                <th>&nbsp;</th>
                                <th>Kode Kwitansi</th>
                                <th>Keterangan</th>
                                <th>Departemen</th>
                                <th>Tanggal</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody id='list_KasKecil'></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>
<!-- End: Modal -->

<!-- Start: Modal Setor Kas Kecil -->
<div class="modal fade" id="SetorKasKecil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Setor Kas Kecil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-xs table-striped table-borderless table-hover" id="tabelsetorkaskecil">
                        <thead>
                            <tr class="table-active">
                            <th>&nbsp;</th>
                            <th>Kode Kwitansi</th>
                            <th>Keterangan</th>
                            <th>Departemen</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody id='list_SetorKasKecil'></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>
<!-- End: Modal -->

<!-- Start: Modal ReturJual -->
<div class="modal fade" id="ReturJual" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Retur Jual</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table" id="tabelreturjual">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Kode Kwitansi</th>
                            <th>Kontak</th>
                            <th>Keterangan</th>
                            <th>Departemen</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody id='list_returjual'>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>
<!-- End: Modal -->


<!-- Start: Modal ReturBeli -->
<div class="modal fade" id="ReturBeli" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Retur Beli</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table" id="tabelreturbeli">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Kode Kwitansi</th>
                            <th>Kontak</th>
                            <th>Keterangan</th>
                            <th>Departemen</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody id='list_returbeli'>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>
<!-- End: Modal -->

<!-- Start: Modal Deposito -->
<div class="modal fade" id="Deposito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Deposito</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table" id="tabeldeposito">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Kode Kwitansi</th>
                            <th>Keterangan</th>
                            <th>Departemen</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody id='list_deposito'>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>
<!-- End: Modal -->

<!-- Start: Modal Piutang -->
<div class="modal fade" id="piutang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Piutang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-xs table-striped table-borderless table-hover" id="tabelPiutang">
                        <thead>
                            <tr class="table-active">
                                <th>&nbsp;</th>
                                <th>Tgl Inv</th>
                                <th>Tgl J/T</th>
                                <th><?php echo lang('No Invoice') ?></th>
                                <th><?php echo lang('Keterangan') ?></th>
                                <th><?php echo lang('Supplier') ?></th>
                                <th class="text-center"><?php echo lang('piutang') ?></th>
                                <th class="text-center"><?php echo lang('Sudah Dibayar') ?></th>
                                <th class="text-center"><?php echo lang('Sisa piutang') ?></th>
                            </tr>
                        </thead>
                        <tbody id="listPiutang"></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>
<!-- End: Modal -->

<!-- Start: Modal Hutang -->
<div class="modal fade" id="hutang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Hutang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-xs table-striped table-borderless table-hover index_datatable" id="tabelHutang">
                        <thead>
                            <tr class="table-active">
                                <th>&nbsp;</th>
                                <th><?php echo lang('Tanggal') ?></th>
                                <th>Tgl J/T</th>
                                <th><?php echo lang('No Invoice') ?></th>
                                <th><?php echo lang('Keterangan') ?></th>
                                <th><?php echo lang('Supplier') ?></th>
                                <th class="text-center"><?php echo lang('Utang') ?></th>
                                <th class="text-center"><?php echo lang('Sudah Dibayar') ?></th>
                                <th class="text-center"><?php echo lang('Sisa Utang') ?></th>
                                <th class="text-center">Usia Hutang</th>
                            </tr>
                        </thead>
                        <tbody id="listHutang"></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>
<!-- End: Modal -->

<!-- Start: Modal Pindah Buku -->
<div class="modal fade" id="pindahBuku" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Pindah Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formPindahBuku">
                    <div class="table-responsive">
                        <table class="table table-xs table-striped table-borderless table-hover" id="tabelPindahBuku">
                            <thead>
                                <tr class="table-active">
                                    <th>Tipe</th>
                                    <th>Sumber Dana</th>
                                    <th>Nomor Akun</th>
                                    <th>Penerimaan</th>
                                    <th>Pengeluaran</th>
                                </tr>
                            </thead>
                            <tbody id='list_pindahBuku'></tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="simpanPindahBuku()">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>
<!-- End: Modal -->

<script type="text/javascript">
    var base_url    = '{site_url}Kas_bank/';
    var saldoSumberDana;
    var idPerusahaan;
    $.fn.dataTable.Api.register( 'hasValue()' , function(value) {
        return this .data() .toArray() .toString() .toLowerCase() .split(',') .indexOf(value.toString().toLowerCase())>-1
    })

    $(document).ready(function(){
        if ('<?= $this->session->userid; ?>' !== '1') {
            ajax_select({
                id        : '#pejabat',
                url       : base_url + 'select2_mdepartemen_pejabat/<?= $this->session->idperusahaan; ?>',
                selected  : {
                  id  : '<?= $kas_bank['pejabat']; ?>'
                }
            });

            getListPenjualan();
            getListPembelian();
            getListBudgetEvent();
            getListKasKecil();
            getListSetorKasKecil();
            getPiutang();
            getHutang();
            getSaldoSumberDana('edit');
            getPindahBuku();
            getSetorPajak();
            $.ajax({
                url     : '{site_url}SetUpJurnal/get',
                method  : 'post',
                data    : {
                    jenis       : 'kas bank',
                    formulir    : 'kasBank'
                },
                success : function (response) {
                    $("#setupJurnal").val(response.kodeJurnal);
                    $("#idSetupJurnal").val(response.idSetupJurnal);
                }
            })
        } else {
          ajax_select({
            id        : '#id_perusahaan',
            url       : base_url + 'select2_mperusahaan',
            selected  : {
              id  : '<?= $kas_bank["perusahaan"]; ?>'
            }
          });

            ajax_select({
                id          : '#pejabat',
                url         : base_url + 'select2_mdepartemen_pejabat/<?= $kas_bank["perusahaan"]; ?>',
                selected    : {
                    id  : '<?= $kas_bank['pejabat']; ?>'
                }
            });

            getSaldoSumberDana();
        }
        
      $.ajax({
        url   : base_url + 'getDetailKasBank',
        type  : 'post',
        data  : {
          idKasBank : '<?= $kas_bank["id"]; ?>'
        },
        success : function (response) {
          response.forEach(element => {
            save_detail(element, 'edit');
          });
        }
      })
    })

    //combobox nama penerima/pejabat
    $('#id_perusahaan').change(function(e) {
        tabelpenjualan.clear().draw();
        tabelpembelian.clear().draw();
        tabelbudgetevent.clear().draw();
        tabelrewardsales.clear().draw();
        tabelsetorpajak.clear().draw();
        tabelkaskecil.clear().draw();
        tabelsetorkaskecil.clear().draw();
        tabelreturbeli.clear().draw();
        tabelreturbeli.clear().draw();
        tabeldeposito.clear().draw();
        tabelPiutang.clear().draw();
        tabelHutang.clear().draw();
        tabelPindahBuku.clear().draw();

        $("#pejabat").val($("#pejabat").data("default-value"));
        $('input[name=penerimaan]').val('0'); 
        $('input[name=pengeluaran]').val('0');
        var perusahaanId    = $('#id_perusahaan').children('option:selected').val();
        idPerusahaan        = perusahaanId;
        ajax_select({
            id: '#pejabat',
            url: base_url + 'select2_mdepartemen_pejabat/' + perusahaanId,
        });
        getListPenjualan();
        getListPembelian();
        getListBudgetEvent();
        getListKasKecil();
        getListSetorKasKecil();
        getPiutang();
        getHutang();
        getSaldoSumberDana();
        getPindahBuku();
        getSetorPajak();
        $.ajax({
            url     : '{site_url}SetUpJurnal/get',
            method  : 'post',
            data    : {
                jenis       : 'kas bank',
                formulir    : 'kasBank'
            },
            success : function (response) {
                $("#setupJurnal").val(response.kodeJurnal);
                $("#idSetupJurnal").val(response.idSetupJurnal);
            }
        })
    })

    function simpanPindahBuku(no) {
        var pindahBuku  = tabelPindahBuku.data().toArray();
        var formData    = new FormData($('#formPindahBuku')[0]);
        var penerimaan  = formData.getAll('penerimaanPindahBuku');
        var pengeluaran = formData.getAll('pengeluaranPindahBuku');
        var idakun      = formData.getAll('akun');
        var idRekening  = formData.getAll('rekening');
        var i           = 0;
        for (let index = 0; index < saldoSumberDana.length; index++) {
            const element = saldoSumberDana[index];
            if (idRekening == element.id) {
                row = index;
                break;
            }
            row = index;
        }
        var data    = table_detail_SSD.row(row).data();
        var terima  = data[3].toString().replace(/([\.]|,00)/g, '')*1;
        var keluar  = data[4].toString().replace(/([\.]|,00)/g, '')*1;
        pindahBuku.forEach(element => {
            if (penerimaan[i] !== '' || pengeluaran[i] !== '') {
                if (penerimaan[i] == '') {
                    penerimaan[i]  = 0;
                }
                if (pengeluaran[i] == '') {
                    pengeluaran[i]  = 0;
                }
                table_detail.row.add([
                    ``,
                    `<button type="button" class="btn btn-danger delete_detail" id="button_pindahBuku${no}" onclick="hapus_data(this);">-</button>`,
                    `${element[0]}`,
                    ``,
                    ``,
                    formatRupiah(String(penerimaan[i])) + ',00',
                    formatRupiah(String(pengeluaran[i])) + ',00',
                    `<input type="hidden" name="idakun[]" value="${idakun[i]}">${element[2]}`,
                    ``,
                    ``,
                    `<input type="hidden" name="idRekening[]" value="${idRekening[i]}">${element[1]}`
                ]).draw(false);
                terima  += parseInt(penerimaan[i]);
                keluar  += parseInt(pengeluaran[i]);
            }
            i++;
        });
        saldoAkhir  = formatRupiah(String(parseInt(data[2].toString().replace(/([\.]|,00)/g, '')*1) - parseInt(keluar) + parseInt(terima))) + ',00';
        table_detail_SSD.row(row).data([
            data[0],
            data[1],
            data[2],
            formatRupiah(String(terima)) + ',00',
            formatRupiah(String(keluar)) + ',00',
            saldoAkhir
        ]).draw();
        detail_array();
        $('#pindahBuku').modal('hide');
    }

    //combobox nama penerima/pejabat
    $('#tanggal').change(function(e) {
        tabelpenjualan.clear().draw();
        tabelpembelian.clear().draw();
        tabelbudgetevent.clear().draw();
        tabelrewardsales.clear().draw();
        tabelsetorpajak.clear().draw();
        tabelkaskecil.clear().draw();
        tabelsetorkaskecil.clear().draw();
        tabelreturbeli.clear().draw();
        tabelreturbeli.clear().draw();
        tabeldeposito.clear().draw();
        tabelPiutang.clear().draw();
        tabelHutang.clear().draw();
        
        getListPenjualan();
        getListPembelian();
        getListBudgetEvent();
        getListKasKecil();
        getListSetorKasKecil();
        getPiutang();
        getHutang();
        getSetorPajak();
    })

    //datatable rincian BKU
    var table_detail = $('#table_detail_rincian_buku_kas_umum').DataTable({
        sort: false,
        info: false,
        searching: false,
        paging: false,
        columnDefs: [
            {targets: [0], visible:false},
            {targets: [1,2,3,4,7,8,9,10] },
            {targets: [5,6], className: 'text-right'}
        ],
        footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\Rp.]/g, '').replace(/,00/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            penerimaan = api.column(5).data().reduce( function (a, b) {
                return intVal(a) + intVal(b); 
            }, 0 );
            pengeluaran = api.column(6).data().reduce( function (a, b) {
                return intVal(a) + intVal(b); 
            }, 0 );

            $('#penerimaan').val(formatRupiah(String(penerimaan)) + ',00')
            $('#pengeluaran').val(formatRupiah(String(pengeluaran)) + ',00')
            
        }
    })

    //datatable rincian SSD
    var table_detail_SSD = $('#table_detail_rincian_saldo_sumber_dana').DataTable({
      sort        : false,
      info        : false,
      searching   : false,
      paging      : false,
      columnDefs  : [
        {targets: [0], visible:false},
        {targets: [1], className: 'text-left'},
        {targets: [2,3,4,5], className: 'text-right'}
      ],
      footerCallback  : function ( row, data, start, end, display ) {
        var api = this.api(), data;
        var intVal = function ( i ) {
          return typeof i === 'string' ?
            i.replace(/[\Rp.]/g, '').replace(/,00/g, '')*1 :
            typeof i === 'number' ?
              i : 0;
        };
        tot_saldo_awal = api.column(2).data().reduce( function (a, b) {
            return intVal(a) + intVal(b); 
        }, 0 );
        tot_penerimaan = api.column(3).data().reduce( function (a, b) {
            return intVal(a) + intVal(b); 
        }, 0 );
        tot_pengeluaran = api.column(4).data().reduce( function (a, b) {
            return intVal(a) + intVal(b); 
        }, 0 );
        tot_saldo_akhir = api.column(5).data().reduce( function (a, b) {
            return intVal(a) + intVal(b); 
        }, 0 );

        $('#tot_saldo_awal').html(formatRupiah(String(tot_saldo_awal)) + ',00');
        $('#tot_penerimaan').html(formatRupiah(String(tot_penerimaan)) + ',00');
        $('#tot_pengeluaran').html(formatRupiah(String(tot_pengeluaran)) + ',00');
        $('#tot_saldo_akhir').html(formatRupiah(String(tot_saldo_akhir)) + ',00');
      }
    })

    //datatable penjualan
    var tabelpenjualan = $('#tabelpenjualan').DataTable({
        sort        : false,
        info        : false,
        searching   : true,
        paging      : false,
        columnDefs  : [
            {targets    : [0,3,4,5,7], className : 'text-center'},
            {targets    : [6] , className: 'text-right'},
            
        ],
    })

    //datatable pembelian
    var tabelpembelian = $('#tabelpembelian').DataTable({
        sort        : false,
        info        : false,
        searching   : true,
        paging      : false,
        columnDefs  : [
            {targets    : [0,2,3,4], className : 'text-center' },
            {targets    : [5] , className: 'text-right'},
            
        ],
    })
    //datatable budget event
    var tabelbudgetevent = $('#tabelbudgetevent').DataTable({
        sort: false,
        info: false,
        searching   : true,
        paging: false,
        columnDefs: [
            {targets: [0,1,2,3,4] },
            {targets: [5] , className: 'text-right'},
            
        ],
    })
    //datatable RewardSales
    var tabelrewardsales = $('#tabelrewardsales').DataTable({
        sort: false,
        info: false,
        searching   : true,
        paging: false,
        columnDefs: [
            {targets: [0,1,2,3,4] },
            {targets: [5] , className: 'text-right'},
            
        ],
    })
    //datatable setorpajak
    var tabelsetorpajak = $('#tabelsetorpajak').DataTable({
        sort: false,
        info: false,
        searching   : true,
        paging: false,
        columnDefs: [
            {targets: [0,1,2,3] },
            {targets: [4] , className: 'text-right'},
            
        ],
    })
    //datatable kas kecil
    var tabelkaskecil = $('#tabelkaskecil').DataTable({
        sort: false,
        info: false,
        searching   : true,
        paging: false,
        columnDefs: [
            {targets: [0,1,2,3,4] },
            {targets: [5] , className: 'text-right'},
            
        ],
    })
    //datatable setor kas kecil
    var tabelsetorkaskecil = $('#tabelsetorkaskecil').DataTable({
        sort: false,
        info: false,
        searching   : true,
        paging: false,
        columnDefs: [
            {targets: [0,1,2,3,4] },
            {targets: [5] , className: 'text-right'},
            
        ],
    })
    //datatable ReturJual
    var tabelreturjual = $('#tabelreturjual').DataTable({
        sort: false,
        info: false,
        searching   : true,
        paging: false,
        columnDefs: [
            {targets: [0,1,2,3,4] },
            {targets: [5] , className: 'text-right'},
            
        ],
    })
    //datatable ReturBeli
    var tabelreturbeli = $('#tabelreturbeli').DataTable({
        sort: false,
        info: false,
        searching   : true,
        paging: false,
        columnDefs: [
            {targets: [0,1,2,3,4] },
            {targets: [5] , className: 'text-right'},
            
        ],
    })
    //datatable deposito
    var tabeldeposito = $('#tabeldeposito').DataTable({
        sort: false,
        info: false,
        searching   : true,
        paging: false,
        columnDefs: [
            {targets: [0,1,2,3,4] },
            {targets: [5] , className: 'text-right'},
            
        ],
    })

    var tabelPiutang = $('#tabelPiutang').DataTable({
        sort: false
    });

    var tabelHutang = $('#tabelHutang').DataTable({
        sort: false
    });

    var tabelPindahBuku = $('#tabelPindahBuku').DataTable({
        sort: false
    });

    function getListPenjualan() {
      var table         = $('#list_penjualan');
      var idPerusahaan  = $('#id_perusahaan').val();
      var tgl           = $('input[name=tanggal]').val();
      $.ajax({
        type    : "get",
        data    : {idPerusahaan: idPerusahaan, tgl: tgl },
        url     : base_url + 'get_Penjualan',
        success : function(response) {
          setupJurnal = response;
          for (let index = 0; index < response.length; index++) {
            var jumlah          = 0;
            var nominalBayar    = [];
            var keterangan      = [];
            if (response[index].uangmuka !== '' && response[index].uangmuka !== '0') {
              nominalBayar[jumlah]    = response[index].uangmuka;
              keterangan[jumlah]      = 'Uang Muka';
              jumlah++;
            } 
            if (response[index].a1 !== '' && response[index].a1 !== '0') {
              nominalBayar[jumlah]    = response[index].a1;
              keterangan[jumlah]     = 'Term Ke-1';
              jumlah++;
            } 
            if (response[index].a2 !== '' && response[index].a2 !== '0') {
              nominalBayar[jumlah]    = response[index].a2;
              keterangan[jumlah]      = 'Term Ke-2';
              jumlah++;
            } 
            if (response[index].a3 !== '' && response[index].a3 !== '0') {
              nominalBayar[jumlah]    = response[index].a3;
              keterangan[jumlah]      = 'Term Ke-3';
              jumlah++;
            } 
            if (response[index].a4 !== '' && response[index].a4 !== '0') {
              nominalBayar[jumlah]    = response[index].a4;
              keterangan[jumlah]      = 'Term Ke-4';
              jumlah++;
            } 
            if (response[index].a5 !== '' && response[index].a5 !== '0') {
              nominalBayar[jumlah]    = response[index].a5;
              keterangan[jumlah]      = 'Term Ke-5';
              jumlah++;
            } 
            if (response[index].a6 !== '' && response[index].a6 !== '0') {
              nominalBayar[jumlah]    = response[index].a6;
              keterangan[jumlah]      = 'Term Ke-6';
              jumlah++;
            } 
            if (response[index].a7 !== '' && response[index].a7 !== '0') {
              nominalBayar[jumlah]    = response[index].a7;
              keterangan[jumlah]      = 'Term Ke-7';
              jumlah++;
            } 
            if (response[index].a8 !== '' && response[index].a8 !== '0') {
              nominalBayar[jumlah]    = response[index].a8;
              keterangan[jumlah]      = 'Term Ke-8';
              jumlah++;
            }
            for (let i = 0; i < jumlah; i++) {
              tabelpenjualan.row.add([
                `<input type="checkbox" id="checkbox_JUAL${response[index].idfaktur}" name="" data-id="${response[index].idfaktur}" data-tipe="Penjualan" data-tgl="${response[index].tanggal}" data-kwitansi="${response[index].notrans}" data-nominal="${nominalBayar[i]}" data-namaakun="${response[index].namaakun}" data-noakun="${response[index].akunno}" data-kodeperusahaan="${response[index].kode}" data-namadepartemen="${response[index].namaDepartemen}" data-namabank="${response[index].namaRekening}" data-norekening="${response[index].norek}" onchange="save_detail(this);" idRekening="${response[index].idRekening}" idAkun="${response[index].idakun}" cara_pembayaran="${response[index].cara_pembayaran}" tabulasi="penjualan">`,
                formatRupiah(String(`${nominalBayar[i]}`)) + ',00',
                keterangan[i],
                response[index].notrans,
                response[index].rekanan,
                response[index].nama,
                response[index].tanggal,
                formatRupiah(String(response[index].total)) + ',00',
                response[index].norek + '<br>' + response[index].namaRekening,
                response[index].cara_pembayaran,
              ]).draw();
            }
          }
        }
      });
    }

    function getListPembelian() {
      var table = $('#list_pembelian');
      var idPerusahaan = $('#id_perusahaan').val();
      var tgl = $('input[name=tanggal]').val();
      $.ajax({
        type    : "get",
        data    : {idPerusahaan: idPerusahaan, tgl: tgl },
        url     : base_url + 'get_Pembelian',
        success : function(response) {
          for (let index = 0; index < response.length; index++) {
            element           = response[index];
            var jumlah        = 0;
            var nominalBayar  = [];
            var keterangan    = [];
            if (response[index].uangmuka !== '' && response[index].uangmuka !== '0') {
              nominalBayar[jumlah]    = response[index].uangmuka;
              keterangan[jumlah]      = 'Uang Muka';
              jumlah++;
            }
            if (response[index].a1 !== '' && response[index].a1 !== '0') {
              nominalBayar[jumlah]    = response[index].a1;
              keterangan[jumlah]     = 'Term Ke-1';
              jumlah++;
            }
            if (response[index].a2 !== '' && response[index].a2 !== '0') {
              nominalBayar[jumlah]    = response[index].a2;
              keterangan[jumlah]      = 'Term Ke-2';
              jumlah++;
            }
            if (response[index].a3 !== '' && response[index].a3 !== '0') {
              nominalBayar[jumlah]    = response[index].a3;
              keterangan[jumlah]      = 'Term Ke-3';
              jumlah++;
            }
            if (response[index].a4 !== '' && response[index].a4 !== '0') {
              nominalBayar[jumlah]    = response[index].a4;
              keterangan[jumlah]      = 'Term Ke-4';
              jumlah++;
            }
            if (response[index].a5 !== '' && response[index].a5 !== '0') {
              nominalBayar[jumlah]    = response[index].a5;
              keterangan[jumlah]      = 'Term Ke-5';
              jumlah++;
            }
            if (response[index].a6 !== '' && response[index].a6 !== '0') {
              nominalBayar[jumlah]    = response[index].a6;
              keterangan[jumlah]      = 'Term Ke-6';
              jumlah++;
            }
            if (response[index].a7 !== '' && response[index].a7 !== '0') {
              nominalBayar[jumlah]    = response[index].a7;
              keterangan[jumlah]      = 'Term Ke-7';
              jumlah++;
            }
            if (response[index].a8 !== '' && response[index].a8 !== '0') {
              nominalBayar[jumlah]    = response[index].a8;
              keterangan[jumlah]      = 'Term Ke-8';
              jumlah++;
            }
            for (let i = 0; i < jumlah; i++) {
              tabelpembelian.row.add([
                `<input type="checkbox" id="checkbox_BELI${element.idfaktur}" name="" data-id="${element.idfaktur}" data-tipe="Pembelian" data-tgl="${element.tanggal}" data-kwitansi="${element.notrans}" data-nominal="${nominalBayar[i]}" data-namaakun="${element.namaakun}" data-noakun="${element.akunno}" data-kodeperusahaan="${element.kode}" data-namadepartemen="${element.namaDepartemen}" data-namabank="${element.namaBank}" data-norekening="${element.norek}" onchange="save_detail(this);" idRekening="${response[index].idRekening}" idAkun="${element.idakun}" cara_pembayaran="${element.cara_pembayaran}" tabulasi="pembelian">`,
                formatRupiah(String(`${nominalBayar[i]}`)) + ',00',
                keterangan[i],
                response[index].notrans,
                response[index].rekanan,
                response[index].tanggal,
                formatRupiah(String(response[index].total)) + ',00',
                response[index].cara_pembayaran,
              ]).draw();
            }
          }
        }
      });
    }

    function getListBudgetEvent() {
        var table = $('#list_budgetevent');
        var idPerusahaan = $('#id_perusahaan').val();
        var tgl = $('input[name=tanggal]').val();
        $.ajax({
            type: "get",
            data : {idPerusahaan: idPerusahaan, tgl: tgl },
            url: base_url + 'get_BudgetEvent/1',
            success: function(response) {
                for (let i = 0; i < response.length; i++) {
                    const element = response[i];

                    if (i < 0) {
                        tabelbudgetevent.row.add([
                            `<input type="checkbox" name="" id=""  disabled>`,
                            `${element.nokwitansi}`,
                            `${element.keterangan}`,
                            `${element.nama_departemen}`,
                            `${element.tanggal}`,
                            `${element.nominal}`,
                        ]).draw();
                    } else {
                        tabelbudgetevent.row.add([
                            `<input type="checkbox" id="checkbox_BE${element.id}" name="" data-id="${element.id}" data-tipe="Budget Event" data-tgl="${element.tanggal}" data-kwitansi="${element.nokwitansi}" data-nominal="${element.nominal}" data-namaakun="${element.namaakun}" data-noakun="${element.akunno}" data-kodeperusahaan="${element.kode}" data-namadepartemen="${element.nama_departemen}" data-namabank="${element.nama_bank}" data-norekening="${element.nomor_rekening}" onchange="save_detail(this);" idAkun="${element.idakun}" idRekening="${element.idRekening}">`,
                            `${element.nokwitansi}`,
                            `${element.keterangan}`,
                            `${element.nama_departemen}`,
                            `${element.tanggal}`,
                            formatRupiah(String(`${element.nominal}`)) + ',00',
                        ]).draw();
                    }
                }
            }
        });
    }

    function getSetorPajak() {
        var idPerusahaan    = $('#id_perusahaan').val();
        var tgl             = $('input[name=tanggal]').val();
        $.ajax({
            type    : "post",
            data    : {
                idPerusahaan    : idPerusahaan, 
                tanggal         : tgl 
            },
            url     : '{site_url}SetorPajak/get',
            success: function(response) {
                for (let i = 0; i < response.length; i++) {
                    const element = response[i];
                    if (i < 0) {
                        tabelsetorpajak.row.add([
                            `<input type="checkbox" name="" id=""  disabled>`,
                            `${element.nokwitansi}`,
                            `${element.keterangan}`,
                            `${element.nama_departemen}`,
                            `${element.tanggal}`,
                            `${element.nominal}`,
                        ]).draw();
                    } else {
                        tabelsetorpajak.row.add([
                            `<input type="checkbox" id="checkbox_SetorPajak${element.idPajakPemesananPenjualan}" name="" data-id="${element.idPajakPemesananPenjualan}" data-tipe="Setor Pajak" data-tgl="${element.tanggal}" data-kwitansi="${element.noSSP}" data-nominal="${element.nominal}" data-namaakun="${element.namaAkunPajak}" data-noakun="${element.akunPajak}" data-kodeperusahaan="${element.kode}" data-namadepartemen="${element.namaDepartemen}" data-namabank="${element.namaRekening}" data-norekening="${element.norek}" onchange="save_detail(this);" idAkun="${element.idAkunPajak}" idRekening="${element.idRekening}">`,
                            `${element.noSSP}`,
                            `${element.namaDepartemen}`,
                            `${element.tanggal}`,
                            formatRupiah(String(`${element.nominal}`)) + ',00',
                        ]).draw();
                    }
                }
            }
        });
    }

    function getPindahBuku() {
        var idPerusahaan    = $('#id_perusahaan').val();
        $.ajax({
            type    : "get",
            data    : {
                idPerusahaan    : idPerusahaan
            },
            url     : '{site_url}rekening/get',
            success: function(response) {
                for (let i = 0; i < response.length; i++) {
                    const element = response[i];
                    tabelPindahBuku.row.add([
                        `PB`,
                        `<input type="hidden" name="rekening" value="${element.id}">` + element.nama,
                        `<input type="hidden" name="akun" value="${element.idakun}">` + element.akun,
                        `<input type="text" name="penerimaanPindahBuku" id="penerimaanPindahBuku" class="form-control">`,
                        `<input type="text" name="pengeluaranPindahBuku" id="pengeluaranPindahBuku" class="form-control">`
                    ]).draw();
                }
            }
        });
    }

    function getListKasKecil() {
        var table = $('#list_KasKecil');
        var idPerusahaan = $('#id_perusahaan').val();
        var tgl = $('input[name=tanggal]').val();
        $.ajax({
            type: "get",
            data : {idPerusahaan: idPerusahaan, tgl : tgl},
            url: base_url + 'get_KasKecil',
            success: function(response) {
                for (let i = 0; i < response.length; i++) {
                    const element = response[i];
                    if (i < 0) {
                        tabelkaskecil.row.add([
                            `<input type="checkbox" name="" id=""  disabled>`,
                            `${element.nokwitansi}`,
                            `${element.keterangan}`,
                            `${element.nama_departemen}`,
                            `${element.tanggal}`,
                            `${element.nominal}`,
                        ]).draw();
                    } else {
                        tabelkaskecil.row.add([
                            `<input type="checkbox" id="checkbox_PKK${element.id}" name="" data-id="${element.id}" data-tipe="Pengajuan Kas Kecil" data-tgl="${element.tanggal}" data-kwitansi="${element.nokwitansi}" data-nominal="${element.nominal}" data-namaakun="${element.nama_akun}" data-noakun="${element.nomor_akun}" data-kodeperusahaan="${element.kode}" data-namadepartemen="${element.nama_departemen}" data-namabank="${element.nama_bank}" data-norekening="${element.nomor_rekening}" idRekening="${element.idRekening}" onchange="save_detail(this)" idAkun="${element.idakun}">`,
                            `${element.nokwitansi}`,
                            `${element.keterangan}`,
                            `${element.nama_departemen}`,
                            `${element.tanggal}`,
                            formatRupiah(String(`${element.nominal}`)) + ',00',
                        ]).draw();
                    }
                }
            }
        });
    }

    function getListSetorKasKecil() {
        var table = $('#list_SetorKasKecil');
        var idPerusahaan = $('#id_perusahaan').val();
        var tgl = $('input[name=tanggal]').val();
        $.ajax({
            type: "get",
            data : {idPerusahaan: idPerusahaan, tgl : tgl},
            url: base_url + 'get_SetorKasKecil',
            success: function(response) {
                for (let i = 0; i < response.length; i++) {
                    const element = response[i];

                    if (i < 0) {
                        tabelsetorkaskecil.row.add([
                            `<input type="checkbox" name="" id=""  disabled>`,
                            `${element.nokwitansi}`,
                            `${element.keterangan}`,
                            `${element.nama_departemen}`,
                            `${element.tanggal}`,
                            `${element.nominal}`,
                        ]).draw();
                    } else {
                        tabelsetorkaskecil.row.add([
                            `<input type="checkbox" id="checkbox_SKK${element.id}" data-id="${element.id}" data-tipe="Setor Kas Kecil" data-tgl="${element.tanggal}" data-kwitansi="${element.nokwitansi}" data-nominal="${element.nominal}" data-namaakun="${element.nama_akun}" data-noakun="${element.nomor_akun}" data-kodeperusahaan="${element.kode}" data-namadepartemen="${element.nama_departemen}" data-namabank="${element.nama_bank}" data-norekening="${element.nomor_rekening}" onchange="save_detail(this);" idAkun="${element.idakun}" idRekening="${element.idRekening}">`,
                            `${element.nokwitansi}`,
                            `${element.keterangan}`,
                            `${element.nama_departemen}`,
                            `${element.tanggal}`,
                            formatRupiah(String(`${element.nominal}`)) + ',00',
                        ]).draw();
                    }
                }
            }
        });
    }

    function getPiutang() {
        var idPerusahaan    = $('#id_perusahaan').val();
        var tgl             = $('input[name=tanggal]').val();
        $.ajax({
            type    : 'get',
            data    : {
                perusahaanid    : idPerusahaan,
                tanggal         : tgl
            },
            url     : '{site_url}piutang/get',
            beforeSend: function() {
                pageBlock();
            },
            afterSend: function() {
                unpageBlock();
            },
            success : function (response) {
                for (let index = 0; index < response.length; index++) {
                    piutang    = response[index];
                    tabelPiutang.row.add([
                        `<input type="checkbox" id="checkboxPiutang${piutang.idSaldoAwalPiutang}" data-id="${piutang.idSaldoAwalPiutang}" data-tipe="Saldo Awal Piutang" data-tgl="${piutang.tanggal}" data-kwitansi="${piutang.noInvoice}" data-nominal="${piutang.primeOwing}" data-namaakun="${piutang.namaakun}" data-noakun="${piutang.akunno}" idAkun="${piutang.idakun}" data-kodeperusahaan="${piutang.kode}" onchange="save_detail(this);">`,
                        `${piutang.tanggal}`,
                        `${piutang.tanggalTempo}`,
                        `${piutang.noInvoice}`,
                        `${piutang.deskripsi}`,
                        `${piutang.namaPelanggan}`,
                        formatRupiah(String(`${piutang.primeOwing}`)) + ',00',
                        ``,
                        ``
                    ]).draw();
                }
            }
        })
    }

    function getSaldoSumberDana(edit) {
      if (edit) {
        var idPerusahaan    = '<?= $kas_bank["perusahaan"]; ?>';
      } else {
        var idPerusahaan    = $('#id_perusahaan').val();
      }

      var tanggal         = $('input[name=tanggal]').val();

      $.ajax({
        type  : 'get',
        data  : {
          perusahaan  : idPerusahaan,
          tanggal     : tanggal
        },
        url : base_url  + '/getSaldoSumberDana',
        beforeSend: function() {
          pageBlock();
        },
        success : function (response) {
          unpageBlock();
          saldoSumberDana = response;
          if (edit) {
            for (let index = 0; index < response.length; index++) {
              rek    = response[index];
              table_detail_SSD.row.add([
                rek.id,
                rek.nama,
                formatRupiah(String(rek.totalSaldo)) + ',00',
                `0,00`,
                `0,00`,
                formatRupiah(String(rek.totalSaldo)) + ',00'
              ]).draw();
            }
          }
        }
      })
    }

    function getHutang() {
      var idPerusahaan    = $('#id_perusahaan').val();
      var tgl             = $('input[name=tanggal]').val();

      tabelHutang.destroy();
      $('#tabelHutang').DataTable({
        sort  : false,
        ajax  : {
          url   : '{site_url}utang/get',
          type  : 'get',
          data  : {
            perusahaanid  : idPerusahaan,
            tanggal       : tgl
          },
        },
        pageLength  : 100,
        stateSave   : true,
        autoWidth   : false,
        dom         : '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"p>',
        language    : {
          search            : '<span></span> _INPUT_',
          searchPlaceholder : 'Type to filter...',
        },
        columns : [
          {
            data    : 'id', 
            render  : function (data, type, row) {
              return `<input type="checkbox" id="checkboxHutang${row.id}" data-id="${row.id}" data-tipe="Saldo Awal Hutang" data-tgl="${row.tanggal}" data-kwitansi="${row.notrans}" data-nominal="${row.total}" idAkun="${row.idakun}" data-namaakun="${row.namaakun}" data-noakun="${row.akunno}" data-kodeperusahaan="${row.kode}" onchange="save_detail(this);" tabulasi="hutang">`
            }
          },
          {data : 'tanggal'},
          {data : 'tanggaltempo'},
          {data : 'notrans'},
          {data : 'catatan'},
          {data : 'rekanan'},
          {
            data    : 'prime',
            render  : function(data,type,row) {
              return formatRupiah(String(`${row.total}`)) + ',00'
            }
          },
          {render : function (data, type, row) {
            return '';
          }},
          {render : function (data, type, row) {
            return '';
          }},
          {render : function (data, type, row) {
            return '';
          }},
        ],
      });
    }

    //save items
    function save_detail(elem, edit) {
      if (edit) { 
        var tipe          = elem.tipe;
        var id            = elem.idtipe;
        var tgl           = elem.tanggal;
        var nokwitansi    = elem.nokwitansi;
        if (elem.penerimaan !== '0') {
          var nominal   = elem.penerimaan;
        } else {
          var nominal   = elem.pengeluaran;
        }
        var namaakun          = elem.namaakun;
        var noakun            = elem.akunno;
        var kodeperusahaan    = elem.kodeunit;
        var namadepartemen    = elem.departemen;
        var namabank          = elem.namaRekening;
        var norekening        = elem.norek;
        var idRekening        = elem.idRekening;
        var idAkun            = elem.idakun;
        var stat              = 1;
        var cara_pembayaran   = elem.caraPembayaran;
        var idSetupJurnal     = elem.idSetupJurnal;
        var setupJurnal       = elem.kodeJurnal;
      } else {
        const tipe              = $(elem).attr('data-tipe');
        const id                = $(elem).attr('data-id');
        const tgl               = $(elem).attr('data-tgl');
        const nokwitansi        = $(elem).attr('data-kwitansi');
        const nominal           = $(elem).attr('data-nominal');
        const namaakun          = $(elem).attr('data-namaakun');
        const noakun            = $(elem).attr('data-noakun');
        const kodeperusahaan    = $(elem).attr('data-kodeperusahaan');
        const namadepartemen    = $(elem).attr('data-namadepartemen');
        const namabank          = $(elem).attr('data-namabank');
        const norekening        = $(elem).attr('data-norekening');
        const idRekening        = $(elem).attr('idRekening');
        const idAkun            = $(elem).attr('idAkun');
        const stat              = $(elem).is(":checked");
        const cara_pembayaran   = $(elem).attr('cara_pembayaran');
        const tabulasi          = $(elem).attr('tabulasi');
        let idSetupjurnal;
        let setupJurnal;
        if (tipe == 'Saldo Awal Hutang' || tipe == 'Saldo Awal Piutang') {
          var data    = {
            tabulasi    : tabulasi
          }
        } else {
          var data    = {
            tabulasi        : tabulasi,
            cara_pembayaran : cara_pembayaran
          }
        }
        $.ajax({
          url     : '{site_url}kas_bank/getSetupJurnal',
          data    : data,
          method  : 'get',
          success : function (hasil) {
            idSetupJurnal = hasil['idSetupJurnal'];
            setupJurnal = hasil['kodeJurnal'];
          },
          async   : false
        })
      }

      for (let index = 0; index < saldoSumberDana.length; index++) {
        const element = saldoSumberDana[index];
        if (idRekening == element.id) {
          row = index;
          break;
        }
        row = index;
      }
      var data          = table_detail_SSD.row(row).data();
      var penerimaan    = data[3].toString().replace(/([\.]|,00)/g, '')*1;
      var pengeluaran   = data[4].toString().replace(/([\.]|,00)/g, '')*1;
      if ( tipe == 'Penjualan'){
        const table = $('#isitabel');     
        if (stat) {
          table_detail.row.add([
            `${id}`,
            `<button type="button" class="btn btn-danger delete_detail" id="button_JUAL${id}" data-id="${id}" data-tipe="${tipe}" onclick="hapus_data(this);" idRekening="${idRekening}" nominal="${nominal}">-</button>`,
            `${tipe}`,
            `${tgl}`,
            `${nokwitansi}`,
            formatRupiah(String(nominal)) + ',00',
            formatRupiah(String('0')) + ',00',
            `<input type="hidden" name="idakun[]" value="${idAkun}">${namaakun}/${noakun}`,
            `${kodeperusahaan}`,
            `${namadepartemen}`,
            `<input type="hidden" name="idRekening[]" value="${idRekening}">${namabank} ${norekening}`,
            `<input type="hidden" name="caraPembayaran[]" value="${cara_pembayaran}">${cara_pembayaran}`,
            `<input type="hidden" name="idSetupJurnal[]" value="${idSetupJurnal}">${setupJurnal}`,
          ]).draw(false);
          penerimaan = parseInt(data[3].toString().replace(/([\.]|,00)/g, '')*1) + parseInt(nominal); 
        } else {
          penerimaan = parseInt(data[3].toString().replace(/([\.]|,00)/g, '')*1) - parseInt(nominal);
          var rowindex=$('#button_JUAL'+id).closest('tr').index();
          table_detail.row(rowindex).remove().draw();
        }
      }else if ( tipe == 'Pembelian'){
        const table = $('#isitabel');       
        if (stat) {
          table_detail.row.add([
            `${id}`,
            `<button type="button" class="btn btn-danger delete_detail" id="button_BELI${id}" data-id="${id}" data-tipe="${tipe}" onclick="hapus_data(this);" idRekening="${idRekening}" nominal="${nominal}">-</button>`,
            `${tipe}`,
            `${tgl}`,
            `${nokwitansi}`,
            formatRupiah(String('0')) + ',00',
            formatRupiah(String(nominal)) + ',00',
            `<input type="hidden" name="idakun[]" value="${idAkun}">${namaakun} ${noakun}`,
            `${kodeperusahaan}`,
            `${namadepartemen}`,
            `<input type="hidden" name="idRekening[]" value="${idRekening}">${namabank} ${norekening}`,
          `<input type="hidden" name="caraPembayaran[]" value="${cara_pembayaran}">${cara_pembayaran}`,
          `<input type="hidden" name="idSetupJurnal[]" value="${idSetupJurnal}">${setupJurnal}`,
          ]).draw(false);
          pengeluaran = parseInt(data[3].toString().replace(/([\.]|,00)/g, '')*1) + parseInt(nominal);
        } else {
          pengeluaran = parseInt(data[3].toString().replace(/([\.]|,00)/g, '')*1) - parseInt(nominal);
          var rowindex=$('#button_BELI'+id).closest('tr').index();
          table_detail.row(rowindex).remove().draw();
        }
      }else if ( tipe == 'Budget Event'){
        const table = $('#isitabel');       
        if (stat) {
          table_detail.row.add([
            `${id}`,
            `<button type="button" class="btn btn-danger delete_detail" id="button_BE${id}" data-id="${id}" data-tipe="${tipe}" onclick="hapus_data(this);">-</button>`,
            `${tipe}`,
            `${tgl}`,
            `${nokwitansi}`,
            formatRupiah(String('0')) + ',00',
            formatRupiah(String(nominal)) + ',00',
            `<input type="hidden" name="idakun[]" value="${idAkun}">${namaakun} ${noakun}`,
            `${kodeperusahaan}`,
            `${namadepartemen}`,
            `<input type="hidden" name="idRekening[]" value="${idRekening}">${namabank} ${norekening}`
          ]).draw(false);
        } else {
          var rowindex  = $('#button_BE'+id).closest('tr').index();
          table_detail.row(rowindex).remove().draw();
        }
      } else if ( tipe == 'Pengajuan Kas Kecil' ){
        const table = $('#isitabel');       
        if (stat) {
          table_detail.row.add([
            id,
            `<button type="button" class="btn btn-danger delete_detail" id="button_PKK${id}" data-id="${id}" data-tipe="${tipe}" onclick="hapus_data(this);">-</button>`,
            tipe,
            tgl,
            nokwitansi,
            formatRupiah(String('0')) + ',00',
            formatRupiah(String(nominal)) + ',00',
            `<input type="hidden" name="idakun[]" value="${idAkun}">${namaakun} ${noakun}`,
            kodeperusahaan,
            namadepartemen,
            `<input type="hidden" name="idRekening[]" value="${idRekening}">${namabank} ${norekening}`,
            `<input type="hidden" name="caraPembayaran[]">`,
            `<input type="hidden" name="idSetupJurnal[]" value="${idSetupJurnal}">${setupJurnal}`,
          ]).draw(false);
          pengeluaran = parseInt(data[4].toString().replace(/([\.]|,00)/g, '')*1) + parseInt(nominal); 
        } else {
          pengeluaran = parseInt(data[4].toString().replace(/([\.]|,00)/g, '')*1) - parseInt(nominal);
          var rowindex=$('#button_PKK'+id).closest('tr').index();
          table_detail.row(rowindex).remove().draw();
        }        
      } else if ( tipe == 'Setor Kas Kecil' ){
        const table = $('#isitabel');       
        if (stat) {
          table_detail.row.add([
            id,
            `<button type="button" class="btn btn-danger delete_detail" id="button_SKK${id}" data-id="${id}" data-tipe="${tipe}" onclick="hapus_data(this);">-</button>`,
            tipe,
            tgl,
            nokwitansi,
            formatRupiah(String(nominal)) + ',00',
            formatRupiah(String('0')) + ',00',
            `<input type="hidden" name="idakun[]" value="${idAkun}">${namaakun} ${noakun}`,
            kodeperusahaan,
            namadepartemen,
            `<input type="hidden" name="idRekening[]" value="${idRekening}">${namabank} ${norekening}`,
            `<input type="hidden" name="caraPembayaran[]">`,
            `<input type="hidden" name="idSetupJurnal[]" value="${idSetupJurnal}">${setupJurnal}`,
          ]).draw( false );
        } else {
          var rowindex  = $('#button_SKK'+id).closest('tr').index();
          table_detail.row(rowindex).remove().draw();
        }
      } else if (tipe == 'Saldo Awal Piutang') {
        const table = $('#isitabel');  
        if (stat) {
          table_detail.row.add([
            `${id}`,
            `<button type="button" class="btn btn-danger delete_detail" id="buttonPiutang${id}" data-id="${id}" data-tipe="${tipe}" onclick="hapus_data(this);">-</button>`,
            `${tipe}`,
            `${tgl}`,
            `${nokwitansi}`,
            formatRupiah(String(nominal))  + ',00',
            formatRupiah(String('0'))  + ',00',
            `<input type="hidden" name="idakun[]" value="${idAkun}">${namaakun} ${noakun}`,
            `${kodeperusahaan}`,
            ``,
            `<input type="hidden" name="idRekening[]" value="${idRekening}" id="idRekening${id}"><select onchange="pilihRekening(this, 'idRekening${id}')" class="form-control pilihRekening" required></select>`,
            `<input type="hidden" name="caraPembayaran[]" value="credit">credit`,
            `<input type="hidden" name="idSetupJurnal[]" value="${idSetupJurnal}">${setupJurnal}`,
          ]).draw( false );
          penerimaan = parseInt(data[3].toString().replace(/([\.]|,00)/g, '')*1) + parseInt(nominal);
        } else {
          penerimaan = parseInt(data[3].toString().replace(/([\.]|,00)/g, '')*1) - parseInt(nominal);
          var rowindex=$('#button_PIUTANGI'+id).closest('tr').index();
          table_detail.row(rowindex).remove().draw();
        }
      } else if (tipe == 'Saldo Awal Hutang') {
        const table = $('#isitabel');  
        if (stat) {
          table_detail.row.add([
            `${id}`,
            `<button type="button" class="btn btn-danger delete_detail" id="buttonHutang${id}" data-id="${id}" data-tipe="${tipe}" onclick="hapus_data(this);">-</button>`,
            `${tipe}`,
            `${tgl}`,
            `${nokwitansi}`,
            formatRupiah(String('0'))  + ',00',
            formatRupiah(String(nominal))  + ',00',
            `<input type="hidden" name="idakun[]" value="${idAkun}">${namaakun} ${noakun}`,
            `${kodeperusahaan}`,
            ``,
            `<input type="hidden" name="idRekening[]" value="${idRekening}" id="idRekening${id}"><select onchange="pilihRekening(this, 'idRekening${id}')" class="form-control pilihRekening" required></select>`,
            `<input type="hidden" name="caraPembayaran[]" value="credit">credit`,
            `<input type="hidden" name="idSetupJurnal[]" value="${idSetupJurnal}">${setupJurnal}`,
          ]).draw( false );
          pengeluaran = parseInt(data[4].toString().replace(/([\.]|,00)/g, '')*1) + parseInt(nominal); 
        } else {
          pengeluaran = parseInt(data[4].toString().replace(/([\.]|,00)/g, '')*1) - parseInt(nominal);
          var rowindex=$('#button_HUTANG'+id).closest('tr').index();
          table_detail.row(rowindex).remove().draw();
        }
      } else if (tipe == 'Setor Pajak') {
        if (stat) {
          table_detail.row.add([
            `${id}`,
            `<button type="button" class="btn btn-danger delete_detail" id="buttonSetorPajak${id}" data-id="${id}" data-tipe="${tipe}" onclick="hapus_data(this);">-</button>`,
            `${tipe}`,
            `${tgl}`,
            `${nokwitansi}`,
            formatRupiah(String('0'))  + ',00',
            formatRupiah(String(nominal))  + ',00',
            `<input type="hidden" name="idakun[]" value="${idAkun}">${namaakun} ${noakun}`,
            `${kodeperusahaan}`,
            ``,
            `<input type="hidden" name="idRekening[]" value="${idRekening}" id="idRekening${id}">${namabank} ${norekening}`
          ]).draw( false );
          pengeluaran = parseInt(data[4].toString().replace(/([\.]|,00)/g, '')*1) + parseInt(nominal); 
        } else {
          pengeluaran = parseInt(data[4].toString().replace(/([\.]|,00)/g, '')*1) - parseInt(nominal);
          var rowindex=$('#button_SetorPajak'+id).closest('tr').index();
          table_detail.row(rowindex).remove().draw();
        }
      }
      saldoAkhir  = formatRupiah(String(parseInt(data[2].toString().replace(/([\.]|,00)/g, '')*1) - parseInt(pengeluaran) + parseInt(penerimaan))) + ',00';
      table_detail_SSD.row(row).data([
        data[0],
        data[1],
        data[2],
        formatRupiah(String(penerimaan)) + ',00',
        formatRupiah(String(pengeluaran)) + ',00',
        saldoAkhir
      ]).draw();
      detail_array();
      hitungTotalPengeluaranPemindahbukuan();
      ajax_select({
        id  : '.pilihRekening',
        url : '{site_url}rekening/select2/' + idPerusahaan,
      });
    }

  function hitungTotalPengeluaranPemindahbukuan(){
    var tbl                       = document.getElementById('table_detail_rincian_buku_kas_umum'), 
    sumPengeluaranPemindahbukuan  = 0;
      console.log(tbl);
    for (var i = 1; i < tbl.rows.length; i++) {
      ubahpengeluaran   = tbl.rows[i].cells[4].innerHTML.split(',00').join('');
      ubahpengeluaran1  = ubahpengeluaran.split('.').join('');
      tipe              = tbl.rows[i].cells[1].innerHTML;
      if (tipe == 'Pengajuan Kas Kecil'){
        sumPengeluaranPemindahbukuan = sumPengeluaranPemindahbukuan + parseInt(ubahpengeluaran1);
      }else{
        sumPengeluaranPemindahbukuan = sumPengeluaranPemindahbukuan + 0;
      }
    }
    $('#pengeluaran_pemindahbukuan').val(sumPengeluaranPemindahbukuan);
  }

    function pilihRekening(elemen, id) {
        $('#' + id).val($(elemen).val());
    }

    function hapus_data(elem) {
        const id            = $(elem).attr('data-id');
        const tipe          = $(elem).attr('data-tipe');
        const idRekening    = $(elem).attr('idRekening');
        for (let index = 0; index < saldoSumberDana.length; index++) {
            const element = saldoSumberDana[index];
            if (idRekening == element.id) {
                row = index;
                break;
            }
        }
        var data          = table_detail_SSD.row(row).data();
        var penerimaan    = data[3].toString().replace(/([\.]|,00)/g, '')*1;
        var pengeluaran = data[4].toString().replace(/([\.]|,00)/g, '')*1;
        const nominal   = $(elem).attr('nominal');         

        if(tipe == 'Penjualan'){
            pengeluaran = parseInt(data[4].toString().replace(/([\.]|,00)/g, '')*1) - parseInt(nominal);
            document.getElementById("checkbox_JUAL"+id).checked = false;
        }else if(tipe == 'Pembelian'){
            penerimaan = parseInt(data[3].toString().replace(/([\.]|,00)/g, '')*1) - parseInt(nominal);
            document.getElementById("checkbox_BELI"+id).checked = false;
        }else if(tipe == 'Budget Event'){
            document.getElementById("checkbox_BE"+id).checked = false;
        }else if(tipe == 'Reward Sales'){
            document.getElementById("checkbox_RS"+id).checked = false;
        }else if(tipe == 'Setor Pajak'){
            document.getElementById("checkbox_SP"+id).checked = false;
        }else if (tipe == 'Pengajuan Kas Kecil'){
            document.getElementById("checkbox_PKK"+id).checked = false;
        }else if (tipe == 'Setor Kas Kecil'){
            document.getElementById("checkbox_SKK"+id).checked = false;
        }else if(tipe == 'Retur Jual'){
            document.getElementById("checkbox_RJ"+id).checked = false;
        }else if(tipe == 'Retur Beli'){
            document.getElementById("checkbox_RB"+id).checked = false;
        }else if(tipe == 'Deposito'){
            document.getElementById("checkbox_DEPO"+id).checked = false;
        }else if(tipe == 'Saldo Awal Piutang'){
            document.getElementById("checkboxPiutang"+id).checked = false;
        }else if(tipe == 'Saldo Awal Hutang'){
            document.getElementById("checkboxHutang"+id).checked = false;
        }  
        saldoAkhir  = formatRupiah(String(parseInt(data[2].toString().replace(/([\.]|,00)/g, '')*1) + parseInt(pengeluaran) - parseInt(penerimaan))) + ',00';
        table_detail_SSD.row(row).data([
            data[0],
            data[1],
            data[2],
            formatRupiah(String(penerimaan)) + ',00',
            formatRupiah(String(pengeluaran)) + ',00',
            saldoAkhir
        ]).draw();
    }

    $('#table_detail_rincian_buku_kas_umum tbody').on('click','.delete_detail',function(){
        table_detail.row($(this).parents('tr')).remove().draw();
        detail_array();
    })


    function detail_array() {
        $('#detail_array').val( JSON.stringify(table_detail.data().toArray()) );
    }

    //simpan data
    function save() {
        var form = $('#form1')[0];
        var formData = new FormData(form);
        $.ajax({
            url: base_url + 'save',
            dataType: 'json',
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                pageBlock();
            },
            afterSend: function() {
                unpageBlock();
            },
            success: function(data) {
                if(data.status == 'success') {
                    swal("Berhasil!", "Berhasil Menambah Data", "success");
                    redirect(base_url);
                } else {
                    swal("Gagal!", "Gagal Menambah Data", "error");
                }
            },
            error: function() {
                swal("Gagal!", "Internal Server Error", "error");
            }
        })
    }
</script>