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
                        <li class="breadcrumb-item"><a href="{site_url}SaldoAwalPiutang">{title}</a></li>
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
                    <form action="javascript:save()" id="formSaldoAwalPiutang">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{subtitle} {title}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Kode Barang</label>
                                            <input type="hidden" name="idSaldoAwalPersediaan" value="{idSaldoAwalPersediaan}">
                                            <select id="kodeBarang" class="form-control" name="kodeBarang" required></select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Perusahaan</label>
                                            <select id="perusahaan" class="form-control" name="perusahaan" required></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Gudang</label>
                                            <select id="gudang" class="form-control" name="gudang" required></select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Kode Akun</label>
                                            <select id="noAkun" class="form-control" name="noAkun"></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Jumlah</label>
                                            <input type="text" class="form-control" name="jumlah" placeholder="Jumlah" required onkeyup="format(this)" value="{quantity}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Harga Pokok</label>
                                            <input type="text" class="form-control" name="hargaPokok" placeholder="Harga Pokok" required onkeyup="format(this)" value="{unitPrice}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Simpan</button>
                                <a class="btn btn-danger" href="{site_url}SaldoAwalPiutang">Batal</a>
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
    var base_url    = '{site_url}SaldoAwalPersediaan';
    $(document).ready(function() {
        ajax_select({
            id          : '#perusahaan',	
            url         : '{site_url}perusahaan/select2',
            selected    : {
                id  : '{perusahaan}'
            }
        });
		ajax_select({
            id          : '#gudang',	
            url         : '{site_url}gudang/select2',
            selected    : {
                id  : '{gudang}'
            }
        });
        ajax_select({
            id          : '#noAkun',	
            url         : '{site_url}noakun/select2_noakun',
            selected    : {
                id  : ''
            }
        });	
        ajax_select({
            id          : '#kodeBarang',	
            url         : '{site_url}item/select2',
            selected    : {
                id  : '{kodeItem}'
            }
        });
	})

    function save() {
        var form        = $('#formSaldoAwalPiutang')[0];
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