
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
                        <li class="breadcrumb-item"><a href="{site_url}Pemesanan_pembelian">Pemesanan Pembelian</a></li>
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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{title} Pemesanan Pembelian</h3>
                </div>
                <!-- /.card-header -->
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
                                        <td class="text-right font-weight-bold"><?= number_format($subtotal,2,',','.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('discount') ?></td>
                                        <td class="text-right font-weight-bold"><?= $diskon; ?> %</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo lang('ppn') ?></td>
                                        <td class="text-right font-weight-bold"><?= number_format($ppn,2,',','.'); ?></td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td><?php echo lang('total') ?></td>
                                        <td class="text-right font-weight-bold"><?= number_format($total,2,',','.'); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-xs table-striped table-borderless table-hover">
                                    <thead>
                                        <tr class="table-active">
                                            <th><?php echo lang('item') ?></th>
                                            <th class="text-right"><?php echo lang('price') ?></th>
                                            <th class="text-right"><?php echo lang('qty') ?></th>
                                            <th class="text-right"><?php echo lang('subtotal') ?></th>
                                            <th class="text-right"><?php echo lang('discount') ?></th>
                                            <th class="text-right">Pajak</th>
                                            <th class="text-right">Biaya Pengiriman</th>
                                            <th class="text-right">No Akun</th>
                                            <th class="text-right"><?php echo lang('total') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $grandtotal = 0; ?>
                                        <?php foreach ($pemesanandetail as $row): ?>
                                            <?php $grandtotal = $row['total'] + $grandtotal ?>
                                            <tr>
                                                <td><?php echo $row['item'] ?></td>
                                                <td class="text-right"><?= number_format($row['harga'],2,',','.'); ?></td>
                                                <td class="text-right"><?php echo number_format($row['jumlah']) ?></td>
                                                <td class="text-right"><?= number_format($row['subtotal'],2,',','.'); ?></td>
                                                <td class="text-right"><?php echo number_format($row['diskon']) ?>%</td>
                                                <td class="text-right">
                                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalPajak<?= $row['id']; ?>" title="Detail Pajak">
                                                        <i class="fas fa-balance-scale"></i>
                                                    </button>
                                                    <div class="modal fade" id="modalPajak<?= $row['id']; ?>">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Pajak</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form id="form_pajak" action="javascript:total_pajak('', '${no}')" enctype="multipart/form-data" method="POST">
                                                                    <div class="modal-body">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-xs table-striped table-borderless table-hover index_datatable" style="width:100%" id="pajak">
                                                                                <thead>
                                                                                    <tr class="table-active">
                                                                                        <th>Nama Pajak</th>
                                                                                        <th>Kode Akun</th>
                                                                                        <th>Nama Akun</th>
                                                                                        <th>Nominal</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="isi_tbody_pajak">
                                                                                    <?php
                                                                                        if ($row['pajak']) {
                                                                                            foreach ($row['pajak'] as $key) { ?>
                                                                                                <tr>
                                                                                                    <td><?= $key['nama_pajak']; ?></td>
                                                                                                    <td><?= $key['akunno']; ?></td>
                                                                                                    <td><?= $key['namaakun']; ?></td>
                                                                                                    <td>
                                                                                                        <?php 
                                                                                                            switch ($key['pengurangan']) {
                                                                                                                case '0':
                                                                                                                    echo number_format($key['nominal'],2,',','.');
                                                                                                                    break;
                                                                                                                case '1':
                                                                                                                    echo '-' . number_format($key['nominal'],2,',','.');
                                                                                                                    break;
                                                                                                                
                                                                                                                default:
                                                                                                                    # code...
                                                                                                                    break;
                                                                                                            }
                                                                                                        ?>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            <?php }
                                                                                        }
                                                                                    ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-right"><?= number_format($row['biayapengiriman'],2,',','.'); ?></td>
                                                <td class="text-right"><?= $row['akunno']; ?></td>
                                                <td class="text-right"><?= number_format($row['total'],2,',','.'); ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="table-active">
                                            <td class="font-weight-bold text-right" colspan="8"><?php echo lang('grand_total') ?></td>
                                            <td class="font-weight-bold text-right"><?= number_format($grandtotal,2,',','.'); ?></td>
                                        </tr>
                                    </tfoot>
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
                                    <input class="form-control um" name="um" id="um" onkeyup="format('um'), hitungtum()" value="<?= number_format($angsuran['uangmuka'],2,',','.'); ?>">
                                </div>
                                <div class="row mb-3">                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('Total Uang Muka + Term') ?>:</label>
                                        <div class="alert alert-danger alert-dismissible" style="display:none" id="alertjumlah">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Jumlah Total dan Jumlah Uang Muka tidak sama
                                        </div>
                                        <input type="hidden" name="grandtotal" readonly value="<?= $grandtotal; ?>">
                                        <input type="hidden" name="id_angsuran" readonly value="<?= $angsuran['id']; ?>">
                                        <input class="form-control tum" name="tum" readonly value="<?= number_format($angsuran['total'],2,',','.'); ?>">
                                    </div>
                                </div> 
                                <div class="col-md-3">                       
                                    <div class="form-group">
                                        <label><?php echo lang('Jumlah Term') ?>:</label>
                                        <input class="form-control jtem" name="jtem" readonly value="<?= $angsuran['jumlahterm'] !== '' ? number_format($angsuran['jumlahterm'],2,',','.') : "" ; ?>">
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
                                    <input type="text" class="form-control" name="a1" placeholder="Angsuran 1" id="a1" onkeyup="format('a1'), hitungterm(), hitungtum()" value="<?= $angsuran['a1'] !== '' ? number_format($angsuran['a1'],2,',','.') : "" ; ?>">
                                </div>
                                <div class="form-group">
                                    <label><?php echo lang('Term 2') ?>:</label>
                                    <input type="text" class="form-control" name="a2" placeholder="Angsuran 2" id="a2" onkeyup="format('a2'), hitungterm(), hitungtum()" value="<?= $angsuran['a2'] !== '' ? number_format($angsuran['a2'],2,',','.') : "" ; ?>">
                                </div>
                                <div class="form-group">
                                    <label><?php echo lang('Term 3') ?>:</label>
                                    <input type="text" class="form-control" name="a3" placeholder="Angsuran 3" id="a3" onkeyup="format('a3'), hitungterm(), hitungtum()" value="<?= $angsuran['a3'] !== '' ? number_format($angsuran['a3'],2,',','.') : "" ; ?>">
                                </div>
                                <div class="form-group">
                                    <label><?php echo lang('Term 4') ?>:</label>
                                    <input type="text" class="form-control" name="a4" placeholder="Angsuran 4" id="a4" onkeyup="format('a4'), hitungterm(), hitungtum()" value="<?= $angsuran['a4'] !== '' ? number_format($angsuran['a4'],2,',','.') : "" ; ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo lang('Term 5') ?>:</label>
                                    <input type="text" class="form-control" name="a5" placeholder="Angsuran 5" id="a5" onkeyup="format('a5'), hitungterm(), hitungtum()" value="<?= $angsuran['a5'] !== '' ? number_format($angsuran['a5'],2,',','.') : "" ; ?>">
                                </div>
                                <div class="form-group">
                                    <label><?php echo lang('Term 6') ?>:</label>
                                    <input type="text" class="form-control" name="a6" placeholder="Angsuran 6" id="a6" onkeyup="format('a6'), hitungterm(), hitungtum()" value="<?= $angsuran['a6'] !== '' ? number_format($angsuran['a6'],2,',','.') : "" ; ?>">
                                </div>
                                <div class="form-group">
                                    <label><?php echo lang('Term 7') ?>:</label>
                                    <input type="text" class="form-control" name="a7" placeholder="Angsuran 7" id="a7" onkeyup="format('a7'), hitungterm(), hitungtum()" value="<?= $angsuran['a7'] !== '' ? number_format($angsuran['a7'],2,',','.') : "" ; ?>">
                                </div>
                                <div class="form-group">
                                    <label><?php echo lang('Term 8') ?>:</label>
                                    <input type="text" class="form-control" name="a8" placeholder="Angsuran 8" id="a8" onkeyup="format('a8'), hitungterm(), hitungtum()" value="<?= $angsuran['a8'] !== '' ? number_format($angsuran['a8'],2,',','.') : "" ; ?>">
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
        var base_url    = '{site_url}requiremen/';
        var kontak      = '<?= $kontakid; ?>'

        $(document).ready(function(){
            ajax_select({ 
                id          : '.kontakid', 
                url         : base_url + 'select2_kontak', 
                selected    : { 
                    id  : kontak 
                    } 
            });
        });

        $(document).on('select2:select','.kontakid',function(e){
            var kontakid    = e.params.data.id;
            var idpemesanan = '<?= $this->uri->segment(3); ?>';
            $.ajax({
                url: base_url + 'update_kontakid/' + idpemesanan,
                method: 'post',
                datatype: 'json',
                data: {
                    kontakid: kontakid
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
                        redirect('{site_url}pemesanan_pembelian');
                    } else {
                        swal("Gagal!", data.message, "error");
                    }
                },
                error: function() {
                    swal("Gagal!", "Internal Server Error", "error");
                }
            })
        }

        function format(id) {
            var angka   = $('#'+id).val()
            $('#'+id).val(formatRupiah(String(angka), 'Rp. '));
        }

        function hitungtum() {
            var um      = parseInt($('#um').val().replace(/[Rp. ]/g, ''));
            var jtem    = parseInt($('.jtem').val().replace(/[Rp. ]/g, ''));
            if (isNaN(jtem)) {
                jtem = 0;
            }
            if (isNaN(um)) {
                um = 0;
            }
            tum = um + jtem;
            $('.tum').val(formatRupiah(String(tum), 'Rp. ') + ',00');
            if (tum !== <?= $grandtotal; ?>) {
                $('#alertjumlah').css('display', 'block');
            } else {
                $('#alertjumlah').css('display', 'none');
            }
            
        }

        function hitungterm() {
            var a1  = parseInt($('#a1').val().replace(/[Rp. ]/g, ''));
            var a2  = parseInt($('#a2').val().replace(/[Rp. ]/g, ''));
            var a3  = parseInt($('#a3').val().replace(/[Rp. ]/g, ''));
            var a4  = parseInt($('#a4').val().replace(/[Rp. ]/g, ''));
            var a5  = parseInt($('#a5').val().replace(/[Rp. ]/g, ''));
            var a6  = parseInt($('#a6').val().replace(/[Rp. ]/g, ''));
            var a7  = parseInt($('#a7').val().replace(/[Rp. ]/g, ''));
            var a8  = parseInt($('#a8').val().replace(/[Rp. ]/g, ''));
            if (isNaN(a1)) {
                a1 = 0;
            }
            if (isNaN(a2)) {
                a2 = 0;
            }
            if (isNaN(a3)) {
                a3 = 0;
            }
            if (isNaN(a4)) {
                a4 = 0;
            }
            if (isNaN(a5)) {
                a5 = 0;
            }
            if (isNaN(a6)) {
                a6 = 0;
            }
            if (isNaN(a7)) {
                a7 = 0;
            }
            if (isNaN(a8)) {
                a8 = 0;
            }
            jtem    = a1 + a2 + a3 + a4 + a5 + a6 + a7 + a8;
            $('.jtem').val(formatRupiah(String(jtem), 'Rp. ') + ',00');
        }
    </script>