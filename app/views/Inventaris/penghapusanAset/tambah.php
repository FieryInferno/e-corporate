
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

    <form action="javascript:simpan(this)" id="formPenghapusan">
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
                            <label>Kode Perusahaan</label>
                            <input type="text" class="form-control" name="kodePerusahaan" disabled id="kodePerusahaan">
                          </div>
                        </div>
                        <div class="col-8">
                          <div class="form-group">
                            <label>Nama Perusahaan</label>
                            <select class="form-control" name="perusahaan" id="perusahaan" style="width:100%;"></select>
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
                            <label>No. Surat Keputusan</label>
                            <input type="text" class="form-control" name="noSk" id="noSk">
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label>Tanggal Surat Keputusan</label>
                            <input type="date" class="form-control" name="tanggalSk" id="tanggalSk">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" id="detailBarangTab" data-toggle="tab" href="#detailBarang" role="tab" aria-controls="home" aria-selected="true">Detail Barang</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="detailBarang" role="tabpanel" aria-labelledby="home-tab">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pilihInventaris">
                        Tambah
                      </button>

                      <div class="modal fade" id="pilihInventaris" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Pilih Inventaris</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="table-responsive">
                                  <table class="table table-xs table-striped table-borderless table-hover pilihInventaris">
                                    <thead>
                                      <tr class="table-active">
                                        <th>#</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Inventaris Barang</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        foreach ($inventaris as $key) { ?>
                                          <tr>
                                            <td>
                                              <input type="checkbox" name="" id="" onchange="pilihInventaris(this)" kodeBarang="<?= $key['kodeInventaris']; ?>" nomorRegister="<?= $key['noRegister']; ?>" namaInventaris="<?= $key['namaInventaris']; ?>" tahunBeli="<?= $key['tanggalPembelian']; ?>" hargaPerolehan="<?= $key['harga']; ?>">
                                            </td>
                                            <td><?= $key['kodeInventaris']; ?></td>
                                            <td><?= $key['namaInventaris']; ?></td>
                                          </tr>
                                        <?php }
                                      ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <button class="btn btn-primary">Ubah</button>
                      <div class="table-responsive">
                        <table class="table table-xs table-striped table-borderless table-hover index_datatable">
                          <thead>
                            <tr class="table-active">
                              <th>Kode Barang</th>
                              <th>Nomor Register</th>
                              <th>Nama Inventaris Barang</th>
                              <th>Tahun Beli</th>
                              <th>Harga Perolehan</th>
                              <th>Nominal Penghapusan</th>
                              <th>Kondisi</th>
                            </tr>
                          </thead>
                        <tbody></tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-footer">
                <div class="float-right">
                  <button class="btn btn-success" type="submit">Simpan</button>
                  <button class="btn btn-danger">Batal</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>
</div>
<script>
  let tableDetailBarang   = $('.index_datatable').DataTable({
    'searching' : false,
    'paging'    : false,
    'ordering'  : false,
    'info'      : false
  });

  let tablePilihInventaris    = $('.pilihInventaris').DataTable();

  $(document).ready(function () {
		ajax_select({
			id	: '#perusahaan',	
			url	: '<?= base_url(); ?>perusahaan/select2',
    });	
        
    $('#jenisAset').select2({
      'placeholder'   : 'Pilih Jenis Aset',
      'allowClear'    : true,
      'ajax'          : {
        'url'           : '{site_url}Noakun/jenisAset',
        dataType        : 'json',
        delay           : 250,
        processResults  : function (data) {
          return {
            results : data
          }
        },
        cache   : false,
      },
    });

    $('#jenisPemeliharaan').select2({
      'placeholder'   : 'Pilih Jenis Pemeliharaan',
      'allowClear'    : true
    });
	});

  $('#perusahaan').change(function () {
    let perusahaan  = $(this).val();
    $.ajax({
      'url'       : '<?= base_url(); ?>perusahaan/getPerusahaan',
      'method'    : 'get',
      'data'      : {
          'idPerusahaan'  : perusahaan
      },
      'success'   : function (data) {
          $('#kodePerusahaan').val(data.kode);
      }
    })
  })

  function pilihInventaris(elemen) {
    let kodeBarang      = $(elemen).attr('kodeBarang');
    let noRegister      = $(elemen).attr('nomorRegister');
    let namaInventaris  = $(elemen).attr('namaInventaris');
    let tahunBeli       = $(elemen).attr('tahunBeli');
    let hargaPerolehan  = $(elemen).attr('hargaPerolehan');

    tableDetailBarang.row.add([
      kodeBarang + `<input type="hidden" name="kodeBarang[]" value="${kodeBarang}">`,
      noRegister,
      namaInventaris,
      tahunBeli,
      formatRupiah(hargaPerolehan) + ',00' + `<input type="hidden" name="harga[]" value="${hargaPerolehan}">`,
      ``,
      ``,
      ``
    ]).draw();
  }

  function simpan(elemen) {
    let data  = new FormData($('#formPenghapusan')[0]);
    console.log(data);
    $.ajax({
      url         : '{site_url}penghapusan_aset/simpan',
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
            redirect('{site_url}penghapusan_aset');
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