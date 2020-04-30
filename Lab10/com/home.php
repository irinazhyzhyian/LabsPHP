<?php defined('INDEX') OR die('Прямий доступ до сторінки заборонено!');
/* компоненти сторінки */
$query = "SELECT * FROM pages WHERE page_alias='home' AND page_publish='Y' LIMIT 1";
$db->run($query);
$db->row();
// змінні коспонента
$id = $db->data[id];
$alias = $db->data[page_alias];
$title = $db->data[page_title];
$h1 = $db->data[page_h1];
$s_desc = $db->data[page_s_desc];
$component = $db->data[page_content];
$img_query = "SELECT * FROM images WHERE id_page=".$id;
$db->run($img_query);
$images = [];
$i = 0;
while($db->fetch()){
    $images[$i]['name'] = $db->fetch['img_name'];
    $images[$i]['path'] = $db->fetch['img_path'];
    $i++;
}
// якщо сторінки не існує
if (!$id) {
header("HTTP/1.1 404 Not Found");
$component = "Помилка 404! Сторінки не існує ;(";
}
$db->stop();