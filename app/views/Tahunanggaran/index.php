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
                <div class="col-12">         
                    <div class="card">
                        <div class="card-header">
                            <a href="{site_url}tahun_anggaran/create" class="btn btn-primary">+ <?php echo lang('add_new') ?></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-xs table-striped table-borderless table-hover index_datatable">
                                    <thead>
                                        <tr class="table-active">
                                            <th>ID</th>
                                            <th><?php echo lang('Tahun') ?></th>
                                            <th><?php echo lang('Keterangan') ?></th>
                                            <th><?php echo lang('Status') ?></th>
                                            <th class="text-center"><?php echo lang('Status') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot></tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
var base_url = '{site_url}tahunanggaran/';
var table = $('.index_datatable').DataTable({
    ajax: {
        url: base_url + 'index_datatable',
        type: 'post',
    },
    pageLength: 100,
    stateSave: true,
    autoWidth: false,
    dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"p>',
    language: {
        search: '<span></span> _INPUT_',
        searchPlaceholder: 'Type to filter...',
    },
    columns: [
        {data: 'id', visible: false},
        {data: 'tahun'},
        {data: 'keterangan'},
        {data: 'status'},
        {
            data: 'id', width: 100, orderable: false,
            render: function(data,type,row) {
                var aksi = ` <a class="btn btn-info btn-sm" href="<?= base_url(); ?>tahun_anggaran/edit/`+data+`">
                                <i class="fas fa-pencil-alt"></i>                             
                            </a>
                            <a class="btn btn-danger btn-sm" href="javascript:deleteData(`+data+`)">
                                <i class="fas fa-trash"></i>                           
                            </a>`;
                return aksi;
            }
        }
    ]
});

function deleteData(id) {
    var notice = new PNotify({
        title: '<?php echo lang('confirm') ?>',
        text: '<p><?php echo lang('confirm_delete') ?></p>',
        hide: false,
        type: 'warning',
        confirm: {
            confirm: true,
            buttons: [
                { text: 'Yes', addClass: 'btn btn-sm btn-primary' },
                { addClass: 'btn btn-sm btn-link' }
            ]
        },
        buttons: { closer: false, sticker: false }
    })
    notice.get().on('pnotify.confirm', function() {
        $.ajax({ url: base_url + 'delete/'+id })
        setTimeout(function() { table.ajax.reload() }, 100);
    })
}
</script>