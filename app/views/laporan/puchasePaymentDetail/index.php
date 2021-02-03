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
            <li class="breadcrumb-item"><a href="#">{title}</a></li>
          </ol>
        </div>  
      </div>
      <div class="card">
        <div class="card-body">
          <div class="m-3">
            <form action="{site_url}purchase_payment_detail" method="get">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Perusahaan:</label>
                    <?php
                      if ($this->session->userid !== '1') { ?>
                        <input type="hidden" name="perusahaan" id="perusahaan" value="<?= $this->session->idperusahaan; ?>">
                        <input type="text" class="form-control" value="<?= $this->session->perusahaan; ?>" disabled>
                      <?php } else { ?>
                        <select class="form-control perusahaan" name="perusahaan" id="perusahaan" style="width: 100%;"></select>
                      <?php }
                    ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="row">
                    <div class="col-5">
                      <div class="form-group">
                        <label>Tanggal Awal</label>
                        <input type="date" class="form-control" name="tanggalAwal" required>
                      </div>
                    </div>
                    <div class="col-2">
                      <div class="form-group">
                        <label>&nbsp;</label>
                        <input type="text" class="form-control" value="s/d" disabled>
                      </div>
                    </div>
                    <div class="col-5">
                      <div class="form-group">
                        <label>Tanggal Akhir</label>
                        <input type="date" class="form-control" name="tanggalAkhir" required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="row">
                    <div class="col-6">
                      <div class="text-right">
                        <button type="submit" class="btn-block btn bg-success" value="pdf" name="jenis">Cetak PDF</button>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="text-right">
                        <button type="submit" class="btn-block btn bg-success" value="excel" name="jenis">Cetak XLS</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    if ('<?= $this->session->userid; ?>' == '1') {
      ajax_select({
        id: '#perusahaan',
        url: '{site_url}perusahaan/select2'
      });
    }
  })
</script>