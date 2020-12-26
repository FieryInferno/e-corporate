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
                                            <input type="text" class="form-control" placeholder="Kode Jurnal" name="kodeJurnal">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Formulir :</label>
                                            <select name="formulir" id="formulir" class="form-control" onchange="pilihFormulir()">
                                                <option value="" disabled selected>Pilih Formulir</option>
                                                <option value="fakturPembelian">Faktur Pembelian</option>
                                                <option value="fakturPenjualan">Faktur Penjualan</option>
                                                <option value="penerimaanBarang">Penerimaan Barang</option>
                                                <option value="pengirimanBarang">Pengiriman Barang</option>
                                                <option value="pengeluaranKasKecil">Pengeluaran Kas Kecil</option>
                                                <option value="kasBank">Kas Bank</option>
                                                <option value="saldoAwal">Saldo Awal</option>
                                                <option value="jurnalPenyesuaian">Jurnal Penyesuaian</option>
                                                <option value="setorPajak">Setor Pajak</option>
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
                                            <label>Tabulasi :</label>
                                            <select name="tabulasi" id="tabulasi" class="form-control" onchange="pilihTabulasi()">
                                                <option value="" disabled selected>Pilih Tabulasi</option>
                                                <option value="piutang">Piutang</option>
                                                <option value="hutang">Hutang</option>
                                                <option value="pembelian">Pembelian</option>
                                                <option value="penjualan">Penjualan</option>
                                                <option value="kasKecil">Kas Kecil</option>
                                                <option value="setorKasKecil">Setor Kas Kecil</option>
                                                <option value="budgetEvent">Budget Event</option>
                                                <option value="setorPajak">Setor Pajak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div id="caraBayar"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Keterangan :</label>
                                            <input type="text" class="form-control" placeholder="Keterangan" name="keterangan">
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
                                            <tbody id="jurnalAnggaran"></tbody>
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
                                            <tbody id="jurnalFinansial"></tbody>
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
        var formulir    = $('#formulir').val();
        if (formulir == 'fakturPembelian' || formulir == 'fakturPenjualan' || formulir == 'pengeluaranKasKecil') {
            var option  = `
                <option value="rekeningBank">Rekening Bank</option>
                <option value="mapRekeningBank1">Map Rekening Bank 1</option>
                <option value="mapRekeningBank2">Map Rekening Bank 2</option>
                <option value="mapRekeningBank3">Map Rekening Bank 3</option>
                <option value="mapRekeningPajak">Map Rekening Pajak</option>
                <option value="mapRekeningPajak1">Map Rekening Pajak 1</option>
                <option value="mapRekeningPajak2">Map Rekening Pajak 2</option>
                <option value="mapRekeningPajak3">Map Rekening Pajak 3</option>
            `;
            if (formulir == 'fakturPenjualan') {
                option  += `
                    <option value="budgetEvent">Budget Event</option>
                    <option value="mapBE1">Map Budget Event 1</option>
                    <option value="mapBE2">Map Budget Event 2</option>
                    <option value="mapBE3">Map Budget Event 3</option>
                `;
            }
        } else {
            var option  = ``;
        }
        var isiTabel    = `
            <tr nomor="${nomor}">
                <td>
                    <div class="row">
                        <div class="col-2">
                            <a href="javascript:hapus('${nomor}')" type="button" class="btn btn-danger">-</a>
                        </div>
                        <div class="col-10">
                            <select name="elemen${tipe}[]" id="elemen${nomor}" class="form-control elemen">
                                <option value=""></option>
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
                                <option value="akunPiutang">Akun Piutang</option>
                                <option value="akunPiutang1">Map Akun Piutang 1</option>
                                <option value="akunPiutang2">Map Akun Piutang 2</option>
                                <option value="akunPiutang3">Map Akun Piutang 3</option>
                                <option value="akunHutang">Akun Hutang</option>
                                <option value="akunHutang1">Map Akun Hutang 1</option>
                                <option value="akunHutang2">Map Akun Hutang 2</option>
                                <option value="akunHutang3">Map Akun Hutang 3</option>
                                <option value="akunPenjualan">Akun Penjualan</option>
                                <option value="akunPenjualan1">Map Akun Penjualan 1</option>
                                <option value="akunPenjualan2">Map Akun Penjualan 2</option>
                                <option value="akunPenjualan3">Map Akun Penjualan 3</option>
                                <option value="akunPembelian">Akun Pembelian</option>
                                <option value="akunPembelian1">Map Akun Pembelian 1</option>
                                <option value="akunPembelian2">Map Akun Pembelian 2</option>
                                <option value="akunPembelian3">Map Akun Pembelian 3</option>
                                ${option}
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
                    <select name="nominal${tipe}[]" id="nominal${nomor}" class="form-control">
                        <option value=""></option>
                        <option value="nominalPiutang">Nominal Piutang</option>
                        <option value="nominalHutang">Nominal Hutang</option>
                        <option value="nominalPenjualan">Nominal Penjualan</option>
                        <option value="nominalPembelian">Nominal Pembelian</option>
                        <option value="nominalBudgetEvent">Nominal Budget Event</option>
                        <option value="nominalSetorPajak">Nominal Setor Pajak</option>
                        <option value="nominalKasKecil">Nominal Kas Kecil</option>
                        <option value="nominalSetorKasKecil">Nominal Setor Kas Kecil</option>
                        <option value="nominalPindahbukuPenerimaan">Nominal Pindahbuku Penerimaan</option>
                        <option value="nominalPindahbukuPengeluaran">Nominal Pindahbuku Pengeluaran</option>
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
        $(`#elemen${nomor}`).select2({
            placeholder: "Pilih Elemen",
            allowClear: true
        });
        $(`#nominal${nomor}`).select2({
            placeholder: "Pilih Nominal",
            allowClear: true
        });
    }

    function hapus(nomor) {
        $(`tr[nomor="${nomor}"]`).remove();
    }

    function save() {
        var form        = $('#formSetUpJurnal')[0];
        var formData    = new FormData(form);
        $.ajax({
            url         : base_url + '/save',
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

    function pilihFormulir() {
        var formulir    = $('#formulir').val();
        if (formulir === 'fakturPembelian' || formulir === 'fakturPenjualan') {
            $('#tipeTransaksi').html(
                `<div class="form-group">
                    <label>Transaksi :</label>
                    <select name="tipeTransaksi" class="form-control">
                        <option value="" disabled selected>Pilih Tipe Transaksi</option>
                        <option value="cash">Cash</option>
                        <option value="kredit">Kredit</option>
                    </select>
                </div>`
            );
        } else if (formulir === 'pengirimanBarang' || formulir === 'penerimaanBarang') {
            $('#tipeTransaksi').html(
                `<div class="form-group">
                    <label>Jenis :</label>
                    <select name="jenis" class="form-control">
                        <option value="" disabled selected>Pilih Jenis</option>
                        <option value="jasa">Barang</option>
                        <option value="barang">Jasa</option>
                    </select>
                </div>`
            );
        } else {
            $('#tipeTransaksi').empty();
        }
    }

    function pilihTabulasi() {
        var tabulasi    = $('#tabulasi').val();
        if (tabulasi === 'pembelian' || tabulasi === 'penjualan') {
            $('#caraBayar').html(
                `<div class="form-group">
                    <label>Cara Bayar :</label>
                    <select name="cara_pembayaran" class="form-control">
                        <option value="" disabled selected>Pilih Tipe Cara Bayar</option>
                        <option value="cash">Cash</option>
                        <option value="kredit">Kredit</option>
                    </select>
                </div>`
            );
        } else {
            $('#caraBayar').empty();
        }
    }

</script>