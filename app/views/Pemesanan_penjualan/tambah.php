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
                                            <label><?php echo lang('Jenis Pembelian') ?>:</label>
                                            <select class="form-control jenis_pembelian" name="jenis_pembelian" required>
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
                                        <button type="button" class="btn btn-sm btn-primary btn_add_detail"><i class="fas fa-plus"></i> <?php echo lang('add_new') ?></button>
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
                                                <th>ID</th>
                                                <th colspan="6">&nbsp;</th>
                                                <th class="text-right"><?php echo lang('total') ?></th>
                                                <th class="text-center" id="total_total">
                                                <th></th>
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
                                <input type="hidden" name="detail_array" id="detail_array">
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

<div id="modal_edit_detail" class="modal fade">
    <div class="modal-dialog">
        <form action="javascript:edit_detail_barang()" id="form3" enctype="multipart/form-data" method="POST">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Edit Detail</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="edit_rowindex">
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
                        <div id="edit_detail_barang"></div>
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

    $(document).ready(function(){
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
    })

    $(document).on('change','.jenis_pembelian',function(){
        if ($(this).val() == 'jasa') {
            $('.jenis_barang').attr("disabled", true);
            $('#rekanan').empty();
            $('#gudang').empty();
        } else {
            $('.jenis_barang').attr("disabled", false);
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
        }
    })

    $(document).on('click','.btn_add_detail',function(){
        $('#modal_add_detail').modal('show');
        $('.itemid').empty();
        var jenis_pembelian = $('.jenis_pembelian').val();
        switch (jenis_pembelian) {
            case 'barang':
                url = base_url + 'select2_item';
                break;
            case 'jasa':
                url = base_url + 'select2_item_jasa';
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

    $(document).on('change','.itemid',function(){
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
                        var jenis_pembelian = $('.jenis_pembelian').val();
                        switch (jenis_pembelian) {
                            case 'barang':
                                for (let index = 0; index < data.length; index++) {
                                    var hargabeli       = data[index].tarif;
                                    var jumlahkasitem   = data[index].jumlah;
                                    detail_barang       =  `<input type="hidden" class="form-control" id="noakun`+index+`" name="noakun[]" required value="${data[index].koderekening}"><input type="hidden" class="form-control" id="sisapaguitem`+index+`" name="sisapaguitem[]" required value="${data[index].jumlah}">`
                                }
                                break;
                            case 'jasa':
                                
                                break;
                        
                            default:
                                break;
                        }
                        
                        $('#detail_barang').append(detail_barang);
                    }
                })
            }
        }
    })

    function save_detail(no) {
        var form            = $('#form2')[0];
        var formData        = new FormData(form);
        var barang          = $('.itemid :selected');
        var jenis_pembelian = $('.jenis_pembelian').val();
        var no_baru         = no + 1;
        for (let index = 0; index < barang.length; index++) {
            var item    = barang[index].text;
            if(table_detail.hasValue(item)) {
                swal("Gagal!", "Item sudah ada", "error");
                return;
            }
            switch (jenis_pembelian) {
                 case 'jasa':
                    noakun  = 0;
                    sisapaguitem = '0';
                    break;

                case 'barang':
                    noakun          = $('#noakun'+index).val();
                    sisapaguitem    = $('#sisapaguitem'+index).val();
                    break;

                default:
                    break;
            }
            $('#noakun'+index).remove();
            $('#sisapaguitem'+index).remove();
            table_detail.row.add([
                barang[index].value,
                item,
                `<input type="text" class="form-control" onkeyup="sum('${index}${no}', '${no}');" name="harga[]" id="harga${index}${no}">`,
                `<input type="text" class="form-control" onkeyup="sum('${index}${no}', '${no}');" name="jumlah[]" id="jumlah${index}${no}">`,
                `<input type="text" class="form-control" id="subtotal${index}${no}" readonly><input type="hidden" name="subtotal[]" id="subtotal_asli${index}${no}" readonly>`,
                `<input type="text" class="form-control" onkeyup="sum_total('${index}${no}', '${no}');" name="diskon[]" id="diskon${index}${no}">`,
                `<input type="text" class="form-control" onkeyup="sum_total('${index}${no}', '${no}');" name="ppn[]" id="ppn${index}${no}">`,
                noakun,
                `<input type="text" class="form-control" name="total[]" id="total${index}${no}" readonly>`,
                `<input type="hidden" name="sisapaguitem[]" id="sisapaguitem_lama${index}${no}" value="${sisapaguitem}"><input type="text" class="form-control" id="sisapaguitem_baru${index}${no}" value="${formatRupiah(sisapaguitem, 'Rp.')+',00'}" readonly>`,
                `<a href="javascript:void(0)" class="edit_detail" id_barang="${barang[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                <a href="javascript:void(0)" class="delete_detail text-danger"><i class="fas fa-trash"></i></a>`
            ]).draw( false );
            detail_array()
            var checklist   = `<tr class="bg-light">
                                    <td style="width:5px;padding-right:0px;"><input type="checkbox" checked="checked"></td>
                                    <td>${item}</td>
                                </tr>`;
            // $('#list_barang').html(checklist);
            // $('#edit_list_barang').html(checklist);
            no++;
            // $('#harga00').autoNumeric('init');
        }
        $('#modal_add_detail').modal('hide');
        $('#form2').attr('action', 'javascript:save_detail('+no_baru+')');
        total_total.push(no);
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
        if (isNaN(parseInt(txtFirstNumberValue))) {
            var result  = 0;    
        }
        if (isNaN(parseInt(txtSecondNumberValue))) {
            var result  = 0;    
        }
        var sisapaguitem            = document.getElementById('sisapaguitem_lama'+no).value;
        var sisapaguitem_baru       = String(parseInt(sisapaguitem) - result);
        if (!isNaN(result)) {
            document.getElementById('subtotal'+no).value        = formatRupiah(String(result), 'Rp.')+',00';
            document.getElementById('subtotal_asli'+no).value   = result;
            document.getElementById('total'+no).value           = formatRupiah(String(result), 'Rp.')+',00';
        }
        else if(txtFirstNumberValue !=null && txtSecondNumberValue == null){
            document.getElementById('subtotal'+no).value = txtFirstNumberValue;
            document.getElementById('total'+no).value = txtFirstNumberValue;
        }else{
            document.getElementById('subtotal'+no).value        = formatRupiah(String(result), 'Rp.')+',00';
            document.getElementById('subtotal_asli'+no).value   = result;
            document.getElementById('total'+no).value           = formatRupiah(String(result), 'Rp.')+',00';
        }
        document.getElementById('sisapaguitem_baru'+no).value = formatRupiah(sisapaguitem_baru, 'Rp.')+',00';
        total_total[no1] = [];
        total_total[no1].push(parseInt(result));
        total_semua();
    }

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
        var sisapaguitem        = document.getElementById('sisapaguitem_lama'+no).value;
        var sisapaguitem_baru   = String(parseInt(sisapaguitem) - parseInt(total));
        document.getElementById('total'+no).value = formatRupiah(String(total), 'Rp.')+',00';
        document.getElementById('sisapaguitem_baru'+no).value = formatRupiah(sisapaguitem_baru, 'Rp.')+',00';
        total_total[no1]    = [];
        total_total[no1].push((parseInt(total)));
        total_semua();
    }
    
    function total_semua() {
        a                   = 0;
        total_total.forEach(b => {
            a   += parseInt(b);
        });
        $('#total_total').html(a);
    }

    $('#table_detail tbody').on('click','.edit_detail',function(){
        var id          = $('.edit_detail').attr('id_barang'); 
        var tr          = table_detail.row($(this).parents('tr')).index();
        var rowindex    = table_detail.row($(this).parents('tr')).index();
        $('input[name=edit_rowindex]').val(rowindex);
        var jenis_pembelian = $('.jenis_pembelian').val();
        switch (jenis_pembelian) {
            case 'barang':
                url = base_url + 'select2_item';
                break;
            case 'jasa':
                url = base_url + 'select2_item_jasa';
                break;
            default:
                break;
        }
        ajax_select({ id: '.edit_itemid', url: url, selected: { id: id } });
        $('#modal_edit_detail').modal('show');
    })

    function edit_detail_barang(no) {
        var formData        = new FormData($('#form3')[0]);
        var rowindex        = formData.get('edit_rowindex');
        var barang          = $('.edit_itemid :selected');
        var jenis_pembelian = $('.jenis_pembelian').val();
        for (let index = 0; index < barang.length; index++) {
            var item    = barang[index].text;
            if(table_detail.hasValue(item)) {
                // NotifyError('Item sudah ada!');
                swal("Gagal!", "Item sudah ada", "error");
                return;
            }
            switch (jenis_pembelian) {
                case 'jasa':
                    noakun  = 0;
                     sisapaguitem    = 0;
                    break;
                case 'barang':
                    noakun          = $('#noakun'+index).val();
                    sisapaguitem    = $('#sisapaguitem'+index).val();
                    break;
            
                default:
                    break;
            }
            table_detail.row(rowindex).data([
                barang[index].value,
                item,
                `<input type="text" class="form-control" onkeyup="sum('${index}${rowindex}', '${rowindex}');" name="harga[]" id="harga${index}${rowindex}">`,
                `<input type="text" class="form-control" onkeyup="sum('${index}${rowindex}', '${rowindex}');" name="jumlah[]" id="jumlah${index}${rowindex}">`,
                `<input type="text" class="form-control" id="subtotal${index}${rowindex}" readonly><input type="hidden" name="subtotal[]" id="subtotal_asli${index}${rowindex}" readonly>`,
                `<input type="text" class="form-control" onkeyup="sum_total('${index}${rowindex}', '${rowindex}');" name="diskon[]" id="diskon${index}${rowindex}">`,
                `<input type="text" class="form-control" onkeyup="sum_total('${index}${rowindex}', '${rowindex}');" name="ppn[]" id="ppn${index}${rowindex}">`,
                noakun,
                `<input type="text" class="form-control" name="total[]" id="total${index}${rowindex}" readonly>`,
                `<input type="hidden" name="sisapaguitem[]" id="sisapaguitem_lama${index}${rowindex}" value="${sisapaguitem}"><input type="text" class="form-control" id="sisapaguitem_baru${index}${rowindex}" value="${formatRupiah(sisapaguitem, 'Rp.')+',00'}" readonly name="sisapaguitem_baru[]" >`,
                `<a href="javascript:void(0)" class="edit_detail" id_barang="${barang[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                <a href="javascript:void(0)" class="delete_detail text-danger" onclick="delete_detail('${no}')"><i class="fas fa-trash"></i></a>`
            ]).draw( false );
            detail_array()
            var checklist   = `<tr class="bg-light">
                                    <td style="width:5px;padding-right:0px;"><input type="checkbox" checked="checked"></td>
                                    <td>${item}</td>
                                </tr>`;
            // $('#list_barang').html(checklist);
            // $('#edit_list_barang').html(checklist);
            rowindex++;
        }
        $('#modal_edit_detail').modal('hide')
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
                        var jenis_pembelian = $('.jenis_pembelian').val();
                        switch (jenis_pembelian) {
                            case 'barang':
                                for (let index = 0; index < data.length; index++) {
                                    var hargabeli       = data[index].tarif;
                                    var jumlahkasitem   = data[index].jumlah;
                                    detail_barang       =  `<input type="hidden" class="form-control" id="noakun`+index+`" name="noakun[]" required value="${data[index].koderekening}"><input type="hidden" class="form-control" id="sisapaguitem`+index+`" name="sisapaguitem[]" required value="${data[index].jumlah}">`
                                }
                                break;
                            case 'jasa':
                                
                                break;
                        
                            default:
                                break;
                        }
                        
                        $('#edit_detail_barang').append(detail_barang);
                    }
                })
            }
        }
    })

    $('#table_detail tbody').on('click','.delete_detail',function(){
        var rowindex    = table_detail.row($(this).parents('tr')).index();
        table_detail.row($(this).parents('tr')).remove().draw();
        detail_array();
        total_total.splice(rowindex, 1);
        total_semua();
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