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
                        <li class="breadcrumb-item"><a href="<?= base_url('pembelian'); ?>">Pembelian</a></li>
                        <li class="breadcrumb-item active"><? $title; ?></li>
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
                            <h3 class="card-title"><?= $title; ?></h3>
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
                                            <select class="form-control kontakid" name="kontakid" disabled></select>
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
                                    <div class="col-md-2">
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
                                        <div class="row">
                                            <div class="col-2">
                                                <button type="button" class="btn btn-sm btn-primary btn_add_detail"><i class="fas fa-plus"></i> <?php echo lang('add_new') ?></button>
                                            </div>
                                            <div class="col-10">
                                                <button type="button" class="btn btn-sm btn-primary" style="display:none;" id="tombol_jasa"><i class="fas fa-plus"></i> Tambah Jasa</button>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-bordered" id="table_detail">
                                        <thead class="{bg_header}">
                                            <tr>
                                                <th>ID</th>
                                                <th><?php echo lang('item') ?></th>
                                                <th class="text-right"><?php echo lang('price') ?></th>
                                                <th class="text-right" style="width:50px;"><?php echo lang('qty') ?></th>
                                                <th class="text-right"><?php echo lang('subtotal') ?></th>
                                                <th class="text-right" style="width:50px;"><?php echo lang('discount') ?></th>
                                                <th class="text-right" style="width:50px;">Pajak</th>
                                                <th class="text-right" style="width:50px;">Biaya Pengiriman</th>
                                                <th class="text-right" style="width:50px;"><?php echo lang('no akun') ?></th>
                                                <th class="text-right"><?php echo lang('total') ?></th>
                                                <th class="text-right"><?php echo lang('sisa pagu item') ?></th>
                                                <th class="text-center" style="width:50px;"><?php echo lang('action') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody> </tbody>
                                        <tfoot class="bg-light">
                                            <tr>
                                                <th>ID</th>
                                                <th colspan="7">&nbsp;</th>
                                                <th class="text-right"><?php echo lang('total') ?></th>
                                                <th class="text-center" id="total_total">
                                                <th></th>
                                                <th></th>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                            <label><?php echo lang('Uang Muka') ?>:</label>
                                            <input class="form-control um" name="um" id="um" onkeyup="format('um'), hitungtum()">
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
                                                <input class="form-control tum" name="tum" readonly>
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
                                            <input type="text" class="form-control" name="a1" placeholder="Angsuran 1" id="a1" onkeyup="format('a1'), hitungterm(), hitungtum()">
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo lang('Term 2') ?>:</label>
                                            <input type="text" class="form-control" name="a2" placeholder="Angsuran 2" id="a2" onkeyup="format('a2'), hitungterm(), hitungtum()">
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo lang('Term 3') ?>:</label>
                                            <input type="text" class="form-control" name="a3" placeholder="Angsuran 3" id="a3" onkeyup="format('a3'), hitungterm(), hitungtum()">
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo lang('Term 4') ?>:</label>
                                            <input type="text" class="form-control" name="a4" placeholder="Angsuran 4" id="a4" onkeyup="format('a4'), hitungterm(), hitungtum()">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo lang('Term 5') ?>:</label>
                                            <input type="text" class="form-control" name="a5" placeholder="Angsuran 5" id="a5" onkeyup="format('a5'), hitungterm(), hitungtum()">
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo lang('Term 6') ?>:</label>
                                            <input type="text" class="form-control" name="a6" placeholder="Angsuran 6" id="a6" onkeyup="format('a6'), hitungterm(), hitungtum()">
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo lang('Term 7') ?>:</label>
                                            <input type="text" class="form-control" name="a7" placeholder="Angsuran 7" id="a7" onkeyup="format('a7'), hitungterm(), hitungtum()">
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo lang('Term 8') ?>:</label>
                                            <input type="text" class="form-control" name="a8" placeholder="Angsuran 8" id="a8" onkeyup="format('a8'), hitungterm(), hitungtum()">
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
    <div class="modal-dialog modal-lg">
        <form action="javascript:save_detail(0, 'barang')" id="form2">
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

<div id="modal_add_jasa" class="modal fade">
    <div class="modal-dialog modal-lg">
        <form action="javascript:save_detail(0, 'jasa1')" id="form_jasa">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jasa</h5>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="rowindex">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Jasa :</label>
                                <select class="form-control id_jasa" name="id_jasa[]" required style="width:100%" multiple>
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

<div id="tambah_modal_pajak"></div>

<div id="tambah_modal_pilih_pajak"></div>

<div id="tambah_modal_pilih_pengiriman"></div>

<script>
    var base_url        = '{site_url}requiremen/';
    var total_total     = [];

    function addPajak(elem, no, id) {
		const kode_pajak 	= $(elem).attr('kode_pajak');
        const nama_pajak 	= $(elem).attr('nama_pajak');
        const kode_akun 	= $(elem).attr('kode_akun');
        const nama_akun 	= $(elem).attr('nama_akun');
		const stat			= $(elem).is(":checked");
        const table			= $('#isi_tbody_pajak'+id);
		// var no1				= 0;		
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
			url     : '{site_url}pajak/get',
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
                    i.replace(/[\Rp.]/g, '').replace(/,00/g)*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            total = api.column( 9 ).data().reduce( function (a, b) {
                return intVal(a) + intVal(b); 
            }, 0 );

            $( api.column( 9 ).footer() ).html(
                formatRupiah(String(total), 'Rp. ')+',00'
            );

            $('.subtotalhead').val( numeral(total).format() )
            $('.totalhead').val( numeral(total).format() )
        }
    })

    $(document).ready(function(){
        ajax_select({ id: '.gudangid', url: base_url + 'select2_gudang', selected: { id: null } });
        ajax_select({id: '#perusahaan',	url: base_url + 'select2_mperusahaan', selected: { id: null } });			
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

        getListPajak();
    })

    $(document).on('change','.jenis_pembelian',function(){
        if ($(this).val() == 'jasa') {
            $('.jenis_barang').attr("disabled", true);
            $('#rekanan').empty();
            $('#gudang').empty();
            $('#form2').attr("action", "javascript:save_detail(0, 'jasa')");
        } else if($(this).val() == 'barang') {
            $('.jenis_barang').attr("disabled", false);
            $('#rekanan').html(`
                <label><?php echo lang('rekanan') ?>:</label>
                <select class="form-control kontakid" name="kontakid" disabled></select>
            `);
            $('#gudang').html(`
                <label><?php echo lang('gudang') ?>:</label>
                <select class="form-control gudangid" name="gudangid"></select>
            `);
            ajax_select({ id: '.gudangid', url: base_url + 'select2_gudang', selected: { id: null } });
            $('#tombol_jasa').css('display', 'none');
            $('#form2').attr("action", "javascript:save_detail(0, 'barang')");
        } else {
            $('.gudangid').attr("disabled", true);
            $('#tombol_jasa').css('display', 'block');
            $('#form2').attr("action", "javascript:save_detail(0, 'barang')");
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
                url = base_url + 'select2_item';
                break;
        }
        $.ajax({
            url         : url,
            method      : 'post',
            datatype    : 'json',
            success: function(data) {
                isi = "";
                for (let index = 0; index < data.length; index++) {
                    isi += `<option value="${data[index].itemid}">${data[index].text}</option>`
                }
                $('.itemid').append(isi);
            }
        })
        $('.itemid').select2();
    })

    $('#tombol_jasa').click(function() {
        $('#modal_add_jasa').modal('show');
        $('.id_jasa').empty();
        var jenis_pembelian = $('.jenis_pembelian').val();
        $.ajax({
            url         : base_url + 'select2_item_jasa',
            method      : 'post',
            datatype    : 'json',
            success: function(data) {
                isi = "";
                for (let index = 0; index < data.length; index++) {
                    isi += `<option value="${data[index].itemid}">${data[index].text}</option>`
                }
                $('.id_jasa').append(isi);
            }
        })
        $('.id_jasa').select2();
    })

    $(document).on('change','.itemid, .id_jasa',function(){
        var rowindex        = $('input[name=rowindex]').val();
        var itemid          = $(this).val();    
        var jenis_pembelian = $('.jenis_pembelian').val();
        if(!rowindex) {
            if(itemid) {
                $.ajax({
                    url         : base_url + 'get_detail_item',
                    method      : 'post',
                    datatype    : 'json',
                    data        : {
                        itemid: itemid
                    },
                    success: function(data) {
                        var detail_barang   = '';
                        for (let index = 0; index < data.length; index++) {
                            detail_barang   +=  `
                                <input type="hidden" class="form-control" id="noakun`+index+`" name="noakun[]" required value="${data[index].akunno}">
                                <input type="hidden" class="form-control" id="sisapaguitem`+index+`" name="sisapaguitem[]" required value="${data[index].jumlah}">`;
                        }
                        $('#detail_barang').html(detail_barang);
                    }
                })
            }
        }
    })

    function save_detail(no, jenis) {
        switch (jenis) {
            case 'barang':
                var form            = $('#form2')[0];
                var formData        = new FormData(form);
                var barang          = $('.itemid :selected');        
                break;
            case 'jasa':
                var form            = $('#form2')[0];
                var formData        = new FormData(form);
                var barang          = $('.itemid :selected');   
                break;

            case 'jasa1':
                var form            = $('#form_jasa')[0];
                var formData        = new FormData(form);
                var barang          = $('.id_jasa :selected');   
                break;
        
            default:
                break;
        }
        var jenis_pembelian = $('.jenis_pembelian').val();
        for (let index = 0; index < barang.length; index++) {
            var item    = barang[index].text;
            if(table_detail.hasValue(item)) {
                swal("Gagal!", "Item sudah ada", "error");
                return;
            }
            noakun          = $('#noakun'+index).val();
            sisapaguitem    = $('#sisapaguitem'+index).val();
            $('#noakun'+index).remove();
            $('#sisapaguitem'+index).remove();
            table_detail.row.add([
                barang[index].value,
                item,
                `<input type="text" class="form-control" onkeyup="sum('${index}${no}', '${no}', '${jenis}');" name="harga[]" id="harga${index}${no}">`,
                `<input type="text" class="form-control" onkeyup="sum('${index}${no}', '${no}', '${jenis}');" name="jumlah[]" id="jumlah${index}${no}">`,
                `<input type="text" class="form-control" id="subtotal${index}${no}" readonly><input type="hidden" name="subtotal[]" id="subtotal_asli${index}${no}" readonly>`,
                `<input type="text" class="form-control" onkeyup="sum_total('${index}${no}', '${no}', '${jenis}');" name="diskon[]" id="diskon${index}${no}">`,
                `<input type="hidden" name="total_pajak[]" id="total_pajak${index}${no}" onchange="sum_total('${index}${no}', '${no}', '${jenis}');">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pajak${index}${no}" title="Tambah Pajak">
                    <i class="fas fa-balance-scale"></i>
                </button>`,
                `<input type="hidden" name="biayapengiriman[]" id="biaya_pengiriman${index}${no}">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_pengiriman${index}${no}" title="Tambah Biaya Pengiriman">
                    <i class="fas fa-shipping-fast"></i>
                </button>`,
                noakun,
                `<input type="text" class="form-control" name="total[]" id="total${index}${no}" readonly onchange="sum_total('${index}${no}', '${no}', '${jenis}');">`,
                `<input type="hidden" name="sisapaguitem[]" id="sisapaguitem_lama${index}${no}" value="${sisapaguitem}"><input type="text" class="form-control" id="sisapaguitem_baru${index}${no}" value="${formatRupiah(String(sisapaguitem), 'Rp.')+',00'}" readonly>`,
                `<a href="javascript:void(0)" class="edit_detail" id_barang="${barang[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                <a href="javascript:void(0)" class="delete_detail text-danger"><i class="fas fa-trash"></i></a>`
            ]).draw( false );
            detail_array()
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
                                                <thead class="{bg_header}">
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
                                                        <thead class="{bg_header}">
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
                                            <thead class="{bg_header}">
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
                url         : '{site_url}pajak/select2_noakun'
            });
            getListPajak(String(index) + String(no));
            total_total.push(no);
            no++;
            var no_baru = no;
        }
        
        $('#modal_add_detail').modal('hide');
        $('#modal_add_jasa').modal('hide');
        $('#form2').attr('action', 'javascript:save_detail('+no_baru+', "barang")');
        $('#form_jasa').attr('action', 'javascript:save_detail('+no_baru+', "jasa")');
    }

    $(document).on('select2:select','.pilih_akun',function(e){
        id  = $(this).attr('data-id');
        $.ajax({
            url         : '{site_url}noakun/get',
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

    function detail_array() {
        var arr = table_detail.data().toArray();
        $('#detail_array').val( JSON.stringify(arr) );
    }

    function sum(no, no1, jenis) {	
        var txtFirstNumberValue                     = document.getElementById('harga'+no).value.replace(/[^,\d]/g, '').toString();    
        document.getElementById('harga'+no).value   = formatRupiah(txtFirstNumberValue, 'Rp.');
		var txtSecondNumberValue                    = document.getElementById('jumlah'+no).value;
        var result                                  = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
        var pajak                 = document.getElementById('total_pajak'+no).value;
        if (!isNaN(parseInt(pajak))) {
            var result   = result + parseInt(pajak);    
        }
        if (isNaN(parseInt(txtFirstNumberValue))) {
            var result  = 0;    
        }
        if (isNaN(parseInt(txtSecondNumberValue))) {
            var result  = 0;    
        }
        if (jenis == 'barang') {
            var sisapaguitem            = document.getElementById('sisapaguitem_lama'+no).value;
            var sisapaguitem_baru       = String(parseInt(sisapaguitem) - result);
        }
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
        if (jenis == 'barang') {
            document.getElementById('sisapaguitem_baru'+no).value = formatRupiah(sisapaguitem_baru, 'Rp.')+',00';
        }
        total_total[no1] = [];
        total_total[no1].push(parseInt(result));
        total_semua();
	}

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
        if (jenis == 'barang') {
            var sisapaguitem            = document.getElementById('sisapaguitem_lama'+no).value;
            var sisapaguitem_baru       = String(parseInt(sisapaguitem) - total);
        }
        document.getElementById('total'+no).value = formatRupiah(String(total), 'Rp.')+',00';
        if (jenis == 'barang') {
            document.getElementById('sisapaguitem_baru'+no).value = formatRupiah(sisapaguitem_baru, 'Rp.')+',00';
        }
        total_total[no1]    = [];
        total_total[no1].push((parseInt(total)));
        total_semua();
    }
    
    function total_semua() {
        a   = 0;
        total_total.forEach(function callback(element, index, array) {
            a   += parseInt(element);
        })
        $('#total_total').html(formatRupiah(String(a), 'Rp. ')+',00');
        $('#grandtotal').val(a);
    }

    $('#table_detail tbody').on('click','.edit_detail',function(){
        var id              = $('.edit_detail').attr('id_barang'); 
        var tr              = table_detail.row($(this).parents('tr')).index();
        var rowindex        = table_detail.row($(this).parents('tr')).index();
        var jenis_pembelian = $('.jenis_pembelian').val();
        $('input[name=edit_rowindex]').val(rowindex);
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
        ajax_select({ 
            id: '.edit_itemid', 
            url: url, 
            selected: { 
                id: id 
            } 
        });
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
                swal("Gagal!", "Item sudah ada", "error");
                return;
            }
            switch (jenis_pembelian) {
                case 'jasa':
                    noakun  = 0;
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

    function format(id) {
            var angka   = $('#'+id).val()
            $('#'+id).val(formatRupiah(String(angka), 'Rp. '));
        }

        function hitungtum() {
            var um          = parseInt($('#um').val().replace(/[Rp. ]/g, ''));
            var jtem        = parseInt($('.jtem').val().replace(/[Rp. ]/g, ''));
            var grandtotal  = parseInt($('#grandtotal').val());
            if (isNaN(jtem)) {
                jtem = 0;
            }
            if (isNaN(um)) {
                um = 0;
            }
            tum = um + jtem;
            $('.tum').val(formatRupiah(String(tum), 'Rp. ') + ',00');
            if (tum !== grandtotal) {
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