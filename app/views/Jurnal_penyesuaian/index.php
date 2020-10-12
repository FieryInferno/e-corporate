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
        <div class="header-elements d-none">
            <div class="d-flex justify-content-center">
                <div class="btn-group">
                    <a href="{site_url}jurnal_penyesuaian/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
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
            <form action="{site_url}jurnal_penyesuaian/index" id="form1" method="get">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label><?php echo lang('start_date') ?>:</label>
                            <input type="date" class="form-control datepicker" name="tanggalawal" required value="{tanggalawal}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label><?php echo lang('end_date') ?>:</label>
                            <input type="date" class="form-control datepicker" name="tanggalakhir" required value="{tanggalakhir}">
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
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">         
            <div class="card">
              <!-- <div class="card-header">
				<a href="{site_url}pajak/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    + Import
                </button>
			</div> -->
                <div class="card-body">
                    <table class="table">
                        <thead class="{bg_header}">
                            <tr>
                                <th><?php echo lang('account') ?></th>
                                <th class="text-right" width="20%"><?php echo lang('debet') ?></th>
                                <th class="text-right" width="20%"><?php echo lang('kredit') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($get_jurnal): ?>
                                <?php foreach ($get_jurnal as $row): ?>
                                    <tr class="bg-grey-300">
                                        <td>
                                            <?php $date = date('d/m/Y', strtotime($row['tanggal'])) ?>
                                            <span class="font-weight-bold"><?php echo $row['keterangan'] ?> - </span> 
                                            <span class="font-weight-bold">( <?php echo $date ?> )</span> 
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php $totaldebet = 0 ?>
                                    <?php $totalkredit = 0 ?>
                                    <?php foreach ($this->model->get_jurnal_detail($row['id']) as $det): ?>
                                        <?php $totaldebet = $totaldebet + $det['debet'] ?>
                                        <?php $totalkredit = $totalkredit + $det['kredit'] ?>
                                        <tr>
                                            <td>
                                                <a href="{site_url}noakun/detail/<?php echo $det['noakun'] ?>">
                                                    <?php if ($det['debet'] == 0): ?>
                                                        <?php echo str_repeat('&nbsp;', 20).'('.$det['noakun'] ?>) - <?php echo $det['namaakun'] ?> 
                                                    <?php else: ?>
                                                        (<?php echo $det['noakun'] ?>) - <?php echo $det['namaakun'] ?> 
                                                    <?php endif ?>
                                                </a>
                                            </td>
                                            <td class="text-right"><?php echo number_format($det['debet']) ?></td>
                                            <td class="text-right"><?php echo number_format($det['kredit']) ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                    <tr class="bg-light font-weight-bold">
                                        <td class="text-right">Total</td>
                                        <td class="text-right"><?php echo number_format($totaldebet) ?></td>
                                        <td class="text-right"><?php echo number_format($totalkredit) ?></td>
                                    </tr>
                                <?php endforeach ?>
                            <?php else: ?>
                                <tr>
                                    <td class="text-center" colspan="3"><?php echo lang('data_not_found') ?></td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3 mb-3">
                <?php echo $pagination ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>