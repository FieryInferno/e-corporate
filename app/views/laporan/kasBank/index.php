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
                                        <label>Rekening : </label>
                                        <select class="form-control" name="rekening" id="rekening" required></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tanggal : </label>
                                        <input type="date" class="form-control" name="tanggal" placeholder="Tanggal" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
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
                        <?php
                            if ($laporan) { ?>
                                <div class="card-header">
                                    <form action="{site_url}laporan/print" method="get">
                                        <input type="hidden" name="perusahaan" value="{perusahaan}">
                                        <input type="hidden" name="rekening" value="{rekening}">
                                        <input type="hidden" name="tanggal" value="{tanggalA}">
                                        <button type="submit" class="btn btn-primary" name="tombol" value="pdf">PDF</button>
                                        <button type="submit" class="btn btn-primary" name="tombol" value="excel">Excel</button>
                                    </form>
                                </div>
                            <?php }
                        ?>
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
                                                            <td class="text-center"><span class="btn btn-sm btn-info"><?= $value['no']; ?></span></td>
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
            $('#perusahaan').change(function(e) {
                var perusahaan  = $('#perusahaan').children('option:selected').val();
                ajax_select({
                    id  : '#rekening',
                    url : '{site_url}rekening/select2/' + perusahaan,
                });
            })   
        } else {
            ajax_select({
                id  : '#rekening',
                url : '{site_url}rekening/select2/<?= $this->session->idperusahaan; ?>',
            });
        }
    })
</script>