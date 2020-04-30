<?defined('INDEX') OR die('Прямий доступ до сторінки заборонено!');
if($_GET[option]=='add'){
    $user = null;
    if(isset($_POST['submit'])&&isset($_POST[login])&&isset($_POST[password])) {
        $add = 'INSERT INTO `users`( `login`, `password`) VALUES("'.$_POST[login].'", "'.$_POST[password].'")';
        if($db->run($add)!==false) {
            $db->run("SELECT * FROM users WHERE login LIKE '".$_POST[login]."' ");
            $message = "Дані додано!";
            $db->row();
            $user = $db->data;
        }
        else 
            $message = "Помилка! ".$db->err;           
    } 
}
else if($_GET[option]=='edit'){
    $id = $_GET[id];
    $query = "SELECT * FROM users WHERE id=".$id;
    if($db->run($query)!==false) {
        if(isset($_POST[submit])&&isset($_POST[login])&&isset($_POST[password])) {
            $update = 'UPDATE users SET `login` ="'.$_POST[login].'", `password` ="'.$_POST[password].'" WHERE id='.$id;
            if($db->run($update)!==false) {
                $db->run("SELECT * FROM users WHERE id=".$id);
                $message = "Дані оновлено!";
            }
        }
        $db->row();
        $user = $db->data; 
    }
}
    ?>
<!Doctype html>
<html>
<head>

    <title>Додати користувача</title>
    <link rel="stylesheet" type="text/css" href="/css/style_form.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class='table-title'>Додати користувача</div>
        <div class='alert alert-warning' role='alert'>
        <?=$message?>
        </div>  
        <div class='table'>

<div class='container'>
   <form method='post' id='login-form'>
      <div class='row'>
      <div class='col-label'>
         <label for='login'>Логін</label>
      </div>
      <div class='col-item'>
         <input type='text' placeholder='Логин' name='login'id='login' required value=<?=$user[login]?>><br>
      </div>
      </div>
      <div class='row'>
      <div class='col-label'>
         <label for='pass'>Пароль</label>
      </div>
      <div class='col-item'>
         <input type='password' placeholder='Пароль'id='pass' name='password' required value=<?=$user[password]?>><br>
      </div>
      </div>
      <input type='submit' name='submit' value='ОК' class='button'>
   </form>
 </div>
</div>
<a href='?act=home' class='btn btn-info' style='margin-left:20px;'><- Повернутись</a><br>     
</body>
</html>