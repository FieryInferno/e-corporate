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
            <div class="row">
                <div class="col-md-6">
                    <form action="javascript:save()" id="form1">
                        <div class="form-group">
                            <label><?php echo lang('name') ?>:</label>
                            <input type="text" class="form-control" name="nama" required value="{nama}">
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('telephone') ?>:</label>
                            <input type="text" class="form-control" name="telepon" required value="{telepon}">
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('email') ?>:</label>
                            <input type="text" class="form-control" name="email" value="{email}">
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('Telepon') ?>:</label>
                            <input type="text" class="form-control" name="telepon" required value="{telepon}">
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('Contact Person') ?>:</label>
                            <input type="text" class="form-control" name="cp" required value="{cp}">
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('type') ?>:</label>
                            <select class="form-control tipe" name="tipe" required></select>
                        </div>
                        <div class="form-group fnoakunpiutang" hidden>
                            <label><?php echo lang('noakunpiutang') ?>:</label>
                            <select class="form-control noakunpiutang" name="noakunpiutang" style="width:100%"></select>
                        </div>
                        <div class="form-group fnoakunutang" hidden>
                            <label><?php echo lang('noakunutang') ?>:</label>
                            <select class="form-control noakunutang" name="noakunutang" style="width:100%"></select>
                        </div>
                        <div class="text-right">
                            <a href="{site_url}kontak" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                            <button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script type="text/javascript">
    var base_url = '{site_url}kontak/';
    $(document).ready(function(){
        ajax_select({ id: '.noakunpiutang', url: base_url + 'select2_mnoakun_piutang', selected: { id: '{noakunpiutang}' } });
        ajax_select({ id: '.noakunutang', url: base_url + 'select2_mnoakun_utang', selected: { id: '{noakunutang}' } });
        $('.tipe').select2({
            placeholder: 'Select an Option',
            data: [
                {id: '1', text: 'Suppliers'},
                {id: '2', text: 'Customers'},
            ]
        }).val('{tipe}').trigger('change');
    })
    $(document).on('change','.tipe',function(){
        var val = $(this).val();
        if(val == '2') {
            $('.noakunpiutang').attr('required',true);
            $('.fnoakunpiutang').attr('hidden',false);
            $('.noakunutang').attr('required',false);
            $('.fnoakunutang').attr('hidden',true);
        } else if(val == '1') {
            $('.noakunpiutang').attr('required',false);
            $('.fnoakunpiutang').attr('hidden',true);
            $('.noakunutang').attr('required',true);
            $('.fnoakunutang').attr('hidden',false);
        } else {
            $('.noakunpiutang').attr('required',false);
            $('.fnoakunpiutang').attr('hidden',true);
            $('.noakunutang').attr('required',false);
            $('.fnoakunutang').attr('hidden',true);
        }
    })
    function save() {
        var form = $('#form1')[0];
        var formData = new FormData(form);
        $.ajax({
            url: base_url + 'save/{id}',
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