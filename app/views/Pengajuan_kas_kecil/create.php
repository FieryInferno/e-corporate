
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
                                    <label><?php echo lang('no_receipt') ?>:</label>
                                    <input type="text" class="form-control" id="nokwitansi" name="nokwitansi" placeholder="AUTO" readonly value="{kode_otomatis}">
                                </div>
                                <div class="form-group">
                                    <label><?php echo lang('company') ?>:</label>
                                    <select id="perusahaan" class="form-control perusahaan" name="perusahaan" required></select>
                                </div>   
                                <div class="form-group">
                                    <label><?php echo lang('cash') ?>:</label>
                                    <select id="kas" class="form-control kas" name="kas" required></select>
                                </div>
                                <div class="form-group">
                                    <label><?php echo lang('nominal') ?>:</label>
                                    <input type="text" class="form-control nominal" id="nominal" name="nominal" required>
                                </div> 
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo lang('date') ?>:</label>
                                    <input type="date" class="form-control datepicker" name="tanggal" required value="{tanggal}">
                                </div>  
                                <div class="form-group">
                                    <label><?php echo lang('recipients_name') ?>:</label>
                                    <select id="pejabat" class="form-control" name="pejabat" required></select>
                                </div> 
                                <div class="form-group">
                                    <label><?php echo lang('Rekening Bank') ?>:</label>
                                    <select id="rekening" class="form-control rekening" name="rekening" required></select>
                                </div>
                                <div class="form-group">
                                    <label><?php echo lang('remaining_petty_cash') ?>:</label>
                                    <input type="text" id="sisa_kas_kecil" class="form-control sisa_kas_kecil text-right" name="" readonly>
                                </div>               
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo lang('information') ?>:</label>
                                    <textarea class="form-control" name="keterangan" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <div class="text-left">
                            <div class="btn-group">
                                <a href="{site_url}pengajuan_kas_kecil" class="btn bg-danger"><?php echo lang('cancel') ?></a>
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

<script type="text/javascript">
    var base_url = '{site_url}pengajuan_kas_kecil/';

    $(document).ready(function(){
        //combbox perusahaan
        ajax_select({
            id: '#perusahaan',
            url: base_url + 'select2_mperusahaan',
        });
        //combobox kas/noakun
        ajax_select({
            id: '#kas',
            url: base_url + 'select2_mnoakun/',
        });
    })

    //combobox pejabat dan rekening
    $('#perusahaan').change(function(e) {
        $("#pejabat").val($("#pejabat").data("default-value"));
        $("#rekening").val($("#rekening").data("default-value"));
        $('input[id=sisa_kas_kecil]').val('0'); 
        var perusahaanId = $('select[name=perusahaan]').val();
        ajax_select({
            id: '#pejabat',
            url: base_url + 'select2_mdepartemen_pejabat/' + perusahaanId,
        });
        ajax_select({
            id: '#rekening',
            url: base_url + 'select2_mrekening_perusahaan/' + perusahaanId,
        });

    })

    //hitung sisa kas kecil
    $('#perusahaan').change(function(){ 
        $.ajax({
            url: base_url + 'get_hitungsisakaskecil',
            method: 'post',
            datatype: 'json',
            data: {
                    idper: $('select[name=perusahaan]').val(),
                },
            success: function(data){
                $('input[id=sisa_kas_kecil]').val(formatRupiah(String(data.hasil), 'Rp. ')+',00');     
            }
        });
        return false;
    }); 
    
    //nomor kwitansi
    $('#perusahaan').change(function(){ 
        var id=$('select[name=perusahaan]').val();
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
    
    //ubah format nominal
    $(document).on('keyup','.nominal, .nominal',function(){
        var val = $(this).val();
        $(this).val( formatRupiah(String(val)) );
    })

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