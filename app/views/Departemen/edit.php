
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
                <div class="row">
                    <div class="col-md-6">
                        <form action="javascript:save()" id="form1">
                            <div class="form-group">
                                <label><?php echo lang('nama perusahaan') ?>:</label>
                                <select id="perusahaan" class="form-control" name="id_perusahaan" required></select>
                                <label><?php echo lang('nama perusahaan') ?>:</label>
                                <input type="text" class="form-control" name="nama" required value="{nama}">
                                <label><?php echo lang('PIC') ?>:</label>
                                <input type="text" class="form-control" name="pejabat" required value="{pejabat}">
                                <label><?php echo lang('jabatan') ?>:</label>
                                <input type="text" class="form-control" name="jabatan" required value="{jabatan}">
                            </div>
                            <div class="text-right">
                                <a href="{site_url}departemen" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                                <button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">          
          </div>
        </div>

<script type="text/javascript">
    var base_url = '{site_url}departemen/';
    $(document).ready(function(){
        ajax_select({
            id: '#perusahaan',
            url: base_url + 'select2_mperusahaan',
            selected: {
                id: '{id_perusahaan}'
            }
        });
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
                    swal("Berhasil!", "Data Berhasil Disimpan!", "success");
                    redirect(base_url);
                } else {
                    swal("Gagal!", "Data Gagal Disimpan!", "error");
                }
            },
            error: function() {
                swal("Gagal!", "Internal Server Error!", "error");
            }
        })
    }
</script>