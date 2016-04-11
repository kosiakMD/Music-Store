
<div id='messages'>
	<?foreach($template["MESSAGES"] as $value):?>
		<div class='message'>
			<?=$value["MESSAGE"];?>
		</div>
	<?endforeach;?>
</div>
<div id='AUTH_WR'>
<?if($template['STATE'] == "UNAUTHORIZED"):?>
	<form action='' method='get'>
		<input type='hidden' name='action' value='login'>
		<label for='username'>Username</label>
		<input type='text' name='username'/>
		<label for='password'>Password</label>
		<input type='password' name='password'/>
		<input type='submit' value='Login'/>
	</form>
<?else:?>
	<form action='' method='get'>
		<input type='hidden' name='action' value='logout'/>
		<input type='submit' value='Logout'/>
	</form>
<?endif;?>
</div>