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
			<div class="row">
				<div class="col-12">         
					<div class="card">
						<div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <form action="javascript:save()" id="form1">
                    <div class="form-group">
                      <label>Formulir :</label>
                        <select class="form-control" name="formulir" id="formulir" style="width:100%;">
                          <option value=""></option>
                          <option value="permintaanPembelian">Permintaan Pembelian</option>
                          <option value="pemesananPembelian">Pemesanan Pembelian</option>
                          <option value="penerimaanBarang">Penerimaan Barang</option>
                          <option value="fakturPembelian">Faktur Pembelian</option>
                          <option value="pesananPenjualan">Pesanan Penjualan</option>
                          <option value="pengirimanBarang">Pengiriman Barang</option>
                          <option value="fakturPenjualan">Faktur Penjualan</option>
                          <option value="kasBank">Kas Bank</option>
                          <option value="pengeluaranKasKecil">Pengeluaran Kas Kecil</option>
                          <option value="pemindahbukuan">Pemindahbukuan</option>
                          <option value="pengajuanKasKecil">Pengajuan Kas Kecil</option>
                          <option value="setorKasKecil">Setor Kas Kecil</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Format Penomoran :</label>
                        <input type="text" class="form-control" name="formatPenomoran" required>
                    </div>
                    <div class="text-right">
                        <a href="{site_url}SistemPenomoran" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                        <button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
                    </div>
                  </form>
                </div>
              </div>
						</div>
					</div>
			</div>
			</div>
		</div>
  </section>
</div>
<script type="text/javascript">
	let base_url = '{site_url}SistemPenomoran/';

  $(document).ready(function () {
    $('#formulir').select2({
      placeholder : 'Pilih Formulir',
      allowClear  : true
    });
  })

  function save() {
    let form = $('#form1')[0];
    let formData = new FormData(form);
    $.ajax({
      url         : base_url + 'save',
      dataType    : 'json',
      method      : 'post',
      data        : formData,
      contentType : false,
      processData : false,
      beforeSend  : function() {
        pageBlock();
      },
      afterSend : function() {
        unpageBlock();
      },
      success : function(data) {
        if(data.status == 'success') {
            swal("Berhasil!", "Data Berhasil Ditambah!", "success");
            redirect(base_url);
        } else {
            swal("Gagal!", "Pikachu was caught!", "error");
        }
      },
      error: function() {
        swal("Gagal!", "Internal Server Error!", "error");
      }
    })
  }
</script>