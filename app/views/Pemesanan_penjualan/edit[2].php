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
                            <h3 class="card-title">Edit <?= $title; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="form1" action="javascript:update()">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="hidden" class="form-control idpemesanan" readonly name="idpemesanan" value="{id}">
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
                                            <?php for ($i=1; $i <= 8 ; $i++) {  ?>
                                        <?php if (($i == 1) || ($i == 5)) { echo '<div class="col-md-6">'; } ?>
                                            <div class="form-group a<?= $i ?>" hidden >
                                                <label><?php echo lang('Term '.$i) ?>:</label>
                                                <input type="text" class="form-control" name="a<?= $i ?>" placeholder="Angsuran <?= $i ?>" id="a<?= $i ?>" 
                                                value="<?php if ($angsuran['a'.$i] != ''){ echo "Rp. " . number_format($angsuran['a'.$i],0,',','.'); }?>" onkeyup="UbahInputRUpiah(this);SUMTOTAL_UM_Term();">
                                            </div>
                                        <?php if (($i == 4) || ($i == 8)){ echo '</div>'; } ?>
                                        <?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo lang('Total Uang Muka + Term') ?>:</label>
                                            <input type="text" class="form-control tum" name="tum" readonly>
                                        </div>
                                    </div>
                                </div>
                      
                                <input type="hidden" name="detail_array" id="detail_array">
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

<!-- modal tambah -->
<div id="modal_add_detail" class="modal fade">
    <div class="modal-dialog">
        <form action="javascript:save_detail(0)" id="form2">
            <div class="modal-content">
                <div class="modal-header bg-primary">
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
                <div class="modal-header bg-primary">
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
            $('#nokwitansi_rekening').attr("hidden", true);
        }else if(jenis_jual == 'jasa'){
            $('.jenis_penjualan').prop("selectedIndex", 1);
            $('.btn_add_detail_barang').attr("hidden", true);
            $('.btn_add_detail_jasa').attr("hidden", false);
            $('.btn_add_detail_budgetevent').attr("hidden", false);
            $('.jenis_barang').attr("disabled", true);
            $('#gudang').empty();
            $('#nokwitansi_rekening').attr("hidden", false);
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
            $('#nokwitansi_rekening').attr("hidden", false);
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

    //perubahan saat jenis penjualan diganti
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
        tabel_detail.clear().draw();
        $('#total_total').html('');
        $('#detail_array').val('');
        total_total=[];
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
        $('#total_total').html('');
        $('#total_penjualan').val('');
        tabel_detail.clear().draw();
        total_total=[];
    })

   //menampilkan modal barang
    $(document).on('click','.btn_add_detail_barang',function(){
        $('#modal_add_detail').modal('show');
        $('.barangid').empty();
        $('.comboboxbarang').attr("hidden", false);
        $('.comboboxjasa').attr("hidden", true);
        $('.comboboxbudgetevent').attr("hidden", true);
        
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
                for ( index = 0; index < data.length; index++) {
                    isi += `<option value="${data[index].id}">${data[index].text}</option>`
                }
                $('.barangid').append(isi);
            }
        })
        $('.barangid').select2();
        
    })

    //menampilkan modal jasa
    $(document).on('click','.btn_add_detail_jasa',function(){
        $('#modal_add_detail').modal('show');
        $('.jasaid').empty();
        $('.comboboxbarang').attr("hidden", true);
        $('.comboboxjasa').attr("hidden", false);
        $('.comboboxbudgetevent').attr("hidden", true);
        $('.jenisItem').val('jasa');
        $.ajax({
            url         : base_url + 'select2_item_jasa',
            method      : 'post',
            datatype    : 'json',
            success: function(data) {
                isi = "";
                for ( index = 0; index < data.length; index++) {
                    isi += `<option value="${data[index].id}">${data[index].text}</option>`
                }
                $('.jasaid').append(isi);
            }
        })
        $('.jasaid').select2();
    })

    //menampilkan modal budgetevent
    $(document).on('click','.btn_add_detail_budgetevent',function(){
        $('#nokwitansi_rekening').attr("hidden", false);
        $('.nokwitansi').val('{kode_otomatis}/BE/{tahun}');
        $("#rekening").val($("#rekening").data("default-value"));
        $('#modal_add_detail').modal('show');
        $('.budgeteventid').empty();
        $('.comboboxbarang').attr("hidden", true);
        $('.comboboxjasa').attr("hidden", true);
        $('.comboboxbudgetevent').attr("hidden", false);
        $('.jenisItem').val('budgetevent');
        $.ajax({
            url         : base_url + 'select2_budgetevent',
            method      : 'post',
            datatype    : 'json',
            success: function(data) {
                isi = "";
                for ( index = 0; index < data.length; index++) {
                    isi += `<option value="${data[index].id}">${data[index].text}</option>`
                }
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
        if ((jenisItem == 'barang') || (jenisItem == 'inventaris')){
            IsiItem = $('.barangid :selected');
        } else if (jenisItem == 'jasa'){
            IsiItem = $('.jasaid :selected');
        }else{
            IsiItem = $('.budgeteventid :selected');
        }
        var no_baru         = no + 1;
        jumlah_rows = tabel_detail.rows().count();
        for ( index = 0; index < IsiItem.length; index++) {
            var id    = IsiItem[index].value;
            var item    = IsiItem[index].text;
            if(tabel_detail.hasValue(id)) {
                swal("Gagal!", "Item sudah ada", "error");
                return;
            }
            tabel_detail.row.add([
                IsiItem[index].value,
                item,
                `<input type="text" class="form-control" onkeyup="sum('${index}${jumlah_rows}', '${jumlah_rows}');" name="harga[]" id="harga${index}${jumlah_rows}">`,
                `<input type="text" class="form-control" onkeyup="sum('${index}${jumlah_rows}', '${jumlah_rows}');" name="jumlah[]" id="jumlah${index}${jumlah_rows}">`,
                `<input type="text" class="form-control" id="subtotal${index}${jumlah_rows}" readonly><input type="hidden" name="subtotal[]" id="subtotal_asli${index}${jumlah_rows}" readonly>`,
                `KURS KOSONG`,
                `<input type="text" class="form-control" onkeyup="sum('${index}${jumlah_rows}', '${jumlah_rows}'); sum_total('${index}${jumlah_rows}', '${jumlah_rows}');" name="diskon[]" id="diskon${index}${jumlah_rows}">`,
                `<input type="text" class="form-control" onkeyup="sum('${index}${jumlah_rows}', '${jumlah_rows}'); sum_total('${index}${jumlah_rows}', '${jumlah_rows}');" name="ppn[]" id="ppn${index}${jumlah_rows}">`,
                `<input type="text" class="form-control" name="total[]" id="total${index}${jumlah_rows}" readonly>`,
                `<a href="javascript:EditDetail('${IsiItem[index].value}','${jenisItem}')" class="edit_detail"><i class="fas fa-pencil-alt"></i></a>&nbsp; 
                    <a href="javascript:void(0)" class="delete_detail text-danger"><i class="fas fa-trash"></i></a>`,
                `${jenisItem}`
            ]).draw( false );
            
            detail_array();
            jumlah_rows++;
        }
        $('#modal_add_detail').modal('hide');
        $('#form2').attr('action', 'javascript:save_detail('+jumlah_rows+')');
    }

    //detail array keseluruhan
    function detail_array() {
        var arr = tabel_detail.data().toArray();
        $('#detail_array').val( JSON.stringify(arr) );
    }

    //edit data barang
    function EditDetail(id,jenisItem){
        if ((jenisItem == 'barang') || (jenisItem == 'inventaris')){
            var rowindex    = tabel_detail.row($('.edit_detail').parents('tr')).index();
            $('input[name=edit_rowindex]').val(rowindex);
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
            ajax_select({ id: '.edit_barangid', url: url, selected: { id: id } });
        }else if (jenisItem == 'jasa'){
            var rowindex    = tabel_detail.row($(this).parents('tr')).index();
            $('input[name=edit_rowindex]').val(rowindex);
            $('.edit_jenisItem').val('jasa');
            $('.edit_comboboxbarang').attr("hidden", true);
            $('.edit_comboboxjasa').attr("hidden", false);
            $('.edit_comboboxbudgetevent').attr("hidden", true); 
            url = base_url + 'select2_item_jasa';
            ajax_select({ id: '.edit_jasaid', url: url, selected: { id: id } });
        }else{
            var rowindex    = tabel_detail.row($(this).parents('tr')).index();
            $('input[name=edit_rowindex]').val(rowindex);
            $('.edit_jenisItem').val('budgetevent');
            $('.edit_comboboxbarang').attr("hidden", true);
            $('.edit_comboboxjasa').attr("hidden", true);
            $('.edit_comboboxbudgetevent').attr("hidden", false); 
            url = base_url + 'select2_budgetevent';
            ajax_select({ id: '.edit_budgeteventid', url: url, selected: { id: id } });
        }
        $('#modal_edit_detail').modal('show');
    }
    
    //simpan edit
    function save_edit_detail(no) {
        var formData        = new FormData($('#form3')[0]);
        var edit_rowindex   = $('input[name=edit_rowindex]').val();
        var Edit_jenisItem  = $('.edit_jenisItem').val();
        var IsiItem    = '';
        if ((Edit_jenisItem == 'barang') || (Edit_jenisItem == 'inventaris')){
            edit_isiitem = $('.edit_barangid :selected');
        } else if (Edit_jenisItem == 'jasa'){
            edit_isiitem = $('.edit_jasaid :selected');
        }else{
            edit_isiitem = $('.edit_budgeteventid :selected');
        }

        for ( index = 0; index < edit_isiitem.length; index++) {
            var id    = edit_isiitem[index].value;
            var item  = edit_isiitem[index].text;
            if(tabel_detail.hasValue(id)) {
                swal("Gagal!", "Item sudah ada", "error");
                return;
            }
            tabel_detail.row(edit_rowindex).data([
                edit_isiitem[index].value,
                item,
                `<input type="text" class="form-control" onkeyup="sum('${index}${edit_rowindex}', '${edit_rowindex}');" name="harga[]" id="harga${index}${edit_rowindex}">`,
                `<input type="text" class="form-control" onkeyup="sum('${index}${edit_rowindex}', '${edit_rowindex}');" name="jumlah[]" id="jumlah${index}${edit_rowindex}">`,
                `<input type="text" class="form-control" id="subtotal${index}${edit_rowindex}" readonly><input type="hidden" name="subtotal[]" id="subtotal_asli${index}${edit_rowindex}" readonly>`,
                `KURS KOSONG`,
                `<input type="text" class="form-control" onkeyup="sum('${index}${edit_rowindex}', '${edit_rowindex}'); sum_total('${index}${edit_rowindex}', '${edit_rowindex}');" name="diskon[]" id="diskon${index}${edit_rowindex}">`,
                `<input type="text" class="form-control" onkeyup="sum('${index}${edit_rowindex}', '${edit_rowindex}'); sum_total('${index}${edit_rowindex}', '${edit_rowindex}');" name="ppn[]" id="ppn${index}${edit_rowindex}">`,
                `<input type="text" class="form-control" name="total[]" id="total${index}${edit_rowindex}" readonly>`,
                `<a href="javascript:EditDetail('${edit_isiitem[index].value}','${Edit_jenisItem}')" class="edit_detail"><i class="fas fa-pencil-alt"></i></a>&nbsp
                    <a href="javascript:void(0)" class="delete_detail text-danger" onclick="delete_detail('${no}')"><i class="fas fa-trash"></i></a>`,
                `${Edit_jenisItem}`
            ]).draw( false );
            detail_array();
            edit_rowindex++;
        }
        $('#modal_edit_detail').modal('hide');
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
        var txtFirstNumberValue                     = document.getElementById('harga'+no).value.replace(/[^0-9]+/g, '').toString();    
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
        var subtotal            = document.getElementById('subtotal_asli'+no).value;
        var diskon              = document.getElementById('diskon'+no).value;
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
    
    //setting keyup format rupiah
    function UbahInputRUpiah(nama_inputan){
        $(nama_inputan).on('keyup',function(){
            var nilai= $(this).val();
            $(this).val(formatRupiah(String(nilai), 'Rp. '));
        });
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
                    var nama_item = ''; 
                    var tipe_item = data[i].tipe;
                    if ((tipe_item == 'barang') || (tipe_item == 'inventaris')){
                        nama_item = data[i].item;
                    }else if (tipe_item == 'jasa'){
                        nama_item = data[i].jasa;
                    }else{
                        nama_item = data[i].budgetevent;
                    }
                    grandtotal = grandtotal + parseInt(data[i].total);
                    tabel_detail.row.add([
                        data[i].itemid,
                        nama_item,
                        `<input type="text" class="form-control" onkeyup="sum('${i}${no}', '${no}');" name="harga[]" id="harga${i}${no}" value="${formatRupiah(data[i].harga,'Rp. ')}">`,
                        `<input type="text" class="form-control" onkeyup="sum('${i}${no}', '${no}');" name="jumlah[]" id="jumlah${i}${no}" value="${data[i].jumlah}">`,
                        `<input type="text" class="form-control" id="subtotal${i}${no}" readonly value="${formatRupiah(data[i].subtotal,'Rp. ')}"><input type="hidden" name="subtotal[]" id="subtotal_asli${i}${no}" readonly value="${formatRupiah(data[i].subtotal,'Rp. ')}">`,
                        `KURS KOSONG`,
                        `<input type="text" class="form-control" onkeyup="sum('${i}${no}', '${no}');sum_total('${i}${no}', '${no}');" name="diskon[]" id="diskon${i}${no}" value="${data[i].diskon}">`,
                        `<input type="text" class="form-control" onkeyup="sum('${i}${no}', '${no}');sum_total('${i}${no}', '${no}');" name="ppn[]" id="ppn${i}${no}" value="${data[i].ppn}">`,
                        `<input type="text" class="form-control" name="total[]" id="total${i}${no}" readonly value="${formatRupiah(data[i].total,'Rp. ')}">`,
                        `<a href="javascript:EditDetail('${data[i].itemid}','${data[i].tipe}')" class="edit_detail"><i class="fas fa-pencil-alt"></i></a>&nbsp; <a href="javascript:void(0)" class="delete_detail text-danger"><i class="fas fa-trash"></i></a>`,
                        `${data[i].tipe}`
                        ]).draw( false );
                    detail_array();
                    total_total[no]    = [];
                    total_total[no].push((parseInt(data[i].total)));
                    total_semua();
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
        nilai_urut = parseInt(nilai_jtem) + parseInt('1');
        $('#a'+nilai_urut).val(''); 
        SUMTOTAL_UM_Term();
    });
    $('.jtem').on('click',function(){
        for (var i = 1; i <= 8; i++) {
            $('.a'+i).attr("hidden", true);
        } 
        var nilai_jtem = $(this).val();
        for (var j = 1; j <= nilai_jtem; j++) {
            $('.a'+j).attr("hidden", false);
        }
        nilai_urut = parseInt(nilai_jtem) + parseInt('1');
        $('#a'+nilai_urut).val(''); 
        SUMTOTAL_UM_Term();
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