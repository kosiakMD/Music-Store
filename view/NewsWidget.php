<div class="block_title">Новости
</div>
<div class="block_content">
	<?foreach($template["NEWS_ITEM"] as $key => $value):?>
	<div class="block_news">
		<span><?=$value["DATE"]?></span>
		<p>
			<a href="<?="/news/".$value['CODE']."/";?>">
				<?=$value["TITLE"];?>
			</a>
		</p>
	</div>
	<?endforeach;?>
</div>
<div class="block_bottom">
</div>