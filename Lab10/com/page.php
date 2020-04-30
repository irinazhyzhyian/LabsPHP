<?php defined('INDEX') OR die('Прямий доступ до сторінки заборонено!');
/* компоненти сторінки */
$alias = $_GET[alias];
$query = "SELECT * FROM pages WHERE page_alias='".$alias."' AND page_publish='Y' LIMIT 1";
$db->run($query);
$db->row();
// змінні компонента
$id = $db->data[id];
$alias = $db->data[page_alias];
$title = $db->data[page_title];
$h1 = $db->data[page_h1];
$s_desc = $db->data[page_s_desc];
$component = $db->data[page_content];
$db->run("SELECT * FROM images WHERE id_page=".$id);
$images = [];
$i = 0;
while($db->fetch()){
    $images[$i]['name'] = $db->fetch['img_name'];
    $images[$i]['path'] = $db->fetch['img_path'];
    $i++;
}
$db->run("SELECT * FROM works WHERE id_page = ".$id);
$works = [];
while($db->fetch()){
    $works[$db->fetch['id']]['title']=$db->fetch['title'];
    $works[$db->fetch['id']]['text']=$db->fetch['text'];

}
// якщо сторінки не існує
if (!$id) {
    header("HTTP/1.1 404 Not Found");
    $component = "Помилка 404! Сторінки не існує ;(";
}
$db->stop();
?>