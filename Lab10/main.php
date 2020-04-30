<?
$query = "SELECT page_alias, page_title FROM pages";
$db->run($query);
$pages = [];
$i = 0;
while($db->fetch()){
    $pages[$db->fetch['page_alias']] = $db->fetch['page_title'];
}
$db->stop();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?=$title?></title>
	<link rel="stylesheet" type="text/css" href="/css/style_verstca.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
		  	$("#menu").click(function(){ 		
				$("#menu").animate({		
			  		width: 250    		
				});
				$("#cont").css('visibility', 'visible');			
		  	});
			$("#menu").hover(function(){ 		
				$("#menu").animate({	
		  			width:100    	
				});
				$("#cont").css('visibility', 'hidden');
	 		});
		});
		
	</script>
	
</head>
<body>

<div class="wrapper">
	<div id="header">
	<h1 style="font-family: 'Le Murmure Regular'; font-size:50px; color: white; float:left; padding-bottom:20px;">Для гордої і владної душі життя і воля – на горі високій...</h1>
	</div>
	<div id="menu">
		<img src="/images/menu.png" style="margin-left: 25px;">
        <ul id="cont">
			<?php foreach ($pages as $key=>$value) { 
				if($key=='home'){?>
					<li><a href="index.php" class="stretched-link"><?=$value;?></a></li>
			<?}else{?>
				<li><a href="index.php?option=page&alias=<?=$key;?>" class="stretched-link"><?=$value;?></a></li>
			<?php }} ?>
			<li><a href="index.php?option=galery" class="stretched-link">Галерея</a></li>
        </ul>
	</div>

	<div class="center">	
		<div class="content">
			<img src=<?=$images[0]['path']."/".$images[0]['name']?> style="float: right; margin:40px; box-shadow: 5px 5px grey; width: 300px; height:390px;">
			<br>
			<h1> <?=$h1?></h1>
			<h3 style="font-style:italic;"><?=$s_desc?></h3>
			<img src=<?=$images[1]['path']."/".$images[1]['name']?> style="float: left; margin:40px; box-shadow: 10px 10px grey;">
			<?=$component?>
		</div>			
	</div>
	<div class="empty"></div>
</div>
	<div id="footer" style="text-align: center;">
		&copy;2020, Ірина Жижиян
	</div>
</body>
</html>