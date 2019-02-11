<?php
require ($_SERVER['DOCUMENT_ROOT'].'/components/class.php');
//Используем что бы вывести первый раз
$book_c= new its_books();
$result=$book_c->view_books($GLOBALS['BOOKS']);
$GLOBALS['VIEW_BOOKS']=$result;
