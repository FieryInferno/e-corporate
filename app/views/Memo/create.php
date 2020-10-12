<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-info22 mr-2"></i> <span class="font-weight-semibold">{title}</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none">
            <div class="d-flex justify-content-center">
                <div class="btn-group">
                    <a href="{site_url}memo/printpdf" class="btn btn-primary">
                        <?php echo lang('print') ?>
                    </a>
                    <a href="{site_url}memo" class="btn btn-danger">
                        <?php echo lang('back') ?>
                    </a>
                </div>
            </div>
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
                <div class="col-md-6">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><?php echo lang('notrans') ?></td>
                                <td class="font-weight-bold">{notrans}</td>
                            </tr>
                            <tr>
                                <td><?php echo lang('supplier') ?></td>
                                <td class="font-weight-bold">{nama}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-5">
                <form action="javascript:save()" id="form1">
                    <input type="hidden" name="kontakid" value="{kontakid}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('Total_Memo') ?>:</label>
                                <input type="text" class="form-control decimalnumber saldo" name="saldo" disabled value="{saldo}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('Pengembalian_Memo') ?>:</label>
                                <input type="text" class="form-control totaldibayar" name="totaldibayar" required value="0">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo lang('account_number') ?>:</label>
                                <select class="form-control noakunbayar" name="noakunbayar" required></select>
                            </div>
                        </div>
                    </div>
                    <div class="text-left">
                        <div class="btn-group">
                            <a href="{site_url}memo" class="btn bg-danger"><?php echo lang('cancel') ?></a>
                            <button type="submit" class="btn bg-success"><?php echo lang('save') ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{assets_path}global/js/plugins/notifications/pnotify.min.js"></script>
<script src="{assets_path}global/js/plugins/forms/selects/select2.full.min.js"></script>
<script src="{assets_path}global/js/plugins/pickers/pickadate/picker.js"></script>
<script src="{assets_path}global/js/plugins/pickers/pickadate/picker.date.js"></script>
<script type="text/javascript">

    var base_url = '{site_url}memo/';


    $(document).ready(function(){

        $('.totaldibayar').val( numeral( $('.totaldibayar').val() ).format() );

        ajax_select({ id: '.noakunbayar', url: base_url + 'select2_noakunbayar', selected: { id: '' } });

        $('.totaldibayar').change(function(){
            var val = numeral( $(this).val() ).value();
            var saldo = numeral( $('.saldo').val() ).value();
            if(val > saldo) {
                NotifyError('Jumlah pembayaran tidak boleh lebih besar dari saldo debet memo!');
                $(this).val( numeral(0).format() );
                return false;
            }
        })
    })

    $(document).on('keyup','.totaldibayar',function(){
        var val = $(this).val();
        $(this).val( numeral(val).format() );
    })

    function save() {
        var form = $('#form1')[0];
        var formData = new FormData(form);
        
        $.ajax({
            url: base_url + 'save_pengembalian',
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
                    redirect(base_url);
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