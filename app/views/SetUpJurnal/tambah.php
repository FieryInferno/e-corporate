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
                            <select name="elemen${tipe}[]" id="elemen" class="form-control elemen">
                                <option value="" disabled selected>Pilih Elemen</option>
                                <option value="kodeAkun">Kode Akun</option>
                                <option value="mapAkun1">Map Akun 1</option>
                                <option value="mapAkun2">Map Akun 2</option>
                                <option value="mapAkun3">Map Akun 3</option>
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