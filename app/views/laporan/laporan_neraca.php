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
                        <li class="breadcrumb-item active">{subtitle}</li>
                    </ol>
                </div>  
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="m-3">
                        <form action="{site_url}export_laporan_neraca" method="get">
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
                                    <div class="form-group">
                                        <label><?php echo lang('Tanggal Awal') ?>:</label>
                                        <input type="date" class="form-control datepicker" name="tanggalAwal" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo lang('Tanggal Akhir') ?>:</label>
                                        <input type="date" class="form-control datepicker" name="tanggalAkhir" required>
                                    </div>
                                </div>
                            </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="row">
                                <div class="col-6">
                                  <div class="text-right">
                                    <button type="submit" name="pdf" value="pdf" formtarget="_blank" class="btn btn-block btn-success">Cetak PDF</button>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="text-right">
                                    <button type="submit" name="excel" value="excel" class="btn btn-block btn-success">Cetak XLS</button>
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

    <!-- Main content -->
</div>
<script type="text/javascript">
    $(document).ready(function () {
        if ('<?= $this->session->userid; ?>' == '1') {
            ajax_select({
                id: '#perusahaan',
                url: '{site_url}perusahaan/select2'
            });
        }

        ajax_select({
            id  : '#kasKecil',
            url : '{site_url}pengajuan_kas_kecil/select2_mnoakun/',
        });
    })
</script>