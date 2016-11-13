<?php
/**
* @author Pavel Kostritcyn [http://p0zitiv.ru]
* @copyright (C) 2013 (= POZITIV =)
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
#############################################################
#															#
#		Разработчик Pavel Kostricyn : admin@p0zitiv.ru		#
#															#
#############################################################
*/
defined('_JEXEC') or die('Restricted access'); // Запрет прямого доступа!
jimport('joomla.application.component.view'); // Подключаем библиотеку представления Joomla.

// Расчет товаров на строку
$BrowseProducts_per_row = 5;
$Browsecellwidth = ' width' . floor (100 / $BrowseProducts_per_row);
$iBrowseCol = 1;
$iBrowseProduct = 1;

$verticalseparator = " vertical-separator"; // Разделитель
$cookiename = 'vm_favorites';
$kuk = $_COOKIE[$cookiename];
$product_decode = unserialize(stripcslashes($kuk));
$prodPerPage = JRequest::getInt('limit',20);
$pageNumber = JRequest::getInt('start',0);
$total_product = count($product_decode);
if($prodPerPage > 0){
	$product_decode = array_slice($product_decode,$pageNumber,$prodPerPage);
} else {
	$product_decode = array_slice($product_decode,$pageNumber);
}
foreach ($product_decode as $product) {
	$db = JFactory::getDBO();
	$qt ='SELECT `product_discount_id`,`product_price` FROM `#__virtuemart_product_prices` WHERE `virtuemart_product_id`='.$product.'';
	$db->setQuery($qt); $product_price = $db->loadAssoc();
	if (isset($product_price['product_discount_id'])) {
		$qt1 ='SELECT `calc_value_mathop`,`calc_value` FROM `#__virtuemart_calcs` WHERE `virtuemart_calc_id` = '.$product_price['product_discount_id'].'';
		$db->setQuery($qt1); $product_calc = $db->loadAssoc();
	} else {
		$product_calc['calc_value_mathop'] = '0';
	}
	$qt2 ='SELECT `product_name` FROM `#__virtuemart_products_en_gb` LEFT JOIN `#__virtuemart_products` USING (virtuemart_product_id) WHERE `virtuemart_product_id` = '.$product.'';
	$db->setQuery($qt2); $product_name = $db->loadAssoc();
	$qt21 ='SELECT b.`currency_symbol` FROM `#__virtuemart_vendors` as a LEFT JOIN `#__virtuemart_currencies` as b ON a.`vendor_currency` = b.`virtuemart_currency_id` WHERE a.`virtuemart_vendor_id` = 1';
	$db->setQuery($qt21); $price_currency = $db->loadResult();
	$qt3 ='SELECT `virtuemart_category_id` FROM `#__virtuemart_product_categories` WHERE `virtuemart_product_id` = '.$product.'';
	$db->setQuery($qt3); $category_id = $db->loadResult();
	$qt4 ='SELECT * FROM `#__virtuemart_product_medias` LEFT JOIN `#__virtuemart_medias` USING (virtuemart_media_id) WHERE `virtuemart_product_id` = '.$product.'';
	$db->setQuery($qt4); $media = $db->loadAssoc();
	$qt5 ='SELECT `mf_name` FROM `#__virtuemart_product_manufacturers` LEFT JOIN `#__virtuemart_manufacturers_en_gb` USING (virtuemart_manufacturer_id) WHERE `virtuemart_product_id` = '.$product.'';
	$db->setQuery($qt5); $manufacturer = $db->loadAssoc();
	$knop= '<div class="addtocart-area">
			<form method="post" class="product" action="index.php">
				<span class="quantity-box"><input type="text" class="quantity-input" name="quantity[]" value="1"></span>
				<span class="quantity-controls">
				<input type="button" class="quantity-controls quantity-plus">
				<input type="button" class="quantity-controls quantity-minus">
				</span>
				<span class="addtocart-button"><input type="submit" name="addtocart" class="addtocart-button" value="в корзину" title="в корзину"></span>
				<div class="clear"></div>
				<input type="hidden" class="pname" value="'.$product_name['product_name'].'">
				<input type="hidden" name="option" value="com_virtuemart">
				<input type="hidden" name="view" value="cart">
				<noscript><input type="hidden" name="task" value="add" /></noscript>
				<input type="hidden" name="virtuemart_product_id[]" value="'.$product.'">
				<input type="hidden" name="virtuemart_category_id[]" value="0">
			</form>
			<div class="clear"></div>
		</div>';
	// Горизонтальный разделитель
	if ($iBrowseCol == 1 && $iBrowseProduct > $BrowseProducts_per_row) {
		?>
	<!--<div class="horizontal-separator"></div>-->
		<?php
	}

	// Начало новой строки или нет
	if ($iBrowseCol == 1) {
		?>
	<div class="row">
	<?php
	}

	// Вертикальный разделитель
	if ($iBrowseProduct == $BrowseProducts_per_row or $iBrowseProduct % $BrowseProducts_per_row == 0) {
		$show_vertical_separator = ' ';
	} else {
		$show_vertical_separator = $verticalseparator;
	}
	$link = 'index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$product.'&virtuemart_category_id='.$category_id['virtuemart_category_id'];
	// Товар
	?>
	<div class="product wish-list floatleft<?php echo $show_vertical_separator ?>">
		<div class="spacer">
			<div class="quick-1">
				<div class="quick-content-1">
					<div class="quick-row">
						<ul>
							<li><a class="modal" href="<?php echo $product->link; ?>?tmpl=component" rel="{handler: 'iframe', size: {x: 700, y: 480}}"><i class="fa fa-search fa-3x" aria-hidden="true"></i></a></li>
							<li><a class="modal" href="<?php echo $product->link; ?>?tmpl=component" rel="{handler: 'iframe', size: {x: 700, y: 480}}">Быстрый просмотр</a></li>
							<li><a class="quick-order-1 show_popup" rel="order" >Заказать в один клик</a></li>
						</ul>
					</div>
					<div class="bp">
						<?php $productId = $product; // $product поменять на переменную id продукта. Например для шаблона категории это $product->virtuemart_product_id, а для карточки товара это $this->product->virtuemart_product_id
						?>
						<script>
						function send<?php echo $productId ?>() {
							var product_id = jQuery('#product_id<?php echo $productId ?>').val()
							jQuery.ajax({
								type: "POST",
								url: "<?php echo JURI::root() ?>components/com_vm_favorite/script/script.php",
								data:  ( {'product_id' : product_id, 'cookie' : jQuery.cookie('vm_favorites')} ),
								success: function(favorite) {
									/*jQuery("#result<?php echo $productId ?>").empty(); // Для отладки работы скрипта
									jQuery("#result<?php echo $productId ?>").append(favorite);*/
									jQuery.cookie('vm_favorites',favorite, {path: "/",domain: "<?php echo $_SERVER['SERVER_NAME'] ?>"});//запись в куки
									jQuery("#favorite_button<?php echo $productId ?>").toggleClass("deleted");
								}
							});
						}
						</script>
						<form action="" method="post" style="display: inline-block;width: 100%;">
							<input type="button" id="favorite_button<?php echo $productId ?>" onclick="send<?php echo $productId ?>();" title="Избранное" class="favorite_button">
							<input type="hidden" id="product_id<?php echo $productId ?>" value="<?php echo $productId ?>">
						</form>
						<!--Для отладки работы скрипта-->
						<!--<div id="result<?php echo $productId ?>"></div>-->
						<?php //echo'<pre>'; print_r($media); echo'</pre>'; ?>
						<img src="<?php if ($media['file_url'] != '') echo $media['file_url']; else echo '/components/com_virtuemart/assets/images/vmgeneral/noimage.gif'; ?>" alt="<?php echo $media['file_title'] ?>" class="browseproductImage"/>
					</div>
					<a class="wish-link" href="<?php echo $link; ?>"><?php echo $product_name['product_name'] ?></a>
					<div class="product-price marginbottom12" id="productPrice<?php echo $product ?>">
						<?php 
						if($product_calc['calc_value_mathop']=='-%'){
							$priceSales = $product_price['product_price'] - ($product_price['product_price'] * $product_calc['calc_value']  / 100);
						}elseif($product_calc['calc_value_mathop']=='+%'){
							$priceSales = $product_price['product_price'] + ($product_price['product_price'] * $product_calc['calc_value']  / 100);
						}elseif($product_calc['calc_value_mathop']=='-'){
							$priceSales = $product_price['product_price'] - $product_calc['calc_value'];
						}elseif($product_calc['calc_value_mathop']=='+'){
							$priceSales = $product_price['product_price'] + $product_calc['calc_value'];
						}else {$priceSales = $product_price['product_price'];
						};
						if($product_price['product_price'] == $priceSales) $priceBase=''; else $priceBase=round($product_price['product_price']).' '.$price_currency;
						?>
						<div class="PricesalesPrice" style="display : block;"><span class="PricesalesPrice"><?php echo round($priceSales).' '.$price_currency; ?></span></div>
					</div>

					<?php echo $knop ?>	
			
					<div class="clear"></div>
				</div><!-- end of spacer -->
			</div> <!-- end of product -->
		</div><!-- end of spacer -->
	</div> <!-- end of product -->
	<?php

	// Конец новой строки или нет
	if ($iBrowseCol == $BrowseProducts_per_row || $iBrowseCol == $total_product) {
		?>
		<div class="clear"></div>
	</div> <!-- end of row -->
		<?php
		$iBrowseCol = 1;
	} else {
		$iBrowseCol++;
	}
	$iBrowseProduct++;
} //end of foreach
?>
