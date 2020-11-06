
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
                        <li class="breadcrumb-item"><a href="{site_url}Pemesanan_penjualan">Penjualan</a></li>
                        <li class="breadcrumb-item"><a href="{site_url}Faktur_penjualan">{title}</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail {title}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><?php echo lang('notrans') ?></td>
                                        <td class="font-weight-bold">{notrans}</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('date') ?></td>
                                        <td class="font-weight-bold">{tanggal}</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('supplier') ?></td>
                                        <td class="font-weight-bold">{kontak}</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('warehouse') ?></td>
                                        <td class="font-weight-bold">{gudang}</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('note') ?></td>
                                        <td class="font-weight-bold">{catatan}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                    <td><?php echo lang('subtotal') ?></td>
                                    <td class="text-right font-weight-bold"><?= number_format($subtotal, 2, ',','.') ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('discount') ?></td>
                                        <?Php 
                                            $hasil_diskon = $subtotal;
                                            if ($diskon > 0){
                                                $nominaldiskon = ($diskon * $subtotal / 100);
                                                $hasil_diskon = $hasil_diskon - $nominaldiskon;
                                            }else{
                                                $nominaldiskon = 0;
                                                $hasil_diskon = $hasil_diskon - $nominaldiskon;
                                            }
                                        ?>
                                    <td class="text-right font-weight-bold"><?= number_format($hasil_diskon, 2, ',','.') ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('ppn') ?></td>
                                    <td class="text-right font-weight-bold"><?= number_format($ppn, 2, ',','.') ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('Biaya Pengiriman') ?></td>
                                    <td class="text-right font-weight-bold"><?= number_format($biaya_pengiriman, 2, ',','.') ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('total') ?></td>
                                    <td class="text-right font-weight-bold"><?= number_format($total, 2, ',','.') ?></td>
                                </tr>
                                <?php if ($totalretur > 0): ?>
                                    <tr>
                                        <td><?php echo lang('Total_Retur') ?></td>
                                        <td class="text-right font-weight-bold">(<?= number_format($totalretur, 2, ',','.') ?>)</td>
                                    </tr>
                                <?php endif ?>
                                <?php if ($totalkreditmemo > 0): ?>
                                    <tr>
                                        <td class="font-weight-bold"><?php echo lang('Total_Kredit_Memo') ?></td>
                                        <td class="text-right font-weight-bold"><?= number_format($totalkreditmemo, 2, ',','.') ?></td>
                                    </tr>
                                <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-pills mb-3 nav-tabs" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Detil Faktur Penjualan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Setor Pajak</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <div class="table-responsive">
                                        <table class="table table-xs table-striped table-borderless indexDatatables">
                                            <thead>
                                                <tr class="table-active">
                                                    <th><?php echo lang('item') ?></th>
                                                    <th><?php echo lang('price') ?></th>
                                                    <th><?php echo lang('qty') ?></th>
                                                    <th><?php echo lang('subtotal') ?></th>
                                                    <th><?php echo lang('discount') ?></th>
                                                    <th>Pajak</th>
                                                    <th><?php echo lang('Biaya Pengiriman') ?></th>
                                                    <th>No Akun</th>
                                                    <th><?php echo lang('total') ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{item}</td>
                                                    <td class="text-right"><?= number_format($harga, 2, ',', '.'); ?></td>
                                                    <td class="text-right">{jumlah}</td>
                                                    <td class="text-right"><?= number_format($subtotal, 2, ',', '.'); ?></td>
                                                    <td>{diskon}%</td>
                                                    <td class="text-right"><?= number_format($ppn, 2, ',', '.'); ?></td>
                                                    <td class="text-right"><?= number_format($biaya_pengiriman, 2, ',', '.'); ?></td>
                                                    <td class="text-right">{akunno}</td>
                                                    <td class="text-right"><?= number_format($total, 2, ',', '.'); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="table-responsive">
                                        <table class="table table-xs table-striped table-borderless" id="tabelSetorPajak">
                                            <thead>
                                                <tr class="table-active">
                                                    <th>Nama Pajak</th>
                                                    <th>Kode Akun</th>
                                                    <th>Nama Akun</th>
                                                    <th>Nominal</th>
                                                    <th>NPWP</th>
                                                    <th>NTPN</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{nama_pajak}</td>
                                                    <td>{akunPajak}</td>
                                                    <td>{namaAkunPajak}</td>
                                                    <td><?= number_format($nominal, 2, ',', '.'); ?></td>
                                                    <td><input type="text" name="npwp" id="npwp" class="form-control" readonly></td>
                                                    <td><input type="text" name="ntpn" id="ntpn" class="form-control" readonly></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    var tabelFakturPenjualan    = $('.indexDatatables').DataTable();
    var tabelSetorPajak         = $('#tabelSetorPajak').DataTable();
    var base_url                = '{site_url}SetorPajak/';

    $('#npwp').on('click', function () {
        $(this).removeAttr('readonly')
    })

    $('#npwp').on('focusout', function () {
        $(this).attr('readonly', 'readonly');
        update('npwp');
    })

    $('#ntpn').on('click', function () {
        $(this).removeAttr('readonly')
    })

    $('#ntpn').on('focusout', function () {
        $(this).attr('readonly', 'readonly');
        update('ntpn');
    })

    $(document).ready(function () {
        get('npwp');
        get('ntpn');
    })

    function get(jenis) {
        $.ajax({
            url     : base_url + 'get',
            type    : 'post',
            data    : {
                jenis                       : jenis,
                idPajakPemesananPenjualan   : '{idPajakPemesananPenjualan}'
            },
            success : function (response) {
                if (response[jenis] !== null) {
                    $('#' + jenis).val(response[jenis]);
                }
            }
        })
    }

    function update(jenis) {
        var isi = $('#' + jenis).val();
        switch (jenis) {
            case 'npwp':
                var data    = {
                    npwp                        : isi,
                    idPajakPemesananPenjualan   : '{idPajakPemesananPenjualan}'
                }
                break;
            case 'ntpn':
                var data    = {
                    ntpn                        : isi,
                    idPajakPemesananPenjualan   : '{idPajakPemesananPenjualan}'
                }
                break;
        
            default:
                break;
        }
        $.ajax({
            url     : base_url + 'update',
            type    : 'post',
            data    : data,
            beforeSend: function() {
                pageBlock();
            },
            afterSend: function() {
                unpageBlock();
            }
        })
    }
</script>