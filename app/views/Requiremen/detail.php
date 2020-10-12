
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
                        <li class="breadcrumb-item"><a href="{site_url}Requiremen">{title}</a></li>
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
                    <div class="row mb-3">
                        <div class="col-md-6 text-left">
                        <!-- <div class="btn-group">
                            <?php if ($status !== '3'): ?>
                                <a href="{site_url}pengiriman_pembelian/create?idpemesanan={id}" class="btn btn-outline-primary">
                                    <?php echo lang('delivery') ?> 
                                </a>
                                <a href="{site_url}faktur_pembelian/create?idpemesanan={id}" class="btn btn-outline-primary">
                                    <?php echo lang('create_invoice') ?>
                                </a>
                            <?php endif ?>
                        </div> -->
                        </div>
                        <div class="col-md-6 text-right">
                            <?php if ($status == '4'): ?>
                                <h1 class="text-danger font-weight-bold text-uppercase"><?php echo lang('pending') ?></h1>
                            <?php elseif ($status == '5'): ?>
                                <h1 class="text-warning font-weight-bold text-uppercase"><?php echo lang('partial') ?></h1>
                            <?php else: ?>
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
                                    <!-- <td class="font-weight-bold"><?php echo $kontak['nama'] ?></td> -->
                                    <td class="font-weight-bold">
                                        <select id="kontakid" class="form-control kontakid" name="kontakid" required></select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('warehouse') ?></td>
                                    <td class="font-weight-bold"><?php echo $gudang['nama'] ?></td>
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
                                        <td class="text-right font-weight-bold"><?= "Rp. " . number_format($subtotal,2,',','.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('discount') ?></td>
                                        <td class="text-right font-weight-bold"><?= $diskon . ' %'; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('ppn') ?></td>
                                        <td class="text-right font-weight-bold"><?= "Rp. " . number_format($ppn,2,',','.'); ?></td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td><?php echo lang('total') ?></td>
                                        <td class="text-right font-weight-bold"><?= "Rp. " . number_format($total,2,',','.'); ?></td>
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
                                                <td><?php echo $row['item'] ?></td>
                                                <td class="text-right"><?= "Rp. " . number_format($row['harga'],2,',','.'); ?></td>
                                                <td class="text-right"><?php echo number_format($row['jumlah']) ?></td>
                                                <td class="text-right"><?= "Rp. " . number_format($row['subtotal'],2,',','.'); ?></td>
                                                <td class="text-right"><?php echo number_format($row['diskon']) ?>%</td>
                                                <td class="text-right"><?php echo number_format($row['ppn']) ?>%</td>
                                                <td class="text-right"><?= "Rp. " . number_format($row['total'],2,',','.'); ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                        <tr class="bg-light">
                                            <td class="font-weight-bold text-right" colspan="6"><?php echo lang('grand_total') ?></td>
                                            <td class="font-weight-bold text-right"><?= "Rp. " . number_format($grandtotal,2,',','.'); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <form action="javascript:save()" id="form">
                        <div class="row mb-3">
                            <div class="col-md-6">
                            <div class="form-group">
                                    <label><?php echo lang('Uang Muka') ?>:</label>
                                    <input type="hidden" value="<?= $this->uri->segment(3); ?>" name="idpemesanan">
                                    <input class="form-control um" name="um">
                                </div>
                                <div class="row mb-3">                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('Total Uang Muka + Term') ?>:</label>
                                        <input class="form-control tum" name="tum">
                                    </div>
                                </div> 
                                <div class="col-md-3">                       
                                    <div class="form-group">
                                        <label><?php echo lang('Jumlah Term') ?>:</label>
                                        <input class="form-control jtem" name="jtem">
                                    </div>
                                </div>
                                </div>
                                
                                <div class="form-group">
                                    <label><?php echo lang('note') ?>:</label>
                                    <textarea class="form-control catatan" name="catatan" rows="6"></textarea>
                                </div>                       
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo lang('Term 1') ?>:</label>
                                    <input type="text" class="form-control" name="a1" placeholder="Angsuran 1">
                                </div>
                                <div class="form-group">
                                    <label><?php echo lang('Term 2') ?>:</label>
                                    <input type="text" class="form-control" name="a2" placeholder="Angsuran 2">
                                </div>
                                <div class="form-group">
                                    <label><?php echo lang('Term 3') ?>:</label>
                                    <input type="text" class="form-control" name="a3" placeholder="Angsuran 3">
                                </div>
                                <div class="form-group">
                                    <label><?php echo lang('Term 4') ?>:</label>
                                    <input type="text" class="form-control" name="a4" placeholder="Angsuran 4">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo lang('Term 5') ?>:</label>
                                    <input type="text" class="form-control" name="a5" placeholder="Angsuran 5">
                                </div>
                                <div class="form-group">
                                    <label><?php echo lang('Term 6') ?>:</label>
                                    <input type="text" class="form-control" name="a6" placeholder="Angsuran 6">
                                </div>
                                <div class="form-group">
                                    <label><?php echo lang('Term 7') ?>:</label>
                                    <input type="text" class="form-control" name="a7" placeholder="Angsuran 7">
                                </div>
                                <div class="form-group">
                                    <label><?php echo lang('Term 8') ?>:</label>
                                    <input type="text" class="form-control" name="a8" placeholder="Angsuran 8">
                                </div>
                            </div>
                        </div>
                        <div class="text-left">
                            <div class="btn-group">
                                <a href="{site_url}requiremen" class="btn bg-danger"><?php echo lang('cancel') ?></a>
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

    <script>
        var base_url = '{site_url}requiremen/';

        $(document).ready(function(){
            // ajax_select({ id: '.kontakid', url: base_url + 'select2_kontak', selected: { id: null } });
            var kontak  = '<?= $kontak['id']; ?>'
            $.ajax({
                url: base_url + 'select2_kontak',
                method: 'get',
                datatype: 'json',
                success: function(data) {
                    isi = "";
                    for (let index = 0; index < data.length; index++) {
                        if (kontak == data[index].id) {
                            isi += `<option value="${data[index].id}" selected>${data[index].text}</option>`
                        } else {
                            isi += `<option value="${data[index].id}">${data[index].text}</option>`
                        }
                    }
                    $('.kontakid').append(isi);
                    $('.kontakid').select2();
                }
            })
        });

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