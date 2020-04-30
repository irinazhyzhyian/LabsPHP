<? defined('INDEX') OR die('Прямий доступ до сторінки заборонено!');
    if($_GET[option]=='edit'){
        $id = $_GET[id];
        $query = "SELECT * FROM pages WHERE id=".$id;
        if($db->run($query)!==false) {
            if(isset($_POST['submit'])) {
                $update = 'UPDATE pages SET `page_alias`="'.$_POST[page_alias].'", `page_title` ="'.$_POST[page_title].'", `page_h1`="'.$_POST[page_h1].'",
                `page_s_desc` ="'.$_POST[page_s_desc].'", `page_content` = "'.$_POST[page_content].'", `page_publish` ="'.$_POST[page_publish].'"  WHERE id='.$id;
                if($db->run($update)!==false) {
                    $db->run("SELECT * FROM pages WHERE id=".$id);
                    $message = "Дані оновлено!";
                }
            }
            $db->row();
            $page = $db->data; 
        }
    }
    else if($_GET[option]=='add'){
        $page = null;
        if(isset($_POST['submit'])&& isset($_POST[page_alias])&&isset($_POST[page_title])&&isset($_POST[page_h1])&&isset($_POST[page_content])&&isset($_POST[page_publish])) {
            $add = 'INSERT INTO `pages`( `page_alias`, `page_title`, `page_h1`, `page_s_desc`, `page_content`, `page_publish`) VALUES(
            "'.$_POST[page_alias].'", "'.$_POST[page_title].'", "'.$_POST[page_h1].'", "'.$_POST[page_s_desc].'", "'.$_POST[page_content].'", "'.$_POST[page_publish].'")';
            if($db->run($add)!==false) {
                $db->run("SELECT * FROM pages WHERE page_alias LIKE '".$_POST[page_alias]."' ");
                $message = "Дані додано!";
                $db->row();
                $page = $db->data;
            }  
            else 
                $message = "Помилка! ".$db->err;            
        } 
    }
    ?>
<!Doctype html>
<html>
<head>

    <title>Редакція сторінки</title>
    <link rel="stylesheet" type="text/css" href="/css/style_form.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class='table-title'>Редакція публікації</div>
        <div class='alert alert-warning' role='alert'>
        <?=$message?>
        </div>  
        <form method='post' class='user-form'>
        <div class='container'>
               <form method='post' id='login-form'>
               <div class='row'>
                  <div class='col-label'>
                     <label for='tit1'>Alias</label>
                  </div>
                  <div class='col-item'>
                     <input type='text' placeholder='Заголовок' required name='page_alias' id='tit1' value=<?=$page[page_alias]?>> <br>
                  </div>
                  </div>
                  <div class='row'>
                  <div class='col-label'>
                     <label for='tit'>Титулка</label>
                  </div>
                  <div class='col-item'>
                     <input type='text' placeholder='Заголовок' max='1000' length='100' required name='page_title' id='tit' value=<?=$page[page_title]?>><br>
                  </div>
                  </div>
                  <div class='row'>
                  <div class='col-label'>
                     <label for='tit2'>Заголовок</label>
                  </div>
                  <div class='col-item'>
                     <textarea name='page_h1' id='tit3'required><?=$page[page_h1]?></textarea><br>
                  </div>
                  </div>
                  <div class='row'>
                  <div class='col-label'>
                     <label for='tit3'>Короткий опис</label>
                  </div>
                  <div class='col-item'>
                    <textarea name='page_s_desc' id='tit3'required><?=$page[page_s_desc]?></textarea><br>
                  </div>
                  </div>
                  <div class='row'>
                  <div class='col-label'>
                  <label for='txt'>Контент</label>
                  </div>
                  <div class='col-item'>
                     <textarea name="page_content" id='txt'><?=$page[page_content]?></textarea><br>
                  </div>
                  </div>
                  <div class='row'>
                  <div class='col-label'>
                     <label for='dis'>Опублікувати</label>
                  </div>
                  <div class='col-item'>
                    <select size='1' name='page_publish'>
                        <option value='Y' selected>YES</option>
                        <option value='N'>No</option>
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
