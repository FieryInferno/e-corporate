<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('anggaran_belanja'); ?>">{title}</a></li>
                        <li class="breadcrumb-item active">{subtitle}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <!-- left column -->
                <div class="col-md-12">
                    <form action="">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{subtitle} {title}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Kode Jurnal :</label>
                                            <input type="text" class="form-control" placeholder="Kode Jurnal">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Formulir :</label>
                                            <select name="formulir" id="formulir" class="form-control">
                                                <option value="fakturPembelian">Faktur Pembelian</option>
                                                <option value="fakturPembelian">Faktur Penjualan</option>
                                                <option value="fakturPembelian">Penerimaan Barang</option>
                                                <option value="fakturPembelian">Pengiriman Barang</option>
                                                <option value="fakturPembelian">Pengeluaran Kas Kecil</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Keterangan :</label>
                                            <input type="text" class="form-control" placeholder="Keterangan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Entitas Akuntansi</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h5>Jurnal Anggaran</h5>
                                        <button type="button" class="btn btn-primary">
                                            + <?php echo lang('add_new') ?>
                                        </button>
                                        <table class="table table-striped table-borderless table-hover">
                                            <thead>
                                                <tr class="table-active">
                                                    <th scope="col">Elemen</th>
                                                    <th scope="col">D/K</th>
                                                    <th scope="col">Nominal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-2">
                                                                <button type="button" class="btn btn-danger">-</button>
                                                            </div>
                                                            <div class="col-10">
                                                                <select name="elemen" id="elemen" class="form-control">
                                                                    <option value="" disabled selected>Pilih Elemen</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <select name="d/k" id="d/k" class="form-control">
                                                            <option value="" disabled selected>Pilih Jenis</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="nominal" id="nominal" class="form-control">
                                                            <option value="" disabled selected>Pilih Nominal</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-2">
                                                                <button type="button" class="btn btn-danger">-</button>
                                                            </div>
                                                            <div class="col-10">
                                                                <select name="elemen" id="elemen" class="form-control">
                                                                    <option value="" disabled selected>Pilih Elemen</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <select name="d/k" id="d/k" class="form-control">
                                                            <option value="" disabled selected>Pilih Jenis</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="nominal" id="nominal" class="form-control">
                                                            <option value="" disabled selected>Pilih Nominal</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-6">
                                        <h5>Jurnal Finansial</h5>
                                        <button type="button" class="btn btn-primary">
                                            + <?php echo lang('add_new') ?>
                                        </button>
                                        <table class="table table-striped table-borderless table-hover">
                                            <thead>
                                                <tr class="table-active">
                                                    <th scope="col">Elemen</th>
                                                    <th scope="col">D/K</th>
                                                    <th scope="col">Nominal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-2">
                                                                <button type="button" class="btn btn-danger">-</button>
                                                            </div>
                                                            <div class="col-10">
                                                                <select name="elemen" id="elemen" class="form-control">
                                                                    <option value="" disabled selected>Pilih Elemen</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <select name="d/k" id="d/k" class="form-control">
                                                            <option value="" disabled selected>Pilih Jenis</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="nominal" id="nominal" class="form-control">
                                                            <option value="" disabled selected>Pilih Nominal</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-2">
                                                                <button type="button" class="btn btn-danger">-</button>
                                                            </div>
                                                            <div class="col-10">
                                                                <select name="elemen" id="elemen" class="form-control">
                                                                    <option value="" disabled selected>Pilih Elemen</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <select name="d/k" id="d/k" class="form-control">
                                                            <option value="" disabled selected>Pilih Jenis</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="nominal" id="nominal" class="form-control">
                                                            <option value="" disabled selected>Pilih Nominal</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </form>
                    <!--/.col (left) -->
                <!--/.col (right) -->
                </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>