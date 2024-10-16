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
            document: $(this).parents(".file-loader-wrapper").find(".file-loader input[type='file']").data("document"),
            page: $(this).parents(".file-loader-wrapper").find(".file-loader input[type='file']").data("page"),
            user: location.pathname.match(/\d+$/)[0],
            // comment: $(this).parents(".comment-popup").find("textarea").val(),
        }

        axios.post("/api/pa/users/files/upload", data).then(response => {
            console.log(response);
            Swal.fire({
                title: '',
                text: response.data.message,
                type: 'success',
                showCancelButton: false,
                confirmButtonText: 'OK',
            });
        });

        $(this).parents(".comment-popup").hide(100);
    });

    $(".files").on("click", ".file__edit", function (e) {
        e.preventDefault();
        $(this).find(".comment-popup").show(100);
    });

    $(".files").on("click", ".file__delete", function (e) {
        e.preventDefault();

        console.log();

        let data = {
            user: location.pathname.match(/\d+$/)[0],
            path: $(this).parents(".file").find(".file__name").text(),
        };

        axios.delete("/api/pa/users/files/delete", { data: data })
            .then(response => {
                $(this).parents(".file").remove();
                Swal.fire({
                    title: '',
                    text: response.data.message,
                    type: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                });
            })
    });

    $(".getZipAchive").on("click", function (e) {
        e.preventDefault();

        location.href = `/api/pa/files/${$(this).data("id")}/zip/create`;
    });


    $(".file-loader-wrapper input[type='file']").on("change", function () {
        let formData = new FormData();

        Array.from(this.files).forEach(file => {
            formData.append(file.name, file)
        });

        formData.append("document", $(this).data("document"));
        formData.append("page", $(this).data("page"));
        formData.append("control", $(this).attr("name"));


        axios.post("/api/pa/users/files/upload", formData).then(response => {
            response.data.documents.forEach(element => {
                let newBlock = $(this).parents(".file-loader-wrapper").find(".file-loader__files .file:first-child").clone();
                $(newBlock).find(".file__name").attr("href", element.path);
                $(newBlock).find(".file__name").text(element.path);
                $(newBlock).find(".tooltip").data("id", element.id);
                $(newBlock).css("display", "flex");
                $(this).parents(".file-loader-wrapper").find(".file-loader__files").append(newBlock);
            });

        });
    });

    $("select[name='class']").on("change", function () {
        console.log($(this).val());
        if ($(this).val() == 2) {
            /** Абитуриент */
            $(".works").css("display", "none");
            $(".documents input[name='diploma']").parents(".field").css("display", "flex");
            $(".documents input[name='report']").parents(".field").css("display", "flex");
            $(".documents-2").css("display", "none");
            $("select[name='admission_year']").parents(".column-item").css("display", "none");
            $(".exams").css("display", "block");

            let visibleDocs = [
                "report",
                "diplomaApp",
                "anotherApp"
            ];

            $(".achievments input[type='file']").parents(".field").css("display", "none");

            Array.from($(".achievments input[type='file']")).forEach(el => {
                if (visibleDocs.includes($(el).attr("name")))
                    $(el).parents(".field").css("display", "flex")
            });
        }

        if ($(this).val() == 1) {
            /** Аспирант */
            $(".works").css("display", "block");
            $(".documents input[name='diploma']").parents(".field").css("display", "none");
            $(".documents input[name='report']").parents(".field").css("display", "none");
            $(".exams").css("display", "none");
            $("select[name='admission_year']").parents(".column-item").css("display", "block");
            $(".documents-2").css("display", "block");

            let visibleDocs = [
                "materialConf",
                "thesisReport",
                "article",
                "pid",
                "another_as",
                "reportStudent"
            ];

            $(".achievments input[type='file']").parents(".field").css("display", "none");

            Array.from($(".achievments input[type='file']")).forEach(el => {
                if (visibleDocs.includes($(el).attr("name")))
                    $(el).parents(".field").css("display", "flex")
            });
        }
    });

    $(".user_icon").on("change", function () {
        let formData = new FormData();

        Array.from(this.files).forEach(file => {
            formData.append($(this).prop("name"), file)
        });

        axios.post("/api/pa/users/files/upload", formData).then(response => {
            $(this).parents("label").find("img").attr("src", `/storage/${response.data.image}`);
        });
    });

});
