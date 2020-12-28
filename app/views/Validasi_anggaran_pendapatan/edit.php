<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-info22 mr-2"></i> <span class="font-weight-semibold">{title}</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <div class="card">
        <div class="card-header {bg_header}">
            <div class="header-elements-inline">
                <h5 class="card-title">{subtitle}</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <form action="javascript:save()" id="form1">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo lang('Nama Perusahaan') ?>:</label>
                                    <select id="perusahaan" class="form-control" name="idperusahaan" disabled></select>
                                </div>
                                <div class="form-group">
                                    <label><?php echo lang('Nama Department') ?>:</label>
                                    <select id="department" class="form-control" name="dept" disabled></select>
                                </div>
                                <div class="form-group">
                                    <label><?php echo lang('PIC') ?>:</label>
                                    <select id="pejabat" class="form-control" name="pejabat" disabled></select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tahun Anggaran :</label>
                                    <select id="thnanggaran" class="form-control" name="thnanggaran" disabled>
                                        <?php for ($i = 2020; $i > 2015; $i--) { ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tgl Pengajuan :</label>
                                    <input id="tglpengajuan" type="date" class="form-control" name="tglpengajuan" disabled></select>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-sm-12">
                        <br>
                        <div style="overflow-x:scroll; width:100%">
                            <table class="table" style="white-space: nowrap; width: 1500px" id="rekening">
                                <thead class="{bg_header}">
                                    <tr>
                                        <th class="text-center"><?php echo lang('action') ?></th>
                                        <th class="text-center">Kode Rekening</th>
                                        <th class="text-center">Uraian</th>
                                        <th class="text-center">Volume</th>
                                        <th class="text-center">Satuan</th>
                                        <th class="text-center">Tarif</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Realisasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-light">
                                        <td></td>
                                        <td>4</td>
                                        <td>PENDAPATAN - LRA</td>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td></td>
                                        <td>4.1</td>
                                        <td>PENDAPATAN ASLI DAERAH</td>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td></td>
                                        <td>4.1.4</td>
                                        <td>Lain lain Pendapatan Asli Daerah</td>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td></td>
                                        <td>4.1.4.16</td>
                                        <td>Pendapatan dari Badan Layanan Umum Daerah</td>
                                        <td colspan="5"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <br>
                        <div class="text-right">
                            <a href="{site_url}validasi_anggaran_pendapatan" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                            <?php if ($status != 'Validate') { ?>

                                <button type="submit" class="btn bg-success" form="form1" onclick="!this.form && document.getElementById('myform').submit()"><?php echo lang('Validate') ?></button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script type="text/javascript">
    var base_url = '{site_url}validasi_anggaran_pendapatan/';
    var RekTitle = [];
    var RekItem;
    $(document).ready(function() {
        ajax_select({
            id: '#perusahaan',
            url: base_url + 'select2_mperusahaan',
            selected: {
                id: '{idperusahaan}'
            }
        });
        console.log('{dept}');
        $('#perusahaan').change(function(e) {
            var perusahaanId = $('#perusahaan').children('option:selected').val();
            ajax_select({
                id: '#department',
                url: base_url + 'select2_mdepartemen/' + perusahaanId,
                selected: {
                    id: "{dept}"
                }
            });
        })

        $('#department').change(function(e) {
            var deptName = $('#department').children('option:selected').text();
            ajax_select({
                id: '#pejabat',
                url: base_url + 'select2_mdepartemen_pejabat/' + deptName,
                selected: {
                    id: "{pejabat}"
                }
            });
        })

        $('#thnanggaran').val("{thnanggaran}");
        $('#tglpengajuan').val("{tglpengajuan}");


        get_rekitem();
    })

    function getListRekening() {
        var table = $('#list_rekening');
        var temp;
        $.ajax({
            type: "get",
            url: base_url + 'get_rekeningpendapatan',
            success: function(response) {
                for (let i = 0; i < response.length; i++) {
                    const element = response[i];
                    if (i < 4) {
                        const html = `
							<tr class="bg-light">
								<td><input type="checkbox" name="" id=""  disabled></td>
								<td>${element.koderekening}</td>
								<td>${element.namarekening}</td>
							</tr>
						`;
                        table.append(html);
                    } else {
                        let checked = '';
                        if (RekTitle.includes(element.koderekening)) {
                            checked = 'checked';
                            const table = $('#rekening');

                            const html = `
                                        <tr class="bg-light item-title" kode="${element.koderekening}">
                                            <td>
                                                
                                            </td>
                                            <td>${element.koderekening}</td>
                                            <td>${element.namarekening}</td>
                                            <td colspan="5"></td>
                                        </tr>
                                    `;
                            table.append(html);
                            for (let i = 0; i < RekItem.length; i++) {
                                const item = RekItem[i];
                                if (element.koderekening == item.koderekening) {
                                    let buah, pak;
                                    (item.satuan == 'buah') ? buah = 'selected': pak = 'selected';
                                    const html = `
                                    <tr class="rek-items" kode="${item.koderekening}">
                                        <td>
                                            
                                        </td>
                                        <td>${item.koderekening}</td>
                                        <td><input disabled type="text" class="form-control" name="uraian" value="${item.uraian}"></td>
                                        <td><input disabled type="text" class="form-control" name="volume" value="${item.volume}"></td>
                                        <td>
                                            <select disabled type="text" class="form-control" name="satuan">
                                                <option value="buah" ${buah}>buah</option>
                                                <option value="pak" ${pak}>pak</option>
                                            </select>
                                        </td>
                                        <td><input disabled type="text" class="form-control" name="uraian" value="${item.tarif}"></td>
                                        <td><input disabled type="text" class="form-control" name="tarif" value="${item.jumlah}"></td>
                                        <td><input disabled type="text" class="form-control" name="keterangan" value="${item.keterangan}"></td>
                                    </tr>
                                    `;
                                    table.append(html);
                                }
                            }
                        }
                        const html = `
							<tr>
								<td><input type="checkbox" name="" ${checked} data-name="${element.namarekening}" kode-rekening="${element.koderekening}" id="" onchange="addRekening(this)"></td>
								<td>${element.koderekening}</td>
								<td>${element.namarekening}</td>
							</tr>
						`;
                        table.append(html);
                    }
                }
            }
        });
    }


    function get_rekitem() {
        $.ajax({
            type: "get",
            url: base_url + 'get_rekitem/{id}',
            success: function(response) {
                RekItem = response;
                console.log(response);
                var temp;
                for (let i = 0; i < response.length; i++) {
                    const element = response[i];
                    if (i == 0) {
                        RekTitle.push(element.koderekening);
                        temp = element.koderekening;
                        continue;
                    }
                    if (temp != element.koderekening) {
                        RekTitle.push(element.koderekening);
                        temp = element.koderekening;
                    }
                }
                getListRekening();
            }
        });
    }

    function save() {
        $.ajax({
            type: "get",
            url: base_url + 'save/{id}',
            success: function(response) {
                if (response.status == 'success') {
                    NotifySuccess(response.message)
                    redirect(base_url);
                } else {
                    NotifyError(response.message)
                }
            },
            error: function() {
                NotifyError('<?php echo lang('internal_server_error') ?>');
            }
        });
    }
</script>