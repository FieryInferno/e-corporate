
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
        <!-- SELECT2 EXAMPLE -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah {title}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="javascript:save()" id="form1">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label><?php echo lang('number') ?>:</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="nomor_kas_bank" id="nomor" placeholder="AUTO"readonly value="{kode_otomatis}">
                                </div>
                                <div class="col-md-6">
                                    <input type="checkbox" name="" id="penomoran_otomatis" style="margin-top: 5%" checked onclick="Fungsi_nomor_otomatis()"> <?php echo lang('automatic_numbering') ?>
                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo lang('date') ?>:</label>
                            <div class="input-group">
                                <input type="date" id="tanggal" class="form-control datepicker" name="tanggal" required value="{tanggal}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label><?php echo lang('company') ?>:</label>
                            <select id="id_perusahaan" class="form-control id_perusahaan" name="perusahaan" required></select>
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('Pejabat Keuangan') ?>:</label>    
                            <select id="pejabat" class="form-control" name="pejabat" required></select>
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('information') ?>:</label>
                            <textarea class="form-control" name="keterangan" rows="3"></textarea>
                        </div>
                        <input type="hidden" name="detail_array" id="detail_array">
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                          <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" role="tablist">
                              <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-rincian-buku-kas-umum-tab" data-toggle="pill" href="#rincian_buku_kas_umum" role="tab" aria-controls="custom-tabs-RBKU" aria-selected="true"><?php echo lang('Rincian Buku Kas Umum') ?></a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="custom-saldo-sumber-dana-tab" data-toggle="pill" href="#saldo_sumber_dana" role="tab" aria-controls="custom-tabs-SSD" aria-selected="false"><?php echo lang('Saldo Sumber Dana') ?></a>
                              </li>
                            </ul>
                          </div>
                          <div class="card-body">
                            <div class="tab-content">
                              <div class="tab-pane fade active show" id="rincian_buku_kas_umum" role="tabpanel" aria-labelledby="custom-tabs-rincian-buku-kas-umump-tab">
                                <div class="text-center">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Penjualan">Penjualan</button>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Pembelian">Pembelian</button>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#BudgetEvent">Budget Event</button>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#RewardSales">Reward Sales</button>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#SetorPajak">Setor Pajak</button>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#PengajuanKasKecil">Kas Kecil</button>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#SetorKasKecil">Stor Kas Kecil</button>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ReturJual">Retur Jual</button>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ReturBeli">Retur Beli</button>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Deposito">Deposito</button>
                                </div>

                                <div class="mb-3 mt-3 table-responsive">
                                   <table class="table table-bordered" id="table_detail_rincian_buku_kas_umum">
                                        <thead class="{bg_header}" id="atastabel">
                                             <tr><th><?php echo lang('ID') ?></th>
                                                <th><?php echo lang('') ?></th>
                                                <th><?php echo lang('Tipe') ?></th>
                                                <th><?php echo lang('date') ?></th>
                                                <th><?php echo lang('Nomor Aktivitas') ?></th>
                                                <th><?php echo lang('Penerimaan') ?></th>
                                                <th><?php echo lang('Pengeluaran') ?></th>
                                                <th><?php echo lang('Nomor Akun') ?></th>
                                                <th><?php echo lang('Kode Unit') ?></th>
                                                <th><?php echo lang('Nama Dapartemen') ?></th>
                                                <th><?php echo lang('Sumber Dana') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody id="isitabel"> 

                                        </tbody>
                                    </table>
                                </div>
                              </div>
                              <div class="tab-pane fade" id="saldo_sumber_dana" role="tabpanel" aria-labelledby="custom-saldo-sumber-dana-tab">
                                <div class="mb-3 mt-3 table-responsive">
                                    <table class="table table-bordered" id="table_detail_rincian_saldo_sumber_dana" width="100%">
                                        <thead class="{bg_header}" id="atastabel" >
                                            <tr><th><?php echo lang('ID') ?></th>
                                                <th><?php echo lang('Nama Rekening Bank') ?></th>
                                                <th><?php echo lang('Saldo Awal') ?></th>
                                                <th><?php echo lang('Penerimaan') ?></th>
                                                <th><?php echo lang('Pengeluaran') ?></th>
                                                <th><?php echo lang('Saldo Akhir') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody id="isitabel"> 
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td> ID</td>
                                                <td> Total</td>
                                                <td><div id="tot_saldo_awal"></div></td>
                                                <td><div id="tot_penerimaan"></div></td>
                                                <td><div id="tot_pengeluaran"></div></td>
                                                <td><div id="tot_saldo_akhir"></div></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                              </div>
                
                            </div>
                          </div>
                          <!-- /.card -->
                        </div>
                      </div>
                </div>
                        
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2 text-right" style="margin-top: 1%">Total Penerimaan</div>
                    <div class="col-md-3">
                        <input type="text" id="penerimaan" class="form-control decimalnumber text-right" name="penerimaan" readonly>
                    </div>
                    <div class="col-md-2 text-right" style="margin-top: 1%">Total Pengeluaran</div>
                    <div class="col-md-3">
                        <input type="text" id="pengeluaran" class="form-control decimalnumber text-right" name="pengeluaran" readonly>
                    </div>
                    <input type="hidden" id="pengeluaran_pemindahbukuan" class="form-control decimalnumber text-right" name="pengeluaran_pemindahbukuan" readonly>
                    <div class="col-md-3">
                      
                    </div>
                            
                </div>

                <br>
                <div class="text-right">
                    <div class="btn-group">
                        <a href="{site_url}Kas_bank" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                        &nbsp;<button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
                    </div>
                </div>
                
            </form>
          </div>
        </div>
      </div>
    </div>


<!-- Start: Modal Penjualan -->
<div class="modal fade" id="Penjualan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table" id="tabelpenjualan">
                    <thead class="{bg_header}">
                        <tr class="text-center">
                            <th>&nbsp;</th>
                            <th>Uang Muka</th>
                            <th>Termin</th>
                            <th>Nomor Faktur</th>
                            <th>Nama Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                            <th>Nama Rekening Bank</th>
                        </tr>
                    </thead>
                    <tbody id='list_penjualan'>

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

<!-- Start: Modal Pembelian -->
<div class="modal fade" id="Pembelian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Pembelian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table" id="tabelpembelian">
                    <thead class="{bg_header}">
                        <tr class="text-center">
                            <th>&nbsp;</th>
                            <th>Uang Muka</th>
                            <th>Termin</th>
                            <th>Nomor Faktur</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody id='list_pembelian'>

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

<!-- Start: Modal budget event -->
<div class="modal fade" id="BudgetEvent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Budget Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table" id="tabelbudgetevent">
                    <thead class="{bg_header}">
                        <tr>
                            <th>&nbsp;</th>
                            <th>Kode Kwitansi</th>
                            <th>Keterangan</th>
                            <th>Departemen</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody id='list_budgetevent'>

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

<!-- Start: Modal RewardSales -->
<div class="modal fade" id="RewardSales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Reward Sales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table" id="tabelrewardsales">
                    <thead class="{bg_header}">
                        <tr>
                            <th>&nbsp;</th>
                            <th>Kode Kwitansi</th>
                            <th>Keterangan</th>
                            <th>Departemen</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody id='list_rewardsales'>

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

<!-- Start: Modal SetorPajak -->
<div class="modal fade" id="SetorPajak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Setor Pajak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table" id="tabelsetorpajak">
                    <thead class="{bg_header}">
                        <tr>
                            <th>&nbsp;</th>
                            <th>Kode Kwitansi</th>
                            <th>Keterangan</th>
                            <th>Departemen</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody id='list_setorpajak'>

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

<!-- Start: Modal Pengajuan Kas Kecil -->
<div class="modal fade" id="PengajuanKasKecil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Kas Kecil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table" id="tabelkaskecil">
                    <thead class="{bg_header}">
                        <tr>
                            <th>&nbsp;</th>
                            <th>Kode Kwitansi</th>
                            <th>Keterangan</th>
                            <th>Departemen</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody id='list_KasKecil'>

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

<!-- Start: Modal Setor Kas Kecil -->
<div class="modal fade" id="SetorKasKecil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Setor Kas Kecil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table" id="tabelsetorkaskecil">
                    <thead class="{bg_header}">
                        <tr>
                            <th>&nbsp;</th>
                            <th>Kode Kwitansi</th>
                            <th>Keterangan</th>
                            <th>Departemen</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody id='list_SetorKasKecil'>

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

<!-- Start: Modal ReturJual -->
<div class="modal fade" id="ReturJual" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Retur Jual</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table" id="tabelreturjual">
                    <thead class="{bg_header}">
                        <tr>
                            <th>&nbsp;</th>
                            <th>Kode Kwitansi</th>
                            <th>Keterangan</th>
                            <th>Departemen</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody id='list_returjual'>

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


<!-- Start: Modal ReturBeli -->
<div class="modal fade" id="ReturBeli" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Retur Beli</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table" id="tabelreturbeli">
                    <thead class="{bg_header}">
                        <tr>
                            <th>&nbsp;</th>
                            <th>Kode Kwitansi</th>
                            <th>Keterangan</th>
                            <th>Departemen</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody id='list_returbeli'>

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

<!-- Start: Modal Deposito -->
<div class="modal fade" id="Deposito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Deposito</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table" id="tabeldeposito">
                    <thead class="{bg_header}">
                        <tr>
                            <th>&nbsp;</th>
                            <th>Kode Kwitansi</th>
                            <th>Keterangan</th>
                            <th>Departemen</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody id='list_deposito'>

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
    var base_url = '{site_url}Kas_bank/';
    $.fn.dataTable.Api.register( 'hasValue()' , function(value) {
        return this .data() .toArray() .toString() .toLowerCase() .split(',') .indexOf(value.toString().toLowerCase())>-1
    })

    $(document).ready(function(){
        //combobox perusahaan
        ajax_select({
            id: '#id_perusahaan',
            url: base_url + 'select2_mperusahaan',
        });
    })

    //combobox nama penerima/pejabat
    $('#id_perusahaan').change(function(e) {
        tabelpenjualan.clear().draw();
        tabelpembelian.clear().draw();
        tabelbudgetevent.clear().draw();
        tabelrewardsales.clear().draw();
        tabelsetorpajak.clear().draw();
        tabelkaskecil.clear().draw();
        tabelsetorkaskecil.clear().draw();
        tabelreturbeli.clear().draw();
        tabelreturbeli.clear().draw();
        tabeldeposito.clear().draw();
        
        $("#pejabat").val($("#pejabat").data("default-value"));
        $('input[name=penerimaan]').val('0'); 
        $('input[name=pengeluaran]').val('0');
        var perusahaanId = $('#id_perusahaan').children('option:selected').val();
        ajax_select({
            id: '#pejabat',
            url: base_url + 'select2_mdepartemen_pejabat/' + perusahaanId,
        });
        getListPenjualan();
        getListPembelian();
        getListBudgetEvent();
        getListKasKecil();
        getListSetorKasKecil();
    })

    //combobox nama penerima/pejabat
    $('#tanggal').change(function(e) {
        tabelpenjualan.clear().draw();
        tabelpembelian.clear().draw();
        tabelbudgetevent.clear().draw();
        tabelrewardsales.clear().draw();
        tabelsetorpajak.clear().draw();
        tabelkaskecil.clear().draw();
        tabelsetorkaskecil.clear().draw();
        tabelreturbeli.clear().draw();
        tabelreturbeli.clear().draw();
        tabeldeposito.clear().draw();
        
        getListPenjualan();
        getListPembelian();
        getListBudgetEvent();
        getListKasKecil();
        getListSetorKasKecil();
    })


    //penomoran otomatis
    function Fungsi_nomor_otomatis() {
        var no = document.getElementById("nomor");
        var checkbox = document.getElementById("penomoran_otomatis");
        if (checkbox.checked) {
            no.value='{kode_otomatis}';
            no.readOnly = true;
        } else {
            no.value='';
            no.readOnly = false;
        }
    }

    //nomor kwitansi
    $('#id_perusahaan').change(function(){ 
        $.ajax({
            url : base_url + 'get_kode_perusahaan',
            method : "POST",
            data : {id: $('select[name=perusahaan]').val()},
            async : true,
            dataType : 'json',
            success: function(data){
                var kodeper = '';
                var i;
                for(i=0; i<data.length; i++){ kodeper += data[i].kode; }        
                var nomor = '{kode_otomatis}';
                var tipe = 'BANK';
                var tahun = '{tahun}';
                var kodeperusahaan = kodeper;
                document.getElementById("form1").nomor.value = nomor+'/'+kodeperusahaan+'/'+tipe+'/'+tahun;
            }
        });
        return false;
    }); 

    //datatable rincian BKU
    var table_detail = $('#table_detail_rincian_buku_kas_umum').DataTable({
        sort: false,
        info: false,
        searching: false,
        paging: false,
        columnDefs: [
            {targets: [0], visible:false},
            {targets: [1,2,3,4,7,8,9,10] },
            {targets: [5,6], className: 'text-right'}
        ],
         footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\Rp.]/g, '').replace(/,00/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            penerimaan = api.column(5).data().reduce( function (a, b) {
                return intVal(a) + intVal(b); 
            }, 0 );
            pengeluaran = api.column(6).data().reduce( function (a, b) {
                return intVal(a) + intVal(b); 
            }, 0 );
           
            $('#penerimaan').val(formatRupiah(String(penerimaan), 'Rp. '))
            $('#pengeluaran').val(formatRupiah(String(pengeluaran), 'Rp. '))
            
        }
    })

    //datatable rincian SSD
    var table_detail_SSD = $('#table_detail_rincian_saldo_sumber_dana').DataTable({
        sort: false,
        info: false,
        searching: false,
        paging: false,
        columnDefs: [
            {targets: [0], visible:false},
            {targets: [1], className: 'text-left'},
            {targets: [2,3,4,5], className: 'text-right'}
        ],
         footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\Rp.]/g, '').replace(/,00/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            tot_saldo_awal = api.column(2).data().reduce( function (a, b) {
                return intVal(a) + intVal(b); 
            }, 0 );
            tot_penerimaan = api.column(3).data().reduce( function (a, b) {
                return intVal(a) + intVal(b); 
            }, 0 );
            tot_pengeluaran = api.column(4).data().reduce( function (a, b) {
                return intVal(a) + intVal(b); 
            }, 0 );
            tot_saldo_akhir = api.column(5).data().reduce( function (a, b) {
                return intVal(a) + intVal(b); 
            }, 0 );
           
            $('#tot_saldo_awal').html(formatRupiah(String(tot_saldo_awal), 'Rp. '));
            $('#tot_penerimaan').html(formatRupiah(String(tot_penerimaan), 'Rp. '));
            $('#tot_pengeluaran').html(formatRupiah(String(tot_pengeluaran), 'Rp. '));
            $('#tot_saldo_akhir').html(formatRupiah(String(tot_saldo_akhir), 'Rp. '));
            
        }
    })

    //datatable penjualan
    var tabelpenjualan = $('#tabelpenjualan').DataTable({
        sort: false,
        info: false,
        searching: false,
        paging: false,
        columnDefs: [
            {targets: [0,3,4,5,7], className : 'text-center'},
            {targets: [6] , className: 'text-right'},
            
        ],
    })

    //datatable pembelian
    var tabelpembelian = $('#tabelpembelian').DataTable({
        sort: false,
        info: false,
        searching: false,
        paging: false,
        columnDefs: [
            {targets: [0,2,3,4], className : 'text-center' },
            {targets: [5] , className: 'text-right'},
            
        ],
    })
    //datatable budget event
    var tabelbudgetevent = $('#tabelbudgetevent').DataTable({
        sort: false,
        info: false,
        searching: false,
        paging: false,
        columnDefs: [
            {targets: [0,1,2,3,4] },
            {targets: [5] , className: 'text-right'},
            
        ],
    })
    //datatable RewardSales
    var tabelrewardsales = $('#tabelrewardsales').DataTable({
        sort: false,
        info: false,
        searching: false,
        paging: false,
        columnDefs: [
            {targets: [0,1,2,3,4] },
            {targets: [5] , className: 'text-right'},
            
        ],
    })
    //datatable setorpajak
    var tabelsetorpajak = $('#tabelsetorpajak').DataTable({
        sort: false,
        info: false,
        searching: false,
        paging: false,
        columnDefs: [
            {targets: [0,1,2,3,4] },
            {targets: [5] , className: 'text-right'},
            
        ],
    })
    //datatable kas kecil
    var tabelkaskecil = $('#tabelkaskecil').DataTable({
        sort: false,
        info: false,
        searching: false,
        paging: false,
        columnDefs: [
            {targets: [0,1,2,3,4] },
            {targets: [5] , className: 'text-right'},
            
        ],
    })
    //datatable setor kas kecil
    var tabelsetorkaskecil = $('#tabelsetorkaskecil').DataTable({
        sort: false,
        info: false,
        searching: false,
        paging: false,
        columnDefs: [
            {targets: [0,1,2,3,4] },
            {targets: [5] , className: 'text-right'},
            
        ],
    })
    //datatable ReturJual
    var tabelreturjual = $('#tabelreturjual').DataTable({
        sort: false,
        info: false,
        searching: false,
        paging: false,
        columnDefs: [
            {targets: [0,1,2,3,4] },
            {targets: [5] , className: 'text-right'},
            
        ],
    })
    //datatable ReturBeli
    var tabelreturbeli = $('#tabelreturbeli').DataTable({
        sort: false,
        info: false,
        searching: false,
        paging: false,
        columnDefs: [
            {targets: [0,1,2,3,4] },
            {targets: [5] , className: 'text-right'},
            
        ],
    })
    //datatable deposito
    var tabeldeposito = $('#tabeldeposito').DataTable({
        sort: false,
        info: false,
        searching: false,
        paging: false,
        columnDefs: [
            {targets: [0,1,2,3,4] },
            {targets: [5] , className: 'text-right'},
            
        ],
    })

    function getListPenjualan() {
        var table = $('#list_penjualan');
        var idPerusahaan = $('select[name=perusahaan]').val();
        var tgl = $('input[name=tanggal]').val();
        $.ajax({
            type: "get",
            data : {idPerusahaan: idPerusahaan, tgl: tgl },
            url: base_url + 'get_Penjualan',
            success: function(response) {
                
               for (let i = 0; i < response.length; i++) {
                    const element = response[i];
                    var angsuran = ''; 

                    if (element.jumlahterm != 0){
                        if (element.a1 != ''){
                            angsuran += 'Term 1 : '+ formatRupiah(String(`${element.a1}`), 'Rp. ');
                        }
                        if (element.a2 != ''){
                            angsuran += '<br>Term 2 : '+ formatRupiah(String(`${element.a2}`), 'Rp. ');
                        }
                        if (element.a3 != ''){
                            angsuran += '<br>Term 3 : '+ formatRupiah(String(`${element.a3}`), 'Rp. ')
                        }
                        if (element.a4 != ''){
                            angsuran += '<br>Term 4 : '+ formatRupiah(String(`${element.a4}`), 'Rp. ');
                        }
                        if (element.a5 != ''){
                            angsuran += '<br>Term 5 : '+ formatRupiah(String(`${element.a5}`), 'Rp. ');
                        }
                        if (element.a6 != ''){
                            angsuran += '<br>Term 6 : '+ formatRupiah(String(`${element.a6}`), 'Rp. ');
                        }
                        if (element.a7 != ''){
                            angsuran += '<br>Term 7 : '+ formatRupiah(String(`${element.a7}`), 'Rp. ');
                        }
                        if (element.a8 != ''){
                            angsuran += '<br>Term 8 : '+ formatRupiah(String(`${element.a8}`), 'Rp. ');
                        }
                    }
                    
                    tabelpenjualan.row.add([
                        `<input type="checkbox" id="checkbox_JUAL${element.idfaktur}" name="" data-id="${element.idfaktur}" data-tipe="Penjualan" data-tgl="${element.tanggal}" data-kwitansi="${element.no_kwitansi}" data-nominal="${element.nominal_faktur}" data-namaakun="" data-noakun="${element.nomor_akun}" data-kodeperusahaan="${element.kode}" data-namadepartemen="${element.nama_departemen}" data-namabank="${element.nama_rekening}" data-norekening="${element.nomor_rekening}" onchange="save_detail(this);">`,
                        formatRupiah(String(`${element.uangmuka}`), 'Rp. '),
                        `${angsuran}`,
                        `${element.no_kwitansi}`,
                        `${element.nama_pelanggan}`,
                        `${element.tanggal}`,
                        formatRupiah(String(`${element.nominal_faktur}`), 'Rp. '),
                        `${element.nomor_rekening} <br> ${element.nama_rekening}`,
                    ]).draw();
                }
            }
        });
    }

    function getListPembelian() {
        var table = $('#list_pembelian');
        var idPerusahaan = $('select[name=perusahaan]').val();
        var tgl = $('input[name=tanggal]').val();
        $.ajax({
            type: "get",
            data : {idPerusahaan: idPerusahaan, tgl: tgl },
            url: base_url + 'get_Pembelian',
            success: function(response) {
               for (let i = 0; i < response.length; i++) {
                    const element = response[i];
                    var angsuran = ''; 

                    if (element.jumlahterm != 0){
                        if (element.a1 != ''){
                            angsuran += 'Term 1 : '+ formatRupiah(String(`${element.a1}`), 'Rp. ');
                        }
                        if (element.a2 != ''){
                            angsuran += '<br>Term 2 : '+ formatRupiah(String(`${element.a2}`), 'Rp. ');
                        }
                        if (element.a3 != ''){
                            angsuran += '<br>Term 3 : '+ formatRupiah(String(`${element.a3}`), 'Rp. ')
                        }
                        if (element.a4 != ''){
                            angsuran += '<br>Term 4 : '+ formatRupiah(String(`${element.a4}`), 'Rp. ');
                        }
                        if (element.a5 != ''){
                            angsuran += '<br>Term 5 : '+ formatRupiah(String(`${element.a5}`), 'Rp. ');
                        }
                        if (element.a6 != ''){
                            angsuran += '<br>Term 6 : '+ formatRupiah(String(`${element.a6}`), 'Rp. ');
                        }
                        if (element.a7 != ''){
                            angsuran += '<br>Term 7 : '+ formatRupiah(String(`${element.a7}`), 'Rp. ');
                        }
                        if (element.a8 != ''){
                            angsuran += '<br>Term 8 : '+ formatRupiah(String(`${element.a8}`), 'Rp. ');
                        }
                    }
                    
                    tabelpembelian.row.add([
                        `<input type="checkbox" id="checkbox_JUAL${element.idfaktur}" name="" data-id="${element.idfaktur}" data-tipe="Pembelian" data-tgl="${element.tanggal}" data-kwitansi="${element.no_kwitansi}" data-nominal="${element.nominal_faktur}" data-namaakun="" data-noakun="" data-kodeperusahaan="${element.kode}" data-namadepartemen="${element.nama_departemen}" data-namabank="" data-norekening="" onchange="save_detail(this);">`,
                        formatRupiah(String(`${element.uangmuka}`), 'Rp. '),
                        `${angsuran}`,
                        `${element.no_kwitansi}`,
                        `${element.tanggal}`,
                        formatRupiah(String(element.nominal_faktur), 'Rp. '),
                    ]).draw();
                    
                }
            }
        });
    }

    function getListBudgetEvent() {
        var table = $('#list_budgetevent');
        var idPerusahaan = $('select[name=perusahaan]').val();
        var tgl = $('input[name=tanggal]').val();
        $.ajax({
            type: "get",
            data : {idPerusahaan: idPerusahaan, tgl: tgl },
            url: base_url + 'get_BudgetEvent',
            success: function(response) {
               for (let i = 0; i < response.length; i++) {
                    const element = response[i];

                    if (i < 0) {
                        tabelbudgetevent.row.add([
                            `<input type="checkbox" name="" id=""  disabled>`,
                            `${element.nokwitansi}`,
                            `${element.keterangan}`,
                            `${element.nama_departemen}`,
                            `${element.tanggal}`,
                            `${element.nominal}`,
                        ]).draw();
                    } else {
                        tabelbudgetevent.row.add([
                            `<input type="checkbox" id="checkbox_BE${element.id}" name="" data-id="${element.id}" data-tipe="Budget Event" data-tgl="${element.tanggal}" data-kwitansi="${element.nokwitansi}" data-nominal="${element.nominal}" data-namaakun="" data-noakun="${element.akunno}" data-kodeperusahaan="${element.kode}" data-namadepartemen="${element.nama_departemen}" data-namabank="${element.nama_bank}" data-norekening="${element.nomor_rekening}" onchange="save_detail(this);">`,
                            `${element.nokwitansi}`,
                            `${element.keterangan}`,
                            `${element.nama_departemen}`,
                            `${element.tanggal}`,
                            formatRupiah(String(`${element.nominal}`), 'Rp. '),
                        ]).draw();
                    }
                }
            }
        });
    }

    function getListKasKecil() {
        var table = $('#list_KasKecil');
        var idPerusahaan = $('select[name=perusahaan]').val();
        var tgl = $('input[name=tanggal]').val();
        $.ajax({
            type: "get",
            data : {idPerusahaan: idPerusahaan, tgl : tgl},
            url: base_url + 'get_KasKecil',
            success: function(response) {
                for (let i = 0; i < response.length; i++) {
                    const element = response[i];
                    if (i < 0) {
                        tabelkaskecil.row.add([
                            `<input type="checkbox" name="" id=""  disabled>`,
                            `${element.nokwitansi}`,
                            `${element.keterangan}`,
                            `${element.nama_departemen}`,
                            `${element.tanggal}`,
                            `${element.nominal}`,
                        ]).draw();
                    } else {
                        tabelkaskecil.row.add([
                            `<input type="checkbox" id="checkbox_PKK${element.id}" name="" data-id="${element.id}" data-tipe="Pengajuan Kas Kecil" data-tgl="${element.tanggal}" data-kwitansi="${element.nokwitansi}" data-nominal="${element.nominal}" data-namaakun="${element.nama_akun}" data-noakun="${element.nomor_akun}" data-kodeperusahaan="${element.kode}" data-namadepartemen="${element.nama_departemen}" data-namabank="${element.nama_bank}" data-norekening="${element.nomor_rekening}" onchange="save_detail(this)">`,
                            `${element.nokwitansi}`,
                            `${element.keterangan}`,
                            `${element.nama_departemen}`,
                            `${element.tanggal}`,
                            formatRupiah(String(`${element.nominal}`), 'Rp. '),
                        ]).draw();
                    }
                }
            }
        });
    }

   function getListSetorKasKecil() {
        var table = $('#list_SetorKasKecil');
        var idPerusahaan = $('select[name=perusahaan]').val();
        var tgl = $('input[name=tanggal]').val();
        $.ajax({
            type: "get",
            data : {idPerusahaan: idPerusahaan, tgl : tgl},
            url: base_url + 'get_SetorKasKecil',
            success: function(response) {
               for (let i = 0; i < response.length; i++) {
                    const element = response[i];

                    if (i < 0) {
                        tabelsetorkaskecil.row.add([
                            `<input type="checkbox" name="" id=""  disabled>`,
                            `${element.nokwitansi}`,
                            `${element.keterangan}`,
                            `${element.nama_departemen}`,
                            `${element.tanggal}`,
                            `${element.nominal}`,
                        ]).draw();
                    } else {
                        tabelsetorkaskecil.row.add([
                            `<input type="checkbox" id="checkbox_SKK${element.id}" data-id="${element.id}" data-tipe="Setor Kas Kecil" data-tgl="${element.tanggal}" data-kwitansi="${element.nokwitansi}" data-nominal="${element.nominal}" data-namaakun="${element.nama_akun}" data-noakun="${element.nomor_akun}" data-kodeperusahaan="${element.kode}" data-namadepartemen="${element.nama_departemen}" data-namabank="${element.nama_bank}" data-norekening="${element.nomor_rekening}" onchange="save_detail(this);">`,
                            `${element.nokwitansi}`,
                            `${element.keterangan}`,
                            `${element.nama_departemen}`,
                            `${element.tanggal}`,
                            formatRupiah(String(`${element.nominal}`), 'Rp. '),
                        ]).draw();
                    }
                }
            }
        });
    }

    //save items
    function save_detail(elem) {
        const tipe = $(elem).attr('data-tipe');
        const id = $(elem).attr('data-id');
        const tgl = $(elem).attr('data-tgl');
        const nokwitansi = $(elem).attr('data-kwitansi');
        const nominal = $(elem).attr('data-nominal');
        const namaakun = $(elem).attr('data-namaakun');
        const noakun = $(elem).attr('data-noakun');
        const kodeperusahaan = $(elem).attr('data-kodeperusahaan');
        const namadepartemen = $(elem).attr('data-namadepartemen');
        const namabank = $(elem).attr('data-namabank');
        const norekening = $(elem).attr('data-norekening');

        if ( tipe == 'Penjualan'){
            const stat = $(elem).is(":checked");
            const table = $('#isitabel');       
            if (stat) {
               table_detail.row.add([
                    `${id}`,
                    `<button type="button" class="btn btn-danger delete_detail" id="button_JUAL${id}" data-id="${id}" data-tipe="${tipe}" onclick="hapus_data(this);">-</button>`,
                    `${tipe}`,
                    `${tgl}`,
                    `${nokwitansi}`,
                    formatRupiah(String(nominal), 'Rp. '),
                    formatRupiah(String('0'), 'Rp. '),
                    `${namaakun} ${noakun}`,
                    `${kodeperusahaan}`,
                    `${namadepartemen}`,
                    `${namabank} ${norekening}`
                ]).draw(false);
            } else {
                var rowindex=$('#button_JUAL'+id).closest('tr').index();
                table_detail.row(rowindex).remove().draw();
            }
        }else if ( tipe == 'Pembelian'){
            const stat = $(elem).is(":checked");
            const table = $('#isitabel');       
            if (stat) {
               table_detail.row.add([
                    `${id}`,
                    `<button type="button" class="btn btn-danger delete_detail" id="button_BELI${id}" data-id="${id}" data-tipe="${tipe}" onclick="hapus_data(this);">-</button>`,
                    `${tipe}`,
                    `${tgl}`,
                    `${nokwitansi}`,
                    formatRupiah(String('0'), 'Rp. '),
                    formatRupiah(String(nominal), 'Rp. '),
                    `${namaakun} ${noakun}`,
                    `${kodeperusahaan}`,
                    `${namadepartemen}`,
                    `${namabank} ${norekening}`
                ]).draw(false);
            } else {
                var rowindex=$('#button_BELI'+id).closest('tr').index();
                table_detail.row(rowindex).remove().draw();
            }
        }else if ( tipe == 'Budget Event'){
            const stat = $(elem).is(":checked");
            const table = $('#isitabel');       
            if (stat) {
               table_detail.row.add([
                    `${id}`,
                    `<button type="button" class="btn btn-danger delete_detail" id="button_BE${id}" data-id="${id}" data-tipe="${tipe}" onclick="hapus_data(this);">-</button>`,
                    `${tipe}`,
                    `${tgl}`,
                    `${nokwitansi}`,
                    formatRupiah(String('0'), 'Rp. '),
                    formatRupiah(String(nominal), 'Rp. '),
                    `${namaakun} ${noakun}`,
                    `${kodeperusahaan}`,
                    `${namadepartemen}`,
                    `${namabank} ${norekening}`
                ]).draw(false);
            } else {
                var rowindex=$('#button_BE'+id).closest('tr').index();
                table_detail.row(rowindex).remove().draw();
            }
        }
        else if ( tipe == 'Pengajuan Kas Kecil' ){
            const stat = $(elem).is(":checked");
            const table = $('#isitabel');       
            if (stat) {
                table_detail.row.add([
                    `${id}`,
                    `<button type="button" class="btn btn-danger delete_detail" id="button_PKK${id}" data-id="${id}" data-tipe="${tipe}" onclick="hapus_data(this);">-</button>`,
                    `${tipe}`,
                    `${tgl}`,
                    `${nokwitansi}`,
                    formatRupiah(String('0'), 'Rp. '),
                    formatRupiah(String(nominal), 'Rp. '),
                    `${namaakun} ${noakun}`,
                    `${kodeperusahaan}`,
                    `${namadepartemen}`,
                    `${namabank} ${norekening}`
                ]).draw(false);
            } else {
                var rowindex=$('#button_PKK'+id).closest('tr').index();
                table_detail.row(rowindex).remove().draw();
            }         
        }else if ( tipe == 'Setor Kas Kecil' ){
            const stat = $(elem).is(":checked");
            const table = $('#isitabel');       
            if (stat) {
               table_detail.row.add([
                    `${id}`,
                    `<button type="button" class="btn btn-danger delete_detail" id="button_SKK${id}" data-id="${id}" data-tipe="${tipe}" onclick="hapus_data(this);">-</button>`,
                    `${tipe}`,
                    `${tgl}`,
                    `${nokwitansi}`,
                    formatRupiah(String(nominal),'Rp. '),
                    formatRupiah(String('0'),'Rp. '),
                    `${namaakun} ${noakun}`,
                    `${kodeperusahaan}`,
                    `${namadepartemen}`,
                    `${namabank} ${norekening}`
                ]).draw( false );
            } else {
                var rowindex=$('#button_SKK'+id).closest('tr').index();
                table_detail.row(rowindex).remove().draw();
            }
        }
        detail_array();
        hitungTotalPengeluaranPemindahbukuan();
    }

    function hapus_data(elem) {
        const id = $(elem).attr('data-id');
        const tipe = $(elem).attr('data-tipe');
        if(tipe == 'Penjualan'){
            document.getElementById("checkbox_JUAL"+id).checked = false;
        }else if(tipe == 'Pembelian'){
            document.getElementById("checkbox_BELI"+id).checked = false;
        }else if(tipe == 'Budget Event'){
            document.getElementById("checkbox_BE"+id).checked = false;
        }else if(tipe == 'Reward Sales'){
            document.getElementById("checkbox_RS"+id).checked = false;
        }else if(tipe == 'Setor Pajak'){
            document.getElementById("checkbox_SP"+id).checked = false;
        }else if (tipe == 'Pengajuan Kas Kecil'){
            document.getElementById("checkbox_PKK"+id).checked = false;
        }else if (tipe == 'Setor Kas Kecil'){
            document.getElementById("checkbox_SKK"+id).checked = false;
        }else if(tipe == 'Retur Jual'){
            document.getElementById("checkbox_RJ"+id).checked = false;
        }else if(tipe == 'Retur Beli'){
            document.getElementById("checkbox_RB"+id).checked = false;
        }else if(tipe == 'Deposito'){
            document.getElementById("checkbox_DEPO"+id).checked = false;
        }  
    }

    $('#table_detail_rincian_buku_kas_umum tbody').on('click','.delete_detail',function(){
        table_detail.row($(this).parents('tr')).remove().draw();
        detail_array();
        hitungTotalPengeluaranPemindahbukuan();
    })


    function detail_array() {
        $('#detail_array').val( JSON.stringify(table_detail.data().toArray()) );
    }

    function hitungTotalPengeluaranPemindahbukuan(){
        var tbl= document.getElementById('table_detail_rincian_buku_kas_umum'), sumPengeluaranPemindahbukuan=0;
        for (var i = 1; i < tbl.rows.length; i++) {
            ubahpengeluaran = tbl.rows[i].cells[5].innerHTML.split('Rp. ').join('');
            ubahpengeluaran1 = ubahpengeluaran.split('.').join('');
            tipe = tbl.rows[i].cells[1].innerHTML;
            if ( tipe == 'Pengajuan Kas Kecil'){
                sumPengeluaranPemindahbukuan = sumPengeluaranPemindahbukuan + parseInt(ubahpengeluaran1);
            }else{
                sumPengeluaranPemindahbukuan = sumPengeluaranPemindahbukuan + 0;
            }
        }
        document.getElementById('pengeluaran_pemindahbukuan').value=formatRupiah(String(sumPengeluaranPemindahbukuan), 'Rp. ');
    }
    //simpan data
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
</script>