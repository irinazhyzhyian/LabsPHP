<?php  session_start();
define("INDEX", ""); // встановлення константи головного контроллера

require_once($_SERVER[DOCUMENT_ROOT]."/cfg/core.php"); // підключення ядра

// підключення до БД
$db = new MyDB();
$db->connect();

// головний констроллер
if($_GET[act]){
    include($_SERVER[DOCUMENT_ROOT]."/admin/".$_GET[act].".php");
}
else{
    unset($_SESSION[login]);
    unset($_SESSION[password]);
    include($_SERVER[DOCUMENT_ROOT]."/admin/home.php");
}
?>

