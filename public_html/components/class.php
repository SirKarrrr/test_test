<?php
require($_SERVER['DOCUMENT_ROOT'] . '/model/model.php');

class its_books
{
    public $res;
    //Обновление списка каталога
    public function view_books($books)
    {
        foreach ($books as $key => $book) {
            $this->res[] = $book;
        }
        return $this->res;
    }
}

?>