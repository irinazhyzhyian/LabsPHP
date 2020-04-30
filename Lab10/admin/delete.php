<?defined('INDEX') OR die('Прямий доступ до сторінки заборонено!');
    header('Location: ?act=home');
    $id=$_GET[id];
    $table=$_GET[table];
    $db->run("DELETE FROM ".$table." WHERE id=".$id);

?>
