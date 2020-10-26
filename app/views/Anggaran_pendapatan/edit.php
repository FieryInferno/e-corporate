
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
                <li class="breadcrumb-item"><a href="{site_url}anggaran_pendapatan/create">Anggaran Pendapatan</a></li>
                <li class="breadcrumb-item active">{title}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card">
        <div class="card-header">
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
                    <div class="col-sm-12">
                        <div class="text-left">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                + Pilih Rekening
                            </button>
                        </div>
                        <br>
                        <div style="overflow-x:scroll; width:100%">
                            <table class="table" style="white-space: nowrap; width: 1500px" id="rekening">
                                <thead>
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
                                <tbody></tbody>
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
</form>
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
                    <thead>
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

<script type="text/javascript">
    var base_url = '{site_url}anggaran_pendapatan/';
    var RekTitle = [];
    var RekItem;
    $(document).ready(function() {
        ajax_select({
            id: '#perusahaan',
            url: base_url + 'select2_mperusahaan',
            selected: {
                id: '{idPerusahaan}'
            }
        });
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

    function getListRekening(a) {
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
                        console.log(RekTitle);
                        let checked = '';
                        if (RekTitle.includes(element.idakun)) {
                            checked = 'checked';
                            const table = $('#rekening');
                            const html = `
                                        <tr class="bg-light item-title" kode="${element.akunno}">
                                            <td  id="a${i}">
                                                <button type="button" class="btn btn-primary" onclick="addItem(this, ${i}, 0)">+</button>
                                            </td>
                                            <td>${element.akunno}</td>
                                            <td>${element.namaakun}</td>
                                            <td colspan="5"></td>
                                        </tr>
                                    `;
                            table.append(html);
                            for (let j = 0; j < RekItem.length; j++) {
                                const item = RekItem[j];
                                if (element.idakun == item.koderekening) {
                                    let buah, pak;
                                    (item.satuan == 'buah') ? buah = 'selected': pak = 'selected';
                                    const html = `
                                    <tr class="rek-items" kode="${element.akunno}">
                                        <td>
                                            <button type="button" class="btn btn-danger" onclick="removeItem(this)">-</button>
                                        </td>
                                        <td>
                                            <input type="hidden" name="kode_rekening[]" id="kode_rekening${i}${j}${i}${j}" value="${item.koderekening}">
                                            ${element.akunno}
                                        </td>
                                        <td><input type="text" class="form-control" name="uraian[]" value="${item.uraian}"></td>
                                        <td><input type="text" class="form-control" name="volume[]" id="volume${i}${j}${i}${j}" onkeyup="sum('${i}${j}${i}${j}');" value="${item.volume}"></td>
                                        <td>
                                            <select type="text" class="form-control" name="satuan">
                                                <option value="buah" ${buah}>buah</option>
                                                <option value="pak" ${pak}>pak</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" name="harga[]" id="harga${i}${j}${i}${j}" onkeyup="sum('${i}${j}${i}${j}');" value="${formatRupiah(String(item.tarif))}"></td>
                                        <td><input type="text" class="form-control" name="jumlah[]" id="jumlah${i}${j}${i}${j}" readonly onkeyup="sum('${i}${j}${i}${j}');" value="${formatRupiah(String(item.jumlah))}"></td>
                                        <td><input type="text" class="form-control" name="keterangan" value="${item.keterangan}"></td>
                                    </tr>
                                    `;
                                    table.append(html);
                                }
                            }
                        }

                        const html = `
							<tr>
								<td><input type="checkbox" name="" data-name="${element.namaakun}" kode-rekening="${element.akunno}" id="" onchange="addRekening(this, ${i})" idRekening="${element.idakun}" ${checked}></td>
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


    function sum(no) {
        var txtFirstNumberValue                 = document.getElementById('volume' + no).value;
        var txtSecondNumberValue                = document.getElementById('harga' + no).value.replace(/[^,\d]/g, '').toString();
        console.log(typeof document.getElementById('harga' + no).value);
        if (!isNaN(parseInt(txtSecondNumberValue))){
            // console.log(txtSecondNumberValue);
            document.getElementById('harga' + no).value  = formatRupiah(txtSecondNumberValue);
        }
        var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
        if (!isNaN(result)) {
            document.getElementById('jumlah' + no).value = formatRupiah(String(result))+',00';;
        }
        else{
            document.getElementById('jumlah' + no).value = formatRupiah('0')+',00';
        }
    }

        function isNumberKey(evt)
        {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
        return true;
        }

    function addRekening(elem, no) {
		const kodeRekening 	= $(elem).attr('kode-rekening');
		const namaRekening 	= $(elem).attr('data-name');
		const stat			= $(elem).is(":checked");
		const table			= $('#rekening');
		const idRekening	= $(elem).attr('idRekening');
		if (stat) {
			const html = `
				<tr class="bg-light item-title" kode="${kodeRekening}" idRekening="${idRekening}">
					<td id="a${no}">
						<button type="button" class="btn btn-primary" onclick="addItem(this, ${no}, 0)">+</button>
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

    function addItem(elem, no, no2) {
		const td			= $(elem).parents('td');
		const tr			= $(elem).parents('tr');
		const kodeRekening	= $(tr).attr('kode');
		const idRekening	= $(tr).attr('idRekening');
		var no3				= no2 + 1;
		const html = `
			<tr class="rek-items" kode="${kodeRekening}">
				<td>
					<button type="button" class="btn btn-danger" onclick="removeItem(this)">-</button>
				</td>
				<td>
					<input type="hidden" name="kode_rekening[]" id="kode_rekening`+no+no2+`" value="${idRekening}">
					${kodeRekening}
				</td>
				<td><input type="text" class="form-control" name="uraian[]"></td>
				<td><input type="text" class="form-control" onkeyup="sum('${no}${no2}');" name="volume[]" id="volume${no}${no2}"></td>
				<td>
					<select type="text" class="form-control" name="satuan[]">
						<option>buah</option>
						<option>pak</option>
					</select>
				</td>
				<td><input type="text" class="form-control" name="harga[]" onkeyup="sum('${no}${no2}');" onkeypress="return isNumberKey(event)" id="harga${no}${no2}"></td>
				<td><input type="text" class="form-control" name="jumlah[]" id="jumlah${no}${no2}" onkeyup="sum('${no}${no2}');" onkeypress="return isNumberKey(event)" readonly ></td>
				<td><input type="text" class="form-control" name="keterangan"></td>
			</tr>
			`;
		$(html).insertAfter(tr);
		$('#a'+no).html(`<button type="button" class="btn btn-primary" onclick="addItem(this,`+no+`,`+no3+`)">+</button>`);
	}

    function get_rekitem() {
        $.ajax({
            type: "get",
            url: base_url + 'get_rekitem/{id}',
            success: function(response) {
                RekItem = response;
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
                    swal("Berhasil!", "Berhasil Menambah Data!", "success");
					redirect(base_url);
                } else {
                    swal("Gagal!", "Gagal Menambah Data!", "error");
                }
            },
            error: function() {
                swal("Gagal!", "Internal Server Error!", "error");
            }
        })
    }
</script>