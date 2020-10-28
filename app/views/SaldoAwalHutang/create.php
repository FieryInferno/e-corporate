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
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Nama Pemasok</label>
                                            <div class="col-sm-10">
                                                <select id="pemasok" class="form-control" name="pemasok" required></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Tanggal</label>
                                            <div class="col-sm-10">
                                                <input type="date" id="tanggal" class="form-control" name="tanggal" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">No. Invoice</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="noInvoice" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Nilai Hutang</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nilaiHutang" placeholder="Nilai Hutang">
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
    var base_url    = '{site_url}SaldoAwalHutang';
    $(document).ready(function() {
		ajax_select({
            id          : '#pemasok',	
            url         : '{site_url}kontak/select2',
            selected    : {
                id  : ''
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
                    swal("Gagal!", "Gagal Menambah Data", "error");
                }
            },
            error: function() {
                swal("Gagal!", "Internal Server Error", "error");
            }
        })
    }
</script>