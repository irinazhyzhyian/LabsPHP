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
			$(".slideT").hide();
    		$(".pointer").click(function () {
        	$(this).children(".slideT").slideToggle("slow");
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
					<li><a href="/" class="stretched-link"><?=$value;?></a></li>
			<?}else{?>
				<li><a href="index.php?option=page&alias=<?=$key;?>" class="stretched-link"><?=$value;?></a></li>
			<?php }} ?>
			<li><a href="index.php?option=galery" class="stretched-link">Галерея</a></li>
        </ul>
	</div>

	<div class="center">	
		<div class="content" >
			<h1 > <?=$h1?></h1>
			<?if(count($images)>0){ ?>
				<ul id="slides" style="text-align:center;">
				<img class="showing slides" src='<?=$images[0]['path']."/".$images[0]['name']?>' width='500', height='400' > 
				<?for($i=1; $i<count($images); $i++){?>
				<img class="slide slides" src='<?=$images[$i]['path']."/".$images[$i]['name']?>'width='500', height='400'>
				<?}?>
				</ul>
				<script>
  				var slides = document.querySelectorAll('#slides .slides');
				var currentSlide = 0;
				var slideInterval = setInterval(nextSlide, 2000);
				function nextSlide(){
				slides[currentSlide].className = 'slide';
				currentSlide = (currentSlide+1)%slides.length;
				slides[currentSlide].className = 'showing';
				}
 				</script>
			<?}?>
			<h3 style="font-style:italic;"><?=$s_desc?></h3>
			<p><?=$component?></p>
			<?if(count($works)>0){ 
				foreach($works as $work){
					?>
					<div class="pointer" title='Клікни на мене щоб згорнути/розгорнути текст'>
						<h2><?=$work['title']?></h2>
						<span class="slideT" style="display: block; overflow: hidden;">
							<p><?=$work['text']?></p>
						</span>
					</div>
					<?
				}
			}?>
		</div>			
	</div>
	<div class="empty"></div>
</div>
	<div id="footer" style="text-align: center;">
		&copy;2020, Ірина Жижиян
	</div>
</body>
</html>