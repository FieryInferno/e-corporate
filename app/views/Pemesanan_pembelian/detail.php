<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-info22 mr-2"></i> <span class="font-weight-semibold">{title}</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none">
            <div class="d-flex justify-content-center">
                <div class="btn-group">
                    <a href="{site_url}pemesanan_pembelian/printpdf/{id}" target="_blank" class="btn btn-primary">
                        <?php echo lang('print') ?>
                    </a>
                    <a href="{site_url}pemesanan_pembelian" class="btn btn-danger">
                        <?php echo lang('back') ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="card">
        <div class="card-header {bg_header}">
            <div class="header-elements-inline">
                <h5 class="card-title">{subtitle}</h5>
            </div>
        </div>
        <div class="card-body">
        <div class="row mb-3">
                <div class="col-md-6 text-left">
                    <div class="btn-group">
                        <?php if ($status !== '3'): ?>
                            <a href="{site_url}pengiriman_pembelian/create?idpemesanan={id}" class="btn btn-outline-primary">
                                <?php echo lang('delivery') ?> 
                            </a>
                            <a href="{site_url}faktur_pembelian/create?idpemesanan={id}" class="btn btn-outline-primary">
                                <?php echo lang('create_invoice') ?>
                            </a>
                        <?php endif ?>
                    </div>
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
                                <td class="text-right font-weight-bold"><?php echo number_format($subtotal) ?></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('discount') ?></td>
                                <td class="text-right font-weight-bold"><?php echo number_format($diskon) ?></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('ppn') ?></td>
                                <td class="text-right font-weight-bold"><?php echo number_format($ppn) ?></td>
                            </tr>
                            <tr class="bg-light">
                                <td><?php echo lang('total') ?></td>
                                <td class="text-right font-weight-bold"><?php echo number_format($total) ?></td>
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
                                        <td class="text-right"><?php echo number_format($row['harga']) ?></td>
                                        <td class="text-right"><?php echo number_format($row['jumlah']) ?></td>
                                        <td class="text-right"><?php echo number_format($row['subtotal']) ?></td>
                                        <td class="text-right"><?php echo number_format($row['diskon']) ?>%</td>
                                        <td class="text-right"><?php echo number_format($row['ppn']) ?>%</td>
                                        <td class="text-right"><?php echo number_format($row['total']) ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr class="bg-light">
                                    <td class="font-weight-bold text-right" colspan="6"><?php echo lang('grand_total') ?></td>
                                    <td class="font-weight-bold text-right"><?php echo number_format($grandtotal) ?></td>
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
    </div>
</div>

<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script src="{assets_path}global/js/plugins/tables/datatables/datatables.min.js"></script>
<script src="{assets_path}global/js/plugins/pickers/pickadate/picker.js"></script>
<script src="{assets_path}global/js/plugins/pickers/pickadate/picker.date.js"></script>
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
                    NotifySuccess(data.message)
                } else {
                    NotifyError(data.message)
                }
            },
            error: function() {
                NotifyError('<?php echo lang('internal_server_error') ?>');
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
                    NotifySuccess(data.message)
                    redirect(base_url);
                } else {
                    NotifyError(data.message)
                }
            },
            error: function() {
                NotifyError('<?php echo lang('internal_server_error') ?>');
            }
        })
    }
</script>