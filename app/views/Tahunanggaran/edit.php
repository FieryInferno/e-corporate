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
                        <li class="breadcrumb-item"><a href="<?= base_url('tahun_anggaran'); ?>">{title}</a></li>
                        <li class="breadcrumb-item active">{subtitle}</li>
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
                            <h3 class="card-title">Tambah Tahun Anggaran</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="javascript:save()" id="form1">
                                <div class="form-group">
                                    <label><?php echo lang('tahun') ?>:</label>
                                    <input type="text" class="form-control" name="tahun" required value="{tahun}">
                                    <label><?php echo lang('keterangan') ?>:</label>
                                    <input type="text" class="form-control" name="keterangan" required value="{keterangan}">
                                </div>
                                <div class="text-right">
                                    <a href="{site_url}tahunanggaran" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                                    <button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
                                </div>
                            </form>
                        </div>
                        <!-- form start -->
                        
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
	var base_url = '{site_url}tahunanggaran/';
    $(document).ready(function(){
    })
    function save() {
        var form        = $('#form1')[0];
        var formData    = new FormData(form);
        $.ajax({
            url         : base_url + 'save/{id}',
            dataType    : 'json',
            method      : 'post',
            data        : formData,
            contentType : false,
            processData : false,
            beforeSend  : function() {
                pageBlock();
            },
            afterSend   : function() {
                unpageBlock();
            },
            success     : function(data) {
                if (data.status == 'success') {
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