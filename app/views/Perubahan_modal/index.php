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
        <div class="header-elements d-none">
			<div class="d-flex justify-content-center">
				<div class="btn-group">
					<?php $currentURL = current_url(); ?>
					<?php $params = $_SERVER['QUERY_STRING']; ?>
					<?php $fullURL = $currentURL . '/printpdf?' . $params; ?>
					<?php $fullURLChange = $fullURL ?>
					<?php if ($this->uri->segment(2)): ?>
						<?php $fullURL = $currentURL . '?' . $params; ?>
						<?php $fullURLChange = str_replace('index', 'printpdf', $fullURL) ?>
					<?php endif ?>
					<a href="<?php echo $fullURLChange ?>" target="_blank" class="btn btn-warning"><?php echo lang('print') ?></a>
				</div>
			</div>
		</div>
        <div class="m-3">
            <form action="{site_url}perubahan_modal/index" id="form1" method="get">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Perusahaan:</label>
                            <select class="form-control perusahaanid" name="perusahaanid"></select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label><?php echo lang('start_date') ?>:</label>
                            <input type="text" class="form-control datepicker" name="tanggalawal" required value="{tanggalawal}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label><?php echo lang('end_date') ?>:</label>
                            <input type="text" class="form-control datepicker" name="tanggalakhir" required value="{tanggalakhir}">
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
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">         
            <div class="card">
                <table class="table table-bordered">
                    <thead class="{bg_header}">
                        <tr>
                            <th colspan="3" class="text-uppercase">
                                <?php echo lang('Statement_of_Owner_Equity') ?> 
                                (<?php echo formatdateslash($tanggalawal) ?> - <?php echo formatdateslash($tanggalakhir) ?>)
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $awal = 0 ?>
                        <tr class="bg-light">
                            <td colspan="3" class="font-weight-bold text-uppercase">
                                <span class="float-left"> <?php echo lang('Modal Awal') ?> - <?php echo formatdateslash($tanggalawal) ?> </span>
                                <span class="float-right"><?php echo formatnumberakunting($get_saldo_awal['totalsaldoawal']) ?></span>
                            </td>
                        </tr>
                        <?php $totalekuitas = $get_saldo_awal['totalsaldoawal'] ?>
                        <?php foreach ($getekuitas as $ekuitas): ?>
                            <?php $totalekuitas = $totalekuitas + $ekuitas['saldo'] ?>
                            <?php if ($ekuitas['saldo'] > 0): ?>
                                <tr>
                                    <td colspan="2">
                                        <a href="{site_url}noakun/detail/<?php echo $ekuitas['noakun'] ?>">
                                            (<?php echo $ekuitas['noakun'] ?>) - <?php echo $ekuitas['namaakun'] ?> 
                                        </a>
                                    </td>
                                    <td class="text-right"><?php echo formatnumberakunting($ekuitas['saldo']) ?></td>
                                </tr>
                            <?php endif ?>
                        <?php endforeach ?>
                        <tr>
                            <td colspan="2">Laba / Rugi Bersih</td>
                            <td class="text-right"><?php echo formatnumberakunting($gettotallabarugi) ?></td>
                        </tr>

                        <?php $totalmodal = $totalekuitas + $gettotallabarugi ?>
                        <?php $totalprive = 0 ?>
                        <?php foreach ($getprive as $prive): ?>
                            <?php $totalprive = $totalprive + $prive['saldo'] ?>
                            <?php if ($prive['saldo'] > 0): ?>
                                <tr>
                                    <td colspan="2">
                                        <a href="{site_url}noakun/detail/<?php echo $prive['noakun'] ?>"> 
                                            (<?php echo $prive['noakun'] ?>) - <?php echo $prive['namaakun'] ?>
                                        </a> 
                                    </td>
                                    <td class="text-right">(<?php echo formatnumberakunting($prive['saldo']) ?>)</td>
                                </tr>
                            <?php endif ?>
                        <?php endforeach ?>
                        <tr class="bg-light">
                            <td colspan="3" class="font-weight-bold text-uppercase">
                                <span class="float-left"> <?php echo lang('Modal Akhir') ?> - <?php echo formatdateslash($tanggalakhir) ?> </span>
                                <span class="float-right"><?php echo formatnumberakunting($totalmodal-$totalprive) ?></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
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