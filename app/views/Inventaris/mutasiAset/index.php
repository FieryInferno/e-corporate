
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
            <div class="card-header">
              <a class="btn btn-success" href="<?= base_url(); ?>mutasi_aset/tambah"><i class="fas fa-plus"></i> Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-xs table-striped table-borderless table-hover index_datatable">
                  <thead>
                    <tr class="table-active">
                      <th>No SK Mutasi</th>
                      <th>Nama Perusahaan Asal</th>
                      <th>Nama Perusahaan Penerima</th>
                      <th>Nominal Mutasi</th>
                      <th>Jenis Aset</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script>
  let table   = $('.index_datatable').DataTable({
    ajax  : {
      url : '{site_url}mutasi_aset/data'
    },
    columns : [
      {data : 'noSuratKeputusan'},
      {data : 'perusahaanAsal'},
      {data : 'perusahaanPenerima'},
      {
        data    : 'nominalAsset',
        render  : function (data, type, row) {
          return formatRupiah(data) + ',00';
        }
      },
      {data : 'jenisInventaris'},
      {data : 'idMutasi'},
    ]
  });   
</script>