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
            <div class="card-header">
              <form action="{site_url}jurnal">
                <div class="row">
                  <div class="col-2">
                    <select name="tipe" id="tipe" class="form-control">
                      <option value="" disabled selected>-- Semua Jenis --</option>
                      <option value="saldoAwal">Saldo Awal</option>
                      <option value="fakturPenjualan">Faktur Penjualan</option>
                      <option value="fakturPembelian">Faktur Pembelian</option>
                      <option value="kasBank">Kas Bank</option>
                      <option value="penerimaanBarang">Penerimaan Barang</option>
                      <option value="pengirimanBarang">Pengiriman Barang</option>
                      <option value="jurnalPenyesuaian">Jurnal Penyesuaian</option>
                      <option value="kasKecil">Kas Kecil</option>
                    </select>
                  </div>
                  <div class="col-2">
                    <input type="date" name="tglMulai" placeholder="Tanggal Mulai" class="form-control">
                  </div>
                  <div class="col-2">
                    <input type="date" name="tglSampai" placeholder="Tanggal Sampai" class="form-control">
                  </div>
                  <div class="col-2">
                    <input type="text" name="kodeAkun" placeholder="Kode Akun" class="form-control">
                  </div>
                  <div class="col-2">
                    <button class="btn btn-info" type="submit">Filter</button>
                    <button class="btn btn-danger">Reset</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-xs index_datatable">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Tipe</th>
                      <th>No Trans</th>
                      <th>Departemen</th>
                      <th>Nama Perusahaan</th>
                      <th>Nomor Akun</th>
                      <th>Nama Akun</th>
                      <th>Debit</th>
                      <th>Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($jurnalUmum as $key => $value) { 
                        foreach ($value as $key) { ?>
                          <tr>
                            <td><?= $key['tanggal']; ?></td>
                            <td><?= $key['formulir']; ?></td>
                            <td><?= $key['noTrans']; ?></td>
                            <td><?= $key['departemen']; ?></td>
                            <td><?= $key['nama_perusahaan']; ?></td>
                            <td><?= $key['akunno']; ?></td>
                            <td><?= $key['namaakun']; ?></td>
                            <?php 
                              if ($key['jenisAnggaran'] !== null) { 
                                switch ($key['jenisAnggaran']) {
                                  case 'debit': ?>
                                    <td>Rp. <?= number_format($key['total'],2,',','.'); ?></td>
                                    <td>Rp. <?= number_format(0,2,',','.'); ?></td>
                                    <?php break;
                                  case 'kredit': ?>
                                    <td>Rp. <?= number_format(0,2,',','.'); ?></td>
                                    <td>Rp. <?= number_format($key['total'],2,',','.'); ?></td>
                                    <?php break;
                                  default:
                                    # code...
                                    break;
                                }
                              } ?>
                          </tr>
                        <?php }
                      }
                    ?>
                  </tbody>
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
  var base_url = '{site_url}Jurnal/';
  var table     = $('.index_datatable').DataTable(); 
  // var table = $('.index_datatable').DataTable({
	// 	ajax: {
	// 		url     : base_url + 'index_datatable',
	// 		type    : 'post',
	// 	},
	// 	pageLength: 100,
	// 	stateSave: true,
	// 	autoWidth: false,
	// 	dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"p>',
	// 	language: {
	// 		search: '<span></span> _INPUT_',
	// 		searchPlaceholder: 'Type to filter...',
	// 	},
	// 	columns: [{
	// 			data: 'idSetupJurnal',
	// 			visible: false
	// 		},
	// 		{data	: 'kodeJurnal'},
	// 		{data	: 'formulir'},
	// 		{data	: 'keterangan'},
	// 		{
	// 			className	: "text-center",
	// 			render: function(data, type, row) {
	// 				var aksi = `
	// 					<div class="list-icons"> 
	// 						<div class="dropdown"> 
	// 							<a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
	// 							<div class="dropdown-menu dropdown-menu-right">
	// 								<a class="dropdown-item" href=""><i class="fas fa-pencil-alt"></i> Edit</a>
	// 								<a href="javascript:deleteData('` + row.idSetupJurnal + `')" class="dropdown-item delete"><i class="fas fa-trash"></i> <?php echo lang('delete') ?></a>
	// 							</div> 
	// 						</div> 
	// 					</div>`;
	// 				return aksi;
	// 			}
	// 		}
	// 	]
	// });
</script>