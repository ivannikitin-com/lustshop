<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lustshop
 */

?>

	</div><!-- #content -->

	<footer class="footer">
		<div class="container">
			<div class="footer__main">
				<div class="row">
					<div class="footer__column col-sm-6 col-md-3">
						<div class="footer__title">Каталог</div>
						<ul class="footer__list">
							<li class="footer__list-item"><a href="">Игрушки для взрослых</a></li>
							<li class="footer__list-item"><a href="">Сексуальное белье</a></li>
							<li class="footer__list-item"><a href="">Аксессуары</a></li>
							<li class="footer__list-item"><a href="">БДСМ-СВТ</a></li>
							<li class="footer__list-item"><a href="">Косметика</a></li>
							<li class="footer__list-item"><a href="">Другое</a></li>
							<li class="footer__list-item"><a href="">Спецпредложения</a></li>
						</ul>					
					</div>
					<div class="footer__column col-sm-6 col-md-3">
						<div class="footer__title">Новости и блог</div>
						<p><a href="">Сексуальные девушки ограбили секс-шоп в Австралии на $700</a></p>
						<p class="footer__list-item"><a href="">Женский возбудитель и основные принципы действия</a></p>
						<p class="footer__list-item"><a href="">15 знаменитостей, которые не могут жить без своих секс-игрушек</a></p>					
					</div>
					<div class="footer__column col-sm-6 col-md-3">
						<div class="footer__title">Обслуживание клиенов</div>
						<ul class="footer__list">						
							<li class="footer__list-item"><a href="">Оплата</a></li>
							<li class="footer__list-item"><a href="">Доставка</a></li>
							<li class="footer__list-item"><a href="">О нас</a></li>
							<li class="footer__list-item"><a href="">Контакты</a></li>
						</ul>
					</div>	
					<div class="footer__column col-sm-6 col-md-3">
						<div class="footer__title">Звоните, пишите</div>
						<div class="footer__phone"><a href="tel:+74955404836">+7-495 540-48-36</a></div>
						<div class="footer__email"><a href="mailto:info@lustshop.ru">info@lustshop.ru</a></div>
						<div class="footer__share">
							<div class="footer__title">Подписывайтесь</div>
							<div class="footer__socials">
								<a rel="nofollow" target="_blank" href="https://www.facebook.com/"><img src="<?php echo get_template_directory_uri(); ?>/src/img/fb.png" class="img-fluid"></a>
								<a rel="nofollow" target="_blank" href="https://twitter.com/"><img src="<?php echo get_template_directory_uri(); ?>/src/img/tw.png" class="img-fluid"></a>
								<a rel="nofollow" target="_blank" href="https://vk.com/"><img src="<?php echo get_template_directory_uri(); ?>/src/img/vk.png" class="img-fluid"></a>
								<a rel="nofollow" target="_blank" href="https://www.instagram.com/"><img src="<?php echo get_template_directory_uri(); ?>/src/img/insta.png" class="img-fluid"></a>
								<a rel="nofollow" target="_blank" href="https://www.pinterest.com/"><img src="<?php echo get_template_directory_uri(); ?>/src/img/pin.png" class="img-fluid"></a>
							</div>
						</div><!--/.footer__share-->
					</div><!--./col-->
				</div><!--/.row-->
			</div><!-- footer__main-->
		</div><!--/.container-->

		<div class="footer__bottom">
			<div class="container">
				<div class="footer__payment row no-gutters justify-content-center">
					<img src="<?php echo get_template_directory_uri(); ?>/src/img/visa.png" width="75" height="48">
					<img src="<?php echo get_template_directory_uri(); ?>/src/img//visa-electron.png" width="75" height="48">
					<img src="<?php echo get_template_directory_uri(); ?>/src/img/mastercard.png" width="75" height="48">
					<img src="<?php echo get_template_directory_uri(); ?>/src/img/maestro.png" width="75" height="48">
				</div>
			</div><!--/.container-->
		</div><!--/.footer__bottom-->
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
