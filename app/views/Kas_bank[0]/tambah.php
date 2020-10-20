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
                        <li class="breadcrumb-item"><a href="<?= base_url('kas_bank'); ?>">Kas Bank</a></li>
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
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label><?php echo lang('number') ?>:</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="nomor_kas_bank" id="nomor" placeholder="AUTO"readonly value="{kode_otomatis}">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="checkbox" name="" id="penomoran_otomatis" style="margin-top: 5%" checked onclick="Fungsi_nomor_otomatis()"> <?php echo lang('automatic_numbering') ?>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><?php echo lang('date') ?>:</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control datepicker" name="tanggal" required value="{tanggal}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label><?php echo lang('company') ?>:</label>
                                            <select id="id_perusahaan" class="form-control id_perusahaan" name="perusahaan" required></select>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo lang('Pejabat Keuangan') ?>:</label>    
                                            <select id="pejabat" class="form-control" name="pejabat" required></select>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo lang('information') ?>:</label>
                                            <textarea class="form-control" name="keterangan" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <?php $menu = array(
                                    'rincian_buku_kas_umum',
                                    'saldo_sumber_dana',
                                )?>
                                <ul class="nav nav-tabs  <?php echo menu_is_open($menu) ?>" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#rincian_buku_kas_umum" role="tab" data-toggle="tab"><?php echo lang('Rincian Buku Kas Umum') ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#saldo_sumber_dana" role="tab" data-toggle="tab"><?php echo lang('Saldo Sumber Dana') ?></a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="rincian_buku_kas_umum">

                                        <div class="text-center">
                                            <a href="javascript:penjualan()" class="btn bg-success"><?php echo lang('Penjualan') ?></a>&nbsp;
                                            <a href="javascript:pembelian()" class="btn bg-success"><?php echo lang('Pembelian') ?></a>&nbsp;
                                            <a href="javascript:budgetevent()" class="btn bg-success"><?php echo lang('Budget Event') ?></a>&nbsp;
                                            <a href="javascript:rewardsales()" class="btn bg-success"><?php echo lang('Reward Sales') ?></a>&nbsp;
                                            <a href="javascript:setorpajak()" class="btn bg-success"><?php echo lang('Setor Pajak') ?></a>&nbsp;
                                            <a href="javascript:PengajuanKasKecil()" class="btn bg-success"><?php echo lang('Kas Kecil')?></a>&nbsp;
                                            <a href="javascript:SetorKasKecil()" class="btn bg-success"><?php echo lang('Setor Kas Kecil')?></a>&nbsp;
                                            <a href="javascript:returjual()" class="btn bg-success"><?php echo lang('Retur Jual') ?></a>&nbsp;
                                            <a href="javascript:returbeli()" class="btn bg-success"><?php echo lang('Retur Beli') ?></a>&nbsp;
                                        </div>

                                        <div class="mb-3 mt-3 table-responsive">
                                            <table class="table table-bordered" id="table_detail_rincian_buku_kas_umum">
                                                <thead class="{bg_header}" id="atastabel" hidden>
                                                    <tr><th><?php echo lang('No') ?></th>
                                                        <th><?php echo lang('Tipe') ?></th>
                                                        <th><?php echo lang('date') ?></th>
                                                        <th><?php echo lang('Nomor Aktivitas') ?></th>
                                                        <th><?php echo lang('Penerimaan') ?></th>
                                                        <th><?php echo lang('Pengeluaran') ?></th>
                                                        <th><?php echo lang('Nomor Akun') ?></th>
                                                        <th><?php echo lang('Kode Unit') ?></th>
                                                        <th><?php echo lang('Nama Dapartemen') ?></th>
                                                        <th><?php echo lang('Sumber Dana') ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="isitabel"> 

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="saldo_sumber_dana">
                                        <div class="mb-3 mt-3 table-responsive">
                                            <table class="table table-bordered" id="table_detail_rincian_buku_kas_umum">
                                                <thead class="{bg_header}" id="atastabel" >
                                                    <tr><th><?php echo lang('No') ?></th>
                                                        <th><?php echo lang('Tipe') ?></th>
                                                        <th><?php echo lang('date') ?></th>
                                                        <th><?php echo lang('Nomor Aktivitas') ?></th>
                                                        <th><?php echo lang('Penerimaan') ?></th>
                                                        <th><?php echo lang('Pengeluaran') ?></th>
                                                        <th><?php echo lang('Nomor Akun') ?></th>
                                                        <th><?php echo lang('Kode Unit') ?></th>
                                                        <th><?php echo lang('Nama Dapartemen') ?></th>
                                                        <th><?php echo lang('Sumber Dana') ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="isitabel"> 
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                
                                <br>
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-2 text-right" style="margin-top: 1%">Total Penerimaan</div>
                                    <div class="col-md-3">
                                        <input type="text" id="penerimaan_sementara" class="form-control decimalnumber text-right" name="" readonly>
                                        <input type="hidden" id="penerimaan" class="form-control decimalnumber text-right" name="penerimaan" readonly>
                                    </div>
                                    <div class="col-md-2 text-right" style="margin-top: 1%">Total Pengeluaran</div>
                                    <div class="col-md-3">
                                        <input type="text" id="pengeluaran_sementara" class="form-control decimalnumber text-right" name="" readonly>
                                        <input type="hidden" id="pengeluaran" class="form-control decimalnumber text-right" name="pengeluaran" readonly>
                                    </div>
                                    <div class="col-md-3">
                                    
                                    </div>
                                            
                                </div>

                                <br>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="text-left">
                                    <div class="btn-group">
                                        <a href="{site_url}kas_bank" class="btn bg-danger"><?php echo lang('cancel') ?></a>
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

<script type="text/javascript">
    var base_url = '{site_url}kas_bank/';
    $.fn.dataTable.Api.register( 'hasValue()' , function(value) {
        return this .data() .toArray() .toString() .toLowerCase() .split(',') .indexOf(value.toString().toLowerCase())>-1
    })

    $(document).ready(function(){
        //combobox perusahaan
        ajax_select({
            id: '#id_perusahaan',
            url: base_url + 'select2_mperusahaan',
        });
    })

    //combobox nama penerima/pejabat
    $('#id_perusahaan').change(function(e) {
        $("#pejabat").val($("#pejabat").data("default-value"));
        $('input[name=penerimaan]').val('0'); 
        $('input[name=pengeluaran]').val('0');
        var perusahaanId = $('#id_perusahaan').children('option:selected').val();
        var num = perusahaanId.toString().padStart(3, "0")
        $('#corpCode').val(num);
        ajax_select({
            id: '#pejabat',
            url: base_url + 'select2_mdepartemen_pejabat/' + perusahaanId,
        });
    })

    //hitung penerimaan dan pengeluaran
    $('#id_perusahaan').change(function(){ 
        $.ajax({
            url: base_url + 'get_hitungtotal',
            method: 'post',
            datatype: 'json',
            data: { idper: $('select[name=perusahaan]').val() },
            success: function(data){
                $('input[id=penerimaan]').val(data.penerimaan); 
                document.getElementById('penerimaan_sementara').value=formatRupiah($('input[id=penerimaan]').val(),'Rp. ')+',00';
                $('input[id=pengeluaran]').val(data.pengeluaran);
                document.getElementById('pengeluaran_sementara').value=formatRupiah($('input[id=pengeluaran]').val(),'Rp. ')+',00';   
            }
        });
        return false;
    }); 

    //penomoran otomatis
    function Fungsi_nomor_otomatis() {
        var no = document.getElementById("nomor");
        var checkbox = document.getElementById("penomoran_otomatis");
        if (checkbox.checked) {
            no.value='{kode_otomatis}';
            no.readOnly = true;
        } else {
            no.value='';
            no.readOnly = false;
        }
    }

    //nomor kwitansi
    $('#id_perusahaan').change(function(){ 
        $.ajax({
            url : base_url + 'get_kode_perusahaan',
            method : "POST",
            data : {id: $('select[name=perusahaan]').val()},
            async : true,
            dataType : 'json',
            success: function(data){
                var kodeper = '';
                var i;
                for(i=0; i<data.length; i++){ kodeper += data[i].kode; }        
                var nomor = '{kode_otomatis}';
                var tipe = 'BANK';
                var tahun = '{tahun}';
                var kodeperusahaan = kodeper;
                document.getElementById("form1").nomor.value = nomor+'/'+kodeperusahaan+'/'+tipe+'/'+tahun;
            }
        });
        return false;
    }); 

    //panggil data penjualan
    function penjualan() {
        document.getElementById('atastabel').hidden=true; 
        document.getElementById('isitabel').hidden=true; 
    }

    //panggil data pembelian
    function pembelian() {
        document.getElementById('atastabel').hidden=true; 
        document.getElementById('isitabel').hidden=true; 
    }

    //panggil data budgetevent
    function budgetevent() {
        document.getElementById('atastabel').hidden=true; 
        document.getElementById('isitabel').hidden=true; 
    }

    //panggil data rewardsales
    function rewardsales() {
        document.getElementById('atastabel').hidden=true; 
        document.getElementById('isitabel').hidden=true; 
    }

    //panggil data setor pajak
    function setorpajak() {
        document.getElementById('atastabel').hidden=true; 
        document.getElementById('isitabel').hidden=true; 
    }

    //panggil data return beli
    function returbeli() {
        document.getElementById('atastabel').hidden=true; 
        document.getElementById('isitabel').hidden=true; 
    }

    //panggil data retur jual
    function returjual() {
        document.getElementById('atastabel').hidden=true; 
        document.getElementById('isitabel').hidden=true; 
    }


    //panggil data pengajuan kas kecil
    function PengajuanKasKecil() {
        $.ajax({
            url : base_url + 'DataPengajuanKasKecil',
            method : "POST",
            data : {idPer: $('select[name=perusahaan]').val() },
            async : true,
            dataType : 'json',
            success: function(data){
                var html_pengajuan = '';
                var total_kas_kecil = 0;
                var i;
                var no =1;
                document.getElementById('atastabel').hidden=false; 
                if (data.length > 0){  
                    for(i=0; i<data.length; i++){
                        html_pengajuan += '<tr><td>'+(no++)+'</td><td>Pengajuan Kas Kecil</td><td>'+data[i].tanggal+'</td><td>'+data[i].nokwitansi+'</td><td class="text-right">'+formatRupiah('0','Rp. ')+',00</td><td class="text-right">'+formatRupiah(data[i].nominal,'Rp. ')+',00</td><td>'+data[i].nama_akun+' '+data[i].nomor_akun+'</td><td>'+data[i].kode+'</td><td>'+data[i].nama+'</td><td>'+data[i].nama_bank+' '+data[i].nomor_rekening+'</td></tr>';
                    }
                }else {
                    html_pengajuan='<tr><td colspan="10" class="text-center">Data kas kecil tidak ditemukan</td></tr>'
                }
                document.getElementById('isitabel').hidden=false; 
                $('#isitabel').html(html_pengajuan);
            }
        });
    }

    //panggil data setor kas kecil
    function SetorKasKecil() {
        $.ajax({
            url : base_url + 'DataSetorKasKecil',
            method : "POST",
            data : {idPer: $('select[name=perusahaan]').val() },
            async : true,
            dataType : 'json',
            success: function(data){
                var html_setor = '';
                var total_setor_kas_kecil = 0;
                var i;
                var no =1;
                document.getElementById('atastabel').hidden=false;
                if (data.length > 0){
                    for(i=0; i<data.length; i++){
                        html_setor += '<tr><td>'+(no++)+'</td><td>Setor Kas Kecil</td><td>'+data[i].tanggal+'</td><td>'+data[i].nokwitansi+'</td><td class="text-right">'+formatRupiah(data[i].nominal,'Rp. ')+',00</td><td class="text-right">'+formatRupiah('0','Rp. ')+',00</td><td>'+data[i].nama_akun+' '+data[i].nomor_akun+'</td><td>'+data[i].kode+'</td><td>'+data[i].nama+'</td>><td>'+data[i].nama_bank+' '+data[i].nomor_rekening+'</td></tr>';
                    }
                }else {
                    html_setor='<tr><td colspan="10" class="text-center">Data setor kas kecil tidak ditemukan</td></tr>'
                }
                document.getElementById('isitabel').hidden=false;
                $('#isitabel').html(html_setor);
            }
        });
    }

    //rubah format rupiah
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split           = number_string.split(','),
        sisa             = split[0].length % 3,
        rupiah             = split[0].substr(0, sisa),
        ribuan             = split[0].substr(sisa).match(/\d{3}/gi);
 
        // tambahkan titik jika yang di input sudah menjadi angka satuan ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
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