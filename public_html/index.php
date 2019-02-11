<?
require($_SERVER['DOCUMENT_ROOT'] . '/components/result.php');
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/css/style.css"/>
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.js" type="text/javascript"></script>


</head>
<body>


<a href="#" class="but" id="add_bt">добавить запись</a>
    <div class="container">
        <?
        foreach ($GLOBALS['VIEW_BOOKS'] as $book) {
            ?>
            <div class="element">
                <div class="Avatar"></div>
                <div class="ID">Номер книги №: <? echo $book["ID"]; ?></div>
                <div class="Name">Наименование книги: <? echo $book["name"]; ?></div>
                <div class="Type">Жанр книги: <? echo $book["type"]; ?></div>
                <div class="Author">Автор: <? echo $book["author"]; ?></div>
                <div class="Year">Год книги: <? echo $book["year"]; ?></div>
                <a href="#" class="but" id="upd_bt" data-upd="<?=$book["ID"]?>">Редактировать книгу</a>
                <a href="#" class="but" id="del_bt" data-del="<?=$book["ID"]?>">Удалить книгу</a>
            </div>
        <? } ?>
    </div>

<div id="add_modal_form">
    <span id="add_modal_close">X</span>
    <form action="" method="POST" class="add_form">
        <div class="add_book">
            <span>Наименование книги:</span>
            <input id="name" class="elements" type="text">
            <span>Автор книги:</span>
            <input id="author" class="elements" type="text">
            <span>Жанр книги:</span>
            <select id="type" class="elements"  >
                <option>Детектив</option>
                <option>Фантастика </option>
                <option>Любовные романы</option>
                <option>Бизнес </option>
                <option>Поэзия </option>
                <option>Русская классика </option>
            </select>
<!--            <input id="type" class="elements" type="text">-->
<!--            <span>Год книги: </span>-->
            <input id="year" class="elements" type="text">
            <a id="add_book_bt" class="but"> Добавить книгу </a>
        </div>
    </form>
</div>

<div id="upd_modal_form">
    <span id="upd_modal_close">X</span>
    <form action="" method="POST" class="update_form">
        <div class="upd_book">
            <span>Наименование книги:</span>
            <input id="name" class="elements" type="text">
            <span>Автор книги:</span>
            <input id="author" class="elements" type="text">
            <span>Жанр книги:</span>
            <input id="type" class="elements" type="text">
            <span>Год книги: </span>
            <input id="year" class="elements" type="text">
            <a id="update_book_bt" class="but" data-upd="">Редактировать книгу</a>
        </div>
    </form>
</div>
<div id="overlay"></div>
</body>
</html>