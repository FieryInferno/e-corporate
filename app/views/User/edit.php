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
                                            <input type="password" class="form-control" name="password" required>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn bg-success"><?php echo lang('change_password') ?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
                    swal("Berhasil!", "Berhasil Mengedit Data", "success");
                    redirect(base_url)
                } else {
                    swal("Gagal!", "Gagal Mengedit Data", "error");
                }
            },
            error: function() {
                swal("Gagal!", "Internal Server Error", "error");
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
                    swal("Berhasil!", "Berhasil Mengubah Password", "success");
                    redirect(base_url)
                } else {
                    swal("Gagal!", "Gagal Mengubah Password", "error");
                }
            },
            error: function() {
                swal("Gagal!", "Internal Server Error", "error");
            }
        })
    }
</script>