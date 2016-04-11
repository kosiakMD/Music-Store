<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Главная</title>
	<link href="/css.css" rel="stylesheet" type="text/css" />
	<script src="/js/jquery.js" type="text/javascript"></script>
	<script src="/js/scripts.js" type="text/javascript"></script>
	<?if(is_array($header_meta)):?>
		<?foreach($header_meta as $name => $value):?>
			<meta name='<?=strtolower($name);?>' value='<?=$value?>'/>
		<?endforeach;?>
	<?endif;?>
</head>

<body>
	<div id="wrapper">
		<div id="header">
			<div id="logo" class="float_left">
				<a href="#"></a>
			</div>
			<div id="header_right">
				<div id="h_search">
					<form action="" style="margin: 0px; width:310px;" method="post">
						<input class="queryField" size="35" maxlength="35" name="query" type="text"/>
						<input value="Поиск" name="sfSbm" class="submForm" type="submit"/>
					</form> 
				</div>
			</div>
		</div>
		<div id="head_menu">
			<a href="index.html">Главная</a>
			<a href="about.html">О нас</a>
			<a href="contacts.html">Контакты</a>
			<a href="delivery.html">Оплата и доставка</a>
			<a href="garant.html">Гарантия</a>
			<a href="discount.html">Дисконт</a>
			<a href="rent.html">Аренда звука</a>
			<a href="#">Галерея</a>
			<a href="enter.html">Вход</a>
		</div>