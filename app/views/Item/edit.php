
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
                <form action="javascript:save()" id="form1">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('code') ?>:</label>
                                <input type="text" class="form-control" name="kode" placeholder="AUTO" pattern="[a-zA-Z0-9-#]+" maxlength="10" value="{kode}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('name') ?>:</label>
                                <input type="text" class="form-control" name="nama" required value="{nama}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('unit') ?>:</label>
                                <select class="form-control satuanid" name="satuanid" required></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('category') ?>:</label>
                                <select class="form-control kategoriid" name="kategoriid" required></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('purchase_price') ?>:</label>
                                <input type="text" class="form-control hargabeli" name="hargabeli" required value="<?= "Rp " . number_format($hargabeli, 0,',','.'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('purchase_account') ?>:</label>
                                <select class="form-control noakunbeli" name="noakunbeli"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('sales_price') ?>:</label>
                                <input type="text" class="form-control hargajual" name="hargajual" required value="<?= "Rp " . number_format($hargajual, 0,',','.'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('sales_account') ?>:</label>
                                <select class="form-control noakunjual" name="noakunjual"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('Rekening Anggaran Belanja') ?>:</label>
                                <select class="form-control noakunpersediaan" name="noakunpersediaan"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('Departemen') ?>:</label>
                                <select class="form-control departemen" name="idDepartemen"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('Image') ?>:</label>
                                <input type="file" class="form-control h-auto" name="gambar">
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
    var base_url = '{site_url}item/';

    $(document).ready(function(){
        ajax_select({ id: '.satuanid', url: base_url + 'select2_satuanid', selected: { id: '{satuanid}' } });
        ajax_select({ id: '.kategoriid', url: base_url + 'select2_kategoriid', selected: { id: '{kategoriid}' } });
        ajax_select({ 
            id: '.noakunbeli', 
            url: '{site_url}noakun/select2_noakun', 
            selected: { 
                id: '{noakunbeli}' 
            } 
        });
        ajax_select({ 
            id: '.noakunjual', 
            url: '{site_url}noakun/select2_noakun', 
            selected: { 
                id: '{noakunjual}' 
            } 
        });
        ajax_select({ id: '.noakunpersediaan', url: base_url + 'select2_noakunpersediaan', selected: { id: '{noakunpersediaan}' } });
        ajax_select({ 
            id: '.departemen', 
            url: base_url + 'select2_departemen', 
            selected: { 
                id: '{idDepartemen}' 
            } 
        });
    })

    $(document).on('keyup','.hargajual, .hargabeli',function(){
        var val = $(this).val();
        $(this).val( formatRupiah(val, 'Rp. ') );
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