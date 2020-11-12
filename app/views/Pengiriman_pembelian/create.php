
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
                        <li class="breadcrumb-item"><a href="{base_url}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{base_url}pengiriman_barang">{title}</a></li>
                        <li class="breadcrumb-item active">{subtitle}</li>
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
                    <h3 class="card-title">{subtitle} {title}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="javascript:save()" id="form1" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo lang('date') ?>:</label>
                                    <div class="input-group"> 
                                        <input type="hidden" name="idPenerimaan" value="<?= $this->uri->segment(3); ?>">
                                        <input type="date" class="form-control" name="tanggal" required value="<?= $pengiriman['tanggal']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No. Pemesanan :</label>
                                            <input type="text" class="form-control" id="nopemesanan" disabled value="<?= $pengiriman['nopemesanan']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No. Pengiriman :</label>
                                            <input type="text" class="form-control" id="nopengiriman" disabled value="<?= $pengiriman['notrans']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo lang('supplier') ?>:</label>
                                    <input type="text" class="form-control" id="kontakid" disabled value="<?= $pengiriman['supplier']; ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo lang('warehouse') ?>:</label>
                                    <input type="text" class="form-control" id="gudangid" disabled value="<?= $pengiriman['gudang']; ?>">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Setup Jurnal : </label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Surat Jalan : </label>
                                    <input type="text" class="form-control" name="suratJalan">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo lang('note') ?>:</label>
                                    <textarea class="form-control catatan" name="catatan" rows="6"><?= $pengiriman['catatan']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 mt-3 table-responsive">
                            <table class="table table-xs table-striped table-borderless table-hover" id="table_detail">
                                <thead>
                                    <tr class="table-active">
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Nomor Akun</th>
                                        <th class="text-right"><?php echo lang('qty_residual') ?></th>
                                        <th class="text-right"><?php echo lang('qty_received') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $total_barang   = 0;
                                        $no             = 0;
                                        foreach ($pengiriman['detail'] as $key) { 
                                            $total_barang   += $key['jumlah']; ?>
                                            <tr>
                                                <input type="hidden" name="no[]" value="<?= $no; ?>">
                                                <input class="idpemesanan" type="hidden" name="idpemesanan" value="<?= $pengiriman['idpemesanan']; ?>">
                                                <input type="hidden" name="pemdet[]" value="<?= $key['id']; ?>">
                                                <input class="itemid" type="hidden" name="itemid[]" value="<?= $key['itemid']; ?>">
                                                <input type="hidden" name="harga[]" value="<?= $key['harga']; ?>">
                                                <td><?= $key['kode']; ?></td>
                                                <td><?= $key['nama_barang']; ?></td>
                                                <td><?= $key['akunno']; ?></td>
                                                <input type="hidden" name="jumlah_sisa[]" value="<?= $key['jumlahsisa']; ?>">
                                                <td class="text-right" width="20%"><?= $key['jumlahsisa']; ?></td>
                                                <td class="text-right" width="20%">
                                                    <input type="number" min="0" name="jumlah[]" class="form-control jumlah text-right" value="0">
                                                </td>
                                            </tr>
                                        <?php }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr class="table-active">
                                        <td colspan="3" style="text-align:center;">Total Barang</td>
                                        <td id="total_barang" class="text-right"><?= $total_barang; ?></td>
                                        <td id="total_penerimaan" class="text-right">0</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                <div class="card-footer">
                        <div class="text-left">
                            <div class="btn-group">
                                <a href="{site_url}pemesanan_pembelian" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                                <button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
                            </div>
                        </div>
                    </form>     
                </div>
                    <!-- /.col -->
            </div>
                    <!-- /.row -->
        </div>
            <!-- /.card-body -->
    </div>
</div>

<script type="text/javascript">
    var base_url = '{site_url}pengiriman_pembelian/';

    $(document).ready(function(){
        ajax_select({ 
            id: '#idpemesanan', 
            url: base_url + 'select2_pemesanan'
        });
    })

    $('#table_detail').on('change','.jumlah',function(){
        var itemid      = null;
        var jumlah      = null;
        var idpemesanan = null;
        var row = $(this).closest('tr');
        row.find('input.itemid').each(function() { itemid = this.value });
        row.find('input.jumlah').each(function() { jumlah = this.value });
        row.find('input.idpemesanan').each(function() { idpemesanan = this.value });
        $.ajax({
            url: base_url + 'cekjumlahinput',
            dataType: 'json',
            method: 'post',
            data: { 
                itemid      : itemid,
                idpemesanan : idpemesanan
            },
            success: function(data) {
                jumlah = parseInt(jumlah);
                if(jumlah > data.jumlahsisa) {
                    swal("Gagal!", "Kesalahan mengisi jumlah", "error");
                    row.find('input.jumlah').val( data.jumlahsisa );
                    $('#total_penerimaan').html(data.jumlahsisa);
                }
                if(jumlah < 0) {
                    location.reload()
                }
                hitungPenerimaan();
            }
        })
    })

    function hitungPenerimaan() {
        formData            = new FormData($('#form1')[0]);
        total_penerimaan    = 0;
        penerimaan          = formData.getAll('jumlah[]');
        penerimaan.forEach(function callback(element, index, array) {
            total_penerimaan    += parseInt(element);
        });
        $('#total_penerimaan').html(total_penerimaan);
    }

    function save() {
        var form = $('#form1')[0];
        var formData = new FormData(form);

        var sum = 0;
        $('#table_detail .jumlah').each(function() {
            var value = numeral($(this).val()).value();
            if(!isNaN(value) && value.length != 0) {
                sum += parseFloat(value);
            }
        });
        if(sum <= 0) {
            swal("Gagal!", "Silahkan Isi Jumlah Penerimaan", "error");
            return false;
        }
        
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
                    swal("Berhasil!", data.message, "success");
                    redirect(base_url);
                } else {
                    swal("Gagal!", data.message, "error");
                }
            },
            error: function() {
                swal("Gagal!", "Interval Server Error", "error");
            }
        })
    }

</script>