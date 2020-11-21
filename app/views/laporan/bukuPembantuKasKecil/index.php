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
                        <form action="" id="form1" method="get">
                            <div class="row">
                                <div class="col-md-6">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Rekening Kas Kecil : </label>
                                        <select class="form-control" name="kasKecil" id="kasKecil" required></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tanggal Awal : </label>
                                        <input type="date" class="form-control" name="tanggalAwal" placeholder="Tanggal" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tanggal Akhir : </label>
                                        <input type="date" class="form-control" name="tanggalAkhir" placeholder="Tanggal" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="text-right">
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
                        <div class="card-body">
                            <div class="table-responsive">
								<table class="table table-xs table-striped table-borderless table-hover index_datatable">
									<thead>
										<tr class="table-active">
                                            <th class="text-center">No Kas</th>
                                            <th class="text-center">Uraian</th>
                                            <th class="text-center">Penerimaan</th>
                                            <th class="text-center">Pengeluaran</th>
										</tr>
									</thead>
									<tbody>
                                        <?php
                                            if ($laporan !== null) { 
                                                $jumlahDebet    = 0;
                                                $jumlahKredit   = 0; 

                                                function terbilang($nilai) {
                                                    if($nilai<0) {
                                                        $hasil = "minus ". trim(penyebut($nilai));
                                                    } else {
                                                        $hasil = trim(penyebut($nilai));
                                                    }     		
                                                    return $hasil;
                                                }
                                                ?>
                                                <tr>
                                                    <td></td>
                                                    <td class="text-center"><strong>Jumlah Sampai dengan Tanggal {tanggal}</strong></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <?php foreach ($laporan as $key) {
                                                    foreach ($key as $value) { ?>
                                                        <tr>
                                                            <td class="text-center"><?= $value['no']; ?></td>
                                                            <td class="text-center"><?= $value['keterangan']; ?></td>
                                                            <td class="text-center"><?= number_format($value['debet'],2,',','.'); ?></td>
                                                            <td class="text-center"><?= number_format($value['kredit'],2,',','.'); ?></td>
                                                        </tr>
                                                    <?php 
                                                        $jumlahDebet    += $value['debet'];
                                                        $jumlahKredit   += $value['kredit'];
                                                    }
                                                } ?>
                                                <tr>
                                                    <td class="text-center" colspan="2"><strong>Jumlah Tanggal {tanggal}</strong></td>
                                                    <td class="text-center"><strong><?= number_format($jumlahDebet,2,',','.'); ?></strong></td>
                                                    <td class="text-center"><strong><?= number_format($jumlahKredit,2,',','.'); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" colspan="2"><strong>Jumlah Sampai dengan Tanggal {tanggalAwal}</strong></td>
                                                    <td class="text-center"><strong><?= number_format($jumlahDebetAwal,2,',','.'); ?></strong></td>
                                                    <td class="text-center"><strong><?= number_format($jumlahKreditAwal,2,',','.'); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" colspan="2"><strong>Jumlah Sampai dengan Tanggal {tanggal}</strong></td>
                                                    <td class="text-center"><strong><?= number_format(($jumlahDebetAwal + $jumlahDebet),2,',','.'); ?></strong></td>
                                                    <td class="text-center"><strong><?= number_format(($jumlahKreditAwal + $jumlahKredit),2,',','.'); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" colspan="2"><strong>Saldo Hari ini Tanggal {tanggal}</strong></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"><strong><?= number_format((($jumlahDebetAwal + $jumlahDebet) - ($jumlahKreditAwal + $jumlahKredit)),2,',','.'); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4"><strong>Sisa dengan huruf : <?= strtoupper(terbilang((($jumlahDebetAwal + $jumlahDebet) - ($jumlahKreditAwal + $jumlahKredit)))) . ' RUPIAH'; ?></strong></td>
                                                </tr>
                                            <?php }
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