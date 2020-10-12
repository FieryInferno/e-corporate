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
                            <input type="text" class="form-control" name="name" required value="{name}">
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('email') ?>:</label>
                            <input type="text" class="form-control" name="email" required value="{email}">
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('username') ?>:</label>
                            <input type="text" class="form-control" name="username" required value="{username}">
                        </div>
                        <div class="form-group">
                            <label>Cabang:</label>
                            <select class="form-control cabangid" name="cabangid" required></select>
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('permission') ?>:</label>
                            <select class="form-control permissionid" name="permissionid" required></select>
                        </div>
                        <div class="text-right">
                            <a href="{site_url}user" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                            <button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form action="javascript:change_password()" id="form2">
                        <div class="form-group">
                            <label><?php echo lang('new_password') ?>:</label>
                            <input type="text" class="form-control" name="password" required>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn bg-success"><?php echo lang('change_password') ?></button>
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
    var base_url = '{site_url}user/';
    $(document).ready(function(){
    	ajax_select({ id: '.permissionid', url: base_url + 'select2_permissionid', selected: { id: '{permissionid}' } });
    	ajax_select({ id: '.cabangid', url: base_url + 'select2_cabangid', selected: { id: '{cabangid}' } });
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
                    redirect(base_url)
                } else {
                    NotifyError(data.message)
                }
            },
            error: function() {
                NotifyError('<?php echo lang('internal_server_error') ?>');
            }
        })
    }

    function change_password() {
        var form = $('#form2')[0];
        var formData = new FormData(form);
        $.ajax({
            url: base_url + 'change_password/{id}',
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
                    redirect(base_url)
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