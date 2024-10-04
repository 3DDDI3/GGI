if ($('.admin_edit-form button[type=submit]').length) {
    $('.save').show();
    $('body').on('click', '.save', function () {
        $('.admin_edit-form button[type=submit]').click();
    });
}

$('body').on('keyup', '.client-card-input input, .input-number', function () {
    if (this.value.match(/[^0-9]/g)) {
        this.value = this.value.replace(/[^0-9]/g, '');
    }
});

$(document).ready(function () {

    // Маска номера телефона
    $("input[name='phone']").not('.select-phone').inputmask('+7 (999) 999-99-99');
    $(".select-phone").inputmask('(999) 999-99-99');

    // Маска для поля с рейтингом
    $('.rating-change, .gallery-rating, .main-video-rating, .file-rating').inputmask({
        alias: 'numeric',
        rightAlign: false
    });

    // Уведомление
    $('body').on('click', '.button_alert, #black', function () {
        $('.notice').hide();
    });

    setTimeout(function () {
        $('.notice').fadeOut(150);
    }, 1000);

    // Название файла или кол-во в кнопке выбора файла
    $('.admin_edit-form').on('change', "input[type='file']", function () {
        if ($(this)[0].hasAttribute('multiple')) {

            let count = this.files.length;
            let file = declOfNum(count, ['файл', 'файла', 'файлов']);
            let fileCount = 'Выбрано';

            if (count === 1) {
                // fileCount = 'Выбран';
                $(this).next('label').text(this.files[0].name);
            } else {
                $(this).next('label').text(fileCount + ' ' + count + ' ' + file);
            }

        } else {
            $(this).next('label').text(this.files[0].name);
        }
    });

    $('.gallery-sortable').sortable({
        handle: '.card_image_block',
        // cancel: '',

        placeholder: 'sortable-placeholder-active',
        forcePlaceholderSize: true,
        cursor: 'grabbing',
        start: function (event, ui) {
            ui.item.addClass('sortable-active');
            ui.placeholder.height(ui.item.height() - 4).width(ui.item.width() - 4);
        },
        stop: function (event, ui) {
            ui.item.removeClass('sortable-active');
        },
        update: function (event, ui) {

            let cards = $('.admin_img_card', this),
                count = cards.length;

            cards.each(function () {
                $('.gallery-rating', this).val(--count).trigger('change');
            });

        }
    });

    $('.sortable_list').sortable({
        // handle: '',
        cancel: '.admin_show,a,input,h4,p,span',

        placeholder: 'sortable-list-placeholder',
        forcePlaceholderSize: true,
        cursor: 'grabbing',
        start: function (event, ui) {
            ui.item.addClass('sortable-active');
            ui.placeholder.height(ui.item.innerHeight() - 2);
        },
        stop: function (event, ui) {
            ui.item.removeClass('sortable-active');
        },
        update: function (event, ui) {

            let items = $('.list_item', this),
                count = items.length,
                className = $('.rating-change', this).data('class'),
                array = [];

            items.each(function () {
                let ratingInput = $('.rating-change', this);
                ratingInput.val(--count);
                array[ratingInput.data('id')] = ratingInput.val();
            });

            $.ajax({
                url: '/admin/ajax',
                type: 'POST',
                data: {
                    action: 'sortableRating',
                    array: array,
                    className: className,
                },
                success: function (data) {
                    console.log(data);
                },
                error: function (data) {
                    console.log(data);
                }
            });


        }
    });

});

$('.file-uploader__section.ui-sortable').sortable({

    placeholder: 'sortable-placeholder-active',
    forcePlaceholderSize: true,
    cursor: 'grabbing',
    start: function (event, ui) {
        ui.item.addClass('sortable-active');
        ui.placeholder.height(ui.item.innerHeight() - 2)
    },
    stop: function (event, ui) {
        ui.item.removeClass('sortable-active');
    },
    update: function (event, ui) {

        let cards = $('.row', this),
            count = cards.length;

        cards.each(function () {
            $('.file-rating', this).val(--count).trigger('change');
        });

    }
});

$('.js-admin_nav_title').on('click', function () {
    var pages = $(this).next();
    if (pages.hasClass('js-admin_nav_pages')) {
        if (pages.is(':visible')) {
            pages.slideUp();
        } else {
            pages.slideDown();
        }
    }
});

$('.js-modal-search-checkboxes').on('click', function () {

    var token = $('[name=_token]').val();
    var dataUrl = $(this).attr('data-url');
    var dataId = $(this).attr('data-id');
    var dataClass = $(this).attr('data-class');
    var dataInput = $(this).siblings('input[type=hidden]').val();
    var dialogContent = $('.dialog__content');

    dialogOpen();

    dialogContent.html('<div class="loading"></div>')

    $.ajax({
        url: dataUrl,
        type: 'POST',
        data: {
            '_token': token,
            'id': dataId,
            'class': dataClass,
            'data': dataInput,
        },
        success: function (data) {
            dialogContent.html(data);
        }
    });

});

$(document).on('click', '.js-search-checkboxes__search-button', function () {
    var token = $('[name=_token]').val();
    var parent = $(this).closest('.js-search-checkboxes');
    var dataClass = parent.find('.search-checkboxes__class').val();
    var data = $('.' + dataClass).find('input[type=hidden]').val();
    var dataUrl = parent.attr('data-url');
    var search = parent.find('.js-search-checkboxes__search-input').val();
    var itemsArea = parent.find('.js-search-checkboxes__items');

    itemsArea.html('<div class="loading"></div>');

    $.ajax({
        url: dataUrl,
        type: 'POST',
        data: {
            '_token': token,
            'search': search,
            'data': data
        },
        success: function (data) {
            itemsArea.html(data);
        }
    });
});

$(document).on('change', '.search-checkboxes input[type=checkbox], textarea[name=search-textbox]', function () {
    var dataClass = $(this)
        .closest('.search-checkboxes__body')
        .find('.search-checkboxes__class')
        .val();
    var input = $('.' + dataClass).find('input[type=hidden]');
    var str = '';
    var checkboxes = $('.search-checkboxes');

    if (checkboxes.find('textarea[name=search-textbox]').length > 0) {
        var data = [];
        $('.search-checkboxes__item').each(function () {
            var checkbox = $(this).find('input[type=checkbox]');

            if (checkbox || text)
                data.push({
                    'id': checkbox.val(),
                    'checked': (checkbox.is(':checked') ? 1 : 0),
                    'text': $(this).find('textarea[name=search-textbox]').val()
                });
        });
        str = JSON.stringify(data);
        input.val(str).trigger('change');
    }
    else {
        checkboxes.find('input[type=checkbox]:checked').each(function () {
            str += $(this).val() + '|';
        });
        input.val(str.slice(0, -1)).trigger('change');
    }
});

$('.set_status > .checkbox_block_wrap input').on('change', function () {
    $('.js-sets-products').toggle();
});

$('[name=custom_average_review_rating_status]').on('change', function () {
    $('.average-rating-input').toggle();
});

/* --- CHOSEN SELECT --- */

if ($('.chosen').length > 0) {
    $('.chosen').chosen({
        no_results_text: "Ничего не найдено...",
        width: '100%',
        search_contains: true
    });
    $('.search-select .chosen, .search-select2 .chosen, .search-select3 .chosen, .search-select4 .chosen').change(function () {
        var submit = $('.filter_form button[type=submit]');
        if (submit.length) {
            submit.click();
        }
    });
}

/* --- // --- */


/* --- CHECKBOX BLOCK ALL --- */

$('body').on('change', '.checkbox-multiple-block-all', function () {
    var parent = $(this).closest('.checkbox-multiple');
    if ($(this).prop('checked')) {
        $('.checkbox-multiple-block', parent).prop('checked', true);
    }
    else {
        $('.checkbox-multiple-block', parent).prop('checked', false);
    }
});

$('body').on('change', '.checkbox-multiple-block', function () {
    var parent = $(this).closest('.checkbox-multiple');
    if (!$(this).prop('checked')) {
        $('.checkbox-multiple-block-all', parent).prop('checked', false);
    }
});

/* --- // --- */

/* --- Banners Type --- */

$('body').on('change', '.banners-type', function () {
    var id = $(this).val();
    $('.banners-size').removeClass('banners-size-show');
    $('.banners-size[data-id=' + id + ']').addClass('banners-size-show');
});

/* --- // --- */


/* --- Items --- */

$('body').on('click', '.items-add', function () {
    var btn = $(this);
    var id = btn.attr('data-id');
    var table = btn.attr('data-table');
    var type = btn.attr('data-type');
    var fieldset = btn.closest('fieldset');
    var items = $('>.items', fieldset);
    var items_childs = btn.closest('.items-childs');
    btn.addClass('items-add-loading');
    $.ajax({
        url: '/admin/ajax',
        type: 'POST',
        data: {
            action: 'items_add',
            table: table,
            id: id,
            type: type
        },
        success: function (html) {
            btn.removeClass('items-add-loading');
            items.append(html);
            if (items_childs.length > 0) {
                btn.addClass('items-add-hide');
            }
        }
    });
});

$('body').on('change', '.items-edit', function () {
    var item_id = $(this).attr('data-id');
    var table = $(this).attr('data-table');
    var type = $(this).attr('data-type');
    var value = $(this).val() || '';
    $.ajax({
        url: '/admin/ajax',
        type: 'POST',
        data: {
            action: 'items_edit',
            table: table,
            item_id: item_id,
            value: value,
            type: type
        },
        success: function (html) { }
    });
});

$('body').on('change', '.items-edit2', function () {
    var item_id = $(this).attr('data-id');
    var table = $(this).attr('data-table');
    var type = $(this).attr('data-type');
    var value = $(this).val() || '';
    $.ajax({
        url: '/admin/ajax',
        type: 'POST',
        data: {
            action: 'items_edit2',
            table: table,
            item_id: item_id,
            value: value,
            type: type
        },
        success: function (html) { }
    });
});

$('body').on('change', '.items-edit-checkbox', function () {
    var item_id = $(this).attr('data-id');
    var table = $(this).attr('data-table');
    var field = $(this).attr('data-field');
    var value = 0;
    if ($(this).prop('checked')) value = 1;
    $.ajax({
        url: '/admin/ajax',
        type: 'POST',
        data: {
            action: 'items_edit_checkbox',
            table: table,
            item_id: item_id,
            value: value,
            field: field
        },
        success: function (html) { }
    });
});

$('body').on('click', '.items-edit-delete', function () {
    var table = $(this).attr('data-table');
    var type = $(this).attr('data-type');
    var id = $(this).attr('data-id');
    var parent = $(this).closest('.input_block');
    var fieldset = $(this).closest('fieldset');
    Swal.fire({
        title: 'Вы действительно хотите удалить?',
        text: 'Отменить это действие будет невозможно',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Удалить',
        cancelButtonText: 'Отмена',
    }).then((result) => {
        if (result.value) {
            parent.remove();
            $('>.items-add', fieldset).removeClass('items-add-hide');
            $.ajax({
                url: '/admin/ajax',
                type: 'POST',
                data: {
                    action: 'items_delete',
                    table: table,
                    id: id,
                    type: type
                },
                success: function (html) { },
                error: function (html) { console.log(html); },
            });
        }
    });
});

$('body').on('click', '.items-value', function () {
    var name = $(this).html() || '';
    var parent = $(this).closest('.input_block');
    $('.items-edit', parent).val(name).change();
    $('.items-values', parent).hide();
});

$('body').on('focus', '.items-edit', function () {
    var parent = $(this).closest('.input_block');
    $('.items-values', parent).show();
});

$(document).click(function (event) {
    if ($(event.target).closest('.items-edit').length) return;

    $('.items-values').hide();

    event.stopPropagation();
});

/* --- Chars type --- */

$('body').on('change', '.chars-type-change', function () {
    var id = $(this).val();
    var items = $('.chars-type-items');
    var dop = $('.chars-type-dop');

    items.show();
    if (id == 1) items.hide();

    dop.hide();
    if (id == 4 || id == 5) {
        dop.show();
    }
});

/* --- // --- */



$('.admin_content').on('click', '.js-accordion__button', function () {
    var body = $(this).closest('.js-accordion').find('.js-accordion__body');
    if (!body.is(':visible')) {
        body.slideDown();
        $(this).addClass('accordion__button_active');
        value = 1;
    }
    else {
        body.slideUp();
        $(this).removeClass('accordion__button_active');
        value = 2;
    }
    var name = $(this).html();
    $.ajax({
        url: '/admin/ajax',
        type: 'POST',
        data: {
            action: 'accordion',
            name: name,
            value: value
        },
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log(data);
        }
    });
});


$(function () {
    var boxes = $('.js-construct-box');

    $('.js-construct-box-column__add').on('click', function () {
        var column = $(this).closest('.js-construct-box-column');
        var parentId = column.attr('data-parent-id');
        var box = column.closest('.js-construct-box');
        var name = box.attr('data-name');
        var fieldName = parentId ? name + "[" + parentId + "]" + "[]" : name + "[]";
        var body = column.find('.js-construct-box-column__body');
        var field = "<div class='construct-box-column__item js-construct-box-column__item'>" +
            "<textarea name='" + fieldName + "'></textarea>" +
            "<button type='button' class='construct-box-column__delete js-construct-box-column__delete'></button>" +
            "</div>"

        body.append(field);
        box.find('input.js-construct-box__edit').val(1)
    });

    $('.js-construct-box textarea').on('change', function () {
        var box = $(this).closest('.js-construct-box');
        box.find('input.js-construct-box__edit').val(1);
    });

    boxes.on('click', '.js-construct-box-column__delete', function () {
        var box = $(this).closest('.js-construct-box');
        box.find('input.js-construct-box__edit').val(1);

        $(this).parent().remove();
    });
});

function humanFileSize(bytes, si = false, dp = 1) {
    const thresh = si ? 1000 : 1024;

    if (Math.abs(bytes) < thresh) {
        return bytes + ' B';
    }

    const units = si
        ? ['kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']
        : ['KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB'];
    let u = -1;
    const r = 10 ** dp;

    do {
        bytes /= thresh;
        ++u;
    } while (Math.round(Math.abs(bytes) * r) / r >= thresh && u < units.length - 1);


    return bytes.toFixed(dp) + ' ' + units[u];
}

$(function () {

    if ($('.file-uploader__form').length) {

        const form = document.querySelector(".file-uploader__form"),
            fileInput = document.querySelector(".file-uploader .file-input"),
            progressArea = document.querySelector(".file-uploader .progress-area"),
            uploadedArea = document.querySelector(".file-uploader .uploaded-area"),
            uploadedFile = fileInput.files[0];

        // form click event
        form.addEventListener("click", () => {
            fileInput.click();
        });

        fileInput.onchange = ({ target }) => {
            for (const [key, file] of Object.entries(target.files)) {
                if (file) {
                    let fileName = file.name; //getting file name
                    if (fileName.length >= 25) { //if file name length is greater than 12 then split it and add ...
                        let splitName = fileName.split('.');
                        fileName = splitName[0].substring(0, 13) + "... ." + splitName[1];
                    }
                    progressArea.innerHTML = "";
                    let uploadedHTML = `<li class="row new-row">
                                <div class="content upload">
                                  <i class="fas fa-file-alt"></i>
                                  <div class="details">
                                    <span class="name">${fileName}</span>
                                    <span class="size">${humanFileSize(file.size, false)}</span>
                                  </div>
                                </div>
                                <i class="fas fa-check"></i>
                              </li>`;

                    // uploadedArea.innerHTML = uploadedHTML; //uncomment this line if you don't want to show upload history
                    uploadedArea.insertAdjacentHTML("afterbegin", uploadedHTML); //remove this line if you don't want to show upload history
                }
            };

        }

    }

});

$('.js-bonus-accrual__button').on('click', function () {
    var parent = $(this).closest('.js-bonus-accrual');
    var input = parent.find('input');
    var count = input.val();
    var id = $(this).attr('data-id');
    var type = $(this).attr('data-type');

    Swal.fire({
        title: 'Начислено ' + count + ' бонусов',
        icon: 'success'
    });
    if (type == 'review') {
        parent.find('.js-bonus-accrual__grid').remove();
        parent.html("<strong>За отзыв начислено <span>" + count + "</span> бонусов</strong>")
    }
    if (type == 'custom_accrual') {
        input.val('');
        var count_span = parent.find('strong > span');
        count_span.text(Number(count_span.text()) + Number(count));
    }

    $.ajax({
        url: '/admin/ajax',
        type: 'POST',
        data: {
            action: 'bonusesAccrual',
            count: count,
            id: id,
            type: type
        },
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log(data);
        }
    });
});