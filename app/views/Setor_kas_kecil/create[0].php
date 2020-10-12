<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-info22 mr-2"></i> <span class="font-weight-semibold">{title}</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <div class="card">
        <div class="card-header {bg_header}">
            <div class="header-elements-inline">
                <h5 class="card-title">{subtitle}</h5>
            </div> 
        </div> 
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
                            <input type="text" class="form-control nominal text-right" id="nominal" name="nominal" placeholder="0">
                        </div> 
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('date') ?>:</label>
                            <input type="text" class="form-control datepicker" name="tanggal" required value="{tanggal}">
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
                <div class="text-left">
                    <div class="btn-group">
                        <a href="{site_url}setor_kas_kecil" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                        &nbsp;<button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script src="{assets_path}global/js/plugins/tables/datatables/datatables.min.js"></script>
<script src="{assets_path}global/js/plugins/pickers/pickadate/picker.js"></script>
<script src="{assets_path}global/js/plugins/pickers/pickadate/picker.date.js"></script>
<script type="text/javascript">
    var base_url = '{site_url}setor_kas_kecil/';

    $(document).ready(function(){
        //combobox perusahan
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
    //combobox nama penerima/pejabat
    $('#perusahaan').change(function(e) {
        $("#pejabat").val($("#pejabat").data("default-value"));
        $("#rekening").val($("#rekening").data("default-value"));
        $('input[id=sisa_kas_kecil]').val('0'); 
        var perusahaanId=$('select[name=perusahaan]').val();
        ajax_select({
            id: '#pejabat',
            url: base_url + 'select2_mdepartemen_pejabat/' +  perusahaanId,
        });
        ajax_select({
            id: '#rekening',
            url: base_url + 'select2_mrekening_perusahaan/' + perusahaanId,
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
            data: {
                    idper: $('select[name=perusahaan]').val(),
                },
            success: function(data){
                $('input[id=sisa_kas_kecil]').val(numeral(data.hasil).format());  
            }
        });
        return false;
    }); 
   
    //ubah format nominal
    $(document).on('keyup','.nominal, .nominal',function(){
        var val = $(this).val();
        $(this).val( numeral(val).format() );
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
                    NotifySuccess(data.message)
                    redirect(base_url);
                } else {
                    NotifyError(data.message)
                }
            },
            error: function() {
                NotifyError('<?php echo lang('internal_server_error') ?>');
            }
        })
    }



        
</script>