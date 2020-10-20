
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
              <li class="breadcrumb-item"><a href="{site_url}pajak/create">Anggaran Pendapatan</a></li>
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
            <h3 class="card-title">{title} Anggaran Pendapatan</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

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
							<select class="form-control" name="thnanggaran" required>
								<?php for ($i = 2020; $i > 2015; $i--) { ?>
									<option value="<?= $i ?>"><?= $i ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label>Tgl Pengajuan :</label>
							<input type="date" class="form-control" name="tglpengajuan" required></select>
						</div>

					</div>
				</div>
			</form>
			<div class="row">
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
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">          
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

<script type="text/javascript">

	var base_url = '{site_url}anggaran_pendapatan/';
	$(document).ready(function() {
		ajax_select({
			id: '#perusahaan',
			url: base_url + 'select2_mperusahaan',
		});

		$('#perusahaan').change(function(e) {
			var perusahaanId = $('#perusahaan').children('option:selected').val();
			var num = perusahaanId.toString().padStart(3, "0")
			$('#corpCode').val(num);
			ajax_select({
				id: '#department',
				url: base_url + 'select2_mdepartemen/' + perusahaanId,
			});
		})

		$('#department').change(function(e) {
			var deptName = $('#department').children('option:selected').text();
			var deptId = $('#department').children('option:selected').val()
			var num = deptId.toString().padStart(3, "0")
			$('#deptCode').val(num);
			ajax_select({
				id: '#pejabat',
				url: base_url + 'select2_mdepartemen_pejabat/' + deptName,
			});
		})

		getListRekening();
	})

	function getListRekening() {
		var table = $('#list_rekening');
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
						const html = `
							<tr>
								<td><input type="checkbox" name="" data-name="${element.namaakun}" kode-rekening="${element.akunno}" id="" onchange="addRekening(this)"></td>
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
				<td><input type="text" class="form-control" onkeyup="sum();" name="volume" id="volume"></td>
				<td>
					<select type="text" class="form-control" name="satuan">
						<option>buah</option>
						<option>pak</option>
					</select>
				</td>
				<td><input type="text" class="form-control" name="uraian" onkeyup="sum();" onkeypress="return isNumberKey(event)" id="harga"></td>
				<td><input type="text" class="form-control" name="tarif" id="jumlah" onkeyup="sum();" onkeypress="return isNumberKey(event)" readonly ></td>
				<td><input type="text" class="form-control" name="keterangan"></td>
			</tr>
			`;
		$(html).insertAfter(tr);

	}
	
	function sum() {
        var txtFirstNumberValue                 = document.getElementById('volume').value;
        var txtSecondNumberValue                = document.getElementById('harga').value.replace(/[^,\d]/g, '').toString();
        console.log(typeof document.getElementById('harga').value);
        if (!isNaN(parseInt(txtSecondNumberValue))){
            // console.log(txtSecondNumberValue);
            document.getElementById('harga').value  = formatRupiah(txtSecondNumberValue, 'Rp.');
        }
        var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
        if (!isNaN(result)) {
            document.getElementById('jumlah').value = formatRupiah(String(result), 'Rp.')+',00';;
        }
        else{
            document.getElementById('jumlah').value = formatRupiah('0', 'Rp.')+',00';
        }
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
					swal("Berhasil!", "Berhasil Menambah Data!", "success");
					ajax_item();
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