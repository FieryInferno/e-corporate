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
      <div class="row">
        <div class="col-12">         
          <div class="card">
            <div class="card-body">
              <form action="{site_url}piutang/index" id="form1" method="get">
                <div class="row">
                  <?php
                    if ($this->session->userid !== '1') { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Perusahaan : </label>
                          <input type="hidden" name="perusahaanid" value="<?= $this->session->idperusahaan; ?>">
                          <input type="text" class="form-control" value="<?= $this->session->perusahaan; ?>" disabled>
                        </div>
                      </div>
                    <?php } else { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Perusahaan : </label>
                          <select class="form-control perusahaanid" name="perusahaanid"></select>
                        </div>
                      </div>
                    <?php }
                  ?>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Usia Piutang : </label>
                      <select class="form-control" name="usiaPiutang">
                        <option value="" disabled selected>Pilih Usia Utang</option>
                        <option value="kurang30">Kurang Dari 30 Hari</option>
                        <option value="0">0 Hari</option>
                        <option value="lebih30">Lebih Dari 30 Hari</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo lang('Kontak') ?>:</label>
                      <select class="form-control kontakid" name="kontakid"></select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label><?php echo lang('start_date') ?>:</label>
                      <input type="date" class="form-control datepicker" name="tanggalawal">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label><?php echo lang('end_date') ?>:</label>
                      <input type="date" class="form-control datepicker" name="tanggalakhir">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="text-right">
                      <button class="btn-block btn btn-success" type="submit"><i class="fas fa-filter"></i> Filter</button>
                      <button class="btn-block btn btn-warning">Reset</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
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
              <div class="table-responsive">
                <table class="table table-xs table-striped table-borderless table-hover" id="tabelPiutang">
                  <thead>
                    <tr class="table-active">
                      <th>Tgl Inv</th>
                      <th>Tgl J/T</th>
                      <th>Usia Piutang</th>
                      <th><?php echo lang('No Invoice') ?></th>
                      <th>Nama Perusahaan</th>
                      <th><?php echo lang('Keterangan') ?></th>
                      <th><?php echo lang('Supplier') ?></th>
                      <th class="text-center"><?php echo lang('piutang') ?></th>
                      <th class="text-center"><?php echo lang('Sudah Dibayar') ?></th>
                      <th class="text-center"><?php echo lang('Sisa piutang') ?></th>
                      <th class="text-center"><?php echo lang('Status') ?></th>
                      <th class="text-right"><?php echo lang('action') ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $totalPiutang   = 0;
                      foreach ($piutang as $key) { 
                        $totalPiutang   += $key['primeOwing']; ?>
                        <tr>
                          <td><?= $key['tanggal']; ?></td>
                          <td><?= $key['tanggalTempo']; ?></td>
                          <td><?= $key['usiaPiutang']; ?> Hari</td>
                          <td><?= $key['noInvoice']; ?></td>
                          <td><?= $key['nama_perusahaan']; ?></td>
                          <td><?= $key['deskripsi']; ?></td>
                          <td><?= $key['namaPelanggan']; ?></td>
                          <td><?= number_format($key['primeOwing'],2,',','.'); ?></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>
                            <div class="list-icons"> 
                              <div class="dropdown"> 
                                <a href="#" class="list-icons-item" data-toggle="dropdown"> <i class="fas fa-bars"></i> </a> 
                                <div class="dropdown-menu dropdown-menu-right"></div> 
                              </div> 
                            </div>
                          </td>
                        </tr>
                      <?php }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr class="table-active">
                      <td colspan="7" class="text-right">Total</td>
                      <td><?= number_format($totalPiutang,2,',','.'); ?></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
	var base_url  = '{site_url}piutang/';
	if ('<?= $this->session->userid; ?>' == '1') {
    ajax_select({ 
      id        : '.perusahaanid', 
      url       : '{site_url}perusahaan/select2', 
      selected  : { 
        id  : '{perusahaanid}' 
      } 
    });

    $('.perusahaanid').change(function(e) {
      var perusahaan  = $('.perusahaanid').children('option:selected').val();
      ajax_select({ 
        id        : '.kontakid', 
        url       : base_url + 'select2_kontak_piutang/' + perusahaan, 
        selected  : { 
          id: '{kontakid}' 
        } 
      });
    })
  } else {
    ajax_select({ 
      id        : '.kontakid', 
      url       : base_url + 'select2_kontak_piutang/<?= $this->session->idperusahaan; ?>', 
      selected  : { 
        id: '{kontakid}' 
      } 
    });

//     $('.kontakid').select2({
//       'placeholder'   : 'Pilih Jenis Inventaris',
//       'allowClear'    : true,
//       'ajax'          : {
//         'url'           : '{site_url}Noakun/jenisAset',
//         dataType        : 'json',
//         delay           : 250,
//         processResults  : function (data) {
//           return {
//             results : data
//           }
//         },
//         cache   : false,
//       },
//     })
//           var newOption = new Option('semua', 'semua', false, false);
// $('.kontakid').append(newOption).trigger('change');
  }

  $('#tabelPiutang').DataTable({
    "order": [[ 0, "desc" ]]
  });
</script>