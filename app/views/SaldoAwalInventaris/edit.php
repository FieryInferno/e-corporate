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
                    <form action="javascript:save()" id="formSaldoAwalInventaris">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{subtitle} {title}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Kode Inventaris</label>
                                            <input type="hidden" name="idSaldoAwalInventaris" value="{idSaldoAwalInventaris}">
                                            <select id="kodeInventaris" class="form-control" name="kodeInventaris" required></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" name="namaInventaris" id="namaInventaris" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>No. Register</label>
                                            <input type="number" class="form-control" name="noRegister" id="noRegister" required onkeyup="panjangNoRegister(this)" value="{noRegister}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Kelompok</label>
                                            <input type="hidden" name="kelompok" id="kelompok1" required>
                                            <input type="text" class="form-control" id="kelompok" required readonly>
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
                                            <label>Tahun Perolehan</label>
                                            <input type="date" class="form-control" name="tahunPerolehan" placeholder="Tahun Perolehan" required value="{tanggalPembelian}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" value="{keterangan}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <input type="text" class="form-control" name="lokasi" placeholder="Lokasi" required value="{lokasi}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Kondisi</label>
                                            <select name="kondisi" id="kondisi" class="form-control" >
                                                <option value="" selected>Pilih Kondisi</option>
                                                <option value="baik" <?= $kondisi = 'baik' ? 'selected' : '' ; ?>>Baik</option>
                                                <option value="rusak" <?= $kondisi = 'rusak' ? 'selected' : '' ; ?>>Rusak</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nilai Buku</label>
                                            <input type="text" class="form-control" name="nilaiBuku" placeholder="Nilai Buku" onkeyup="format(this)" value="{harga}">
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
    var base_url    = '{site_url}SaldoAwalInventaris';
    $(document).ready(function() {
        ajax_select({
            id          : '#perusahaan',	
            url         : '{site_url}perusahaan/select2',
            selected    : {
                id  : '{perusahaan}'
            }
        });
		ajax_select({
            id          : '#kodeInventaris',	
            url         : '{site_url}item/select2',
            selected    : {
                id  : '{kodeInventaris}'
            }
        });
        $('#kelompok').val('{namaakun}');
        $('#kelompok1').val('{noAkun}');
        $('#namaInventaris').val('{namaInventaris}');
	})

    function save() {
        var form        = $('#formSaldoAwalInventaris')[0];
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

    function format(elem, id) {
        var data    = $(elem).val();
        $(elem).val(formatRupiah(String(data)));
    }

    $('#kodeInventaris').change(function () {
        var idItem  = $('#kodeInventaris').val();
        $.ajax({
            url     : '{site_url}item/get',
            method  : 'post',
            data    : {
                id  : idItem
            },
            success : function (data) {
                $('#kelompok').val(data.namaakun);
                $('#kelompok1').val(data.idakun);
                $('#namaInventaris').val(data.nama);
            }
        })
    })

    function panjangNoRegister(elemen) {
        var panjang = ($(elemen).val()).length;
        if (panjang > 5) {
            toastr.error('Tidak boleh lebih dari 5');
            $(elemen).val('');
        }
    }
</script>