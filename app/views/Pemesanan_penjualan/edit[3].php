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
                        <li class="breadcrumb-item"><a href="<?= base_url('Pemesanan_penjualan'); ?>">Penjualan</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li> 
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
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah <?= $title; ?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <a href="{site_url}Pemesanan_penjualan" class="btn btn-tool"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- card body -->
                        <div class="card-body">
                            <!-- form start -->
                            <form id="form1" action="javascript:save()">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="hidden" class="form-control idpemesanan" readonly name="idpemesanan" value="{id}">
                                        <div class="form-group">
                                            <label><?php echo lang('notrans') ?>:</label>
                                            <input type="text" class="form-control"readonly name="notrans" placeholder="AUTO">
                                        </div>
                                        <div class="form-group" id="rekanan">
                                            <label><?php echo lang('rekanan') ?>:</label>
                                            <select class="form-control kontakid" name="kontakid" required></select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo lang('date') ?>:</label>
                                            <div class="input-group"> 
                                                <input type="date" class="form-control datepicker" name="tanggal" required value="{tanggal}">
                                            </div>
                                        </div>
                                        <div class="form-group" id="gudang">
                                            <label><?php echo lang('gudang') ?>:</label>
                                            <select class="form-control gudangid" name="gudangid"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo lang('Perusahaan') ?>:</label>
                                            <div class="input-group"> 
                                                <select id="perusahaan" class="form-control perusahaan" name="idperusahaan" required style="width: 100%;"></select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo lang('Departemen') ?>:</label>
                                            <div class="input-group"> 
                                            <select id="departemen" class="form-control departemen" name="dept" required></select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo lang('PIC') ?>:</label>
                                            <div class="input-group"> 
                                            <select id="pejabat" class="form-control pejabat" name="pejabat" required></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                    <div class="form-group">
                                            <label><?php echo lang('Jenis Penjualan') ?>:</label>
                                            <select class="form-control jenis_penjualan" name="jenis_penjualan" required>
                                                <option value="barang">Barang</option>                                   
                                                <option value="jasa">Jasa</option>
                                                <option value="barang_dan_jasa">Barang dan Jasa</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo lang('Jenis Barang') ?>:</label>
                                            <select class="form-control jenis_barang" name="jenis_barang" id="jenis_barang" required>
                                                    <option value="barang_dagangan">Barang Dagangan</option>
                                                    <option value="inventaris">Inventaris</option>    
                                                    <option value="barang_dan_jasa">Barang dan Jasa</option>                               
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo lang('Cara Pembayaran') ?>:</label>
                                            <select class="form-control cara_pembayaran" name="cara_pembayaran" required>
                                                    <option value="cash">Cash</option>
                                                    <option value="credit">Credit</option>                                   
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                </div>
                                <div class="mb-3 mt-3 table-responsive">
                                    <div class="mt-3 mb-3">
                                        <button type="button" class="btn btn-sm btn-primary btn_add_detail_barang" hidden><?php echo lang('Tambah Barang') ?></button>
                                        <button type="button" class="btn btn-sm btn-primary btn_add_detail_jasa" hidden><?php echo lang('Tambah Jasa') ?></button>
                                        <button type="button" class="btn btn-sm btn-primary btn_add_detail_budgetevent" hidden><?php echo lang('Budget Event') ?></button>
                                    </div>
                                    <div class="row" id="nokwitansi_rekening">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo lang('Nomor') ?>:</label>
                                                <input type="text" class="form-control nokwitansi" readonly name="nokwitansi">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo lang('Rekening') ?>:</label>
                                                <select id="rekening" class="form-control rekening" name="rekening"></select>
                                            </div>
                                        </div>
                                    </div>
                                  
                                    <table class="table table-bordered" id="tabel_detail_item" width="100%" hidden>
                                        <thead class="{bg_header}">
                                            <tr>
                                                <th>ID</th>
                                                <th class="text-center"><?php echo lang('Item') ?></th>
                                                <th class="text-center"><?php echo lang('price') ?></th>
                                                <th class="text-center"><?php echo lang('qty') ?></th>
                                                <th class="text-center"><?php echo lang('subtotal') ?></th>
                                                <th class="text-center"><?php echo lang('Kurs <br> mata uang') ?></th>
                                                <th class="text-center"><?php echo lang('discount') ?></th>
                                                <th class="text-center"><?php echo lang('Pajak') ?></th>
                                                <th class="text-center"><?php echo lang('Biaya <br>Pengiriman') ?></th>
                                                <th class="text-center"><?php echo lang('No Akun') ?></th>
                                                <th class="text-center"><?php echo lang('total') ?></th>
                                                <th class="text-center"><?php echo lang('action') ?></th>
                                                <th class="text-center"><?php echo lang('tipe') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody> </tbody>
                                        <tfoot class="bg-light">
                                            <tr>
                                                <th>ID</th>
                                                <th colspan="8">&nbsp;</th>
                                                <th class="text-right"><?php echo lang('total') ?></th>
                                                <th class="text-center" id="total_total_item"></th>
                                                <th><input type="hidden" name="total_penjualan" class="total_penjualan"></th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <table class="table table-bordered" id="tabel_detail_budgetevent" width="100%" hidden>
                                        <thead class="{bg_header}">
                                            <tr>
                                                <th>ID</th>
                                                <th class="text-center"><?php echo lang('Item') ?></th>
                                                <th class="text-center"><?php echo lang('price') ?></th>
                                                <th class="text-center"><?php echo lang('qty') ?></th>
                                                <th class="text-center"><?php echo lang('subtotal') ?></th>
                                                <th class="text-center"><?php echo lang('Kurs <br> mata uang') ?></th>
                                                <th class="text-center"><?php echo lang('discount') ?></th>
                                                <th class="text-center"><?php echo lang('Pajak') ?></th>
                                                <th class="text-center"><?php echo lang('Biaya <br>Pengiriman') ?></th>
                                                <th class="text-center"><?php echo lang('No Akun') ?></th>
                                                <th class="text-center"><?php echo lang('total') ?></th>
                                                <th class="text-center"><?php echo lang('action') ?></th>
                                                <th class="text-center"><?php echo lang('tipe') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody> </tbody>
                                        <tfoot class="bg-light">
                                            <tr>
                                                <th>ID</th>
                                                <th colspan="8">&nbsp;</th>
                                                <th class="text-right"><?php echo lang('total') ?></th>
                                                <th class="text-center" id="total_total_budgetevent"></th>
                                                <th><input type="hidden" name="total_budgetevent" class="total_budgetevent"></th>
                                            </tr>
                                        </tfoot>
                                    </table>



                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo lang('note') ?>:</label>
                                            <textarea class="form-control catatan" name="catatan" rows="6"></textarea>
                                        </div>                       
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label><?php echo lang('Uang Muka') ?>:</label>
                                                    <input type="text" class="form-control um" name="um" onkeyup="UbahInputRUpiah(this); SUMTOTAL_UM_Term()">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label><?php echo lang('Jumlah Term') ?>:</label>
                                                    <input type="number" class="form-control jtem" name="jtem" min="0" max="8">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group a1" hidden>
                                                    <label><?php echo lang('Term 1') ?>:</label>
                                                    <input type="text" class="form-control" name="a1" placeholder="Angsuran 1" onkeyup="UbahInputRUpiah(this); SUMTOTAL_UM_Term()">
                                                </div>
                                                <div class="form-group a2" hidden>
                                                    <label><?php echo lang('Term 2') ?>:</label>
                                                    <input type="text" class="form-control" name="a2" placeholder="Angsuran 2"  onkeyup="UbahInputRUpiah(this); SUMTOTAL_UM_Term()"> 
                                                </div>
                                                <div class="form-group a3" hidden>
                                                    <label><?php echo lang('Term 3') ?>:</label>
                                                    <input type="text" class="form-control" name="a3" placeholder="Angsuran 3" onkeyup="UbahInputRUpiah(this); SUMTOTAL_UM_Term()">
                                                </div>
                                                <div class="form-group a4" hidden>
                                                    <label><?php echo lang('Term 4') ?>:</label>
                                                    <input type="text" class="form-control" name="a4" placeholder="Angsuran 4" onkeyup="UbahInputRUpiah(this); SUMTOTAL_UM_Term()">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group a5" hidden>
                                                    <label><?php echo lang('Term 5') ?>:</label>
                                                    <input type="text" class="form-control" name="a5" placeholder="Angsuran 5" onkeyup="UbahInputRUpiah(this); SUMTOTAL_UM_Term()">
                                                </div>
                                                <div class="form-group a6" hidden>
                                                    <label><?php echo lang('Term 6') ?>:</label>
                                                    <input type="text" class="form-control" name="a6" placeholder="Angsuran 6" onkeyup="UbahInputRUpiah(this); SUMTOTAL_UM_Term()">
                                                </div>
                                                <div class="form-group a7" hidden>
                                                    <label><?php echo lang('Term 7') ?>:</label>
                                                    <input type="text" class="form-control" name="a7" placeholder="Angsuran 7" onkeyup="UbahInputRUpiah(this); SUMTOTAL_UM_Term()">
                                                </div>
                                                <div class="form-group a8" hidden>
                                                    <label><?php echo lang('Term 8') ?>:</label>
                                                    <input type="text" class="form-control" name="a8" placeholder="Angsuran 8" onkeyup="UbahInputRUpiah(this); SUMTOTAL_UM_Term()">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo lang('Total Uang Muka + Term') ?>:</label>
                                            <input type="text" class="form-control tum" name="tum" readonly>
                                        </div>
                                    </div>
                                    <input type="text" name="detail_array_item" id="detail_array_item">
                                    <input type="text" name="detail_array_budgetevent" id="detail_array_budgetevent">
                                </div>
                                <div class="text-right">
                                    <div class="btn-group">
                                        <a href="{site_url}Pemesanan_penjualan" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                                        <button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
                                    </div>
                                </div>
                                </form>
                                <!-- /form -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                    <!-- /.card -->
                    </div>
                <!--/.col (left) -->
            <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- modal tambah -->
<div id="modal_add_detail" class="modal fade">
    <div class="modal-dialog">
        <form action="javascript:save_detail(0)" id="form2">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo lang('add_new') ?></h5>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="rowindex">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="jenisItem" class="jenisItem">
                            <div class="form-group comboboxbarang">
                                <label><?php echo lang('item') ?>:</label>
                                <select class="form-control barangid" name="barangid[]" style="width:100%" multiple>
                                </select>
                            </div>
                            <div class="form-group comboboxjasa">
                                <label><?php echo lang('item') ?>:</label>
                                <select class="form-control jasaid" name="jasaid[]" style="width:100%" multiple>
                                </select>
                            </div>
                            <div class="form-group comboboxbudgetevent">
                                <label><?php echo lang('item') ?>:</label>
                                <select class="form-control budgeteventid" name="budgeteventid[]" style="width:100%" multiple>
                                </select>
                            </div>
                        </div>
                        <table class="table">
                            <tbody id='list'>

                            </tbody>
                        </table>
                        <div id="detail"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo lang('cancel') ?></button>
                        <button type="submit" class="btn btn-success"><?php echo lang('save') ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- modal edit -->
<div id="modal_edit_detail" class="modal fade">
    <div class="modal-dialog">
        <form action="javascript:save_edit_detail()" id="form3" enctype="multipart/form-data" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Detail</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="edit_rowindex">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="edit_jenisItem" class="edit_jenisItem">
                            <div class="form-group edit_comboboxbarang">
                                <label><?php echo lang('item') ?>:</label>
                                <select class="form-control edit_barangid" name="edit_barangid[]" style="width:100%">
                                </select>
                            </div>
                            <div class="form-group edit_comboboxjasa">
                                <label><?php echo lang('item') ?>:</label>
                                <select class="form-control edit_jasaid" name="edit_jasaid[]" style="width:100%">
                                </select>
                            </div>
                            <div class="form-group edit_comboboxbudgetevent">
                                <label><?php echo lang('item') ?>:</label>
                                <select class="form-control edit_budgeteventid" name="edit_budgeteventid[]" style="width:100%">
                                </select>
                            </div>
                        </div>
                        <table class="table">
                            <tbody id='edit_list'>

                            </tbody>
                        </table>
                        <div id="detail_edit"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo lang('cancel') ?></button>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="tambah_modal_pajak"></div>

<div id="tambah_modal_pilih_pajak"></div>

<div id="tambah_modal_pilih_pengiriman"></div>

<script type="text/javascript">
    var base_url                = '{site_url}Pemesanan_penjualan/';
    var total_total_item        = [];
    var total_total_budgetevent = [];
    $.fn.dataTable.Api.register( 'hasValue()' , function(value) {
        return this .data() .toArray() .toString() .toLowerCase() .split(',') .indexOf(value.toString().toLowerCase())>-1
    })



    // isi tabel (detail pemesanan)
    $(document).ready(function(){
        
        $.ajax({
            url         : base_url + 'get_detail_pemesanan',
            method      : 'post',
            async       : true,
            dataType    : 'json',
            data        : { id : $('.idpemesanan').val() },
            success: function(data) {
                var i;
                var no=0;
                var grandtotal = 0;
                for(i=0; i<data.length; i++){
                    var nama_item = ''; 
                    var tipe_item = data[i].tipe;
                    if (tipe_item == 'barang'){
                        nama_item = data[i].item;
                    }else if (tipe_item == 'inventaris'){
                        nama_item = data[i].inventaris;
                    }
                    else if (tipe_item == 'jasa'){
                        nama_item = data[i].jasa;
                    }
                    
                    grandtotal = grandtotal + parseInt(data[i].total);
                    tabel_detail_item.row.add([
                        data[i].itemid,
                        nama_item,
                        `<input type="text" class="form-control" onkeyup="sum('${i}${no}', '${no}','${tipe_item}');" name="harga[]" id="harga${i}${no}" value="${formatRupiah(data[i].harga,'Rp. ')}">`,
                        `<input type="text" class="form-control" onkeyup="sum('${i}${no}', '${no}','${tipe_item}');" name="jumlah[]" id="jumlah${i}${no}" value="${data[i].jumlah}">`,
                        `<input type="text" class="form-control" id="subtotal${i}${no}" readonly value="${formatRupiah(data[i].subtotal,'Rp. ')}"><input type="hidden" name="subtotal[]" id="subtotal_asli${i}${no}" readonly value="${formatRupiah(data[i].subtotal,'Rp. ')}">`,
                        `KURS`,
                        `<input type="text" class="form-control" onkeyup="sum_total('${i}${no}', '${no}','${tipe_item}');" name="diskon[]" id="diskon${i}${no}" value="${data[i].diskon}">`,
                        `<input type="text" name="total_pajak[]" id="total_pajak${i}${no}" onchange="sum_total('${i}${no}', '${no}','${tipe_item}');" value="${data[i].ppn}">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pajak${i}${no}" title="Tambah Pajak">
                                <i class="fas fa-balance-scale"></i>
                            </button>`,
                        `<input type="text" name="biayapengiriman[]" id="biaya_pengiriman${i}${no}" value="${data[i].biaya_pengiriman}" onchange="sum_total('${i}${no}', '${no}','${tipe_item}');">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pengiriman${i}${no}" title="Tambah Biaya Pengiriman">
                                <i class="fas fa-shipping-fast"></i>
                            </button>`,
                        `${data[i].akunno}`,
                        `<input type="text" class="form-control" name="total[]" id="total${i}${no}" readonly onchange="sum_total('${i}${no}', '${no}','${tipe_item}');" value="${formatRupiah(data[i].total,'Rp. ')}">`,
                        `<a href="javascript:EditDetail('${data[i].itemid}','${data[i].tipe}')" class="edit_detail${data[i].itemid}"><i class="fas fa-pencil-alt"></i></a>&nbsp; 
                            <a href="javascript:void(0)" class="delete_detail text-danger"><i class="fas fa-trash"></i></a>`,
                        `${data[i].tipe}`
                        ]).draw( false );
                    detail_array_item();

                    modal_pajak = `<div class="modal fade" id="modal_pajak${i}${no}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Pajak</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form_pajak${i}${no}" action="javascript:total_pajak('${i}${no}', '${no}','${data[i].tipe}')" enctype="multipart/form-data" method="POST">
                                    <div class="modal-body">
                                        <div class="mb-3 mt-3 table-responsive">
                                            <div class="mt-3 mb-3">
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pilih_pajak${i}${no}" id="pilih_pajak">
                                                    <i class="fas fa-plus"></i>Pilih Pajak
                                                </button>
                                            </div>
                                            <table class="table table-bordered" style="width:100%" id="pajak">
                                                <thead class="bg-dark">
                                                    <tr>
                                                        <th class="text-right">Nama Pajak</th>
                                                        <th class="text-right">Kode Akun</th>
                                                        <th class="text-right">Nama Akun</th>
                                                        <th class="text-right">Nominal</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="isi_tbody_pajak${i}${no}">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <input type="hidden" name="idpajak${i}${no}" id="idpajak${i}${no}">
                                        <input type="hidden" name="iditem${i}${no}" value="${data[i].itemid}">
                                        <input type="hidden" name="jenisitem${i}${no}" value="${data[i].tipe}">
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>`;
                
                    modal_pilih_pajak   = `<div class="modal fade" id="modal_pilih_pajak${i}${no}">
                                        <div class="modal-dialog ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Pilih Pajak</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <thead class="bg-dark">
                                                            <tr>
                                                                <th>&nbsp;</th>
                                                                <th>Kode Pajak</th>
                                                                <th>Nama Pajak</th>
                                                                <th>Kode Akun</th>
                                                                <th>Nama Akun</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id='list_pajak${i}${no}'>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`
                    modal_pengiriman = `
                        <div class="modal fade" id="modal_pengiriman${i}${no}">
                            <div class="modal-dialog ">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Biaya Pengiriman</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form_pengiriman${i}${no}" action="javascript:total_pengiriman('${i}${no}', '${no}','${data[i].tipe}')" enctype="multipart/form-data" method="POST">
                                    <div class="modal-body">
                                        <div class="mb-3 mt-3 table-responsive">
                                            <div class="mt-3 mb-3">
                                                <select class="form-control pilih_akun" name="noakun" required id="noakun${i}${no}" multiple data-id="${i}${no}""></select>
                                            </div>
                                            <table class="table table-bordered" style="width:100%" id="pengiriman">
                                                <thead class="bg-dark">
                                                    <tr>
                                                        <th class="text-right">Kode Akun</th>
                                                        <th class="text-right">Nama Akun</th>
                                                        <th class="text-right">Nominal</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="isi_tbody_pengiriman${i}${no}">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>`;
                    $('#tambah_modal_pajak').append(modal_pajak);
                    $('#tambah_modal_pilih_pajak').append(modal_pilih_pajak);
                    $('#tambah_modal_pilih_pengiriman').append(modal_pengiriman);
                    ajax_select({ 
                        id          : `#noakun${i}${no}`, 
                        url         : base_url+'select2_noakun_pengiriman'
                    });
                    getListPajak(String(i) + String(no));
                    total_total_item[no]    = [];
                    total_total_item[no].push((parseInt(data[i].total)));
                    total_semua(data[i].tipe);
                    no++;
                    no_baru = no;
                }
                var hasil = formatRupiah(String(grandtotal), 'Rp. ');
                $('#total_total_item').html(hasil);
                $('.total_penjualan').val(hasil);
                $('#form2').attr('action', 'javascript:save_detail('+no_baru+')');
            }
        });
        
        $.ajax({
            url         : base_url + 'get_detail_budgetevent',
            method      : 'post',
            async       : true,
            dataType    : 'json',
            data        : { id : $('.idpemesanan').val() },
            success: function(data) {
                var i;
                var no = 0;
                var grandtotal = 0;
                for(i=0; i<data.length; i++){
                    $('.nokwitansi').val(data[i].nokwitansi);

                    grandtotal = grandtotal + parseInt(data[i].total);

                    tabel_detail_budgetevent.row.add([
                        data[i].idbudgetevent,
                        data[i].budgetevent,
                        `<input type="text" class="form-control" onkeyup="sum('${i}${i}${no}', '${no}','budgetevent');" name="harga[]" id="harga${i}${i}${no}" value="${formatRupiah(data[i].harga,'Rp. ')}">`,
                        `<input type="text" class="form-control" onkeyup="sum('${i}${i}${no}', '${no}','budgetevent');" name="jumlah[]" id="jumlah${i}${i}${no}" value="${data[i].jumlah}">`,
                        `<input type="text" class="form-control" id="subtotal${i}${i}${no}" readonly value="${formatRupiah(data[i].subtotal,'Rp. ')}"><input type="hidden" name="subtotal[]" id="subtotal_asli${i}${i}${no}" readonly value="${formatRupiah(data[i].subtotal,'Rp. ')}">`,
                        `KURS`,
                        `<input type="text" class="form-control" onkeyup="sum_total('${i}${i}${no}', '${no}','budgetevent');" name="diskon[]" id="diskon${i}${i}${no}" value="${data[i].diskon}">`,
                        `<input type="text" name="total_pajak[]" id="total_pajak${i}${i}${no}" onchange="sum_total('${i}${i}${no}', '${no}','budgetevent');" value="${data[i].ppn}">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pajak${i}${i}${no}" title="Tambah Pajak">
                                <i class="fas fa-balance-scale"></i>
                            </button>`,
                        `<input type="text" name="biayapengiriman[]" id="biaya_pengiriman${i}${i}${no}" value="${data[i].biaya_pengiriman}" onchange="sum_total('${i}${i}${no}', '${no}','budgetevent');">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pengiriman${i}${i}${no}" title="Tambah Biaya Pengiriman">
                                <i class="fas fa-shipping-fast"></i>
                            </button>`,
                        `${data[i].akunno}`,
                        `<input type="text" class="form-control" name="total[]" id="total${i}${i}${no}" readonly onchange="sum_total('${i}${i}${no}', '${no}','budgetevent');" value="${formatRupiah(data[i].total,'Rp. ')}">`,
                        `<a href="javascript:EditDetail('${data[i].idbudgetevent}','budgetevent')" class="edit_detail${data[i].idbudgetevent}"><i class="fas fa-pencil-alt"></i></a>&nbsp; 
                            <a href="javascript:void(0)" class="delete_detail text-danger"><i class="fas fa-trash"></i></a>`,
                        `budgetevent`
                    ]).draw( false );

                    detail_array_budgetevent();

                    modal_pajak = `<div class="modal fade" id="modal_pajak${i}${i}${no}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Pajak</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form_pajak${i}${i}${no}" action="javascript:total_pajak('${i}${i}${no}', '${no}','budgetevent')" enctype="multipart/form-data" method="POST">
                                    <div class="modal-body">
                                        <div class="mb-3 mt-3 table-responsive">
                                            <div class="mt-3 mb-3">
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pilih_pajak${i}${i}${no}" id="pilih_pajak">
                                                    <i class="fas fa-plus"></i>Pilih Pajak
                                                </button>
                                            </div>
                                            <table class="table table-bordered" style="width:100%" id="pajak">
                                                <thead class="bg-dark">
                                                    <tr>
                                                        <th class="text-right">Nama Pajak</th>
                                                        <th class="text-right">Kode Akun</th>
                                                        <th class="text-right">Nama Akun</th>
                                                        <th class="text-right">Nominal</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="isi_tbody_pajak${i}${i}${no}">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <input type="hidden" name="idpajak${i}${i}${no}" id="idpajak${i}${i}${no}">
                                        <input type="hidden" name="iditem${i}${i}${no}" value="${data[i].idbudgetevent}">
                                        <input type="hidden" name="jenisitem${i}${i}${no}" value="budgetevent">
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>`;
                
                    modal_pilih_pajak   = `<div class="modal fade" id="modal_pilih_pajak${i}${i}${no}">
                                        <div class="modal-dialog ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Pilih Pajak</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <thead class="bg-dark">
                                                            <tr>
                                                                <th>&nbsp;</th>
                                                                <th>Kode Pajak</th>
                                                                <th>Nama Pajak</th>
                                                                <th>Kode Akun</th>
                                                                <th>Nama Akun</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id='list_pajak${i}${i}${no}'>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`
                    modal_pengiriman = `
                        <div class="modal fade" id="modal_pengiriman${i}${i}${no}">
                            <div class="modal-dialog ">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Biaya Pengiriman</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form_pengiriman${i}${i}${no}" action="javascript:total_pengiriman('${i}${i}${no}', '${no}','budgetevent')" enctype="multipart/form-data" method="POST">
                                    <div class="modal-body">
                                        <div class="mb-3 mt-3 table-responsive">
                                            <div class="mt-3 mb-3">
                                                <select class="form-control pilih_akun" name="noakun" required id="noakun${i}${i}${no}" multiple data-id="${i}${i}${no}""></select>
                                            </div>
                                            <table class="table table-bordered" style="width:100%" id="pengiriman">
                                                <thead class="bg-dark">
                                                    <tr>
                                                        <th class="text-right">Kode Akun</th>
                                                        <th class="text-right">Nama Akun</th>
                                                        <th class="text-right">Nominal</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="isi_tbody_pengiriman${i}${i}${no}">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>`;
                    $('#tambah_modal_pajak').append(modal_pajak);
                    $('#tambah_modal_pilih_pajak').append(modal_pilih_pajak);
                    $('#tambah_modal_pilih_pengiriman').append(modal_pengiriman);
                    ajax_select({ 
                        id          : `#noakun${i}${i}${no}`, 
                        url         : base_url+'select2_noakun_pengiriman'
                    });
                    getListPajak(String(i)+String(i) + String(no));

                    total_total_budgetevent[no]    = [];
                    total_total_budgetevent[no].push((parseInt(data[i].total)));
                    total_semua('budgetevent');
                    no++;
                    no_baru = no;
                }
                var hasil = formatRupiah(String(grandtotal), 'Rp. ');
                $('#total_total_budgetevent').html(hasil);
                $('.total_budgetevent').val(hasil);
                $('#form2').attr('action', 'javascript:save_detail('+no_baru+')');
            }
        });


    })

    //pajak
    function addPajak(elem, no, id) {
        const id_pajak    = $(elem).attr('id_pajak');
        const kode_pajak    = $(elem).attr('kode_pajak');
        const nama_pajak    = $(elem).attr('nama_pajak');
        const kode_akun     = $(elem).attr('kode_akun');
        const nama_akun     = $(elem).attr('nama_akun');
        const stat          = $(elem).is(":checked");
        const table         = $('#isi_tbody_pajak'+id);
        // var no1              = 0;        
        if (stat) {
            html = `<tr no="${no}">
                        <td>${kode_pajak}</td>
                        <td>${kode_akun}</td>
                        <td>${nama_akun}</td>
                        <td><input type="text" class="form-control pajak" id="nominal_pajak${no}${id}" onkeyup="nominalPajak('${no}${id}')" name="pajak"></td>
                    </tr>`;
            table.append(html);
        } else {
            // alert('a');
            $(`tr[no="${no}"]`).remove();
        }
    }

    function total_pajak(id, no, jenis) {
        var formData    = new FormData($('#form_pajak'+id)[0]);
        var pajak       = formData.getAll('pajak');
        var pajak_baru  = 0;
        pajak.forEach(p => {
            pajak_baru  += parseInt(p.replace(/[Rp.]/g, ''));
        });
        $('#total_pajak'+id).val(pajak_baru);
        $('#modal_pajak'+id).modal('hide');
        sum_total(id, no, jenis);
    }

     function nominalPajak(no) {
        var nilai   = $('#nominal_pajak' + no).val();
        var nilai1  = nilai.replace(/[^,\d]/g, '').toString();
        $('#nominal_pajak' + no).val(formatRupiah(String(nilai), 'Rp. '));
    }

    function getListPajak(id) {
        var table = $('#list_pajak'+id);
        $('#list_pajak'+id).empty();
        $.ajax({
            type    : "get",
            url     : base_url + 'get_PilihanPajak',
            success : function(response) {
                for (let i = 0; i < response.length; i++) {
                    const element = response[i];
                    if (i < 0) {
                        const html = `
                            <tr class="bg-light">
                                <td><input type="checkbox" name="" id=""  disabled></td>
                                <td>${element.kode_pajak}</td>
                                <td>${element.nama_pajak}</td>
                                <td>${element.akunno}</td>
                                <td>${element.namaakun}</td>
                            </tr>
                        `;
                        table.append(html);
                    } else {
                        const html  = `
                            <tr>
                                <td><input type="checkbox" name="" id_pajak="${element.id_pajak}" kode_pajak="${element.kode_pajak}" nama_pajak="${element.nama_pajak}" kode_akun="${element.akunno}" nama_akun="${element.namaakun}"id="" onchange="addPajak(this, `+i+`, '`+id+`')"></td>
                                <td>${element.kode_pajak}</td>
                                <td>${element.nama_pajak}</td>
                                <td>${element.akunno}</td>
                                <td>${element.namaakun}</td>
                            </tr>
                        `;
                        table.append(html);
                    }
                }
            }
        });
    }

    //pengiriman
    function total_pengiriman(id, no,jenis) {
        var formData            = new FormData($('#form_pengiriman'+id)[0]);
        var pengiriman          = formData.getAll('pengiriman');
        var biaya_pengiriman    = 0;
        pengiriman.forEach(p => {
            biaya_pengiriman  += parseInt(p.replace(/[Rp.]/g, ''));
        });
        $('#biaya_pengiriman'+id).val(biaya_pengiriman);
        $('#modal_pengiriman'+id).modal('hide');
        sum_total(id, no, jenis);
    }

    $(document).on('select2:select','.pilih_akun',function(e){
        id  = $(this).attr('data-id');
        $.ajax({
            url         : base_url + 'select2_noakun',
            method      : 'post',
            datatype    : 'json',
            data        : {
                id  : e.params.data.id
            },
            success: function(data) {
                var isi_tbody_pengiriman    = `
                    <tr>
                        <td>${data.akunno}</td>
                        <td>${data.namaakun}</td>
                        <td><input type="text" class="form-control pajak" id="nominal_pajak${id}" onkeyup="nominalPajak('${id}')" name="pengiriman"></td>
                    </tr>`;
                $('#isi_tbody_pengiriman'+id).append(isi_tbody_pengiriman);
            }
        })
    })


    //datatable item
    var tabel_detail_item = $('#tabel_detail_item').DataTable({
        sort: false,
        info: false,
        searching: false,
        paging: false,
        columnDefs: [
            {targets: [0,12], visible: false},
            {targets: [5,7,8,9,11], className: 'text-center'}
        ],
        
    })

    //datatable budget event
    var tabel_detail_budgetevent = $('#tabel_detail_budgetevent').DataTable({
        sort: false,
        info: false,
        searching: false,
        paging: false,
        columnDefs: [
            {targets: [0,12], visible: false},
            {targets: [5,7,8,9,11], className: 'text-center'}
        ],
        
    })

    $(document).ready(function(){
        //isi combobox kontak, gudang, perusahaan, departemen, pejabat
        ajax_select({id: '#perusahaan', url: base_url + 'select2_mperusahaan', selected: { id: '{idperusahaan}' } });
        ajax_select({id: '#departemen', url: base_url + 'select2_mdepartemen/{departemen}', selected: { id: '{departemen}' } });
        ajax_select({id: '#pejabat', url: base_url + 'select2_mdepartemen_pejabat/{pejabat}', selected: { id: '{pejabat}' } });
        //menyembunyikan button tambah
        $('.btn_add_detail_barang').attr("hidden", true);
        $('.btn_add_detail_jasa').attr("hidden", true);
        $('.btn_add_detail_budgetevent').attr("hidden", true);

        //hiden combobobox
        $('.comboboxbarang').attr("hidden", true);
        $('.comboboxjasa').attr("hidden", true);
        $('.comboboxbudgetevent').attr("hidden", true);
        $('.edit_comboboxbarang').attr("hidden", true);
        $('.edit_comboboxjasa').attr("hidden", true);
        $('.edit_comboboxbudgetevent').attr("hidden", true);
        $('#nokwitansi_rekening').attr("hidden", true);

        //select jenis penjualan
        var jenis_jual = '{jenis_pembelian}'; 
        var jenis_barang = '{jenis_barang}'; 
        if (jenis_jual == 'barang'){
            $('.jenis_penjualan').prop("selectedIndex", 0);
            $('.btn_add_detail_barang').attr("hidden", false);
            $('.btn_add_detail_jasa').attr("hidden", true);
            $('.btn_add_detail_budgetevent').attr("hidden", true);
            $('#rekanan').html(`
                <label><?php echo lang('rekanan') ?>:</label>
                <select class="form-control kontakid" name="kontakid"></select>
            `);
            if (jenis_barang == 'barang_dagangan'){
                $('#gudang').html(`
                    <label><?php echo lang('gudang') ?>:</label>
                    <select class="form-control gudangid" name="gudangid"></select>
                `);
            }else{
                $('#gudang').empty();
            }
            ajax_select({ id: '.kontakid', url: base_url + 'select2_kontak', selected: { id: '{kontakid}' } });
            ajax_select({ id: '.gudangid', url: base_url + 'select2_gudang', selected: { id: '{gudangid}' } });
        }else if(jenis_jual == 'jasa'){
            $('.jenis_penjualan').prop("selectedIndex", 1);
            $('.btn_add_detail_barang').attr("hidden", true);
            $('.btn_add_detail_jasa').attr("hidden", false);
            $('.btn_add_detail_budgetevent').attr("hidden", false);
            $('.jenis_barang').attr("disabled", true);
            $('#gudang').empty();
            $.ajax({
                url         : base_url + 'get_budget_event',
                method      : 'post',
                async       : true,
                dataType    : 'json',
                data        : { id : $('.idpemesanan').val() },
                success: function(data) {
                    var i;
                    for(i=0; i<data.length; i++){ 
                       $('.nokwitansi').val(data[i].nokwitansi); 
                        ajax_select({
                            id: '#rekening',
                            url: base_url + 'select2_mrekening_perusahaan/' + '{idperusahaan}',
                            selected: { id: data[i].rekening }
                        });   
                    }
                }
            })
            ajax_select({ id: '.kontakid', url: base_url + 'select2_kontak', selected: { id: '{kontakid}' } });
        }else{
             $.ajax({
                url         : base_url + 'get_budget_event',
                method      : 'post',
                async       : true,
                dataType    : 'json',
                data        : { id : $('.idpemesanan').val() },
                success: function(data) {
                    var i;
                    for(i=0; i<data.length; i++){ 
                       $('.nokwitansi').val(data[i].nokwitansi); 
                        ajax_select({
                            id: '#rekening',
                            url: base_url + 'select2_mrekening_perusahaan/' + '{idperusahaan}',
                            selected: { id: data[i].rekening }
                        });                     
                    }
                }
            })
            $('.jenis_penjualan').prop("selectedIndex", 2);
            $('.btn_add_detail_barang').attr("hidden", false);
            $('.btn_add_detail_jasa').attr("hidden", false);
            $('.btn_add_detail_budgetevent').attr("hidden", false);
            $('#rekanan').html(`
                <label><?php echo lang('rekanan') ?>:</label>
                <select class="form-control kontakid" name="kontakid"></select>
            `);
            $('#gudang').html(`
                <label><?php echo lang('gudang') ?>:</label>
                <select class="form-control gudangid" name="gudangid"></select>
            `);
            ajax_select({ id: '.kontakid', url: base_url + 'select2_kontak', selected: { id: '{kontakid}' } });
            ajax_select({ id: '.gudangid', url: base_url + 'select2_gudang', selected: { id: '{gudangid}' } });
        }
        //select jenis barang
        var jenis_brg = '{jenis_barang}'; 
        if (jenis_brg == 'barang'){
            $('.jenis_barang').prop("selectedIndex", 0);
        }else if(jenis_brg == 'inventaris'){
            $('.jenis_barang').prop("selectedIndex", 1);
        }else{
            $('.jenis_barang').prop("selectedIndex", 2);
        }
        //select cara pembayaran
        var cr_pembayaran = '{cara_pembayaran}'; 
        if (cr_pembayaran == 'cash'){
            $('.cara_pembayaran').prop("selectedIndex", 0);
        }else {
            $('.cara_pembayaran').prop("selectedIndex", 1);
        }

        $('#tabel_detail_item').attr("hidden", false);
        $('#tabel_detail_budgetevent').attr("hidden", true);
        getListPajak();
    })

    //mengisi combobox depatemen
    $('#perusahaan').change(function(e) {
        $("#departemen").val($("#departemen").data("default-value"));
        $("#pejabat").val($("#pejabat").data("default-value"));
        $("#rekening").empty();
        var perusahaanId = $('#perusahaan').children('option:selected').val();
        ajax_select({
            id: '#departemen',
            url: base_url + 'select2_mdepartemen/' + perusahaanId,
        });
        ajax_select({
            id: '#rekening',
            url: base_url + 'select2_mrekening_perusahaan/' + perusahaanId,
        });
        
    })
    //mengisi combobox pejabat
    $('#departemen').change(function(e) {
        $("#pejabat").val($("#pejabat").data("default-value"));
        var deptId = $('#departemen').children('option:selected').val()
        ajax_select({
            id: '#pejabat',
            url: base_url + 'select2_mdepartemen_pejabat/' + deptId,
        });  
    })

    //perubahan saat jenis pembelian diganti
    $(document).on('change','.jenis_penjualan',function(){
        $('#nokwitansi_rekening').attr("hidden", true);
        $('.nokwitansi').val('');
        if ($(this).val() == 'jasa') {
            $('.jenis_barang').attr("disabled", true);
            $('#gudang').empty();
            $('.btn_add_detail_barang').attr("hidden", true);
            $('.btn_add_detail_jasa').attr("hidden", false);
            $('.btn_add_detail_budgetevent').attr("hidden", false);
        } else if ($(this).val() == 'barang'){ 
            $("#rekening").val($("#rekening").data("default-value"));
            $('.jenis_barang').attr("disabled", false);
            $('.btn_add_budget_event').attr("hidden", true);
            $('.btn_add_detail_barang').attr("hidden", false);
            $('.btn_add_detail_jasa').attr("hidden", true);
            $('.btn_add_detail_budgetevent').attr("hidden", true);
            $('.jenis_barang').prop("selectedIndex", 0);
            document.getElementById("jenis_barang").options[0].disabled = false;
            document.getElementById("jenis_barang").options[1].disabled = false;
            document.getElementById("jenis_barang").options[2].disabled = true;
            $('#gudang').html(`
                <label><?php echo lang('gudang') ?>:</label>
                <select class="form-control gudangid" name="gudangid"></select>
            `);
            ajax_select({ id: '.kontakid', url: base_url + 'select2_kontak', selected: { id: null } });
            ajax_select({ id: '.gudangid', url: base_url + 'select2_gudang', selected: { id: null } });
        }else{  
            $('.jenis_barang').attr("disabled", false);
            $('.btn_add_detail_barang').attr("hidden", false);
                $('.btn_add_detail_jasa').attr("hidden", false);
                $('.btn_add_detail_budgetevent').attr("hidden", false);
            $('#gudang').html(`
                <label><?php echo lang('gudang') ?>:</label>
                <select class="form-control gudangid" name="gudangid"></select>
            `);
            ajax_select({ id: '.kontakid', url: base_url + 'select2_kontak', selected: { id: null } });
            ajax_select({ id: '.gudangid', url: base_url + 'select2_gudang', selected: { id: null } });
            $('.jenis_barang').prop("selectedIndex", 2);
            document.getElementById("jenis_barang").options[0].disabled = true;
            document.getElementById("jenis_barang").options[1].disabled = true;
            document.getElementById("jenis_barang").options[2].disabled = false;
            var jenis_penjualan = $('.jenis_penjualan').val();
            
        }
        tabel_detail_item.clear().draw();
        tabel_detail_budgetevent.clear().draw();
        $('#total_total_item').html('');
        $('#total_total_budgetevent').html('');
        $('#detail_array_item').val('');
        $('#detail_array_budgetevent').val('');
        total_total_item=[];
        total_total_budgetevent=[];
    })

     //perubahan saat jenis barang diganti
    $(document).on('change','.jenis_barang',function(){
        var jenis_barang = $(this).val();
            if (jenis_barang == 'barang_dagangan'){
                $('#gudang').html(`
                    <label><?php echo lang('gudang') ?>:</label>
                    <select class="form-control gudangid" name="gudangid"></select>
                `);
                ajax_select({ id: '.gudangid', url: base_url + 'select2_gudang', selected: { id: null } });
            }else if (jenis_barang == 'inventaris'){
                $('#gudang').empty();
            }
        $('#total_total_item').html('');
        $('#total_total_budgetevent').html('');
        $('#total_penjualan').val('');
        tabel_detail_item.clear().draw();
        tabel_detail_budgetevent.clear().draw();
        total_total_item=[];
        total_total_budgetevent=[];
    })

    //menampilkan modal barang
    $(document).on('click','.btn_add_detail_barang',function(){
        $('#modal_add_detail').modal('show');
        $('#nokwitansi_rekening').attr("hidden", true);
        $('.nokwitansi').attr("hidden", true);
        $('.barangid').empty();
        $('.comboboxbarang').attr("hidden", false);
        $('.comboboxjasa').attr("hidden", true);
        $('.comboboxbudgetevent').attr("hidden", true);
        $('#tabel_detail_item').attr("hidden", false);
        $('#tabel_detail_budgetevent').attr("hidden", true);
        var jenis_barang = $('.jenis_barang').val();
        var idgudang = $('.gudangid').val();
        switch (jenis_barang){
            case 'barang_dagangan' :
                url = base_url + 'select2_item'+ '/'+ idgudang +'/'+idgudang;
                $('.jenisItem').val('barang');
                break;
            case 'inventaris' :
                url = base_url + 'select2_item_inventaris';
                $('.jenisItem').val('inventaris');
                break;
            case 'barang_dan_jasa':
                url = base_url + 'select2_item'+ '/'+ idgudang +'/'+idgudang;
                $('.jenisItem').val('barang');
                break;
            default:
                break;
        }
        $.ajax({
            url         : url,
            method      : 'post',
            datatype    : 'json',
            success: function(data) {
                isi = "";
                detail = "";
                for ( index = 0; index < data.length; index++) {
                    detail += `<input type="hidden" class="form-control" id="noakun`+data[index].id+`" name="noakun[]" required value="${data[index].koderekening}">`;
                    isi += `<option value="${data[index].id}">${data[index].text}</option>`
                }
                $('#detail').html(detail);
                $('.barangid').append(isi);
            }
        })
        $('.barangid').select2();
        
    })

    //menampilkan modal jasa
    $(document).on('click','.btn_add_detail_jasa',function(){
        $('#modal_add_detail').modal('show');
        $('#nokwitansi_rekening').attr("hidden", true);
        $('.nokwitansi').attr("hidden", true);
        $('.jasaid').empty();
        $('.comboboxbarang').attr("hidden", true);
        $('.comboboxjasa').attr("hidden", false);
        $('.comboboxbudgetevent').attr("hidden", true);
        $('.jenisItem').val('jasa');
        $('#tabel_detail_item').attr("hidden", false);
        $('#tabel_detail_budgetevent').attr("hidden", true);
        $.ajax({
            url         : base_url + 'select2_item_jasa',
            method      : 'post',
            datatype    : 'json',
            success: function(data) {
                isi = "";
                detail="";
                for ( index = 0; index < data.length; index++) {
                     detail += `<input type="hidden" class="form-control" id="noakun`+data[index].id+`" name="noakun[]" required value="${data[index].koderekening}">`;
                    isi += `<option value="${data[index].id}">${data[index].text}</option>`
                }
                $('#detail').html(detail);
                $('.jasaid').append(isi);
            }
        })
        $('.jasaid').select2();
    })

    //menampilkan modal budgetevent
    $(document).on('click','.btn_add_detail_budgetevent',function(){
        $('#nokwitansi_rekening').attr("hidden", false);
        $('.nokwitansi').attr("hidden", false);
        $("#rekening").val($("#rekening").data("default-value"));
        $('#modal_add_detail').modal('show');
        $('.budgeteventid').empty();
        $('.comboboxbarang').attr("hidden", true);
        $('.comboboxjasa').attr("hidden", true);
        $('.comboboxbudgetevent').attr("hidden", false);
        $('.jenisItem').val('budgetevent');
        $('#tabel_detail_item').attr("hidden", true);
        $('#tabel_detail_budgetevent').attr("hidden", false);
        $.ajax({
            url         : base_url + 'select2_budgetevent',
            method      : 'post',
            datatype    : 'json',
            success: function(data) {
                isi = "";
                detail="";
                for ( index = 0; index < data.length; index++) {
                    detail += `<input type="hidden" class="form-control" id="noakun`+data[index].id+`" name="noakun[]" required value="${data[index].koderekening}">`;
                    isi += `<option value="${data[index].id}">${data[index].text}</option>`
                }
                $('#detail').html(detail);
                $('.budgeteventid').append(isi);
            }
        })
        $('.budgeteventid').select2();
    })



     //save detail barang
    function save_detail(no) {
        var form            = $('#form2')[0];
        var formData        = new FormData(form);
        var IsiItem            = '';
        var jenisItem       = $('.jenisItem').val();
        var noakun = 0;
        if ((jenisItem == 'barang') || (jenisItem == 'inventaris')){
            IsiItem = $('.barangid :selected');   
        } else if (jenisItem == 'jasa'){
            IsiItem = $('.jasaid :selected');
        }else{
            IsiItem = $('.budgeteventid :selected');
        }

        var no_baru         = no + 1;
        jumlah_rows_item = tabel_detail_item.rows().count();
        jumlah_rows_budget_event = tabel_detail_budgetevent.rows().count();
        for ( index = 0; index < IsiItem.length; index++) {
            var id    = IsiItem[index].value;
            var item    = IsiItem[index].text;
            
            noakun   = $('#noakun'+IsiItem[index].value).val();
            $('#noakun'+IsiItem[index].value).remove();
         
            if (jenisItem != 'budgetevent')
            {
                if(tabel_detail_item.hasValue(id)) {
                    swal("Gagal!", "Item sudah ada", "error");
                    return;
                }
                
                tabel_detail_item.row.add([
                    IsiItem[index].value,
                    item,
                    `<input type="text" class="form-control" onkeyup="sum('${index}${no}', '${no}','${jenisItem}');" name="harga[]" id="harga${index}${no}">`,
                    `<input type="text" class="form-control" onkeyup="sum('${index}${no}', '${no}','${jenisItem}');" name="jumlah[]" id="jumlah${index}${no}">`,
                    `<input type="text" class="form-control" id="subtotal${index}${no}" readonly><input type="hidden" name="subtotal[]" id="subtotal_asli${index}${no}" readonly>`,
                    `KURS`,
                    `<input type="text" class="form-control" onkeyup="sum_total('${index}${no}', '${no}','${jenisItem}');" name="diskon[]" id="diskon${index}${no}">`,
                    `<input type="text" name="total_pajak[]" id="total_pajak${index}${no}" onchange="sum_total('${index}${no}', '${no}','${jenisItem}');">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pajak${index}${no}" title="Tambah Pajak">
                        <i class="fas fa-balance-scale"></i>
                    </button>`,
                    `<input type="text" name="biayapengiriman[]" id="biaya_pengiriman${index}${no}" onchange="sum_total('${index}${no}', '${no}','${jenisItem}');">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pengiriman${index}${no}" title="Tambah Biaya Pengiriman">
                        <i class="fas fa-shipping-fast"></i>
                    </button>`,
                    `${noakun}`,
                    `<input type="text" class="form-control" name="total[]" id="total${index}${no}" readonly onchange="sum_total('${index}${no}', '${no}','${jenisItem}');">`,
                    `<a href="javascript:EditDetail('${IsiItem[index].value}','${jenisItem}')" class="edit_detail${IsiItem[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp; 
                        <a href="javascript:void(0)" class="delete_detail text-danger"><i class="fas fa-trash"></i></a>`,
                    `${jenisItem}`
                ]).draw( false );
                detail_array_item();
                 modal_pajak = `<div class="modal fade" id="modal_pajak${index}${no}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Pajak</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form_pajak${index}${no}" action="javascript:total_pajak('${index}${no}', '${no}','${jenisItem}')" enctype="multipart/form-data" method="POST">
                                    <div class="modal-body">
                                        <div class="mb-3 mt-3 table-responsive">
                                            <div class="mt-3 mb-3">
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pilih_pajak${index}${no}" id="pilih_pajak">
                                                    <i class="fas fa-plus"></i>Pilih Pajak
                                                </button>
                                            </div>
                                            <table class="table table-bordered" style="width:100%" id="pajak">
                                                <thead class="bg-dark">
                                                    <tr>
                                                        <th class="text-right">Nama Pajak</th>
                                                        <th class="text-right">Kode Akun</th>
                                                        <th class="text-right">Nama Akun</th>
                                                        <th class="text-right">Nominal</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="isi_tbody_pajak${index}${no}">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <input type="hidden" name="idpajak${index}${no}" id="idpajak${index}${no}">
                                        <input type="hidden" name="iditem${index}${no}" value="${id}">
                                        <input type="hidden" name="jenisitem${index}${no}" value="${jenisItem}">
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>`;
                
                    modal_pilih_pajak   = `<div class="modal fade" id="modal_pilih_pajak${index}${no}">
                                        <div class="modal-dialog ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Pilih Pajak</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <thead class="bg-dark">
                                                            <tr>
                                                                <th>&nbsp;</th>
                                                                <th>Kode Pajak</th>
                                                                <th>Nama Pajak</th>
                                                                <th>Kode Akun</th>
                                                                <th>Nama Akun</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id='list_pajak${index}${no}'>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`
                    modal_pengiriman = `
                        <div class="modal fade" id="modal_pengiriman${index}${no}">
                            <div class="modal-dialog ">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Biaya Pengiriman</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form_pengiriman${index}${no}" action="javascript:total_pengiriman('${index}${no}', '${no}','${jenisItem}')" enctype="multipart/form-data" method="POST">
                                    <div class="modal-body">
                                        <div class="mb-3 mt-3 table-responsive">
                                            <div class="mt-3 mb-3">
                                                <select class="form-control pilih_akun" name="noakun" required id="noakun${index}${no}" multiple data-id="${index}${no}""></select>
                                            </div>
                                            <table class="table table-bordered" style="width:100%" id="pengiriman">
                                                <thead class="bg-dark">
                                                    <tr>
                                                        <th class="text-right">Kode Akun</th>
                                                        <th class="text-right">Nama Akun</th>
                                                        <th class="text-right">Nominal</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="isi_tbody_pengiriman${index}${no}">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>`;
                    $('#tambah_modal_pajak').append(modal_pajak);
                    $('#tambah_modal_pilih_pajak').append(modal_pilih_pajak);
                    $('#tambah_modal_pilih_pengiriman').append(modal_pengiriman);
                    ajax_select({ 
                        id          : `#noakun${index}${no}`, 
                        url         : base_url+'select2_noakun_pengiriman'
                    });
                    getListPajak(String(index) + String(no));
                 
            }else{
                if(tabel_detail_budgetevent.hasValue(id)) {
                    swal("Gagal!", "Item sudah ada", "error");
                    return;
                }
               
                tabel_detail_budgetevent.row.add([
                    IsiItem[index].value,
                    item,
                    `<input type="text" class="form-control" onkeyup="sum('${index}${index}${no}', '${no}','${jenisItem}');" name="harga1[]" id="harga${index}${index}${no}">`,
                    `<input type="text" class="form-control" onkeyup="sum('${index}${index}${no}', '${no}','${jenisItem}');" name="jumlah1[]" id="jumlah${index}${index}${no}">`,
                    `<input type="text" class="form-control" id="subtotal${index}${index}${no}" readonly><input type="hidden" name="subtotal1[]" id="subtotal_asli${index}${index}${no}" readonly>`,
                    `KURS`,
                    `<input type="text" class="form-control" onkeyup="sum_total('${index}${index}${no}', '${no}','${jenisItem}');" name="diskon1[]" id="diskon${index}${index}${no}">`,
                    `<input type="text" name="total_pajak1[]" id="total_pajak${index}${index}${no}" onchange="sum_total('${index}${index}${no}', '${no}','${jenisItem}');">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pajak${index}${index}${no}" title="Tambah Pajak">
                        <i class="fas fa-balance-scale"></i>
                    </button>`,
                    `<input type="text" name="biayapengiriman1[]" id="biaya_pengiriman${index}${index}${no}" onchange="sum_total('${index}${no}', '${no}','${jenisItem}');">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pengiriman${index}${index}${no}" title="Tambah Biaya Pengiriman">
                        <i class="fas fa-shipping-fast"></i>
                    </button>`,
                    `${noakun}`,
                    `<input type="text" class="form-control" name="total1[]" id="total${index}${index}${no}" readonly onchange="sum_total('${index}${index}${no}', '${no}','${jenisItem}');">`,
                    `<a href="javascript:EditDetail('${IsiItem[index].value}','${jenisItem}')" class="edit_detail${IsiItem[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp; 
                        <a href="javascript:void(0)" class="delete_detail text-danger"><i class="fas fa-trash"></i></a>`,
                    `${jenisItem}`
                ]).draw( false );
                detail_array_budgetevent();

                modal_pajak = `<div class="modal fade" id="modal_pajak${index}${index}${no}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Pajak</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form_pajak${index}${index}${no}" action="javascript:total_pajak('${index}${index}${no}', '${no}','budgetevent')" enctype="multipart/form-data" method="POST">
                                    <div class="modal-body">
                                        <div class="mb-3 mt-3 table-responsive">
                                            <div class="mt-3 mb-3">
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pilih_pajak${index}${index}${no}" id="pilih_pajak">
                                                    <i class="fas fa-plus"></i>Pilih Pajak
                                                </button>
                                            </div>
                                            <table class="table table-bordered" style="width:100%" id="pajak">
                                                <thead class="bg-dark">
                                                    <tr>
                                                        <th class="text-right">Nama Pajak</th>
                                                        <th class="text-right">Kode Akun</th>
                                                        <th class="text-right">Nama Akun</th>
                                                        <th class="text-right">Nominal</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="isi_tbody_pajak${index}${index}${no}">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <input type="hidden" name="idpajak${index}${index}${no}" id="idpajak${index}${index}${no}">
                                        <input type="hidden" name="iditem${index}${index}${no}" value="${id}">
                                        <input type="hidden" name="jenisitem${index}${index}${no}" value="${jenisItem}">
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>`;
                
                    modal_pilih_pajak   = `<div class="modal fade" id="modal_pilih_pajak${index}${index}${no}">
                                        <div class="modal-dialog ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Pilih Pajak</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <thead class="bg-dark">
                                                            <tr>
                                                                <th>&nbsp;</th>
                                                                <th>Kode Pajak</th>
                                                                <th>Nama Pajak</th>
                                                                <th>Kode Akun</th>
                                                                <th>Nama Akun</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id='list_pajak${index}${index}${no}'>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`
                    modal_pengiriman = `
                        <div class="modal fade" id="modal_pengiriman${index}${index}${no}">
                            <div class="modal-dialog ">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Biaya Pengiriman</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form_pengiriman${index}${index}${no}" action="javascript:total_pengiriman('${index}${index}${no}', '${no}','budgetevent')" enctype="multipart/form-data" method="POST">
                                    <div class="modal-body">
                                        <div class="mb-3 mt-3 table-responsive">
                                            <div class="mt-3 mb-3">
                                                <select class="form-control pilih_akun" name="noakun" required id="noakun${index}${index}${no}" multiple data-id="${index}${index}${no}""></select>
                                            </div>
                                            <table class="table table-bordered" style="width:100%" id="pengiriman">
                                                <thead class="bg-dark">
                                                    <tr>
                                                        <th class="text-right">Kode Akun</th>
                                                        <th class="text-right">Nama Akun</th>
                                                        <th class="text-right">Nominal</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="isi_tbody_pengiriman${index}${index}${no}">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>`;
                    $('#tambah_modal_pajak').append(modal_pajak);
                    $('#tambah_modal_pilih_pajak').append(modal_pilih_pajak);
                    $('#tambah_modal_pilih_pengiriman').append(modal_pengiriman);
                    ajax_select({ 
                        id          : `#noakun${index}${index}${no}`, 
                        url         : base_url+'select2_noakun_pengiriman'
                    });
                    getListPajak(String(index)+String(index) + String(no));
                }
            no++;
            no_baru = no;
        }
        $('#modal_add_detail').modal('hide');
        $('#form2').attr('action', 'javascript:save_detail('+no_baru+')');
    }

    //detail array keseluruhan
    function detail_array_item() {
        var arr = tabel_detail_item.data().toArray();
        $('#detail_array_item').val( JSON.stringify(arr));
    }

    function detail_array_budgetevent() {
        var arr1 = tabel_detail_budgetevent.data().toArray();
        $('#detail_array_budgetevent').val( JSON.stringify(arr1));
    }

    //edit data barang
    function EditDetail(id,jenisItem){
        if ((jenisItem == 'barang') || (jenisItem == 'inventaris')){
            var rowindex    = tabel_detail_item.row($('.edit_detail'+id).parents('tr')).index();
            $('input[name=edit_rowindex]').val(rowindex);
            $('.edit_barangid').empty();
            $('.edit_comboboxbarang').attr("hidden", false);
            $('.edit_comboboxjasa').attr("hidden", true);
            $('.edit_comboboxbudgetevent').attr("hidden", true); 
            var idgudang = $('.gudangid').val();
            var jenis_barang = $('.jenis_barang').val();
            if (jenis_barang == 'barang_dagangan'){
                url = base_url + 'select2_item'+'/'+id+'/'+idgudang;
                $('.edit_jenisItem').val('barang');
            }else if (jenis_barang == 'inventaris'){
                url = base_url + 'select2_item_inventaris';
                $('.edit_jenisItem').val('inventaris');
            }else{
                url = base_url + 'select2_item'+'/'+id+'/'+idgudang;
                $('.edit_jenisItem').val('barang');
            }
            $.ajax({
                url         : url,
                method      : 'post',
                datatype    : 'json',
                success: function(data) {
                    isi = "";
                    detail="";
                    for ( index = 0; index < data.length; index++) {
                        if (data[index].id != id){
                            isi += `<option value="${data[index].id}">${data[index].text}</option>`
                        }else{
                            isi += `<option value="${data[index].id}" selected>${data[index].text}</option>`
                        }
                        detail += `<input type="hidden" class="form-control" id="noakun`+data[index].id+`" name="noakun[]" required value="${data[index].koderekening}">`;     
                    }
                    $('#detail_edit').html(detail);
                    $('.edit_barangid').append(isi);
                }
            })
            $('.edit_barangid').select2();
        }else if (jenisItem == 'jasa'){
            var rowindex    = tabel_detail_item.row($('.edit_detail'+id).parents('tr')).index();
            $('input[name=edit_rowindex]').val(rowindex);
            $('.edit_jasaid').empty();
            $('.edit_jenisItem').val('jasa');
            $('.edit_comboboxbarang').attr("hidden", true);
            $('.edit_comboboxjasa').attr("hidden", false);
            $('.edit_comboboxbudgetevent').attr("hidden", true); 
            url = base_url + 'select2_item_jasa';
            $.ajax({
                url         : url,
                method      : 'post',
                datatype    : 'json',
                success: function(data) {
                    isi = "";
                    detail="";
                    for ( index = 0; index < data.length; index++) {
                        if (data[index].id != id){
                            isi += `<option value="${data[index].id}">${data[index].text}</option>`
                        }else{
                            isi += `<option value="${data[index].id}" selected>${data[index].text}</option>`
                        }
                        detail += `<input type="hidden" class="form-control" id="noakun`+data[index].id+`" name="noakun[]" required value="${data[index].koderekening}">`;     
                    }
                    $('#detail_edit').html(detail);
                    $('.edit_jasaid').append(isi);
                }
            })
            $('.edit_jasaid').select2();

        }else{
            var rowindex    = tabel_detail_item.row($('.edit_detail'+id).parents('tr')).index();
            $('input[name=edit_rowindex]').val(rowindex);
            $('.edit_budgeteventid').empty();
            $('.edit_jenisItem').val('budgetevent');
            $('.edit_comboboxbarang').attr("hidden", true);
            $('.edit_comboboxjasa').attr("hidden", true);
            $('.edit_comboboxbudgetevent').attr("hidden", false); 
            url = base_url + 'select2_budgetevent';
            $.ajax({
                url         : url,
                method      : 'post',
                datatype    : 'json',
                success: function(data) {
                    isi = "";
                    detail="";
                    for ( index = 0; index < data.length; index++) {
                        if (data[index].id != id){
                            isi += `<option value="${data[index].id}">${data[index].text}</option>`
                        }else{
                            isi += `<option value="${data[index].id}" selected>${data[index].text}</option>`
                        }
                        detail += `<input type="hidden" class="form-control" id="noakun`+data[index].id+`" name="noakun[]" required value="${data[index].koderekening}">`;     
                    }
                    $('#detail_edit').html(detail);
                    $('.edit_budgeteventid').append(isi);
                }
            })
            $('.edit_budgeteventid').select2();

        }
        $('#modal_edit_detail').modal('show');
    }
    
    //simpan edit
    function save_edit_detail() {
        var formData        = new FormData($('#form3')[0]);
        var edit_rowindex   = $('input[name=edit_rowindex]').val();
        var Edit_jenisItem  = $('.edit_jenisItem').val();
        var IsiItem    = '';
        var noakun =0;
        if ((Edit_jenisItem == 'barang') || (Edit_jenisItem == 'inventaris')){
            edit_isiitem = $('.edit_barangid :selected');
        } else if (Edit_jenisItem == 'jasa'){
            edit_isiitem = $('.edit_jasaid :selected');
            noakun = 0;
        }else{
            edit_isiitem = $('.edit_budgeteventid :selected');
        }

        var no = 0;
        for ( index = 0; index < edit_isiitem.length; index++) {
            var id    = edit_isiitem[index].value;
            var item  = edit_isiitem[index].text;
            
            noakun   = $('#noakun'+edit_isiitem[index].value).val();
            $('#noakun'+edit_isiitem[index].value).remove();

            if (Edit_jenisItem != 'budgetevent'){
                if(tabel_detail_item.hasValue(id)) {
                    swal("Gagal!", "Item sudah ada", "error");
                    return;
                }
                tabel_detail_item.row(edit_rowindex).data([
                    edit_isiitem[index].value,
                    item,
                    `<input type="text" class="form-control" onkeyup="sum('${index}${edit_rowindex}', '${edit_rowindex}','${Edit_jenisItem}');" name="harga[]" id="harga${index}${edit_rowindex}">`,
                    `<input type="text" class="form-control" onkeyup="sum('${index}${edit_rowindex}', '${edit_rowindex}','${Edit_jenisItem}');" name="jumlah[]" id="jumlah${index}${edit_rowindex}">`,
                    `<input type="text" class="form-control" id="subtotal${index}${edit_rowindex}" readonly><input type="hidden" name="subtotal[]" id="subtotal_asli${index}${edit_rowindex}" readonly>`,
                    `KURS`,
                    `<input type="text" class="form-control" onkeyup="sum_total('${index}${edit_rowindex}', '${edit_rowindex}','${Edit_jenisItem}');" name="diskon[]" id="diskon${index}${edit_rowindex}">`,
                    `<input type="text" name="total_pajak[]" id="total_pajak${index}${edit_rowindex}" onchange="sum_total('${index}${edit_rowindex}', '${edit_rowindex}','${Edit_jenisItem}');">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pajak${index}${edit_rowindex}" title="Tambah Pajak">
                        <i class="fas fa-balance-scale"></i>
                    </button>`,
                    `<input type="text" name="biayapengiriman[]" id="biaya_pengiriman${index}${edit_rowindex}" onchange="sum_total('${index}${edit_rowindex}', '${edit_rowindex}','${Edit_jenisItem}');">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pengiriman${index}${edit_rowindex}" title="Tambah Biaya Pengiriman">
                        <i class="fas fa-shipping-fast"></i>
                    </button>`,
                    `${noakun}`,
                    `<input type="text" class="form-control" name="total[]" id="total${index}${edit_rowindex}" readonly onchange="sum_total('${index}${edit_rowindex}', '${edit_rowindex}','${Edit_jenisItem}');">`,
                    `<a href="javascript:EditDetail('${edit_isiitem[index].value}','${Edit_jenisItem}')" class="edit_detail${edit_isiitem[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp
                        <a href="javascript:void(0)" class="delete_detail text-danger"><i class="fas fa-trash"></i></a>`,
                    `${Edit_jenisItem}`
                ]).draw( false );
                detail_array_item();
                modal_pajak = `<div class="modal fade" id="modal_pajak${index}${edit_rowindex}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Pajak</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form_pajak${index}${edit_rowindex}" action="javascript:total_pajak('${index}${edit_rowindex}', '${edit_rowindex}','${Edit_jenisItem}')" enctype="multipart/form-data" method="POST">
                                    <div class="modal-body">
                                        <div class="mb-3 mt-3 table-responsive">
                                            <div class="mt-3 mb-3">
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pilih_pajak${index}${edit_rowindex}" id="pilih_pajak">
                                                    <i class="fas fa-plus"></i>Pilih Pajak
                                                </button>
                                            </div>
                                            <table class="table table-bordered" style="width:100%" id="pajak">
                                                <thead class="bg-dark">
                                                    <tr>
                                                        <th class="text-right">Nama Pajak</th>
                                                        <th class="text-right">Kode Akun</th>
                                                        <th class="text-right">Nama Akun</th>
                                                        <th class="text-right">Nominal</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="isi_tbody_pajak${index}${edit_rowindex}">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <input type="hidden" name="idpajak${index}${edit_rowindex}" id="idpajak${index}${edit_rowindex}">
                                        <input type="hidden" name="iditem${index}${edit_rowindex}" value="${id}">
                                        <input type="hidden" name="jenisitem${index}${edit_rowindex}" value="${Edit_jenisItem}">
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>`;
                
                    modal_pilih_pajak   = `<div class="modal fade" id="modal_pilih_pajak${index}${edit_rowindex}">
                                        <div class="modal-dialog ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Pilih Pajak</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <thead class="bg-dark">
                                                            <tr>
                                                                <th>&nbsp;</th>
                                                                <th>Kode Pajak</th>
                                                                <th>Nama Pajak</th>
                                                                <th>Kode Akun</th>
                                                                <th>Nama Akun</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id='list_pajak${index}${edit_rowindex}'>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`
                    modal_pengiriman = `
                        <div class="modal fade" id="modal_pengiriman${index}${edit_rowindex}">
                            <div class="modal-dialog ">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Biaya Pengiriman</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form_pengiriman${index}${edit_rowindex}" action="javascript:total_pengiriman('${index}${edit_rowindex}', '${edit_rowindex}','${Edit_jenisItem}')" enctype="multipart/form-data" method="POST">
                                    <div class="modal-body">
                                        <div class="mb-3 mt-3 table-responsive">
                                            <div class="mt-3 mb-3">
                                                <select class="form-control pilih_akun" name="noakun" required id="noakun${index}${edit_rowindex}" multiple data-id="${index}${edit_rowindex}""></select>
                                            </div>
                                            <table class="table table-bordered" style="width:100%" id="pengiriman">
                                                <thead class="bg-dark">
                                                    <tr>
                                                        <th class="text-right">Kode Akun</th>
                                                        <th class="text-right">Nama Akun</th>
                                                        <th class="text-right">Nominal</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="isi_tbody_pengiriman${index}${edit_rowindex}">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>`;
                    $('#tambah_modal_pajak').append(modal_pajak);
                    $('#tambah_modal_pilih_pajak').append(modal_pilih_pajak);
                    $('#tambah_modal_pilih_pengiriman').append(modal_pengiriman);
                    ajax_select({ 
                        id          : `#noakun${index}${edit_rowindex}`, 
                        url         : base_url+'select2_noakun_pengiriman'
                    });
                    getListPajak(String(index) + String(edit_rowindex));
            }else{
                if(tabel_detail_budgetevent.hasValue(id)) {
                    swal("Gagal!", "Item sudah ada", "error");
                    return;
                }
                tabel_detail_budgetevent.row(edit_rowindex).data([
                    edit_isiitem[index].value,
                    item,
                    `<input type="text" class="form-control" onkeyup="sum('${index}${index}${edit_rowindex}', '${edit_rowindex}','${Edit_jenisItem}');" name="harga[]" id="harga${index}${index}${edit_rowindex}">`,
                    `<input type="text" class="form-control" onkeyup="sum('${index}${index}${edit_rowindex}', '${edit_rowindex}','${Edit_jenisItem}');" name="jumlah[]" id="jumlah${index}${index}${edit_rowindex}">`,
                    `<input type="text" class="form-control" id="subtotal${index}${index}${edit_rowindex}" readonly><input type="hidden" name="subtotal[]" id="subtotal_asli${index}${index}${edit_rowindex}" readonly>`,
                    `KURS KOSONG`,
                    `<input type="text" class="form-control" onkeyup="sum_total('${index}${index}${edit_rowindex}', '${edit_rowindex}','${Edit_jenisItem}');" name="diskon[]" id="diskon${index}${index}${edit_rowindex}">`,
                    `<input type="text" name="total_pajak[]" id="total_pajak${index}${index}${edit_rowindex}" onchange="sum_total('${index}${index}${edit_rowindex}', '${edit_rowindex}','${Edit_jenisItem}');">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pajak${index}${index}${edit_rowindex}" title="Tambah Pajak">
                        <i class="fas fa-balance-scale"></i>
                    </button>`,
                    `<input type="text" name="biayapengiriman[]" id="biaya_pengiriman${index}${index}${edit_rowindex}" onchange="sum_total('${index}${index}${edit_rowindex}', '${edit_rowindex}','${Edit_jenisItem}');">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pengiriman${index}${index}${edit_rowindex}" title="Tambah Biaya Pengiriman">
                        <i class="fas fa-shipping-fast"></i>
                    </button>`,
                    `${noakun}`,
                    `<input type="text" class="form-control" name="total[]" id="total${index}${index}${edit_rowindex}" readonly onchange="sum_total('${index}${index}${edit_rowindex}', '${edit_rowindex}','${Edit_jenisItem}');">`,
                    `<a href="javascript:EditDetail('${edit_isiitem[index].value}','${Edit_jenisItem}')" class="edit_detail${edit_isiitem[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp
                        <a href="javascript:void(0)" class="delete_detail text-danger"><i class="fas fa-trash"></i></a>`,
                    `${Edit_jenisItem}`
                ]).draw( false );
                
                detail_array_budgetevent();

               
            }
        }
        $('#modal_edit_detail').modal('hide');
    }


    //hapus isi tabel item
    $('#tabel_detail_item tbody').on('click','.delete_detail',function(){
        var rowindex    = tabel_detail_item.row($(this).parents('tr')).index();
        tabel_detail_item.row($(this).parents('tr')).remove().draw();
        detail_array_item();
        total_total_item.splice(rowindex, 1);
        total_semua('barang');
    })

    //hapus isi tabel budget event
    $('#tabel_detail_budgetevent tbody').on('click','.delete_detail',function(){
        var rowindex    = tabel_detail_budgetevent.row($(this).parents('tr')).index();
        tabel_detail_budgetevent.row($(this).parents('tr')).remove().draw();
        detail_array_budgetevent();
        total_total_budgetevent.splice(rowindex, 1);
        total_semua('budgetevent');
    })

    //hitung subtotal dan total
    function sum(no, no1, jenis) { 
        var txtFirstNumberValue                     = document.getElementById('harga'+no).value.replace(/[^,\d]/g, '').toString();    
        document.getElementById('harga'+no).value   = formatRupiah(txtFirstNumberValue, 'Rp.');
        var txtSecondNumberValue                    = document.getElementById('jumlah'+no).value;
        var result                                  = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
        var pajak                                   = document.getElementById('total_pajak'+no).value;
        if (!isNaN(parseInt(pajak))) {
            var result   = result + parseInt(pajak);    
        }
        if (isNaN(parseInt(txtFirstNumberValue))) {
            var result  = 0;    
        }
        if (isNaN(parseInt(txtSecondNumberValue))) {
            var result  = 0;    
        }
        
        if (!isNaN(result)) {
            hasilsubtotal = parseInt(txtFirstNumberValue * txtSecondNumberValue);
            document.getElementById('subtotal'+no).value        = formatRupiah(String(hasilsubtotal), 'Rp.');
            document.getElementById('subtotal_asli'+no).value   = hasilsubtotal;
            document.getElementById('total'+no).value           = formatRupiah(String(result), 'Rp.');
        }
        else if(txtFirstNumberValue !=null && txtSecondNumberValue == null){
            document.getElementById('subtotal'+no).value = txtFirstNumberValue;
            document.getElementById('total'+no).value = txtFirstNumberValue;
        }else{
            hasilsubtotal = parseInt(txtFirstNumberValue * txtSecondNumberValue);
            document.getElementById('subtotal'+no).value        = formatRupiah(String(hasilsubtotal), 'Rp.');
            document.getElementById('subtotal_asli'+no).value   = hasilsubtotal;
            document.getElementById('total'+no).value           = formatRupiah(String(result), 'Rp.');
        }
        if (jenis != 'budgetevent'){
            total_total_item[no1] = [];
            total_total_item[no1].push(parseInt(result));
        }else{
            total_total_budgetevent[no1] = [];
            total_total_budgetevent[no1].push(parseInt(result));
        }
        total_semua(jenis);
    }

    //hitung total dengan diskon dan pajak
    function sum_total(no, no1, jenis) {   
       var subtotal            = document.getElementById('subtotal_asli'+no).value.replace(/[^,\d]/g, '').toString();
        if (isNaN(parseInt(subtotal))) {
            var subtotal   = 0;    
        }
        var diskon              = document.getElementById('diskon'+no).value;
        if (isNaN(parseInt(diskon))) {
            var subtotal_baru   = parseInt(subtotal);    
        } else {
            var subtotal_baru   = parseInt(subtotal) - (parseInt(diskon) * parseInt(subtotal)/100);
        }
        var pajak                 = document.getElementById('total_pajak'+no).value;
        if (isNaN(parseInt(pajak))) {
            var total   = parseInt(subtotal_baru);    
        } else {
            var total   = parseInt(subtotal_baru) + parseInt(pajak);
        }
        var pengiriman  = document.getElementById('biaya_pengiriman'+no).value;
        if (isNaN(parseInt(pengiriman))) {
            var total   = parseInt(total);    
        } else {
            var total   = parseInt(total) + parseInt(pengiriman);
        }
        document.getElementById('total'+no).value = formatRupiah(String(total), 'Rp.');

        if (jenis != 'budgetevent'){
            total_total_item[no1]    = [];
            total_total_item[no1].push((parseInt(total)));
        }else{
            total_total_budgetevent[no1]    = [];
            total_total_budgetevent[no1].push((parseInt(total)));
        }
        total_semua(jenis);
    }

    //hitung total tabel
    function total_semua(jenis) {
        if (jenis != 'budgetevent'){
            a  = 0;
            total_total_item.forEach(function callback(element, index, array) {
                a   += parseInt(element);
            })
            var hasil = formatRupiah(String(a), 'Rp. ');
            $('#total_total_item').html(hasil);
            $('.total_penjualan').val(hasil);
        }else{
            b  = 0;
            total_total_budgetevent.forEach(function callback(element, index, array) {
                b   += parseInt(element);
            })
            var hasil = formatRupiah(String(b), 'Rp. ');
            $('#total_total_budgetevent').html(hasil);
            $('.total_budgetevent').val(hasil);
        }
    }

    //angsuran
    $(document).ready(function(){
        //mengambil detail angsuran
        $.ajax({
            url         : base_url + 'get_detail_angsuran',
            method      : 'post',
            async       : true,
            dataType    : 'json',
            data        : { id : $('.idpemesanan').val() },
            success: function(data) {
                var i;
                for(i=0; i<data.length; i++){ 
                    var uangmuka = data[i].uangmuka; 
                    var jumlahterm = data[i].jumlahterm;
                    var a1 = data[i].a1; 
                    var a2 = data[i].a2;
                    var a3 = data[i].a3;
                    var a4 = data[i].a4;
                    var a5 = data[i].a5;
                    var a6 = data[i].a6;
                    var a7 = data[i].a7;
                    var a8 = data[i].a8;
                    var total = data[i].total;
                }
                $('.um').val(formatRupiah(uangmuka, 'Rp.')); 
                $('.jtem').val(jumlahterm);
                if (parseInt(jumlahterm) > 0){
                    for (var i = 1; i <= 8; i++) {
                         $('.a'+i).attr("hidden", true);
                    } 
            
                    for (var j = 1; j <= jumlahterm; j++) {
                         $('.a'+j).attr("hidden", false);
                    } 
                }
                $('.tum').val(formatRupiah(total, 'Rp.')); 
            }
        })
    })
    
    //setting keyup format rupiah
    function UbahInputRUpiah(nama_inputan){
        $(nama_inputan).on('keyup',function(){
            var nilai= $(this).val();
            $(this).val(formatRupiah(String(nilai), 'Rp. '));
        });
    }

    //setting keyup untuk tampilan jumlah anggsuran
    $('.jtem').on('keyup',function(){
        for (var i = 1; i <= 8; i++) {
             $('.a'+i).attr("hidden", true);
        } 
        var nilai_jtem = $(this).val();
        for (var j = 1; j <= nilai_jtem; j++) {
             $('.a'+j).attr("hidden", false);
        } 
    });
    $('.jtem').on('click',function(){
        for (var i = 1; i <= 8; i++) {
             $('.a'+i).attr("hidden", true);
        } 
        var nilai_jtem = $(this).val();
        for (var j = 1; j <= nilai_jtem; j++) {
             $('.a'+j).attr("hidden", false);
        } 
    });

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
    
   function save() {
        var form = $('#form1')[0];
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
                    swal("Berhasil!", data.message, "success");
                    redirect(base_url);
                } else {
                    swal("Gagal!", data.message, "error");
                }
            },
            error: function() {
                swal("Gagal!", "Internal Server Error", "error");
            }
            })
    }

</script>