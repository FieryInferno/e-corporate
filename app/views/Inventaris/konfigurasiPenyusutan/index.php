
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

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">         
          <div class="card">
            <div class="card-body">
              <form action="#">
                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label>Konfigurasi Umur Ekonomis</label>
                      <select name="konfigurasiUmur" id="konfigurasiUmur" style="width:100%;" class="form-control" >
                        <option value="tahunan">Tahunan</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label>Konfigurasi Penyusutan</label>
                      <select name="konfigurasiPenyusutan" id="konfigurasiPenyusutan" style="width:100%;" class="form-control" >
                        <option value="garisLurus">Garis Lurus</option>
                      </select>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-12">         
          <div class="card">
            <div class="card-header">
              <a class="btn btn-success" href="<?= base_url(); ?>konfigurasi_penyusutan/tambah"><i class="fas fa-plus"></i> Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-xs table-striped table-borderless table-hover index_datatable">
                  <thead>
                    <tr class="table-active">
                      <th>Kode Barang</th>
                      <th>Nama Barang</th>
                      <th>Masa Manfaat</th>
                      <th>Batas Kapitalisasi</th>
                      <th>Tambahan Masa Manfaat</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
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
</div>
<script>
  $(document).ready(function () {
    $('#konfigurasiUmur').select2();
    $('#konfigurasiPenyusutan').select2();
  });
  
  let table   = $('.index_datatable').DataTable({
    ajax  : {
      url : '{site_url}konfigurasi_penyusutan/data'
    },
    columns : [
      {data : 'kodeBarang'},
      {data : 'namaBarang'},
      {data : 'masaManfaat'},
      {data : 'batasKapitalisasi'},
      {data : 'tambahanMasaManfaat'},
      {
        data    : 'idKonfigurasiPenyusutan',
        render  : function (data, type, row) {
          let aksi  = `
            <div class="list-icons"> 
              <div class="dropdown"> 
                <a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
								<div class="dropdown-menu dropdown-menu-right">
									<a href="{site_url}konfigurasi_penyusutan/edit/${data}" class="dropdown-item text-success"><i class="fas fa-pencil-alt"></i> Edit</a>
									<a href="" class="dropdown-item delete text-danger"><i class="fas fa-trash"></i> <?php echo lang('delete') ?></a>
                </div> 
              </div> 
            </div>`;
          return aksi;
        }
      },
    ]
  });   
</script>