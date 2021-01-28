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
            <li class="breadcrumb-item"><a href="<?= base_url('anggaran_belanja'); ?>">Anggaran Belanja</a></li>
            <li class="breadcrumb-item active"><? $title; ?></li>
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
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><?= $title; ?></h3>
            </div>
            <form id="form1" action="javascript:save()">
              <div class="card-body">
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
                      <label><?php echo lang('PIC') ?>:</label>
                      <select id="pejabat" class="form-control" name="pejabat" required></select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tahun Anggaran :</label>
                      <select class="form-control" name="thnanggaran" required>
                        <?php for ($i = 2020; $i > 2015; $i--) { ?>
                          <option value="<?= $i ?>"><?= $i ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Tgl Pengajuan :</label>
                        <input type="hidden" name="idAnggaranBelanja" value="{id}">
                        <input type="date" class="form-control" name="tglpengajuan" required value="{tglpengajuan}"></select>
                      </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="text-left">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                      + Pilih Rekening
                    </button>
                  </div>
                  <br>
                  <div style="overflow-x:scroll; width:100%">
                    <div class="table-responsive">
                      <table class="table table-xs table-striped table-borderless table-hover" id="rekening">
                        <thead>
                          <tr class="table-active">
                            <th class="text-center"><?php echo lang('action') ?></th>
                            <th class="text-center">Kode Rekening</th>
                            <th class="text-center">Uraian</th>
                            <th class="text-center">Cabang</th>
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
                </div>
              </div>
              <div class="card-footer">
                <div class="text-left">
                  <div class="btn-group">
                    <a href="{site_url}anggaran_belanja" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                    <button type="submit" class="btn bg-success" form="form1" onclick="!this.form && document.getElementById('myform').submit()"><?php echo lang('save') ?></button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- /.content-wrapper -->

<!-- Start: Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Pilih Rekening</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
          <table class="table table-xs table-striped table-borderless table-hover index_datatable" id="listRekening">
            <thead>
              <tr class="table-active">
                <th>&nbsp;</th>
                <th>Kode Rekening</th>
                <th>Nama Rekening</th>
              </tr>
            </thead>
            <tbody id='list_rekening'></tbody>
          </table>
      </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	let base_url  = '{site_url}anggaran_belanja/';
	let RekTitle  = [];
  let RekItem;
  let tableRekening = $('#listRekening').DataTable();

	$(document).ready(function() {
		ajax_select({
			id			: '#perusahaan',	
			url			: '{site_url}perusahaan/select2',
			selected	: {
				id	: '{idperusahaan}'
			}
		});			
		// ajax_select({ id: '#satuan', url: base_url + 'select2_satuan', selected: { id: '' } });		
		$('#perusahaan').change(function(e) {
			var perusahaanId = $('#perusahaan').children('option:selected').val();
			var num = perusahaanId.toString().padStart(3, "0")
			$('#corpCode').val(num);
			ajax_select({
				id: '#department',
				url: base_url + 'select2_mdepartemen/' + perusahaanId,
				selected	: {
					id	: '{dept}'
				}
			});
		})

		$('#department').change(function(e) {
			var deptName  = $('#department').children('option:selected').text();
			var deptId    = $('#department').children('option:selected').val()
			var num = deptId.toString().padStart(3, "0")
			$('#deptCode').val(num);
			ajax_select({
				id			  : '#pejabat',
				url			  : base_url + 'select2_mdepartemen_pejabat/' + deptId,
				selected	: {
					id	: '{pejabat}'
				}
			});
		})

		get_rekitem();
	})

	function get_rekitem() {
    $.ajax({
      type    : "get",
      url     : base_url + 'get_rekitem/{id}',
      success : function(response) {
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

	function getListRekening(a) {
    var temp;
    $.ajax({
      type    : "get",
      url     : base_url + 'get_rekeningbelanja',
      success : function(response) {
        for (let i = 0; i < response.length; i++) {
          const element = response[i];
          if (i < 0) {
            tableRekening.row.add([
              `<input type="checkbox" name="" id=""  disabled>`,
              element.akunno,
              element.namaakun
            ]).draw();
          } else {
            let checked = '';
            if (RekTitle.includes(element.idakun)) {
              checked     = 'checked';
              const table = $('#rekening');
              const html  = `
                <tr class="bg-light item-title" kode="${element.akunno}">
                    <td  id="a${i}">
                        <button type="button" class="btn btn-primary" onclick="addItem(this, ${i}, 0)">+</button>
                    </td>
                    <td>${element.akunno}</td>
                    <td>${element.namaakun}</td>
                    <td colspan="5"></td>
                </tr>`;
              table.append(html);
              for (let j = 0; j < RekItem.length; j++) {
                const item = RekItem[j];
                if (element.idakun == item.koderekening) {
                  let buah, pak;
                  (item.satuan == 'buah') ? buah = 'selected': pak = 'selected';
                  const html = `
                    <tr class="rek-items" kode="${element.akunno}">
                      <td><button type="button" class="btn btn-danger" onclick="removeItem(this)">-</button></td>
                      <td><input type="hidden" name="kode_rekening[]" id="kode_rekening${i}${j}${i}${j}" value="${item.koderekening}">${element.akunno}</td>
                      <td><select class="form-control uraian" id="uraian${i}${j}${i}${j}" name="uraian[]" required style="width: 100%"></select></td>
                      <td><select name="cabang[]" id="cabang${i}${j}${i}${j}" class="form-control" style="width: 100%"></select></td>
                      <td><input type="text" class="form-control" name="volume[]" id="volume${i}${j}${i}${j}" onkeyup="sum('${i}${j}${i}${j}');" value="${item.volume}"></td>
                      <td>
                          <select type="text" class="form-control" name="satuan[]">
                              <option value="buah" ${buah}>buah</option>
                              <option value="pak" ${pak}>pak</option>
                          </select>
                      </td>
                      <td><input type="text" class="form-control" name="tarif[]" id="harga${i}${j}${i}${j}" onkeyup="sum('${i}${j}${i}${j}');" value="${formatRupiah(String(item.tarif))}"></td>
                      <td><input type="text" class="form-control" name="jumlah[]" id="jumlah${i}${j}${i}${j}" readonly onkeyup="sum('${i}${j}${i}${j}');" value="${formatRupiah(String(item.jumlah))}"></td>
                      <td><input type="text" class="form-control" name="keterangan[]" value="${item.keterangan}"></td>
                    </tr>`;
                  table.append(html);
                  ajax_select({
                    id	        : `#cabang${i}${j}${i}${j}`,
                    url	        : `{site_url}cabang/select2/{idperusahaan}`,
                    selected    : {
                        id  : item.cabang
                    }
                  });
									ajax_select({
                    id	        : `#uraian${i}${j}${i}${j}`,
                    url	        : `{site_url}anggaran_belanja/select_uraian`,
                    selected    : {
                        id  : item.uraian
                    }
                  });
                }
              }
            }

            tableRekening.row.add([
              `<input type="checkbox" name="" data-name="${element.namaakun}" kode-rekening="${element.akunno}" id="" onchange="addRekening(this, ${i})" idRekening="${element.idakun}" ${checked}>`,
              element.akunno,
              element.namaakun
            ]).draw();
          }
        }
      }
    });
  }

	function addRekening(elem, no) {
		const kodeRekening 	= $(elem).attr('kode-rekening');
		const namaRekening 	= $(elem).attr('data-name');
		const stat			= $(elem).is(":checked");
		const table			= $('#rekening');
		const idRekening 	= $(elem).attr('idRekening');
		// var no1				= 0;		
		if (stat) {
			const html = `
				<tr class="bg-light item-title" kode="${kodeRekening}" idRekening="${idRekening}">
					<td id="a${no}">
						<button type="button" class="btn btn-primary" onclick="addItem(this,`+no+`,`+0+`)">+</button>
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
	}


	function addItem(elem, no, no2) {
		const td 			= $(elem).parents('td');
		const tr 			= $(elem).parents('tr');
		const kodeRekening 	= $(tr).attr('kode');
		const idRekening 	= $(tr).attr('idRekening');
		var no3				= no2 + 1;
		const html 			= `
			<tr class="rek-items" kode="${kodeRekening}">
				<td>
					<button type="button" class="btn btn-danger" onclick="removeItem(this)">-</button>
				</td>
				<td>
					<input type="hidden" name="kode_rekening[]" id="kode_rekening`+no+no2+`" value="${idRekening}">
					${kodeRekening}
				</td>			
				<td>
					<select class="form-control uraian" id="uraian" name="uraian[]" required>
						<?php 
							foreach($uraian as $row)
							{ 
								echo '<option value="'.$row->id.'">'.$row->nama.'</option>';
							}
						?>
					</select>
				</td>
				<td>
					<select name="cabang[]" id="cabang${no}${no2}" class="form-control" style="width: 100%;"></select>
				</td>
				<td>
					<input type="text" class="form-control" onkeyup="sum('`+no+no2+`');" name="volume[]" id="volume`+no+no2+`">
				</td>
				<td>
					<select class="form-control satuan" name="satuan[]" required>
						<?php 
							foreach($satuan as $row)
							{ 
								echo '<option value="'.$row->nama.'">'.$row->nama.'</option>';
							}
						?>
					</select>
				</td>
				<td>
					<input type="text" class="form-control"onkeyup="sum('`+no+no2+`');" name="tarif[]" id="harga`+no+no2+`">
				</td>
				<td>
					<input type="hidden" class="form-control"onkeyup="sum('`+no+no2+`');" name="jumlah[]" readonly id="jumlah`+no+no2+`">
					<input type="text" class="form-control"onkeyup="sum('`+no+no2+`');" readonly id="lihat`+no+no2+`">
				</td>
				<td>
					<input type="text" class="form-control" name="keterangan[]">
				</td>
			</tr>
			`;
		$(html).insertAfter(tr);
		$('#a'+no).html(`<button type="button" class="btn btn-primary" onclick="addItem(this,`+no+`,`+no3+`)">+</button>`);
		ajax_select({
			id	: `#cabang${no}${no2}`,
			url	: '{site_url}cabang/select2',
		});
    }
    
	function sum(no) {
        // angka.,	
        var txtFirstNumberValue                     = document.getElementById('volume'+no).value;
        var txtSecondNumberValue                    = document.getElementById('harga'+no).value.replace(/[^,\d]/g, '').toString();
        console.log(txtSecondNumberValue);
		var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
		if (!isNaN(result)) {
			document.getElementById('jumlah'+no).value = result;
			document.getElementById('lihat'+no).value = formatRupiah(String(result))+',00';
		}
		else if(txtFirstNumberValue !=null && txtSecondNumberValue == null){
			document.getElementById('jumlah'+no).value = txtFirstNumberValue;
		}else{
		document.getElementById('jumlah'+no).value = txtSecondNumberValue;
		document.getElementById('lihat'+no).value = formatRupiah(String(txtSecondNumberValue))+',00';
        }
        document.getElementById('harga'+no).value   = formatRupiah(txtSecondNumberValue);
	}
        function isNumberKey(evt)
        {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
        return true;
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
					uraian: $(select[0]).val(),
					volume: $(input[0]).val(),
					satuan: $(select[1]).val(),
					tarif: $(input[1]).val(),
					jumlah: $(input[2]).val(),
					keterangan: $(input[3]).val()
				});
			}
		}
		$.ajax({
			type: "post",
			url: base_url + 'add_rekeningitem',
			data: {
				'items': data

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
			success: function(response) {
				if (response.status == 'success') {
					swal("Berhasil!", "Berhasil Menambah Data", "success");
					// ajax_item();
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
</script>