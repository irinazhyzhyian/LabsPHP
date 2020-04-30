<?defined('INDEX') OR die('Прямий доступ до сторінки заборонено!');
    $db->run("SELECT id, page_title FROM pages");
    while($db->fetch())
        $pages[$db->fetch[id]] = $db->fetch[page_title];
?>
<!Doctype html>
<html>
<head>
    <title>Завантаження файлів</title>
    <link rel="stylesheet" type="text/css" href="/css/style_form.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body style="padding-left: 50px;">
<form enctype='multipart/form-data' method=post>
    <input type='hidden' name='MAX_FILE_SIZE' value='1000000'>
    <h3>Завантажити:</h3> <input name='upfile' type=file>
    <br>
    <select size="1" name="id_page">
		<option value="0" selected>--Сторінка, до якої "прив'язати" зображення--</option>
					<?php foreach ($pages as $key=>$value) { ?>
					<option value="<?=$key;?>"><?=$value;?></option>
					<?php } ?>
    </select>
    <br>
    <input type='text' name='title' value='ФОТО'><br/>
    <input type=submit name='submit' value='OK' File>
</form> <br><br>
<a href='?act=home' class='btn btn-info' style='margin-left:20px;'><- Повернутись</a><br>
</body>
</html>

<?
if(isset($_POST[submit])){
try {
    if (
        !isset($_FILES['upfile']['error']) ||
        is_array($_FILES['upfile']['error'])
    ) {
        throw new RuntimeException('<h3>Неправильні параметри.</h3>');
    }

    switch ($_FILES['upfile']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('<h3>Жодного файлу не вибрано.</h3>');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('<h3>Перевищено ліміт розміру файлів.</h3>');
        default:
            throw new RuntimeException('Невідома помилка.');
    }

    if ($_FILES['upfile']['size'] > 1000000) {
        throw new RuntimeException('<h3>Перевищено ліміт розміру файлів.</h3>');
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES['upfile']['tmp_name']),
        array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        ),
        true
    )) {
        throw new RuntimeException('<h3>Неправильний формат файлу.</h3>');
    }
    $data = sprintf('%s.%s', sha1_file($_FILES['upfile']['tmp_name']),$ext); 
    if (!move_uploaded_file(
        $_FILES['upfile']['tmp_name'],
        sprintf('../images/%s', $data))) {
        throw new RuntimeException('<h3>Не вдалося перемістити завантажений файл.</h3>');
    }
    if($_POST[id_page]!=0)
        $db->run('INSERT INTO `images`(`img_name`, `img_path`, `id_page`, `title`) VALUES ("'.$data.'", "/images", "'.$_POST[id_page].'", "'.$_POST[title].'")');
    else
        $db->run('INSERT INTO `images`(`img_name`, `img_path`, `title`) VALUES ("'.$data.'", "/images", "'.$_POST[title].'")');
    echo '<h3>Файл успішно завантажено!</h3>';

} catch (RuntimeException $e) {

    echo $e->getMessage();

}
}
?>