
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
						<li class="breadcrumb-item active">{subtitle}</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
  </section>

  <form action="javascript:simpan(this)" id="formKonfigurasiPenyusutan">
      <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">         
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <div class="row">
                      <div class="col-4">
                        <div class="form-group">
                          <label>Kode</label>
                          <input type="text" class="form-control" name="kode" disabled id="kode">
                        </div>
                      </div>
                      <div class="col-8">
                        <div class="form-group">
                          <label>Nama Barang</label>
                          <select class="form-control" name="barang" id="barang" style="width:100%;" onchange="pilihBarang(this)"></select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label>Masa Manfaat</label>
                          <input type="text" class="form-control" name="masaManfaat" id="masaManfaat">
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label>Batas Kapitalisasi</label>
                          <input type="text" class="form-control" name="batasKapitalisasi" id="batasKapitalisasi">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label>Tambahan Masa Manfaat</label>
                          <input type="text" class="form-control" name="tambahanMasaManfaat" id="tambahanMasaManfaat">
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label>Prosentasi Penyusutan</label>
                          <input type="text" class="form-control" name="prosentasiPenyusutan" id="prosentasiPenyusutan">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="card">
              <div class="card-footer">
                <button class="btn btn-success" type="submit">Simpan</button>
                <button class="btn btn-danger">Batal</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>
</div>
<script>
  $(document).ready(function () {
    ajax_select({
			id	: '#barang',	
			url	: '<?= base_url(); ?>item/select2',
    });
  });

  function pilihBarang(elemen) {
    let barang  = $(elemen).val();
    $.ajax({
      'url'       : '<?= base_url(); ?>item/get',
      'method'    : 'post',
      'data'      : {
          'id'  : barang
      },
      'success'   : function (data) {
        $('#kode').val(data.kode);
      }
    })
  }

  function simpan(elemen) {
    let data  = new FormData($('#formKonfigurasiPenyusutan')[0]);
    $.ajax({
      url         : '{site_url}konfigurasi_penyusutan/simpan',
      data        : data,
      method      : 'post',
      dataType    : 'json',
      processData : false,
      contentType : false,
      beforeSend  : function () {
        pageBlock();
      },
      afterSend : function() {
        unpageBlock();
      },
      success : function(data) {
        if(data.status == 'success') {
            swal("Berhasil!", "Berhasil Menambah Data", "success");
            redirect('{site_url}konfigurasi_penyusutan');
        } else {
            swal("Gagal!", "Gagal Menambah Data", "error");
        }
      },
      error : function() {
        swal("Gagal!", "Internal Server Error", "error");
      }
    })
  }
</script>