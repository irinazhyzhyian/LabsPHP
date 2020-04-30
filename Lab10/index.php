<?php session_start();
define("INDEX", ""); // встановлення константи головного контроллера

require_once($_SERVER[DOCUMENT_ROOT]."/cfg/core.php"); // підключення ядра

// підключення до БД
$db = new MyDB();
$db->connect();

// головний констроллер
if($_GET[option]){
    include($_SERVER[DOCUMENT_ROOT]."/com/".$_GET[option].".php");
    if($_GET[option]=='galery')
        include ($_SERVER[DOCUMENT_ROOT]."/galery_template.php");
    else
        include ($_SERVER[DOCUMENT_ROOT]."/template.php");
}
else {
    include($_SERVER[DOCUMENT_ROOT]."/com/home.php");
    include ($_SERVER[DOCUMENT_ROOT]."/main.php");
}
?>