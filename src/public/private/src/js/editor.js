$(document).ready(function () {

    $('.editor').summernote({
        height: 300,
        lang: 'ru-RU',
        callbacks: {
            onImageUpload: function (files) {
                for (let i = 0; i < files.length; i++) {
                    $.upload(files[i], $(this));
                }
            }
        },
    });

    $.upload = function (file, editor) {

        let formData = new FormData();
        formData.append('action', 'imgUpload');
        formData.append('file', file);

        $.ajax({
            method: 'POST',
            url: '/admin/ajax',
            contentType: false,
            cache: false,
            processData: false,
            data: formData,
            success: function (src) {
                editor.summernote('insertImage', src);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error(textStatus + ' ' + errorThrown);
            }
        });
    };

});
