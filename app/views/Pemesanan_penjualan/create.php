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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tambah <?= $title; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- card body -->
                        <div class="card-body">
                            <!-- form start -->
                            <form id="form1" action="javascript:save()">
                                <div class="row">
                                    <div class="col-md-3">
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
                                            <label><?php echo lang('Pejabat') ?>:</label>
                                            <div class="input-group"> 
                                            <select id="pejabat" class="form-control pejabat" name="pejabat" required></select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Cabang : </label>
                                            <div class="input-group"> 
                                                <select id="cabang" class="form-control cabang" name="cabang" required></select>
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
                                    <div class="table-responsive">
                                        <table class="table table-xs table-striped table-borderless table-hover index_datatable" id="tabel_detail_item" width="100%" hidden>
                                            <thead>
                                                <tr class="table-active">
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
                                            <tbody></tbody>
                                            <tfoot>
                                                <tr class="table-active">
                                                    <th>ID</th>
                                                    <th colspan="8">&nbsp;</th>
                                                    <th class="text-right"><?php echo lang('total') ?></th>
                                                    <th class="text-center" id="total_total_item"></th>
                                                    <th><input type="hidden" name="total_penjualan" class="total_penjualan"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-xs table-striped table-borderless table-hover index_datatable" id="tabel_detail_budgetevent" width="100%" hidden>
                                            <thead>
                                                <tr class="table-active">
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
                                            <tbody></tbody>
                                            <tfoot>
                                                <tr class="table-active">
                                                    <th>ID</th>
                                                    <th colspan="8">&nbsp;</th>
                                                    <th class="text-right"><?php echo lang('total') ?></th>
                                                    <th class="text-center" id="total_total_budgetevent"></th>
                                                    <th><input type="hidden" name="total_budgetevent" class="total_budgetevent"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
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
                                    <input type="hidden" name="detail_array_item" id="detail_array_item">
                                    <input type="hidden" name="detail_array_budgetevent" id="detail_array_budgetevent">
                                    <div id="detailPajak"></div>
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

<div id="modal_add_barang_inventaris" class="modal fade">
    <div class="modal-dialog modal-lg">
        <form action="javascript:save_detail(0,&#39;barang_inventaris&#39;)" id="form_barang_inventaris">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Baru</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="jenis_item">
                    <input type="hidden" name="rowindex_barang_inventaris">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><item></item></label>
                                <select class="form-control id_barang_inventaris" name="id_barang_inventaris[]" required="" style="width:100%" multiple="">
                                </select>
                            </div>
                        </div>
                        <table class="table">
                            <tbody id="list_barang_inventaris">

                            </tbody>
                        </table>
                        <div id="detail_barang_inventaris"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="modal_add_jasa" class="modal fade">
    <div class="modal-dialog modal-lg">
        <form action="javascript:save_detail(0, &#39;jasa&#39;)" id="form_jasa">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jasa</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="jenis_item">
                    <input type="hidden" name="rowindex_jasa">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Jasa :</label>
                                <select class="form-control id_jasa" name="id_jasa[]" required="" style="width:100%" multiple="">
                                </select>
                            </div>
                        </div>
                        <table class="table">
                            <tbody id="list_jasa">

                            </tbody>
                        </table>
                        <div id="detail_jasa"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="modal_add_budgetevent" class="modal fade">
    <div class="modal-dialog modal-lg">
        <form action="javascript:save_detail(0, &#39;budgetevent&#39;)" id="form_budgetevent">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Budget Event</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="rowindex_budgetevent">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Budget Event :</label>
                                <select class="form-control id_budgetevent" name="id_budgetevent[]" required="" style="width:100%" multiple="">
                                </select>
                            </div>
                        </div>
                        <table class="table">
                            <tbody id="list_budgetevent">

                            </tbody>
                        </table>
                        <div id="detail_budgetevent"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="modal_edit_detail_item" class="modal fade">
    <div class="modal-dialog modal-lg">
        <form action="javascript:save_edit_detail('item')" id="form_edit_item" enctype="multipart/form-data" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Item</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="edit_jenisitem" class="edit_jenisitem">
                    <input type="hidden" name="edit_rowindex_item">
                    <input type="hidden" class="nmr_urut_item">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Item:</label>
                                <select class="form-control edit_itemid" name="edit_itemid[]" required="" style="width:100%">
                                </select>
                            </div>
                        </div>
                        <table class="table">
                            <tbody id="edit_list_item">

                            </tbody>
                        </table>
                        <div id="edit_detail_item"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="modal_edit_detail_budgetevent" class="modal fade">
    <div class="modal-dialog modal-lg">
        <form action="javascript:save_edit_detail('budgetevent')" id="form_edit_budgetevent" enctype="multipart/form-data" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Budget Event</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="edit_rowindex_budgetevent">
                     <input type="hidden" class="nmr_urut_budgetevent">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Budget Event:</label>
                                <select class="form-control edit_budgeteventid" name="edit_budgeteventid[]" required="" style="width:100%">
                                </select>
                            </div>
                        </div>
                        <table class="table">
                            <tbody id="edit_list_budgetevent">

                            </tbody>
                        </table>
                        <div id="edit_detail_budgetevent"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
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
        ajax_select({ id: '.kontakid', url: base_url + 'select2_kontak', selected: { id: null } });
        ajax_select({ id: '.gudangid', url: base_url + 'select2_gudang', selected: { id: null } });
        ajax_select({id: '#perusahaan', url: base_url + 'select2_mperusahaan', selected: { id: null } });           

        //menyembunyikan button tambah
        $('.btn_add_detail_barang').attr("hidden", false);
        $('.btn_add_detail_jasa').attr("hidden", true);
        $('.btn_add_detail_budgetevent').attr("hidden", true);

        //setting inputan anggsuran 
        $('input[name=jtem]').val('0');  

        $('#nokwitansi_rekening').attr("hidden", true);
        var jn_penjualan = $('.jenis_penjualan').val();
        if (jn_penjualan == 'barang'){
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
        }

        $('#tabel_detail_item').attr("hidden", false);
        $('#tabel_detail_budgetevent').attr("hidden", true);
    }) 

    $('#perusahaan').change(function(e) {
        $("#departemen").val($("#departemen").data("default-value"));
        $("#pejabat").val($("#pejabat").data("default-value"));
        $("#rekening").val($("#rekening").data("default-value"));
        var perusahaanId = $('#perusahaan').children('option:selected').val();
        ajax_select({
            id: '#departemen',
            url: base_url + 'select2_mdepartemen/' + perusahaanId,
        });
        ajax_select({
            id: '#rekening',
            url: base_url + 'select2_mrekening_perusahaan/' + perusahaanId,
        });
        ajax_select({
            id          : '#cabang',
            url         : '{site_url}cabang/select2_perusahaan/' + perusahaanId
        });
    })

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
        $('#modal_add_barang_inventaris').modal('show');
        $('#nokwitansi_rekening').attr("hidden", true);
        $('.nokwitansi').attr("hidden", true);
        $('#tabel_detail_item').attr("hidden", false);
        $('#tabel_detail_budgetevent').attr("hidden", true);
        var jenis_barang = $('.jenis_barang').val();
        var idgudang = $('.gudangid').val();
        if (jenis_barang == 'inventaris'){
            $('item').html('Inventaris:');
            $('.jenis_item').val('inventaris');
            url = base_url + 'select2_item_inventaris';
        }else{
            $('item').html('Barang:');
            $('.jenis_item').val('barang');
            url = base_url + 'select2_item'+ '/'+ idgudang +'/'+idgudang;
        }
        $('.id_barang_inventaris').empty();
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
                $('#detail_barang_inventaris').html(detail);
                $('.id_barang_inventaris').append(isi);
            }
        })
        $('.id_barang_inventaris').select2();
    })

    //menampilkan modal jasa
    $(document).on('click','.btn_add_detail_jasa',function(){
        $('#modal_add_jasa').modal('show');
        $('#nokwitansi_rekening').attr("hidden", true);
        $('.nokwitansi').attr("hidden", true);
        $('#tabel_detail_item').attr("hidden", false);
        $('#tabel_detail_budgetevent').attr("hidden", true);
        $('.id_jasa').empty();
        $('.jenis_item').val('jasa');
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
                $('#detail_jasa').html(detail);
                $('.id_jasa').append(isi);
            }
        })
        $('.id_jasa').select2();
    })

    //menampilkan modal budgetevent
    $(document).on('click','.btn_add_detail_budgetevent',function(){
        $('#modal_add_budgetevent').modal('show');
        $('#nokwitansi_rekening').attr("hidden", false);
        $('.nokwitansi').attr("hidden", false);
        $('.nokwitansi').val('{kode_otomatis}/BE/{tahun}');
        $("#rekening").val($("#rekening").data("default-value"));
        $('#tabel_detail_item').attr("hidden", true);
        $('#tabel_detail_budgetevent').attr("hidden", false);
        $('.id_budgetevent').empty();
        $.ajax({
            url         : base_url + 'select2_budgetevent',
            method      : 'post',
            datatype    : 'json',
            success: function(data) {
                isi = "";
                detail="";
                for ( index = 0; index < data.length; index++) {
                    detail += `<input type="hidden" class="form-control" id="noakun1`+data[index].id+`" name="noakun1[]" required value="${data[index].koderekening}">`;
                    isi += `<option value="${data[index].id}">${data[index].text}</option>`
                }
                $('#detail_budgetevent').html(detail);
                $('.id_budgetevent').append(isi);
            }
        })
        $('.id_budgetevent').select2();
    })


    function save_detail(no, jenis) {
        switch (jenis) {
            case 'barang_inventaris':
                var form            = $('#form_barang_inventaris')[0];
                var formData        = new FormData(form);
                var barang          = $('.id_barang_inventaris :selected');        
                break;
            case 'jasa':
                var form            = $('#form_jasa')[0];
                var formData        = new FormData(form);
                var barang          = $('.id_jasa :selected');        
                break;
            case 'budgetevent':
                var form            = $('#form_budgetevent')[0];
                var formData        = new FormData(form);
                var barang          = $('.id_budgetevent :selected');        
                break;
            default:
                break;
        }

        if (jenis != 'budgetevent'){
            var jenis_item = $('.jenis_item').val();
            for (let index = 0; index < barang.length; index++) {
                var id    = barang[index].value;
                var item  = barang[index].text;
                if(tabel_detail_item.hasValue(id)) {
                    swal("Gagal!", "Item sudah ada", "error");
                    return;
                }
                noakun   = $('#noakun'+barang[index].value).val();
                $('#noakun'+barang[index].value).remove();
                tabel_detail_item.row.add([
                    barang[index].value,
                    item,
                    `<input type="text" class="form-control" onkeyup="sum('${index}${no}', '${no}', '${jenis}');" name="harga[]" id="harga${index}${no}">`,
                    `<input type="text" class="form-control" onkeyup="sum('${index}${no}', '${no}', '${jenis}');" name="jumlah[]" id="jumlah${index}${no}">`,
                    `<input type="text" class="form-control" id="subtotal${index}${no}" readonly><input type="hidden" name="subtotal[]" id="subtotal_asli${index}${no}" readonly>`,
                    `KURS`,
                    `<input type="text" class="form-control" onkeyup="sum_total('${index}${no}', '${no}', '${jenis}');" name="diskon[]" id="diskon${index}${no}">`,
                    `<input type="hidden" name="total_pajak[]" id="total_pajak${index}${no}" onchange="sum_total('${index}${no}', '${no}', '${jenis}');">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pajak${index}${no}" title="Tambah Pajak">
                        <i class="fas fa-balance-scale"></i>
                    </button>`,
                    `<input type="hidden" name="biayapengiriman[]" id="biaya_pengiriman${index}${no}" onchange="sum_total('${index}${no}', '${no}', '${jenis}');">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pengiriman${index}${no}" title="Tambah Biaya Pengiriman">
                        <i class="fas fa-shipping-fast"></i>
                    </button>`,
                    `${noakun}`,
                    `<input type="text" class="form-control" name="total[]" id="total${index}${no}" readonlY>`,
                    `<a href="javascript:EditDetail('${barang[index].value}','${jenis_item}','${no}')" class="edit_detail${barang[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp; 
                        <a href="javascript:delete_detail_item('${no}')" class="delete_detail_item text-danger"><i class="fas fa-trash"></i></a>`,
                    `${jenis_item}`
                ]).draw( false );
                detail_array_item();

                modal_pajak = `<div class="modal fade" id="modal_pajak${index}${no}">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Pajak</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form_pajak${index}${no}" action="javascript:total_pajak('${index}${no}', '${no}')" enctype="multipart/form-data" method="POST">
                                    <div class="modal-body">
                                        <div class="mb-3 mt-3 table-responsive">
                                            <div class="mt-3 mb-3">
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pilih_pajak${index}${no}" id="pilih_pajak">
                                                    <i class="fas fa-plus"></i>Pilih Pajak
                                                </button>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-xs table-striped table-borderless table-hover index_datatable" style="width:100%" id="pajak">
                                                    <thead>
                                                        <tr class="table-active">
                                                            <th>Nama Pajak</th>
                                                            <th>Kode Akun</th>
                                                            <th>Nama Akun</th>
                                                            <th>Nominal</th>
                                                            <th>Pengurangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="isi_tbody_pajak${index}${no}"></tbody>
                                                </table>
                                            </div>
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
                
                modal_pilih_pajak   = `<div class="modal fade" id="modal_pilih_pajak${index}${no}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Pilih Pajak</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-xs table-striped table-borderless table-hover index_datatable">
                                                            <thead>
                                                                <tr class="table-active">
                                                                    <th>&nbsp;</th>
                                                                    <th>Kode Pajak</th>
                                                                    <th>Nama Pajak</th>
                                                                    <th>Kode Akun</th>
                                                                    <th>Nama Akun</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id='list_pajak${index}${no}'></tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`
                modal_pengiriman = `
                    <div class="modal fade" id="modal_pengiriman${index}${no}">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Biaya Pengiriman</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="form_pengiriman${index}${no}" action="javascript:total_pengiriman('${index}${no}', '${no}')" enctype="multipart/form-data" method="POST">
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
                no++;
            }
            var no_baru = no;
   
            $('#form_barang_inventaris').attr('action', 'javascript:save_detail('+no_baru+',"barang_inventaris")');    
            $('#modal_add_barang_inventaris').modal('hide');    
         
            $('#form_jasa').attr('action', 'javascript:save_detail('+no_baru+',"jasa")');
            $('#modal_add_jasa').modal('hide');     
                  
        } else {
            for (let index = 0; index < barang.length; index++) {
                var id    = barang[index].value;
                var item  = barang[index].text;
                if(tabel_detail_budgetevent.hasValue(id)) {
                    swal("Gagal!", "Item sudah ada", "error");
                    return;
                }
                 noakun   = $('#noakun1'+barang[index].value).val();
                $('#noakun1'+barang[index].value).remove();
                tabel_detail_budgetevent.row.add([
                    barang[index].value,
                    item,
                    `<input type="text" class="form-control" onkeyup="sum('${index}${no}', '${no}', '${jenis}');" name="harga1[]" id="harga1${index}${no}">`,
                    `<input type="text" class="form-control" onkeyup="sum('${index}${no}', '${no}', '${jenis}');" name="jumlah1[]" id="jumlah1${index}${no}">`,
                    `<input type="text" class="form-control" id="subtotal1${index}${no}" readonly><input type="hidden" name="subtotal1[]" id="subtotal_asli1${index}${no}" readonly>`,
                    `KURS`,
                    `<input type="text" class="form-control" onkeyup="sum_total('${index}${no}', '${no}', '${jenis}');" name="diskon1[]" id="diskon1${index}${no}">`,
                    `<input type="hidden" name="total_pajak1[]" id="total_pajak1${index}${no}" onchange="sum_total('${index}${no}', '${no}', '${jenis}');">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pajak1${index}${no}" title="Tambah Pajak">
                        <i class="fas fa-balance-scale"></i>
                    </button>`,
                    `<input type="hidden" name="biayapengiriman1[]" id="biaya_pengiriman1${index}${no}" onchange="sum_total('${index}${no}', '${no}', '${jenis}');">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pengiriman1${index}${no}" title="Tambah Biaya Pengiriman">
                        <i class="fas fa-shipping-fast"></i>
                    </button>`,
                    `${noakun}`,
                    `<input type="text" class="form-control" name="total1[]" id="total1${index}${no}" readonly>`,
                    `<a href="javascript:EditDetail('${barang[index].value}','${jenis}','${no}')" class="edit_detail${barang[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp; 
                        <a href="javascript:delete_detail_budgetevent('${no}')" class="delete_detail_budgetevent text-danger"><i class="fas fa-trash"></i></a>`,
                    `${jenis}`
                ]).draw( false );
                detail_array_budgetevent();

                modal_pajak = `<div class="modal fade" id="modal_pajak1${index}${no}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Pajak</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form_pajak1${index}${no}" action="javascript:total_pajak1('${index}${no}', '${no}')" enctype="multipart/form-data" method="POST">
                                    <div class="modal-body">
                                        <div class="mb-3 mt-3 table-responsive">
                                            <div class="mt-3 mb-3">
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pilih_pajak1${index}${no}" id="pilih_pajak1">
                                                    <i class="fas fa-plus"></i>Pilih Pajak
                                                </button>
                                            </div>
                                            <table class="table table-bordered" style="width:100%" id="pajak1">
                                                <thead class="bg-dark">
                                                    <tr>
                                                        <th class="text-right">Nama Pajak</th>
                                                        <th class="text-right">Kode Akun</th>
                                                        <th class="text-right">Nama Akun</th>
                                                        <th class="text-right">Nominal</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="isi_tbody_pajak1${index}${no}">
                                                    
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
                
                modal_pilih_pajak   = `<div class="modal fade" id="modal_pilih_pajak1${index}${no}">
                                        <div class="modal-dialog modal-lg">
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
                                                        <tbody id='list_pajak1${index}${no}'>

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
                    <div class="modal fade" id="modal_pengiriman1${index}${no}">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Biaya Pengiriman</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="form_pengiriman1${index}${no}" action="javascript:total_pengiriman1('${index}${no}', '${no}')" enctype="multipart/form-data" method="POST">
                                <div class="modal-body">
                                    <div class="mb-3 mt-3 table-responsive">
                                        <div class="mt-3 mb-3">
                                            <select class="form-control pilih_akun1" name="noakun1" required id="noakun1${index}${no}" multiple data-id1="${index}${no}""></select>
                                        </div>
                                        <table class="table table-bordered" style="width:100%" id="pengiriman1">
                                            <thead class="bg-dark">
                                                <tr>
                                                    <th class="text-right">Kode Akun</th>
                                                    <th class="text-right">Nama Akun</th>
                                                    <th class="text-right">Nominal</th>
                                                </tr>
                                            </thead>
                                            <tbody id="isi_tbody_pengiriman1${index}${no}">
                                                
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
                    id          : `#noakun1${index}${no}`, 
                    url         : base_url+'select2_noakun_pengiriman'
                });
                getListPajak1(String(index) + String(no));
                no++;
            }
            var no_baru = no; 
            $('#form_budgetevent').attr('action', 'javascript:save_detail('+no_baru+',"budgetevent")');   
            $('#modal_add_budgetevent').modal('hide');      
        }
    }

    //barang, inventaris, dan jasa
    function addPajak(elem, no, id) {
        const kode_pajak    = $(elem).attr('kode_pajak');
        const nama_pajak    = $(elem).attr('nama_pajak');
        const kode_akun     = $(elem).attr('kode_akun');
        const nama_akun     = $(elem).attr('nama_akun');
        const idPajak       = $(elem).attr('idPajak');
        const stat          = $(elem).is(":checked");
        const table         = $('#isi_tbody_pajak'+id);
        // var no1              = 0;        
        if (stat) {
            html = `<tr no="${no}">
                        <td><input type="hidden" name="idPajak" value="${idPajak}">${kode_pajak}</td>
                        <td>${kode_akun}</td>
                        <td>${nama_akun}</td>
                        <td><input type="text" class="form-control pajak" id="nominal_pajak${no}${id}" onkeyup="nominalPajak('${no}${id}')" name="pajak"></td>
                        <td><input type="checkbox" name="pengurangan" id="pengurangan${no}${id}"></td>
                    </tr>`;
            table.append(html);
        } else {
            // alert('a');
            $(`tr[no="${no}"]`).remove();
        }
    }

    function total_pajak(id, no) {
        var formData    = new FormData($('#form_pajak'+id)[0]);
        var pajak       = formData.getAll('pajak');
        var pengurangan = formData.getAll('pengurangan');
        var idPajak     = formData.getAll('idPajak');
        var pajak_baru  = 0;
        var index       = 0;
        pajak.forEach(p => {
            var stat    = $('#pengurangan' + index + id).is(':checked');
            if (stat) {
                pajak_baru  -= parseInt(p.replace(/[.]/g, ''));
                stat        = 1;
            } else {
                pajak_baru  += parseInt(p.replace(/[.]/g, ''));
                stat        = 0;
            }
            pengurangan[index]  = stat; 
            index++;
        });
        var x   = $('#idPajak' + id);
        if (x.length == 0) {
            $('#detailPajak').append(
                `<input type="hidden" name="idPajak[]" value="${idPajak}" id="idPajak${id}">
                <input type="hidden" name="pajak[]" value="${pajak}" id="pajak${id}">
                <input type="hidden" name="pengurangan[]" value="${pengurangan}" id="pengurangan${id}">`
            );
        } else {
            $('#idPajak' + id).val(idPajak);
            $('#pajak' + id).val(pajak);
            $('#pengurangan' + id).val(pengurangan);
        }
        $('#total_pajak'+id).val(pajak_baru);
        $('#modal_pajak'+id).modal('hide');
        sum_total(id, no, "item")
    }

    function total_pengiriman(id, no) {
        var formData            = new FormData($('#form_pengiriman'+id)[0]);
        var pengiriman          = formData.getAll('pengiriman');
        var biaya_pengiriman    = 0;
        pengiriman.forEach(p => {
            biaya_pengiriman  += parseInt(p.replace(/[Rp.]/g, ''));
        });
        $('#biaya_pengiriman'+id).val(biaya_pengiriman);
        $('#modal_pengiriman'+id).modal('hide');
        sum_total(id, no, "item")
    }

    function nominalPajak(no) {
        var nilai   = $('#nominal_pajak' + no).val();
        $('#nominal_pajak' + no).val(formatRupiah(String(nilai)));
    }

    function getListPajak(id) {
        var table = $('#list_pajak'+id);
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
                                <td><input type="checkbox" name="" kode_pajak="${element.kode_pajak}" nama_pajak="${element.nama_pajak}" kode_akun="${element.akunno}" nama_akun="${element.namaakun}" idPajak="${element.id_pajak}" onchange="addPajak(this, `+i+`, '`+id+`')"></td>
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

    //budgetevent
    function addPajak1(elem, no, id) {
        const kode_pajak    = $(elem).attr('kode_pajak1');
        const nama_pajak    = $(elem).attr('nama_pajak1');
        const kode_akun     = $(elem).attr('kode_akun1');
        const nama_akun     = $(elem).attr('nama_akun1');
        const stat          = $(elem).is(":checked");
        const table         = $('#isi_tbody_pajak1'+id);
        // var no1              = 0;        
        if (stat) {
            html = `<tr no="${no}">
                        <td>${kode_pajak}</td>
                        <td>${kode_akun}</td>
                        <td>${nama_akun}</td>
                        <td><input type="text" class="form-control pajak1" id="nominal_pajak1${no}${id}" onkeyup="nominalPajak1('${no}${id}')" name="pajak1"></td>
                    </tr>`;
            table.append(html);
        } else {
            // alert('a');
            $(`tr[no="${no}"]`).remove();
        }
    }

    function total_pajak1(id, no) {
        var formData    = new FormData($('#form_pajak1'+id)[0]);
        var pajak       = formData.getAll('pajak1');
        var pajak_baru  = 0;
        pajak.forEach(p => {
            pajak_baru  += parseInt(p.replace(/[Rp.]/g, ''));
        });
        $('#total_pajak1'+id).val(pajak_baru);
        $('#modal_pajak1'+id).modal('hide');
        sum_total(id, no, "budgetevent")
    }

    function total_pengiriman1(id, no) {
        var formData            = new FormData($('#form_pengiriman1'+id)[0]);
        var pengiriman          = formData.getAll('pengiriman1');
        var biaya_pengiriman    = 0;
        pengiriman.forEach(p => {
            biaya_pengiriman  += parseInt(p.replace(/[Rp.]/g, ''));
        });
        $('#biaya_pengiriman1'+id).val(biaya_pengiriman);
        $('#modal_pengiriman1'+id).modal('hide');
        sum_total(id, no, "budgetevent")
    }

    function nominalPajak1(no) {
        var nilai   = $('#nominal_pajak1' + no).val();
        var nilai1  = nilai.replace(/[^,\d]/g, '').toString();
        $('#nominal_pajak1' + no).val(formatRupiah(String(nilai)));
    }

    function getListPajak1(id) {
        var table = $('#list_pajak1'+id);
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
                                <td><input type="checkbox" name="" kode_pajak1="${element.kode_pajak}" nama_pajak1="${element.nama_pajak}" kode_akun1="${element.akunno}" nama_akun1="${element.namaakun}"id="" onchange="addPajak1(this, `+i+`, '`+id+`')"></td>
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

    $(document).on('select2:select','.pilih_akun1',function(e){
        id  = $(this).attr('data-id1');
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
                        <td><input type="text" class="form-control pajak1" id="nominal_pajak1${id}" onkeyup="nominalPajak1('${id}')" name="pengiriman1"></td>
                    </tr>`;
                $('#isi_tbody_pengiriman1'+id).append(isi_tbody_pengiriman);
            }
        })
    })

    //hitung subtotal dan total
    function sum(no, no1, jenis) { 
        if (jenis != 'budgetevent'){
            var txtFirstNumberValue                     = document.getElementById('harga'+no).value.replace(/[^,\d]/g, '').toString(); 
            document.getElementById('harga'+no).value   = formatRupiah(txtFirstNumberValue);
            var txtSecondNumberValue                    = document.getElementById('jumlah'+no).value;
            var result                                  = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
            var pajak                                   = document.getElementById('total_pajak'+no).value;
            if (!isNaN(parseInt(pajak))) {
                var result   = result + parseInt(pajak);    
            }
            var biaya_pengiriman                        = document.getElementById('biaya_pengiriman'+no).value;
            if (!isNaN(parseInt(biaya_pengiriman))) {
                var result   = result + parseInt(biaya_pengiriman);    
            }
            if (isNaN(parseInt(txtFirstNumberValue))) {
                var result  = 0;    
            }
            if (isNaN(parseInt(txtSecondNumberValue))) {
                var result  = 0;    
            }
            
            if (!isNaN(result)) {
                hasilsubtotal = parseInt(txtFirstNumberValue * txtSecondNumberValue);
                document.getElementById('subtotal'+no).value        = formatRupiah(String(hasilsubtotal)) + ',00';
                document.getElementById('subtotal_asli'+no).value   = hasilsubtotal;
                document.getElementById('total'+no).value           = formatRupiah(String(result)) + ',00';
            }
            else if(txtFirstNumberValue !=null && txtSecondNumberValue == null){
                document.getElementById('subtotal'+no).value = txtFirstNumberValue;
                document.getElementById('total'+no).value = txtFirstNumberValue;
            }else{
                hasilsubtotal = parseInt(txtFirstNumberValue * txtSecondNumberValue);
                document.getElementById('subtotal'+no).value        = formatRupiah(String(hasilsubtotal)) + ',00';
                document.getElementById('subtotal_asli'+no).value   = hasilsubtotal;
                document.getElementById('total'+no).value           = formatRupiah(String(result)) + ',00';
            }
                total_total_item[no1] = [];
                total_total_item[no1].push(parseInt(result));
        }else{
            var txtFirstNumberValue                     = document.getElementById('harga1'+no).value.replace(/[^,\d]/g, '').toString(); 
            document.getElementById('harga1'+no).value   = formatRupiah(txtFirstNumberValue);
            var txtSecondNumberValue                    = document.getElementById('jumlah1'+no).value;
            var result                                  = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
            
            var pajak                                   = document.getElementById('total_pajak1'+no).value;
            if (!isNaN(parseInt(pajak))) {
                var result   = result + parseInt(pajak);    
            }

            var biaya_pengiriman                        = document.getElementById('biaya_pengiriman1'+no).value;
            if (!isNaN(parseInt(biaya_pengiriman))) {
                var result   = result + parseInt(biaya_pengiriman);    
            }
            if (isNaN(parseInt(txtFirstNumberValue))) {
                var result  = 0;    
            }
            if (isNaN(parseInt(txtSecondNumberValue))) {
                var result  = 0;    
            }
            
            if (!isNaN(result)) {
                hasilsubtotal = parseInt(txtFirstNumberValue * txtSecondNumberValue);
                document.getElementById('subtotal1'+no).value        = formatRupiah(String(hasilsubtotal)) + ',00';
                document.getElementById('subtotal_asli1'+no).value   = hasilsubtotal;
                document.getElementById('total1'+no).value           = formatRupiah(String(result)) + ',00';
            }
            else if(txtFirstNumberValue !=null && txtSecondNumberValue == null){
                document.getElementById('subtotal1'+no).value = txtFirstNumberValue;
                document.getElementById('total1'+no).value = txtFirstNumberValue;
            }else{
                hasilsubtotal = parseInt(txtFirstNumberValue * txtSecondNumberValue);
                document.getElementById('subtotal1'+no).value        = formatRupiah(String(hasilsubtotal)) + ',00';
                document.getElementById('subtotal_asli1'+no).value   = hasilsubtotal;
                document.getElementById('total1'+no).value           = formatRupiah(String(result)) + ',00';
            }
            total_total_budgetevent[no1] = [];
            total_total_budgetevent[no1].push(parseInt(result));
        }
        total_semua(jenis);
    }

    //hitung total dengan diskon dan pajak
    function sum_total(no, no1, jenis) { 
        if (jenis != 'budgetevent'){
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
            document.getElementById('total'+no).value = formatRupiah(String(total)) + ',00';

            total_total_item[no1]    = [];
            total_total_item[no1].push((parseInt(total)));
        }else{
            var subtotal            = document.getElementById('subtotal_asli1'+no).value.replace(/[^,\d]/g, '').toString();
            if (isNaN(parseInt(subtotal))) {
                var subtotal   = 0;    
            }
            var diskon              = document.getElementById('diskon1'+no).value;
            if (isNaN(parseInt(diskon))) {
                var subtotal_baru   = parseInt(subtotal);    
            } else {
                var subtotal_baru   = parseInt(subtotal) - (parseInt(diskon) * parseInt(subtotal)/100);
            }
            var pajak                 = document.getElementById('total_pajak1'+no).value;
            if (isNaN(parseInt(pajak))) {
                var total   = parseInt(subtotal_baru);    
            } else {
                var total   = parseInt(subtotal_baru) + parseInt(pajak);
            }
            var pengiriman  = document.getElementById('biaya_pengiriman1'+no).value;
            if (isNaN(parseInt(pengiriman))) {
                var total   = parseInt(total);    
            } else {
                var total   = parseInt(total) + parseInt(pengiriman);
            }
            document.getElementById('total1'+no).value = formatRupiah(String(total)) + ',00';
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
            var hasil = formatRupiah(String(a)) + ',00';
            $('#total_total_item').html(hasil);
            $('.total_penjualan').val(hasil);
        }else{
            b  = 0;
            total_total_budgetevent.forEach(function callback(element, index, array) {
                b   += parseInt(element);
            })
            var hasil1 = formatRupiah(String(b)) + ',00';
            $('#total_total_budgetevent').html(hasil1);
            $('.total_budgetevent').val(hasil1);
        }
    }

    //hapus data
    function delete_detail_item(no){
        total_total_item.splice(no, 1,"0");
        total_semua("item");
    }
    $('#tabel_detail_item tbody').on('click','.delete_detail_item',function(){
        tabel_detail_item.row($(this).parents('tr')).remove().draw();
        detail_array_item();
    })
    function delete_detail_budgetevent(no){
        total_total_budgetevent.splice(no, 1,"0");
        total_semua("budgetevent");
    }
    $('#tabel_detail_budgetevent tbody').on('click','.delete_detail_budgetevent',function(){
        tabel_detail_budgetevent.row($(this).parents('tr')).remove().draw();
        detail_array_budgetevent();
    })


    //mengambil isi tabel
    function detail_array_item() {
        var arr = tabel_detail_item.data().toArray();
        $('#detail_array_item').val( JSON.stringify(arr) );
    }
    function detail_array_budgetevent() {
        var arr = tabel_detail_budgetevent.data().toArray();
        $('#detail_array_budgetevent').val( JSON.stringify(arr) );
    }

    //modal edit data
    function EditDetail(id,jenis,no){
        if (jenis != 'budgetevent'){
            var rowindex    = tabel_detail_item.row($('.edit_detail'+id).parents('tr')).index();
            $('input[name=edit_rowindex_item]').val(rowindex);
            $('.edit_itemid').empty();
            $('.nmr_urut_item').val(no);
            var idgudang = $('.gudangid').val();
            if (jenis == 'barang'){
                url = base_url + 'select2_item'+'/'+id+'/'+idgudang;
                $('.edit_jenisitem').val('barang');
            }else if (jenis == 'inventaris'){
                url = base_url + 'select2_item_inventaris';
                $('.edit_jenisitem').val('inventaris');
            }else if (jenis == 'jasa'){
                url = base_url + 'select2_item_jasa';
                $('.edit_jenisitem').val('jasa');
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
                    $('#edit_detail_item').html(detail);
                    $('.edit_itemid').append(isi);
                }
            })
            $('.edit_itemid').select2();

            $('#modal_edit_detail_item').modal('show');
        }else{

            var rowindex    = tabel_detail_budgetevent.row($('.edit_detail'+id).parents('tr')).index();
            $('input[name=edit_rowindex_budgetevent]').val(rowindex);
            $('.edit_budgeteventid').empty();
            $('.edit_jenisitem').val('budgetevent');
            $('.nmr_urut_budgetevent').val(no);
            $.ajax({
                url         : base_url + 'select2_budgetevent',
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
                        detail += `<input type="hidden" class="form-control" id="noakun1`+data[index].id+`" name="noakun1[]" required value="${data[index].koderekening}">`;     
                    }
                    $('#edit_detail_budgetevent').html(detail);
                    $('.edit_budgeteventid').append(isi);
                }
            })
            $('.edit_budgeteventid').select2();

            $('#modal_edit_detail_budgetevent').modal('show');
        }
    }

    function save_edit_detail(jenis) {
       
        if (jenis != 'budgetevent'){
            var formData        = new FormData($('#form_edit_item')[0]);
            var edit_rowindex   = $('input[name=edit_rowindex_item]').val();
            var edit_jenisitem  = $('.edit_jenisitem').val();
            var noakun          = 0;
            var edit_isiitem    = $('.edit_itemid :selected');
            var nmr_urut       = $('.nmr_urut_item').val();

            for (var index = 0; index < edit_isiitem.length; index++) {
                var id    = edit_isiitem[index].value;
                var item    = edit_isiitem[index].text;
                if(tabel_detail_item.hasValue(id)) {
                        swal("Gagal!", "Item sudah ada", "error");
                        return;
                }
                noakun   = $('#noakun'+edit_isiitem[index].value).val();
                $('#noakun'+edit_isiitem[index].value).remove();

                tabel_detail_item.row(edit_rowindex).data([
                    edit_isiitem[index].value,
                    item,
                    `<input type="text" class="form-control" onkeyup="sum('${index}${nmr_urut}', '${nmr_urut}','${jenis}');" name="harga[]" id="harga${index}${nmr_urut}">`,
                    `<input type="text" class="form-control" onkeyup="sum('${index}${nmr_urut}', '${nmr_urut}','${jenis}');" name="jumlah[]" id="jumlah${index}${nmr_urut}">`,
                    `<input type="text" class="form-control" id="subtotal${index}${nmr_urut}" readonly><input type="hidden" name="subtotal[]" id="subtotal_asli${index}${nmr_urut}" readonly>`,
                    `KURS`,
                    `<input type="text" class="form-control" onkeyup="sum_total('${index}${nmr_urut}', '${nmr_urut}','${jenis}');" name="diskon[]" id="diskon${index}${nmr_urut}">`,
                    `<input type="hidden" name="total_pajak[]" id="total_pajak${index}${nmr_urut}" onchange="sum_total('${index}${nmr_urut}', '${nmr_urut}','${jenis}');">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pajak${index}${nmr_urut}" title="Tambah Pajak">
                        <i class="fas fa-balance-scale"></i>
                    </button>`,
                    `<input type="hidden" name="biayapengiriman[]" id="biaya_pengiriman${index}${nmr_urut}" onchange="sum_total('${index}${nmr_urut}', '${nmr_urut}','${jenis}');">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pengiriman${index}${nmr_urut}" title="Tambah Biaya Pengiriman">
                        <i class="fas fa-shipping-fast"></i>
                    </button>`,
                    `${noakun}`,
                    `<input type="text" class="form-control" name="total[]" id="total${index}${nmr_urut}" readonly>`,
                    `<a href="javascript:EditDetail('${edit_isiitem[index].value}','${jenis}','${nmr_urut}')" class="edit_detail${edit_isiitem[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp
                        <a href="javascript:delete_detail_item('${nmr_urut}')" class="delete_detail_item text-danger"><i class="fas fa-trash"></i></a>`,
                    `${edit_jenisitem}`
                ]).draw( false );
                detail_array_item();
                total_total_item[nmr_urut]    = [];
                total_total_item[nmr_urut].push(0);
                total_semua("item");
            }
            $('#modal_edit_detail_item').modal('hide');
        }else{
            var formData        = new FormData($('#form_edit_budgetevent')[0]);
            var edit_rowindex   = $('input[name=edit_rowindex_budgetevent]').val();
            var edit_jenisitem  = "budgetevent";
            var noakun          = 0;
            var edit_isiitem    = $('.edit_budgeteventid :selected');
            var nmr_urut        = $('.nmr_urut_budgetevent').val();

            for (var index = 0; index < edit_isiitem.length; index++) {
                var id    = edit_isiitem[index].value;
                var item    = edit_isiitem[index].text;
                if(tabel_detail_budgetevent.hasValue(id)) {
                        swal("Gagal!", "Item sudah ada", "error");
                        return;
                }

                noakun   = $('#noakun1'+edit_isiitem[index].value).val();
                $('#noakun1'+edit_isiitem[index].value).remove();

                tabel_detail_budgetevent.row(edit_rowindex).data([
                    edit_isiitem[index].value,
                    item,
                    `<input type="text" class="form-control" onkeyup="sum('${index}${nmr_urut}', '${nmr_urut}','${jenis}');" name="harga1[]" id="harga1${index}${nmr_urut}">`,
                    `<input type="text" class="form-control" onkeyup="sum('${index}${nmr_urut}', '${nmr_urut}','${jenis}');" name="jumlah1[]" id="jumlah1${index}${nmr_urut}">`,
                    `<input type="text" class="form-control" id="subtotal1${index}${nmr_urut}" readonly><input type="hidden" name="subtotal1[]" id="subtotal_asli1${index}${nmr_urut}" readonly>`,
                    `KURS`,
                    `<input type="text" class="form-control" onkeyup="sum_total('${index}${nmr_urut}', '${nmr_urut}','${jenis}');" name="diskon1[]" id="diskon1${index}${nmr_urut}">`,
                    `<input type="hidden" name="total_pajak1[]" id="total_pajak1${index}${nmr_urut}" onchange="sum_total('${index}${nmr_urut}', '${nmr_urut}','${jenis}');">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pajak1${index}${nmr_urut}" title="Tambah Pajak">
                        <i class="fas fa-balance-scale"></i>
                    </button>`,
                    `<input type="hidden" name="biayapengiriman1[]" id="biaya_pengiriman1${index}${nmr_urut}" onchange="sum_total('${index}${nmr_urut}', '${nmr_urut}','${jenis}');">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pengiriman1${index}${nmr_urut}" title="Tambah Biaya Pengiriman">
                        <i class="fas fa-shipping-fast"></i>
                    </button>`,
                    `${noakun}`,
                    `<input type="text" class="form-control" name="total1[]" id="total1${index}${nmr_urut}" readonly>`,
                    `<a href="javascript:EditDetail('${edit_isiitem[index].value}','${jenis}','${nmr_urut}')" class="edit_detail${edit_isiitem[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp
                        <a href="javascript:delete_detail_budgetevent('${nmr_urut}')" class="delete_detail_budgetevent  text-danger"><i class="fas fa-trash"></i></a>`,
                    `${edit_jenisitem}`
                ]).draw( false );
                detail_array_budgetevent();
                total_total_budgetevent[nmr_urut]    = [];
                total_total_budgetevent[nmr_urut].push(0);
                total_semua("budgetevent");
            }      
            $('#modal_edit_detail_budgetevent').modal('hide');
        }
    }

    //setting keyup format rupiah
    function UbahInputRUpiah(nama_inputan){
        $(nama_inputan).on('keyup',function(){
            var nilai= $(this).val();
            $(this).val(formatRupiah(String(nilai)));
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
        $('input[name=tum]').val(formatRupiah(String(hasil_um_term))) + ',00'; 
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