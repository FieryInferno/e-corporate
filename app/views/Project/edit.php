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
                                            <input type="text" class="form-control" readonly id="noEvent" value="{noEvent}" name="noEvent" >
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Tanggal Mulai : </label>
                                            <input type="date" class="form-control" name="tanggalMulai" required  value="{tanggalMulai}">
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
                                            <input type="text" class="form-control" name="kodeEvent" required value="{kodeEvent}">
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
                                            <input type="date" class="form-control" name="tanggalSelesai" required value="{tanggalSelesai}">
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
                                            <input type="text" class="form-control" name="kelompokUmur" required value="{kelompokUmur}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Cabang : </label>
                                            <input type="hidden" name="idProject" value="{idProject}">
                                            <select class="form-control cabang" name="cabang" style="width: 100%;" id="cabang" required></select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Region : </label>
                                            <select class="form-control region" name="region" style="width: 100%;" id="region" required>
                                                <option value=""></option>
                                                <option value="DKI Jakarta" <?= $region = 'DKI Jakarta' ? 'selected' : '' ; ?>>DKI Jakarta</option>
                                                <option value="Network" <?= $region = 'Network' ? 'selected' : '' ; ?>>Network</option>
                                                <option value="Java" <?= $region = 'Java' ? 'selected' : '' ; ?>>Java</option>
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
                                                <tbody>
                                                    <?php
                                                        $totalPendapatan    = 0;
                                                        foreach ($detail as $key) { 
                                                            if ($key['tipe'] == 'pendapatan') { ?>
                                                                <tr>
                                                                    <td>
                                                                        <input type="hidden" name="noAkun[]" value="<?= $key['noAkun']; ?>">
                                                                        <?= $key['noAkun1']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" onkeyup="nominal(this), hitung('<?= $key['noAkun']; ?>')" name="harga[]" class="form-control" id="harga<?= $key['noAkun']; ?>" value="<?= number_format($key['harga'], 2, ',', '.'); ?>">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" onkeyup="nominal(this), hitung('<?= $key['noAkun']; ?>')" name="jumlah[]" class="form-control" id="jumlah<?= $key['noAkun']; ?>" value="<?= $key['jumlah']; ?>">
                                                                    </td>
                                                                    <td>
                                                                        <input type="hidden" name="subtotal[]" id="subtotal<?= $key['noAkun']; ?>" value="<?= $key['subtotal']; ?>">
                                                                        <input type="text" name="subtotal" required class="form-control subtotal<?= $key['noAkun']; ?>" disabled value="<?= number_format($key['subtotal'], 2, ',', '.'); ?>">
                                                                    </td>
                                                                    <td>
                                                                        <input type="hidden" name="tipe[]" value="pendapatan">
                                                                        <input type="hidden" name="total[]" id="total<?= $key['noAkun']; ?>" value="<?= $key['total']; ?>">
                                                                        <?php
                                                                            $totalPendapatan    += $key['total']; ?>
                                                                            <input type="text" name="totalPendapatan1" class="form-control total<?= $key['noAkun']; ?>" readonly value="<?= number_format($key['total'], 2, ',', '.'); ?>">
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:hapusDetail(this)" class="text-danger"><i class="fas fa-trash"></i></a>
                                                                    </td>
                                                                </tr>
                                                            <?php }
                                                        }
                                                    ?>
                                                </tbody>
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
                                                <tbody>
                                                <?php
                                                    $totalHPP    = 0;
                                                    foreach ($detail as $key) { 
                                                        if ($key['tipe'] == 'HPP') { ?>
                                                            <tr>
                                                                <td>
                                                                    <input type="hidden" name="noAkun[]" value="<?= $key['noAkun']; ?>">
                                                                    <?= $key['noAkun1']; ?>
                                                                </td>
                                                                <td>
                                                                    <input type="text" onkeyup="nominal(this), hitung('<?= $key['noAkun']; ?>')" name="harga[]" class="form-control" id="harga<?= $key['noAkun']; ?>" value="<?= number_format($key['harga'], 2, ',', '.'); ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" onkeyup="nominal(this), hitung('<?= $key['noAkun']; ?>')" name="jumlah[]" class="form-control" id="jumlah<?= $key['noAkun']; ?>" value="<?= $key['jumlah']; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" name="subtotal[]" id="subtotal<?= $key['noAkun']; ?>" value="<?= $key['subtotal']; ?>">
                                                                    <input type="text" name="subtotal" required class="form-control subtotal<?= $key['noAkun']; ?>" disabled value="<?= number_format($key['subtotal'], 2, ',', '.'); ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" name="tipe[]" value="HPP">
                                                                    <input type="hidden" name="total[]" id="total<?= $key['noAkun']; ?>" value="<?= $key['total']; ?>">
                                                                    <?php
                                                                        $totalHPP    += $key['total']; ?>
                                                                        <input type="text" name="totalHPP1" class="form-control total<?= $key['noAkun']; ?>" readonly value="<?= number_format($key['total'], 2, ',', '.'); ?>">
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:hapusDetail(this)" class="text-danger"><i class="fas fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                    }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="grossProfit1" role="tabpanel" aria-labelledby="contact-tab">
                                        <input type="hidden" name="grossProfit" id="grossProfit2" value="<?= $totalPendapatan - $totalHPP; ?>">
                                        <input type="hidden" name="totalPendapatan" id="totalPendapatan" value="<?= $totalPendapatan; ?>">
                                        <input type="hidden" name="totalHPP" id="totalHPP" value="<?= $totalHPP; ?>">
                                        <div class="form-group">
                                            <label>Total Pendapatan - Total HPP : </label>
                                            <input type="text" id="grossProfit" required class="form-control" disabled value="<?= number_format($totalPendapatan - $totalHPP, 2, ',', '.'); ?>">
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
                    <div class="table-responsive">
                        <table class="table table-xs table-striped table-borderless table-hover" id="tabelTambahPendapatan" style="width:100%">
                            <thead>
                                <tr class="table-active">
                                    <th width="20%">#</th>
                                    <th width="40%">No. Akun</th>
                                    <th width="40%">Nama Akun</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
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
                        <input type="text" name="totalHPP" id="totalHPP" required class="form-control" disabled>
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
                    <div class="table-responsive">
                        <table class="table table-xs table-striped table-borderless table-hover" id="tabelTambahHPP" style="width:100%">
                            <thead>
                                <tr class="table-active">
                                    <th width="20%">#</th>
                                    <th width="40%">No. Akun</th>
                                    <th width="40%">Nama Akun</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>                 
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    var tabelDetail = $('#tabelDetail').DataTable();
    var baseUrl     = '{site_url}project/';
    var tabelTambahPendapatan   = $('#tabelTambahPendapatan').DataTable({
        ajax    : {
            url : '{site_url}noakun/getPendapatan',
        },
        columns : [
            {
                data    : 'idakun',
                render  : function (data, type, row) {
                    return `<input type="checkbox" onchange="save_detail('TambahPendapatan', this);" idAkun="${data}" noAkun="${row.akunno}" namaAkun="${row.namaakun}">`;
                }, 
                width   : '20%'
            },
            {
                data    : 'akunno', 
                width   : '40%'
            },
            {
                data    : 'namaakun', 
                width   : '40%'
            }
        ],
        columnDefs  : [
            {width  : '50%', target : 0}
        ]
    });
    var tabelTambahHPP  = $('#tabelTambahHPP').DataTable({
        ajax    : {
            url : '{site_url}noakun/getHPP',
        },
        columns : [
            {
                data    : 'idakun',
                render  : function (data, type, row) {
                    return `<input type="checkbox" onchange="save_detail('TambahHPP', this);" idAkun="${data}" noAkun="${row.akunno}" namaAkun="${row.namaakun}">`;
                }, 
                width   : '20%'
            },
            {
                data    : 'akunno', 
                width   : '40%'
            },
            {
                data    : 'namaakun', 
                width   : '40%'
            }
        ],
        columnDefs  : [
            {width  : '50%', target : 0}
        ]
    });
    var tabelPendapatan         = $('#tabelPendapatan').DataTable();
    var tabelHPP                = $('#tabelHPP').DataTable();

	$(document).ready(function(){
        if ('<?= $this->session->userid; ?>' == '1') {
            ajax_select({ 
                id          : '.perusahaan', 
                url         : '{site_url}perusahaan/select2',
                selected    : {
                    id  : '{perusahaan}'
                }
            });
        }
        ajax_select({ 
            id          : '.gudang', 
            url         : '{site_url}gudang/select2/',
            selected    : {
                id  : '{gudang}'
            }
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
            selected    : {
                id  : '{rekanan}'
            }
        });
        ajax_select({ 
            id          : '.departemen', 
            url         : '{site_url}departemen/select2/' + perusahaan,
            selected    : {
                id  : '{departemen}'
            }
        });
        ajax_select({ 
            id          : '.cabang', 
            url         : '{site_url}cabang/select2/' + perusahaan,
            selected    : {
                id  : '{cabang}'
            }
        });
    })

    function save() {
        var form = $('#form')[0];
        var formData = new FormData(form);
        $.ajax({
            url: base_url + 'save/',
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
        var harga   = parseInt($('#harga' + elemen).val().replace(/[^,\d]/g, ''));
        var jumlah  = parseInt($('#jumlah' + elemen).val());
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
        $('.subtotal' + elemen).val(formatRupiah(String(total)) + ',00');
        $('.total' + elemen).val(formatRupiah(String(total)) + ',00');
        $('#subtotal' + elemen).val(total);
        $('#total' + elemen).val(total);
        var detail          = new FormData($('#form')[0]);
        var pendapatan      = detail.getAll('totalPendapatan1');
        var HPP             = detail.getAll('totalHPP1');
        var totalPendapatan = 0;
        var totalHPP        = 0;
        if (pendapatan) {
            pendapatan.forEach(element => {
                totalPendapatan += parseInt(element.replace(/[^,\d]/g, ''));
            });
        }
        if (HPP) {
            HPP.forEach(element => {
                totalHPP    += parseInt(element.replace(/[^,\d]/g, ''));
            });
        }
        var grossProfit = totalPendapatan - totalHPP;
        $('#grossProfit').val(formatRupiah(String(grossProfit)) + ',00');
        $('#grossProfit2').val(grossProfit);
        $('#totalPendapatan').val(totalPendapatan);
        $('#totalHPP').val(totalHPP);
    }

    function save_detail(tipe, elemen) {
        var idakun      = $(elemen).attr('idakun');
        var akunno      = $(elemen).attr('noAkun') + ' - ' + $(elemen).attr('namaAkun');
        var formNoAkun  = `<input type="hidden" name="noAkun[]" value="${idakun}">`;
        switch (tipe) {
            case 'TambahHPP':
                tabelHPP.row.add([
                    formNoAkun + akunno,
                    `<input type="text" onkeyup="nominal(this), hitung('${idakun}')" name="harga[]" class="form-control" id="harga${idakun}">`,
                    `<input type="text" onkeyup="nominal(this), hitung('${idakun}')" name="jumlah[]" class="form-control" id="jumlah${idakun}">`,
                    `<input type="hidden" name="subtotal[]" id="subtotal${idakun}">
                    <input type="text" name="subtotal" required class="form-control subtotal${idakun}" disabled>`,
                    `<input type="hidden" name="tipe[]" value="HPP">
                    <input type="hidden" name="total[]" id="total${idakun}">
                    <input type="text" name="totalHPP1" class="form-control total${idakun}" readonly>`,
                    `<a href="javascript:hapusDetail(this)" class="text-danger"><i class="fas fa-trash"></i></a>`
                ]).draw();
                break;
            case 'TambahPendapatan':
                tabelPendapatan.row.add([
                    formNoAkun + akunno,
                    `<input type="text" onkeyup="nominal(this), hitung('${idakun}')" name="harga[]" class="form-control" id="harga${idakun}">`,
                    `<input type="text" onkeyup="nominal(this), hitung('${idakun}')" name="jumlah[]" class="form-control" id="jumlah${idakun}">`,
                    `<input type="hidden" name="subtotal[]" id="subtotal${idakun}">
                    <input type="text" name="subtotal" required class="form-control subtotal${idakun}" disabled>`,
                    `<input type="hidden" name="tipe[]" value="pendapatan">
                    <input type="hidden" name="total[]" id="total${idakun}">
                    <input type="text" name="totalPendapatan1" class="form-control total${idakun}" readonly>`,
                    `<a href="javascript:hapusDetail(this)" class="text-danger"><i class="fas fa-trash"></i></a>`
                ]).draw();
                break;
        
            default:
                break;
        }
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