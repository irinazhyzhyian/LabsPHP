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
	<title>Галерея</title>
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
	<style>
		.hovergallery img{
			-webkit-transform:scale(0.8); 
			-moz-transform:scale(0.8); 
			-o-transform:scale(0.8); 
			-webkit-transition-duration: 0.5s; 
			-moz-transition-duration: 0.5s; 
			-o-transition-duration: 0.5s; 
			opacity: 0.9; 
			margin: 0 10px 5px 0; 
		}

		.hovergallery img:hover{
		-webkit-transform:scale(1.1); 
		-moz-transform:scale(1.1); 
		-o-transform:scale(1.1); 
		box-shadow:0px 0px 30px gray; 
		-webkit-box-shadow:0px 0px 30px gray; 
		-moz-box-shadow:0px 0px 30px gray; 
		opacity: 1;
		}
	</style>

	
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
					<li><a href="/" class="stretched-link"><?=$value;?></a></li>
			<?}else{?>
				<li><a href="index.php?option=page&alias=<?=$key;?>" class="stretched-link"><?=$value;?></a></li>
			<?php }} ?>
			<li><a href="index.php?option=galery" class="stretched-link">Галерея</a></li>
        </ul>
	</div>

	<div class="center">	
		<div class="content">
			<h1>Галерея</h1>
			<?if(count($images)>0){
				?><div class="hovergallery"><?
				foreach($images as $img){?>
					<img src='<?=$img['path']."/".$img['name']?>' style="width: 500px; height: 500px;" title='<?=$img['title']?>'/>
				<?}?>
				</div>
			<?}?>
		</div>			
	</div>
	<div class="empty"></div>
</div>
	<div id="footer" style="text-align: center;">
		&copy;2020, Ірина Жижиян
	</div>
</body>
</html>