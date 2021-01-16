
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
                  <?php
                    if ($this->session->userid !== '1') { ?>
                      <div class="col-4">
                        <div class="form-group">
                          <label>Perusahaan : </label>
                          <input type="hidden" name="perusahaan" value="<?= $this->session->idperusahaan; ?>">
                          <input type="text" class="form-control" value="<?= $this->session->perusahaan; ?>" disabled>
                        </div>
                      </div>
                    <?php } else { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Perusahaan : </label>
                          <select class="form-control" name="perusahaan" id="perusahaan"></select>
                        </div>
                      </div>
                    <?php }
                  ?>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="text-right">
                      <button onclick="tampilData()" class="btn-block btn btn-success"><i class="fas fa-filter"></i> Filter</button>
                      <button class="btn-block btn btn-warning">Reset</button>
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
              <a class="btn btn-success" href="<?= base_url(); ?>penghapusan_aset/tambah"><i class="fas fa-plus"></i> Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-xs table-striped table-borderless table-hover index_datatable">
                  <thead>
                    <tr class="table-active">
                      <th>Kode Perusahaan</th>
                      <th>Nama Perusahaan</th>
                      <th>Tanggal SK</th>
                      <th>Nomor SK</th>
                      <th>Nominal</th>
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
      url : '{site_url}penghapusan_aset/data'
    },
    columns : [
      {data : 'kodePerusahaan'},
      {data : 'nama_perusahaan'},
      {data : 'tanggalSk'},
      {data : 'noSk'},
      {
        data    : 'nominalPenghapusan',
        render  : function (data, type, row) {
          return formatRupiah(data) + ',00';
        }
      },
      {data : 'idPenghapusan'},
    ]
  });   

	$(document).ready(function () {
		ajax_select({
			id	: '#perusahaan',	
			url	: '<?= base_url(); ?>perusahaan/select2',
		});	
  });
  
  function tampilData() {
    table.destroy();
    table   = $('.index_datatable').DataTable({
      ajax  : {
        url   : '{site_url}penghapusan_aset/data',
        data  : {
          perusahaan  : $('#perusahaan').val()
        },
        method  : 'get',
      },
      columns : [
        {data : 'kodePerusahaan'},
        {data : 'nama_perusahaan'},
        {data : 'nama_perusahaan'},
        {
          data    : 'nominalAsset',
          render  : function (data, type, row) {
            return formatRupiah(data) + ',00';
          }
        },
        {
          data    : 'nominalAsset',
          render  : function (data, type, row) {
            return formatRupiah(data) + ',00';
          }
        },
        {data : 'nominalAsset'},
        {data : 'noDokumen'},
        {data : 'jenisPemeliharaan'},
        {data : 'kodePerusahaan'},
      ]
    });
  }
</script>