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
                        <form id="form1" action="javascript:save()">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
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
                                            <select id="department" class="form-control department" name="dept" required></select>
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
                                                <option value="barang">Barang</option>                                   
                                                <option value="jasa">Jasa</option>
                                                <option value="barang_dan_jasa">Barang dan Jasa</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo lang('Jenis Barang') ?>:</label>
                                            <select class="form-control jenis_barang" name="jenis_barang" required>
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

                                    <!-- tabel barang dagangan -->
                                    <table class="table table-bordered" id="table_detail_barang_dagangan" width="100%" hidden>
                                        <thead class="{bg_header}">
                                            <tr>
                                                <th>ID</th>
                                                <th class="text-center"><?php echo lang('item') ?></th>
                                                <th class="text-center"><?php echo lang('price') ?></th>
                                                <th class="text-center"><?php echo lang('qty') ?></th>
                                                <th class="text-center"><?php echo lang('subtotal') ?></th>
                                                <th class="text-center"><?php echo lang('discount') ?></th>
                                                <th class="text-center"><?php echo lang('ppn') ?></th>
                                                <th class="text-center"><?php echo lang('no akun') ?></th>
                                                <th class="text-center"><?php echo lang('total') ?></th>
                                                <th class="text-center"><?php echo lang('action') ?></th>
                                                <th class="text-center"><?php echo lang('kurs') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody> </tbody>
                                        <tfoot class="bg-light">
                                            <tr>
                                                <th>ID</th>
                                                <th colspan="6">&nbsp;</th>
                                                <th class="text-right"><?php echo lang('total') ?></th>
                                                <th class="text-center" id="total_total_barang_dagangan">
                                                <th></th>
                                                <th></th>
                                                    <!-- <input type="hidden" name="total_semua" id="total_semua" value="0"> -->
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <!-- tabel jasa & inventaris-->
                                    <table class="table table-bordered" id="table_detail_jasa_dan_inventaris" width="100%" hidden>
                                        <thead class="{bg_header}">
                                            <tr>
                                                <th>ID</th>
                                                <th class="text-center"><?php echo lang('Kode') ?></th>
                                                <th class="text-center"><?php echo lang('name') ?></th>
                                                <th class="text-center"><?php echo lang('price') ?></th>
                                                <th class="text-center"><?php echo lang('qty') ?></th>
                                                <th class="text-center"><?php echo lang('subtotal') ?></th>
                                                <th class="text-center"><?php echo lang('kurs mata uang') ?></th>
                                                <th class="text-center"><?php echo lang('discount') ?></th>
                                                <th class="text-center"><?php echo lang('ppn') ?></th>
                                                <th class="text-center"><?php echo lang('total') ?></th>
                                                <th class="text-center"><?php echo lang('action') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody> </tbody>
                                        <tfoot class="bg-light">
                                            <tr>
                                                <th>ID</th>
                                                <th colspan="7">&nbsp;</th>
                                                <th class="text-right"><?php echo lang('total') ?></th>
                                                <th class="text-center" id="total_total_jasa_dan_inventaris">
                                                <th></th>
                                                    <!-- <input type="hidden" name="total_semua" id="total_semua" value="0"> -->
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                   
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                            <label><?php echo lang('Uang Muka') ?>:</label>
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
                                barang
                                <input type="text" name="detail_array_barang" id="detail_array_barang">
                                jasa
                                <input type="text" name="detail_array_jasa" id="detail_array_barang">
                                jasa dan barang
                                <input type="text" name="detail_array_jasa_barang" id="detail_array_jasa_barang">
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="text-left">
                                    <div class="btn-group">
                                        <a href="{site_url}requiremen" class="btn bg-danger"><?php echo lang('cancel') ?></a>
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
<div id="modal_edit_detail_jasa" class="modal fade">
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

    //datatable barang dagangan
    var table_detail_barang_dagangan = $('#table_detail_barang_dagangan').DataTable({
        sort: false,
        info: false,
        searching: false,
        paging: false,
        columnDefs: [
            {targets: [0], visible: false},
            {targets: [8], className: 'text-right'}
        ],
        footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            total = api.column( 8 ).data().reduce( function (a, b) {
                return intVal(a) + intVal(b); 
            }, 0 );

            $( api.column( 8 ).footer() ).html(
                numeral(total).format()
            );

            $('.subtotalhead').val( numeral(total).format() )
            $('.totalhead').val( numeral(total).format() )
        }
    })

    //datatable jasa dan inventaris
    var table_detail_jasa_dan_inventaris = $('#table_detail_jasa_dan_inventaris').DataTable({
        sort: false,
        info: false,
        searching: false,
        paging: false,
        columnDefs: [
            {targets: [0], visible: false},
            {targets: [8], className: 'text-right'}
        ],
        footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            total = api.column( 9 ).data().reduce( function (a, b) {
                return intVal(a) + intVal(b); 
            }, 0 );

            $( api.column( 9 ).footer() ).html(
                numeral(total).format()
            );

            $('.subtotalhead').val( numeral(total).format() )
            $('.totalhead').val( numeral(total).format() )
        }
    })


    $(document).ready(function(){
        //isi combobox kontak, gudang, perusahaan, departement, pejabat
        ajax_select({ id: '.kontakid', url: base_url + 'select2_kontak', selected: { id: null } });
        ajax_select({ id: '.gudangid', url: base_url + 'select2_gudang', selected: { id: null } });
        ajax_select({id: '#perusahaan', url: base_url + 'select2_mperusahaan', selected: { id: null } });           
        $('#perusahaan').change(function(e) {
            var perusahaanId = $('#perusahaan').children('option:selected').val();
            var num = perusahaanId.toString().padStart(3, "0")
            $('#corpCode').val(num);
            ajax_select({
                id: '#department',
                url: base_url + 'select2_mdepartemen/' + perusahaanId,
            });
        })

        $('#department').change(function(e) {
            var deptName = $('#department').children('option:selected').text();
            var deptId = $('#department').children('option:selected').val()
            var num = deptId.toString().padStart(3, "0")
            $('#deptCode').val(num);
            ajax_select({
                id: '#pejabat',
                url: base_url + 'select2_mdepartemen_pejabat/' + deptName,
            });
        })
        //menampilkan tabel barang dagangan
        var jenis_penjualan = $('.jenis_penjualan').val();
        var jenis_barang = $('.jenis_barang').val();
        if ((jenis_penjualan == 'barang') && (jenis_barang == 'barang_dagangan')){
            $('#table_detail_barang_dagangan').attr("hidden", false);
            $('#table_detail_jasa_dan_inventaris').attr("hidden", true);
        }
        //menyembunyikan button tambah
        $('.btn_add_detail_barang').attr("hidden", false);
        $('.btn_add_detail_jasa').attr("hidden", true);
        $('.btn_add_detail_budgetevent').attr("hidden", true);
    })

    //perubahan saat jenis pembelian diganti
    $(document).on('change','.jenis_penjualan',function(){
        if ($(this).val() == 'jasa') {
            $('.jenis_barang').attr("disabled", true);
            $('#rekanan').empty();
            $('#gudang').empty();
            $('#table_detail_barang_dagangan').attr("hidden", true);
            $('#table_detail_jasa_dan_inventaris').attr("hidden", false);
            $('.btn_add_detail_barang').attr("hidden", true);
            $('.btn_add_detail_jasa').attr("hidden", false);
            $('.btn_add_detail_budgetevent').attr("hidden", false);
        } else if ($(this).val() == 'barang'){
            $('#table_detail_barang_dagangan').attr("hidden", false);
            $('#table_detail_jasa_dan_inventaris').attr("hidden", true);    
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
            $('#table_detail_barang_dagangan').attr("hidden", false);
            $('#table_detail_jasa_dan_inventaris').attr("hidden", true);    
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
        table_detail_barang_dagangan.clear().draw();
        table_detail_jasa_dan_inventaris.clear().draw();
        $('#detail_array_barang').val('');
        $('#detail_array_jasa').val('');
        $('#detail_array_jasa_barang').val('');
    })

    //perubahan saat jenis barang diganti
    $(document).on('change','.jenis_barang',function(){
        if ($(this).val() == 'barang_dagangan') {
            $('#table_detail_barang_dagangan').attr("hidden", false);
            $('#table_detail_jasa_dan_inventaris').attr("hidden", true); 
        } else if ($(this).val() == 'inventaris'){
            $('#table_detail_barang_dagangan').attr("hidden", true);
            $('#table_detail_jasa_dan_inventaris').attr("hidden", false);
        }
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

    //mengambil detail barang
    $(document).on('change','.itemid',function(){
        var rowindex_barang = $('input[name=rowindex_barang]').val();
        var itemid = $(this).val();       
        if(!rowindex_barang) {
            if(itemid) {
                var jenis_barang = $('.jenis_barang').val();
                switch (jenis_barang) {
                    case 'barang_dagangan':
                        $.ajax({
                            url: base_url + 'get_detail_item_barang_dagangan',
                            method: 'post',
                            datatype: 'json',
                            data: {
                                itemid: itemid
                            },
                            success: function(data) {   
                                for (let index = 0; index < data.length; index++) {
                                    var hargabeli       = data[index].harga;
                                    var jumlahkasitem   = data[index].jumlah;
                                    detail_barang       =  `<input type="hidden" class="form-control" id="noakun`+index+`" name="noakun[]" required value="${data[index].noakunjual}">`
                                }
                                $('#detail_barang').append(detail_barang);
                            }
                        })
                        break;
                    case 'inventaris':
                       
                        break;
                    case 'barang_dan_jasa':
                       
                        break;
                    default:
                        break;
                }
            }
        }
    })

    //mengambil detail jasa
    $(document).on('change','.jasaid',function(){
        var rowindex_jasa = $('input[name=rowindex_jasa]').val();
        var jasaid = $(this).val();       
        if(!rowindex_jasa) {
            if(jasaid) {
               $.ajax({
                    url: base_url + 'get_detail_item_jasa',
                    method: 'post',
                    datatype: 'json',
                    data: { jasaid: jasaid },
                    success: function(data) {
                    for (let index = 0; index < data.length; index++) {
                        detail_jasa       =  `<input type="hidden" class="form-control" id="nomorakun`+index+`" name="nomorakun[]" required value="${data[index].akunno}"><input type="hidden" class="form-control" id="namaakun`+index+`" name="namaakun[]" required value="${data[index].namaakun}">`
                                    }
                        $('#detail_jasa').append(detail_jasa);
                    }
                })
            }
        }
    })

    //mengambil detail budget event
    $(document).on('change','.budgeteventid',function(){
        var rowindex_budgetevent = $('input[name=rowindex_budgetevent]').val();
        var budgeteventid = $(this).val();       
        if(!rowindex_budgetevent) {
            if(budgeteventid) {
               //$.ajax({
                //    url: base_url + 'get_detail_item_jasa',
                //    method: 'post',
                //    datatype: 'json',
                 //   data: { jasaid: jasaid },
                   // success: function(data) {
                   // for (let index = 0; index < data.length; index++) {
                     //   detail_jasa       =  `<input type="hidden" class="form-control" id="nomorakun`+index+`" name="nomorakun[]" required value="${data[index].akunno}"><input type="hidden" class="form-control" id="namaakun`+index+`" name="namaakun[]" required value="${data[index].namaakun}">`
                    //}
                       // $('#detail_jasa').append(detail_jasa);
                    //}
                //})

            }
        }
    })

    //save detail barang
    function save_detail_barang(no) {
        var form            = $('#form2')[0];
        var formData        = new FormData(form);
        var barang          = $('.itemid :selected');
        var jenis_barang    = $('.jenis_barang').val();
        var no_baru         = no + 1;
        for (let index = 0; index < barang.length; index++) {
            var id    = barang[index].value;
            var item    = barang[index].text;
            if(table_detail_barang_dagangan.hasValue(id)) {
                swal("Gagal!", "Item sudah ada", "error");
                return;
            }
            switch (jenis_barang) {
                case 'barang_dagangan':
                    noakun = $('#noakun'+index).val();
                    table_detail_barang_dagangan.row.add([
                        barang[index].value,
                        item,
                        `<input type="text" class="form-control" onkeyup="sum('${index}${no}', '${no}');" name="harga[]" id="harga${index}${no}">`,
                        `<input type="text" class="form-control" onkeyup="sum('${index}${no}', '${no}');" name="jumlah[]" id="jumlah${index}${no}">`,
                        `<input type="text" class="form-control" id="subtotal${index}${no}" readonly><input type="hidden" name="subtotal[]" id="subtotal_asli${index}${no}" readonly>`,
                        `<input type="text" class="form-control" onkeyup="sum_total('${index}${no}', '${no}');" name="diskon[]" id="diskon${index}${no}">`,
                        `<input type="text" class="form-control" onkeyup="sum_total('${index}${no}', '${no}');" name="ppn[]" id="ppn${index}${no}">`,
                        noakun,
                        `<input type="text" class="form-control" name="total[]" id="total${index}${no}" readonly>`,
                        `<a href="javascript:void(0)" class="edit_detail_barang" id_barang="${barang[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                        <a href="javascript:void(0)" class="delete_detail text-danger"><i class="fas fa-trash"></i></a>`,
                        `KURS KOSONG`
                    ]).draw( false );
                    break;
                case 'inventaris':
                    
                    break;
                case 'barang_dan_jasa':

                    break;

                default:
                    break;
            }
            
            detail_array_barang()
            no++;
        }
        $('#modal_add_detail_barang').modal('hide');
        $('#form2').attr('action', 'javascript:save_detail_barang('+no_baru+')');
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
            if(table_detail_jasa_dan_inventaris.hasValue(id)) {
                swal("Gagal!", "Item sudah ada", "error");
                return;
            }

            switch (jenis_penjualan){
                case 'jasa':
                        nomorakun  = $('#nomorakun'+index).val();
                        namaakun  = $('#namaakun'+index).val();
                        table_detail_jasa_dan_inventaris.row.add([
                            jasa[index].value,
                            nomorakun,
                            namaakun,
                            `<input type="text" class="form-control" onkeyup="sum('${index}${no}', '${no}');" name="harga[]" id="harga${index}${no}">`,
                            `<input type="text" class="form-control" onkeyup="sum('${index}${no}', '${no}');" name="jumlah[]" id="jumlah${index}${no}">`,
                            `<input type="text" class="form-control" id="subtotal${index}${no}" readonly><input type="hidden" name="subtotal[]" id="subtotal_asli${index}${no}" readonly>`,
                            `KURS KOSONG`,
                            `<input type="text" class="form-control" onkeyup="sum_total('${index}${no}', '${no}');" name="diskon[]" id="diskon${index}${no}">`,
                            `<input type="text" class="form-control" onkeyup="sum_total('${index}${no}', '${no}');" name="ppn[]" id="ppn${index}${no}">`,
                            `<input type="text" class="form-control" name="total[]" id="total${index}${no}" readonly>`,
                            `<a href="javascript:void(0)" class="edit_detail_jasa" idjasa="${jasa[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp; <a href="javascript:void(0)" class="delete_detail text-danger"><i class="fas fa-trash"></i></a>`
                        ]).draw( false );
                    break;
                case 'barang_dan_jasa':

                    break;

                default:
                    break;
            }
            
            detail_array_jasa();
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
        var jenis_penjualan    = $('.jenis_penjualan').val();
        for (let index = 0; index < budget.length; index++) {
            var item    = budget[index].nomorakun;
            //if(table_detail_jasa_dan_inventaris.hasValue(item)) {
              //  swal("Gagal!", "Item sudah ada", "error");
                //return;
            //}

            switch (jenis_penjualan){
                case 'jasa':
                        
                    break;
                case 'barang_dan_jasa':

                    break;

                default:
                    break;
            }
            
            detail_array_jasa_barang();
            no++;
        }
        $('#modal_add_detail_jasa').modal('hide');
        $('#form4').attr('action', 'javascript:save_detail_jasa('+no_baru+')');
        total_total.push(no);
    }


    //detail array barang
    function detail_array_barang() {
        var arr = table_detail_barang_dagangan.data().toArray();
        $('#detail_array_barang').val( JSON.stringify(arr) );
    }

    //detail array jasa
    function detail_array_jasa() {
        var arr = table_detail_jasa_dan_inventaris.data().toArray();
        $('#detail_array_jasa').val( JSON.stringify(arr) );
    }
    //detail array jasa dan barang
    function detail_array_jasa_barang() {
        //var arr = table_detail_jasa_dan_inventaris.data().toArray();
        //$('#detail_array_jasa').val( JSON.stringify(arr) );
    }

    //edit data barang dagangan
    $('#table_detail_barang_dagangan tbody').on('click','.edit_detail_barang',function(){
        var id          = $('.edit_detail_barang').attr('id_barang'); 
        var tr          = table_detail_barang_dagangan.row($(this).parents('tr')).index();
        var rowindex    = table_detail_barang_dagangan.row($(this).parents('tr')).index();
        $('input[name=edit_rowindex_barang]').val(rowindex);
        var idgudang = $('.gudangid').val();
        url = base_url + 'select2_item'+'/'+id+'/'+idgudang;
        ajax_select({ id: '.edit_itemid', url: url, selected: { id: id } });
        $('#modal_edit_detail_barang').modal('show');
    })

    //edit data jasa dan inventaris
    $('#table_detail_jasa_dan_inventaris tbody').on('click','.edit_detail_jasa',function(){
        var id          = $('.edit_detail_jasa').attr('idjasa'); 
        var rowindex    = table_detail_barang_dagangan.row($(this).parents('tr')).index();
        $('input[name=edit_rowindex_jasa]').val(rowindex);
       
        url = base_url + 'select2_item_jasa';

        ajax_select({ id: '.edit_jasaid', url: url, selected: { id: id } });
        $('#modal_edit_detail_jasa').modal('show');
    })

    //edit barang detail
    $(document).on('change','.edit_itemid',function(){
        var rowindex_barang = $('input[name=edit_rowindex_barang]').val();
        var itemid = $(this).val();   
        if(!rowindex_barang) {
            if(itemid) {
                var jenis_barang = $('.jenis_barang').val();
                switch (jenis_barang) {
                    case 'barang_dagangan':
                       $.ajax({
                             url: base_url + 'get_detail_item_barang_dagangan',
                            method: 'post',
                            datatype: 'json',
                            data: {
                                itemid: itemid
                            },
                            success: function(data) {
                                for (let index = 0; index < data.length; index++) {
                                    var hargabeli       = data[index].harga;
                                    var jumlahkasitem   = data[index].jumlah;
                                    detail_barang_edit       =  `<input type="hidden" class="form-control" id="noakun`+index+`" name="noakun[]" required value="${data[index].noakunjual}">`
                                }
                                $('#detail_barang_edit').append(detail_barang_edit);
                            }
                        });
                        break;

                    case 'inventaris':
                        
                        break;

                    case 'barang_dan_jasa':
                        
                        break; 

                    default:
                    
                        break;
                }             
            }
        }
    })

    //edit jasa detail
    $(document).on('change','.edit_jasaid',function(){
        var rowindex_jasa = $('input[name=edit_rowindex_jasa]').val();
        var jasaid = $(this).val();   
        if(!rowindex_jasa) {
            if(jasaid) {
                var jenis_penjualan = $('.jenis_penjualan').val();
                switch (jenis_penjualan) {
                    case 'jasa':
                        $.ajax({
                            url: base_url + 'get_detail_item_jasa',
                            method: 'post',
                            datatype: 'json',
                            data: {
                                jasaid: jasaid
                            },
                            success: function(data) {
                                for (let index = 0; index < data.length; index++) {
                                    detail_jasa       =  `<input type="hidden" class="form-control" id="nomorakun`+index+`" name="nomorakun[]" required value="${data[index].akunno}"><input type="hidden" class="form-control" id="namaakun`+index+`" name="namaakun[]" required value="${data[index].namaakun}">`
                                }
                                $('#edit_detail_jasa').append(detail_jasa);
                            }
                        });     
                        break;
                    case 'barang_dan_jasa':

                        break; 
                    default:
                    
                        break;
                }             
            }
        }
    })

   //edit budget event detail
    $(document).on('change','.edit_budgeteventid',function(){
        var rowindex_budgetevent = $('input[name=rowindex_budgetevent]').val();
        var budgeteventid = $(this).val();   
        if(!rowindex_budgetevent) {
            if(budgeteventid) {
                var jenis_penjualan = $('.jenis_penjualan').val();
                switch (jenis_penjualan) {
                    case 'jasa':
                       
                        break;
                    case 'barang_dan_jasa':

                        break; 
                    default:
                    
                        break;
                }             
            }
        }
    })

    //simpan edit barang
    function save_edit_detail_barang(no) {
        var formData        = new FormData($('#form3')[0]);
        var rowindex_barang = formData.get('edit_rowindex_barang');
        var barang          = $('.edit_itemid :selected');
        var jenis_barang = $('.jenis_barang').val();
        for (let index = 0; index < barang.length; index++) {
            var id    = barang[index].value;
            var item    = barang[index].text;
            if(table_detail_barang_dagangan.hasValue(id)) {
                // NotifyError('Item sudah ada!');
                swal("Gagal!", "Item sudah ada", "error");
                return;
            }
            switch (jenis_barang) {
                case 'barang_dagangan':

                        noakun  = $('#noakun'+index).val();
                        $('#noakun'+index).remove();
                        table_detail_barang_dagangan.row(rowindex_barang).data([
                            barang[index].value,
                            item,
                            `<input type="text" class="form-control" onkeyup="sum('${index}${rowindex_barang}', '${rowindex_barang}');" name="harga[]" id="harga${index}${rowindex_barang}">`,
                            `<input type="text" class="form-control" onkeyup="sum('${index}${rowindex_barang}', '${rowindex_barang}');" name="jumlah[]" id="jumlah${index}${rowindex_barang}">`,
                            `<input type="text" class="form-control" id="subtotal${index}${rowindex_barang}" readonly><input type="hidden" name="subtotal[]" id="subtotal_asli${index}${rowindex_barang}" readonly>`,
                            `<input type="text" class="form-control" onkeyup="sum_total('${index}${rowindex_barang}', '${rowindex_barang}');" name="diskon[]" id="diskon${index}${rowindex_barang}">`,
                            `<input type="text" class="form-control" onkeyup="sum_total('${index}${rowindex_barang}', '${rowindex_barang}');" name="ppn[]" id="ppn${index}${rowindex_barang}">`,
                            noakun,
                            `<input type="text" class="form-control" name="total[]" id="total${index}${rowindex_barang}" readonly>`,
                            `<a href="javascript:void(0)" class="edit_detail_barang" id_barang="${barang[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                            <a href="javascript:void(0)" class="delete_detail text-danger" onclick="delete_detail('${no}')"><i class="fas fa-trash"></i></a>`,
                            `KURS KOSONG`
                        ]).draw( false );
                    break;

                case 'inventaris':
                    
                    break;

                case 'barang_dan_jasa':
                    
                    break;  
            
                default:
                    break;
            }
            
            detail_array_barang()
            rowindex_barang++;
        }
        $('#modal_edit_detail_barang').modal('hide')
    }

    //save edit jasa 
    function save_edit_detail_jasa(no) {
        var formData        = new FormData($('#form5')[0]);
        var edit_rowindex_jasa = formData.get('edit_rowindex_jasa');
        var jasa          = $('.edit_jasaid :selected');
        var jenis_penjualan = $('.jenis_penjualan').val();
        for (let index = 0; index < jasa.length; index++) {
            var id    = jasa[index].value;
            if(table_detail_jasa_dan_inventaris.hasValue(id)) {
                // NotifyError('Item sudah ada!');
                swal("Gagal!", "Item sudah ada", "error");
                return;
            }
            switch (jenis_penjualan) {
                case 'jasa':
                    nomorakun  = $('#nomorakun'+index).val();
                    namaakun  = $('#namaakun'+index).val();
                    $('#nomorakun'+index).remove();
                    $('#namaakun'+index).remove();
                    table_detail_jasa_dan_inventaris.row(edit_rowindex_jasa).data([
                            jasa[index].value,
                            nomorakun,
                            namaakun,
                            `<input type="text" class="form-control" onkeyup="sum('${index}${edit_rowindex_jasa}', '${edit_rowindex_jasa}');" name="harga[]" id="harga${index}${edit_rowindex_jasa}">`,
                            `<input type="text" class="form-control" onkeyup="sum('${index}${edit_rowindex_jasa}', '${edit_rowindex_jasa}');" name="jumlah[]" id="jumlah${index}${edit_rowindex_jasa}">`,
                            `<input type="text" class="form-control" id="subtotal${index}${edit_rowindex_jasa}" readonly><input type="hidden" name="subtotal[]" id="subtotal_asli${index}${edit_rowindex_jasa}" readonly>`,
                            `KURS KOSONG`,
                            `<input type="text" class="form-control" onkeyup="sum_total('${index}${edit_rowindex_jasa}', '${edit_rowindex_jasa}');" name="diskon[]" id="diskon${index}${edit_rowindex_jasa}">`,
                            `<input type="text" class="form-control" onkeyup="sum_total('${index}${edit_rowindex_jasa}', '${edit_rowindex_jasa}');" name="ppn[]" id="ppn${index}${edit_rowindex_jasa}">`,
                            `<input type="text" class="form-control" name="total[]" id="total${index}${edit_rowindex_jasa}" readonly>`,
                            `<a href="javascript:void(0)" class="edit_detail_jasa" id_jasa="${jasa[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                            <a href="javascript:void(0)" class="delete_detail text-danger" onclick="delete_detail('${no}')"><i class="fas fa-trash"></i></a>`,
                            `KURS KOSONG`
                        ]).draw( false );
                    break;

                case 'barang_dan_jasa':

                    break
            
                default:
                    break;
            }
            
            detail_array_jasa()
            edit_rowindex_jasa++;
        }
        $('#modal_edit_detail_jasa').modal('hide');
    }
    
    //save edit budget event 
    function save_edit_detail_jasa(no) {
       
    }

    //hapus isi tabel barang dagangan
    $('#table_detail_barang_dagangan tbody').on('click','.delete_detail',function(){
        var rowindex    = table_detail_barang_dagangan.row($(this).parents('tr')).index();
        table_detail_barang_dagangan.row($(this).parents('tr')).remove().draw();
        detail_array_barang();
        total_total.splice(rowindex, 1);
        total_semua();
    })
    //hapus isi tabel jasa dan inventaris
    $('#table_detail_jasa_dan_inventaris tbody').on('click','.delete_detail',function(){
        var rowindex    = table_detail_jasa_dan_inventaris.row($(this).parents('tr')).index();
        table_detail_jasa_dan_inventaris.row($(this).parents('tr')).remove().draw();
        detail_array_jasa();
        total_total.splice(rowindex, 1);
        total_semua();
    })
    //hapus isi tabel barang dan jasa
    $('#// tbody').on('click','.delete_detail',function(){
        
    })

    function save() {
        var form = $('#form1')[0];
        var formData = new FormData(form);
        detail = formData.get('detail_array');
        if(detail.length < 10) {
            NotifyError('Silahkan isi detail terlebih dulu!');
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
                    swal("Berhasil!", "Berhasil Menambah Data", "success");
                    redirect(base_url);
                } else {
                    swal("Gagal!", "Gagal Menambah Data", "error");
                }
            },
            error: function() {
                swal("Gagal!", "Internal Server Error", "error");
            }
        })
    }
</script>