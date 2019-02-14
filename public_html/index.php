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
                <div class="ID">Номер книги №: <span><? echo $book["ID"]; ?></span></div>
                <div class="Name">Наименование книги: <span><? echo $book["name"]; ?></span></div>
                <div class="Type">Жанр книги: <span><? echo $book["type"]; ?></span></div>
                <div class="Author">Автор:<span> <? echo $book["author"]; ?></span></div>
                <div class="Year">Год книги:<span> <? echo $book["year"]; ?></span></div>
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
            <span>Год книги: </span>
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
            <select id="type" class="elements"  >
                <option>Детектив</option>
                <option>Фантастика </option>
                <option>Любовные романы</option>
                <option>Бизнес </option>
                <option>Поэзия </option>
                <option>Русская классика </option>
            </select>
            <span>Год книги: </span>
            <input id="year" class="elements" type="text">
            <a id="update_book_bt" class="but" data-upd="">Редактировать книгу</a>
        </div>
    </form>
</div>
<div id="inform_modal">
    <span id="inform_modal_close">X</span>
    <div class="text_modal"></div>
</div>
<div id="overlay"></div>
</body>
</html>