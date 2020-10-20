
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
                                        <th class="text-right"><?php echo lang('ppn') ?></th>
                                        <th class="text-right"><?php echo lang('no akun') ?></th>
                                        <th class="text-right"><?php echo lang('total') ?></th>
                                        <th class="text-right"><?php echo lang('sisa pagu item') ?></th>
                                        <th class="text-center"><?php echo lang('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody> </tbody>
                                <tfoot class="bg-light">
                                    <tr>
                                        <th colspan="7">&nbsp;</th>
                                        <th class="text-right"><?php echo lang('total') ?></th>
                                        <th class="text-center">&nbsp;</th>
                                        <th></th>
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
        <form action="javascript:save_detail()" id="form2">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title"><?php echo lang('add_new') ?></h5>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="rowindex">
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="form-group">
                                <label><?php echo lang('item') ?>:</label>
                                <select id="itemid" class="form-control itemid" name="itemid" required style="width:100%"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label><?php echo lang('price') ?>:</label>
                                <input type="text" class="form-control" name="harga" required onkeyup="UbahInputRUpiah(this);">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('qty') ?>:</label>
                                <input type="text" class="form-control decimalnumber" name="jumlah" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('discount') ?>:</label>
                                <input type="text" class="form-control decimalnumber" name="diskon" required maxlength="2" min="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('ppn') ?>:</label>
                                <input type="text" class="form-control decimalnumber" name="ppn" required maxlength="2" min="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <!--<label><?php echo lang('kode akun belanja') ?>:</label>-->
                                <input type="hidden" class="form-control decimalnumber" name="noakunpersediaan" required readonly>
                                <input type="hidden" class="form-control decimalnumber" name="jumlahkasitem" required readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo lang('cancel') ?></button>
                        &nbsp;
                        <button type="submit" class="btn btn-success"><?php echo lang('save') ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    var base_url = '{site_url}Pengeluaran_kas_kecil/';

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

    //nomor kwitansi
    $('#perusahaan').change(function(){ 
        var id=document.getElementById("form1").perusahaan.value;
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
        return false;
    });

    //hitung sisa kas kecil
    $('#perusahaan').change(function(){ 
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
        footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\Rp.]/g, '').replace(/,00/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            total = api.column( 8 ).data().reduce( function (a, b) {
                return intVal(a) + intVal(b); 
            }, 0 );

            $( api.column( 8 ).footer() ).html(
                formatRupiah(String(total), 'Rp. ')
            );

            $('.subtotalhead').val( numeral(total).format() )
            $('.totalhead').val( numeral(total).format() )
            $('#nominal').val( formatRupiah(String(total), 'Rp. '))
        }
    })
  
    $('#table_detail tbody').on('click','.delete_detail',function(){
        table_detail.row($(this).parents('tr')).remove().draw();
        detail_array();
    })

    //ketika masih kosong
    $(document).on('click','.btn_add_detail',function(){
        $('#modal_add_detail').modal('show')
        $('input[name=rowindex]').val(null);
        $('input[name=harga]').val(0);
        $('input[name=jumlah]').val(0);
        $('input[name=diskon]').val(0);
        $('input[name=ppn]').val(0);
        $('input[name=noakunpersediaan]').val(0);
        
        //combobox item berdasarkan perusahan dan departemen
        ajax_select({
            id: '.itemid',
            url: base_url + 'select2_item/' + $('select[name=perusahaan]').val()+'/'+$('select[name=departemen]').val(),
        });
   
        $('.itemid').val(null).trigger('change');
    })

    $('#table_detail tbody').on('click','.edit_detail',function(){
        $('#modal_add_detail').modal('show');
        var tr = table_detail.row($(this).parents('tr')).index();
        var itemid = table_detail.cell(tr,0).data();
        var harga = table_detail.cell(tr,2).data();
        var jumlah = table_detail.cell(tr,3).data();
        var diskon = table_detail.cell(tr,5).data();
        var ppn = table_detail.cell(tr,6).data();
        var noakunpersediaan = table_detail.cell(tr,7).data();

        $('input[name=rowindex]').val(tr);
        $('.itemid').val(itemid).trigger('change');
        $('input[name=harga]').val(harga);
        $('input[name=jumlah]').val(jumlah);
        $('input[name=diskon]').val(diskon);
        $('input[name=ppn]').val(ppn);
        $('input[name=noakunpersediaan]').val(noakunpersediaan);
        
        ajax_select({
            id          : '.itemid',
            url         : base_url + 'select2_item/' + $('select[name=perusahaan]').val()+'/'+$('select[name=departemen]').val(),
            selected: { id: '{itemid}' }
        });

    })

    //ini ketika sudah memilih id item
    $(document).on('change','.itemid',function(){
        var itemid = $(this).val();
            if(itemid) {
                $.ajax({
                    url: base_url + 'get_detail_item',
                    method: 'post',
                    datatype: 'json',
                    data: {
                        itemid: itemid
                    },
                    success: function(data) {
                        var hargabeli = data.tarif;
                        var noakunpersediaan = data.koderekening;
                        var jumlahkasitem = data.jumlah;
                        $('input[name=harga]').val( formatRupiah(String(hargabeli), 'Rp. '));
                        $('input[name=jumlah]').val(1);
                        $('input[name=diskon]').val(0);
                        $('input[name=ppn]').val(0);
                        $('input[name=noakunpersediaan]').val(noakunpersediaan);
                        $('input[name=jumlahkasitem]').val(jumlahkasitem);
                        // var hargabeli = data.hargabeliterakhir;
                        // var noakunpersediaan = data.noakunpersediaan;
                        // $('input[name=harga]').val( numeral(hargabeli).format() );
                        // $('input[name=jumlah]').val(1);
                        // $('input[name=diskon]').val(0);
                        // $('input[name=ppn]').val(0);
                        // $('input[name=noakunpersediaan]').val(noakunpersediaan);
                        // console.log(data)
                    }
                })
            }
    })

    //save items
    function save_detail() {
        var form = $('#form2')[0];
        var formData = new FormData(form);

        var rowindex = formData.get('rowindex');
        var item = $('.itemid :selected').text();
        if (rowindex == ''){
            if(table_detail.hasValue(item)) {
                swal("Gagal!", "Item sudah ada!", "error");
                return;
            }
        }

        var jumlah = numeral(formData.get('jumlah')).value();
        var harga   = formData.get('harga').replace(/[^,\d]/g, '').toString();
        var jumkas = numeral(formData.get('jumlahkasitem')).value();
        if(jumlah <= 0 || harga <= 0) {
            swal("Gagal!", "Jumlah atau harga tidak boleh kosong!", "error");
            return;
        }
        var subtotal = harga * jumlah;
        var diskon = numeral(formData.get('diskon')).value();
        subtotal = subtotal - (diskon*subtotal/100);
        var jumlahkasitem=jumkas-subtotal;
        var ppn = numeral(formData.get('ppn')).value();
        var noakunpersediaan = numeral(formData.get('noakunpersediaan')).value();
        var total = subtotal + (ppn*subtotal/100);
        if(diskon < 0 || ppn < 0) {
            swal("Gagal!", "Diskon atu PPN error!", "error");
            return;
        }
        if(rowindex == '') {
            table_detail.row.add([
                formData.get('itemid'),
                item,
                formatRupiah(String(formData.get('harga')), 'Rp. '),
                formData.get('jumlah'),
                formatRupiah(String(jumlah*harga), 'Rp. '),
                formData.get('diskon'),
                formData.get('ppn'),
                formData.get('noakunpersediaan'),
                formatRupiah(String(total), 'Rp. '),
                formatRupiah(String(jumlahkasitem), 'Rp. '),
                `<a href="javascript:void(0)" class="edit_detail btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                <a href="javascript:void(0)" class="delete_detail btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>`
            ]).draw( false );
        } else {
            table_detail.row(rowindex).data([
                formData.get('itemid'),
                item,
                formatRupiah(String(formData.get('harga')), 'Rp. '),
                formData.get('jumlah'),
                formatRupiah(String(jumlah*harga), 'Rp. '),
                formData.get('diskon'),
                formData.get('ppn'),
                formData.get('noakunpersediaan'),
                formatRupiah(String(total), 'Rp. '),
                formatRupiah(String(jumlahkasitem), 'Rp. '),
                `<a href="javascript:void(0)" class="edit_detail btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                <a href="javascript:void(0)" class="delete_detail btn btn-danger btn-sm"><i class="fas fa-trash"></i></i></a>`
            ]).draw( false );
        }

        $('#modal_add_detail').modal('hide')
        detail_array()
    }

    function detail_array() {
        var arr = table_detail.data().toArray();
        $('#detail_array').val( JSON.stringify(arr) );
    }

    //setting keyup format rupiah
    function UbahInputRUpiah(nama_inputan){
        $(nama_inputan).on('keyup',function(){
            var nilai= $(this).val();
            $(this).val(formatRupiah(String(nilai), 'Rp. '));
        });
    }

    //simpan data
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