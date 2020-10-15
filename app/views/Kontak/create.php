
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
            <form action="javascript:save()" id="form1">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('name') ?>:</label>
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                            <div class="form-group">
                            </div>
                            <div class="form-group">
                                <label><?php echo lang('email') ?>:</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label><?php echo lang('Telepon') ?>:</label>
                                <input type="text" class="form-control" name="telepon" required>
                            </div>
                            <div class="form-group">
                                <label><?php echo lang('Contact Person') ?>:</label>
                                <input type="text" class="form-control" name="cp" required>
                            </div>
                            <div class="form-group">
                                <label><?php echo lang('type') ?>:</label>
                                <select class="form-control tipe" name="tipe" required></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Perusahaan :</label>
                                <select class="form-control perusahaan" name="perusahaan" required></select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-left">
                        <a href="{site_url}kontak" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                        <button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
                    </div>
                </div>
            </form>
            <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">          
          </div>
        </div>
        <script type="text/javascript">
	var base_url = '{site_url}kontak/';

    var noakunpiutang = '<?php echo get_pengaturan_akun(14) ?>'
    var noakunhutang = '<?php echo get_pengaturan_akun(15) ?>'
    $(document).ready(function(){
        ajax_select({ id: '.noakunpiutang', url: base_url + 'select2_mnoakun_piutang', selected: { id: noakunpiutang } });
    	ajax_select({ id: '.noakunutang', url: base_url + 'select2_mnoakun_utang', selected: { id: noakunhutang } });
        $('.tipe').select2({
            placeholder: 'Select an Option',
            data: [
                {id: '1', text: 'Suppliers'},
                {id: '2', text: 'Customers'},
            ]
        }).val(null).trigger('change');
        ajax_select({ 
            id          : '.perusahaan', 
            url         : '{site_url}perusahaan/select2', 
            selected    : { 
                id  : '' 
            } 
        });
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