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
        <div class="card-header header-elements-inline {bg_header}">
            <h5 class="card-title">Generate CRUD</h5>
        </div>
        <div class="card-body">
            <form action="javascript:save()" id="form1">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama:</label>
                            <input type="text" class="form-control" name="nama" required>
                            <span class="form-text text-muted">
                                Nama disini akan menjadi nama dari file controller dan model dan direktori views
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Pilih Table:</label>
                            <select class="form-control table" name="table"></select>
                            <span class="form-text text-muted">
                                Pilih table yang akan dibuat CRUD nya.
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-left">
                            <button type="submit" class="btn {bg_header}">
                                GENERATE CRUD <i class="icon-reload-alt ml-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script type="text/javascript">

    var base_url = '{site_url}generate_crud/';

    $(document).ready(function(){
        $('.table').select2({
            placeholder: 'Pilih Opsi',
            ajax: {
                url: base_url + 'list_tables',
                dataType: 'json'
            }
        })
    })

    function save() {
        var form = $('#form1')[0];
        var formData = new FormData(form);
        
        $.ajax({
            url: base_url + 'generate',
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
                    location.reload()
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