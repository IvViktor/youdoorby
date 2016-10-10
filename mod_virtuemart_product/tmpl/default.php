<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$col= 1 ;
$pwidth= ' width'.floor ( 100 / $products_per_row );
if ($products_per_row > 1) { $float= "floatleft";}
else {$float="center";}
?>
<div class="vmgroup<?php echo $params->get( 'moduleclass_sfx' ) ?>">
 
<?php if ($headerText) { ?>
	<div class="vmheader"><?php echo $headerText ?></div>
<?php }
if ($display_style =="div") { ?>
<div class="vmproduct<?php echo $params->get('moduleclass_sfx'); ?>">
<?php foreach ($products as $product) { ?>
	<div class="<?php echo $pwidth ?> <?php echo $float ?>"><div class="quick"><div style="padding: 10px 0;" class="spacer">
<div class="quick-content">
<div class="quick-row">
<ul>
<li><a class="modal" href="<?php echo $url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$product->virtuemart_product_id.'&virtuemart_category_id='.$product->virtuemart_category_id).'?tmpl=component'; ?>" rel="{handler: 'iframe', size: {x: 700, y: 480}}"><i class="fa fa-search fa-3x" aria-hidden="true"></i></a></li>
<li><a class="modal" href="<?php echo $url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$product->virtuemart_product_id.'&virtuemart_category_id='.$product->virtuemart_category_id).'?tmpl=component'; ?>" rel="{handler: 'iframe', size: {x: 700, y: 480}}">Быстрый просмотр</a></li>
<li><a class="quick-order show_popup" rel="order" >Заказать в один клик</a></li>
</ul>
</div>
 </div>
<?php
 if (!empty($product->images[0]) )
 $image = $product->images[0]->displayMediaThumb('class="featuredProductImage" border="0"',false) ;
 else $image = '';
 echo JHTML::_('link', JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$product->virtuemart_product_id.'&virtuemart_category_id='.$product->virtuemart_category_id),$image,array('title' => $product->product_name) );

 echo '<div class="clear"></div>';
 echo '</div>';
 $url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$product->virtuemart_product_id.'&virtuemart_category_id='.$product->virtuemart_category_id); ?>
 <a class="product-name" href="<?php echo $url ?>"><?php echo $product->product_name ?></a>	<div class="product-price">	<?php	echo '<div class="clear"></div>';

 if ($show_price) {
 // 		echo $currency->priceDisplay($product->prices['salesPrice']);
 if (!empty($product->prices['salesPrice'] ) ) echo $currency->createPriceDiv('salesPrice','',$product->prices,true);
 // 		if ($product->prices['salesPriceWithDiscount']>0) echo $currency->priceDisplay($product->prices['salesPriceWithDiscount']);
 if (!empty($product->prices['salesPriceWithDiscount']) ) echo $currency->createPriceDiv('salesPriceWithDiscount','',$product->prices,true);
 }
 if ($show_addtocart) echo mod_virtuemart_product::addtocart($product);
 ?>

 </div></div></div>
	<?php
		if ($col == $products_per_row && $products_per_row && $col < $totalProd ) {
			echo "	</div><div style='clear:both;'>";
			$col= 1 ;
		} else {
			$col++;
		}
	} ?>
</div>
<br style='clear:both;' />

<?php
} else {
$last = count($products)-1;
?>

<ul class="vmproduct<?php echo $params->get('moduleclass_sfx'); ?>">
<?php foreach ($products as $product) : ?>
 <li class="<?php echo $pwidth ?> <?php echo $float ?>">
 <?php
 if (!empty($product->images[0]) )
			$image = $product->images[0]->displayMediaThumb('class="featuredProductImage" border="0"',false) ;
		else $image = '';
			echo JHTML::_('link', JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$product->virtuemart_product_id.'&virtuemart_category_id='.$product->virtuemart_category_id),$image,array('title' => $product->product_name) );
			echo '<div class="clear"></div>';
	$url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$product->virtuemart_product_id.'&virtuemart_category_id='.
$product->virtuemart_category_id); ?>		<a href="<?php echo $url ?>"><?php echo $product->product_name ?></a>		<?php	echo '<div class="clear"></div>';

		if ($show_price) {
			echo $currency->createPriceDiv('salesPrice','',$product->prices,true);
			if ($product->prices['salesPriceWithDiscount']>0) echo $currency->createPriceDiv('salesPriceWithDiscount','',$product->prices,true);
		}
		if ($show_addtocart) echo mod_virtuemart_product::addtocart($product);
		?>
	</li>
<?php
	if ($col == $products_per_row && $products_per_row && $last ) {
		echo '
		</ul><div class="clear"></div>
		<ul  class="vmproduct'.$params->get('moduleclass_sfx')  .'">';
		$col= 1 ;
	} else {
		$col++;
	}
	$last--;
	endforeach; ?>
</ul><div class="clear"></div>

<?php }
	if ($footerText) : ?>
	<div class="vmfooter<?php echo $params->get( 'moduleclass_sfx' ) ?>">
		 <?php echo $footerText ?>
	</div>
<?php endif; ?>
</div> 