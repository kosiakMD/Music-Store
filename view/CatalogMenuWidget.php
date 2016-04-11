<div class="block_title">Каталог</div>
<div class="block_content">
	<ul class="kat_list">
		<li>
			<div class="katalog">
				<a class="katalog" href="#">
					<span class="list_item" style="font-weight:bold;color:#C63;">Акция!!!</span>
				</a>
			</div>
		</li>
		<?foreach($template["CATEGORY_TREE"] as $tree):?>
			<li>
				<div class="katalog">
					<a class="katalog" href="/shop/<?=$tree['CODE'];?>/">
						<span class="list_item"><?=$tree["NAME"];?></span>
						<div class="list_corner">
							<img src="/images/17.gif" alt=""/>
						</div>
					</a>
				</div>
				<?if(is_array($tree["CHILD"]) && !empty($tree["CHILD"])):	?>
					<div class="ul_container">
						<ul class="drop">
							<?
							foreach($tree["CHILD"] as $child_tree) {
								RenderTree($child_tree, "/shop/$tree[CODE]");
							}
							?>
						</ul>
					</div>
				<?endif;?>
			</li>
		<?endforeach?>
	</ul>
</div>
<div class="block_bottom"></div>