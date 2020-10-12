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
                <h3 class="mb-3 mt-3"><?php echo lang('sales') ?></h3>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('Piutang Belum Ditagih') ?>:</label>
                            <select class="form-control piutang_belum_ditagih" name="piutang_belum_ditagih" multiselect="multiselect" required></select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('Pajak Penjualan') ?>:</label>
                            <select class="form-control pajak_penjualan" name="pajak_penjualan" required></select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('Pendapatan Penjualan') ?>:</label>
                            <select class="form-control pendapatan_penjualan" name="pendapatan_penjualan" required></select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('Pendapatan Belum Ditagih') ?>:</label>
                            <select class="form-control retur_penjualan" name="retur_penjualan" required></select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('Retur Penjualan') ?>:</label>
                            <select class="form-control penjualan_belum_ditagih" name="penjualan_belum_ditagih" required></select>
                        </div>
                    </div>
                </div>

                <h3 class="mb-3 mt-3"><?php echo lang('purchasing') ?></h3>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('Pajak Pembelian') ?>:</label>
                            <select class="form-control pajak_pembelian" name="pajak_pembelian" required></select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('Hutang Belum Ditagih') ?>:</label>
                            <select class="form-control hutang_belum_ditagih" name="hutang_belum_ditagih" required></select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('Pembelian') ?>:</label>
                            <select class="form-control pembelian" name="pembelian" required></select>
                        </div>
                    </div>
                </div>

                <h3 class="mb-3 mt-3"><?php echo lang('Utang dan Piutang') ?></h3>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('Piutang Usaha') ?>:</label>
                            <select class="form-control piutang_usaha" name="piutang_usaha" required></select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('Hutang Usaha') ?>:</label>
                            <select class="form-control hutang_usaha" name="hutang_usaha" required></select>
                        </div>
                    </div>
                </div>

                <h3 class="mb-3 mt-3"><?php echo lang('Persediaan') ?></h3>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('Persediaan') ?>:</label>
                            <select class="form-control persediaan" name="persediaan" required></select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('Persediaan Produksi') ?>:</label>
                            <select class="form-control persediaan_produksi" name="persediaan_produksi" required></select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('Persediaan Rusak') ?>:</label>
                            <select class="form-control persediaan_rusak" name="persediaan_rusak" required></select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('Persediaan Umum') ?>:</label>
                            <select class="form-control persediaan_umum" name="persediaan_umum" required></select>
                        </div>
                    </div>
                </div>

                <h3 class="mb-3 mt-3"><?php echo lang('Persediaan') ?></h3>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('Modal') ?>:</label>
                            <select class="form-control ekuitas_saldo_awal" name="ekuitas_saldo_awal" required></select>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{site_url}item" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                    <button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script type="text/javascript">
    var base_url = '{site_url}metaakun/';

    $(document).ready(function(){
        setTimeout(function() { get_select2('.piutang_belum_ditagih',1); }, 500);
        setTimeout(function() { get_select2('.pajak_penjualan',3); }, 500);
        setTimeout(function() { get_select2('.pendapatan_penjualan',4); }, 500);
        setTimeout(function() { get_select2('.retur_penjualan',6); }, 500);
        setTimeout(function() { get_select2('.penjualan_belum_ditagih',7); }, 500);
        
        
        setTimeout(function() { get_select2('.pajak_pembelian',10); }, 500);
        setTimeout(function() { get_select2('.hutang_belum_ditagih',11); }, 500);
        setTimeout(function() { get_select2('.pembelian',13); }, 500);

        setTimeout(function() { get_select2('.piutang_usaha',14); }, 500);
        setTimeout(function() { get_select2('.hutang_usaha',15); }, 500);

        setTimeout(function() { get_select2('.persediaan',16); }, 500);
        setTimeout(function() { get_select2('.persediaan_produksi',17); }, 500);
        setTimeout(function() { get_select2('.persediaan_rusak',18); }, 500);
        setTimeout(function() { get_select2('.persediaan_umum',19); }, 500);
        setTimeout(function() { get_select2('.ekuitas_saldo_awal',21); }, 500);
    })

    function get_select2(elementID, keyID) {
        $.ajax({
            url: base_url + 'get_pengaturan_akun/'+keyID,
            type: 'post',
            success: function(data) {
                key = data;
                ajax_select({ id: elementID, url: base_url + 'select2_noakun', selected: { id: key } });
            }
        })
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