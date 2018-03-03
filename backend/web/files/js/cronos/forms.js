$( document ).ready(function() {
    var form_login = $('#form_login');
    var form_information = $('#form_information');
    var form_security = $('#form_security');
    var form = $("#form");
    var form = $("#form");
    var form_section = $("#form_section");
    var form_category = $("#form_category");
    var form_subcategory = $("#form_subcategory");

    /* Аутентификация */
    form_login.on('submit',function(e) {
        e.preventDefault();
        var msg = form_login.serialize();
        $.ajax({
            dataType: "json",
            type: "POST",
            url: "/profile/site/login/",
            data:msg,
            status: startLoading(".login-form"),
            success: function(data) {
                $(".login-form").unblock();
                SendSwal(data.message, data.type);
                if (data.type == "success") {
                    setTimeout(function () {
                        window.location.href = "/profile/";
                    }, 1500);
                }
            },
        }).fail(function (xhr) {
            console.log(xhr. responseText);
        });
    });
    /* --------------------- */

    /* Редактирование профиля */
    form_information.validate({
        ignore: 'input[type=hidden]',
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        validClass: "validation-valid-label",
        success: function(label) {
            label.addClass("validation-valid-label").text("Принято.")
        },
        rules: {
            first_name: {
                minlength: 2
            },
            last_name: {
                minlength: 2
            },
            phone: {
                minlength: 5
            },
        },
        submitHandler: function () {
            var msg = form_information.serialize();
            $.ajax({
                dataType: "json",
                type: "POST",
                url: "/profile/account/setinformation/",
                data:msg,
                status: startLoading(form_information),
                success: function(data) {
                    form_information.unblock();
                    SendSwal(data.message, data.type);
                    if (data.type == "success") {
                        $("#last_edit").html(data.last_edit);
                    } else if (data.type == "information") {
                        setTimeout(function () {
                            window.location.href = "/profile/authentication/";
                        }, 2000);
                    }
                },
            }).fail(function (xhr) {
                console.log(xhr. responseText);
            });
            return false;
        }
    });


    form_security.validate({
        ignore: 'input[type=hidden]',
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        validClass: "validation-valid-label",
        success: function(label) {
            label.addClass("validation-valid-label").text("Принято.")
        },
        rules: {
            newpass: {
                minlength: 5
            },
            repeat_newpass: {
                equalTo: "#newpass"
            },
        },
        submitHandler: function () {
            var msg = form_security.serialize();
            $.ajax({
                dataType: "json",
                type: "POST",
                url: "/profile/account/setpassword/",
                data: msg,
                cache: false,
                processData: false,
                status: startLoading(form_security),
                success: function (data) {
                    form_security.unblock();
                    SendSwal(data.message, data.type);
                    if (data.type == "success") {
                        setTimeout(function () {
                            window.location.href = "/profile/logout/";
                        }, 2000);
                    } else if (data.type == "information") {
                        setTimeout(function () {
                            window.location.href = "/profile/authentication/";
                        }, 2000);
                    }
                },
            }).fail(function (xhr) {
                console.log(xhr.responseText);
            });
            return false;
        }
    });
    /* ------------------------ */



    /* Форма для раздела */
    form_section.validate({
        ignore: 'input[type=hidden]',
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        validClass: "validation-valid-label",
        success: function(label) {
            label.addClass("validation-valid-label").text("Принято.")
        },
        submitHandler: function () {
            var form = document.getElementById("form_section");
            var msg = new FormData(form);
            console.log(msg);
            $.ajax({
                dataType: "json",
                type: "POST",
                url: "/profile/sections/action/",
                data: msg,
                cache: true,
                contentType: false,
                processData: false,
                status: startLoading($("#form_section")),
                success: function (data) {
                    var redirect = null;
                    $("#form_section").unblock();
                    if (data.type == "information") {
                        setTimeout(function () {
                            window.location.href = "/profile/authentication/";
                        }, 2000);
                    } else if (data.type == "success") {
                        redirect = "sections";
                    }
                    SendSwal(data.message, data.type, redirect);
                },
            }).fail(function (xhr) {
                console.log(xhr.responseText);
            });
            return false;
        }
    });

    /* Форма для подраздела */
    form_category.validate({
        ignore: 'input[type=hidden]',
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        validClass: "validation-valid-label",
        success: function(label) {
            label.addClass("validation-valid-label").text("Принято.")
        },
        submitHandler: function () {
            var form = document.getElementById("form_category");
            var msg = new FormData(form);
            console.log(msg);
            $.ajax({
                dataType: "json",
                type: "POST",
                url: "/profile/categories/action/",
                data: msg,
                cache: true,
                contentType: false,
                processData: false,
                status: startLoading($("#form_category")),
                success: function (data) {
                    var redirect = null;
                    $("#form_category").unblock();
                    if (data.type == "information") {
                        setTimeout(function () {
                            window.location.href = "/profile/authentication/";
                        }, 2000);
                    } else if (data.type == "success") {
                        redirect = "categories";
                    }
                    SendSwal(data.message, data.type, redirect);
                },
            }).fail(function (xhr) {
                console.log(xhr.responseText);
            });
            return false;
        }
    });


    /* Форма для категории */
    form_subcategory.validate({
        ignore: 'input[type=hidden]',
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        validClass: "validation-valid-label",
        success: function(label) {
            label.addClass("validation-valid-label").text("Принято.")
        },
        submitHandler: function () {
            var form = document.getElementById("form_subcategory");
            var msg = new FormData(form);
            console.log(msg);
            $.ajax({
                dataType: "json",
                type: "POST",
                url: "/profile/subcategories/action/",
                data: msg,
                cache: true,
                contentType: false,
                processData: false,
                status: startLoading($("#form_subcategory")),
                success: function (data) {
                    var redirect = null;
                    $("#form_subcategory").unblock();
                    if (data.type == "information") {
                        setTimeout(function () {
                            window.location.href = "/profile/authentication/";
                        }, 2000);
                    } else if (data.type == "success") {
                        redirect = "subcategories";
                    }
                    SendSwal(data.message, data.type, redirect);
                },
            }).fail(function (xhr) {
                console.log(xhr.responseText);
            });
            return false;
        }
    });

    $('body').on('click', '.delete', function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var table = $(this).data("table");
        var redirect = $(this).data("redirect");
        var token = $('meta[name=csrf-token]').attr("content");


        swal({
            title: "Подтверждаете удаление?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2196F3",
            confirmButtonText: "Подтверждаю",
            cancelButtonText: "Отмена",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    dataType: "json",
                    type: "POST",
                    url: "/profile/site/delete/",
                    data: {"_csrf-backend":token, id:id, table:table},
                    status: startLoading($("#form_" + name)),
                    success: function (data) {
                        $("#form_" + name).unblock();
                        if (data.type == "information") {
                            setTimeout(function () {
                                window.location.href = "/profile/authentication/";
                            }, 2000);
                        } else if (data.type != "success") {
                            redirect = null;
                        }
                        SendSwal(data.message, data.type, redirect);
                    },
                }).fail(function (xhr) {
                    console.log(xhr.responseText);
                });
            } else {
                swal({
                    title: "Действие отменено",
                    timer: 900,
                    type: "error",
                    showConfirmButton: false
                });
            }
        });
    });

    function startLoading(block) {
        $(block).block({
            message: '<i class="icon-spinner4 spinner"></i>',
            overlayCSS: {
                backgroundColor: 'rgba(63, 158, 195, 0.59)',
                opacity: 1,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                color: '#fff',
                backgroundColor: 'transparent'
            }
        });
    }

    function SendSwal(message, type, link) {
        swal({
            title: message,
            timer: 900,
            type: type,
            showConfirmButton: false
        });
        if (link != null) {
            $('#' + link).trigger('click');
        }
    }
});