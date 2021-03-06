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
                        <li class="breadcrumb-item"><a href="{site_url}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{site_url}SaldoAwalHutang">{title}</a></li>
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
                    <form action="javascript:save()" id="formSaldoAwalHutang">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{subtitle} {title}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>No. Invoice</label>
                                            <input type="hidden" name="idSaldoAwalPiutang" value="{idSaldoAwalPiutang}">
                                            <input type="text" class="form-control" name="noInvoice" placeholder="No. Invoice" required value="{noInvoice}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d'); ?>" id="tanggal" required value="{tanggal}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Tanggal Tempo</label>
                                            <input type="date" class="form-control" name="tanggalTempo" onchange="periksaTanggal()" id="tanggalTempo" required value="{tanggalTempo}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Perusahaan</label>
                                            <select id="perusahaan" class="form-control" name="perusahaan" required></select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Nama Pelanggan</label>
                                            <select id="pemasok" class="form-control" name="pemasok" required></select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>No. Akun</label>
                                            <select id="noAkun" class="form-control" name="noAkun" required></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" placeholder="deskripsi" class="form-control" required>{deskripsi}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Nilai Piutang</label>
                                                    <input type="text" class="form-control" name="nilaiPiutang" placeholder="Nilai Piutang" required onkeyup="format(this)" value="<?= number_format($jumlah,0,',','.'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Prime Owing</label>
                                                    <input type="text" class="form-control" name="primeOwing" placeholder="Prime Owing" required onkeyup="format(this)" value="<?= number_format($primeOwing,0,',','.'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Tax Owing</label>
                                                    <input type="text" class="form-control" name="taxOwing" placeholder="Tax Owing" required onkeyup="format(this)" value="<?= number_format($taxOwing,0,',','.'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Simpan</button>
                                <a class="btn btn-danger" href="{site_url}SaldoAwalHutang">Batal</a>
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
    var base_url    = '{site_url}SaldoAwalPiutang';
    $(document).ready(function() {
		ajax_select({
            id          : '#perusahaan',	
            url         : '{site_url}perusahaan/select2',
            selected    : {
                id  : '{perusahaan}'
            }
        });
        ajax_select({
            id          : '#pemasok',	
            url         : '{site_url}kontak/select2',
            selected    : {
                id  : '{namaPelanggan}'
            }
        });
        ajax_select({
            id          : '#noAkun',	
            url         : '{site_url}noakun/select2_noakun',
            selected    : {
                id  : '{akun}'
            }
        });	
	})

    function save() {
        var form        = $('#formSaldoAwalHutang')[0];
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
                    swal("Gagal!", data.pesan, "error");
                }
            },
            error: function() {
                swal("Gagal!", "Internal Server Error", "error");
            }
        })
    }

    function periksaTanggal() {
        var tanggal         = $('#tanggal').val();
        var tanggalTempo    = $('#tanggalTempo').val();
        var selisih         = (new Date(tanggalTempo).getTime() - new Date(tanggal).getTime()) / 1000;
        if (selisih < 0) {
            toastr.error('Tanggal Tempo Error');
            $('#tanggalTempo').val('');
        }
    }

    function format(elem, id) {
        var data    = $(elem).val();
        $(elem).val(formatRupiah(String(data)));
    }
</script>