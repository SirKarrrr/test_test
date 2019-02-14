$(document).ready(function () {
    $('#add_book_bt').click(function () {

            var name = $("div.add_book input#name").val();
            var type = $("div.add_book select#type").val();
            var author = $("div.add_book input#author").val();
            var year = $("div.add_book input#year").val();
            var action = "add";
            $("div.validation_msg").remove();
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
                        if (data.success) {
                            $('#add_modal_form')
                                .animate({opacity: 0, top: '45%'}, 200,
                                    function () {
                                        $(this).css('display', 'none');
                                        $('#overlay').fadeOut(400);
                                    }
                                );
                            console.log(data);
                            update_content(data.books);
                            update_text_info(data.book_add);

                            $('#overlay').fadeIn(400,
                                function () {
                                    $('#inform_modal')
                                        .css('display', 'block')
                                        .animate({opacity: 1, top: '50%'}, 200);
                                });
                            // alert("Книга  добавлена!");
                        } else valid_form(data.not_valid);
                    }
                }
            );

        }
    );
    function valid_form(data) {
        $( ".add_book" ).prepend(data);
    }

    function update_text_info(data) {
        $( ".text_modal" ).append("<div class=\"action_msg\">"+data.action+"</div><div class=\"element\">\n" +
            "            <div class=\"Avatar\"></div>\n" +
            "            <div class=\"ID\">Номер книги №:" + data.book_id+ "</div>\n" +
            "            <div class=\"Name\">Наименование книги: " + data.name + "</div>\n" +
            "            <div class=\"Type\">Жанр книги: " + data.type + "</div>\n" +
            "            <div class=\"Author\">Автор: " + data.author + "</div>\n" +
            "            <div class=\"Year\">Год книги: " + data.year + "</div>\n" +
            "        </div>");
    }
    function update_content(data) {
        $(".container").empty();
        for (var i = 0; i < data.length; i++) {
            $(".container").append("<div class=\"element\">\n" +
                "            <div class=\"Avatar\"></div>\n" +
                "            <div class=\"ID\">Номер книги №: <span>" + data[i].ID + "</span></div>\n" +
                "            <div class=\"Name\">Наименование книги: <span>" + data[i].name + "</span></div>\n" +
                "            <div class=\"Type\">Жанр книги:<span> " + data[i].type + "</span></div>\n" +
                "            <div class=\"Author\">Автор: <span>" + data[i].author + "</span></div>\n" +
                "            <div class=\"Year\">Год книги: <span>" + data[i].year + "</span></div>\n" +
                " <a href=\"#\" class=\"but\" id=\"upd_bt\" data-upd=\"" + data[i].ID + "\">Редактировать запись</a>" +
                "<a href=\"#\" class=\"but\" id=\"del_bt\" data-del=\"" + data[i].ID + "\">Удалить книгу</a>"+
                "        </div>");
        }
    }

    $("#del_bt").live('click', function () {
        var name = $(this).parent().children("div.Name").children("span").text();
        var type = $(this).parent().children("div.Type").children("span").text();
        var author = $(this).parent().children("div.Author").children("span").text();
        var year =  $(this).parent().children("div.Year").children("span").text();
        var id_book =  $(this).parent().children("div.ID").children("span").text();
        var action = "del";
        console.log($(this).parent());
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
                    if (data.success) {
                        console.log(data);
                        update_content(data.books);
                        update_text_info(data.book_del);

                        $('#overlay').fadeIn(400,
                            function () {
                                $('#inform_modal')
                                    .css('display', 'block')
                                    .animate({opacity: 1, top: '50%'}, 200);
                            });
                    } else valid_form(data.not_valid);
                }
            }
        );
    });

    $("#update_book_bt").live('click', function () {
        var id_book = $("a#update_book_bt").data('upd');

        var action = "upd";
        $('#upd_modal_form')
            .animate({opacity: 0, top: '45%'}, 200,
                function () {
                    $(this).css('display', 'none');
                    $('#overlay').fadeOut(400);
                }
            );
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
                    if (data.success) {
                        console.log(data);
                        update_content(data.books);
                        update_text_info(data.book_upd);

                        $('#overlay').fadeIn(400,
                            function () {
                                $('#inform_modal')
                                    .css('display', 'block')
                                    .animate({opacity: 1, top: '50%'}, 200);
                            });
                    } else valid_form(data.not_valid);
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
        var name = $(this).parent().children("div.Name").children("span").text();
        var type = $(this).parent().children("div.Type").children("span").text();
        var author = $(this).parent().children("div.Author").children("span").text();
        var year =  $(this).parent().children("div.Year").children("span").text();
        $('div.upd_book input#name').val(name);
        $("div.upd_book  select#type :contains("+type+")").attr("selected", "selected");
        $('div.upd_book input#author').val(author);
        $('div.upd_book input#year').val(year);
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

    $('#inform_modal_close, #overlay').click(function () {
        $('#inform_modal')
            .animate({opacity: 0, top: '45%'}, 200,
                function () {
                    $(this).css('display', 'none');
                    $('#overlay').fadeOut(400);
                }
            );
        $('.text_modal').empty()
    });

});