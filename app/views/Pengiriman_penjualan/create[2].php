
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
                        <li class="breadcrumb-item active">{title}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Tambah {title}</h3>
                
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <a href="{site_url}Pemesanan_penjualan" class="btn btn-tool"><i class="fas fa-times"></i></a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="javascript:save()" id="form1">
                        <input type="hidden" name="pemesananid" value="{id}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo lang('date') ?> PO:</label>
                                    <div class="input-group"> 
                                        <input type="text" class="form-control datepicker" name="tanggalPO" required value="{tanggal}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo lang('date') ?> Terima:</label>
                                    <div class="input-group"> 
                                        <input type="date" class="form-control datepicker" name="tanggalterima" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo lang('Nomor Surat Jalan') ?>:</label>
                                    <div class="input-group"> 
                                        <input type="text" class="form-control nomorsuratjalan" name="nomorsuratjalan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo lang('Departemen') ?>:</label>
                                    <select class="form-control departemen" name="departemen" disabled></select>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <?php if (($jenis_barang == 'barang_dagangan') OR ($jenis_pembelian == 'barang_dan_jasa')): ?>
                                <div class="col-md-3">
                            <?php else : ?>
                                <div class="col-md-6">
                            <?php endif ?>
                                    <div class="form-group">
                                        <label><?php echo lang('supplier') ?>:</label>
                                        <select class="form-control kontakid" name="kontakid" disabled></select>
                                    </div>
                            <?php if (($jenis_barang == 'barang_dagangan') OR ($jenis_pembelian == 'barang_dan_jasa')): ?>
                                </div>
                            <?php else : ?>
                                </div>
                            <?php endif ?>
                            <?php if (($jenis_barang == 'barang_dagangan') OR ($jenis_pembelian == 'barang_dan_jasa')): ?>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo lang('warehouse') ?>:</label>
                                        <select class="form-control gudangid" name="gudangid" disabled></select>
                                    </div>
                                </div>
                            <?php endif ?>
                                <div class="col-md-6">&nbsp;</div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo lang('note') ?>:</label>
                                    <textarea class="form-control catatan" name="catatan" rows="6"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 mt-3 table-responsive">
                            <table class="table table-bordered" id="table_detail">
                                <thead class="{bg_header}">
                                    <tr>
                                        <th><?php echo lang('item') ?></th>
                                        <th class="text-right"><?php echo lang('qty_residual') ?></th>
                                        <th class="text-right"><?php echo lang('Jumlah Kirim') ?></th>
                                        <th class="text-right"><?php echo lang('stock') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($pemesanandetail as $row): ?>
                                        <tr>
                                            <input class="no" type="hidden" name="no[]" value="<?php echo $no ?>">
                                            <input class="" type="hidden" name="idpenjualdetail[]" value="<?php echo $row['id'] ?>">
                                            <input class="itemid" type="hidden" name="itemid[]" value="<?php echo $row['itemid'] ?>">
                                            <input class="harga" type="hidden" name="harga[]" value="<?php echo $row['harga'] ?>">
                                            <input class="diskon" type="hidden" name="diskon[]" value="<?php echo $row['diskon'] ?>">
                                            <input class="ppn" type="hidden" name="ppn[]" value="<?php echo $row['ppn'] ?>">
                                            <input class="biaya_pengiriman" type="hidden" name="biaya_pengiriman[]" value="<?php echo $row['biaya_pengiriman'] ?>">
                                            <td>
                                                <?php 
                                                    if ($row['tipe']=='barang'){
                                                        echo $row['item']; 
                                                    }else{
                                                        echo $row['lain_lain'];
                                                    }
                                                ?> 
                                            </td>
                                                <?php 
                                                    $jumlahsisa = 0;
                                                    if ($row['sisastok'] == ''){
                                                        $jumlahsisa = $row['jumlahsisa']; 
                                                    }else if ($row['jumlahsisa'] > $row['sisastok']){
                                                        $jumlahsisa = $row['sisastok']; 
                                                    }else{
                                                        $jumlahsisa = $row['jumlahsisa']; 
                                                    }
                                                ?>
                                            <td class="text-right" width="20%"><?php echo $row['jumlahsisa'] ?></td>
                                            <td class="text-right" width="20%">
                                                <input type="number" min="0" name="jumlah[]" class="form-control jumlah text-right" value="<?php echo $jumlahsisa ?>">
                                            </td>
                                            <td class="text-right" width="20%">
                                                <?php 
                                                    if ($row['tipe']=='barang'){
                                                        echo $row['sisastok']; 
                                                        echo '<input type="hidden" name="sisastok[]" class="form-control sisastok" value="'.$row['sisastok'].'">';
                                                    }else{
                                                        echo '-';
                                                    }
                                                ?> 
                                                <input type="hidden" name="tipe[]" class="form-control" value="<?php echo $row['tipe'] ?>">
                                            </td>
                                        </tr>
                                        <?php $no++ ?>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right">
                            <div class="btn-group">
                                <a href="{site_url}pemesanan_penjualan" class="btn bg-danger"><?php echo lang('cancel') ?></a>
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
    var base_url = '{site_url}Pengiriman_penjualan/';

    $(document).ready(function(){
        ajax_select({ id: '.kontakid', url: base_url + 'select2_kontak', selected: { id: '{kontakid}' } });
        ajax_select({ id: '.gudangid', url: base_url + 'select2_gudang', selected: { id: '{gudangid}' } });
        ajax_select({ id: '.departemen', url: base_url + 'select2_departemen', selected: { id: '{departemen}' } });
    })

    var table_detail = $('#table_detail').DataTable({
        sort: false,
        info: false,
        searching: false,
        paging: false,
    })

    $('#table_detail tbody').on('change','.jumlah',function(){
        var itemid = null;
        var jumlah = null;
        var sisastok = null;
        var row = $(this).closest('tr');
        row.find('input.itemid').each(function() { itemid = this.value });
        row.find('input.jumlah').each(function() { jumlah = this.value });
        row.find('input.sisastok').each(function() { sisastok = this.value });

        jumlah = parseInt(jumlah)
        sisastok = parseInt(sisastok);
        if (jumlah > sisastok){
             swal("Gagal!", "Stok tidak mencukupi!", "error");
             row.find('input.jumlah').val(sisastok);
             table_detail.reload();
        }else{
            $.ajax({
                url: base_url + 'cekjumlahinput',
                dataType: 'json',
                method: 'post',
                data: { 
                    itemid: itemid,
                    idpemesanan: '{id}'
                },
                success: function(data) {
                    jumlah = parseInt(jumlah);
                    
                    if(jumlah > data.jumlahsisa) {
                        swal("Gagal!", "Kesalahan menginput jumlah!", "error");
                        row.find('input.jumlah').val( data.jumlahsisa );
                        table_detail.reload()
                    }
                   
                }
            })
        }
    })

    function save() {
        var form = $('#form1')[0];
        var formData = new FormData(form);

        var sum = 0;
        $('#table_detail tbody .jumlah').each(function() {
            var value = numeral($(this).val()).value();
            if(!isNaN(value) && value.length != 0) {
                sum += parseFloat(value);
            }
        });
        if(sum <= 0) {
            swal("Gagal!", "Silahkan isi jumlah pengiriman!", "error");
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
                    swal("Berhasil!",data.message, "success");
                    redirect(base_url);
                } else {
                    swal("Gagal!",data.message, "error");
                }
            },
            error: function() {
                 swal("Gagal!", "Internal Server Error", "error");
            }
        })
    }
</script>