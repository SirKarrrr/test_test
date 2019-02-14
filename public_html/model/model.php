<?
require($_SERVER['DOCUMENT_ROOT'] . '/components/supfunc.php');

connect_bd();

function connect_bd()//
{
    unset($GLOBALS['BOOKS']);
    $link = mysqli_connect("localhost", "cb26558_test", "qwerty", "cb26558_test") or die("Ошибка " . mysqli_error($link));
    $query = mysqli_query($link, "SELECT * FROM `books`");
    while ($dataall = mysqli_fetch_array($query)) {
        $GLOBALS['BOOKS'][] = $dataall;
    }

}

function last_id_book()
{
    $link = mysqli_connect("localhost", "cb26558_test", "qwerty", "cb26558_test") or die("Ошибка " . mysqli_error($link));
    $query = mysqli_query($link, "SELECT MAX(ID) FROM `books`");
    while ($dataall = mysqli_fetch_array($query)) {
        $LastID = $dataall[0];
    }
    $GLOBALS['LAST_ID'] = $LastID;

}

function add_book($newID, $type, $author, $name, $year)
{

    $link = mysqli_connect("localhost", "cb26558_test", "qwerty", "cb26558_test") or die("Ошибка " . mysqli_error($link));
    $query = "INSERT INTO `books`(`ID`, `type`, `author`, `name`, `year`) VALUES ($newID,'$type','$author','$name',$year)";
    $result = mysqli_query($link, $query);
    return $result;
}
function upd_book($newID, $type, $author, $name, $year)
{

    $link = mysqli_connect("localhost", "cb26558_test", "qwerty", "cb26558_test") or die("Ошибка " . mysqli_error($link));
    $query = "UPDATE `books` SET `type`='$type',`author`='$author',`name`='$name',`year`=$year WHERE `ID`=$newID";
    $result = mysqli_query($link, $query);
    return $result;
}
function del_book($newID)
{

    $link = mysqli_connect("localhost", "cb26558_test", "qwerty", "cb26558_test") or die("Ошибка " . mysqli_error($link));
    $query = "DELETE FROM `books` WHERE `ID`=$newID";
    $result = mysqli_query($link, $query);
    return $result;
}


