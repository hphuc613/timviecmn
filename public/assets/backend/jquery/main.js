/***** Action Clear Search *****/
$(document).on('click', 'button.clear', function (event) {
    event.preventDefault();
    var form = $(this).parents('form');
    form.find('input').attr('disabled', 'disabled');
    form.find('select').attr('disabled', 'disabled');
    form.trigger('submit');
});


/***** Hide menu group null *****/
$(document).find('.menu-child').each(function (key, item) {
    if ($(item).find('li').length === 0) {
        $(item).parents('li').addClass('d-none');
    }
});

/***** Action delete *****/
$(document).on('click', '.btn-delete', function (e) {
    e.preventDefault();
    var action = $(this).attr('href');
    var lang = $('html').attr('lang');
    var title = (lang !== 'en') ? "你確定嗎?" : "Are you sure?";
    var text = (lang !== 'en') ? "您将无法还原此内容!" : "You won't be able to revert this!";

    swal.fire({
        title: title,
        text: text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: (lang !== 'en') ? '刪除' : 'Delete',
        confirmButtonColor: "#d33",
        cancelButtonText: (lang !== 'en') ? '取消' : 'Cancel',
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            window.location.replace(action);
        }
    });
});

/***** Alert Notification *****/
function notificationAlert() {
    var successNoti = $('.success-notification').val();
    if (successNoti !== "") {
        $.toast({
            heading: "Success",
            text: successNoti,
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'success',
            hideAfter: 10000,
            stack: 6
        });
    }

    var dangerNoti = $('.danger-notification').val();
    if (dangerNoti !== "") {
        $.toast({
            heading: "Fail",
            text: dangerNoti,
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 10000,
            stack: 6
        });
    }
}

/***** Action Check all item in table *****/
$(document).on('click', '.select-all', function () {
    var class_child = $(this).attr('id');
    if (class_child !== '') {
        var child = $('input.' + class_child);
        if (child.length > 0) {
            child.not(this).prop('checked', this.checked);
        } else {
            if (!$(this).hasClass('select-all-with-other-child')) {
                $('input.checkbox-item').not(this).prop('checked', this.checked);
            }
        }
    } else {
        $('input.checkbox-item').not(this).prop('checked', this.checked);
    }
});

/** Upload Style**/
$(document).on('change', 'input[type="file"]', function (e) {
    var file_name = e.target.files[0].name;
    $(this).siblings('label#upload-display').html('<i class="fa fa-upload"></i> ' + file_name);
});

/*********** Datetime Picker *************/
var lang = $('html').attr('lang');
//VIETNAM CALENDAR
$.fn.datetimepicker.dates['vi'] = {
    days: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy", "Chủ nhật"],
    daysShort: ["CNhật", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy", "CNhật"],
    daysMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7", "CN"],
    months: ["Tháng một", "Tháng hai", "Tháng ba", "Tháng tư", "Tháng năm", "Tháng sáu", "Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai"],
    monthsShort: ["Th. 1", "Th. 2", "Th. 3", "Th. 4", "Th. 5", "Th. 6", "Th. 7", "Th. 8", "Th. 9", "Th. 10", "Th. 11", "Th. 12"],
    today: "Hôm nay",
    meridiem: ['SA', 'CH']
};
$('input.datetime, input.date, input.time, input.month, input.year').attr("autocomplete", "off");
$('input.datetime').datetimepicker({
    format: 'dd-mm-yyyy hh:ii',
    fontAwesome: true,
    autoclose: true,
    todayHighlight: true,
    todayBtn: true,
    language: lang,
});

$('input.date').datetimepicker({
    format: 'dd-mm-yyyy',
    fontAwesome: true,
    autoclose: true,
    todayHighlight: true,
    startView: 2, // 0: hour current, 1: time in date current, 2: date
                  // in month current, 3: month in year current, 4 year
                  // in decade current
    minView: 2,
    todayBtn: true,
    language: lang,
});
$('input.time').datetimepicker({
    format: 'hh:ii',
    fontAwesome: true,
    autoclose: true,
    startView: 1,
    language: lang,
});
$('input.month').datetimepicker({
    format: 'mm-yyyy',
    fontAwesome: true,
    autoclose: true,
    startView: 3,
    minView: 3,
    language: lang,
});
$('input.year').datetimepicker({
    format: 'yyyy',
    fontAwesome: true,
    autoclose: true,
    startView: 4,
    minView: 4,
    language: lang,
});

/***********************************************************************/
/*********** Elfinder Popup *************/
function openElfinder(btn, url, soundPath, csrf) {
    var modal = '\n' +
        '    <div class="modal fade" style="z-index: 12000" id="elfinder-show">\n' +
        '        <div class="modal-dialog modal-lg" style="max-width: 90%">\n' +
        '            <div class="modal-content bg-transparent border-0">\n' +
        '                <div class="modal-body">\n' +
        '                    <div id="elfinder"></div>\n' +
        '                </div>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '    </div>';

    if ($('body').find('#elfinder-show').length === 0) {
        $('body').append(modal);
    }
    var lang = $('html').attr('lang');
    $('#elfinder-show').modal();
    $('#elfinder').elfinder({
        debug: false,
        lang: lang,
        width: '100%',
        height: '100%',
        customData: {
            _token: csrf
        },
        commandsOptions: {
            getfile: {
                onlyPath: true,
                folders: false,
                multiple: false,
                oncomplete: 'destroy'
            },
            ui: 'uploadbutton'
        },
        mimeDetect: 'internal',
        onlyMimes: [
            'image/jpeg',
            'image/jpg',
            'image/png',
            'image/gif'
        ],
        soundPath: soundPath,
        url: url,
        getFileCallback: function (file) {
            $(btn).parents('.input-group').find('input').val(file.url);
            $(btn).find('.cke_dialog_ui_input_text').val(file.url);

            //Add to gallery form
            var form = $(btn).parents('#gallery-form');
            if (form.length > 0) {
                var html = '';
                html += '<div class="image-item">';
                html += '<button type="button" href="javascript:" class="btn btn-outline-danger btn-remove"><i class="fa fa-trash"></i></button>';
                html += '<input value="' + file.url + '" name="images[]" class="d-none">';
                html += '<img src="' + file.url + '" alt="' + file.url + '">';
                html += '</div>';
                form.find('#gallery').append(html);
            }

            $('#elfinder-show').modal('hide');
        },
        resizable: false
    }).elfinder('instance');
}
