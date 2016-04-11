<div id="way">
	<?foreach($template['FULL_PATH'] as $key => $value):?>
		<a href="<?=$value['URL'];?>">
			<?=$value['NAME'];?>
		</a>
		<?if(!$value['IS_LAST']):?>
			<span>»</span>
		<?endif;?>
	<?endforeach;?>
</div>

<h1 itemprop="name"><?=$template['PRODUCT_NAME'];?></h1>
	<div class="product">
		<img src="<?=$template['PRODUCT_IMAGE_URL'];?>">

		<div class="eval">
			<ul id="star"></ul>

			<div id="info" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
				Рейтинг: <span class="bold_rate" itemprop="ratingValue"><?=$template['RATING_VALUE'];?></span>/<span itemprop="reviewCount"><?=$template['RATING_COUNT'];?></span>
			</div>

			<div id="mark_info">
				<span id="prod_count">Единица:</span><span class="bold_rate"><?=$template['STORE_COUNT'];?></span>
			</div>
		</div>

		<div class="price_buy">
			<div id="buy" itemprop="offers" itemscope="" itemtype="http://schema.org/AggregateOffer">
				<span id="prod_price" itemprop="price"><?=$template['PRICE_FORMATED'];?></span>

					<div id="to_basket">
						<input type="text" value="1" id="toBask" size="3"><input type="button" value="в корзину">
					</div>
					<a href="order.html"></a>

					<div id="to_buy"></div>
				</div>
			</div>

			<div id="delivery"></div>

			<ul id="switch_page">
				<li><a href="#" id="fPage">Описание</a></li><li><a href="javascript:void(0);" id="sPage">Отзывы</a></li><li><a href="#" id="tPage">Характеристики</a></li>
			</ul>
		</div>

		<div id="descr" class="first_p">
			<div class="tab fPage vis">
				<font size="2"><strong style="font-size: 10pt;" itemprop="description">
					<?=$template['PRODUCT_DESCRIPTION'];?>
				</font><br>
					<br>
					<span id="iconsSync"><a class="iconC" rel="nofollow" href="#" onclick="withFacebook()" title="Поделиться в Facebook" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -16px 0" href="#" onclick="addGoogle()" title="Добавить +1 и поделиться в Google+" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -32px 0" href="http://www.liveinternet.ru/journal_post.php?action=n_add&amp;cnurl=http%3A%2F%2Fwww.robik-music.com%2Fshop%2F3140%2Fdesc%2Fbehringer-podcastudio-firewire&amp;cntitle=%D0%9A%D0%BE%D0%BC%D0%BF%D0%BB%D0%B5%D0%BA%D1%82%20%D0%B7%D0%B2%D1%83%D0%BA%D0%BE%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B8%20Behringer%20PODCASTUDIO%20FireWire%20%7C%D1%86%D0%B5%D0%BD%D0%B0%2C%20%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5%2C%20%D0%BE%D1%82%D0%B7%D1%8B%D0%B2%D1%8B%2C%20%D1%84%D0%BE%D1%82%D0%BE%2C%20%D0%BA%D1%83%D0%BF%D0%B8%D1%82%D1%8C%2C%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0%20%D0%B1%D0%B5%D1%81%D0%BF%D0%BB%D0%B0%D1%82%D0%BD%D0%BE%2C%20%D0%B7%D0%B0%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C.%20%D0%9C%D1%83%D0%B7%D1%8B%D0%BA%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%20%22Robik-Music%22" title="Опубликовать в LiveInternet" target="_blank"></a><a class="iconC" rel="nofollow" style="display:inline-block;vertical-align:bottom;width:16px;height:16px;margin:0 6px 6px 0;outline:none;background:url(http://www.robik-music.com/share42/icons.png) -48px 0" href="http://www.livejournal.com/update.bml?event=http%3A%2F%2Fwww.robik-music.com%2Fshop%2F3140%2Fdesc%2Fbehringer-podcastudio-firewire&amp;subject=%D0%9A%D0%BE%D0%BC%D0%BF%D0%BB%D0%B5%D0%BA%D1%82%20%D0%B7%D0%B2%D1%83%D0%BA%D0%BE%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B8%20Behringer%20PODCASTUDIO%20FireWire%20%7C%D1%86%D0%B5%D0%BD%D0%B0%2C%20%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5%2C%20%D0%BE%D1%82%D0%B7%D1%8B%D0%B2%D1%8B%2C%20%D1%84%D0%BE%D1%82%D0%BE%2C%20%D0%BA%D1%83%D0%BF%D0%B8%D1%82%D1%8C%2C%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0%20%D0%B1%D0%B5%D1%81%D0%BF%D0%BB%D0%B0%D1%82%D0%BD%D0%BE%2C%20%D0%B7%D0%B0%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C.%20%D0%9C%D1%83%D0%B7%D1%8B%D0%BA%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%20%22Robik-Music%22" title="Опубликовать в LiveJournal" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -64px 0" href="http://connect.mail.ru/share?url=http%3A%2F%2Fwww.robik-music.com%2Fshop%2F3140%2Fdesc%2Fbehringer-podcastudio-firewire&amp;title=%D0%9A%D0%BE%D0%BC%D0%BF%D0%BB%D0%B5%D0%BA%D1%82%20%D0%B7%D0%B2%D1%83%D0%BA%D0%BE%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B8%20Behringer%20PODCASTUDIO%20FireWire%20%7C%D1%86%D0%B5%D0%BD%D0%B0%2C%20%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5%2C%20%D0%BE%D1%82%D0%B7%D1%8B%D0%B2%D1%8B%2C%20%D1%84%D0%BE%D1%82%D0%BE%2C%20%D0%BA%D1%83%D0%BF%D0%B8%D1%82%D1%8C%2C%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0%20%D0%B1%D0%B5%D1%81%D0%BF%D0%BB%D0%B0%D1%82%D0%BD%D0%BE%2C%20%D0%B7%D0%B0%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C.%20%D0%9C%D1%83%D0%B7%D1%8B%D0%BA%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%20%22Robik-Music%22" title="Поделиться в Моем Мире@Mail.Ru" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -80px 0" href="http://www.myspace.com/Modules/PostTo/Pages/?u=http%3A%2F%2Fwww.robik-music.com%2Fshop%2F3140%2Fdesc%2Fbehringer-podcastudio-firewire&amp;t=%D0%9A%D0%BE%D0%BC%D0%BF%D0%BB%D0%B5%D0%BA%D1%82%20%D0%B7%D0%B2%D1%83%D0%BA%D0%BE%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B8%20Behringer%20PODCASTUDIO%20FireWire%20%7C%D1%86%D0%B5%D0%BD%D0%B0%2C%20%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5%2C%20%D0%BE%D1%82%D0%B7%D1%8B%D0%B2%D1%8B%2C%20%D1%84%D0%BE%D1%82%D0%BE%2C%20%D0%BA%D1%83%D0%BF%D0%B8%D1%82%D1%8C%2C%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0%20%D0%B1%D0%B5%D1%81%D0%BF%D0%BB%D0%B0%D1%82%D0%BD%D0%BE%2C%20%D0%B7%D0%B0%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C.%20%D0%9C%D1%83%D0%B7%D1%8B%D0%BA%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%20%22Robik-Music%22" title="Добавить в MySpace" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -96px 0" href="#" onclick="addMyspace()" title="Добавить в Одноклассники" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -112px 0" href="#" onclick="withTwitter()" title="Добавить в Twitter" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -128px 0" href="#" onclick="addContact()" title="Поделиться В Контакте" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -144px 0" href="http://zakladki.yandex.ru/newlink.xml?url=http%3A%2F%2Fwww.robik-music.com%2Fshop%2F3140%2Fdesc%2Fbehringer-podcastudio-firewire&amp;name=%D0%9A%D0%BE%D0%BC%D0%BF%D0%BB%D0%B5%D0%BA%D1%82%20%D0%B7%D0%B2%D1%83%D0%BA%D0%BE%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B8%20Behringer%20PODCASTUDIO%20FireWire%20%7C%D1%86%D0%B5%D0%BD%D0%B0%2C%20%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5%2C%20%D0%BE%D1%82%D0%B7%D1%8B%D0%B2%D1%8B%2C%20%D1%84%D0%BE%D1%82%D0%BE%2C%20%D0%BA%D1%83%D0%BF%D0%B8%D1%82%D1%8C%2C%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0%20%D0%B1%D0%B5%D1%81%D0%BF%D0%BB%D0%B0%D1%82%D0%BD%D0%BE%2C%20%D0%B7%D0%B0%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C.%20%D0%9C%D1%83%D0%B7%D1%8B%D0%BA%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%20%22Robik-Music%22" title="Добавить в Яндекс.Закладки" target="_blank"></a></span>
				</div>

				<div class="tab sPage unvis">
					<p>Всего комментариев: <span>0</span></p>

					<table cellspacing="1" cellpadding="2" class="commTable">
						<tbody>
							<tr>
								<td class="commTd1" nowrap="">Имя *:</td>

								<td class="commTd2"><input class="commFl" type="text" name="name" value="" size="30" maxlength="60"></td>
							</tr>

							<tr>
								<td class="commTd1">Email:</td>

								<td class="commTd2"><input class="commFl" type="text" name="email" value="" size="30" maxlength="60"></td>
							</tr>

							<tr>
								<td class="commTd2" colspan="2">
									<div style="padding-bottom:2px"></div>

									<table cellspacing="0" width="100%">
										<tbody>
											<tr>
												<td valign="top">
													<textarea class="commFl" style="height:135px;" rows="8" name="message" id="message" cols="50"></textarea></td>

													<td width="5%" valign="top" align="center" style="padding-left:3px;">
														<script type="text/javascript">
														function emoticon(code,nm){if (code != ""){var txtarea=document.getElementById(nm);code = ' ' + code + ' ';if (document.selection) {txtarea.focus();var txtContent = txtarea.value;var str = document.selection.createRange();if (str.text == ""){str.text = code;} else if (txtContent.indexOf(str.text) != -1){str.text = code + str.text;} else {txtarea.value = txtContent + code;}}else{txtarea.value = txtarea.value + code;}}}
														</script>

														<table cellpadding="2" class="smiles" onmouseover="document.getElementById('asmltrQ9ZdD').style.display='';" onmouseout="document.getElementById('asmltrQ9ZdD').style.display='none';">
															<tbody>
																<tr>
																	<td></td>
																</tr>

																<tr id="asmltrQ9ZdD" style="display:none;">
																	<td colspan="3" align="center" id="allSmiles" nowrap=""><a href="javascript://" rel="nofollow" onclick="new _uWnd('Sml',' ',-250,-350,{autosize:0,closeonesc:1,resize:0},{url:'/index/35-0-0'});return false;">
																		Все смайлы</a></td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>

									<tr class="commTd2" id="showAddonsFields">
										<td colspan="2" nowrap="1"><a href="javascript://" onclick="$(this).parent().parent().hide().next().show().next().show()">
											Указать плюсы и минусы</a></td>
										</tr>

										<tr class="commTd2" style="display:none;" id="hideAddonsFields">
											<td colspan="2"><a href="javascript://" onclick="$(this).parent().parent().prev().show().next().hide().next().hide()">
												Скрыть дополнительные поля</a></td>
											</tr>

											<tr class="commTd2" style="display:none;">
												<td colspan="2">
													<table cellspacing="0" width="100%">
														<tbody>
															<tr>
																<td><label>Плюсы:</label></td>
															</tr>

															<tr>
																<td valign="top">
																	<textarea class="prosFl" rows="3" name="pros" id="pros" cols="72"></textarea></td>
																</tr>

																<tr>
																	<td><label>Минусы:</label></td>
																</tr>

																<tr>
																	<td valign="top">
																		<textarea class="consFl" rows="3" name="cons" id="cons" cols="72"></textarea></td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>

													<tr class="capture">
														<td class="commTd1" nowrap="">Код *:</td>

														<td class="commTd2"><input class="securityCode" type="text" name="code" size="7" maxlength="6" style="padding:4px;font-size:20px;"><input type="hidden" name="seckey" value="628390191834915498"><img alt="" style="margin:0;padding:0;border:0;cursor:pointer;vertical-align:top;" id="secuImgC" align="absmiddle" title="Обновить код безопасности" onclick="this.src='http://www.robik-music.com/secure/?k=628390191834915498;m=addcom17114625;tm='+Math.random();" src="http://www.robik-music.com/secure/?k=628390191834915498;m=addcom17114625;tm=1366734488"><img alt="" src="http://s53.ucoz.net/img/ma/refresh.gif" border="0" align="absmiddle" style="cursor:pointer;" onclick="document.getElementById('secuImgC').src='http://www.robik-music.com/secure/?k=628390191834915498;m=addcom17114625;tm='+Math.random();" title="Обновить код безопасности"></td>
													</tr>

													<tr>
														<td class="commTd2" colspan="2" align="center"><input type="submit" class="commSbmFl" id="addcBut" name="submit" value="- Добавить комментарий -"></td>
													</tr>
												</tbody>
											</table><span id="iconsSync"><a class="iconC" rel="nofollow" href="#" onclick="withFacebook()" title="Поделиться в Facebook" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -16px 0" href="#" onclick="addGoogle()" title="Добавить +1 и поделиться в Google+" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -32px 0" href="http://www.liveinternet.ru/journal_post.php?action=n_add&amp;cnurl=http%3A%2F%2Fwww.robik-music.com%2Fshop%2F3140%2Fdesc%2Fbehringer-podcastudio-firewire&amp;cntitle=%D0%9A%D0%BE%D0%BC%D0%BF%D0%BB%D0%B5%D0%BA%D1%82%20%D0%B7%D0%B2%D1%83%D0%BA%D0%BE%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B8%20Behringer%20PODCASTUDIO%20FireWire%20%7C%D1%86%D0%B5%D0%BD%D0%B0%2C%20%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5%2C%20%D0%BE%D1%82%D0%B7%D1%8B%D0%B2%D1%8B%2C%20%D1%84%D0%BE%D1%82%D0%BE%2C%20%D0%BA%D1%83%D0%BF%D0%B8%D1%82%D1%8C%2C%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0%20%D0%B1%D0%B5%D1%81%D0%BF%D0%BB%D0%B0%D1%82%D0%BD%D0%BE%2C%20%D0%B7%D0%B0%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C.%20%D0%9C%D1%83%D0%B7%D1%8B%D0%BA%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%20%22Robik-Music%22" title="Опубликовать в LiveInternet" target="_blank"></a><a class="iconC" rel="nofollow" style="display:inline-block;vertical-align:bottom;width:16px;height:16px;margin:0 6px 6px 0;outline:none;background:url(http://www.robik-music.com/share42/icons.png) -48px 0" href="http://www.livejournal.com/update.bml?event=http%3A%2F%2Fwww.robik-music.com%2Fshop%2F3140%2Fdesc%2Fbehringer-podcastudio-firewire&amp;subject=%D0%9A%D0%BE%D0%BC%D0%BF%D0%BB%D0%B5%D0%BA%D1%82%20%D0%B7%D0%B2%D1%83%D0%BA%D0%BE%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B8%20Behringer%20PODCASTUDIO%20FireWire%20%7C%D1%86%D0%B5%D0%BD%D0%B0%2C%20%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5%2C%20%D0%BE%D1%82%D0%B7%D1%8B%D0%B2%D1%8B%2C%20%D1%84%D0%BE%D1%82%D0%BE%2C%20%D0%BA%D1%83%D0%BF%D0%B8%D1%82%D1%8C%2C%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0%20%D0%B1%D0%B5%D1%81%D0%BF%D0%BB%D0%B0%D1%82%D0%BD%D0%BE%2C%20%D0%B7%D0%B0%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C.%20%D0%9C%D1%83%D0%B7%D1%8B%D0%BA%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%20%22Robik-Music%22" title="Опубликовать в LiveJournal" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -64px 0" href="http://connect.mail.ru/share?url=http%3A%2F%2Fwww.robik-music.com%2Fshop%2F3140%2Fdesc%2Fbehringer-podcastudio-firewire&amp;title=%D0%9A%D0%BE%D0%BC%D0%BF%D0%BB%D0%B5%D0%BA%D1%82%20%D0%B7%D0%B2%D1%83%D0%BA%D0%BE%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B8%20Behringer%20PODCASTUDIO%20FireWire%20%7C%D1%86%D0%B5%D0%BD%D0%B0%2C%20%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5%2C%20%D0%BE%D1%82%D0%B7%D1%8B%D0%B2%D1%8B%2C%20%D1%84%D0%BE%D1%82%D0%BE%2C%20%D0%BA%D1%83%D0%BF%D0%B8%D1%82%D1%8C%2C%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0%20%D0%B1%D0%B5%D1%81%D0%BF%D0%BB%D0%B0%D1%82%D0%BD%D0%BE%2C%20%D0%B7%D0%B0%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C.%20%D0%9C%D1%83%D0%B7%D1%8B%D0%BA%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%20%22Robik-Music%22" title="Поделиться в Моем Мире@Mail.Ru" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -80px 0" href="http://www.myspace.com/Modules/PostTo/Pages/?u=http%3A%2F%2Fwww.robik-music.com%2Fshop%2F3140%2Fdesc%2Fbehringer-podcastudio-firewire&amp;t=%D0%9A%D0%BE%D0%BC%D0%BF%D0%BB%D0%B5%D0%BA%D1%82%20%D0%B7%D0%B2%D1%83%D0%BA%D0%BE%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B8%20Behringer%20PODCASTUDIO%20FireWire%20%7C%D1%86%D0%B5%D0%BD%D0%B0%2C%20%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5%2C%20%D0%BE%D1%82%D0%B7%D1%8B%D0%B2%D1%8B%2C%20%D1%84%D0%BE%D1%82%D0%BE%2C%20%D0%BA%D1%83%D0%BF%D0%B8%D1%82%D1%8C%2C%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0%20%D0%B1%D0%B5%D1%81%D0%BF%D0%BB%D0%B0%D1%82%D0%BD%D0%BE%2C%20%D0%B7%D0%B0%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C.%20%D0%9C%D1%83%D0%B7%D1%8B%D0%BA%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%20%22Robik-Music%22" title="Добавить в MySpace" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -96px 0" href="#" onclick="addMyspace()" title="Добавить в Одноклассники" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -112px 0" href="#" onclick="withTwitter()" title="Добавить в Twitter" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -128px 0" href="#" onclick="addContact()" title="Поделиться В Контакте" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -144px 0" href="http://zakladki.yandex.ru/newlink.xml?url=http%3A%2F%2Fwww.robik-music.com%2Fshop%2F3140%2Fdesc%2Fbehringer-podcastudio-firewire&amp;name=%D0%9A%D0%BE%D0%BC%D0%BF%D0%BB%D0%B5%D0%BA%D1%82%20%D0%B7%D0%B2%D1%83%D0%BA%D0%BE%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B8%20Behringer%20PODCASTUDIO%20FireWire%20%7C%D1%86%D0%B5%D0%BD%D0%B0%2C%20%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5%2C%20%D0%BE%D1%82%D0%B7%D1%8B%D0%B2%D1%8B%2C%20%D1%84%D0%BE%D1%82%D0%BE%2C%20%D0%BA%D1%83%D0%BF%D0%B8%D1%82%D1%8C%2C%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0%20%D0%B1%D0%B5%D1%81%D0%BF%D0%BB%D0%B0%D1%82%D0%BD%D0%BE%2C%20%D0%B7%D0%B0%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C.%20%D0%9C%D1%83%D0%B7%D1%8B%D0%BA%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%20%22Robik-Music%22" title="Добавить в Яндекс.Закладки" target="_blank"></a></span><br>
											<br>
										</div>

										<div class="tab tPage unvis">
											<?=$template['MANUFACTURER_DESCRIPTION']?><br>
											<span id="iconsSync"><a class="iconC" rel="nofollow" href="#" onclick="withFacebook()" title="Поделиться в Facebook" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -16px 0" href="#" onclick="addGoogle()" title="Добавить +1 и поделиться в Google+" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -32px 0" href="http://www.liveinternet.ru/journal_post.php?action=n_add&amp;cnurl=http%3A%2F%2Fwww.robik-music.com%2Fshop%2F3140%2Fdesc%2Fbehringer-podcastudio-firewire&amp;cntitle=%D0%9A%D0%BE%D0%BC%D0%BF%D0%BB%D0%B5%D0%BA%D1%82%20%D0%B7%D0%B2%D1%83%D0%BA%D0%BE%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B8%20Behringer%20PODCASTUDIO%20FireWire%20%7C%D1%86%D0%B5%D0%BD%D0%B0%2C%20%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5%2C%20%D0%BE%D1%82%D0%B7%D1%8B%D0%B2%D1%8B%2C%20%D1%84%D0%BE%D1%82%D0%BE%2C%20%D0%BA%D1%83%D0%BF%D0%B8%D1%82%D1%8C%2C%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0%20%D0%B1%D0%B5%D1%81%D0%BF%D0%BB%D0%B0%D1%82%D0%BD%D0%BE%2C%20%D0%B7%D0%B0%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C.%20%D0%9C%D1%83%D0%B7%D1%8B%D0%BA%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%20%22Robik-Music%22" title="Опубликовать в LiveInternet" target="_blank"></a><a class="iconC" rel="nofollow" style="display:inline-block;vertical-align:bottom;width:16px;height:16px;margin:0 6px 6px 0;outline:none;background:url(http://www.robik-music.com/share42/icons.png) -48px 0" href="http://www.livejournal.com/update.bml?event=http%3A%2F%2Fwww.robik-music.com%2Fshop%2F3140%2Fdesc%2Fbehringer-podcastudio-firewire&amp;subject=%D0%9A%D0%BE%D0%BC%D0%BF%D0%BB%D0%B5%D0%BA%D1%82%20%D0%B7%D0%B2%D1%83%D0%BA%D0%BE%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B8%20Behringer%20PODCASTUDIO%20FireWire%20%7C%D1%86%D0%B5%D0%BD%D0%B0%2C%20%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5%2C%20%D0%BE%D1%82%D0%B7%D1%8B%D0%B2%D1%8B%2C%20%D1%84%D0%BE%D1%82%D0%BE%2C%20%D0%BA%D1%83%D0%BF%D0%B8%D1%82%D1%8C%2C%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0%20%D0%B1%D0%B5%D1%81%D0%BF%D0%BB%D0%B0%D1%82%D0%BD%D0%BE%2C%20%D0%B7%D0%B0%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C.%20%D0%9C%D1%83%D0%B7%D1%8B%D0%BA%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%20%22Robik-Music%22" title="Опубликовать в LiveJournal" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -64px 0" href="http://connect.mail.ru/share?url=http%3A%2F%2Fwww.robik-music.com%2Fshop%2F3140%2Fdesc%2Fbehringer-podcastudio-firewire&amp;title=%D0%9A%D0%BE%D0%BC%D0%BF%D0%BB%D0%B5%D0%BA%D1%82%20%D0%B7%D0%B2%D1%83%D0%BA%D0%BE%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B8%20Behringer%20PODCASTUDIO%20FireWire%20%7C%D1%86%D0%B5%D0%BD%D0%B0%2C%20%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5%2C%20%D0%BE%D1%82%D0%B7%D1%8B%D0%B2%D1%8B%2C%20%D1%84%D0%BE%D1%82%D0%BE%2C%20%D0%BA%D1%83%D0%BF%D0%B8%D1%82%D1%8C%2C%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0%20%D0%B1%D0%B5%D1%81%D0%BF%D0%BB%D0%B0%D1%82%D0%BD%D0%BE%2C%20%D0%B7%D0%B0%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C.%20%D0%9C%D1%83%D0%B7%D1%8B%D0%BA%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%20%22Robik-Music%22" title="Поделиться в Моем Мире@Mail.Ru" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -80px 0" href="http://www.myspace.com/Modules/PostTo/Pages/?u=http%3A%2F%2Fwww.robik-music.com%2Fshop%2F3140%2Fdesc%2Fbehringer-podcastudio-firewire&amp;t=%D0%9A%D0%BE%D0%BC%D0%BF%D0%BB%D0%B5%D0%BA%D1%82%20%D0%B7%D0%B2%D1%83%D0%BA%D0%BE%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B8%20Behringer%20PODCASTUDIO%20FireWire%20%7C%D1%86%D0%B5%D0%BD%D0%B0%2C%20%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5%2C%20%D0%BE%D1%82%D0%B7%D1%8B%D0%B2%D1%8B%2C%20%D1%84%D0%BE%D1%82%D0%BE%2C%20%D0%BA%D1%83%D0%BF%D0%B8%D1%82%D1%8C%2C%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0%20%D0%B1%D0%B5%D1%81%D0%BF%D0%BB%D0%B0%D1%82%D0%BD%D0%BE%2C%20%D0%B7%D0%B0%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C.%20%D0%9C%D1%83%D0%B7%D1%8B%D0%BA%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%20%22Robik-Music%22" title="Добавить в MySpace" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -96px 0" href="#" onclick="addMyspace()" title="Добавить в Одноклассники" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -112px 0" href="#" onclick="withTwitter()" title="Добавить в Twitter" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -128px 0" href="#" onclick="addContact()" title="Поделиться В Контакте" target="_blank"></a><a class="iconC" rel="nofollow" style="background:url(http://www.robik-music.com/share42/icons.png) -144px 0" href="http://zakladki.yandex.ru/newlink.xml?url=http%3A%2F%2Fwww.robik-music.com%2Fshop%2F3140%2Fdesc%2Fbehringer-podcastudio-firewire&amp;name=%D0%9A%D0%BE%D0%BC%D0%BF%D0%BB%D0%B5%D0%BA%D1%82%20%D0%B7%D0%B2%D1%83%D0%BA%D0%BE%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B8%20Behringer%20PODCASTUDIO%20FireWire%20%7C%D1%86%D0%B5%D0%BD%D0%B0%2C%20%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5%2C%20%D0%BE%D1%82%D0%B7%D1%8B%D0%B2%D1%8B%2C%20%D1%84%D0%BE%D1%82%D0%BE%2C%20%D0%BA%D1%83%D0%BF%D0%B8%D1%82%D1%8C%2C%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0%20%D0%B1%D0%B5%D1%81%D0%BF%D0%BB%D0%B0%D1%82%D0%BD%D0%BE%2C%20%D0%B7%D0%B0%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C.%20%D0%9C%D1%83%D0%B7%D1%8B%D0%BA%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%20%22Robik-Music%22" title="Добавить в Яндекс.Закладки" target="_blank"></a></span>
										</div>
									</div>

									<h1>Вы недавно смотрели:</h1>
									<?if(isset($template["RECENTLY_VIEWED"])):?>
									<?foreach($template["RECENTLY_VIEWED"] as $recently_viewed):?>
									<div class="list-item" id="id-item-11021">
										<table cellspacing="6" width="100%">
											<tbody>
												<tr valign="top">
													<td width="150"><a href="<?='/shop/'.$recently_viewed['PRODUCT_ID'];?>">
														<img alt="" src="<?=$recently_viewed['PRODUCT_IMAGE_URL'];?>">
													</a>
												</td>

													<td>
														<a style="font-size:16px" href="<?='/shop/'.$recently_viewed['PRODUCT_ID'];?>">
															<?=$recently_viewed["PRODUCT_NAME"];?>
														</a>

														<div style="margin-top:10px;"></div>

														<div style="margin-top:10px; font-size:10px;">
															<?=$recently_viewed["PRODUCT_DESCRIPTION"];?>
														</div>

														<div style="font-size: 14px; margin:10px 0;">
															<span class="price"><?=$recently_viewed["PRICE_FORMATED"];?></span>
														</div>

														<div class="basket"><img src="images/bdone.png" alt=""></div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<?endforeach;?>
									<?endif;?>

									<hr>
									<strong style="font-size: small;"><img src="images/robik-logo.png" alt="" align="left" width="200pxpx" style="margin-right: 3px; margin-left: 3px;"></strong>

									<p><font size="2" style="font-size: 10pt;">Каждый
										музыкант стремится &nbsp;наиболее полно выразить свою
										идею и чувства через своё произведение или
										&nbsp;исполнение. &nbsp;А это невозможно без
										&nbsp;качественного инструмента.</font></p>

										<p><font size="2"><strong>&nbsp; Музыкальный магазин
											&nbsp;"Robik-Music"</strong> является
											&nbsp;зарегистрированной торговой маркой и реальным
											магазином в г. Сарны Ровенской &nbsp;обл. &nbsp;Мы
											предлагаем качественное &nbsp;музыкальное оборудование
											на любой вкус уже более 5 лет любителям и
											профессионалам. У нас вы можете не только приобрести
											необходимый &nbsp;товар, но и получить профессиональную
											консультацию, опробовать инструмент в &nbsp;действии,
											ознакомиться с ведущими брендами в области музыкальной
											индустрии.</font></p>

											<p><font size="2">&nbsp; Благодаря
												<b>музыкальному&nbsp;интернет-магазину
													&nbsp;"Robik-Music"</b> вы имеете возможность выбрать
													желаемый инструмент или &nbsp;оборудование, заказать и
													получить его по месту жительства (<a href="http://www.robik-music.com/index/oplata_i_dostavka/0-349">доставка</a>
													по всей &nbsp;Украине). &nbsp;На "витрине" нашего
													&nbsp;<b>интернет-магазина</b> находятся товары как
													испытанных временем компаний, так и &nbsp;новых
													производителей.</font></p>

													<p><font size="2">&nbsp; В нашем <b>музыкальном
														интернет-магазине</b> &nbsp;вы можете приобрести
														клавишные, струнные, духовые и др. <b>музыкальные
														&nbsp;инструменты</b>, аксессуары к ним, а также
														звуковое, студийное оборудование, &nbsp;приборы
														световых эффектов, комплекты для установки сцен,
														кабельную продукцию и &nbsp;многое
														другое.<br></font></p>

														<p><font size="2">&nbsp; Также мы осуществляем
															&nbsp;комплекс услуг по инсталляции звукового и
															светового оборудования в кинозалах,
															&nbsp;культурно-развлекательных центрах, на концертных
															площадках. (см. "<a href="http://www.robik-music.com/index/arenda_zvuka/0-350">аренда
															звука</a>")</font></p>