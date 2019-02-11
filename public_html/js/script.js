$(document).ready(function () {
    $('#add_book_bt').click(function () {

            var name = $("div.add_book input#name").val();
            var type = $("div.add_book select#type").val();
            var author = $("div.add_book input#author").val();
            var year = $("div.add_book input#year").val();
            var action = "add";
            alert(year);
            $.ajax(
                {
                    type: "POST",
                    url: 'components/ajax.php',
                    data: {
                        BDName: name,
                        BDType: type,
                        BDAuthor: author,
                        BDYear: year,
                        Action: action
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data) {
                            console.log(data);
                            update_content(data);
                            alert("Книга  добавлена!");
                        } else alert('Ошибка добавления книги');
                    }
                }
            );

        }
    );

    function update_content(data) {
        $(".container").empty();
        for (var i = 0; i < data.length; i++) {
            $(".container").append("<div class=\"element\">\n" +
                "            <div class=\"Avatar\"></div>\n" +
                "            <div class=\"ID\">Номер книги №:" + data[i].ID + "</div>\n" +
                "            <div class=\"Name\">Наименование книги: " + data[i].name + "</div>\n" +
                "            <div class=\"Type\">Жанр книги: " + data[i].type + "</div>\n" +
                "            <div class=\"Author\">Автор: " + data[i].author + "</div>\n" +
                "            <div class=\"Year\">Год книги: " + data[i].year + "</div>\n" +
                " <a href=\"#\" class=\"but\" id=\"upd_bt\" data-upd=\"" + data[i].ID + "\">Редактировать запись</a>" +
                "<a href=\"#\" class=\"but\" id=\"del_bt\" data-del=\"" + data[i].ID + "\">Удалить книгу</a>"+
                "        </div>");
        }
    }

    $("#del_bt").live('click', function () {

        var id_book = $(this).data('del');
        var action = "del";
        alert(id_book);
        $.ajax(
            {
                type: "POST",
                url: 'components/ajax.php',
                data: {
                    BDID: id_book,
                    Action: action
                },
                dataType: "json",
                success: function (data) {
                    if (data) {
                        console.log(data);
                        update_content(data);
                        alert("Книга  удалена!");
                    } else alert('Ошибка удаления книги');
                }
            }
        );
    });

    $("#update_book_bt").live('click', function () {
        var name = $("div.upd_book input#name").val();
        var type = $("div.upd_book input#type").val();
        var author = $("div.upd_book input#author").val();
        var id_book = $("a#update_book_bt").data('upd');
        var year = $("div.upd_book input#year").val();
        var action = "upd";
        $.ajax(
            {
                type: "POST",
                url: 'components/ajax.php',
                data: {
                    BDName: name,
                    BDType: type,
                    BDAuthor: author,
                    BDYear: year,
                    BDID: id_book,
                    Action: action
                },
                dataType: "json",
                success: function (data) {
                    if (data) {
                        console.log(data);
                        update_content(data);
                        alert("Книга  обновлена!");
                    } else alert('Ошибка обновления книги');
                }
            }
        );
    });

    $('a#add_bt').click(function (event) {
        event.preventDefault();
        $('#overlay').fadeIn(400,
            function () {
                $('#add_modal_form')
                    .css('display', 'block')
                    .animate({opacity: 1, top: '50%'}, 200);
            });
    });
    $("a#upd_bt").live('click', function (event) {
        var upd_id = $(this).data('upd');
        $('a#update_book_bt').data("upd", upd_id);
        event.preventDefault();
        $('#overlay').fadeIn(400,
            function () {
                $('#upd_modal_form')
                    .css('display', 'block')
                    .animate({opacity: 1, top: '50%'}, 200);
            });
    });

    $('#add_modal_close, #overlay').click(function () {
        $('#add_modal_form')
            .animate({opacity: 0, top: '45%'}, 200,
                function () {
                    $(this).css('display', 'none');
                    $('#overlay').fadeOut(400);
                }
            );
    });

    $('#upd_modal_close, #overlay').click(function () {
        $('#upd_modal_form')
            .animate({opacity: 0, top: '45%'}, 200,
                function () {
                    $(this).css('display', 'none');
                    $('#overlay').fadeOut(400);
                }
            );
    });

});