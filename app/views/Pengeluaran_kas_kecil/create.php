
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
                       <a href="{site_url}Pengeluaran_kas_kecil" class="btn btn-tool"><i class="fas fa-times"></i></a>
                    </div>
                  </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="javascript:save()" id="form1">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo lang('no_receipt') ?>:</label>
                                    <input type="text" class="form-control" name="nokwitansi" id="nokwitansi" placeholder="AUTO" readonly value="{kode_otomatis}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo lang('date') ?>:</label>
                                    <input type="text" class="form-control datepicker" name="tanggal" required value="{tanggal}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo lang('company') ?>:</label>
                                    <select id="perusahaan" class="form-control perusahaan" name="perusahaan" required></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                 <div class="form-group">
                                    <label><?php echo lang('Departemen') ?>:</label>
                                    <select id="departemen" class="form-control departemen" name="departemen" required></select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo lang('recipients_name') ?>:</label>
                                    <select id="pejabat" class="form-control pejabat" name="pejabat" required></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo lang('cash') ?>:</label>
                                    <select id="kas" class="form-control kas" name="akunno" required></select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo lang('nominal') ?>:</label>
                                    <input type="text" id="nominal" class="form-control nominal text-right" name="nominal" readonly="" required="">
                                </div>
                               
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo lang('remaining_petty_cash') ?>:</label>
                                    <input type="text" id="sisa_kas_kecil" class="form-control sisa_kas_kecil text-right" name="sisa_kas_kecil" readonly>
                                </div>  
                            </div>
                        </div>
            
                        <div class="mb-3 mt-3 table-responsive">
                            <div class="mt-3 mb-3" id="btn_add_detail">
                                <button type="button" class="btn btn-sm btn-primary btn_add_detail"><?php echo lang('Tambah Biaya') ?></button>
                            </div>
                            <table class="table table-bordered" id="table_detail">
                                <thead class="{bg_header}">
                                    <tr>
                                        <th>ID</th>
                                        <th><?php echo lang('item') ?></th>
                                        <th class="text-right"><?php echo lang('price') ?></th>
                                        <th class="text-right"><?php echo lang('qty') ?></th>
                                        <th class="text-right"><?php echo lang('subtotal') ?></th>
                                        <th class="text-right"><?php echo lang('discount') ?></th>
                                        <th class="text-right"><?php echo lang('Pajak') ?></th>
                                        <th class="text-right"><?php echo lang('Biaya Pengiriman') ?></th>
                                        <th class="text-right"><?php echo lang('No akun') ?></th>
                                        <th class="text-right"><?php echo lang('total') ?></th>
                                        <th class="text-right"><?php echo lang('sisa pagu item') ?></th>
                                        <th class="text-center"><?php echo lang('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody> </tbody>
                                <tfoot class="bg-light">
                                    <tr>
                                        <th colspan="9"><?php echo lang('total') ?></th>
                                        <th class="text-right"><total></total></th>
                                        <th class="text-center">&nbsp;</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <input type="hidden" name="detail_array" id="detail_array">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo lang('information') ?>:</label>
                                    <textarea class="form-control" name="keterangan" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="btn-group">
                                <a href="{site_url}Pengeluaran_kas_kecil" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                                &nbsp;<button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
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

<div id="modal_add_detail" class="modal fade">
    <div class="modal-dialog modal-lg">
        <form action="javascript:save_detail(0)" id="form2">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Baru</h5>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="rowindex">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Item:</label>
                                <select class="form-control itemid" name="itemid[]" required="" style="width:100%" multiple="">
                                </select>
                            </div>
                        </div>
                        <table class="table">
                            <tbody id="list_barang">

                            </tbody>
                        </table>
                        <div id="detail_barang"></div>
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

<div id="modal_edit_detail" class="modal fade">
    <div class="modal-dialog modal-lg">
        <form action="javascript:edit_detail_barang()" id="form3" enctype="multipart/form-data" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Detail</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="edit_rowindex">
                    <input type="hidden" class="edit_nmr_urut">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Item:</label>
                                <select class="form-control edit_itemid" name="edit_itemid[]" required="" style="width:100%">
                                </select>
                            </div>
                        </div>
                        <table class="table">
                            <tbody id="edit_list_barang">

                            </tbody>
                        </table>
                        <div id="edit_detail_barang"></div>
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
    var base_url = '{site_url}Pengeluaran_kas_kecil/';
    var total_total     = [];

    $.fn.dataTable.Api.register( 'hasValue()' , function(value) {
        return this .data() .toArray() .toString() .toLowerCase() .split(',') .indexOf(value.toString().toLowerCase())>-1
    })

    //isi tabel biaya
    var table_detail = $('#table_detail').DataTable({
        sort: false,
        info: false,
        searching: false,
        paging: false,
        columnDefs: [
            {targets: [0], visible: false},
            {targets: [2,3,4,5,6,7,8,9], className: 'text-right'}
        ],
    })

    $(document).ready(function(){  
        //combobox perusahaan      
        ajax_select({
            id: '#perusahaan',
            url: base_url + 'select2_mperusahaan',
        });
        //combobox kas/akunno
        ajax_select({
            id: '#kas',
            url: base_url + 'select2_mnoakun/',
        });
    })

    //combobox departemen
    $('#perusahaan').change(function(e) {
        $("#departemen").val($("#departemen").data("default-value"));
        $('input[name=pejabat]').val(''); 
        $('input[id=sisa_kas_kecil]').val('0'); 
        var peru = $('#perusahaan').children('option:selected').val();
        ajax_select({
            id: '#departemen',
            url: base_url + 'select2_mdepartemen/' + peru,
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

    
    $('#perusahaan').change(function(){ 
        var id=document.getElementById("form1").perusahaan.value;
        //nomor kwitansi
        $.ajax({
            url : base_url + 'get_kode_perusahaan',
            method : "POST",
            data : {id: id},
            async : true,
            dataType : 'json',
            success: function(data){
                var kodeper = '';
                var i;
                for(i=0; i<data.length; i++){ kodeper += data[i].kode; }
                        
                var nomor = '{kode_otomatis}';
                var tipe = 'KK';
                var tahun = '{tahun}';
                var kodeperusahaan = kodeper;
                document.getElementById("form1").nokwitansi.value = nomor+'/'+kodeperusahaan+'/'+tipe+'/'+tahun;
            }
        });
        //hitung sisa kas kecil
        $.ajax({
            url: base_url + 'get_hitungsisakaskecil',
            method: 'post',
            datatype: 'json',
            data: { idper: $('select[name=perusahaan]').val() },
            success: function(data){
                $('input[id=sisa_kas_kecil]').val( formatRupiah(String(data.hasil), 'Rp. ')); 
            }
        });
        return false;
    });

    //menampilkan modal tambah biaya
    $(document).on('click','.btn_add_detail',function(){
        $('#modal_add_detail').modal('show');
        $('.itemid').empty();
        $.ajax({
            url         : base_url + 'select2_item/' + $('select[name=perusahaan]').val()+'/'+$('select[name=departemen]').val(),
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

    //mengambil data detail item
    $(document).on('change','.itemid',function(){
        var rowindex        = $('input[name=rowindex]').val();
        var itemid          = $(this).val();    
        $.ajax({
            url         : base_url + 'get_detail_item',
            method      : 'post',
            datatype    : 'json',
            data        : { itemid: itemid },
            success: function(data) {
                var detail_barang   = '';
                for (let index = 0; index < data.length; index++) {
                    detail_barang +=  `
                        <input type="hidden" class="form-control" id="noakun`+index+`" name="noakun[]" required value="${data[index].koderekening}">
                        <input type="hidden" class="form-control" id="sisapaguitem`+index+`" name="sisapaguitem[]" required value="${data[index].jumlah}">`;
                }
                $('#detail_barang').html(detail_barang);
            }
        })
    })
    
    //save data
    function save_detail(no) {
        var barang          = $('.itemid :selected');        
        for (let index = 0; index < barang.length; index++) {
            var id    = barang[index].value;
            var item    = barang[index].text;
            if(table_detail.hasValue(id)) {
                swal("Gagal!", "Item sudah ada", "error");
                return;
            }
            noakun          = $('#noakun'+index).val();
            sisapaguitem    = $('#sisapaguitem'+index).val();
            $('#noakun'+index).remove();
            $('#sisapaguitem'+index).remove();

            sisapaguitem_tabel  = `<input type="hidden" name="sisapaguitem[]" id="sisapaguitem_lama${index}${no}" value="${sisapaguitem}"><input type="text" class="form-control" id="sisapaguitem_baru${index}${no}" value="${formatRupiah(sisapaguitem, 'Rp.')}" readonly>`;
            
            table_detail.row.add([
                barang[index].value,
                item,
                `<input type="text" class="form-control" onkeyup="sum('${index}${no}', '${no}');" name="harga[]" id="harga${index}${no}">`,
                `<input type="text" class="form-control" onkeyup="sum('${index}${no}', '${no}');" name="jumlah[]" id="jumlah${index}${no}">`,
                `<input type="text" class="form-control" id="subtotal${index}${no}" readonly><input type="hidden" name="subtotal[]" id="subtotal_asli${index}${no}" readonly>`,
                `<input type="text" class="form-control" onkeyup="sum_total('${index}${no}', '${no}');" name="diskon[]" id="diskon${index}${no}">`,
                `<input type="hidden" name="total_pajak[]" id="total_pajak${index}${no}" onchange="sum_total('${index}${no}', '${no}');">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pajak${index}${no}" title="Tambah Pajak">
                    <i class="fas fa-balance-scale"></i>
                </button>`,
                `<input type="hidden" name="biayapengiriman[]" id="biaya_pengiriman${index}${no}">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pengiriman${index}${no}" title="Tambah Biaya Pengiriman">
                    <i class="fas fa-shipping-fast"></i>
                </button>`,
                noakun,
                `<input type="text" class="form-control" name="total[]" id="total${index}${no}" readonly onchange="sum_total('${index}${no}', '${no}');">`,
                sisapaguitem_tabel,
                `<a href="javascript:edit_detail('${barang[index].value}','${no}')" class="edit_detail"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                <a href="javascript:delete_detail('${no}')" class="delete_detail text-danger"><i class="fas fa-trash"></i></a>`
            ]).draw( false );

            detail_array();

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
                                        <div class="modal-dialog modal-xl">
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
                        <div class="modal-dialog modal-xl">
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
                url         : base_url + 'select2_noakun_pengiriman'
            });
            getListPajak(String(index) + String(no));
            no++;
            var no_baru = no;
        }
        
        $('#modal_add_detail').modal('hide');
        $('#form2').attr('action', 'javascript:save_detail('+no_baru+')');
    }


    $(document).on('select2:select','.pilih_akun',function(e){
        id  = $(this).attr('data-id');
        $.ajax({
            url         : base_url + 'get_noakun_pengiriman',
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

    function addPajak(elem, no, id) {
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

    function total_pajak(id, no) {
        var formData    = new FormData($('#form_pajak'+id)[0]);
        var pajak       = formData.getAll('pajak');
        var pajak_baru  = 0;
        pajak.forEach(p => {
            pajak_baru  += parseInt(p.replace(/[Rp.]/g, ''));
        });
        $('#total_pajak'+id).val(pajak_baru);
        $('#modal_pajak'+id).modal('hide');
        sum_total(id, no)
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
        sum_total(id, no)
    }

    function nominalPajak(no) {
        var nilai   = $('#nominal_pajak' + no).val();
        var nilai1  = nilai.replace(/[^,\d]/g, '').toString();
        $('#nominal_pajak' + no).val(formatRupiah(String(nilai), 'Rp. '));
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
                                <td><input type="checkbox" name="" kode_pajak="${element.kode_pajak}" nama_pajak="${element.nama_pajak}" kode_akun="${element.akunno}" nama_akun="${element.namaakun}"id="" onchange="addPajak(this, `+i+`, '`+id+`')"></td>
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


    function detail_array() {
        var arr = table_detail.data().toArray();
        $('#detail_array').val( JSON.stringify(arr) );
    }

    function sum(no, no1) {  
        var txtFirstNumberValue                     = document.getElementById('harga'+no).value.replace(/[^,\d]/g, '').toString();    
        document.getElementById('harga'+no).value   = formatRupiah(txtFirstNumberValue, 'Rp.');
        var txtSecondNumberValue                    = document.getElementById('jumlah'+no).value;
        var result                                  = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
        var pajak                 = document.getElementById('total_pajak'+no).value;
        if (!isNaN(parseInt(pajak))) {
            var result   = result + parseInt(pajak);    
        }
        var biaya_pengiriman                 = document.getElementById('biaya_pengiriman'+no).value;
        if (!isNaN(parseInt(biaya_pengiriman))) {
            var result   = result + parseInt(biaya_pengiriman);    
        }
        if (isNaN(parseInt(txtFirstNumberValue))) {
            var result  = 0;    
        }
        if (isNaN(parseInt(txtSecondNumberValue))) {
            var result  = 0;    
        }
        
        var sisapaguitem            = document.getElementById('sisapaguitem_lama'+no).value;
        var sisapaguitem_baru       = String(parseInt(sisapaguitem) - result);
        
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
        
        document.getElementById('sisapaguitem_baru'+no).value = formatRupiah(sisapaguitem_baru, 'Rp.');
        
        total_total[no1] = [];
        total_total[no1].push(parseInt(result));
        total_semua();
    }

    function sum_total(no, no1) {    
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
        
        var sisapaguitem            = document.getElementById('sisapaguitem_lama'+no).value;
        var sisapaguitem_baru       = String(parseInt(sisapaguitem) - total);
        
        document.getElementById('total'+no).value = formatRupiah(String(total), 'Rp.');
        
        document.getElementById('sisapaguitem_baru'+no).value = formatRupiah(sisapaguitem_baru, 'Rp.');
        
        total_total[no1]    = [];
        total_total[no1].push((parseInt(total)));
        total_semua();
    }
    
    function total_semua() {
        a   = 0;
        total_total.forEach(function callback(element, index, array) {
            a   += parseInt(element);
        })
        $('total').html(formatRupiah(String(a), 'Rp. '));
        $('.nominal').val(formatRupiah(String(a), 'Rp. '));
    }



    function edit_detail(id, no){
        $('.edit_nmr_urut').val(no);
        $('.edit_itemid').empty();
        $.ajax({
            url         : base_url + 'select2_item/' + $('select[name=perusahaan]').val()+'/'+$('select[name=departemen]').val(),
            method      : 'post',
            datatype    : 'json',
            success: function(data) {
                isi = "";
                for (let index = 0; index < data.length; index++) {
                    if (data[index].id == id){
                        isi += `<option value="${data[index].id}" selected>${data[index].text}</option>`;
                    }else{
                        isi += `<option value="${data[index].id}">${data[index].text}</option>`
                    }
                }
                $('.edit_itemid').append(isi);
            }
        })
        $('.edit_itemid').select2();
        $('#modal_edit_detail').modal('show');
    }

    $('#table_detail tbody').on('click','.edit_detail',function(){
        var tr              = table_detail.row($(this).parents('tr')).index();
        var rowindex        = table_detail.row($(this).parents('tr')).index();
        $('input[name=edit_rowindex]').val(rowindex);
    })

    function edit_detail_barang(no) {
        var formData        = new FormData($('#form3')[0]);
        var rowindex        = formData.get('edit_rowindex');
        var nmr_urut        = $('.edit_nmr_urut').val();
        var barang          = $('.edit_itemid :selected');

        for (let index = 0; index < barang.length; index++) {
            var id    = barang[index].value;
            var item    = barang[index].text;
            if(table_detail.hasValue(id)) {
                swal("Gagal!", "Item sudah ada", "error");
                return;
            }
            
            noakun          = $('#noakun'+index).val();
            sisapaguitem    = $('#sisapaguitem'+index).val();
                  
            table_detail.row(rowindex).data([
                barang[index].value,
                item,
                `<input type="text" class="form-control" onkeyup="sum('${index}${nmr_urut}', '${nmr_urut}');" name="harga[]" id="harga${index}${nmr_urut}">`,
                `<input type="text" class="form-control" onkeyup="sum('${index}${nmr_urut}', '${nmr_urut}');" name="jumlah[]" id="jumlah${index}${nmr_urut}">`,
                `<input type="text" class="form-control" id="subtotal${index}${nmr_urut}" readonly><input type="hidden" name="subtotal[]" id="subtotal_asli${index}${nmr_urut}" readonly>`,
                `<input type="text" class="form-control" onkeyup="sum_total('${index}${nmr_urut}', '${nmr_urut}');" name="diskon[]" id="diskon${index}${nmr_urut}">`,
                 `<input type="hidden" name="total_pajak[]" id="total_pajak${index}${nmr_urut}" onchange="sum_total('${index}${nmr_urut}', '${nmr_urut}');">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pajak${index}${nmr_urut}" title="Tambah Pajak">
                    <i class="fas fa-balance-scale"></i>
                </button>`,
                `<input type="hidden" name="biayapengiriman[]" id="biaya_pengiriman${index}${nmr_urut}">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pengiriman${index}${nmr_urut}" title="Tambah Biaya Pengiriman">
                    <i class="fas fa-shipping-fast"></i>
                </button>`,
                noakun,
                `<input type="text" class="form-control" name="total[]" id="total${index}${nmr_urut}" readonly>`,
                `<input type="hidden" name="sisapaguitem[]" id="sisapaguitem_lama${index}${nmr_urut}" value="${sisapaguitem}"><input type="text" class="form-control" id="sisapaguitem_baru${index}${nmr_urut}" value="${formatRupiah(sisapaguitem, 'Rp.')}" readonly name="sisapaguitem_baru[]" >`,
                `<a href="javascript:edit_detail('${barang[index].value}','${nmr_urut}')" class="edit_detail"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                <a href="javascript:delete_detail('${nmr_urut}')" class="delete_detail text-danger"><i class="fas fa-trash"></i></a>`
            ]).draw( false );
            detail_array();
            total_total[nmr_urut]    = [];
            total_total[nmr_urut].push(0);
            total_semua();
        }
        $('#modal_edit_detail').modal('hide');
    }

    $(document).on('change','.edit_itemid',function(){
        var rowindex = $('input[name=rowindex]').val();
        var itemid = $(this).val();   
        if(!rowindex) {
            if(itemid) {
                $.ajax({
                    url: base_url + 'get_detail_item',
                    method: 'post',
                    datatype: 'json',
                    data: {
                        itemid: itemid
                    },
                    success: function(data) {
                        for (let index = 0; index < data.length; index++) {
                            var hargabeli       = data[index].tarif;
                            var jumlahkasitem   = data[index].jumlah;
                            detail_barang       =  `<input type="hidden" class="form-control" id="noakun`+index+`" name="noakun[]" required value="${data[index].koderekening}"><input type="hidden" class="form-control" id="sisapaguitem`+index+`" name="sisapaguitem[]" required value="${data[index].jumlah}">`          
                        }
                        $('#edit_detail_barang').append(detail_barang);
                    }
                })
            }
        }
    })

    function delete_detail(no){
        total_total.splice(no, 1,"0");
        total_semua();
    }

    $('#table_detail tbody').on('click','.delete_detail',function(){
        table_detail.row($(this).parents('tr')).remove().draw();
        detail_array();
    })
    //simpan data
    function save() {
        var form = $('#form1')[0];
        var formData = new FormData(form);
        detail = formData.get('detail_array');
        if(detail.length < 10) {
            swal("Error!","Silahkan isi detail terlebih dulu!", "error");
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