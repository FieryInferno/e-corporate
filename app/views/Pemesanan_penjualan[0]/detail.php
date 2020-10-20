
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
                        <li class="breadcrumb-item"><a href="{site_url}pemesanan_penjualan">Penjualan</a></li>
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
                    <h3 class="card-title">Detail {title}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                       <a href="{site_url}pemesanan_penjualan" class="btn btn-tool"><i class="fas fa-times"></i></a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6 text-left">
                            <div class="btn-group">
                                <?php if ($status !== '3'): ?>
                                    <a href="{site_url}pengiriman_penjualan/create?idpemesanan={id}" class="btn btn-outline-primary">
                                        <?php echo lang('delivery') ?> 
                                    </a>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <?php if (($status == '4') OR ($status == '5')): ?>
                                <h1 class="text-danger font-weight-bold text-uppercase"><?php echo lang('pending') ?></h1>
                            <?php elseif ($status == '2'): ?>
                                <h1 class="text-warning font-weight-bold text-uppercase"><?php echo lang('partial') ?></h1>
                            <?php  elseif ($status == '3'): ?>
                                <h1 class="text-success font-weight-bold text-uppercase"><?php echo lang('done') ?></h1>
                            <?php endif ?>
                        </div>
                    </div>
                    <hr>
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
                                            <td class="font-weight-bold"><?php echo $kontak['nama'] ?></td>
                                            <!-- <td class="font-weight-bold">
                                                <select id="kontakid" class="form-control kontakid" name="kontakid" required></select>
                                            </td> -->
                                        </tr>
                                    <?php if (($jenis_barang == 'barang_dagangan') OR ($jenis_pembelian == 'barang_dan_jasa')): ?>
                                        <tr>
                                            <td><?php echo lang('warehouse') ?></td>
                                            <td class="font-weight-bold"><?php echo $gudang['nama'] ?></td>
                                        </tr>
                                    <?php endif?>
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
                                        <td class="text-right font-weight-bold"><?= "Rp. " . number_format($subtotal,0,',','.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('discount') ?></td>
                                        <td class="text-right font-weight-bold"><?= "Rp. " . number_format($diskon,0,',','.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('ppn') ?></td>
                                        <td class="text-right font-weight-bold"><?= "Rp. " . number_format($ppn,0,',','.'); ?></td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td><?php echo lang('total') ?></td>
                                        <td class="text-right font-weight-bold"><?= "Rp. " . number_format($total,0,',','.'); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                
                                <table class="table table-bordered">
                                    <thead class="{bg_header}">
                                        <tr>
                                            <th><?php echo lang('item') ?></th>
                                            <th class="text-right"><?php echo lang('price') ?></th>
                                            <th class="text-right"><?php echo lang('qty') ?></th>
                                            <th class="text-right"><?php echo lang('subtotal') ?></th>
                                            <th class="text-right"><?php echo lang('discount') ?></th>
                                            <th class="text-right"><?php echo lang('ppn') ?></th>
                                            <th class="text-right"><?php echo lang('total') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $grandtotal = 0; ?>
                                        <?php foreach ($pemesanandetail as $row): ?>
                                            <?php $grandtotal = $row['total'] + $grandtotal ?>
                                            <tr>
                                                <td>
                                                    <?php 
                                                    if ($row['tipe']=='barang'){
                                                        echo $row['item']; 
                                                    }else{
                                                        echo $row['lain_lain'];
                                                    }
                                                    ?>    
                                                </td>
                                                <td class="text-right"><?= "Rp. " . number_format($row['harga'],0,',','.'); ?></td>
                                                <td class="text-right"><?php echo number_format($row['jumlah']) ?></td>
                                                <td class="text-right"><?= "Rp. " . number_format($row['subtotal'],0,',','.'); ?></td>
                                                <td class="text-right"><?php echo number_format($row['diskon']) ?>%</td>
                                                <td class="text-right"><?php echo number_format($row['ppn']) ?>%</td>
                                                <td class="text-right"><?= "Rp. " . number_format($row['total'],0,',','.'); ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                        <tr class="bg-light">
                                            <td class="font-weight-bold text-right" colspan="6"><?php echo lang('grand_total') ?></td>
                                            <td class="font-weight-bold text-right"><?= "Rp. " . number_format($grandtotal,0,',','.'); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <form action="javascript:save()" id="form">
                        <input type="hidden" name="idpemesanan" value="<?= $this->uri->segment(3); ?>" readonly>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                &nbsp;                  
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label><?php echo lang('Uang Muka') ?>:</label>
                                            <input type="text" class="form-control um" name="um" value="<?= "Rp. " . number_format($angsuran['uangmuka'],0,',','.')?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label><?php echo lang('Jumlah Term') ?>:</label>
                                                <input type="number" class="form-control jtem" name="jtem" min="0" max="8" value="<?= $angsuran['jumlahterm'] ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    
                                        <?php for ($i=1; $i <= $angsuran['jumlahterm'] ; $i++) {  ?>
                                        <?php if (($i == 1) || ($i == 5)) { echo '<div class="col-md-6">'; } ?>
                                            <div class="form-group a<?= $i ?>" hidden >
                                                <label><?php echo lang('Term '.$i) ?>:</label>
                                                <input type="text" class="form-control" name="a<?= $i ?>" placeholder="Angsuran <?= $i ?>" 
                                                value="<?php if ($angsuran['a'.$i] != ''){ echo "Rp. " . number_format($angsuran['a'.$i],0,',','.'); }?>" <?php if ($angsuran['a'.$i] != ''){ echo 'readonly'; } ?> onkeyup="UbahInputRUpiah(this);SUMTOTAL_UM_Term();">
                                            </div>
                                        <?php if (($i == 4) || ($i == 8) || ($i ==  $angsuran['jumlahterm'])){ echo '</div>'; } ?>
                                        <?php } ?>
                                      
                                </div>
                                    <div class="form-group">
                                        <label><?php echo lang('Total Uang Muka + Term') ?>:</label>
                                        <input type="text" class="form-control tum" name="tum" readonly value="<?= "Rp. " . number_format($angsuran['total'],0,',','.')?>">
                                    </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="btn-group">
                                <a href="{site_url}pemesanan_penjualan" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                                <button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">          
                </div>
            </div>
        </div>
    </section>
</div>
    <script>
        var base_url = '{site_url}pemesanan_penjualan/';

        $(document).ready(function(){
            var kontak  = '<?= $kontak['id']; ?>'
            // ajax_select({ id: '.kontakid', url: base_url + 'select2_kontak', selected: { id: null } });
            
            //$.ajax({
                //url: base_url + 'select2_kontak',
                //method: 'get',
                //datatype: 'json',
                //success: function(data) {
                    //isi = "";
                    //for (let index = 0; index < data.length; index++) {
                        //if (kontak == data[index].id) {
                            //isi += `<option value="${data[index].id}" selected>${data[index].text}</option>`
                       // } else {
                            //isi += `<option value="${data[index].id}">${data[index].text}</option>`
                       // }
                    //}
                    //$('.kontakid').append(isi);
                    //$('.kontakid').select2();
                //}
            //})

            //hidden term 1 - 8
            for (var i = 1; i <= 8; i++) {
                $('.a'+i).attr("hidden", true);
            } 

            //menampilkan jumlah term
            var jumlahterm  = $('.jtem').val();
            for (var j = 1; j <= jumlahterm; j++) {
                $('.a'+j).attr("hidden", false);
            }    

        });


        //setting keyup format rupiah
        function UbahInputRUpiah(nama_inputan){
            $(nama_inputan).on('keyup',function(){
                var nilai= $(this).val();
                $(this).val(formatRupiah(String(nilai), 'Rp. '));
            });
        }

        //hitung total uang muka dan term
        function SUMTOTAL_UM_Term(){
            var totalangsuran = 0;
            for (var i = 1; i <= 8; i++) {
                angsuran = $('input[name=a'+i+']').val().replace(/[^,\d]/g, '').toString();
                if (angsuran == ''){
                    totalangsuran = totalangsuran + 0;
                }else{
                    totalangsuran = totalangsuran + parseInt(angsuran);
                }
            } 
            uang_muka = $('input[name=um]').val().replace(/[^,\d]/g, '').toString();
            if (uang_muka == ''){
                hasil_um_term = 0 + parseInt(totalangsuran);
            }else{
                hasil_um_term = parseInt(uang_muka) + parseInt(totalangsuran);
            }
             
            $('input[name=tum]').val(formatRupiah(String(hasil_um_term), 'Rp. ')); 
        }

        $(document).on('change','.kontakid',function(){
            var kontakid    = $(this).val();
            var idpemesanan = '<?= $this->uri->segment(3); ?>';
            $.ajax({
                url: base_url + 'update_kontakid/' + idpemesanan,
                method: 'post',
                datatype: 'json',
                data: {
                    kontakid: kontakid
                },
                beforeSend: function() {
                    pageBlock();
                },
                afterSend: function() {
                    unpageBlock();
                },
                success: function(data) {
                    if(data.status == 'success') {
                        swal("Berhasil!", "Berhasil Mengupdate Data", "success");
                    } else {
                        swal("Gagal!", "Gagal Mengupdate Data", "error");
                    }
                },
                error: function() {
                    swal("Gagal!", "Internal Server Error", "error");
                }
            })
        })

        function save() {
            var form = $('#form')[0];
            var formData = new FormData(form);
            $.ajax({
                url: base_url + 'tambah_angsuran',
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
                        swal("Berhasil!", "Berhasil Mengupdate Data", "success");
                        redirect(base_url);
                    } else {
                        swal("Gagal!", "Gagal Mengupdate Data", "error");
                    }
                },
                error: function() {
                    swal("Gagal!", "Internal Server Error", "error");
                }
            })
        }
    </script>