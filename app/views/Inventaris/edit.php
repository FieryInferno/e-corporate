
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
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">{title}</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <div class="col-md-6">
                <form action="javascript:save()" id="form1">
                    <div class="form-group">
                        <label><?php echo lang('Nama Barang') ?>:</label>
                        <input type="text" class="form-control" name="nama_barang" required value="{nama_barang}">
                    </div>
                    <div class="form-group">
                        <label><?php echo lang('Tahun Perolehan') ?>:</label>
                        <input type="text" class="form-control" name="tahun_perolehan" required value="{tahun_perolehan}">
                    </div>
                    <div class="form-group">
                        <label><?php echo lang('Nominal Asset') ?>:</label>
                        <input type="text" class="form-control" name="nominal_asset" required value="{nominal_asset}">
                    </div>
                    <div class="text-right">
                        <a href="{site_url}inventaris" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                        <button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
                    </div>
                </form>
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
    var base_url = '{site_url}inventaris/';
    $(document).ready(function(){
    	ajax_select({ id: '.idhakakses', url: base_url + 'select2_mpegawaihakakses', selected: { id: null } });
        $('.jenkel').select2({
            placeholder: 'Select an Option',
            data: [
                {id: 'LAKI-LAKI', text: 'LAKI-LAKI'},
                {id: 'PEREMPUAN', text: 'PEREMPUAN'},
            ]
        }).val(null).trigger('change');
    })    
    function save() {
        var form = $('#form1')[0];
        var formData = new FormData(form);
        $.ajax({
            url: base_url + 'save/{id_inventaris}',
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
                    swal("Gagal!", "Data Gagal Diedit!", "error");
                }
            },
            error: function() {
                swal("Gagal!", "Internal Server Error!", "error");
            }
        })
    }
</script>