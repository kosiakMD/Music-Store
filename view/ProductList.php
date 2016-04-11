<span>
	<?foreach($template['FULL_PATH'] as $value):?>
		<a href="<?=$value['URL']?>">
			<?=$value['NAME']?>
		</a>
		<?if(!$value['IS_LAST']):?>
			<span>»</span>
		<?endif;?>
	<?endforeach;?>
</span>

<?if(isset($template["CATEGORY_INFO"])):?>
	<div id="common_title">
		<h6><?=$template["CATEGORY_INFO"]["NAME"];?></h6>
		<img src="/images/<?=$template["CATEGORY_INFO"]["IMAGE"];?>" alt="<?=$template["CATEGORY_INFO"]["NAME"];?>">
	</div>
<?endif;?>
<hr>
<br>
<?if(isset($template["BRAND_INFO"])):?>
	<div id="common_title">
		<h6><?=$template["BRAND_INFO"]["NAME"];?></h6>
		<img src="/images/<?=$template["BRAND_INFO"]["IMAGE"];?>" alt="<?=$template["BRAND_INFO"]["NAME"];?>">
	</div>
<?else:?>
	<?foreach($template["CHILD_BRANDS"] as $value):?>
		<a href="/shop/<?=$template["CATEGORY_PATH_STRING"]."/".$value["CODE"];?>/">
			<?=$value["NAME"];?>
		</a>
	<?endforeach;?>
<?endif;?>
<hr>
<br>

<?if(isset($template["SUB_CATEGORIES"])):?>
<div id="common_info">
	<table cellpadding="5" cellspacing="0" class="catalog">
		<tbody>
				<?for($i = 0; $i < count($template["SUB_CATEGORIES"]); $i += 2):?>
					<?$value1 = $template["SUB_CATEGORIES"][$i];?>
					<?$value2 = isset($template["SUB_CATEGORIES"][$i + 1]) ? $template["SUB_CATEGORIES"][$i + 1] : null;?>
					<tr valign="top">
						<td class="catalog-item">
							<a href="<?=$value1['URL'];?>" title="<?=$value1['NAME'];?>">
								<img src="/images/<?=$value1['IMAGE'];?>" alt="<?=$value1['NAME'];?>">
							</a>

							<h3>
								<a href="<?=$value1['URL'];?>">
									<?=$value1['NAME'];?>
								</a>
							</h3>
						</td>
						<?if(!is_null($value2)):?>
						<td class="catalog-item">
							<a href="<?=$value2['URL'];?>" title="<?=$value2['NAME'];?>">
								<img src="/images/<?=$value2['IMAGE'];?>" alt="<?=$value2['NAME'];?>">
							</a>

							<h3>
								<a href="<?=$value2['URL'];?>">
									<?=$value2['NAME'];?>
								</a>
							</h3>
						</td>
						<?endif;?>
					</tr>
				<?endfor;?>
		</tbody>
	</table>
	<br>
	<hr>
</div>
<?endif;?>

<?if(!empty($template["ITEM_LIST"])):?>
	<?foreach($template["ITEM_LIST"] as $value):?>
		<div class="list-item" id="id-item-<?=$value["ID"];?>">
			<table border="0" cellpadding="0" cellspacing="6" width="100%">
				<tr valign="top">
					<td width="150">
						<a href="/images/<?=$value["IMAGE_NAME"];?>">
							<img alt="" src="/images/<?=$value["IMAGE_NAME"];?>">
						</a>
					</td>
					<td>
						<a style="font-size:16px" href="/shop/<?=$value["ID"];?>">
							<?=$value["NAME"];?>
						</a>
						<div style="margin-top:10px;"></div>
						<div style="margin-top:10px; font-size:10px;">
							<?=$value["DESCRIPTION"];?>
						</div>

						<div style="font-size: 14px; margin:10px 0;">
							<span class="price"><?=$value["PRICE"];?></span>
						</div>

						<div class="basket"><img src="/images/bdone.png"alt="">
						</div>
					</td>
				</tr>
			</table>
		</div>
	<?endforeach;?>
	<?if(isset($template["PAGER"])):?>
		<?foreach($template["PAGER"]["PREV"] as $prev_page):?>
			<a href='<?=$template['BASE_URL'] . "/page".strval($prev_page)."/";?>'>
				<?=$prev_page + 1?>
			</a>
		<?endforeach;?>
		<span>
			<?=$template["PAGER"]["CURRENT"] + 1;?>
		</span>
		<?foreach($template["PAGER"]["NEXT"] as $next_page):?>
			<a href='<?=$template['BASE_URL'] . "/page".strval($next_page)."/";?>'>
				<?=$next_page + 1?>
			</a>
		<?endforeach;?>
	<?endif;?>
<?endif;?>

												