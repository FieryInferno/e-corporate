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
                <div class="col-md-12">
                    <form action="javascript:save()" id="formSaldoAwal">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Saldo Awal Neraca</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nomor :</label>
                                            <input type="text" class="form-control" placeholder="(Auto)" name="nomor" readonly>
                                        </div>
                                    </div>
									<div class="col-6">
										<div class="form-group">
                                            <label></label>
                                            <div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked>
												<label class="form-check-label" for="defaultCheck1">
													Penomoran Otomatis
												</label>
											</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
									<div class="col-6">
                                        <div class="form-group">
                                            <label>Tanggal :</label>
                                            <input type="date" class="form-control" placeholder="Tanggal" name="tanggal" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Perusahaan :</label>
                                            <?php
                                                if ($this->session->userid !== '1') { ?>
                                                    <input type="hidden" name="perusahaan" value="<?= $this->session->idperusahaan; ?>">
                                                    <input type="text" class="form-control" value="<?= $this->session->perusahaan; ?>" disabled>
                                                <?php } else { ?>
                                                    <select class="form-control perusahaan" name="perusahaan" style="width: 100%;" id="perusahaan"></select>
                                                <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Keterangan :</label>
                                            <input type="text" class="form-control" placeholder="Keterangan" name="keterangan" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Rincian Saldo Awal</h3>
                            </div>
							<div class="card-header">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
								+ Tambah Akun
							</button>

							<!-- Modal -->
							<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Pilih Akun</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
                                        <table class="table table-striped table-borderless table-hover" id="tabelNoAkun">
                                            <thead>
                                                <tr class="table-active">
                                                    <th scope="col">#</th>
                                                    <th scope="col">Kode Akun</th>
                                                    <th scope="col">Nama akun</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
									</div>
									</div>
								</div>
							</div>
                            </div>
                            <div class="card-body">
								<div class="row">
									<div class="col-12">
                                        <table class="table table-striped table-borderless table-hover" id="tabelRincian">
                                            <thead>
                                                <tr class="table-active">
                                                    <th scope="col" width="30%">Kode Akun</th>
                                                    <th scope="col" width="30%">Nama akun</th>
                                                    <th scope="col" width="20%" class="text-center">Debit</th>
													<th scope="col" width="20%" class="text-center">Kredit</th>
                                                </tr>
                                            </thead>
                                            <tbody id="rincianAkun"></tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2" class="text-right">Total :</th>
                                                    <th class="text-right" id="totalDebit">Rp. 0,00</th>
                                                    <th class="text-right" id="totalKredit">Rp. 0,00</th>
                                                </tr>
                                            </tfoot>
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
<script>
    base_url    = '{site_url}saldo_awal/';
	$(document).ready(function() {
        if ('<?= $this->session->userid; ?>' == 1) {
            var idPerusahaan    = null; 
        } else {
            var idperusahaan    = '<?= $this->session->perusahaan; ?>';
            $('#perusahaan').attr('readonly'); 
        }
        ajax_select({
            id			: '#perusahaan',
            url			: '{site_url}perusahaan/select2',
            selected	: {
                id	: idPerusahaan
            }
        });
    })

    var table = $('#tabelNoAkun').DataTable({
		ajax: {
			url     : '{site_url}noakun/index_datatable/123',
			type    : 'post',
		},
		stateSave: true,
		autoWidth: false,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"p>',
        language: {
            search: '<span></span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
        },
        columns: [
            {
                data    : 'idakun',
                render  : function(data,type,row) {
                    return `
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" onchange="tambahAkun(this)" idAkun="${data}" noAkun="${row.akunno}" namaAkun="${row.namaakun}">
                        </div>`;
                }
            },
            {data: 'akunno'},
            {data: 'namaakun'},
        ]
	});

    function tambahAkun(elemen) {
        var idAkun      = $(elemen).attr('idAkun');
        var noAkun      = $(elemen).attr('noAkun');
        var namaAkun    = $(elemen).attr('namaAkun');
        var status      = $(elemen).is(':checked');
        if (status) {
            $('#rincianAkun').append(
                `<tr idAkun="${idAkun}">
                    <td>
                        <input type="hidden" value="${idAkun}" name="idAkun[]">
                        ${noAkun}
                    </td>
                    <td>${namaAkun}</td>
                    <td>
                        <input type="text" name="debit[]" onkeyup="nilai(this), hitung('debit')" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="kredit[]" onkeyup="nilai(this), hitung('kredit')" class="form-control">
                    </td>
                </tr>`
            )
        } else {
            $(`tr[idAkun = ${idAkun}]`).remove();
        }
    }

    function nilai(elemen) {
        var nilai   = $(elemen).val();
        $(elemen).val(formatRupiah(String(nilai), 'Rp. '));
    }

    function hitung(jenis) {
        switch (jenis) {
            case 'debit':
                data    = new FormData($('#formSaldoAwal')[0]);
                data0   = data.getAll('debit[]');
                data1   = 0;
                data0.forEach(element => {
                    data1   += element.replace(/[^,\d]/g, '')*1;
                });
                $('#totalDebit').html(formatRupiah(String(data1), 'Rp. ') + ',00');
                break;
            case 'kredit':
                data    = new FormData($('#formSaldoAwal')[0]);
                data0   = data.getAll('kredit[]');
                data1   = 0;
                data0.forEach(element => {
                    data1   += element.replace(/[^,\d]/g, '')*1;
                });
                $('#totalKredit').html(formatRupiah(String(data1), 'Rp. ') + ',00');
                break;
        
            default:
                break;
        }
    }

    function save() {
        var form        = $('#formSaldoAwal')[0];
        var formData    = new FormData(form);
        var totalDebit  = $('#totalDebit').html();
        var totalKredit = $('#totalKredit').html();
        if(totalDebit !== totalKredit) {
            swal("Gagal!", "Angka Debit dan Kredit Tidak Sama", "error");
        } else {
            $.ajax({
                url: base_url + 'save',
                dataType: 'json',
                method: 'post',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    pageBlock();
                },
                afterSend: function() {
                    unpageBlock();
                },
                success: function(data) {
                    if(data.status == 'success') {
                        swal("Berhasil!", "Berhasil Menambah Data", "success");
                        redirect(base_url);
                    } else {
                        swal("Gagal!", "Gagal Menambah Data", "error");
                    }
                },
                error: function() {
                    swal("Gagal!", "Internal Server Error", "error");
                }
            })
        }
    }
</script>