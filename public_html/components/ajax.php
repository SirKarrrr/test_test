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
    $result = add_book($newID, $type, $author, $name, $year);
    //Обновление списка каталога
    connect_bd();
    $add_view_content = new its_books();
    $new_catalog = $add_view_content->view_books($GLOBALS['BOOKS']);
    echo json_encode($new_catalog);
    exit;
}

if($action_check=='upd'){

    $name = $_POST['BDName'];
    $type = $_POST['BDType'];
    $author = $_POST['BDAuthor'];
    $year = $_POST['BDYear'];

    $newID=$_POST['BDID'];
    $result = upd_book($newID, $type, $author, $name, $year);
    //Обновление списка каталога
    connect_bd();
    $add_view_content = new its_books();
    $new_catalog = $add_view_content->view_books($GLOBALS['BOOKS']);
    echo json_encode($new_catalog);
    exit;
}

if($action_check=='del'){

    $newID=$_POST['BDID'];
    $result = del_book($newID);
    //Обновление списка каталога
    connect_bd();
    $add_view_content = new its_books();
    $new_catalog = $add_view_content->view_books($GLOBALS['BOOKS']);
    echo json_encode($new_catalog);
    exit;
}
