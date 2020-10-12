
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
            <li class="breadcrumb-item"><a href="{site_url}pajak/create">Pajak</a></li>
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

          <form action="javascript:save()" id="form1">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kode Pajak:</label>
                        <input type="text" class="form-control" name="kode_pajak" placeholder="Masukan Kode Pajak" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Pajak:</label>
                        <input type="text" class="form-control" name="nama_pajak" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Akun:</label>
                        <select class="form-control noakun" name="noakun" required></select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Persen:</label>
                        <input type="number" class="form-control" name="persen" required>
                    </div>
                </div>
            </div>
				<div class="text-right">
					<a href="{site_url}item" class="btn bg-danger"><?php echo lang('cancel') ?></a>
					<button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
				</div>
			</form>
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
	var base_url = '{site_url}pajak/';

    $(document).ready(function(){
        ajax_select({ 
          id: '.noakun', 
          url: base_url + 'select2_noakun', 
          selected: { id: '' } 
        });
    })

    $(document).on('keyup','.hargajual, .hargabeli',function(){
        var val = $(this).val();
        $(this).val( numeral(val).format() );
    })
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