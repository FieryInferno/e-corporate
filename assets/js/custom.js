
function pageBlock() {
    $.blockUI({ 
        message: '<i class="icon-spinner4 spinner"></i>',
        timeout: 500,
        overlayCSS: {
            backgroundColor: '#1b2024',
            opacity: 0.8,
            zIndex: 1200,
            cursor: 'wait'
        },
        css: {
            border: 0,
            color: '#fff',
            padding: 0,
            zIndex: 1201,
            backgroundColor: 'transparent'
        }
    });
}
function unpageBlock() {
    $.unblockUI()
}

function redirect(url) {
    setTimeout(function() { window.location = url }, 1000);
}

function NotifySuccess(textMsg='Success!', titleMsg='Success!') {
    new PNotify({
        title: titleMsg,
        text: textMsg,
        icon: 'icon-checkmark3',
        type: 'success',
    });
}

function NotifyError(textMsg='Error!', titleMsg='Error!') {
    new PNotify({
        title: titleMsg,
        text: textMsg,
        icon: 'icon-blocked',
        type: 'error',
    });
}

function NotyDeleteConfirm(url) {
    // Setup
    var notice = new PNotify({
        title: 'Confirmation',
        text: '<p>Are you sure you want to delete it?</p>',
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

    // On confirm
    notice.get().on('pnotify.confirm', function() {
        redirect(url)
        // alert('Ok, cool.');
    })

    // On cancel
    notice.get().on('pnotify.cancel', function() {
        // alert('Oh ok. Chicken, I see.');
    });    
}

function ajax_select(data) {
    if(data) {
        $(data.id).select2({
            allowClear: true,
            minimumInputLength: data.minimumInputLength,
            placeholder: 'Select an Option',
            ajax: {
                url: data.url,
                dataType: 'json',
                delay: 250,
                data: data.data,
                processResults: function (data) {
                    return {
                        results: data
                    }
                },
                cache: false,
            },
        })

        var selected = data.selected;
        if(selected) {
            var dataoption = $(data.id)
            $.ajax({
                url: data.url + '/' + selected.id,
                dataType: 'json',
                success: function(data) {
                    var option = new Option(data.text, data.id, true, true);
                    dataoption.append(option).trigger('change');
                    dataoption.trigger({
                        type: 'select2:select',
                        params: {
                            data: data
                        }
                    })
                }
            })          
        }
    }
}

$(document).on('keyup','.decimalnumber',function(){
    var val = $(this).val();
    $(this).val( numeral(val).format() );
})

$(document).ready(function(){
    $('.decimalnumber').val( numeral( $('.decimalnumber').val() ).format() );
    $('.datepicker').pickadate({format: 'yyyy-mm-dd'});
})

$(document).on('click','.js-link, .edit', function(e){
    e.preventDefault();
    var content = $('.content');
    var href = $(this).prop('href');
    pageBlock()
    content.load(href, function(response, status, xhr){
        unpageBlock();
    });
})

$(document).on('click', '.rounded', function(e){
    e.preventDefault();
    $('.rounded').removeClass('active')
    var content = $('.content');
    var elementID = $(this);
    var href = $(this).prop('href');
    pageBlock()
    content.load(href, function(response, status, xhr){
        elementID.addClass('active')
        $('.navbar-nav-link').click()
        $('.breadcrumb span').show().text(elementID.text())
        unpageBlock();
    });
})

$(document).on('click', '.dashboard', function(e){
    e.preventDefault();
    var content = $('.content');
    var href = $(this).prop('href');
    pageBlock();
    content.load(href, function(response, status, xhr){
        $('.navbar-nav-link').click()
        $('.rounded').removeClass('active')
        $('.breadcrumb span').hide()
        unpageBlock();
    });
})