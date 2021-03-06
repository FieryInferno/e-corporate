
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
              <a class="btn btn-success" href="<?= base_url(); ?>pemeliharaan_aset/tambah"><i class="fas fa-plus"></i> Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-xs table-striped table-borderless table-hover index_datatable">
                  <thead>
                    <tr class="table-active">
                      <th>Kode Perusahaan</th>
                      <th>Nama Perusahaan</th>
                      <th>Pemilik Terkini</th>
                      <th>Nominal Aset</th>
                      <th>Nominal Pemeliharaan</th>
                      <th>Nomor Dokumen/SK Pemeliharaan</th>
                      <th>Jenis Pemeliharaan</th>
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
      url : '{site_url}pemeliharaan_aset/data'
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
        data    : 'totalNominalPemeliharaan',
        render  : function (data, type, row) {
          return formatRupiah(data) + ',00';
        }
      },
      {data : 'noDokumen'},
      {data : 'jenisPemeliharaan'},
      {
        data    : 'idPemeliharaan',
        render  : function (data, type, row) {
          let aksi  = `
            <div class="list-icons"> 
              <div class="dropdown"> 
                <a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
								<div class="dropdown-menu dropdown-menu-right">
									<a href="{site_url}pemeliharaan_aset/edit/${data}" class="dropdown-item text-success"><i class="fas fa-pencil-alt"></i> Edit</a>
									<a href="javascript:hapus('${data}')" class="dropdown-item delete text-danger"><i class="fas fa-trash"></i> <?php echo lang('delete') ?></a>
                </div> 
              </div> 
            </div>`;
          return aksi;
        }
      },
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
        url   : '{site_url}pemeliharaan_aset/data',
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

  function hapus(idPemeliharaan) {
    swal("Anda yakin akan menghapus data?", {
      buttons : {
        cancel  : "Batal",
        catch   : {
          text  : "Ya, Yakin",
          value : "ya",
        },
      },
    })
    .then((value) => {
      switch (value) {
        case "ya":
        $.ajax({
          url         : '{site_url}pemeliharaan_aset/hapus/' + idPemeliharaan,
          beforeSend  : function() {
            pageBlock();
          },
          afterSend : function() {
            unpageBlock();
          },
          success : function(data) {
            if(data.status == 'success') {
              swal("Berhasil!", "Data Berhasil Dihapus!", "success");
              setTimeout(function() { table.ajax.reload() }, 100);
            } else {
              swal("Gagal!", "Pikachu was caught!", "error");
            }
          },
          error: function() {
          swal("Gagal!", "Internal Server Error!", "error");
          }
        })
        break;
      }
    });
  }
</script>