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
                        <li class="breadcrumb-item"><a href="<?= base_url('project'); ?>">{title}</a></li>
                        <li class="breadcrumb-item active">{subtitle}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <form action="javascript:save()" id="form">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="header-elements-inline">
                                    <h5 class="card-title">{subtitle}</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>No. Event : </label>
                                            <input type="text" class="form-control" name="noEvent" readonly id="noEvent">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Tanggal Mulai : </label>
                                            <input type="date" class="form-control" name="tanggalMulai" required>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label><?php echo lang('Perusahaan') ?>:</label>
                                            <div class="input-group"> 
                                                <?php
                                                    if ($this->session->userid !== '1') { ?>
                                                        <input type="hidden" name="idperusahaan" value="<?= $this->session->idperusahaan; ?>" id="perusahaan">
                                                        <input type="text" class="form-control" value="<?= $this->session->perusahaan; ?>" disabled>
                                                    <?php } else { ?>
                                                        <select class="form-control perusahaan" name="idperusahaan" style="width: 100%;" id="perusahaan" required></select>
                                                    <?php }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Kode Event : </label>
                                            <input type="text" class="form-control" name="kodeEvent" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Rekanan : </label>
                                            <select class="form-control rekanan" name="rekanan" style="width: 100%;" id="rekanan" required></select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Tanggal Selesai : </label>
                                            <input type="date" class="form-control" name="tanggalSelesai" required>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Departemen : </label>
                                            <select class="form-control departemen" name="departemen" style="width: 100%;" id="departemen" required></select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Kelompok Umur : </label>
                                            <input type="text" class="form-control" name="kelompokUmur" required required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Cabang : </label>
                                            <select class="form-control cabang" name="cabang" style="width: 100%;" id="cabang" required></select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Region : </label>
                                            <select class="form-control region" name="region" style="width: 100%;" id="region" required>
                                                <option value=""></option>
                                                <option value="DKI Jakarta">DKI Jakarta</option>
                                                <option value="Network">Network</option>
                                                <option value="Java">Java</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Gudang : </label>
                                            <select class="form-control gudang" name="gudang" style="width: 100%;" id="gudang"  required></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/.col (left) -->
                    <!--/.col (right) -->
                    </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#pendapatan" role="tab" aria-controls="home" aria-selected="true">Pendapatan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#HPP" role="tab" aria-controls="profile" aria-selected="false">HPP</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#grossProfit1" role="tab" aria-controls="contact" aria-selected="false">Gross Profit</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="pendapatan" role="tabpanel" aria-labelledby="home-tab">
                                        <button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#modalTambahPendapatan">Tambah</button>
                                        <div class="table-responsive">
                                            <table class="table table-xs table-striped table-borderless table-hover" id="tabelPendapatan">
                                                <thead>
                                                    <tr class="table-active">
                                                        <th>No. Akun</th>
                                                        <th>Harga</th>
                                                        <th>Jumlah</th>
                                                        <th>Subtotal</th>
                                                        <th>Total</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="HPP" role="tabpanel" aria-labelledby="profile-tab">
                                        <button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#modalTambahHPP">Tambah</button>
                                        <div class="table-responsive">
                                            <table class="table table-xs table-striped table-borderless table-hover" id="tabelHPP">
                                                <thead>
                                                    <tr class="table-active">
                                                        <th>No. Akun</th>
                                                        <th>Harga</th>
                                                        <th>Jumlah</th>
                                                        <th>Subtotal</th>
                                                        <th>Total</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="grossProfit1" role="tabpanel" aria-labelledby="contact-tab">
                                        <input type="hidden" name="grossProfit" id="grossProfit1">
                                        <input type="hidden" name="totalPendapatan" id="totalPendapatan">
                                        <input type="hidden" name="totalHPP" id="totalHPP">
                                        <div class="form-group">
                                            <label>Total Pendapatan - Total HPP : </label>
                                            <input type="text" id="grossProfit" required class="form-control" disabled>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{site_url}project" class="btn btn-danger">Batal</a>
                            </div>
                        </div>
                        <!--/.col (left) -->
                    <!--/.col (right) -->
                    </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </form>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalTambahPendapatan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="javascript:save_detail('TambahPendapatan')" id="formPendapatan">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pendapatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>No. Akun : </label>
                        <select class="form-control noakun" name="noakun" style="width: 100%;" id="noakun" required></select>
                    </div>  
                    <div class="form-group">
                        <label>Harga : </label>
                        <input type="text" name="harga" id="harga" required class="form-control" onkeyup="nominal(this), hitung()">
                    </div>  
                    <div class="form-group">
                        <label>Jumlah : </label>
                        <input type="text" name="jumlah" id="jumlah" required class="form-control" onkeyup="hitung()">
                    </div>  
                    <div class="form-group">
                        <label>Subtotal : </label>
                        <input type="text" name="subtotal" id="subtotal" required class="form-control" disabled>
                    </div>      
                    <div class="form-group">
                        <label>Total : </label>
                        <input type="text" name="total" id="total" required class="form-control" disabled>
                    </div>    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>                 
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalTambahHPP">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="javascript:save_detail('TambahHPP')">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah HPP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>No. Akun : </label>
                        <select class="form-control noakunHPP" name="noakunHPP" style="width: 100%;" id="noakunHPP" required></select>
                    </div>  
                    <div class="form-group">
                        <label>Harga : </label>
                        <input type="text" name="hargaHPP" id="hargaHPP" required class="form-control" onkeyup="nominal(this), hitung('HPP')">
                    </div>  
                    <div class="form-group">
                        <label>Jumlah : </label>
                        <input type="text" name="jumlahHPP" id="jumlahHPP" required class="form-control" onkeyup="hitung('HPP')">
                    </div>  
                    <div class="form-group">
                        <label>Subtotal : </label>
                        <input type="text" name="subtotalHPP" id="subtotalHPP" required class="form-control" disabled>
                    </div>      
                    <div class="form-group">
                        <label>Total : </label>
                        <input type="text" name="totalHPP" id="totalHPP1" required class="form-control" disabled>
                    </div>    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>                 
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    var tabelPendapatan = $('#tabelPendapatan').DataTable();
    var tabelHPP        = $('#tabelHPP').DataTable();
    var baseUrl         = '{site_url}project/';

	$(document).ready(function(){
        if ('<?= $this->session->userid; ?>' == '1') {
            ajax_select({ 
                id          : '.perusahaan', 
                url         : '{site_url}perusahaan/select2',
            });
        } else {
            perusahaan  = $('.perusahaan').val();
            $('#noEvent').val('IHT.2020.' + perusahaan + '{noEvent}');
        }
        ajax_select({ 
            id          : '.gudang', 
            url         : '{site_url}gudang/select2/',
        });
        ajax_select({ 
            id          : '.noakun', 
            url         : '{site_url}noakun/select2_pendapatan',
        });
        $('#region').select2({
            placeholder : 'Pilih Region',
            allowClear  : true
        });
        ajax_select({ 
            id          : '.noakunHPP', 
            url         : '{site_url}noakun/select2_hpp',
        });
    })

    $('.perusahaan').change(function (e) {
        perusahaan  = $('.perusahaan').val();
        $('#noEvent').val('IHT.2020.' + perusahaan + '.{noEvent}');
        ajax_select({ 
            id          : '.rekanan', 
            url         : '{site_url}rekanan/select2/' + perusahaan,
        });
        ajax_select({ 
            id          : '.departemen', 
            url         : '{site_url}departemen/select2/' + perusahaan,
        });
        ajax_select({ 
            id          : '.cabang', 
            url         : '{site_url}cabang/select2/' + perusahaan,
        });
    })

    function save() {
        var form = $('#form')[0];
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

    function nominal(elemen) {
        var nominal = $(elemen).val();
        $(elemen).val(formatRupiah(nominal));
    }

    function hitung(elemen) {
        if (elemen) {
            var harga   = parseInt($('#harga' + elemen).val().replace(/[^,\d]/g, ''));
            var jumlah  = parseInt($('#jumlah' + elemen).val());
        } else {
            var harga   = parseInt($('#harga').val().replace(/[^,\d]/g, ''));
            var jumlah  = parseInt($('#jumlah').val());
        }
        if (isNaN(harga) && isNaN(jumlah)) {
            total   = '';
        } else {
            if (isNaN(harga)) {
                harga   = 1;
            }
            if (isNaN(jumlah)) {
                jumlah   = 1;
            }
            total   = harga * jumlah;
        }
        if (elemen) {
            $('#subtotal' + elemen).val(formatRupiah(String(total)) + ',00');
            $('#total' + elemen + '1').val(formatRupiah(String(total)) + ',00');
        } else {
            $('#subtotal').val(formatRupiah(String(total)) + ',00');
            $('#total').val(formatRupiah(String(total)) + ',00');
        }
    }

    function save_detail(tipe) {
        switch (tipe) {
            case 'TambahHPP':
                var noAkun      = $('#noakunHPP').val();
                var harga       = $('#hargaHPP').val();
                var jumlah      = $('#jumlahHPP').val();
                var subtotal    = $('#subtotalHPP').val();
                var total       = $('#totalHPP1').val();
                var akunno      = $('#noakunHPP')[0].textContent;
                var formTotal   = `
                    <input type="hidden" name="total[]" value="${$('#totalHPP1').val().replace(/[^,\d]|(,00)/g, '')}">
                    <input type="hidden" name="totalHPP1" value="${$('#totalHPP1').val().replace(/[^,\d]|(,00)/g, '')}">`;
                var formNoAkun      = `<input type="hidden" name="noAkun[]" value="${$('#noakunHPP').val()}">`;
                var formHarga       = `<input type="hidden" name="harga[]" value="${$('#hargaHPP').val().replace(/[^,\d]|(,00)/g, '')}">`;
                var formJumlah      = `<input type="hidden" name="jumlah[]" value="${$('#jumlahHPP').val().replace(/[^,\d]|(,00)/g, '')}">`;
                var formSubtotal    = `<input type="hidden" name="subtotal[]" value="${$('#subtotalHPP').val().replace(/[^,\d]|(,00)/g, '')}">`;
                tabelHPP.row.add([
                    formNoAkun + akunno,
                    formHarga + harga,
                    formJumlah + jumlah,
                    formSubtotal + subtotal,
                    formTotal + total,
                    `<a href="javascript:hapusDetail(this)" class="text-danger"><i class="fas fa-trash"></i></a>`
                ]).draw();
                break;
            case 'TambahPendapatan':
                var noAkun      = $('#noakun').val();
                var harga       = $('#harga').val();
                var jumlah      = $('#jumlah').val();
                var subtotal    = $('#subtotal').val();
                var total       = $('#total').val();
                var akunno      = $('#noakun')[0].textContent;
                var formTotal   = `
                    <input type="hidden" name="total[]" value="${$('#total').val().replace(/[^,\d]|(,00)/g, '')}">
                    <input type="hidden" name="total" value="${$('#total').val().replace(/[^,\d]|(,00)/g, '')}">`;
                var formNoAkun      = `<input type="hidden" name="noAkun[]" value="${$('#noakun').val()}">`;
                var formHarga       = `<input type="hidden" name="harga[]" value="${$('#harga').val().replace(/[^,\d]|(,00)/g, '')}">`;
                var formJumlah      = `<input type="hidden" name="jumlah[]" value="${$('#jumlah').val().replace(/[^,\d]|(,00)/g, '')}">`;
                var formSubtotal    = `<input type="hidden" name="subtotal[]" value="${$('#subtotal').val().replace(/[^,\d]|(,00)/g, '')}">`;
                tabelPendapatan.row.add([
                    formNoAkun + akunno,
                    formHarga + harga,
                    formJumlah + jumlah,
                    formSubtotal + subtotal,
                    formTotal + total,
                    `<a href="javascript:hapusDetail(this)" class="text-danger"><i class="fas fa-trash"></i></a>`
                ]).draw();
                break;
        
            default:
                break;
        }
        switch (tipe) {
            case 'TambahHPP':
                $('#noakunHPP').val('');
                $('#hargaHPP').val('');
                $('#jumlahHPP').val('');
                $('#subtotalHPP').val('');
                $('#totalHPP1').val('');
                break;
            case 'TambahPendapatan':
                $('#noakun').val('');
                $('#harga').val('');
                $('#jumlah').val('');
                $('#subtotal').val('');
                $('#total').val('');
                break;
        
            default:
                break;
        }
        $('#modal' + tipe).modal('hide');
        var detail          = new FormData($('#form')[0]);
        var pendapatan      = detail.getAll('total');
        var HPP             = detail.getAll('totalHPP1');
        var totalPendapatan = 0;
        var totalHPP        = 0;
        if (pendapatan) {
            pendapatan.forEach(element => {
                totalPendapatan += parseInt(element);
            });
        }
        if (HPP) {
            HPP.forEach(element => {
                totalHPP    += parseInt(element);
            });
        }
        console.log(totalPendapatan);
        console.log(totalHPP);
        var grossProfit = totalPendapatan - totalHPP;
        $('#grossProfit').val(formatRupiah(String(grossProfit)) + ',00');
        $('#grossProfit1').val(grossProfit);
        $('#totalPendapatan').val(totalPendapatan);
        $('#totalHPP').val(totalHPP);
    }

    function save() {
        var form        = $('#form')[0];
        var formData    = new FormData(form);
        $.ajax({
            url         : baseUrl + 'save',
            dataType    : 'json',
            method      : 'post',
            data        : formData,
            contentType : false,
            processData : false,
            beforeSend  : function() {
                pageBlock();
            },
            afterSend   : function() {
                unpageBlock();
            },
            success : function(data) {
                if(data.status == 'success') {
                    swal("Berhasil!", "Berhasil Menambah Data", "success");
                    redirect(baseUrl);
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