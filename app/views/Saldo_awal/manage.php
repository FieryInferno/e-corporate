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
        <p class="m-3 text-left font-weight-semibold">
            Silahkan masukkan saldo awal per tanggal <a href="{site_url}saldo_awal">{tanggal}</a> <br>
        </p>
        <ul class="list">
            <li>Untuk merubah tanggal awal pencatatan silahkan klik tautan tanggal.</li>
            <li>Apabila saldo kredit dan saldo debet tidak sama, maka selisih saldo akan ditambahkan ke akun ekuitas saldo awal.</li>
            <li>Selama belum tutup buku, maka saldo awal bisa diedit.</li>
            <li>Untuk nomor akun-akun persediaan diisi pada menu stok opname dengan pilihan kategori stok awal.</li>
        </ul>
        <form action="javascript:save()" id="form1">
            <div class="table-responsive table-scrollable">
                <table class="table" id="table_detail">
                    <thead class="{bg_header}">
                        <tr>
                            <th> <?php echo lang('name') ?> </th>
                            <th width="20%" class="text-right"><?php echo lang('debet') ?></th>
                            <th width="20%" class="text-right"><?php echo lang('kredit') ?></th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php $no = 0; $totaldebet = 0; $totalkredit = 0 ?>
                        <?php foreach ($saldoawaldetail as $row): ?>
                            <?php $totaldebet = $totaldebet + $row['debet'] ?>
                            <?php $totalkredit = $totalkredit + $row['kredit'] ?>
                            <tr>
                                <input class="no" type="hidden" name="noakun[]" value="<?php echo $row['noakun'] ?>">
                                <td>
                                    <a href="{site_url}noakun/detail/<?php echo $row['noakun'] ?>">
                                        (<?php echo $row['noakun'] ?>) - <?php echo $row['namaakun'] ?>
                                    </a>
                                </td>
                                <?php if ($row['noakun'] == '35'): ?>
                                    <td class="text-right" width="12%">
                                        <input type="text" name="debet[]" readonly maxlength="12" class="form-control debet text-right" value="<?php echo number_format($row['debet']) ?>">
                                    </td>
                                    <td class="text-right" width="12%">
                                        <input type="text" name="kredit[]" readonly maxlength="12" class="form-control kredit text-right" value="<?php echo number_format($row['kredit']) ?>">
                                    </td>
                                <?php else: ?>
                                    <td class="text-right" width="12%">
                                        <input type="text" name="debet[]" maxlength="12" class="form-control debet text-right" value="<?php echo number_format($row['debet']) ?>">
                                    </td>
                                    <td class="text-right" width="12%">
                                        <input type="text" name="kredit[]" maxlength="12" class="form-control kredit text-right" value="<?php echo number_format($row['kredit']) ?>">
                                    </td>
                                <?php endif ?>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <table class="table">
                <tbody>
                    <tr>
                        <td class="text-right font-weight-semibold"><?php echo lang('total') ?></td>
                        <td width="20%" class="text-right totaldebet"><?php echo number_format($totaldebet) ?></td>
                        <input type="hidden" name="totaldebet">
                        <td width="20%" class="text-right totalkredit"><?php echo number_format($totalkredit) ?></td>
                        <input type="hidden" name="totalkredit">
                    </tr>
                </tbody>
            </table>
            <hr>
            <div class="text-right mb-3 mr-3">
                <div class="btn-group">
                    <button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script src="{assets_path}global/js/plugins/tables/datatables/datatables.min.js"></script>
<script src="{assets_path}global/js/plugins/pickers/pickadate/picker.js"></script>
<script src="{assets_path}global/js/plugins/pickers/pickadate/picker.date.js"></script>
<script type="text/javascript">
    var base_url = '{site_url}saldo_awal/';
    
    $(document).on('keyup','.debet',function(){
        var val = $(this).val();
        $(this).val( numeral(val).format() );
    })

    $(document).on('keyup','.kredit ',function(){
        var val = $(this).val();
        $(this).val( numeral(val).format() );
    })

    $('#table_detail tbody').on('change','.debet, .kredit',function(){
        var kredit = 0;
        var debet = 0;
        var noakun = null;
        var row = $(this).closest('tr');
        row.find('input.debet').each(function() { debet = this.value });
        row.find('input.kredit').each(function() { kredit = this.value });

        var totaldebet = 0;
        $('#table_detail tbody').find('input.debet').each(function() { totaldebet += numeral(this.value).value() });
        $('.totaldebet').text( numeral(totaldebet).format() )
        $('input[name=totaldebet]').val( numeral(totaldebet).value() )

        var totalkredit = 0;
        $('#table_detail tbody').find('input.kredit').each(function() { totalkredit += numeral(this.value).value() });
        $('.totalkredit').text( numeral(totalkredit).format() )
        $('input[name=totalkredit]').val( numeral(totalkredit).value() )

    })

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
                    NotifySuccess(data.message)
                    location.reload()
                } else {
                    NotifyError(data.message)
                }
            },
            error: function() {
                NotifyError('<?php echo lang('internal_server_error') ?>');
            }
        })
    }

</script>