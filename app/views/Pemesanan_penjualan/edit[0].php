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
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="form1" action="javascript:update()">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control idpemesanan" readonly name="idpemesanan" value="{id}">
                                        <div class="form-group">
                                            <label><?php echo lang('notrans') ?>:</label>
                                            <input type="text" class="form-control"readonly name="notrans" placeholder="AUTO">
                                        </div>
                                        <div class="form-group" id="rekanan">
                                            <label><?php echo lang('rekanan') ?>:</label>
                                            <select class="form-control kontakid" name="kontakid"></select>
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
                                    </div>
                                    <div class="col-md-3">
                                    <div class="form-group">
                                            <label><?php echo lang('Jenis Penjualan') ?>:</label>
                                            <select class="form-control jenis_penjualan" name="jenis_penjualan" required>
                                                <?php 
                                                    if($jenis_pembelian == 'barang'){
                                                        echo '<option value="barang" selected>Barang</option>>';
                                                    }else{
                                                        echo '<option value="barang">Barang</option>';
                                                    }
                                                    if ($jenis_pembelian == 'jasa'){
                                                        echo '<option value="jasa" select>Jasa</option>';
                                                    }else{
                                                        echo '<option value="jasa">Jasa</option>';
                                                    }
                                                    if ($jenis_pembelian == 'barang_dan_jasa'){
                                                        echo '<option value="barang_dan_jasa" selected>Barang dan Jasa</option>';
                                                    }else{
                                                        echo '<option value="barang_dan_jasa">Barang dan Jasa</option>';
                                                    }
                                                ?> 
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo lang('Jenis Barang') ?>:</label>
                                            <select class="form-control jenis_barang" name="jenis_barang" required>
                                                <?php 
                                                    if($jenis_barang == 'barang_dagangan'){
                                                        echo '<option value="barang_dagangan" selected>Barang Dagangan</option>';
                                                    }else{
                                                        echo '<option value="barang_dagangan">Barang Dagangan</option>';
                                                    }
                                                    if ($jenis_barang == 'inventaris'){
                                                        echo '<option value="inventaris" selected>Inventaris</option> ';
                                                    }else{
                                                        echo '<option value="inventaris">Inventaris</option> ';
                                                    }
                                                    if ($jenis_barang == 'barang_dan_jasa'){
                                                        echo '<option value="barang_dan_jasa" selected>Barang dan Jasa</option>';
                                                    }else{
                                                        echo '<option value="barang_dan_jasa">Barang dan Jasa</option>';
                                                    }
                                                ?>   
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo lang('Cara Pembayaran') ?>:</label>
                                            <select class="form-control cara_pembayaran" name="cara_pembayaran" required>
                                                <?php 
                                                    if($cara_pembayaran == 'cash'){
                                                        echo '<option value="cash" selected>Cash</option>';
                                                    }else{
                                                        echo '<option value="cash">Cash</option>';
                                                    }
                                                    if ($cara_pembayaran == 'credit'){
                                                        echo '<option value="credit" selected>Credit</option>';
                                                    }else{
                                                        echo '<option value="credit">Credit</option>';
                                                    }
                                                ?>                                        
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

                                  
                                    <table class="table table-bordered" id="tabel_detail" width="100%">
                                        <thead class="{bg_header}">
                                            <tr>
                                                <th>ID</th>
                                                <th class="text-center"><?php echo lang('name') ?></th>
                                                <th class="text-center"><?php echo lang('price') ?></th>
                                                <th class="text-center"><?php echo lang('qty') ?></th>
                                                <th class="text-center"><?php echo lang('subtotal') ?></th>
                                                <th class="text-center"><?php echo lang('kurs mata uang') ?></th>
                                                <th class="text-center"><?php echo lang('discount') ?></th>
                                                <th class="text-center"><?php echo lang('ppn') ?></th>
                                                <th class="text-center"><?php echo lang('total') ?></th>
                                                <th class="text-center"><?php echo lang('action') ?></th>
                                                <th class="text-center"><?php echo lang('tipe') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody> </tbody>
                                        <tfoot class="bg-light">
                                            <tr>
                                                <th>ID</th>
                                                <th colspan="6">&nbsp;</th>
                                                <th class="text-right"><?php echo lang('total') ?></th>
                                                <th class="text-center" id="total_total"></th>
                                                <th><input type="hidden" name="total_penjualan" class="total_penjualan"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                   
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo lang('note') ?>:</label>
                                            <textarea class="form-control catatan" name="catatan" rows="6">{catatan}</textarea>
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
                                </div>
                      
                                <input type="text" name="detail_array" id="detail_array">
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="text-right">
                                    <div class="btn-group">
                                        <a href="{site_url}Pemesanan_penjualan" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                                        <button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
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

<!-- modal tambah barang -->
<div id="modal_add_detail_barang" class="modal fade">
    <div class="modal-dialog">
        <form action="javascript:save_detail_barang(0)" id="form2">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title"><?php echo lang('add_new') ?></h5>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="rowindex_barang">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo lang('item') ?>:</label>
                                <select class="form-control itemid" name="itemid[]" required style="width:100%" multiple>
                                </select>
                            </div>
                        </div>
                        <table class="table">
                            <tbody id='list_barang'>

                            </tbody>
                        </table>
                        <div id="detail_barang"></div>
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
<!-- modal tambah Jasa -->
<div id="modal_add_detail_jasa" class="modal fade">
    <div class="modal-dialog">
        <form action="javascript:save_detail_jasa(0)" id="form4">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title"><?php echo lang('add_new') ?></h5>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="rowindex_jasa">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo lang('Jasa') ?>:</label>
                                <select class="form-control jasaid" name="jasaid[]" required style="width:100%" multiple>
                                </select>
                            </div>
                        </div>
                        <table class="table">
                            <tbody id='list_jasa'>

                            </tbody>
                        </table>
                        <div id="detail_jasa"></div>
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
<!-- modal tambah Budget Event -->
<div id="modal_add_detail_budgetevent" class="modal fade">
    <div class="modal-dialog">
        <form action="javascript:save_detail_budgetevent(0)" id="form6">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title"><?php echo lang('add_new') ?></h5>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="rowindex_budgetevent">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo lang('Budget Event') ?>:</label>
                                <select class="form-control budgeteventid" name="budgeteventid[]" required style="width:100%" multiple>
                                </select>
                            </div>
                        </div>
                        <table class="table">
                            <tbody id='list_budgetevent'>

                            </tbody>
                        </table>
                        <div id="detail_budgetevent"></div>
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


<!-- modal edit barang -->
<div id="modal_edit_detail_barang" class="modal fade">
    <div class="modal-dialog">
        <form action="javascript:save_edit_detail_barang()" id="form3" enctype="multipart/form-data" method="POST">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Edit Detail</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="edit_rowindex_barang">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo lang('item') ?>:</label>
                                <select class="form-control edit_itemid" name="edit_itemid[]" required style="width:100%">
                                </select>
                            </div>
                        </div>
                        <table class="table">
                            <tbody id='edit_list_barang'>

                            </tbody>
                        </table>
                        <div id="detail_barang_edit"></div>
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
<!-- modal edit jasa -->
<div id="modal_edit_detail_jasa" class="modal fade">
    <div class="modal-dialog">
        <form action="javascript:save_edit_detail_jasa()" id="form5" enctype="multipart/form-data" method="POST">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Edit Detail</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="edit_rowindex_jasa">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo lang('item') ?>:</label>
                                <select class="form-control edit_jasaid" name="edit_jasaid[]" required style="width:100%">
                                </select>
                            </div>
                        </div>
                        <table class="table">
                            <tbody id='edit_list_jasa'>

                            </tbody>
                        </table>
                        <div id="edit_detail_jasa"></div>
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
<!-- modal edit budgetevent -->
<div id="modal_edit_detail_budgetevent" class="modal fade">
    <div class="modal-dialog">
        <form action="javascript:save_edit_detail_budgetevent()" id="form7" enctype="multipart/form-data" method="POST">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Edit Detail</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="edit_rowindex_budgetevent">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo lang('item') ?>:</label>
                                <select class="form-control edit_budgeteventid" name="edit_budgeteventid[]" required style="width:100%">
                                </select>
                            </div>
                        </div>
                        <table class="table">
                            <tbody id='edit_list_budgetevent'>

                            </tbody>
                        </table>
                        <div id="edit_detail_budgetevent"></div>
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

<script>
    var base_url        = '{site_url}Pemesanan_penjualan/';
    var total_total     = [];
    $.fn.dataTable.Api.register( 'hasValue()' , function(value) {
        return this .data() .toArray() .toString() .toLowerCase() .split(',') .indexOf(value.toString().toLowerCase())>-1
    })


    //datatable
    var tabel_detail = $('#tabel_detail').DataTable({
        sort: false,
        info: false,
        searching: false,
        paging: false,
        columnDefs: [
            {targets: [0,10], visible: false},
            {targets: [8], className: 'text-right'},
        ],
        
    })

    $(document).ready(function(){
        //isi combobox kontak, gudang, perusahaan, departemen, pejabat
        ajax_select({ id: '.kontakid', url: base_url + 'select2_kontak', selected: { id: '{kontakid}' } });
        ajax_select({ id: '.gudangid', url: base_url + 'select2_gudang', selected: { id: '{gudangid}' } });
        ajax_select({id: '#perusahaan', url: base_url + 'select2_mperusahaan', selected: { id: '{idperusahaan}' } });
        ajax_select({id: '#departemen', url: base_url + 'select2_mdepartemen/{departemen}', selected: { id: '{departemen}' } });
        ajax_select({id: '#pejabat', url: base_url + 'select2_mdepartemen_pejabat/{pejabat}', selected: { id: '{pejabat}' } });
        //menyembunyikan button tambah
        $('.btn_add_detail_barang').attr("hidden", false);
        $('.btn_add_detail_jasa').attr("hidden", true);
        $('.btn_add_detail_budgetevent').attr("hidden", true);
    })

    //mengisi combobox depatemen
    $('#perusahaan').change(function(e) {
        $("#departemen").val($("#departemen").data("default-value"));
        $("#pejabat").val($("#pejabat").data("default-value"));
        var perusahaanId = $('#perusahaan').children('option:selected').val();
        ajax_select({
            id: '#departemen',
            url: base_url + 'select2_mdepartemen/' + perusahaanId,
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
        if ($(this).val() == 'jasa') {
            $('.jenis_barang').attr("disabled", true);
            $('#rekanan').empty();
            $('#gudang').empty();
            $('.btn_add_detail_barang').attr("hidden", true);
            $('.btn_add_detail_jasa').attr("hidden", false);
            $('.btn_add_detail_budgetevent').attr("hidden", false);
        } else if ($(this).val() == 'barang'){ 
            $('.jenis_barang').attr("disabled", false);
            $('.btn_add_budget_event').attr("hidden", true);
            $('#rekanan').html(`
                <label><?php echo lang('rekanan') ?>:</label>
                <select class="form-control kontakid" name="kontakid"></select>
            `);
            $('#gudang').html(`
                <label><?php echo lang('gudang') ?>:</label>
                <select class="form-control gudangid" name="gudangid"></select>
            `);
            ajax_select({ id: '.kontakid', url: base_url + 'select2_kontak', selected: { id: null } });
            ajax_select({ id: '.gudangid', url: base_url + 'select2_gudang', selected: { id: null } });
            $('.btn_add_detail_barang').attr("hidden", false);
            $('.btn_add_detail_jasa').attr("hidden", true);
            $('.btn_add_detail_budgetevent').attr("hidden", true);
            $('.jenis_barang').prop("selectedIndex", 0);
        }else{  
            $('.jenis_barang').attr("disabled", false);
            $('.btn_add_budget_event').attr("hidden", true);
            $('#rekanan').html(`
                <label><?php echo lang('rekanan') ?>:</label>
                <select class="form-control kontakid" name="kontakid"></select>
            `);
            $('#gudang').html(`
                <label><?php echo lang('gudang') ?>:</label>
                <select class="form-control gudangid" name="gudangid"></select>
            `);
            ajax_select({ id: '.kontakid', url: base_url + 'select2_kontak', selected: { id: null } });
            ajax_select({ id: '.gudangid', url: base_url + 'select2_gudang', selected: { id: null } });
            $('.jenis_barang').prop("selectedIndex", 2);
            var jenis_penjualan = $('.jenis_penjualan').val();
            var jenis_barang = $('.jenis_barang').val();
            if ((jenis_penjualan == 'barang_dan_jasa') && (jenis_barang == 'barang_dan_jasa'))
            {
                $('.btn_add_detail_barang').attr("hidden", false);
                $('.btn_add_detail_jasa').attr("hidden", false);
                $('.btn_add_detail_budgetevent').attr("hidden", false);
            }
        }
        tabel_detail.clear().draw();
        $('#total_total').html('');
        $('#detail_array').val('');
    })

     //perubahan saat jenis barang diganti
    $(document).on('change','.jenis_barang',function(){
        $('#total_total').html('');
        tabel_detail.clear().draw();
    })

    //menampilkan modal barang
    $(document).on('click','.btn_add_detail_barang',function(){
       $('#modal_add_detail_barang').modal('show');
        $('.itemid').empty();
        var jenis_barang = $('.jenis_barang').val();
        var idgudang = $('.gudangid').val();
        switch (jenis_barang) {
            case 'barang_dagangan':
                url = base_url + 'select2_item'+ '/'+ idgudang +'/'+idgudang;
                break;
            case 'inventaris':
                url = base_url + 'select2_item_inventaris';
                break;
            case 'barang_dan_jasa':
                url = base_url + 'select2_item'+ '/'+ idgudang +'/'+idgudang;
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
                for (let index = 0; index < data.length; index++) {
                    isi += `<option value="${data[index].id}">${data[index].text}</option>`
                }
                $('.itemid').append(isi);
            }
        })
        $('.itemid').select2();
    })

    //menampilkan modal jasa
    $(document).on('click','.btn_add_detail_jasa',function(){
        $('#modal_add_detail_jasa').modal('show');
        $('.jasaid').empty();
        $.ajax({
            url         : base_url + 'select2_item_jasa',
            method      : 'post',
            datatype    : 'json',
            success: function(data) {
                isi = "";
                for (let index = 0; index < data.length; index++) {
                    isi += `<option value="${data[index].id}">${data[index].text}</option>`
                }
                $('.jasaid').append(isi);
            }
        })
        $('.jasaid').select2();
    })

    //menampilkan modal budgetevent
    $(document).on('click','.btn_add_detail_budgetevent',function(){
        $('#modal_add_detail_budgetevent').modal('show');
        $('.budgeteventid').empty();
        $.ajax({
            url         : base_url + 'aa',
            method      : 'post',
            datatype    : 'json',
            success: function(data) {
                isi = "";
                for (let index = 0; index < data.length; index++) {
                    isi += `<option value="${data[index].id}">${data[index].text}</option>`
                }
                $('.budgeteventid').append(isi);
            }
        })
        $('.budgeteventid').select2();
    })

    //save detail barang
    function save_detail_barang(no) {
        var form            = $('#form2')[0];
        var formData        = new FormData(form);
        var barang          = $('.itemid :selected');
        var no_baru         = no + 1;
        for (let index = 0; index < barang.length; index++) {
            var id    = barang[index].value;
            var item    = barang[index].text;
            if(tabel_detail.hasValue(id)) {
                swal("Gagal!", "Item sudah ada", "error");
                return;
            }
            tabel_detail.row.add([
                barang[index].value,
                item,
                `<input type="text" class="form-control" onkeyup="sum('${index}${no}', '${no}');" name="harga[]" id="harga${index}${no}">`,
                `<input type="text" class="form-control" onkeyup="sum('${index}${no}', '${no}');" name="jumlah[]" id="jumlah${index}${no}">`,
                `<input type="text" class="form-control" id="subtotal${index}${no}" readonly><input type="hidden" name="subtotal[]" id="subtotal_asli${index}${no}" readonly>`,
                `KURS KOSONG`,
                `<input type="text" class="form-control" onkeyup="sum_total('${index}${no}', '${no}');" name="diskon[]" id="diskon${index}${no}">`,
                `<input type="text" class="form-control" onkeyup="sum_total('${index}${no}', '${no}');" name="ppn[]" id="ppn${index}${no}">`,
                `<input type="text" class="form-control" name="total[]" id="total${index}${no}" readonly>`,
                `<a href="javascript:void(0)" class="edit_detail_barang" id_barang="${barang[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp; 
                    <a href="javascript:void(0)" class="delete_detail text-danger"><i class="fas fa-trash"></i></a>`,
                `barang`
            ]).draw( false );
            
            detail_array();
            no++;
        }
        $('#modal_add_detail_barang').modal('hide');
        $('#form2').attr('action', 'javascript:save_detail_barang('+no_baru+')');
        total_total.push(no);
    }

    //save detail jasa
    function save_detail_jasa(no) {
        var form            = $('#form4')[0];
        var formData        = new FormData(form);
        var jasa          = $('.jasaid :selected');
        var no_baru         = no + 1;
        var jenis_penjualan    = $('.jenis_penjualan').val();
        for (let index = 0; index < jasa.length; index++) {
            var id    = jasa[index].value;
            var jasatext    = jasa[index].text;
            if(tabel_detail.hasValue(id)) {
                swal("Gagal!", "Item sudah ada", "error");
                return;
            }
            tabel_detail.row.add([
                jasa[index].value,
                jasatext,
                `<input type="text" class="form-control" onkeyup="sum('${index}${no}', '${no}');" name="harga[]" id="harga${index}${no}">`,
                `<input type="text" class="form-control" onkeyup="sum('${index}${no}', '${no}');" name="jumlah[]" id="jumlah${index}${no}">`,
                `<input type="text" class="form-control" id="subtotal${index}${no}" readonly><input type="hidden" name="subtotal[]" id="subtotal_asli${index}${no}" readonly>`,
                `KURS KOSONG`,
                `<input type="text" class="form-control" onkeyup="sum_total('${index}${no}', '${no}');" name="diskon[]" id="diskon${index}${no}">`,
                `<input type="text" class="form-control" onkeyup="sum_total('${index}${no}', '${no}');" name="ppn[]" id="ppn${index}${no}">`,
                `<input type="text" class="form-control" name="total[]" id="total${index}${no}" readonly>`,
                `<a href="javascript:void(0)" class="edit_detail_jasa" id_jasa="${jasa[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp; <a href="javascript:void(0)" class="delete_detail text-danger"><i class="fas fa-trash"></i></a>`,
                `jasa`
            ]).draw( false );
                    
            detail_array();
            no++;
        }
        $('#modal_add_detail_jasa').modal('hide');
        $('#form4').attr('action', 'javascript:save_detail_jasa('+no_baru+')');
        total_total.push(no);
    }

     //save detail budget event
    function save_detail_budgetevent(no) {
        var form            = $('#form6')[0];
        var formData        = new FormData(form);
        var budget          = $('.budgeteventid :selected');
        var no_baru         = no + 1;
        for (let index = 0; index < budget.length; index++) {
            var id    = budget[index].value;
            var budgetevent    = budget[index].text;
            if(tabel_detail.hasValue(id)) {
                swal("Gagal!", "Item sudah ada", "error");
                return;
            }
            tabel_detail.row.add([
                budget[index].value,
                budgetevent,
                `<input type="text" class="form-control" onkeyup="sum('${index}${no}', '${no}');" name="harga[]" id="harga${index}${no}">`,
                `<input type="text" class="form-control" onkeyup="sum('${index}${no}', '${no}');" name="jumlah[]" id="jumlah${index}${no}">`,
                `<input type="text" class="form-control" id="subtotal${index}${no}" readonly><input type="hidden" name="subtotal[]" id="subtotal_asli${index}${no}" readonly>`,
                `KURS KOSONG`,
                `<input type="text" class="form-control" onkeyup="sum_total('${index}${no}', '${no}');" name="diskon[]" id="diskon${index}${no}">`,
                `<input type="text" class="form-control" onkeyup="sum_total('${index}${no}', '${no}');" name="ppn[]" id="ppn${index}${no}">`,
                `<input type="text" class="form-control" name="total[]" id="total${index}${no}" readonly>`,
                `<a href="javascript:void(0)" class="edit_detail_budgetevent" id_budgetevent="${budget[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp; <a href="javascript:void(0)" class="delete_detail text-danger"><i class="fas fa-trash"></i></a>`,
                `budgetevent`
            ]).draw( false );
                    
            detail_array();
            no++;
        }
        $('#modal_add_detail_budgetevent').modal('hide');
        $('#form6').attr('action', 'javascript:save_detail_budgetevent('+no_baru+')');
        total_total.push(no);
    }

    //detail array keseluruhan
    function detail_array() {
        var arr = tabel_detail.data().toArray();
        $('#detail_array').val( JSON.stringify(arr) );
    }

    //edit data barang
    $('#tabel_detail tbody').on('click','.edit_detail_barang',function(){
        var id          = $('.edit_detail_barang').attr('id_barang'); 
        var tr          = tabel_detail.row($(this).parents('tr')).index();
        var rowindex    = tabel_detail.row($(this).parents('tr')).index();
        $('input[name=edit_rowindex_barang]').val(rowindex);
        var idgudang = $('.gudangid').val();
        var jenis_barang = $('.jenis_barang').val();
        if (jenis_barang == 'barang_dagangan'){
            url = base_url + 'select2_item'+'/'+id+'/'+idgudang;
        }else if (jenis_barang == 'inventaris'){
            url = base_url + 'select2_item_inventaris';
        }else{
            url = base_url + 'select2_item'+'/'+id+'/'+idgudang;
        }
        ajax_select({ id: '.edit_itemid', url: url, selected: { id: id } });
        $('#modal_edit_detail_barang').modal('show');
    })
    //edit data jasa
    $('#tabel_detail tbody').on('click','.edit_detail_jasa',function(){
        var id          = $('.edit_detail_jasa').attr('id_jasa'); 
        var rowindex    = tabel_detail.row($(this).parents('tr')).index();
        $('input[name=edit_rowindex_jasa]').val(rowindex);
        url = base_url + 'select2_item_jasa';
        ajax_select({ id: '.edit_jasaid', url: url, selected: { id: id } });
        $('#modal_edit_detail_jasa').modal('show');
    })
    //edit data budget event
    $('#tabel_detail tbody').on('click','.edit_detail_budgetevent',function(){
        var id          = $('.edit_detail_budgetevent').attr('id_budgetevent'); 
        var rowindex    = tabel_detail.row($(this).parents('tr')).index();
        $('input[name=edit_rowindex_budgetevent]').val(rowindex);
        url = base_url + 'aa';
        ajax_select({ id: '.edit_budgeteventid', url: url, selected: { id: id } });
        $('#modal_edit_detail_budgetevent').modal('show');
    })

    //simpan edit barang
    function save_edit_detail_barang(no) {
        var formData        = new FormData($('#form3')[0]);
        var rowindex_barang = formData.get('edit_rowindex_barang');
        var barang          = $('.edit_itemid :selected');
        for (let index = 0; index < barang.length; index++) {
            var id    = barang[index].value;
            var item    = barang[index].text;
            if(tabel_detail.hasValue(id)) {
                swal("Gagal!", "Item sudah ada", "error");
                return;
            }
            tabel_detail.row(rowindex_barang).data([
                barang[index].value,
                item,
                `<input type="text" class="form-control" onkeyup="sum('${index}${rowindex_barang}', '${rowindex_barang}');" name="harga[]" id="harga${index}${rowindex_barang}">`,
                `<input type="text" class="form-control" onkeyup="sum('${index}${rowindex_barang}', '${rowindex_barang}');" name="jumlah[]" id="jumlah${index}${rowindex_barang}">`,
                `<input type="text" class="form-control" id="subtotal${index}${rowindex_barang}" readonly><input type="hidden" name="subtotal[]" id="subtotal_asli${index}${rowindex_barang}" readonly>`,
                `KURS KOSONG`,
                `<input type="text" class="form-control" onkeyup="sum_total('${index}${rowindex_barang}', '${rowindex_barang}');" name="diskon[]" id="diskon${index}${rowindex_barang}">`,
                `<input type="text" class="form-control" onkeyup="sum_total('${index}${rowindex_barang}', '${rowindex_barang}');" name="ppn[]" id="ppn${index}${rowindex_barang}">`,
                `<input type="text" class="form-control" name="total[]" id="total${index}${rowindex_barang}" readonly>`,
                `<a href="javascript:void(0)" class="edit_detail_barang" id_barang="${barang[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                    <a href="javascript:void(0)" class="delete_detail text-danger" onclick="delete_detail('${no}')"><i class="fas fa-trash"></i></a>`,
                `barang`
            ]).draw( false );
            detail_array();
            rowindex_barang++;
        }
        $('#modal_edit_detail_barang').modal('hide');
    }

    //save edit jasa 
    function save_edit_detail_jasa(no) {
        var formData        = new FormData($('#form5')[0]);
        var edit_rowindex_jasa = formData.get('edit_rowindex_jasa');
        var jasa          = $('.edit_jasaid :selected');
        for (let index = 0; index < jasa.length; index++) {
            var id    = jasa[index].value;
            var jasatext    = jasa[index].text;
            if(tabel_detail.hasValue(id)) {
                swal("Gagal!", "Item sudah ada", "error");
                return;
            }
            tabel_detail.row(edit_rowindex_jasa).data([
                jasa[index].value,
                jasatext,
                `<input type="text" class="form-control" onkeyup="sum('${index}${edit_rowindex_jasa}', '${edit_rowindex_jasa}');" name="harga[]" id="harga${index}${edit_rowindex_jasa}">`,
                `<input type="text" class="form-control" onkeyup="sum('${index}${edit_rowindex_jasa}', '${edit_rowindex_jasa}');" name="jumlah[]" id="jumlah${index}${edit_rowindex_jasa}">`,
                `<input type="text" class="form-control" id="subtotal${index}${edit_rowindex_jasa}" readonly><input type="hidden" name="subtotal[]" id="subtotal_asli${index}${edit_rowindex_jasa}" readonly>`,
                `KURS KOSONG`,
                `<input type="text" class="form-control" onkeyup="sum_total('${index}${edit_rowindex_jasa}', '${edit_rowindex_jasa}');" name="diskon[]" id="diskon${index}${edit_rowindex_jasa}">`,
                `<input type="text" class="form-control" onkeyup="sum_total('${index}${edit_rowindex_jasa}', '${edit_rowindex_jasa}');" name="ppn[]" id="ppn${index}${edit_rowindex_jasa}">`,
                `<input type="text" class="form-control" name="total[]" id="total${index}${edit_rowindex_jasa}" readonly>`,
                `<a href="javascript:void(0)" class="edit_detail_jasa" id_jasa="${jasa[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                    <a href="javascript:void(0)" class="delete_detail text-danger" onclick="delete_detail('${no}')"><i class="fas fa-trash"></i></a>`,
                `jasa`
            ]).draw( false );
                
            detail_array();
            edit_rowindex_jasa++;
        }
        $('#modal_edit_detail_jasa').modal('hide');
    }

    //save edit budgetevent 
    function save_edit_detail_budgetevent(no) {
        var formData        = new FormData($('#form7')[0]);
        var edit_rowindex_budgetevent = formData.get('edit_rowindex_budgetevent');
        var budgetevent          = $('.edit_budgeteventid :selected');
        for (let index = 0; index < budgetevent.length; index++) {
            var id    = budgetevent[index].value;
            var budgeteventtext    = budgetevent[index].text;
            if(tabel_detail.hasValue(id)) {
                swal("Gagal!", "Item sudah ada", "error");
                return;
            }
            tabel_detail.row(edit_rowindex_budgetevent).data([
                budgetevent[index].value,
                budgeteventtext,
                `<input type="text" class="form-control" onkeyup="sum('${index}${edit_rowindex_budgetevent}', '${edit_rowindex_budgetevent}');" name="harga[]" id="harga${index}${edit_rowindex_budgetevent}">`,
                `<input type="text" class="form-control" onkeyup="sum('${index}${edit_rowindex_budgetevent}', '${edit_rowindex_budgetevent}');" name="jumlah[]" id="jumlah${index}${edit_rowindex_budgetevent}">`,
                `<input type="text" class="form-control" id="subtotal${index}${edit_rowindex_budgetevent}" readonly><input type="hidden" name="subtotal[]" id="subtotal_asli${index}${edit_rowindex_budgetevent}" readonly>`,
                `KURS KOSONG`,
                `<input type="text" class="form-control" onkeyup="sum_total('${index}${edit_rowindex_budgetevent}', '${edit_rowindex_budgetevent}');" name="diskon[]" id="diskon${index}${edit_rowindex_budgetevent}">`,
                `<input type="text" class="form-control" onkeyup="sum_total('${index}${edit_rowindex_budgetevent}', '${edit_rowindex_budgetevent}');" name="ppn[]" id="ppn${index}${edit_rowindex_budgetevent}">`,
                `<input type="text" class="form-control" name="total[]" id="total${index}${edit_rowindex_budgetevent}" readonly>`,
                `<a href="javascript:void(0)" class="edit_detail_budgetevent" id_budgetevent="${budgetevent[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                    <a href="javascript:void(0)" class="delete_detail text-danger" onclick="delete_detail('${no}')"><i class="fas fa-trash"></i></a>`,
                `budgetevent`
            ]).draw( false );
                
            detail_array();
            edit_rowindex_budgetevent++;
        }
        $('#modal_edit_detail_budgetevent').modal('hide');
    }
    
    //hapus isi tabel barang dagangan
    $('#tabel_detail tbody').on('click','.delete_detail',function(){
        var rowindex    = tabel_detail.row($(this).parents('tr')).index();
        tabel_detail.row($(this).parents('tr')).remove().draw();
        detail_array();
        total_total.splice(rowindex, 1);
        total_semua();
    })

    //hitung subtotal dan total
    function sum(no, no1) { 
        var txtFirstNumberValue                     = document.getElementById('harga'+no).value.replace(/[^,\d]/g, '').toString();    
        document.getElementById('harga'+no).value   = formatRupiah(txtFirstNumberValue, 'Rp.');
        var txtSecondNumberValue                    = document.getElementById('jumlah'+no).value;
        var result                                  = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
        if (isNaN(parseInt(txtFirstNumberValue))) {
            var result  = 0;    
        }
        if (isNaN(parseInt(txtSecondNumberValue))) {
            var result  = 0;    
        }
        if (!isNaN(result)) {
            document.getElementById('subtotal'+no).value        = formatRupiah(String(result), 'Rp.');
            document.getElementById('subtotal_asli'+no).value   = result;
            document.getElementById('total'+no).value           = formatRupiah(String(result), 'Rp.');
        }
        else if(txtFirstNumberValue !=null && txtSecondNumberValue == null){
            document.getElementById('subtotal'+no).value = txtFirstNumberValue;
            document.getElementById('total'+no).value = txtFirstNumberValue;
        }else{
            document.getElementById('subtotal'+no).value        = formatRupiah(String(result), 'Rp.');
            document.getElementById('subtotal_asli'+no).value   = result;
            document.getElementById('total'+no).value           = formatRupiah(String(result), 'Rp.');
        }
        total_total[no1] = [];
        total_total[no1].push(parseInt(result));
        total_semua();
    }

    //hitung total dengan diskon dan ppn
    function sum_total(no, no1) {   
        var subtotal            = document.getElementById('subtotal_asli'+no).value;
        var diskon              = document.getElementById('diskon'+no).value;
        if (isNaN(parseInt(diskon))) {
            var subtotal_baru   = parseInt(subtotal);    
        } else {
            var subtotal_baru   = parseInt(subtotal) - (parseInt(diskon) * parseInt(subtotal)/100);
        }
        var ppn                 = document.getElementById('ppn'+no).value;
        if (isNaN(parseInt(ppn))) {
            var total   = parseInt(subtotal_baru);    
        } else {
            var total   = parseInt(subtotal_baru) + (parseInt(ppn) * parseInt(subtotal_baru)/100);
        }
        document.getElementById('total'+no).value = formatRupiah(String(total), 'Rp.');
        total_total[no1]    = [];
        total_total[no1].push((parseInt(total)));
        total_semua();
    }

    //hitung total tabel
    function total_semua() {
        a  = 0;
        total_total.forEach(b => {
            a   += parseInt(b);
        });
        var hasil = formatRupiah(String(a), 'Rp. ');
        $('#total_total').html(hasil);
        $('.total_penjualan').val(hasil);
    }


    // isi tabel (detail pemesanan)
     $(document).ready(function(){
        //mengambil detail angsuran
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
                    var tipe_item = data[i].tipe;
                    grandtotal = grandtotal + parseInt(data[i].total);
                    if (tipe_item == 'barang'){
                        tabel_detail.row.add([
                            data[i].itemid,
                            data[i].item,
                            `<input type="text" class="form-control" onkeyup="sum('${i}${no}', '${no}');" name="harga[]" id="harga${i}${no}" value="${formatRupiah(data[i].harga,'Rp. ')}">`,
                            `<input type="text" class="form-control" onkeyup="sum('${i}${no}', '${no}');" name="jumlah[]" id="jumlah${i}${no}" value="${data[i].jumlah}">`,
                            `<input type="text" class="form-control" id="subtotal${i}${no}" readonly value="${formatRupiah(data[i].subtotal,'Rp. ')}"><input type="hidden" name="subtotal[]" id="subtotal_asli${i}${no}" readonly value="${formatRupiah(data[i].subtotal,'Rp. ')}">`,
                            `KURS KOSONG`,
                            `<input type="text" class="form-control" onkeyup="sum_total('${i}${no}', '${no}');" name="diskon[]" id="diskon${i}${no}" value="${data[i].diskon}">`,
                            `<input type="text" class="form-control" onkeyup="sum_total('${i}${no}', '${no}');" name="ppn[]" id="ppn${i}${no}" value="${data[i].ppn}">`,
                            `<input type="text" class="form-control" name="total[]" id="total${i}${no}" readonly value="${formatRupiah(data[i].total,'Rp. ')}">`,
                            `<a href="javascript:void(0)" class="edit_detail_barang" id_barang="${data[i].itemid}"><i class="fas fa-pencil-alt"></i></a>&nbsp; <a href="javascript:void(0)" class="delete_detail text-danger"><i class="fas fa-trash"></i></a>`,
                            `${data[i].tipe}`
                        ]).draw( false );
                    }else if (tipe_item == 'jasa'){
                        tabel_detail.row.add([
                            data[i].itemid,
                            data[i].item,
                            `<input type="text" class="form-control" onkeyup="sum('${i}${no}', '${no}');" name="harga[]" id="harga${i}${no}" value="${formatRupiah(data[i].harga,'Rp. ')}">`,
                            `<input type="text" class="form-control" onkeyup="sum('${i}${no}', '${no}');" name="jumlah[]" id="jumlah${i}${no}" value="${data[i].jumlah}">`,
                            `<input type="text" class="form-control" id="subtotal${i}${no}" readonly value="${formatRupiah(data[i].subtotal,'Rp. ')}"><input type="hidden" name="subtotal[]" id="subtotal_asli${i}${no}" readonly value="${formatRupiah(data[i].subtotal,'Rp. ')}">`,
                            `KURS KOSONG`,
                            `<input type="text" class="form-control" onkeyup="sum_total('${i}${no}', '${no}');" name="diskon[]" id="diskon${i}${no}" value="${data[i].diskon}">`,
                            `<input type="text" class="form-control" onkeyup="sum_total('${i}${no}', '${no}');" name="ppn[]" id="ppn${i}${no}" value="${data[i].ppn}">`,
                            `<input type="text" class="form-control" name="total[]" id="total${i}${no}" readonly value="${formatRupiah(data[i].total,'Rp. ')}">`,
                            `<a href="javascript:void(0)" class="edit_detail_jasa" id_jasa="${data[i].itemid}"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                                <a href="javascript:void(0)" class="delete_detail text-danger" onclick="delete_detail('${no}')"><i class="fas fa-trash"></i></a>`,
                            `${data[i].tipe}`
                        ]).draw( false );
                    }else {
                        tabel_detail.row.add([
                            data[i].itemid,
                            data[i].item,
                            `<input type="text" class="form-control" onkeyup="sum('${i}${no}', '${no}');" name="harga[]" id="harga${i}${no}" value="${formatRupiah(data[i].harga,'Rp. ')}">`,
                            `<input type="text" class="form-control" onkeyup="sum('${i}${no}', '${no}');" name="jumlah[]" id="jumlah${i}${no}" value="${data[i].jumlah}">`,
                            `<input type="text" class="form-control" id="subtotal${i}${no}" readonly value="${formatRupiah(data[i].subtotal,'Rp. ')}"><input type="hidden" name="subtotal[]" id="subtotal_asli${i}${no}" readonly value="${formatRupiah(data[i].subtotal,'Rp. ')}">`,
                            `KURS KOSONG`,
                            `<input type="text" class="form-control" onkeyup="sum_total('${i}${no}', '${no}');" name="diskon[]" id="diskon${i}${no}" value="${data[i].diskon}">`,
                            `<input type="text" class="form-control" onkeyup="sum_total('${i}${no}', '${no}');" name="ppn[]" id="ppn${i}${no}" value="${data[i].ppn}">`,
                            `<input type="text" class="form-control" name="total[]" id="total${i}${no}" readonly value="${formatRupiah(data[i].total,'Rp. ')}">`,
                            `<a href="javascript:void(0)" class="edit_detail_budgetevent" id_budgetevent="${data[i].itemid}"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                                <a href="javascript:void(0)" class="delete_detail text-danger" onclick="delete_detail('${no}')"><i class="fas fa-trash"></i></a>`,
                            `${data[i].tipe}`
                        ]).draw( false );
                    }
                    
                    detail_array();
                    no++;
                }
                var hasil = formatRupiah(String(grandtotal), 'Rp. ');
                $('#total_total').html(hasil);
                $('.total_penjualan').val(hasil);
            }
        })

    })

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


    function update() {
        var form = $('#form1')[0];
        var formData = new FormData(form);
            $.ajax({
            url: base_url + 'update',
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