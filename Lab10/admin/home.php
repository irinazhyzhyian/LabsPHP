<? 
defined('INDEX') OR die('Прямий доступ до сторінки заборонено!');
$echo = "<div class='table'>

<div class='table-title'>Зайти в панель адміністратора</div>
<div class='container'>
   <form method='post' id='login-form'>
      <div class='row'>
      <div class='col-label'>
         <label for='login'>Логіе</label>
      </div>
      <div class='col-item'>
         <input type='text' placeholder='Логин' name='login'id='login' required><br>
      </div>
      </div>
      <div class='row'>
      <div class='col-label'>
         <label for='pass'>Пароль</label>
      </div>
      <div class='col-item'>
         <input type='password' placeholder='Пароль'id='pass' name='password' required><br>
      </div>
      </div>
      <input type='submit' value='Увійти' class='button'>
   </form>
 </div>

</div>";
function login($login,$password) {
    $db = new MyDB();
    $db->connect();
    $db->run("SELECT * FROM users WHERE `login` = '".$login."' AND `password` = '".$password."'");
    $db->fetch();
   if(!$db->data[id]) {   
        unset($_SESSION[login]);
        unset($_SESSION[password]);
        return false;
   } else {
        return true;
   }
}

if($_GET[logout]==true){
    $_SESSION[login]=null;
    $_SESSION[password]=null;
    unset($_SESSION[login],$_SESSION[password]);
    session_destroy();

}

if(isset($_POST[login]) && isset($_POST[password])) {
    $_SESSION[login] = $_POST[login];
    $_SESSION[password] = $_POST[password];
}

if(isset($_SESSION[login]) && isset($_SESSION[password])) {
    if(login($_SESSION[login],$_SESSION[password])) {
        $echo = null; //видаляємо форму авторизації

        if($db->run("SELECT * FROM pages")!==false) {
            while($db->fetch()) {
                $pages.= "<ul class='list-group'>
                            <li class='list-group-item list-group-item-action'><a href='?act=page&option=edit&id=".$db->fetch["id"]."'>".$db->fetch["page_title"]."</a>&nbsp;
                            <a class='badge badge-danger' href='?act=delete&table=pages&id=".$db->fetch["id"]."'>Видалити</a></li>
                          </ul>";
            
            }
        } else {
            $pages = "Сторінок немає!";
            }
        if($db->run("SELECT * FROM users")!==false) {
            while($db->fetch()) {
                $users .= "<ul class='list-group'>
                              <li class='list-group-item list-group-item-action'><a href='?act=user&option=edit&id=".$db->fetch["id"]."'>".$db->fetch["login"]."</a>
                              <a class='badge badge-danger' href='?act=delete&table=users&id=".$db->fetch["id"]."'>Видалити</a></li>
                           </ul>";
            }
        } else {
            $users = "Користувачів нема!";
            }

        if($db->run("SELECT * FROM images")!==false){
            while($db->fetch()) {
            $images .=  "<ul class='list-group'>
            <li class='list-group-item list-group-item-action'><a href='?act=edit_images&id=".$db->fetch["id"]."'>".$db->fetch["img_path"]."/".$db->fetch["img_name"]."</a>
            <a class='badge badge-danger' href='?act=delete&table=images&id=".$db->fetch["id"]."'>Видалити</a></li>
         </ul>";
            }

        } else {
            $images = "Зображень немає!";
        }
        if($db->run("SELECT * FROM works")!==false) {
            while($db->fetch()) {
                $works .=  "<ul class='list-group'>
                <li class='list-group-item list-group-item-action'><a href='?act=work&option=edit&id=".$db->fetch["id"]."'>".$db->fetch["title"]."</a>
                <a class='badge badge-danger' href='?act=delete&table=works&id=".$db->fetch["id"]."'>Видалити</a></li>
             </ul>";
                }
        }
        $echo = "<div class='table-title'>Публікації</div>".$pages."
                <br/><a class='btn btn-info' style='margin-left:20px;' href='?act=page&option=add'>+ Додати</a><br/><br/>
                <div class='table-title'>Користувачі</div><br>".$users."
                <br/><a href='?act=user&option=add' class='btn btn-info' style='margin-left:20px;' id='add_user'>+ Додати<a><br/><br/>
                <div class='table-title'>Зображення</div><br>".$images."<br/>
                <a class='btn btn-info' style='margin-left:20px;' href='?act=upload_file'>Завантажити картинку на сервер та БД</a><br/><br>
                <div class='table-title'>Твори</div>".$works."
                <br/><a class='btn btn-info' style='margin-left:20px;' href='?act=work&option=add'>+ Додати</a><br/><br/>
                <a class='btn btn-info' style='margin-left:20px;' href='/'>На головну</a><br/><br>
                <a class='btn btn-info' style='margin-left:20px;' href='?logout=true' >Вийти з панелі</a><br/><br>";
    } }
?>
<!Doctype html>
<html>
<head>

    <title>Адмін панель</title>
    <link rel="stylesheet" type="text/css" href="/css/style_form.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main>
        <?echo $echo;?>
    </main>
    
</body>
</html>