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
            <div class="m-3">
                <div class="card">
                    <div class="card-body">
                        <form action="{site_url}neraca/index" id="form1" method="get">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Perusahaan : </label>
                                        <?php
                                            if ($this->session->userid !== '1') { ?>
                                                <input type="hidden" name="perusahaan" value="<?= $this->session->idperusahaan; ?>">
                                                <input type="text" class="form-control" value="<?= $this->session->perusahaan; ?>" disabled>
                                            <?php } else { ?>
                                                <select class="form-control perusahaanid" name="perusahaan" style="width: 100%;"></select>
                                            <?php }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label><?php echo lang('date') ?>:</label>
                                        <input type="date" class="form-control datepicker" name="tanggalAwal" required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <input type="date" class="form-control datepicker" name="tanggalAkhir" required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn-block btn bg-success"><?php echo lang('search') ?></button>
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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">         
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="{bg_header}">
                                        <th class="font-weight-bold text-uppercase" style="width: 50%;"><?php echo lang('Aset') ?></th>
                                        <th class="font-weight-bold text-uppercase text-right">Periode Ini</th>
                                        <th class="font-weight-bold text-uppercase text-right">Periode Lalu</th>
                                    </tr>
                                    <tr class="bg-grey-300">
                                        <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Aset Lancar') ?></td>
                                    </tr>
                                    <?php
                                        $totalAsetLancar    = 0;
                                        if ($getasetlancar) {
                                            foreach ($getasetlancar as $key) { ?>
                                                <tr class="table-active">
                                                    <td><?= $key['namaakun']; ?></td>
                                                    <td></td>
                                                    <td class="text-right"><?= number_format($key['debet'],2,',','.'); ?></td>
                                                </tr>
                                            <?php 
                                                $totalAsetLancar    += $key['debet'];
                                            }
                                        } 
                                    ?>
                                    <tr class="">
                                        <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Aset Lancar') ?></td>
                                        <td class="text-right font-weight-bold"><?= number_format($totalAsetLancar,2,',','.'); ?></td>
                                    </tr>
                                    <tr class="bg-grey-300">
                                        <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Aset Tetap') ?></td>
                                    </tr>
                                    <tr class="">
                                        <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Aset Tetap') ?></td>
                                        <td class="text-right font-weight-bold"></td>
                                    </tr>

                                    <tr class="bg-success">
                                        <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Aset') ?></td>
                                        <td class="text-right font-weight-bold"></td>
                                    </tr>
                                    <tr class="{bg_header}">
                                        <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Liabilitas dan Ekuitas') ?></td>
                                    </tr>
                                    <tr class="bg-grey-300">
                                        <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Liabilitas') ?></td>
                                    </tr>
                                    <?php
                                        $totalLiabilitas    = 0;
                                        if ($getliabilitas) {
                                            foreach ($getliabilitas as $key) { ?>
                                                <tr class="table-active">
                                                    <td><?= $key['namaakun']; ?></td>
                                                    <td></td>
                                                    <td class="text-right"><?= number_format($key['kredit'],2,',','.'); ?></td>
                                                </tr>
                                            <?php 
                                                $totalLiabilitas    += $key['kredit'];
                                            }
                                        } 
                                    ?>
                                    <tr class="">
                                        <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Liabilitas') ?></td>
                                        <td class="text-right font-weight-bold"><?= number_format($totalLiabilitas,2,',','.'); ?></td>
                                    </tr>
                                    <tr class="bg-grey-300">
                                        <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Ekuitas') ?></td>
                                    </tr>
                                    <?php
                                        $totalEkuitas    = 0;
                                        if ($ekuitas) {
                                            foreach ($ekuitas as $key) { ?>
                                                <tr class="table-active">
                                                    <td><?= $key['namaakun']; ?></td>
                                                    <td></td>
                                                    <td class="text-right"><?= number_format($key['kredit'],2,',','.'); ?></td>
                                                </tr>
                                            <?php 
                                                $totalEkuitas    += $key['kredit'];
                                            }
                                        } 
                                    ?>
                                    <tr>
                                        <td colspan="2"> <?php echo lang("Laba / Rugi Bersih Berjalan") ?> </td>
                                        <td class="text-right"></td>
                                    </tr>
                                    <tr class="">
                                        <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Ekuitas') ?></td>
                                        <td class="text-right font-weight-bold"><?= number_format($totalEkuitas,2,',','.'); ?></td>
                                    </tr>
                                    <tr class="bg-success">
                                        <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Liabilitas dan Ekuitas') ?></td>
                                        <td class="text-right font-weight-bold"><?= number_format(($totalEkuitas - $totalLiabilitas),2,',','.'); ?></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    ajax_select({ 
        id          : '.perusahaanid', 
        url         : '{site_url}perusahaan/select2', 
        selected    : { 
            id: '{perusahaanid}' 
        } 
    });
</script>