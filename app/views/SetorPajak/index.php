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
                <form action="{site_url}utang/index" id="form1" method="get">
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
                                <button type="submit" class="btn-block btn bg-success"><i class="fas fa-filter"></i> Filter</button>
                                <button class="btn-block btn bg-warning">Reset</button>
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
                        <div class="table-responsive">
                            <table class="table table-xs table-striped table-borderless table-hover">
                                <thead>
                                    <tr class="table-active">
                                        <th>Nomor SSP</th>
                                        <th>Tanggal</th>
                                        <th>Pajak</th>
                                        <th>No. Faktur Pembelian</th>
                                        <th>Perusahaan</th>
                                        <th class="text-center">Nominal</th>
                                        <th class="text-center">NTPN</th>
                                        <th class="text-center">NPWP</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>