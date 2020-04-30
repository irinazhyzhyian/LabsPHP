<?
defined('INDEX') OR die('Прямий доступ до сторінки заборонено!');
if($_GET[option]=='edit'){
$id = $_GET[id];
$query = "SELECT * FROM works WHERE id=".$id;
if($db->run($query)!==false) {
    if(isset($_POST['submit']) && isset($_POST[title]) && isset($_POST[text]) && isset($_POST[id_page])) {
        if($_POST[id_page]!=0)
            $update = 'UPDATE works SET `title`="'.$_POST[title].'", `text` ="'.$_POST[text].'", `id_page`="'.$_POST[id_page].'"  WHERE id='.$id;
        else
            $update = 'UPDATE works SET `title`="'.$_POST[title].'", `text` = "'.$_POST[text].'" WHERE id='.$id;      
        if($db->run($update)!==false) {
            $db->run("SELECT * FROM works WHERE id=".$id);
            $message = "Дані оновлено!";
        }
    }
    $db->row();
    $work = $db->data; 
}
}else if($_GET[option]=='add'){
    if(isset($_POST['submit']) && isset($_POST[title]) && isset($_POST[text]) && isset($_POST[id_page])) {
        if($_POST[id_page]!==0)
            $update = 'INSERT INTO `works`(`title`, `text`, `id_page`) VALUES("'.$_POST[title].'", "'.$_POST[text].'", "'.$_POST[id_page].'")';
        else
            $update = 'INSERT INTO `works`(`title`, `text`) VALUES( "'.$_POST[title].'", "'.$_POST[text].'")';      
        if($db->run($update)!==false) {
            $db->run('SELECT * FROM `works` WHERE `title` LIKE "'.$_POST[title].'"');
            $message = "Дані додано!";
            $db->row();
            $work = $db->data; 
        }
    }
}
?>
<!Doctype html>
<html>
<head>

    <title>Редакція роботи</title>
    <link rel="stylesheet" type="text/css" href="/css/style_form.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class='table-title'>Редакція публікації</div>
        <div class='alert alert-warning' role='alert'>
        <?=$message?>
        </div>  
        <?
    $db->run("SELECT id, page_title FROM pages");
    while($db->fetch())
        $pages[$db->fetch[id]] = $db->fetch[page_title];
?>
<form method='post' class='user-form'>
        <div class='container'>
               <form method='post' id='login-form'>
               <div class='row'>
                  <div class='col-label'>
                     <label for='tit1'>Заголовок</label>
                  </div>
                  <div class='col-item'>
                    <textarea name='title' id='tit1'required><?=$work['title']?></textarea><br>
                  </div>
                  </div>
                  <div class='row'>
                  <div class='col-label'>
                     <label for='tit2'>Текст</label>
                  </div>
                  <div class='col-item'>
                     <textarea name='text' id='tit2'required><?=$work['text']?></textarea><br>
                  </div>
                  </div>
                  <div class='row'>
                  <div class='col-label'>
                     <label for='dis'>Прив'язка</label>
                  </div>
                  <div class='col-item'>
                  <select size="1" name="id_page">
		            <option value="0" selected>--Сторінка, до якої "прив'язати"--</option>
                    <?php foreach ($pages as $key=>$value) { 
                        if($work[id_page]==$key){?>
                            <option selected value="<?=$key;?>"><?=$value;?></option>
                        <?} else {?>
					        <option value="<?=$key;?>"><?=$value;?></option>
					<?php } } ?>
                 </select>
                  </div>
                  </div><br>
                  <input type='submit' name ="submit" class='button' value='OK'>
                  </div>
                  </div>
               </form>
        </div>
        <a href='?act=home' class='btn btn-info' style='margin-left:20px;'><- Повернутись</a><br>   
</body>
</html>
