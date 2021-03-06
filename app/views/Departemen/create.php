
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
                                <?php
                                  if ($this->session->userid !== '1') { ?>
                                      <input type="hidden" name="id_perusahaan" value="<?= $this->session->idperusahaan; ?>" id="perusahaan">
                                      <input type="text" class="form-control" value="<?= $this->session->perusahaan; ?>" disabled>
                                  <?php } else { ?>
                                      <select class="form-control id_perusahaan" name="id_perusahaan" style="width: 100%;" id="perusahaan"></select>
                                  <?php }
                                ?>
                                <label><?php echo lang('nama departemen') ?>:</label>
                                <input type="text" class="form-control" id="namakey" onkeyup="rep()" required>
                                <input type="hidden" class="form-control" name="nama" id="nama" onkeyup="rep()" required>
                                <label><?php echo lang('PIC') ?>:</label>
                                <input type="text" class="form-control" name="pejabat" id="pejabat"required>
                                <label><?php echo lang('jabatan') ?>:</label>
                                <input type="text" class="form-control" name="jabatan" required>
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
    if ('<?= $this->session->userid; ?>' == '1') {
      ajax_select({ 
        id        : '.id_perusahaan', 
        url       : base_url + 'select2_id_perusahaan', 
        selected  : { 
          id  : '' 
        } 
      });
    }
  })

	function rep(){
		var str = $("#namakey").val();
		repi=str.replace(/ /g,"_");
    $("#nama").val(repi);
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