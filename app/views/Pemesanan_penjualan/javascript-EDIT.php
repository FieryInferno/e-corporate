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
                `<a href="javascript:void(0)" class="edit_detail_jasa" id_jasa="${jasa[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp; <a href="javascript:void(0)" class="delete_detail text-danger"><i class="fas fa-trash"></i></a>`
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
                `<a href="javascript:void(0)" class="edit_detail_budgetevent" id_budgetevent="${budget[index].value}"><i class="fas fa-pencil-alt"></i></a>&nbsp; <a href="javascript:void(0)" class="delete_detail text-danger"><i class="fas fa-trash"></i></a>`
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
        detail = formData.get('detail_array');
        if(detail.length < 10) {
            swal("Gagal!", "Silahkan isi detail terlebih dulu!", "error");
            return false;
        }
        var cara_pembayaran =  $('.cara_pembayaran').val();
        if (cara_pembayaran == 'cash'){
            var total_penjualan =  $('input[name=total_penjualan]').val().replace(/[^,\d]/g, '').toString();
            var uangmuka_term = $('input[name=tum]').val().replace(/[^,\d]/g, '').toString(); 
            if(total_penjualan != uangmuka_term) {
                swal("Gagal!", "Total penjualan dan total uang muka + term tidak sama!", "error");
                return false;
            }
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