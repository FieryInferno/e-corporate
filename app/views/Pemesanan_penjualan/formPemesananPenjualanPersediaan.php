<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label><?php echo lang('warehouse') ?>:</label>
            <select class="form-control gudangid" name="gudangid" required></select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label><?php echo lang('item') ?>:</label>
            <select class="form-control itemid" name="itemid" required style="width:100%"></select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label><?php echo lang('stock') ?>:</label>
            <input type="text" class="form-control decimalnumber" name="stok" disabled>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label><?php echo lang('price') ?>:</label>
            <input type="text" class="form-control decimalnumber" name="harga" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label><?php echo lang('qty') ?>:</label>
            <input type="text" class="form-control decimalnumber" name="jumlah" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label><?php echo lang('discount') ?>:</label>
            <input type="text" class="form-control decimalnumber" name="diskon" required maxlength="2">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label><?php echo lang('ppn') ?>:</label>
            <input type="text" class="form-control decimalnumber" name="ppn" required maxlength="2">
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        ajax_select({ id: '.itemid', url: base_url + 'select2_item', selected: { id: '' } });
        ajax_select({ id: '.gudangid', url: base_url + 'select2_gudang', selected: { id: '' } });
    })

    $(document).on('change','.gudangid',function(){
        gudangid = $(this).val();
        $('.itemid').val('').trigger('change');
        $('input[name=rowindex]').val(null);
        $('input[name=stok]').val(0);
        $('input[name=harga]').val(0);
        $('input[name=jumlah]').val(0);
        $('input[name=diskon]').val(0);
        $('input[name=ppn]').val(0);
    })

    $(document).on('change','.itemid',function(){
        var gudangid = $('.gudangid').val();
        var rowindex = $('input[name=rowindex]').val();
        var itemid = $(this).val();
        if(!rowindex) {
            if(itemid) {
                
                if(!gudangid) {
                    NotifyError('Silahkan pilih gudang terlebih dahulu.');
                    $('.itemid').val('').trigger('change');
                    return false;
                }

                $.ajax({
                    url: base_url + 'get_detail_item',
                    method: 'post',
                    datatype: 'json',
                    data: {
                        itemid: itemid
                    },
                    success: function(data) {
                        $('input[name=harga]').val( numeral(data.hargajual).format() );
                        $('input[name=jumlah]').val(0);
                        $('input[name=diskon]').val(0);
                        $('input[name=ppn]').val(0);
                    }
                })

                $.ajax({
                    url: base_url + 'get_stok_item',
                    method: 'post',
                    datatype: 'json',
                    data: {
                        itemid: itemid,
                        gudangid: $('select[name=gudangid]').val()
                    },
                    success: function(data) {
                        if(data.stok == null) $('input[name=stok]').val(0);
                        else $('input[name=stok]').val(data.stok);
                    }
                })
            } else {
                $('input[name=rowindex]').val(null);
                $('input[name=stok]').val(0);
                $('input[name=harga]').val(0);
                $('input[name=jumlah]').val(0);
                $('input[name=diskon]').val(0);
                $('input[name=ppn]').val(0);
            }
        }
    })

    $(document).on('change','input[name=jumlah]',function(){
        var jumlah = numeral( $(this).val() ).value();
        var stok = numeral( $('input[name=stok]').val() ).value();
        if(jumlah > stok) {
            NotifyError('Jumlah pesan tidak boleh lebih dari stok');
            $(this).val(0)
            return false;
        }
    })
</script>