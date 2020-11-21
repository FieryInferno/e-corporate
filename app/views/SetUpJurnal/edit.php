<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('anggaran_belanja'); ?>">{title}</a></li>
                        <li class="breadcrumb-item active">{subtitle}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <!-- left column -->
                <div class="col-md-12">
                    <form action="javascript:save()" id="formSetUpJurnal">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{subtitle} {title}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Kode Jurnal :</label>
                                            <input type="hidden" name="idSetupJurnal" value="<?= $setupJurnal['idSetupJurnal']; ?>">
                                            <input type="text" class="form-control" placeholder="Kode Jurnal" name="kodeJurnal" value="<?= $setupJurnal['kodeJurnal']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Formulir :</label>
                                            <select name="formulir" id="formulir" class="form-control" onchange="pilihFormulir()">
                                                <option value="" disabled selected>Pilih Formulir</option>
                                                <option value="fakturPembelian" <?= $setupJurnal['formulir'] == 'fakturPembelian' ? 'selected' : '' ?>>Faktur Pembelian</option>
                                                <option value="fakturPenjualan" <?= $setupJurnal['formulir'] == 'fakturPenjualan' ? 'selected' : '' ?>>Faktur Penjualan</option>
                                                <option value="penerimaanBarang" <?= $setupJurnal['formulir'] == 'penerimaanBarang' ? 'selected' : '' ?>>Penerimaan Barang</option>
                                                <option value="pengirimanBarang" <?= $setupJurnal['formulir'] == 'pengirimanBarang' ? 'selected' : '' ?>>Pengiriman Barang</option>
                                                <option value="pengeluaranKasKecil" <?= $setupJurnal['formulir'] == 'pengeluaranKasKecil' ? 'selected' : '' ?>>Pengeluaran Kas Kecil</option>
                                                <option value="kasBank" <?= $setupJurnal['formulir'] == 'kasBank' ? 'selected' : '' ?>>Kas Bank</option>
                                                <option value="saldoAwal" <?= $setupJurnal['formulir'] == 'saldoAwal' ? 'selected' : '' ?>>Saldo Awal</option>
                                                <option value="jurnalPenyesuaian" <?= $setupJurnal['formulir'] == 'jurnalPenyesuaian' ? 'selected' : '' ?>>Jurnal Penyesuaian</option>
                                                <option value="setorPajak" <?= $setupJurnal['formulir'] == 'setorPajak' ? 'selected' : '' ?>>Setor Pajak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div id="tipeTransaksi"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Keterangan :</label>
                                            <input type="text" class="form-control" placeholder="Keterangan" name="keterangan" value="<?= $setupJurnal['keterangan']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Entitas Akuntansi</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h5>Jurnal Anggaran</h5>
                                        <a href="javascript:tambah('jurnalAnggaran', 1)" type="button" class="btn btn-primary" id="tambahAnggaran">
                                            + <?php echo lang('add_new') ?>
                                        </a>
                                        <table class="table table-striped table-borderless table-hover">
                                            <thead>
                                                <tr class="table-active">
                                                    <th scope="col">Elemen</th>
                                                    <th scope="col">D/K</th>
                                                    <th scope="col">Nominal</th>
                                                </tr>
                                            </thead>
                                            <tbody id="jurnalAnggaran">
                                                <?php
                                                    if (count($setupJurnal['jurnalAnggaran']) > 0) {
                                                        foreach ($setupJurnal['jurnalAnggaran'] as $key) { 
                                                            $nomor  = uniqid(); ?>
                                                            <tr nomor="<?= $nomor; ?>">
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-2">
                                                                            <a href="javascript:hapus('<?= $nomor; ?>')" type="button" class="btn btn-danger">-</a>
                                                                            <input type="hidden" name="idJurnalAnggaran[]" value="<?= $key['idJurnalAnggaran']; ?>">
                                                                        </div>
                                                                        <div class="col-10">
                                                                            <select name="elemenjurnalAnggaran[]" id="elemen" class="form-control elemen">
                                                                                <option value="" disabled selected>Pilih Elemen</option>
                                                                                <option value="kodeAkun" <?= $key['elemen'] == 'kodeAkun' ? 'selected' : '' ?>>Kode Akun</option>
                                                                                <option value="mapAkun1" <?= $key['elemen'] == 'mapAkun1' ? 'selected' : '' ?>>Map Akun 1</option>
                                                                                <option value="mapAkun2" <?= $key['elemen'] == 'mapAkun2' ? 'selected' : '' ?>>Map Akun 2</option>
                                                                                <option value="mapAkun3" <?= $key['elemen'] == 'mapAkun3' ? 'selected' : '' ?>>Map Akun 3</option>
                                                                                <option value="sumberDanaPiutang" <?= $key['elemen'] == 'sumberDanaPiutang' ? 'selected' : '' ?>>Sumber Dana Piutang</option>
                                                                                <option value="sumberDanaPiutang1" <?= $key['elemen'] == 'sumberDanaPiutang1' ? 'selected' : '' ?>>Map Sumber Dana Piutang 1</option>
                                                                                <option value="sumberDanaPiutang2" <?= $key['elemen'] == 'sumberDanaPiutang2' ? 'selected' : '' ?>>Map Sumber Dana Piutang 2</option>
                                                                                <option value="sumberDanaPiutang3" <?= $key['elemen'] == 'sumberDanaPiutang3' ? 'selected' : '' ?>>Map Sumber Dana Piutang 3</option>
                                                                                <option value="sumberDanaHutang" <?= $key['elemen'] == 'sumberDanaHutang' ? 'selected' : '' ?>>Sumber Dana Hutang</option>
                                                                                <option value="sumberDanaHutang1" <?= $key['elemen'] == 'sumberDanaHutang1' ? 'selected' : '' ?>>Map Sumber Dana Hutang 1</option>
                                                                                <option value="sumberDanaHutang2" <?= $key['elemen'] == 'sumberDanaHutang2' ? 'selected' : '' ?>>Map Sumber Dana Hutang 2</option>
                                                                                <option value="sumberDanaHutang3" <?= $key['elemen'] == 'sumberDanaHutang3' ? 'selected' : '' ?>>Map Sumber Dana Hutang 3</option>
                                                                                <option value="sumberDanaPenjualan" <?= $key['elemen'] == 'sumberDanaPenjualan' ? 'selected' : '' ?>>Sumber Dana Penjualan</option>
                                                                                <option value="sumberDanaPenjualan1" <?= $key['elemen'] == 'sumberDanaPenjualan1' ? 'selected' : '' ?>>Map Sumber Dana Penjualan 1</option>
                                                                                <option value="sumberDanaPenjualan2" <?= $key['elemen'] == 'sumberDanaPenjualan2' ? 'selected' : '' ?>>Map Sumber Dana Penjualan 2</option>
                                                                                <option value="sumberDanaPenjualan3" <?= $key['elemen'] == 'sumberDanaPenjualan3' ? 'selected' : '' ?>>Map Sumber Dana Penjualan 3</option>
                                                                                <option value="sumberDanaPembelian" <?= $key['elemen'] == 'sumberDanaPembelian' ? 'selected' : '' ?>>Sumber Dana Pembelian</option>
                                                                                <option value="sumberDanaPembelian1" <?= $key['elemen'] == 'sumberDanaPembelian1' ? 'selected' : '' ?>>Map Sumber Dana Pembelian 1</option>
                                                                                <option value="sumberDanaPembelian2" <?= $key['elemen'] == 'sumberDanaPembelian2' ? 'selected' : '' ?>>Map Sumber Dana Pembelian 2</option>
                                                                                <option value="sumberDanaPembelian3" <?= $key['elemen'] == 'sumberDanaPembelian3' ? 'selected' : '' ?>>Map Sumber Dana Pembelian 3</option>
                                                                                <option value="sumberDanaPengajuanKasKecil" <?= $key['elemen'] == 'sumberDanaPengajuanKasKecil' ? 'selected' : '' ?>>Sumber Dana Pengajuan Kas Kecil</option>
                                                                                <option value="sumberDanaPengajuanKasKecil1" <?= $key['elemen'] == 'sumberDanaPengajuanKasKecil1' ? 'selected' : '' ?>>Map Sumber Dana Pengajuan Kas Kecil 1</option>
                                                                                <option value="sumberDanaPengajuanKasKecil2" <?= $key['elemen'] == 'sumberDanaPengajuanKasKecil2' ? 'selected' : '' ?>>Map Sumber Dana Pengajuan Kas Kecil 2</option>
                                                                                <option value="sumberDanaPengajuanKasKecil3" <?= $key['elemen'] == 'sumberDanaPengajuanKasKecil3' ? 'selected' : '' ?>>Map Sumber Dana Pengajuan Kas Kecil 3</option>
                                                                                <option value="sumberDanaSetorKasKecil" <?= $key['elemen'] == 'sumberDanaSetorKasKecil' ? 'selected' : '' ?>>Sumber Dana Stor Kas Kecil</option>
                                                                                <option value="sumberDanaSetorKasKecil1" <?= $key['elemen'] == 'sumberDanaSetorKasKecil1' ? 'selected' : '' ?>>Map Sumber Dana Stor Kas Kecil 1</option>
                                                                                <option value="sumberDanaSetorKasKecil2" <?= $key['elemen'] == 'sumberDanaSetorKasKecil2' ? 'selected' : '' ?>>Map Sumber Dana Stor Kas Kecil 2</option>
                                                                                <option value="sumberDanaSetorKasKecil3" <?= $key['elemen'] == 'sumberDanaSetorKasKecil3' ? 'selected' : '' ?>>Map Sumber Dana Stor Kas Kecil 3</option>
                                                                                <option value="sumberDanaSetorPajak" <?= $key['elemen'] == 'sumberDanaSetorPajak' ? 'selected' : '' ?>>Sumber Dana Setor Pajak</option>
                                                                                <option value="sumberDanaSetorPajak1" <?= $key['elemen'] == 'sumberDanaSetorPajak1' ? 'selected' : '' ?>>Map Sumber Dana Setor Pajak 1</option>
                                                                                <option value="sumberDanaSetorPajak2" <?= $key['elemen'] == 'sumberDanaSetorPajak2' ? 'selected' : '' ?>>Map Sumber Dana Setor Pajak 2</option>
                                                                                <option value="sumberDanaSetorPajak3" <?= $key['elemen'] == 'sumberDanaSetorPajak3' ? 'selected' : '' ?>>Map Sumber Dana Setor Pajak 3</option>
                                                                                <option value="sumberDanaPenerimaanPindahBuku" <?= $key['elemen'] == 'sumberDanaPenerimaanPindahBuku' ? 'selected' : '' ?>>Sumber Dana Penerimaan Pindah Buku</option>
                                                                                <option value="sumberDanaPengeluaranPindahBuku" <?= $key['elemen'] == 'sumberDanaPengeluaranPindahBuku' ? 'selected' : '' ?>>Sumber Dana Pengeluaran Pindah Buku</option>
                                                                                <option value="rekeningKasKecil" <?= $key['elemen'] == 'rekeningKasKecil' ? 'selected' : '' ?>>Rekening Kas Kecil</option>
                                                                                <option value="rekeningKasKecil1" <?= $key['elemen'] == 'rekeningKasKecil1' ? 'selected' : '' ?>>Map Kas Kecil 1</option>
                                                                                <option value="rekeningKasKecil2" <?= $key['elemen'] == 'rekeningKasKecil2' ? 'selected' : '' ?>>Map Kas Kecil 2</option>
                                                                                <option value="rekeningKasKecil3" <?= $key['elemen'] == 'rekeningKasKecil3' ? 'selected' : '' ?>>Map Kas Kecil 3</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <select name="d/kjurnalAnggaran[]" id="d/k" class="form-control">
                                                                        <option value="" disabled selected>Pilih Jenis</option>
                                                                        <option value="debit" <?= $key['jenis'] == 'debit' ? 'selected' : '' ?>>Debit</option>
                                                                        <option value="kredit" <?= $key['jenis'] == 'kredit' ? 'selected' : '' ?>>Kredit</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select name="nominaljurnalAnggaran[]" id="nominal" class="form-control">
                                                                        <option value="" disabled selected>Pilih Nominal</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-6">
                                        <h5>Jurnal Finansial</h5>
                                        <a href="javascript:tambah('jurnalFinansial', 1)" type="button" class="btn btn-primary" id="tambahFinansial">
                                            + <?php echo lang('add_new') ?>
                                        </a>
                                        <table class="table table-striped table-borderless table-hover">
                                            <thead>
                                                <tr class="table-active">
                                                    <th scope="col">Elemen</th>
                                                    <th scope="col">D/K</th>
                                                    <th scope="col">Nominal</th>
                                                </tr>
                                            </thead>
                                            <tbody id="jurnalFinansial">
                                                <?php
                                                    if (count($setupJurnal['jurnalFinansial']) > 0) {
                                                        foreach ($setupJurnal['jurnalFinansial'] as $key) { 
                                                            $nomor  = uniqid(); ?>
                                                            <tr nomor="<?= $nomor; ?>">
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-2">
                                                                            <a href="javascript:hapus('<?= $nomor; ?>')" type="button" class="btn btn-danger">-</a>
                                                                            <input type="hidden" name="idJurnalFinansial[]" value="<?= $key['idJurnalFinansial']; ?>">
                                                                        </div>
                                                                        <div class="col-10">
                                                                            <select name="elemenjurnalFinansial[]" id="elemen<?= $nomor; ?>" class="form-control" style="width: 100%;">
                                                                                <option value="" disabled selected>Pilih Elemen</option>
                                                                                <option value="kodeAkun" <?= $key['elemen'] == 'kodeAkun' ? 'selected' : '' ?>>Kode Akun</option>
                                                                                <option value="mapAkun1" <?= $key['elemen'] == 'mapAkun1' ? 'selected' : '' ?>>Map Akun 1</option>
                                                                                <option value="mapAkun2" <?= $key['elemen'] == 'mapAkun2' ? 'selected' : '' ?>>Map Akun 2</option>
                                                                                <option value="mapAkun3" <?= $key['elemen'] == 'mapAkun3' ? 'selected' : '' ?>>Map Akun 3</option>
                                                                                <option value="sumberDanaPiutang" <?= $key['elemen'] == 'sumberDanaPiutang' ? 'selected' : '' ?>>Sumber Dana Piutang</option>
                                                                                <option value="sumberDanaPiutang1" <?= $key['elemen'] == 'sumberDanaPiutang1' ? 'selected' : '' ?>>Map Sumber Dana Piutang 1</option>
                                                                                <option value="sumberDanaPiutang2" <?= $key['elemen'] == 'sumberDanaPiutang2' ? 'selected' : '' ?>>Map Sumber Dana Piutang 2</option>
                                                                                <option value="sumberDanaPiutang3" <?= $key['elemen'] == 'sumberDanaPiutang3' ? 'selected' : '' ?>>Map Sumber Dana Piutang 3</option>
                                                                                <option value="sumberDanaHutang" <?= $key['elemen'] == 'sumberDanaHutang' ? 'selected' : '' ?>>Sumber Dana Hutang</option>
                                                                                <option value="sumberDanaHutang1" <?= $key['elemen'] == 'sumberDanaHutang1' ? 'selected' : '' ?>>Map Sumber Dana Hutang 1</option>
                                                                                <option value="sumberDanaHutang2" <?= $key['elemen'] == 'sumberDanaHutang2' ? 'selected' : '' ?>>Map Sumber Dana Hutang 2</option>
                                                                                <option value="sumberDanaHutang3" <?= $key['elemen'] == 'sumberDanaHutang3' ? 'selected' : '' ?>>Map Sumber Dana Hutang 3</option>
                                                                                <option value="sumberDanaPenjualan" <?= $key['elemen'] == 'sumberDanaPenjualan' ? 'selected' : '' ?>>Sumber Dana Penjualan</option>
                                                                                <option value="sumberDanaPenjualan1" <?= $key['elemen'] == 'sumberDanaPenjualan1' ? 'selected' : '' ?>>Map Sumber Dana Penjualan 1</option>
                                                                                <option value="sumberDanaPenjualan2" <?= $key['elemen'] == 'sumberDanaPenjualan2' ? 'selected' : '' ?>>Map Sumber Dana Penjualan 2</option>
                                                                                <option value="sumberDanaPenjualan3" <?= $key['elemen'] == 'sumberDanaPenjualan3' ? 'selected' : '' ?>>Map Sumber Dana Penjualan 3</option>
                                                                                <option value="sumberDanaPembelian" <?= $key['elemen'] == 'sumberDanaPembelian' ? 'selected' : '' ?>>Sumber Dana Pembelian</option>
                                                                                <option value="sumberDanaPembelian1" <?= $key['elemen'] == 'sumberDanaPembelian1' ? 'selected' : '' ?>>Map Sumber Dana Pembelian 1</option>
                                                                                <option value="sumberDanaPembelian2" <?= $key['elemen'] == 'sumberDanaPembelian2' ? 'selected' : '' ?>>Map Sumber Dana Pembelian 2</option>
                                                                                <option value="sumberDanaPembelian3" <?= $key['elemen'] == 'sumberDanaPembelian3' ? 'selected' : '' ?>>Map Sumber Dana Pembelian 3</option>
                                                                                <option value="sumberDanaPengajuanKasKecil" <?= $key['elemen'] == 'sumberDanaPengajuanKasKecil' ? 'selected' : '' ?>>Sumber Dana Pengajuan Kas Kecil</option>
                                                                                <option value="sumberDanaPengajuanKasKecil1" <?= $key['elemen'] == 'sumberDanaPengajuanKasKecil1' ? 'selected' : '' ?>>Map Sumber Dana Pengajuan Kas Kecil 1</option>
                                                                                <option value="sumberDanaPengajuanKasKecil2" <?= $key['elemen'] == 'sumberDanaPengajuanKasKecil2' ? 'selected' : '' ?>>Map Sumber Dana Pengajuan Kas Kecil 2</option>
                                                                                <option value="sumberDanaPengajuanKasKecil3" <?= $key['elemen'] == 'sumberDanaPengajuanKasKecil3' ? 'selected' : '' ?>>Map Sumber Dana Pengajuan Kas Kecil 3</option>
                                                                                <option value="sumberDanaSetorKasKecil" <?= $key['elemen'] == 'sumberDanaSetorKasKecil' ? 'selected' : '' ?>>Sumber Dana Stor Kas Kecil</option>
                                                                                <option value="sumberDanaSetorKasKecil1" <?= $key['elemen'] == 'sumberDanaSetorKasKecil1' ? 'selected' : '' ?>>Map Sumber Dana Stor Kas Kecil 1</option>
                                                                                <option value="sumberDanaSetorKasKecil2" <?= $key['elemen'] == 'sumberDanaSetorKasKecil2' ? 'selected' : '' ?>>Map Sumber Dana Stor Kas Kecil 2</option>
                                                                                <option value="sumberDanaSetorKasKecil3" <?= $key['elemen'] == 'sumberDanaSetorKasKecil3' ? 'selected' : '' ?>>Map Sumber Dana Stor Kas Kecil 3</option>
                                                                                <option value="sumberDanaSetorPajak" <?= $key['elemen'] == 'sumberDanaSetorPajak' ? 'selected' : '' ?>>Sumber Dana Setor Pajak</option>
                                                                                <option value="sumberDanaSetorPajak1" <?= $key['elemen'] == 'sumberDanaSetorPajak1' ? 'selected' : '' ?>>Map Sumber Dana Setor Pajak 1</option>
                                                                                <option value="sumberDanaSetorPajak2" <?= $key['elemen'] == 'sumberDanaSetorPajak2' ? 'selected' : '' ?>>Map Sumber Dana Setor Pajak 2</option>
                                                                                <option value="sumberDanaSetorPajak3" <?= $key['elemen'] == 'sumberDanaSetorPajak3' ? 'selected' : '' ?>>Map Sumber Dana Setor Pajak 3</option>
                                                                                <option value="sumberDanaPenerimaanPindahBuku" <?= $key['elemen'] == 'sumberDanaPenerimaanPindahBuku' ? 'selected' : '' ?>>Sumber Dana Penerimaan Pindah Buku</option>
                                                                                <option value="sumberDanaPengeluaranPindahBuku" <?= $key['elemen'] == 'sumberDanaPengeluaranPindahBuku' ? 'selected' : '' ?>>Sumber Dana Pengeluaran Pindah Buku</option>
                                                                                <option value="rekeningKasKecil" <?= $key['elemen'] == 'rekeningKasKecil' ? 'selected' : '' ?>>Rekening Kas Kecil</option>
                                                                                <option value="rekeningKasKecil1" <?= $key['elemen'] == 'rekeningKasKecil1' ? 'selected' : '' ?>>Map Kas Kecil 1</option>
                                                                                <option value="rekeningKasKecil2" <?= $key['elemen'] == 'rekeningKasKecil2' ? 'selected' : '' ?>>Map Kas Kecil 2</option>
                                                                                <option value="rekeningKasKecil3" <?= $key['elemen'] == 'rekeningKasKecil3' ? 'selected' : '' ?>>Map Kas Kecil 3</option>
                                                                            </select>
                                                                            <script>
                                                                                fuck('<?= $nomor; ?>');
                                                                                function fuck(nomor) {
                                                                                    $('#elemen' + nomor).select2();
                                                                                }
                                                                            </script>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <select name="d/kjurnalFinansial[]" id="d/k" class="form-control">
                                                                        <option value="" disabled selected>Pilih Jenis</option>
                                                                        <option value="debit" <?= $key['jenis'] == 'debit' ? 'selected' : '' ?>>Debit</option>
                                                                        <option value="kredit" <?= $key['jenis'] == 'kredit' ? 'selected' : '' ?>>Kredit</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select name="nominaljurnalFinansial[]" id="nominal" class="form-control">
                                                                        <option value="" disabled selected>Pilih Nominal</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </form>
                    <!--/.col (left) -->
                <!--/.col (right) -->
                </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script>
    var base_url    = '{site_url}SetUpJurnal'; 

    function tambah(tipe, nomor) {
        var isiTabel    = `
            <tr nomor="${nomor}">
                <td>
                    <div class="row">
                        <div class="col-2">
                            <a href="javascript:hapus('${nomor}')" type="button" class="btn btn-danger">-</a>
                        </div>
                        <div class="col-10">
                            <select name="elemen${tipe}[]" id="elemen" class="form-control elemen">
                                <option value="" disabled selected>Pilih Elemen</option>
                                <option value="kodeAkun">Kode Akun</option>
                                <option value="mapAkun1">Map Akun 1</option>
                                <option value="mapAkun2">Map Akun 2</option>
                                <option value="mapAkun3">Map Akun 3</option>
                                <option value="sumberDanaPiutang">Sumber Dana Piutang</option>
                                <option value="sumberDanaPiutang1">Map Sumber Dana Piutang 1</option>
                                <option value="sumberDanaPiutang2">Map Sumber Dana Piutang 2</option>
                                <option value="sumberDanaPiutang3">Map Sumber Dana Piutang 3</option>
                                <option value="sumberDanaHutang">Sumber Dana Hutang</option>
                                <option value="sumberDanaHutang1">Map Sumber Dana Hutang 1</option>
                                <option value="sumberDanaHutang2">Map Sumber Dana Hutang 2</option>
                                <option value="sumberDanaHutang3">Map Sumber Dana Hutang 3</option>
                                <option value="sumberDanaPenjualan">Sumber Dana Penjualan</option>
                                <option value="sumberDanaPenjualan1">Map Sumber Dana Penjualan 1</option>
                                <option value="sumberDanaPenjualan2">Map Sumber Dana Penjualan 2</option>
                                <option value="sumberDanaPenjualan3">Map Sumber Dana Penjualan 3</option>
                                <option value="sumberDanaPembelian">Sumber Dana Pembelian</option>
                                <option value="sumberDanaPembelian1">Map Sumber Dana Pembelian 1</option>
                                <option value="sumberDanaPembelian2">Map Sumber Dana Pembelian 2</option>
                                <option value="sumberDanaPembelian3">Map Sumber Dana Pembelian 3</option>
                                <option value="sumberDanaPengajuanKasKecil">Sumber Dana Pengajuan Kas Kecil</option>
                                <option value="sumberDanaPengajuanKasKecil1">Map Sumber Dana Pengajuan Kas Kecil 1</option>
                                <option value="sumberDanaPengajuanKasKecil2">Map Sumber Dana Pengajuan Kas Kecil 2</option>
                                <option value="sumberDanaPengajuanKasKecil3">Map Sumber Dana Pengajuan Kas Kecil 3</option>
                                <option value="sumberDanaSetorKasKecil">Sumber Dana Stor Kas Kecil</option>
                                <option value="sumberDanaSetorKasKecil1">Map Sumber Dana Stor Kas Kecil 1</option>
                                <option value="sumberDanaSetorKasKecil2">Map Sumber Dana Stor Kas Kecil 2</option>
                                <option value="sumberDanaSetorKasKecil3">Map Sumber Dana Stor Kas Kecil 3</option>
                                <option value="sumberDanaSetorPajak">Sumber Dana Setor Pajak</option>
                                <option value="sumberDanaSetorPajak1">Map Sumber Dana Setor Pajak 1</option>
                                <option value="sumberDanaSetorPajak2">Map Sumber Dana Setor Pajak 2</option>
                                <option value="sumberDanaSetorPajak3">Map Sumber Dana Setor Pajak 3</option>
                                <option value="sumberDanaPenerimaanPindahBuku">Sumber Dana Penerimaan Pindah Buku</option>
                                <option value="sumberDanaPengeluaranPindahBuku">Sumber Dana Pengeluaran Pindah Buku</option>
                                <option value="rekeningKasKecil">Rekening Kas Kecil</option>
                                <option value="rekeningKasKecil1">Map Kas Kecil 1</option>
                                <option value="rekeningKasKecil2">Map Kas Kecil 2</option>
                                <option value="rekeningKasKecil3">Map Kas Kecil 3</option>
                            </select>
                        </div>
                    </div>
                </td>
                <td>
                    <select name="d/k${tipe}[]" id="d/k" class="form-control">
                        <option value="" disabled selected>Pilih Jenis</option>
                        <option value="debit">Debit</option>
                        <option value="kredit">Kredit</option>
                    </select>
                </td>
                <td>
                    <select name="nominal${tipe}[]" id="nominal" class="form-control">
                        <option value="" disabled selected>Pilih Nominal</option>
                    </select>
                </td>
            </tr>`;
        nomorBaru   = nomor + 1;
        switch (tipe) {
            case 'jurnalAnggaran':
                $('#jurnalAnggaran').append(isiTabel);
                break;
            case 'jurnalFinansial':
                $('#jurnalFinansial').append(isiTabel);
                break;
            default:
                break;
        }
        $('#tambahAnggaran').attr('href', 'javascript:tambah("jurnalAnggaran", ' + nomorBaru +')');
        $('#tambahFinansial').attr('href', 'javascript:tambah("jurnalFinansial", ' + nomorBaru +')');
        $(`#elemen${nomor}`).select2();
    }

    function hapus(nomor) {
        $(`tr[nomor="${nomor}"]`).remove();
    }

    function save() {
        var form        = $('#formSetUpJurnal')[0];
        var formData    = new FormData(form);
        $.ajax({
            url         : base_url + '/aksiEdit',
            dataType    : 'json',
            method      : 'post',
            data        : formData,
            contentType : false,
            processData : false,
            beforeSend: function() {
                pageBlock();
            },
            afterSend: function() {
                unpageBlock();
            },
            success: function(data) {
                if(data.status == 'success') {
                    swal("Berhasil!", "Berhasil Mengedit Data", "success");
                    redirect(base_url);
                } else {
                    swal("Gagal!", "Gagal Mengedit Data", "error");
                }
            },
            error: function() {
                swal("Gagal!", "Internal Server Error", "error");
            }
        })
    }

    function pilihFormulir() {
        var formulir    = $('#formulir').val();
        if (formulir === 'fakturPembelian' || formulir === 'fakturPenjualan') {
            $('#tipeTransaksi').html(
                `<div class="form-group">
                    <label>Formulir :</label>
                    <select name="tipeTransaksi" class="form-control">
                        <option value="" disabled selected>Pilih Tipe Transaksi</option>
                        <option value="cash">Cash</option>
                        <option value="kredit">Kredit</option>
                    </select>
                </div>`
            );
        } else {
            $('#tipeTransaksi').empty();
        }
    }
</script>