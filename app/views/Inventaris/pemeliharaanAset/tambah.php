
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
						<li class="breadcrumb-item active">{subtitle}</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
    </section>

    <form action="<?= base_url(); ?>inventaris" method="get">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">         
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Kode Perusahaan</label>
                                                    <input type="text" class="form-control" name="kodePerusahaan" disabled id="kodePerusahaan">
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="form-group">
                                                    <label>Nama Perusahaan</label>
                                                    <select class="form-control" name="perusahaan" id="perusahaan" style="width:100%;"></select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Jenis Aset</label>
                                                    <select class="form-control" name="jenisAset" id="jenisAset" style="width:100%;">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Jenis Pemeliharaan</label>
                                                    <select class="form-control" name="jenisPemeliharaan" id="jenisPemeliharaan" style="width:100%;">
                                                        <option value=""></option>
                                                        <option value="overhaul">Overhaul</option>
                                                        <option value="renovasi">Renovasi</option>
                                                        <option value="restorasi">Restorasi</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nomor Dokumen/SK Pemeliharaan</label>
                                            <input type="text" class="form-control" name="noDokumen" id="noDokumen">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="detailBarangTab" data-toggle="tab" href="#detailBarang" role="tab" aria-controls="home" aria-selected="true">Detail Barang</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="detailBarang" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="table-responsive">
                                            <table class="table table-xs table-striped table-borderless table-hover index_datatable">
                                                <thead>
                                                    <tr class="table-active">
                                                        <th>Kode Barang</th>
                                                        <th>Nomor Register</th>
                                                        <th>Nama Inventaris Barang</th>
                                                        <th>Tahun Beli</th>
                                                        <th>Harga Perolehan</th>
                                                        <th>Kondisi</th>
                                                        <th>Asal Barang</th>
                                                        <th>Perusahaan Awal</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-success" type="submit">Tambah</button>
                                <button class="btn btn-danger">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</div>
<script>
    let tableDetailBarang   = $('.index_datatable').DataTable({
        'searching' : false,
        'paging'    : false,
        'ordering'  : false,
        'info'      : false
    });

    $(document).ready(function () {
		ajax_select({
			id	: '#perusahaan',	
			url	: '<?= base_url(); ?>perusahaan/select2',
		});	
        $('#jenisAset').select2({
            'placeholder'   : 'Pilih Jenis Aset',
            'allowClear'    : true
        });
        $('#jenisPemeliharaan').select2({
            'placeholder'   : 'Pilih Jenis Pemeliharaan',
            'allowClear'    : true
        });
	});

    $('#perusahaan').change(function () {
        let perusahaan  = $(this).val();
        $.ajax({
            'url'       : '<?= base_url(); ?>perusahaan/getPerusahaan',
            'method'    : 'get',
            'data'      : {
                'idPerusahaan'  : perusahaan
            },
            'success'   : function (data) {
                $('#kodePerusahaan').val(data.kode);
            }
        })
    })
</script>