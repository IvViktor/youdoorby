<script>
	function removeProductFromCart(cartItemId){
			jQuery.ajax({
				method: 'GET',
				url: 'http://youdoor.by/index.php?option=com_virtuemart&view=cart&task=delete&cart_virtuemart_product_id='+cartItemId,
				success: function(data){
						let container = document.getElementsByClassName('vm_cart_products')[0]
								.getElementsByClassName('container')[0];
						let deletedItems = container.getElementsByClassName(cartItemId);
						deletedItems.forEach((child) => {
							container.removeChild(child);
						});
				}
			});
	}
</script>
<div class="vmCartModule <?php echo $params->get('moduleclass_sfx'); ?>" id="vmCartModule">

<div class="cart-container">
	<a class="showpopup" rel="cart-1" href="#">
		<i class="fa fa-shopping-cart fa-lg"><div class="total_products"><?php echo  $data->totalProductTxt ?></div></i>
	</a>
	<div class="total" style="float: right;">
		<?php if ($data->totalProduct) echo  $data->billTotal; ?>
	</div>
</div> 

<div class="popup cart-1">
	<a class="closing" href="#">Close</a>


<?php // no direct access
defined('_JEXEC') or die('Restricted access');

//dump ($cart,'mod cart');
// Ajax is displayed in vm_cart_products
// ALL THE DISPLAY IS Done by Ajax using "hiddencontainer" ?>

<!-- Virtuemart 2 Ajax Card -->

<?php
if ($show_product_list) {
	?>
	<div id="hiddencontainer" style=" display: none; ">
		<div class="container">
			<?php if ($show_price) { ?>
			  <div class="prices" style="float: right;"></div>
			<?php } ?>
			<div class="product_row">
				<span class="quantity"></span>&nbsp;x&nbsp;<span class="product_name"></span>
			</div>

			<div class="product_attributes"></div>
		</div>
	</div>
	<div class="vm_cart_products">
		<div class="container">
		
		<?php foreach ($data->products as $product)
		{
			if ($show_price) { ?>
				  <div class="prices <?php echo $product['cart_item_id'] ?>" style="float: right;"><?php echo  $product['prices'] ?></div>
				<?php } ?>
			<div class="product_row <?php echo $product['cart_item_id'] ?>">
				<span class='product_image'>
					<?php echo $product['product_image']; ?>
				</span>
				<span class="quantity"><?php echo  $product['quantity'] ?></span>&nbsp;x&nbsp;<span class="product_name"><?php echo  $product['product_name'] ?></span>
				<span >
					<a class='popup-cart-delete-button'
				 onclick='removeProductFromCart(<?php echo $product["cart_item_id"]?>);'>Delete</a>
				</span>
			</div>
			<?php if ( !empty($product['product_attributes']) ) { ?>
				<div class="product_attributes <?php echo $product['cart_item_id'] ?>"><?php echo  $product['product_attributes'] ?></div>

			<?php }
		}
		?>
		</div>
	</div>
<?php } ?>

<div class="total" style="float: right;">
	<?php if ($data->totalProduct) echo  $data->billTotal; ?>
</div>
<div class="total_products"><?php echo  $data->totalProductTxt ?></div>
<div class="show_cart">
	<?php if ($data->totalProduct) echo  $data->cart_show; ?>
</div>
<div style="clear:both;"></div>

<noscript>
<?php echo JText::_('MOD_VIRTUEMART_CART_AJAX_CART_PLZ_JAVASCRIPT') ?>
</noscript>
</div>

	<div style="clear:both;"></div>


</div>
