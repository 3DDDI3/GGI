$(document).ready(function () {

    // Подтвердить удаление
    $('.admin_delete').click(function (event) {

        let href = $(this).attr('href');
        event.preventDefault();

        Swal.fire({
            title: 'Вы действительно хотите удалить?',
            text: 'Отменить это действие будет невозможно',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Удалить',
            cancelButtonText: 'Отмена',
        }).then((result) => {
            if (result.value) {
                top.location.href = href;
            }
        });

    });

    // Скрывать/показывать по кнопке глаза
    $('.admin_show').click(function () {

        let id = $(this).data('id');
        let className = $(this).data('class');
        let hide;

        if ($(this).hasClass('admin_show_act')) {
            $(this).removeClass('admin_show_act');
            hide = 1;
        } else {
            $(this).addClass('admin_show_act');
            hide = 0;
        }

        $.ajax({
            url: '/admin/ajax',
            type: 'POST',
            data: {
                action: 'adminHide',
                id: id,
                className: className,
                hide: hide,
            },
            success: function (data) {
                console.log(data);
            }
        });

    });

    // Удалить превью
    $('.img_card_delete').click(function () {

        let imgCard = $(this).closest('.admin_img_card'),
            id = $(this).data('id'),
            className = $(this).data('class'),
            path = $(this).data('path'),
            field = $(this).data('field');

        Swal.fire({
            title: 'Вы действительно хотите удалить?',
            text: 'Отменить это действие будет невозможно',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Удалить',
            cancelButtonText: 'Отмена',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/admin/ajax',
                    type: 'POST',
                    data: {
                        action: 'imgDelete',
                        id: id,
                        className: className,
                        path: path,
                        field: field,
                    },
                    success: function (data) {
                        if (data == 'success') {
                            imgCard.remove();

                            Swal.fire({
                                icon: 'success',
                                title: 'Удалено',
                                timer: 1000,
                            });

                        }
                    }
                });
            }
        });
    });

    // Удалить файл
    $('.file_delete').click(function () {

        let parent = $(this).parent('.admin_file_container'),
            id = $(this).data('id'),
            className = $(this).data('class'),
            path = $(this).data('path'),
            field = $(this).data('field');

        Swal.fire({
            title: 'Вы действительно хотите удалить?',
            text: 'Отменить это действие будет невозможно',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Удалить',
            cancelButtonText: 'Отмена',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/admin/ajax',
                    type: 'POST',
                    data: {
                        action: 'fileDelete',
                        id: id,
                        className: className,
                        path: path,
                        field: field,
                    },
                    success: function (data) {
                        if (data == 'success') {
                            parent.remove();

                            Swal.fire({
                                icon: 'success',
                                title: 'Удалено',
                                timer: 1000,
                            });

                        }
                    }
                });
            }
        });
    });

    // Удалить изображение с галереи
    $('.img_gallery_delete').click(function () {

        let imgCard = $(this).closest('.admin_img_card'),
            id = $(this).data('id'),
            className = $(this).data('class'),
            path = $(this).data('path');

        Swal.fire({
            title: 'Вы действительно хотите удалить?',
            text: 'Отменить это действие будет невозможно',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Удалить',
            cancelButtonText: 'Отмена',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/admin/ajax',
                    type: 'POST',
                    data: {
                        action: 'galleryImgDelete',
                        id: id,
                        className: className,
                        path: path,
                    },
                    success: function (data) {
                        if (data == 'success') {
                            imgCard.remove();

                            Swal.fire({
                                icon: 'success',
                                title: 'Удалено',
                                timer: 1000,
                            });

                        }
                    }
                });
            }
        });
    });

    $('.rating-change').change(function () {
        let value = $(this).val(),
            id = $(this).data('id'),
            className = $(this).data('class');

        $.ajax({
            url: '/admin/ajax',
            type: 'POST',
            data: {
                action: 'changeRating',
                id: id,
                className: className,
                value: value
            },
            success: function (data) {
                console.log(data);
            }
        });
    });

    $('.gallery-rating').change(function () {
        let value = $(this).val(),
            id = $(this).data('id');

        $.ajax({
            url: '/admin/ajax',
            type: 'POST',
            data: {
                action: 'changeGalleryRating',
                id: id,
                value: value
            },
            success: function (data) {
                console.log(data);
            }
        });
    });

    $('.file-rating').change(function () {
        let value = $(this).val(),
            id = $(this).data('id');

        $.ajax({
            url: '/admin/ajax',
            type: 'POST',
            data: {
                action: 'changeFileRating',
                id: id,
                value: value
            },
            success: function (data) {
                console.log(data);
            }
        });
    });

    $('.file-alt').change(function () {
        let value = $(this).val(),
            id = $(this).data('id');

        $.ajax({
            url: '/admin/ajax',
            type: 'POST',
            data: {
                action: 'changeFileAlt',
                id: id,
                value: value
            },
            success: function (data) {
                console.log(data);
            }
        });
    });

    $('.js-delete-file').click(function () {

        let imgCard = $(this).closest('.row'),
            id = $(this).data('id'),
            className = $(this).data('class'),
            path = $(this).data('path');

        Swal.fire({
            title: 'Вы действительно хотите удалить?',
            text: 'Отменить это действие будет невозможно',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Удалить',
            cancelButtonText: 'Отмена',
        }).then((result) => {
            if (result.value) {
                imgCard.remove();
                $.ajax({
                    url: '/admin/ajax',
                    type: 'POST',
                    data: {
                        action: 'deleteFile',
                        id: id,
                        className: className,
                        path: path,
                    },
                    success: function (data) {
                        if (data == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Удалено',
                                timer: 1000,
                            });

                        }
                    }
                });
            }
        });
    });

    $(document).on("click", function (e) {
        let newBlock = $(".comment-popup"),
            editIcon = $(".file__edit");

        if ((!newBlock.is(e.target) && !newBlock.is(e.target) && newBlock.has(e.target).length === 0) && (!editIcon.is(e.target) && !editIcon.is(e.target) && editIcon.has(e.target).length === 0))
            $(newBlock).hide(100);
    });

    $(".files").on("click", ".file .comment-popup svg", function () {
        let data = {
            id: $(this).parents(".file__edit").data("id"),
            text: $(this).parents(".comment-popup").find("textarea").val()
        };

        $.ajax({
            type: "method",
            url: "url",
            data: "data",
            dataType: "dataType",
            success: function (response) {

            }
        });

        $(this).parents(".comment-popup").hide(100);
    });

    $(".file__edit").on("click", function (e) {
        e.preventDefault();
        console.log($(this).parents(".file__edit").find(".comment-popup"));
        $(this).find(".comment-popup").show(100);
    });

    $(".file-loader-wrapper input[type='file']").on("change", function () {
        let formData = new FormData();

        Array.from(this.files).forEach(file => {
            formData.append(file.name, file)
        });

        formData.append("document", $(this).data("document"));
        formData.append("page", $(this).data("page"));

        axios.post("/api/pa/users/files/upload", formData).then(response => {
            console.log(response);
            response.data.documents.forEach(element => {
                let newBlock = $(this).parents(".file-loader-wrapper").find(".file-loader__files .file:first-child").clone();
                $(newBlock).find(".file__name").attr("href", 1231);
                $(newBlock).find(".file__name").text("123123123");
                $(newBlock).find(".tooltip").data("id", 45);
                $(newBlock).css("display", "flex");
                $(this).parents(".file-loader-wrapper").find(".file-loader__files").append(newBlock);
            });

        });
    });

});
