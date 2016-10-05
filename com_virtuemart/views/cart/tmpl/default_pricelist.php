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
				<td align="center" >
					<?php if ( $prow->virtuemart_media_id) {  ?>
						<span class="cart-images">
						 <?php
						 if(!empty($prow->image)) echo $prow->image->displayMediaThumb('',false);
						 ?>
						</span>
					<?php } ?>

				</td>
				<td align="center">
					<span>
					<?php echo JHTML::link($prow->url, $prow->product_name).$prow->customfields; ?>
					</span>
				</td>
				<td align="center" >
					<a align="middle"
						 href="<?php echo JRoute::_('index.php?option=com_virtuemart&view=cart&task=delete&cart_virtuemart_product_id='.$prow->cart_item_id  ) ?>">
					Delete
					</a>
			</td>
				<td align="right" ><form action="index.php" method="post" class="inline">
				<input type="hidden" name="option" value="com_virtuemart" />
				<input type="text" class="inputbox" size="2" maxlength="4" name="quantity" value="<?php echo $prow->quantity ?>" />
				<input type="hidden" name="view" value="cart" />
				<input type="hidden" name="task" value="update" />
				<input type="hidden" name="cart_virtuemart_product_id" value="<?php echo $prow->cart_item_id  ?>" />
				<input type="button" name="addnumber" value="+" onclick='addOneToValue(this)'/>
				<input type="button" name="decnumber" value="-" onclick='decOneFromValue(this)'/>
				  </form>
			  	</td>

				<td align="right">
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
		<!--Begin of SubTotal, Tax, Shipment, Coupon Discount and Total listing -->
                  <?php if ( VmConfig::get('show_tax')) { $colspan=3; } else { $colspan=2; } ?>
		<tr>
			<td colspan="3">&nbsp;</td>

			<td colspan="<?php echo $colspan ?>"><hr /></td>
		</tr>
		  <tr class="sectiontableentry1">
			<td colspan="3" align="right"><?php echo JText::_('COM_VIRTUEMART_ORDER_PRINT_PRODUCT_PRICES_TOTAL'); ?></td>

                        <?php if ( VmConfig::get('show_tax')) { ?>
			<td align="right"><?php echo "<span  class='priceColor2'>".$this->cart->prices['taxAmount']."</span>" ?></td>
                        <?php } ?>
			<td align="right"><?php echo "<span  class='priceColor2'>".$this->cart->prices['discountAmount']."</span>" ?></td>
			<td align="right"><?php echo $this->cart->prices['salesPrice'] ?></td>
		  </tr>

			<?php
		if (VmConfig::get('coupons_enable')) {
		?>
			<tr class="sectiontableentry2">
				<td colspan="3" align="left">
				    <?php if(!empty($this->layoutName) && $this->layoutName=='default') {
					   // echo JHTML::_('link', JRoute::_('index.php?view=cart&task=edit_coupon',$this->useXHTML,$this->useSSL), JText::_('COM_VIRTUEMART_CART_EDIT_COUPON'));
					    echo $this->loadTemplate('coupon');
				    }
				?>

				<?php if (!empty($this->cart->cartData['couponCode'])) { ?>
					 <?php
						echo $this->cart->cartData['couponCode'] ;
						echo $this->cart->cartData['couponDescr'] ? (' (' . $this->cart->cartData['couponDescr'] . ')' ): '';
						?>

				</td>

					 <?php if ( VmConfig::get('show_tax')) { ?>
					<td align="right"><?php echo $this->cart->prices['couponTax']; ?> </td>
					 <?php } ?>
					<td align="right">&nbsp;</td>
					<td align="right"><?php echo $this->cart->prices['salesPriceCoupon']; ?> </td>
				<?php } else { ?>
					<td colspan="6" align="left">&nbsp;</td>
				<?php }

				?>
			</tr>
		<?php } ?>


		<?php
		foreach($this->cart->cartData['DBTaxRulesBill'] as $rule){ ?>
			<tr class="sectiontableentry<?php $i ?>">
				<td colspan="3" align="right"><?php echo $rule['calc_name'] ?> </td>

                                   <?php if ( VmConfig::get('show_tax')) { ?>
				<td align="right"> </td>
                                <?php } ?>
				<td align="right"> <?php echo $this->cart->prices[$rule['virtuemart_calc_id'].'Diff'];  ?></td>
				<td align="right"><?php echo $this->cart->prices[$rule['virtuemart_calc_id'].'Diff'];   ?> </td>
			</tr>
			<?php
			if($i) $i=1; else $i=0;
		} ?>

		<?php

		foreach($this->cart->cartData['taxRulesBill'] as $rule){ ?>
			<tr class="sectiontableentry<?php $i ?>">
				<td colspan="3" align="right"><?php echo $rule['calc_name'] ?> </td>
				<?php if ( VmConfig::get('show_tax')) { ?>
				<td align="right"><?php echo $this->cart->prices[$rule['virtuemart_calc_id'].'Diff']; ?> </td>
				 <?php } ?>
				<td align="right"><?php    ?> </td>
				<td align="right"><?php echo $this->cart->prices[$rule['virtuemart_calc_id'].'Diff'];   ?> </td>
			</tr>
			<?php
			if($i) $i=1; else $i=0;
		}

		foreach($this->cart->cartData['DATaxRulesBill'] as $rule){ ?>
			<tr class="sectiontableentry<?php $i ?>">
				<td colspan="3" align="right"><?php echo   $rule['calc_name'] ?> </td>

                                     <?php if ( VmConfig::get('show_tax')) { ?>
				<td align="right"> </td>

                                <?php } ?>
				<td align="right"><?php  echo  $this->cart->prices[$rule['virtuemart_calc_id'].'Diff'];   ?>  </td>
				<td align="right"><?php echo $this->cart->prices[$rule['virtuemart_calc_id'].'Diff'];   ?> </td>
			</tr>
			<?php
			if($i) $i=1; else $i=0;
		} ?>


	<tr class="sectiontableentry1">
                    <?php if (!$this->cart->automaticSelectedShipment) { ?>

		<?php	/*	<td colspan="2" align="right"><?php echo JText::_('COM_VIRTUEMART_ORDER_PRINT_SHIPPING'); ?> </td> */?>
				<td colspan="3" align="left">
				<?php echo $this->cart->cartData['shipmentName']; ?>
				    <br />
				<?php
				if(!empty($this->layoutName) && $this->layoutName=='default' && !$this->cart->automaticSelectedShipment  )
					echo JHTML::_('link', JRoute::_('index.php?view=cart&task=edit_shipment',$this->useXHTML,$this->useSSL), $this->select_shipment_text,'class=""');
				else {
				    JText::_('COM_VIRTUEMART_CART_SHIPPING');
				}
				} else { ?>
                                <td colspan="3" align="left">
				<?php echo $this->cart->cartData['shipmentName']; ?>
				</td>
                                 <?php } ?>

                                     <?php if ( VmConfig::get('show_tax')) { ?>
				<td align="right"><?php echo "<span  class='priceColor2'>".$this->cart->prices['shipmentTax']."</span>"; ?> </td>
                                <?php } ?>
				<td></td>
				<td align="right"><?php echo $this->cart->prices['salesPriceShipment']; ?> </td>
		</tr>

		<tr class="sectiontableentry1">
                          <?php if (!$this->cart->automaticSelectedPayment) { ?>

				<td colspan="3" align="left">
				<?php echo $this->cart->cartData['paymentName']; ?>
				     <br />
				<?php if(!empty($this->layoutName) && $this->layoutName=='default') echo JHTML::_('link', JRoute::_('index.php?view=cart&task=editpayment',$this->useXHTML,$this->useSSL), $this->select_payment_text,'class=""'); else JText::_('COM_VIRTUEMART_CART_PAYMENT'); ?> </td>

				</td>
                         <?php } else { ?>
                                    <td colspan="3" align="left"><?php echo $this->cart->cartData['paymentName']; ?> </td>
                                 <?php } ?>
                                     <?php if ( VmConfig::get('show_tax')) { ?>
				<td align="right"><?php echo "<span  class='priceColor2'>".$this->cart->prices['paymentTax']."</span>"; ?> </td>
                                <?php } ?>
				<td align="right"><?php //echo "<span  class='priceColor2'>".$this->cart->prices['paymentDiscount']."</span>"; ?></td>
				<td align="right"><?php  echo $this->cart->prices['salesPricePayment']; ?> </td>
			</tr>
		  <tr>
			<td colspan="3">&nbsp;</td>
			<td colspan="<?php echo $colspan ?>"><hr /></td>
		  </tr>
		  <tr class="sectiontableentry2">
			<td colspan="3" align="right"><?php echo JText::_('COM_VIRTUEMART_CART_TOTAL') ?>: </td>

                        <?php if ( VmConfig::get('show_tax')) { ?>
			<td align="right"> <?php echo "<span  class='priceColor2'>".$this->cart->prices['billTaxAmount']."</span>" ?> </td>
                        <?php } ?>
			<td align="right"> <?php echo "<span  class='priceColor2'>".$this->cart->prices['billDiscountAmount']."</span>" ?> </td>
			<td align="right"><strong><?php echo $this->cart->prices['billTotal'] ?></strong></td>
		  </tr>
		    <?php
		    if ( $this->totalInPaymentCurrency) {
			?>

		       <tr class="sectiontableentry2">
					    <td colspan="3" align="right"><?php echo JText::_('COM_VIRTUEMART_CART_TOTAL_PAYMENT') ?>: </td>

					    <?php if ( VmConfig::get('show_tax')) { ?>
					    <td align="right">  </td>
					    <?php } ?>
					    <td align="right">  </td>
					    <td align="right"><strong><?php echo $this->totalInPaymentCurrency ?></strong></td>
				      </tr>
				      <?php
		    }
		    ?>


	</table>
</fieldset>
<div class="billto-shipto">
	<div class="width50 floatleft">

		<span><span class="vmicon vm2-shipto-icon"></span>
		<?php echo JText::_('COM_VIRTUEMART_USER_FORM_SHIPTO_LBL'); ?></span>
		<?php // Output Bill To Address ?>
		<div class="output-shipto">
		<?php
		if(empty($this->cart->STaddress['fields'])){
			echo JText::sprintf('COM_VIRTUEMART_USER_FORM_EDIT_BILLTO_EXPLAIN',JText::_('COM_VIRTUEMART_USER_FORM_ADD_SHIPTO_LBL') );
		} else {
			if(!class_exists('VmHtml'))require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'html.php');
			echo JText::_('COM_VIRTUEMART_USER_FORM_ST_SAME_AS_BT'). VmHtml::checkbox('STsameAsBT',$this->cart->STsameAsBT).'<br />';
			foreach($this->cart->STaddress['fields'] as $item){
				if(!empty($item['value'])){ ?>
					<!-- <span class="titles"><?php echo $item['title'] ?></span> -->
					<?php
					if ($item['name'] == 'first_name' || $item['name'] == 'middle_name' || $item['name'] == 'zip') { ?>
						<span class="values<?php echo '-'.$item['name'] ?>" ><?php echo $this->escape($item['value']) ?></span>
					<?php } else { ?>
						<span class="values" ><?php echo $this->escape($item['value']) ?></span>
						<br class="clear" />
					<?php
					}
				}
			}
		}
 		?>
		<div class="clear"></div>
		</div>
		<?php if(!isset($this->cart->lists['current_id'])) $this->cart->lists['current_id'] = 0; ?>
		<a class="details" href="<?php echo JRoute::_('index.php?option=com_virtuemart&view=user&task=editaddresscart&addrtype=ST&cid[]='.$this->cart->lists['current_id'],$this->useXHTML,$this->useSSL) ?>">
		<?php echo JText::_('COM_VIRTUEMART_USER_FORM_ADD_SHIPTO_LBL'); ?>
		</a>

	</div>

	<div class="clear"></div>
</div>
<form method="post" id="userForm" name="chooseShipmentRate" action="<?php echo JRoute::_('index.php'); ?>" class="form-validate">
<?php

	echo "<h1>".JText::_('COM_VIRTUEMART_CART_SELECT_SHIPMENT')."</h1>";


	   echo "<fieldset>\n";
	// if only one Shipment , should be checked by default
	    foreach ($this->shipments_shipment_rates as $shipment_shipment_rates) {
		if (is_array($shipment_shipment_rates)) {
		    foreach ($shipment_shipment_rates as $shipment_shipment_rate) {
			echo $shipment_shipment_rate."<br />\n";
		    }
		}
	    }
	    echo "</fieldset>\n";

    ?>

    <input type="hidden" name="option" value="com_virtuemart" />
    <input type="hidden" name="view" value="cart" />
    <input type="hidden" name="task" value="setshipment" />
    <input type="hidden" name="controller" value="cart" />
</form>
<form method="post" id="paymentForm" name="choosePaymentRate" action="<?php echo JRoute::_('index.php'); ?>" class="form-validate">
<?php
	echo "<h1>".JText::_('COM_VIRTUEMART_CART_SELECT_PAYMENT')."</h1>";
     if ($this->found_payment_method) {


    echo "<fieldset>";
		foreach ($this->paymentplugins_payments as $paymentplugin_payments) {
		    if (is_array($paymentplugin_payments)) {
			foreach ($paymentplugin_payments as $paymentplugin_payment) {
			    echo $paymentplugin_payment.'<br />';
			}
		    }
		}
    echo "</fieldset>";

    } else {
	 echo "<h1>".$this->payment_not_found_text."</h1>";
    }


    ?>

    <input type="hidden" name="option" value="com_virtuemart" />
    <input type="hidden" name="view" value="cart" />
    <input type="hidden" name="task" value="setpayment" />
    <input type="hidden" name="controller" value="cart" />
</form>
<form method="post" id="adminForm" name="userForm" action="<?php echo JRoute::_('index.php?view=user',$this->useXHTML,$this->useSSL) ?>" class="form-validate">

<?php 
		echo 'userfields';
$typefields = array('corefield', 'billto');
$corefields = VirtueMartModelUserfields::getCoreFields();
foreach ($typefields as $typefield) {
    $_k = 0;
    $_set = false;
    $_table = false;
    $_hiddenFields = '';

//             for ($_i = 0, $_n = count($this->userFields['fields']); $_i < $_n; $_i++) {
    for ($_i = 0, $_n = count($this->userFields['fields']); $_i < $_n; $_i++) {
	// Do this at the start of the loop, since we're using 'continue' below!
	if ($_i == 0) {
	    $_field = current($this->userFields['fields']);
	} else {
	    $_field = next($this->userFields['fields']);
	}

	if ($_field['hidden'] == true) {
	    $_hiddenFields .= $_field['formcode'] . "\n";
	    continue;
	}
	if ($_field['type'] == 'delimiter') {
	    if ($_set) {
		// We're in Fieldset. Close this one and start a new
		if ($_table) {
		    echo '	</table>' . "\n";
		    $_table = false;
		}
		echo '</fieldset>' . "\n";
	    }
	    $_set = true;
	    echo '<fieldset>' . "\n";
	    echo '	<legend>' . "\n";
	    echo '		' . $_field['title'];
	    echo '	</legend>' . "\n";
	    continue;
	}



	if (($typefield == 'corefield' && (in_array($_field['name'], $corefields) && $_field['name'] != 'email' && $_field['name'] != 'agreed') )
		or ($typefield == 'billto' && !(in_array($_field['name'], $corefields) && $_field['name'] != 'email' && $_field['name'] != 'agreed') )) {
	    if (!$_table) {
		// A table hasn't been opened as well. We need one here,
		if ( $typefield == 'corefield') {
		    echo '<span class="userfields_info">' . $this->corefield_title . '</span>';
		} else {
		    echo '<span class="userfields_info">' . $this->vmfield_title . '</span>';
		}
		echo '	<table class="adminform user-details">' . "\n";
		$_table = true;
	    }
	    echo '		<tr>' . "\n";
	    echo '			<td class="key">' . "\n";
	    echo '				<label class="' . $_field['name'] . '" for="' . $_field['name'] . '_field">' . "\n";
	    echo '					' . $_field['title'] . ($_field['required'] ? ' *' : '') . "\n";
	    echo '				</label>' . "\n";
	    echo '			</td>' . "\n";
	    echo '			<td>' . "\n";
	    echo '				' . $_field['formcode'] . "\n";
	    echo '			</td>' . "\n";
	    echo '		</tr>' . "\n";
	}
    }

    if ($_table) {
	echo '	</table>' . "\n";
    }
    if ($_set) {
	echo '</fieldset>' . "\n";
    }
    $_k = 0;
    $_set = false;
    $_table = false;
    $_hiddenFields = '';
    reset($this->userFields['fields']);
}

echo $_hiddenFields;
?>


<?php echo "shipTo fields";
 echo $this->lists['shipTo']; ?>

<input type="hidden" name="option" value="com_virtuemart" />
<input type="hidden" name="controller" value="user" />
<input type="hidden" name="task" value="" />
<?php echo JHTML::_( 'form.token' ); ?>
</form>

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
