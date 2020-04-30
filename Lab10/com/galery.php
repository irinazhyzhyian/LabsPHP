<?php defined('INDEX') OR die('Прямий доступ до сторінки заборонено!');
/* компоненти сторінки */
$query = "SELECT * FROM images";
$db->run($query);
$images = [];
$i = 0;
while($db->fetch()){
    $images[$db->fetch['id']]['name'] = $db->fetch['img_name'];
    $images[$db->fetch['id']]['path'] = $db->fetch['img_path'];
    $images[$db->fetch['id']]['title'] = $db->fetch['title'];
    $i++;
}
if (count($images)==0) {
header("HTTP/1.1 404 Not Found");
$component = "Помилка 404! Сторінки не існує ;(";
}
$db->stop();
?>