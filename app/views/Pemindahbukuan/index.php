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
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">         
                    <div class="card">
                        <div class="card-header">
                            <!-- bagian button print -->
                            <div class="header-elements d-none">
                                <div class="d-flex justify-content-center">
                                    
                                </div>
                            </div>
                            

                            <!-- ini bagian search -->
                            <div class="m-3">
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
                                <form action="{site_url}pemindahbukuan/index" id="form1" method="get">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo lang('start_date') ?>:</label>
                                                <input type="date" class="form-control datepicker" name="tanggalawal" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo lang('end_date') ?>:</label>
                                                <input type="date" class="form-control datepicker" name="tanggalakhir" required>
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
                    <div class="content">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-xs table-striped table-borderless table-hover index_datatable">
                                        <thead>
                                            <tr class="table-active">
                                                <th><?php echo lang('id') ?></th>
                                                <th><?php echo lang('No. Kas Bank') ?></th>
                                                <th><?php echo lang('company') ?></th>
                                                <th><?php echo lang('information') ?></th>
                                                <th><?php echo lang('date') ?></th>
                                                <th><?php echo lang('Nominal') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-xs table-striped table-borderless table-hover" id="tabelDetail">
                        <thead>
                            <tr class="table-active">
                                <th>Tanggal</th>
                                <th>Nomor Aktifitas</th>
                                <th>Penerimaan</th>
                                <th>Nomor Akun</th>
                                <th>Nama Perusahaan</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	var base_url = '{site_url}Pemindahbukuan/';

	var table = $('.index_datatable').DataTable({
		ajax: {
			url: base_url + 'index_datatable',
		},
		stateSave: true,
		autoWidth: false,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"p>',
        language: {
            search: '<span></span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
        },
        columns: [
            {data: 'id', visible: false},
            {
                data: 'nomor_kas_bank', 
                render: function(data,type,row) {
                    return ` 
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detail" idPemindahbukuan="${row.id}" onclick="detail(this)">
                        ${data}
                    </button>`;
                }
            },
            {data: 'nama_perusahaan'},
            {data: 'keterangan'},
            {data: 'tanggal'},
            {
                data        : 'nominal', 
                className   : 'text-right', 
                orderable   : false,
                render: function(data, type, row) {
                    return formatRupiah(String(data)) + ',00';
                }
            },
        ]
	});

    var tabelDetail = $('#tabelDetail').DataTable();

    function detail(elemen) {
        tabelDetail.clear().draw();
        $.ajax({
            url     : base_url + 'detail',
            method  : 'post',
            data    : {
                idPemindahbukuan    : $(elemen).attr('idPemindahbukuan')
            },
            success : function (response) {
                tabelDetail.row.add([
                    response.tanggal,
                    response.nomor_kas_bank,
                    formatRupiah(response.pengeluaran) + ',00',
                    response.akun,
                    response.nama_perusahaan
                ]).draw();
            }
        })
    }

    function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split           = number_string.split(','),
            sisa             = split[0].length % 3,
            rupiah             = split[0].substr(0, sisa),
            ribuan             = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka satuan ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
</script>
