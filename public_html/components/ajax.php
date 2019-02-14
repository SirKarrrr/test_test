<?php
require ($_SERVER['DOCUMENT_ROOT'].'/components/class.php');

//Для проверки действия пользователя
$action_check = $_POST['Action'];

if($action_check=='add'){

    $name = $_POST['BDName'];
    $type = $_POST['BDType'];
    $author = $_POST['BDAuthor'];
    $year = $_POST['BDYear'];
    last_id_book();
    $newID=$GLOBALS['LAST_ID']+1;
$year_check = is_numeric($year);
    if(!$name||!$type || !$author||!$year){
        $val_name = !$name? "<div class=\"validation_msg\">Поле наименование не заполнено</div>":'';
        $val_type = !$type? "<div class=\"validation_msg\">Поле жанр не заполнен</div>":'';
        $val_author = !$author? "<div class=\"validation_msg\">Поле автор не заполнено</div>":'';
        $val_year = !$year? "<div class=\"validation_msg\">Поле год издания не заполнено</div>":'';
        echo json_encode(array('success'=>false,"not_valid" => $val_name.$val_type.$val_author.$val_year));
        exit;
    }
    if(strlen($year)>4|| !$year_check){

        $val_year =  "<div class=\"validation_msg\">Указан неверный год издания</div>";
        echo json_encode(array('success'=>false,"not_valid" => $val_year));
        exit;
    }

    $result = add_book($newID, $type, $author, $name, $year);
    //Обновление списка каталога
    connect_bd();
    $add_view_content = new its_books();
    $new_catalog = $add_view_content->view_books($GLOBALS['BOOKS']);
    $action='Книга добавлена!';
    $book_add = array("book_id"=> $newID, "type"=> $type, "author"=> $author,"name"=> $name, "year"=>$year, 'action' => $action);
    echo json_encode(array('success'=>$result,'books'=>$new_catalog,'book_add'=>$book_add,"action" => $action));
    exit;
}

if($action_check=='upd'){

    $name = $_POST['BDName'];
    $type = $_POST['BDType'];
    $author = $_POST['BDAuthor'];
    $year = $_POST['BDYear'];
    $year_check = is_numeric($year);
    if(strlen($year)>4|| !$year_check){

        $val_year =  "<div class=\"validation_msg\">Указан неверный год издания</div>";
        echo json_encode(array('success'=>false,"not_valid" => $val_year));
        exit;
    }
    $newID=$_POST['BDID'];
    $result = upd_book($newID, $type, $author, $name, $year);
    //Обновление списка каталога
    connect_bd();
    $add_view_content = new its_books();
    $new_catalog = $add_view_content->view_books($GLOBALS['BOOKS']);
    $action='Книга обновлена!';
    $book_upd = array("book_id"=> $newID, "type"=> $type, "author"=> $author,"name"=> $name, "year"=>$year, 'action' => $action);
    echo json_encode(array('success'=>$result,'books'=>$new_catalog,'book_upd'=>$book_upd,"action" => $action));
    exit;
}

if($action_check=='del'){

    $name = $_POST['BDName'];
    $type = $_POST['BDType'];
    $author = $_POST['BDAuthor'];
    $year = $_POST['BDYear'];
    $newID=$_POST['BDID'];
    $result = del_book($newID);
    //Обновление списка каталога
    connect_bd();
    $add_view_content = new its_books();
    $new_catalog = $add_view_content->view_books($GLOBALS['BOOKS']);
    $action='Книга удалена!';
    $book_del = array("book_id"=> $newID, "type"=> $type, "author"=> $author,"name"=> $name, "year"=>$year, 'action' => $action);
    echo json_encode(array('success'=>$result,'books'=>$new_catalog,'book_del'=>$book_del));
    exit;
}
