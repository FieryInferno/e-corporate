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
                <form action="{site_url}laba_rugi/index" id="form1" method="get">
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
                            <?php
                                if ($penjualan !== null || $hpp !== null || $pendapatanlainnya !== null || $biayalainnya !== null) { ?>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <button type="submit" class="btn-block btn bg-success"><?php echo lang('search') ?></button>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <button type="submit" class="btn-block btn bg-info">PDF</button>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <button type="submit" class="btn-block btn bg-warning">Excel</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn-block btn bg-success"><?php echo lang('search') ?></button>
                                    </div>
                                <?php }
                            ?>
                        </div>
                    </div>
                </form>
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
                            <table class="table table-xs table-borderless table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th colspan="3" class="text-uppercase">
                                            <?php echo lang('income_statement') ?>
                                            <?php
                                                if ($tanggalawal) {
                                                    echo formatdateslash($tanggalawal) . ' - ' . formatdateslash($tanggalakhir);
                                                }
                                            ?> 
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-grey-300 table-active">
                                        <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Pendapatan dari Penjualan') ?></td>
                                    </tr>
                                    <?php
                                        $totalpenjualan = 0;
                                        if ($penjualan) {
                                            foreach ($penjualan as $key) { 
                                                $totalpenjualan += $key['saldo']; ?>
                                                <tr>
                                                    <td colspan="2">
                                                        <a href="{site_url}noakun/detail/<?php echo $key['akunno'] ?>">
                                                            (<?php echo $key['akunno'] ?>) - <?php echo $key['namaakun'] ?> 
                                                        </a>
                                                    </td>
                                                    <td class="text-right">
                                                        <?= number_format($key['saldo'], 2, ',', '.'); ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                        }
                                    ?>
                                    <tr class="">
                                        <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Pendapatan dari Penjualan') ?></td>
                                        <td class="text-right font-weight-bold"><?= number_format($totalpenjualan, 2, ',', '.'); ?></td>
                                    </tr>
                                    
                                    <tr class="bg-grey-300">
                                        <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Harga Pokok Penjualan') ?></td>
                                    </tr>
                                    <?php
                                        $totalhpp = 0;
                                        if ($hpp) {
                                            foreach ($hpp as $key) { 
                                                $totalhpp += $key['saldo']; ?>
                                                <tr>
                                                    <td colspan="2">
                                                        <a href="{site_url}noakun/detail/<?php echo $key['akunno'] ?>">
                                                            (<?php echo $key['akunno'] ?>) - <?php echo $key['namaakun'] ?> 
                                                        </a>
                                                    </td>
                                                    <td class="text-right">
                                                        <?= number_format($key['saldo'], 2, ',', '.'); ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                        }
                                    ?>
                                    <tr class="">
                                        <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Harga Pokok Penjualan') ?></td>
                                        <td class="text-right font-weight-bold"><?= number_format($totalhpp, 2, ',', '.'); ?></td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Laba Kotor') ?></td>
                                        <!-- <?php $labakotor = $totalpenjualan-$totalhpp ?> -->
                                        <td class="text-right font-weight-bold"><?php echo formatnumberakunting($labakotor) ?></td>
                                    </tr>

                                    <tr class="bg-grey-300">
                                        <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Beban Operasional') ?></td>
                                    </tr>
                                    <!-- <?php $totaloperasional = 0 ?>
                                    <?php foreach ($operasional as $opr): ?>
                                        <?php $totaloperasional = $totaloperasional + $opr['saldo'] ?>
                                        <?php if ($opr['saldo'] > 0): ?>
                                            <tr>
                                                <td colspan="2">
                                                    <a href="{site_url}noakun/detail/<?php echo $opr['noakun'] ?>">
                                                        (<?php echo $opr['noakun'] ?>) - <?php echo $opr['namaakun'] ?> 
                                                    </a>
                                                </td>
                                                <td class="text-right">(<?php echo formatnumberakunting($opr['saldo']) ?>)</td>
                                            </tr>
                                        <?php endif ?>
                                    <?php endforeach ?> -->
                                    <tr class="">
                                        <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Biaya') ?></td>
                                        <td class="text-right font-weight-bold">(<?php echo formatnumberakunting($totaloperasional) ?>)</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Pendapatan Bersih Operasional') ?></td>
                                        <?php $pendapatanbersihoperasional = $labakotor-$totaloperasional ?>
                                        <td class="text-right font-weight-bold"><?php echo formatnumberakunting($pendapatanbersihoperasional) ?></td>
                                    </tr>

                                    <tr class="bg-grey-300">
                                        <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Pendapatan Lainnya') ?></td>
                                    </tr>
                                    <?php
                                        $totalpendapatanlainnya = 0;
                                        if ($pendapatanlainnya) {
                                            foreach ($pendapatanlainnya as $key) { 
                                                $totalpendapatanlainnya += $key['saldo']; ?>
                                                <tr>
                                                    <td colspan="2">
                                                        <a href="{site_url}noakun/detail/<?php echo $key['akunno'] ?>">
                                                            (<?php echo $key['akunno'] ?>) - <?php echo $key['namaakun'] ?> 
                                                        </a>
                                                    </td>
                                                    <td class="text-right">
                                                        <?= number_format($key['saldo'], 2, ',', '.'); ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                        }
                                    ?>
                                    <tr class="">
                                        <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Pendapatan Lainnya') ?></td>
                                        <td class="text-right font-weight-bold"><?= number_format($totalpendapatanlainnya, 2, ',', '.'); ?></td>
                                    </tr>

                                    <tr class="bg-grey-300">
                                        <td colspan="3" class="font-weight-bold text-uppercase"><?php echo lang('Beban Lainya') ?></td>
                                    </tr>
                                    <?php
                                        $totalbiayalainnya = 0;
                                        if ($biayalainnya) {
                                            foreach ($biayalainnya as $key) { 
                                                $totalbiayalainnya += $key['saldo']; ?>
                                                <tr>
                                                    <td colspan="2">
                                                        <a href="{site_url}noakun/detail/<?php echo $key['akunno'] ?>">
                                                            (<?php echo $key['akunno'] ?>) - <?php echo $key['namaakun'] ?> 
                                                        </a>
                                                    </td>
                                                    <td class="text-right">
                                                        <?= number_format($key['saldo'], 2, ',', '.'); ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                        }
                                    ?>
                                    <tr class="">
                                        <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Total Beban Lainnya') ?></td>
                                        <td class="text-right font-weight-bold"><?= number_format($totalbiayalainnya, 2, ',', '.'); ?></td>
                                    </tr>

                                    <tr class="bg-info">
                                        <td colspan="2" class="font-weight-bold text-uppercase"><?php echo lang('Laba / Rugi Bersih') ?></td>
                                        <?php $pendapatanbersih = $pendapatanbersihoperasional + $totalpendapatanlainnya - $totalbiayalainnya ?>
                                        <td class="text-right font-weight-bold"><?= number_format($pendapatanbersih, 2, ',', '.'); ?></td>
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