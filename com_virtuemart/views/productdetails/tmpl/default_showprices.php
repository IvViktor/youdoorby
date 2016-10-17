<?php
/**
 *
 * Show the product details page
 *
 * @package	VirtueMart
 * @subpackage
 * @author Max Milbers, Valerie Isaksen

 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_showprices.php 5406 2012-02-09 12:22:33Z alatak $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
?>
<div class="product-price" id="productPrice<?php echo $this->product->virtuemart_product_id ?>">
    <?php
    if ($this->product->product_unit && VmConfig::get('price_show_packaging_pricelabel')) {
	echo "<strong>" . JText::_('COM_VIRTUEMART_CART_PRICE_PER_UNIT') . ' (' . $this->product->product_unit . "):</strong>";
    } else {
	echo "<strong>" . JText::_('COM_VIRTUEMART_CART_PRICE') . "</strong>";
    }

    if (empty($this->product->prices) and VmConfig::get('askprice', 1)) {
	?>
        <a class="ask-a-question bold" href="<?php echo $url ?>" ><?php echo JText::_('COM_VIRTUEMART_PRODUCT_ASKPRICE') ?></a>
    <?php
    }
    if ($this->showBasePrice) {
	echo $this->currency->createPriceDiv('basePrice', 'COM_VIRTUEMART_PRODUCT_BASEPRICE', $this->product->prices);
	echo $this->currency->createPriceDiv('basePriceVariant', 'COM_VIRTUEMART_PRODUCT_BASEPRICE_VARIANT', $this->product->prices);
    }

    echo $this->currency->createPriceDiv('variantModification', '', $this->product->prices);
    echo $this->currency->createPriceDiv('basePriceWithTax', '', $this->product->prices);
    echo $this->currency->createPriceDiv('discountedPriceWithoutTax', '', $this->product->prices);
    echo $this->currency->createPriceDiv('salesPriceWithDiscount', '', $this->product->prices);
    echo $this->currency->createPriceDiv('salesPrice', '', $this->product->prices);
    echo $this->currency->createPriceDiv('priceWithoutTax', '', $this->product->prices);
    echo $this->currency->createPriceDiv('discountAmount', '', $this->product->prices);
    echo $this->currency->createPriceDiv('taxAmount', '', $this->product->prices);
    ?>
</div>