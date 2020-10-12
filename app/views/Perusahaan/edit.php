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
                                            <label><?php echo lang('kode') ?>:</label>
                                            <input type="text" class="form-control" name="kode" required value="{kode}">
                                            <label><?php echo lang('nama perusahaan') ?>:</label>
                                            <input type="text" class="form-control" name="nama_perusahaan" required value="{nama_perusahaan}">
                                        </div>
                                        <div class="text-right">
                                            <a href="{site_url}kategori" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                                            <button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
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
    var base_url = '{site_url}perusahaan/';
    $(document).ready(function(){
    })
    function save() {
        var form = $('#form1')[0];
        var formData = new FormData(form);
        $.ajax({
            url: base_url + 'save/{idperusahaan}',
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
                    swal("Berhasil!", "Data Berhasil Diedit!", "success");
                    redirect(base_url)
                } else {
                    Nswal("Gagal!", "Data Gagal Disimpan!", "error");
                }
            },
            error: function() {
                swal("Gagal!", "Internal Server Error!", "error");
            }
        })
    }
</script>