<?defined('INDEX') OR die('Прямий доступ до сторінки заборонено!');
        $id = $_GET[id];
        $db->run("SELECT id, page_title FROM pages");
        while($db->fetch())
            $pages[$db->fetch[id]] = $db->fetch[page_title];
        $query = "SELECT * FROM images WHERE id=".$id;
        if($db->run($query)!==false) {
            if(isset($_POST[submit])&&isset($_POST[name])&&isset($_POST[path])&&isset($_POST[id_page])) {
                if($_POST[id_page]!=0)
                    $update = 'UPDATE images SET `img_name` ="'.$_POST[name].'", `img_path` ="'.$_POST[path].'", `title`= "'.$_POST[title].'", `id_page` ="'.$_POST[id_page].'" WHERE id='.$id;
                else
                    $update = 'UPDATE images SET `img_name` ="'.$_POST[name].'", `img_path` ="'.$_POST[path].'", `title`= "'.$_POST[title].'", `id_page` = null WHERE id='.$id;                  
                if($db->run($update)!==false) {
                    $db->run("SELECT * FROM images WHERE id=".$id);
                    $message = "Дані оновлено!";
                }
            }
            $db->row();
            $img = $db->data; 
        }
    ?>
<!Doctype html>
<html>
<head>

    <title>Редагувати користувача</title>
    <link rel="stylesheet" type="text/css" href="/css/style_form.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class='table-title'>Редагувати користувача</div>
        <div class='alert alert-warning' role='alert'>
        <?=$message?>
        </div>  
        <div class='table'>
    <div class='container'>
   <form method='post' id='login-form'>
      <div class='row'>
      <div class='col-label'>
         <label for='login'>Назва</label>
      </div>
      <div class='col-item'>
         <input type='text' placeholder='Назва' name='name'id='login' required value=<?=$img[img_name]?>><br>
      </div>
      </div>
      <div class='row'>
      <div class='col-label'>
         <label for='pass'>Шлях</label>
      </div>
      <div class='col-item'>
         <input type='text' placeholder='Шлях'id='pass' name='path' required value=<?=$img[img_path]?>><br>
      </div>
      </div>
      <div class='row'>
      <div class='col-label'>
         <label for='title'>Опис</label>
      </div>
      <div class='col-item'>
          <textarea id='title' name='title'><?=$img[title]?></textarea><br>
      </div>
      </div>
      <div class='row'>
      <div class='col-label'>
         <label for='p'>Сторінка</label>
      </div>
      <div class='col-item'>
      <select size="1" name="id_page">
		<option value="0">--Сторінка, до якої "прив'язати" зобрадення--</option>
					<?php foreach ($pages as $key=>$value) { 
                        if($img[id_page]==$key){?>
                            <option selected value="<?=$key;?>"><?=$value;?></option>
                        <?} else {?>
					        <option value="<?=$key;?>"><?=$value;?></option>
					<?php } } ?>
                </select>
        <br>
      </div>
      </div>
      <input type='submit' name='submit' value='ОК' class='button'>
   </form>
   <br/><img src='<?=$img[img_path]."/".$img[img_name]?>' style='width: 500px; height: 500px;'/><br/>
 </div>
</div>
<a href='?act=home' class='btn btn-info' style='margin-left:20px;'><- Повернутись</a><br>    
</body>
</html>
