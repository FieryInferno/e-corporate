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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{title}</h3>
                </div>
            <!-- /.card-header -->
                <div class="card-body">
                    <form action="javascript:save()" id="form1">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo lang('notrans') ?>:</label>
                                    <input type="text" class="form-control" name="notrans" required placeholder="AUTO" disabled>
                                </div>
                                <div class="form-group">
                                    <label><?php echo lang('supplier') ?>:</label>
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
                                <div class="form-group">
                                    <label>Setup Jurnal : </label>
                                    <div class="input-group"> 
                                        <input type="hidden" name="setupJurnal" id="setupJurnal1">
                                        <input type="text" class="form-control" disabled id="setupJurnal2">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Perusahaan:</label>
                                    <div class="input-group"> 
                                        <select class="form-control perusahaanid" name="perusahaanid"></select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Tempo:</label>
                                    <div class="input-group"> 
                                        <input type="date" class="form-control" name="tanggalTempo" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Pilih Rekening Bank:</label>
                                    <div class="input-group"> 
                                        <select class="form-control rekening" name="rekening"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Sisa Kas Bank:</label>
                                    <div class="input-group"> 
                                        <input type="text" class="form-control sisakasbank" name="sisakasbank" required readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 mt-3 table-responsive">
                            <div class="mt-3 mb-3">
                                <button type="button" class="btn btn-sm btn-primary btn_add_detail"><?php echo lang('add_new') ?></button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-xs table-striped table-borderless table-hover index_datatable" id="table_detail">
                                    <thead>
                                        <tr class="table-active">
                                            <th>ID</th>
                                            <th class="text-right" style="width:50px;">Nomor Penerimaan</th>
                                            <th class="text-right" style="width:50px;">Kode Barang</th>
                                            <th class="text-right">Nama Barang</th>
                                            <th class="text-right">Departemen</th>
                                            <th class="text-right" style="width:50px;">Jumlah</th>
                                            <th class="text-right">Subtotal</th>
                                            <th class="text-right">Biaya Pengiriman</th>
                                            <th class="text-center">Pajak</th>
                                            <th class="text-center">Total Faktur</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th colspan="5">Total</th>
                                            <th class="text-right"></th>
                                            <th class="text-right"></th>
                                            <th class="text-right"></th>
                                            <th class="text-right"></th>
                                            <th class="text-right"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                        <label><?php echo lang('Uang Muka') ?>:</label>
                                        <input class="form-control um" name="um" id="a0" onkeyup="format('um'), hitungtum()">
                                    </div>
                                    <div class="row mb-3">                            
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo lang('Total Uang Muka + Term') ?>:</label>
                                            <div class="alert alert-danger alert-dismissible" style="display:none" id="alertjumlah">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                Jumlah Total dan Jumlah Uang Muka tidak sama
                                            </div>
                                            <input type="hidden" name="grandtotal" readonly id="grandtotal">
                                            <input class="form-control tum" name="tum" readonly id="a2">
                                        </div>
                                    </div> 
                                    <div class="col-md-3">                       
                                        <div class="form-group">
                                            <label><?php echo lang('Jumlah Term') ?>:</label>
                                            <input class="form-control jtem" name="jtem" id="a1">
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
                                        <input type="text" class="form-control" name="a1" placeholder="Angsuran 1" id="a3" onkeyup="format('a3'), hitungterm(), hitungtum()">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('Term 2') ?>:</label>
                                        <input type="text" class="form-control" name="a2" placeholder="Angsuran 2" id="a4" onkeyup="format('a4'), hitungterm(), hitungtum()">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('Term 3') ?>:</label>
                                        <input type="text" class="form-control" name="a3" placeholder="Angsuran 3" id="a5" onkeyup="format('a5'), hitungterm(), hitungtum()">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('Term 4') ?>:</label>
                                        <input type="text" class="form-control" name="a4" placeholder="Angsuran 4" id="a6" onkeyup="format('a6'), hitungterm(), hitungtum()">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo lang('Term 5') ?>:</label>
                                        <input type="text" class="form-control" name="a5" placeholder="Angsuran 5" id="a7" onkeyup="format('a7'), hitungterm(), hitungtum()">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('Term 6') ?>:</label>
                                        <input type="text" class="form-control" name="a6" placeholder="Angsuran 6" id="a8" onkeyup="format('a8'), hitungterm(), hitungtum()">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('Term 7') ?>:</label>
                                        <input type="text" class="form-control" name="a7" placeholder="Angsuran 7" id="a9" onkeyup="format('a9'), hitungterm(), hitungtum()">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('Term 8') ?>:</label>
                                        <input type="text" class="form-control" name="a8" placeholder="Angsuran 8" id="a10" onkeyup="format('a10'), hitungterm(), hitungtum()">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="detail_array" id="detail_array">
                        <div class="text-left">
                            <div class="btn-group">
                                <a href="{site_url}pemesanan_pembelian" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                                <button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            <!-- /.card-body -->
            <div class="card-footer">          
        </div>
    </section>
</div>

<div id="modal_add_detail" class="modal fade">
    <div class="modal-dialog modal-lg">
        <form action="javascript:save_detail()" id="form2">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo lang('add_new') ?></h5>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="rowindex">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo lang('item') ?>:</label>
                                    <select class="form-control nopenerimaan" name="nopenerimaan[]" required style="width:100%" multiple>
                                </select>
                            </div>
                        </div>
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

<script type="text/javascript">
    var base_url = '{site_url}faktur_pembelian/';
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
        "footerCallback": function ( row, data, start, end, display ) {
			var api = this.api(), data;

			// Remove the formatting to get integer data for summation
			var intVal = function ( i ) {
				return typeof i === 'string' ?
                    i.replace(/[\Rp.]/g, '').replace(/,00/g, '')*1 :
					typeof i === 'number' ?
						i : 0;
			};

			// Total over all pages
			subtotal = api
				.column( 6 )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				}, 0 );
				
            biayapengiriman = api
				.column( 7 )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				}, 0 );

            pajak = api
				.column( 8 )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				}, 0 );

            totaltotal = api
				.column( 9 )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				}, 0 );

			// Update footer
			$( api.column( 6 ).footer() ).html(formatRupiah(String(subtotal))+',00');
            $( api.column( 7 ).footer() ).html(formatRupiah(String(biayapengiriman))+',00');
            $( api.column( 8 ).footer() ).html(formatRupiah(String(pajak))+',00');
            $( api.column( 9 ).footer() ).html(formatRupiah(String(subtotal+biayapengiriman+pajak))+',00');
		}
    })

    $(document).ready(function(){
        ajax_select({ id: '.kontakid', url: base_url + 'select2_kontak', selected: { id: '{kontakid}' } });
        ajax_select({ id: '.gudangid', url: base_url + 'select2_gudang', selected: { id: '{gudangid}' } });
        ajax_select({ 
            id          : '.perusahaanid', 
            url         : '{site_url}perusahaan/select2', 
            selected    : { 
                id  : null 
            } 
        });
        ajax_select({ 
            id          : '.rekening', 
            url         : '{site_url}rekening/select2', 
            selected    : { 
                id  : null 
            } 
        });
    })

    $('#table_detail tbody').on('click','.delete_detail',function(){
        table_detail.row($(this).parents('tr')).remove().draw();
        detail_array();
    })

    $('#table_detail tbody').on('click','.edit_detail',function(){
        var tr = table_detail.row($(this).parents('tr')).index();
        var itemid = table_detail.cell(tr,0).data();
        var harga = table_detail.cell(tr,2).data();
        var jumlah = table_detail.cell(tr,3).data();
        var diskon = table_detail.cell(tr,5).data();
        var ppn = table_detail.cell(tr,6).data();

        $('input[name=rowindex]').val(tr);
        $('.itemid').val(itemid).trigger('change');
        $('input[name=harga]').val(harga);
        $('input[name=jumlah]').val(jumlah);
        $('input[name=diskon]').val(diskon);
        $('input[name=ppn]').val(ppn);
        $('#modal_add_detail').modal('show');
    })

    $(document).on('click','.btn_add_detail',function(){
        $('#modal_add_detail').modal('show')
        $('input[name=rowindex]').val(null);
        $('input[name=harga]').val(0);
        $('input[name=jumlah]').val(0);
        $('input[name=diskon]').val(0);
        $('input[name=ppn]').val(0);
        ajax_select({ id: '.itemid', url: base_url + 'select2_item', selected: { id: null } });
        $('.itemid').val(null).trigger('change');
    })

    function save_detail() {
        var form        = $('#form2')[0];
        var formData    = new FormData(form);
        var pengiriman  = $('.nopenerimaan :selected');
        for (let index = 0; index < pengiriman.length; index++) {
            var id  = pengiriman[index].text;
            if(table_detail.hasValue(id)) {
                swal("Gagal!", "Item sudah ada", "error");
                return;
            }
            $.ajax({
                url: '{site_url}pengiriman_pembelian/get_detail_item',
                method: 'post',
                datatype: 'json',
                data: {
                    id  : pengiriman[index].value
                },
                success: function(data) {
                    var detail  = '';
                    $.ajax({
                        url         : '{site_url}SetUpJurnal/get',
                        dataType    : 'json',
                        method      : 'post',
                        data        : {
                            jenis       : data[0].cara_pembayaran,
                            formulir    : 'fakturPembelian'
                        },
                        success: function(data) {
                            $('#setupJurnal1').val(data['idSetupJurnal']);
                            $('#setupJurnal2').val(data['kodeJurnal']);
                        }
                    });
                    for (let i = 0; i < data[index].detail_pengiriman.length; i++) {
                        var subtotal        = parseInt(data[index].detail_pengiriman[i].jumlahditerima) * parseInt(data[index].detail_pengiriman[i].harga);
                        var biayapengiriman = data[index].detail_pengiriman[i].biayapengiriman;
                        var pajak           = data[index].detail_pengiriman[i].pajak;
                        table_detail.row.add([
                            pengiriman[index].value,
                            data[index].notrans,
                            data[index].detail_pengiriman[i].kode_barang + 
                            `<input type="hidden" value="${data[index].detail_pengiriman[i].idbarang}" name="idbarang[]">
                            <input type="hidden" value="${parseInt(pajak)}" name="pajak[]">
                            <input type="hidden" value="${parseInt(biayapengiriman)}" name="biaya_pengiriman[]">
                            <input type="hidden" name="idpengiriman[]" value="${pengiriman[index].value}">`,
                            data[index].detail_pengiriman[i].nama_barang,
                            data[index].departemen,
                            data[index].detail_pengiriman[i].jumlahditerima,
                            formatRupiah(String(subtotal)) + ',00',
                            formatRupiah(biayapengiriman) + ',00',
                            formatRupiah(pajak) + ',00',
                            formatRupiah(String(subtotal + parseInt(biayapengiriman) + parseInt(pajak))) + ',00' +
                            `<input type="hidden" value="${subtotal + parseInt(biayapengiriman) + parseInt(pajak)}" name="total[]">`,
                            `<a href="javascript:void(0)" class="edit_detail" id_barang="${pengiriman[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                            <a href="javascript:void(0)" class="delete_detail text-danger"><i class="fas fa-trash"></i></a>`
                        ]).draw( false );
                        detail_array();
                    }
                    for (let j = 0; j < 11; j++) {
                        a   = parseInt($('#a' + j).val().replace(/[\Rp.]/g, '').replace(/,00/g, ''));
                        if (isNaN(a)) {
                            a   = 0;
                        }
                        switch (j) {
                            case 0:
                                a   += parseInt(data[index].angsuran.uangmuka);
                                break;
                            case 1:
                                a   += parseInt(data[index].angsuran.jumlahterm);
                                break;
                            case 2:
                                a   += parseInt(data[index].angsuran.total);
                                break;
                            case 3:
                                a   += parseInt(data[index].angsuran.a1);
                                break;
                            case 4:
                                a   += parseInt(data[index].angsuran.a2);
                                break;
                            case 5:
                                a   += parseInt(data[index].angsuran.a3);
                                break;
                            case 6:
                                a   += parseInt(data[index].angsuran.a4);
                                break;
                            case 7:
                                a   += parseInt(data[index].angsuran.a5);
                                break;
                            case 8:
                                a   += parseInt(data[index].angsuran.a6);
                                break;
                            case 9:
                                a   += parseInt(data[index].angsuran.a7);
                                break;
                            case 10:
                                a   += parseInt(data[index].angsuran.a8);
                                break;
                        }
                        $('#a' + j).val(formatRupiah(String(a)) + ',00');
                    }
                    $('#detail').html(detail);
                }
            })
            $('#modal_add_detail').modal('hide');
        }
    }

    function detail_array() {
        var arr = table_detail.data().toArray();
        $('#detail_array').val( JSON.stringify(arr) );
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

    $(document).on('change', '.kontakid', function () {
        ajax_select({ 
            id          : '.nopenerimaan', 
            url         : '{site_url}Pengiriman_pembelian/select2/' + $('.kontakid').val()
        });
    })
</script>