<?php defined('_JEXEC') or die('Restricted access');
/**
 *
 * Layout for the shopping cart
 *
 * @package	VirtueMart
 * @subpackage Cart
 * @author Max Milbers
 * @author Patrick Kohl
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 *
 */

// Check to ensure this file is included in Joomla!

// jimport( 'joomla.application.component.view');
// $viewEscape = new JView();
// $viewEscape->setEscape('htmlspecialchars');

?>

<fieldset>
	<table
		class="cart-summary"
		cellspacing="0"
		cellpadding="0"
		border="0"
		width="100%">



		<?php
		$i=1;
		foreach( $this->cart->products as $pkey =>$prow ) { ?>
			<tr valign="top" class="sectiontableentry<?php echo $i ?>">
				<td class="cart-td-1" align="center" >
					<?php if ( $prow->virtuemart_media_id) {  ?>
						<span class="cart-images">
						 <?php
						 if(!empty($prow->image)) echo $prow->image->displayMediaThumb('',false);
						 ?>
						</span>
					<?php } ?>

				</td>
				<td class="cart-td-2" align="center">
					<span>
					<?php echo JHTML::link($prow->url, $prow->product_name).$prow->customfields; ?>
					</span>
				</td>
				<td class="cart-td-3" align="center" >
					<a align="middle"
						 href="<?php echo JRoute::_('index.php?option=com_virtuemart&view=cart&task=delete&cart_virtuemart_product_id='.$prow->cart_item_id  ) ?>">
					Удалить
					</a>
			</td>
				<td class="cart-td-4" align="right" ><form action="index.php" method="post" class="inline">
				<input type="hidden" name="option" value="com_virtuemart" />
				<input type="text" class="inputbox" size="2" maxlength="4" name="quantity" value="<?php echo $prow->quantity ?>" />
				<input type="hidden" name="view" value="cart" />
				<input type="hidden" name="task" value="update" />
				<input type="hidden" name="cart_virtuemart_product_id" value="<?php echo $prow->cart_item_id  ?>" />
				<input type="button" class="add-number" name="addnumber" value="+" onclick='addOneToValue(this)'/>
				<input type="button" class="dec-number" name="decnumber" value="-" onclick='decOneFromValue(this)'/>
				  </form>
			  	</td>

				<td class="cart-td-5" align="right">
					<?php
					if (VmConfig::get('checkout_show_origprice',1) && !empty($this->cart->pricesUnformatted[$pkey]['basePriceWithTax']) && $prow->basePriceWithTax != $prow->salesPrice ) {
						echo '<span class="line-through">'.$prow->basePriceWithTax .'</span><br />' ;
					}
					echo $prow->salesPrice ;
					?>
				</td>
			</tr>
		<?php
			$i = 1 ? 2 : 1;
		} ?>
	</table>
</fieldset>
<script>
	function addOneToValue(element){
		let formElement = element.parentElement;
		let inputBox = formElement.getElementsByClassName('inputbox')[0];
		let value = +inputBox.value;
		inputBox.value = ++value;
		formElement.submit();
	}
	function decOneFromValue(element){
		let formElement = element.parentElement;
		let inputBox = formElement.getElementsByClassName('inputbox')[0];
		let value = +inputBox.value;
		inputBox.value = --value;
		formElement.submit();
	}

</script>
