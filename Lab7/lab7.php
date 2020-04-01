<?
require_once( "DB.php" );
require_once( "Country.php" );
require_once( "CountryLanguage.php" );
require_once( "Language.php" );
require_once( "Government.php" );
require_once( "Continent.php" );

$continentDB = new Continent();
$languageDB = new Language();
$governmentDB = new Government(); 

$continents = [];
	$result = $continentDB->select();
	while ($row = $result->fetch_assoc()) {
		$continents[$row['id_continent']] = $row['continent'];
	}
$language = [];
	$result = $languageDB->select();
	while ($row = $result->fetch_assoc()) {
		$language[$row['id_language']] = $row['language'];
	}
$gov = [];
	$result = $governmentDB->select();
	while ($row = $result->fetch_assoc()) {
		$gov[$row['id_government']] = $row['government'];
	}
?>
<html>
<head>
    <title>Лабораторна робота 7</title>
    <meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style_form.css" media="screen" />
</head>
<body>


<h1  align="center" style="font-family: 'Montserrat Alternates', monospace; color: white;">Країни світу<br>Лабораторна робота #7</h1> 
<br>
<div align="center" class="font_style">
<div align="right" class="container">
	<form method="POST">
		<div class="row">
			<div class="col-label">
				<label for="fname">Назва країни</label>
			</div>
			<div class="col-item">
				<input type="text" id="fname" name="name" maxlength="100"  placeholder="назва країни">
			</div>
		</div>
		<div class="row">
			<div class="col-label">
				<label for="continent">Континент</label>
			</div>
			<div class="col-item">
				<select size="1" name="continent">
					<option value="0" selected>--Континент--</option>
					<?php foreach ($continents as $key=>$value) { ?>
					<option value="<?=$key;?>"><?=$value;?></option>
					<?php } ?>
				</select>
				<!--<input type="submit" name="btnFindByContinent" value="Пошук">-->
			</div>
		</div>
		
		
		<div class="row">
			<div class="col-label">
				<label for="population">Кількість населення</label>
			</div>
			<div class="col-item">
				<input type="number" id="population" name="population" maxlength="20" min="0" placeholder="кількість населення">
			</div>
		</div>
		<div class="row">
			<div class="col-label">
				<label for="square">Площа (кв. м)</label>
			</div>
			<div  class="col-item">
				<input type="number" id="square" min="0" name="square">
			</div>
		</div>
		
		<div class="row">
			<div class="col-label">
				<label for="form_prav">Форма правління</label>
			</div>
			<div  class="col-item">
				<select size="1" name="government">
				<option value="0" selected>--Форма правління--</option>
					<?php foreach ($gov as $key=>$value) : ?>
					<option value="<?=$key;?>"><?=$value;?></option>
					<?php endforeach; ?>
				</select>
				<!--<input type="submit" name="btnFindByGovernment" value="Пошук">-->
			</div>
		</div>
		
		<div class="row">
			<div class="col-label">
				<label for="language">Державна мова</label>
			</div>
			<div  class="col-item">			
				<select name="language[]" multiple>
				<option value="0" selected>--Дердавна мова--</option>
					<?php foreach ($language as $key=>$value) : ?>
					<option value="<?=$key;?>"><?=$value;?></option>
					<?php endforeach; ?>
				</select>
				<!--<input type="submit" name="btnFindByLanguages" value="Пошук">-->
			</div>
		</div>
		

		<br>
		
		 <button type="submit" name="btnSubmit">Відправити дані</button>
		 <input type="reset" value="Очистити">
		 <button name="btnShow">Вміст таблиці БД</button>
		 <button name="btnSearch">Пошук</button>
		 <br>
		 <br>
	</form>

</div>
</div>
<?php


if (isset($_POST['btnSubmit']) && isset($_POST['name']) && $_POST['name']!="" ) {

	$name = $_POST['name'];
	$continent = $_POST['continent'];
	$population = $_POST['population'];
	$square = $_POST['square'];
	$government = $_POST['government'];
	$languages = $_POST['language'];

	if ($square=="") $square=0;
	if ($population=="") $population=0;
	
	if($continent==0 || $government==0)
			die("<h1 align='center'>Поля Континент та Форма правління є обов'язковми!</h1>");
	if($languages[0]==0)
		unset($languages[0]);
		

	/*$countryDB->setGovernment($government);
	$countryDB->setContinent($continent);
	$countryDB->setCountryName($name);
	$countryDB->setPopulation($population);
	$countryDB->setSquare($square);*/
	$gov = new Government();
	$gov->setGovernment($government);
	$cont = new Continent();
	$cont->setContinent($continent);
	$countryDB = new Country($name, $cont, $gov, $population, $square);
	$countryDB->insert();
	if($languages!=null)
	foreach ($languages as $language) {
		$lang = new Language();
		$lang->setLanguage($language);
		$coun_lanDB = new CountryLanguage($lang, $countryDB);
		$coun_lanDB->insert();
	}
	
	$res = DB::getCountryByName($name);
	$head = "Введені дані";
    
}

	if (isset($_POST['btnShow'])) {
		$res = DB::getAll();
		$head = "Вміст бази даних";
	}

	if(isset($_POST['btnSearch'])) {
		$name = $_POST['name'];
	   	$continent = $_POST['continent'];
	   	$population = $_POST['population'];
	  	$square = $_POST['square'];
	  	$government = $_POST['government'];
		$languages = $_POST['language'];

		if($continent==0)
			$continent = null;
		if($government==0)
			$government = null;
		if(count($languages)==1 && $languages[0]==0)
			$languages = null;
		if($languages[0]==0)
		 	unset($languages[0]);
		if($continent == null && $government==null && $languages==null && $name=="" && $population=="" && $square=="")
			die("<h1 align='center'>Ви не ввели жодні дані для пошуку</h1>");
		echo "<h1 align='center'>Здійснено пошук по всіх введених вище полях</h1>";
		$values = [
			"country_name" => $name,
			"id_continent" => $continent,
			"population" => $population,
			"square" => $square,
			"id_government" => $government,
			"id_language" => $languages
		];
		$res = DB::getObjectsByValues($values);
	}

	
   
    if($res!=null) {
		?>
				<br><br>
				<h3 align="center"> <?=$head?> </h3>
				<table border="1" cellspacing="0">
			<tr>
			<th> Назва країни</th>
			<th> Континент</th>
			<th> Кількість населення</th>
			<th> Площв (кв. м)</th>
			<th> Форма правління</th>
			<th> Державна мова</th>
		</tr>
		<?php
			foreach($res as $row){
		?>
					<tr>
						<?php foreach($row as $v): ?>
						<td><?=$v?></td>
						<?endforeach; 
				?>
					</tr>
		<?php
			}
		?>
		</table>
	<?php	} ?>
</body>
</html>
