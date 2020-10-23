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
                                    <select id="perusahaan" class="form-control" name="idperusahaan" required></select>
                                </div>
                                <div class="form-group">
                                    <label><?php echo lang('Nama Department') ?>:</label>
                                    <select id="department" class="form-control" name="dept" required></select>
                                </div>
                                <div class="form-group">
                                    <label><?php echo lang('Pejabat') ?>:</label>
                                    <select id="pejabat" class="form-control" name="pejabat" required></select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tahun Anggaran :</label>
                                    <select id="thnanggaran" class="form-control" name="thnanggaran" required>
                                        <?php for ($i = 2020; $i > 2015; $i--) { ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tgl Pengajuan :</label>
                                    <input id="tglpengajuan" type="date" class="form-control" name="tglpengajuan" required></select>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-sm-12">
                        <div class="text-left">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                + Pilih Rekening
                            </button>
                        </div>
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
                                    <!--<tr class="bg-light">-->
                                    <!--    <td></td>-->
                                    <!--    <td>4</td>-->
                                    <!--    <td>PENDAPATAN - LRA</td>-->
                                    <!--    <td colspan="5"></td>-->
                                    <!--</tr>-->
                                    <!--<tr class="bg-light">-->
                                    <!--    <td></td>-->
                                    <!--    <td>4.1</td>-->
                                    <!--    <td>PENDAPATAN ASLI DAERAH</td>-->
                                    <!--    <td colspan="5"></td>-->
                                    <!--</tr>-->
                                    <!--<tr class="bg-light">-->
                                    <!--    <td></td>-->
                                    <!--    <td>4.1.4</td>-->
                                    <!--    <td>Lain lain Pendapatan Asli Daerah</td>-->
                                    <!--    <td colspan="5"></td>-->
                                    <!--</tr>-->
                                    <!--<tr class="bg-light">-->
                                    <!--    <td></td>-->
                                    <!--    <td>4.1.4.16</td>-->
                                    <!--    <td>Pendapatan dari Badan Layanan Umum Daerah</td>-->
                                    <!--    <td colspan="5"></td>-->
                                    <!--</tr>-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <br>
                        <div class="text-right">
                            <a href="{site_url}anggaran_pendapatan" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                            <button type="submit" class="btn bg-success" form="form1" onclick="!this.form && document.getElementById('myform').submit()"><?php echo lang('save') ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start: Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Rekening</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead class="{bg_header}">
                        <tr>
                            <th>&nbsp;</th>
                            <th>Kode Rekening</th>
                            <th>Nama Rekening</th>
                        </tr>
                    </thead>
                    <tbody id='list_rekening'>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>
<!-- End: Modal -->
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script type="text/javascript">
    var base_url = '{site_url}anggaran_pendapatan/';
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
                    if (i < 0) {
                        const html = `
							<tr class="bg-light">
								<td><input type="checkbox" name="" id=""  disabled></td>
								<td>${element.akunno}</td>
								<td>${element.namaakun}</td>
							</tr>
						`;
                        table.append(html);
                    } else {
                        let checked = '';
                        if (RekTitle.includes(element.akunno)) {
                            checked = 'checked';
                            const table = $('#rekening');

                            const html = `
                                        <tr class="bg-light item-title" kode="${element.akunno}">
                                            <td>
                                                <button type="button" class="btn btn-primary" onclick="addItem(this)">+</button>
                                            </td>
                                            <td>${element.akunno}</td>
                                            <td>${element.namaakun}</td>
                                            <td colspan="5"></td>
                                        </tr>
                                    `;
                            table.append(html);
                            for (let i = 0; i < RekItem.length; i++) {
                                const item = RekItem[i];
                                if (element.akunno == item.koderekening) {
                                    let buah, pak;
                                    (item.satuan == 'buah') ? buah = 'selected': pak = 'selected';
                                    const html = `
                                    <tr class="rek-items" kode="${item.koderekening}">
                                        <td>
                                            <button type="button" class="btn btn-danger" onclick="removeItem(this)">-</button>
                                        </td>
                                        <td>${item.koderekening}</td>
                                        <td><input type="text" class="form-control" name="uraian" value="${item.uraian}"></td>
                                        <td><input type="text" class="form-control" name="volume" id="volume" onkeyup="sum();" value="${item.volume}"></td>
                                        <td>
                                            <select type="text" class="form-control" name="satuan">
                                                <option value="buah" ${buah}>buah</option>
                                                <option value="pak" ${pak}>pak</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" name="uraian" id="harga" onkeyup="sum();" value="${item.tarif}"></td>
                                        <td><input type="text" class="form-control" name="tarif" id="jumlah" readonly onkeyup="sum();" value="${item.jumlah}"></td>
                                        <td><input type="text" class="form-control" name="keterangan" value="${item.keterangan}"></td>
                                    </tr>
                                    `;
                                    table.append(html);
                                }
                            }
                        }
                        const html = `
							<tr>
								<td><input type="checkbox" name="" ${checked} data-name="${element.namaakun}" kode-rekening="${element.akunno}" id="" onchange="addRekening(this)"></td>
								<td>${element.akunno}</td>
								<td>${element.namaakun}</td>
							</tr>
						`;
                        table.append(html);
                    }
                }
            }
        });
    }


    function sum() {
              var txtFirstNumberValue = document.getElementById('volume').value;
              var txtSecondNumberValue = document.getElementById('harga').value;
              var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
              if (!isNaN(result)) {
                 document.getElementById('jumlah').value = result;
              }
              else{
                 document.getElementById('jumlah').value = txtFirstNumberValue;
              }
        }
        function isNumberKey(evt)
        {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
        return true;
        }
    function addRekening(elem) {
        const kodeRekening = $(elem).attr('kode-rekening');
        const namaRekening = $(elem).attr('data-name');
        const stat = $(elem).is(":checked");
        const table = $('#rekening');
        if (stat) {
            const html = `
				<tr class="bg-light item-title" kode="${kodeRekening}">
					<td>
						<button type="button" class="btn btn-primary" onclick="addItem(this)">+</button>
					</td>
					<td>${kodeRekening}</td>
					<td>${namaRekening}</td>
					<td colspan="5"></td>
				</tr>
			`;
            table.append(html);
        } else {
            $(`tr[kode="${kodeRekening}"]`).remove();
        }
        console.log(stat);
    }

    function addItem(elem) {
        const td = $(elem).parents('td');
        const tr = $(elem).parents('tr');
        const kodeRekening = $(tr).attr('kode');
        console.log(tr.attr('kode'));
        const html = `
			<tr class="rek-items" kode="${kodeRekening}">
				<td>
					<button type="button" class="btn btn-danger" onclick="removeItem(this)">-</button>
				</td>
				<td>${kodeRekening}</td>
				<td><input type="text" class="form-control" name="uraian"></td>
				<td><input type="text" class="form-control" name="volume"></td>
				<td>
					<select type="text" class="form-control" name="satuan">
						<option>buah</option>
						<option>pak</option>
					</select>
				</td>
				<td><input type="text" class="form-control" name="uraian"></td>
				<td><input type="text" class="form-control" name="tarif"></td>
				<td><input type="text" class="form-control" name="keterangan"></td>
			</tr>
			`;
        $(html).insertAfter(tr);

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

    function removeItem(elem) {
        var td = $(elem).parents('td');
        var tr = $(elem).parents('tr');
        $(tr).remove();
    }

    function ajax_item() {
        let data = [];
        const itemHead = $(".item-title");
        for (let i = 0; i < itemHead.length; i++) {
            const element = $(itemHead[i]);
            const kodeHead = $(element).attr('kode');
            const items = $(`.rek-items[kode="${kodeHead}"]`);
            for (let x = 0; x < items.length; x++) {
                const item = $(items[x]);
                const input = item.find('input');
                const select = item.find('select');
                data.push({
                    koderekening: kodeHead,
                    uraian: $(input[0]).val(),
                    volume: $(input[1]).val(),
                    satuan: $(select[0]).val(),
                    tarif: $(input[2]).val(),
                    jumlah: $(input[3]).val(),
                    keterangan: $(input[4]).val()
                });
            }
        }
        console.log(data);
        $.ajax({
            type: "post",
            url: base_url + 'update_rekeningitem',
            data: {
                'items': data,
                'idanggaran': '{id}'
            },
            success: function(response) {
                redirect(base_url);
            }
        });
    }

    function save() {
        var form = $('#form1')[0];
        var formData = new FormData(form);
        $.ajax({
            url: base_url + 'save/{id}',
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
            success: function(response) {
                if (response.status == 'success') {
                    NotifySuccess(response.message)
                    ajax_item();
                } else {
                    NotifyError(response.message)
                }
            },
            error: function() {
                NotifyError('<?php echo lang('internal_server_error') ?>');
            }
        })
    }
</script>