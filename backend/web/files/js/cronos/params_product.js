$(function () {
    var palette = [
        ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
        ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
        ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
        ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
        ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
        ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
        ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
        ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
    ];


    var count = 0;
    var addColorHtml = "<div class = 'rod-color mb-10 mr-10' style = 'display:inline-block;'><input id = 'id_"+ count +"' type='text' name = 'colors[]' class='form-control colorpicker-palette-only' value='#27ADCA'>" +
        '<a href = "#" data-id = "'+ count +'" class = "delete_color text-bold ml-5 mr-5">X</a></div>';


    $('body').off('click', '#add-parameter-button');
    $('body').on('click', '#add-parameter-button', function(e) {
        e.preventDefault();
        var token = $('meta[name=csrf-token]').attr("content");

        $.ajax({
            type: "POST",
            url: "/profile/params/getparams/",
            data:{"_csrf-backend":token},
            success: function(data) {
                console.log(data);
                var customParameterHtml = "<!-- Parameter -->" +
                    "                <div class='col-md-12 mb-10' style = 'padding:0;'>" +
                    "                   <div class='form-group'>" +
                    "                       <div class='col-lg-2' style = 'padding:0;'>" +
                    "                           <label>Название параметра:</label>" +
                    "                           <select name = 'parameter[name][]' class='select'>"
                                                    + data +
                    "                           </select>" +
                    "                       </div>" +
                    "                       <div class='col-lg-3'>" +
                    "                           <label>Значение параметра:</label>" +
                    "                           <input type='text' name='parameter[value][]' class='form-control' placeholder='Значение параметра'>" +
                    "                       </div>" +
                    "                       <div class='col-lg-1 mt-15'>" +
                    "                           <button id='remove-parameter-button' class='btn btn-danger' type='button'>X</button>" +
                    "                       </div>" +
                    "                   </div>" +
                    "                </div>";

                $('#parameter-insert-helper').after(customParameterHtml);
                $('.select').select2();
            },
        }).fail(function (xhr) {
            console.log(xhr. responseText);
        });



    });

    /* color buttons */
    $('body').off('click', '#add-color-button');
    $('body').on('click', '#add-color-button', function(e) {
        e.preventDefault();

        $('#color-insert-helper').before(addColorHtml);
        $(".colorpicker-palette-only").spectrum({
            showPalette: true,
            showPaletteOnly: true,
            palette: palette
        });
    });
    /* size parameter button */
    $('body').on('click', '#remove-parameter-button', function(e) {
        e.preventDefault();
        $(this).closest('.col-md-12').remove();
    });



});
