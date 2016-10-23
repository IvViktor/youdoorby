<?php

/**
 *
 * Show the product details page
 *
 * @package	VirtueMart
 * @subpackage
 * @author Max Milbers, Eugen Stranz
 * @author RolandD,
 * @todo handle child products
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default.php 5444 2012-02-15 15:31:35Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
echo '<script type="text/javascript" src="'.$_SERVER['HOST'].'/components/com_vm_favorite/script/jquery-2.0.2.min.js"></script>'; //Закомментируйте эту строчку, если эта библиотека конфликтует с другим jQuery
echo '<script type="text/javascript" src="'.$_SERVER['HOST'].'/components/com_vm_favorite/script/jquery.cookie.js"></script>';
echo '<link rel="stylesheet" href="'.$_SERVER['HOST'].'/components/com_vm_favorite/css/heart.css" type="text/css">';
// addon for joomla modal Box
JHTML::_('behavior.modal');
// JHTML::_('behavior.tooltip');
$url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&task=askquestion&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&tmpl=component');
$document = &JFactory::getDocument();
$document->addScriptDeclaration("
	jQuery(document).ready(function($) {
		$('a.ask-a-question').click( function(){
			$.facebox({
				iframe: '" . $url . "',
				rev: 'iframe|550|550'
			});
			return false ;
		});
	/*	$('.additional-images a').mouseover(function() {
			var himg = this.href ;
			var extension=himg.substring(himg.lastIndexOf('.')+1);
			if (extension =='png' || extension =='jpg' || extension =='gif') {
				$('.main-image img').attr('src',himg );
			}
			console.log(extension)
		});*/
	});
");
/* Let's see if we found the product */
if (empty($this->product)) {
    echo JText::_('COM_VIRTUEMART_PRODUCT_NOT_FOUND');
    echo '<br /><br />  ' . $this->continue_link_html;
    return;
}
?>

<div class="productdetails-view">
	<?php
	}
	unset($flt_html);

	//reset all link
	if(!empty($resetUri)){?>
  <script>
  
  $(function(){
	  setTimeout(function(){  
	  $("#sbox-content iframe").contents().find("body").append("  <style type="text/css"><? include "css/template2.css" ?>");
	  }, 3000);  
	  }); 
  
  </script>
<?php $productId = $this->product->virtuemart_product_id; // при необходимости поменять на переменную id продукта
include ($_SERVER['DOCUMENT_ROOT'].'/components/com_vm_favorite/script/heart.php'); ?>

    <?php
    // Product Navigation
    if (VmConfig::get('product_navigation', 1)) { ?>
	 <div class="product-neighbours">
	    <?php
	    if (!empty($this->product->neighbours ['previous'][0])) {
		$prev_link = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->neighbours ['previous'][0] ['virtuemart_product_id'] . '&virtuemart_category_id=' . $this->product->virtuemart_category_id);
		echo JHTML::_('link', $prev_link, $this->product->neighbours ['previous'][0]
			['product_name'], array('class' => 'previous-page'));
	    }
	    if (!empty($this->product->neighbours ['next'][0])) {
		$next_link = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->neighbours ['next'][0] ['virtuemart_product_id'] . '&virtuemart_category_id=' . $this->product->virtuemart_category_id);
		echo JHTML::_('link', $next_link, $this->product->neighbours ['next'][0] ['product_name'], array('class' => 'next-page'));
	    }
	    ?>
    	<div class="clear"></div>
        </div>
    <?php } // Product Navigation END
    ?>

    <?php // Product Title  ?>
    <h1><?php echo $this->product->product_name ?></h1>
    <?php // Product Title END  ?>

    <?php
    // Product Edit Link
    echo $this->edit_link;
    // Product Edit Link END
    ?>

    <?php // PDF - Print - Email Icon
    if (VmConfig::get('show_emailfriend') || VmConfig::get('show_printicon') || VmConfig::get('pdf_button_enable')) { ?>
	 <div class="icons">
	    <?php
	    //$link = (JVM_VERSION===1) ? 'index2.php' : 'index.php';
	    $link = 'index.php?tmpl=component&option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->virtuemart_product_id;
	    $MailLink = 'index.php?option=com_virtuemart&view=productdetails&task=recommend&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&tmpl=component';

	    if (VmConfig::get('pdf_icon', 1) == '1') {
		echo $this->linkIcon($link . '&format=pdf', 'COM_VIRTUEMART_PDF', 'pdf_button', 'pdf_button_enable', false);
	    }
	    echo $this->linkIcon($link . '&print=1', 'COM_VIRTUEMART_PRINT', 'printButton', 'show_printicon');
	    echo $this->linkIcon($MailLink, 'COM_VIRTUEMART_EMAIL', 'emailButton', 'show_emailfriend');
	    ?>
    	<div class="clear"></div>
        </div>
	<?php

	} // PDF - Print - Email Icon END  ?>

    <?php // Product Short Description
    if (!empty($this->product->product_s_desc)) { ?>
        <div class="product-short-description">
	    <?php /** @todo Test if content plugins modify the product description */
	    echo nl2br($this->product->product_s_desc); ?>
        </div>
    <?php
    } // Product Short Description END


    if (!empty($this->product->customfieldsSorted['ontop'])) {
	$this->position='ontop';
	echo $this->loadTemplate('customfields');
    } // Product Custom ontop end
    ?>

    <div>
	<div class="width25 floatleft">
<?php
echo $this->loadTemplate('images');
?>
	</div>

<div class="product-descr">
	
	<div class="width75 floatright">
	    <div class="spacer-buy-area">
		<div class="product-row-1">
			<div class="product-size">
				<form method="post" id="product-size" name="productsize" action="">
					<submit>
				</form>
				<div class="product-size-container"><span class="size">Размеры</span><span class="size-how">Как измерить?</span></div>
				<div class="product-size-list"><table><tr><td><a href="#">600x2000</a></td><td><a href="#">700x2000</a></td><td><a href="#">800x2000</a></td><td><a href="#">900x2000</a></td></tr></table></div>
			</div>
			<div class="product-call">
<a href="#" class="call-3 show_popup" rel="call3" style="text-decoration: none;">Вызвать замерщика</a>
			</div>
			<div class="product-ul">

<div class="product-fields fields-1">Артикул: &nbsp;<?php echo $this->product->product_sku ?></div>
<?php 

    if (!empty($this->product->customfieldsSorted['normal'])) {
	$this->position='normal';
	echo $this->loadTemplate('customfields');
    } ?>

			</div>
		</div>
		<div class="product-row-2">

<?php 


		// Add To Cart Button
// 			if (!empty($this->product->prices) and !empty($this->product->images[0]) and $this->product->images[0]->file_is_downloadable==0 ) {
		if (!VmConfig::get('use_as_catalog', 0) and !empty($this->product->prices)) {
		    echo $this->loadTemplate('addtocart');
			echo '<a class="quick-order-prod show_popup" rel="order">Заказать в один клик</a>';
		}  // Add To Cart Button END
				?>
			<div class="price-container">
				<div class="price-polotno">
					<?php 	// Product Price
					if ($this->show_prices and (empty($this->product->images[0]) or $this->product->images[0]->file_is_downloadable == 0)) {
						echo $this->loadTemplate('showprices');
						echo '<p class="price-complect-span">Полотно</p>';
					}
					?>
				</div>
				<div class="price-complect">
					<?php 		
							if ($this->show_prices and (empty($this->product->images[0]) or $this->product->images[0]->file_is_downloadable == 0)) {
						echo $this->loadTemplate('showprices');
						echo '<p class="price-complect-span-1">Комплект</p>';
						echo '<p class="price-complect-span-2">Комплект состоит из коробки, полотна и наличников с двух сторон</p>';
					}
					?>
				</div>
			</div>

		<div class="product-row-3">
			<div class="product-button">
				<a href="/rassrochka-i-kredit"><div class="button-text">
					<div class="button-container">
						<span style="color: #8cc24a; padding: 18px 25px 10px 0; float: left; font-weight: 900; font-size: 35px; line-height: 0.9em;">%</span>
						<ul>
							<li style="color: #000000; font-size: 16px;{jcomments on}border-bottom: 1px solid #f5f5f5;">Рассрочка и кредит</li>
							<li style="color: #8b8b8b; font-size: 12px;">переплата от 0%</li>
						</ul>
					</div>
				</div></a>
				<a href="/besplatnaya-dostavka"><div class="button-text">
					<div class="button-container">
						<i class="fa fa-truck fa-2x" aria-hidden="true"></i>
						<ul>
							<li style="color: #000000; font-size: 16px; border-bottom: 1px solid #f5f5f5;">Бесплатная доставка</li>
							<li style="color: #8b8b8b; font-size: 12px;">при заказе от 5 000 000 руб.</li>
						</ul>
					</div>
				</div></a>
				<a href="/kak-my-rabotaem"><div class="button-text">
					<div class="button-container">
						<i class="fa fa-list-ol fa-2x" aria-hidden="true"></i>
						<ul>
							<li style="color: #000000; font-size: 16px; border-bottom: 1px solid #f5f5f5;">Как мы работаем</li>
							<li style="color: #8b8b8b; font-size: 12px;">узнайте о нас больше</li>
						</ul>
					</div>
				</div></a>
			</div>
			<div class="product-descr-small">
	<?php	// Product Description
	if (!empty($this->product->product_desc)) { ?>
	<?php /** @todo Test if content plugins modify the product description */ ?>
	<?php echo $this->product->product_desc; ?>
    <?php
    } // Product Description END
?>	
			</div>
		</div>
		<?php // TO DO in Multi-Vendor not needed at the moment and just would lead to confusion
		/* $link = JRoute::_('index2.php?option=com_virtuemart&view=virtuemart&task=vendorinfo&virtuemart_vendor_id='.$this->product->virtuemart_vendor_id);
		  $text = JText::_('COM_VIRTUEMART_VENDOR_FORM_INFO_LBL');
		  echo '<span class="bold">'. JText::_('COM_VIRTUEMART_PRODUCT_DETAILS_VENDOR_LBL'). '</span>'; ?><a class="modal" href="<?php echo $link ?>"><?php echo $text ?></a><br />
		 */ ?>

		<?php
		if ($this->showRating) {
		    $maxrating = VmConfig::get('vm_maximum_rating_scale',5);

				if (empty($this->rating)) { ?>
					<span class="vote"><?php echo JText::_('COM_VIRTUEMART_RATING').' '.JText::_('COM_VIRTUEMART_UNRATED') ?></span>
				<?php } else {
					$ratingwidth = ( $this->rating->rating * 100 ) / $maxrating;//I don't use round as percetntage with works perfect, as for me
					?>
					<span class="vote">
						<?php echo JText::_('COM_VIRTUEMART_RATING').' '.round($this->rating->rating, 2) . '/'. $maxrating; ?><br/>
						<span title=" <?php echo (JText::_("COM_VIRTUEMART_RATING_TITLE") . $this->rating->rating . '/' . $maxrating) ?>" class="vmicon ratingbox" style="display:inline-block;">
							<span class="stars-orange" style="width:<?php echo $ratingwidth;?>%">
							</span>
						</span>
					</span>
					<?php
				}
		}
		?>



<?php 

// Product custom_fields END
    // Product Packaging
    $product_packaging = '';
    if ($this->product->packaging || $this->product->box) { ?>
	  <div class="product-packaging">

	    <?php
	    if ($this->product->packaging) {
		$product_packaging .= JText::_('COM_VIRTUEMART_PRODUCT_PACKAGING1') . $this->product->packaging;
		if ($this->product->box)
		    $product_packaging .= '<br />';
	    }
	    if ($this->product->box)
		$product_packaging .= JText::_('COM_VIRTUEMART_PRODUCT_PACKAGING2') . $this->product->box;
	    echo str_replace("{unit}", $this->product->product_unit ? $this->product->product_unit : JText::_('COM_VIRTUEMART_PRODUCT_FORM_UNIT_DEFAULT'), $product_packaging);
	    ?>
        </div>
   <?php } // Product Packaging END
    ?>

		<?php
		// Availability Image
		/* TO DO add width and height to the image */
		if (!empty($this->product->product_availability)) {
		   $stockhandle = VmConfig::get('stockhandle', 'none');
if ($stockhandle == 'risetime' and ($this->product->product_in_stock - $this->product->product_ordered) < 1) {
    ?>	<div class="availability">
    <?php echo JHTML::image(JURI::root() . VmConfig::get('assets_general_path') . 'images/availability/' . VmConfig::get('rised_availability', '7d.gif'), VmConfig::get('rised_availability', '7d.gif'), array('class' => 'availability')); ?>
    </div>
<?php } else {
    ?>
    <div class="availability">
	<?php echo JHTML::image(JURI::root() . VmConfig::get('assets_general_path') . 'images/availability/' . $this->product->product_availability, $this->product->product_availability, array('class' => 'availability')); ?>
    </div>
<?php
}
		}
		?>

		<?php
		// Ask a question about this product
		if (VmConfig::get('ask_question', 1) == '1') { ?>
		   <div class="ask-a-question">
				<a class="ask-a-question" href="<?php echo $url ?>" ><?php echo JText::_('COM_VIRTUEMART_PRODUCT_ENQUIRY_LBL') ?></a>
				<!--<a class="ask-a-question modal" rel="{handler: 'iframe', size: {x: 700, y: 550}}" href="<?php echo $url ?>"><?php echo JText::_('COM_VIRTUEMART_PRODUCT_ENQUIRY_LBL') ?></a>-->
				</div>
		<?php }
		?>

		<?php
		// Manufacturer of the Product
		if (VmConfig::get('show_manufacturers', 1) && !empty($this->product->virtuemart_manufacturer_id)) {
		    $this->loadTemplate('manufacturer');
		}
		?>

		<div class="product-complect-list">
		<h4>Комплектующие</h4>
		<ul>
		<li class="back-1">
		<div>
		<img src="/images/prod-complect-1.png" class="compl-img">
		<div>
		<p style="color: #424242;">Наличник полукруглый 2150х70х80</p>
		<p style="color: #838383;">120000 руб.</p>
		</div>
		</div>
		</li>
		<li class="back-2">
		<div>
		<img src="/images/prod-complect-2.png" class="compl-img">
		<div>
		<p style="color: #424242;">Наличник прямоугольный 2150х70х80</p>
		<p style="color: #838383;">120000 руб.</p>
		</div>
		</div>
		</li>
		<li class="back-1">
		<div>
		<img src="/images/prod-complect-3.png" class="compl-img">
		<div>
		<p style="color: #424242;">Добор 2150х100х8</p>
		<p style="color: #838383;">120000 руб.</p>
		</div>
		</div>
		</li>
		<li class="back-2">
		<div>
		<img src="/images/prod-complect-4.png" class="compl-img">
		<div>
		<p style="color: #424242;">Наличник прямоугольный 2150х70х80</p>
		<p style="color: #838383;">120000 руб.</p>
		</div>
		</div>
		</li>
		</ul>
		</div>
	    </div>
	</div>
	
	
	
	<div class="clear"></div>
	

	
    </div>

	
    <?php
    // Product Files
    // foreach ($this->product->images as $fkey => $file) {
    // Todo add downloadable files again
    // if( $file->filesize > 0.5) $filesize_display = ' ('. number_format($file->filesize, 2,',','.')." MB)";
    // else $filesize_display = ' ('. number_format($file->filesize*1024, 2,',','.')." KB)";

    /* Show pdf in a new Window, other file types will be offered as download */
    // $target = stristr($file->file_mimetype, "pdf") ? "_blank" : "_self";
    // $link = JRoute::_('index.php?view=productdetails&task=getfile&virtuemart_media_id='.$file->virtuemart_media_id.'&virtuemart_product_id='.$this->product->virtuemart_product_id);
    // echo JHTMl::_('link', $link, $file->file_title.$filesize_display, array('target' => $target));
    // }
    if (!empty($this->product->customfieldsRelatedProducts)) {
	echo $this->loadTemplate('relatedproducts');
    } // Product customfieldsRelatedProducts END

    if (!empty($this->product->customfieldsRelatedCategories)) {
	echo $this->loadTemplate('relatedcategories');
    } // Product customfieldsRelatedCategories END
    // Show child categories
    if (VmConfig::get('showCategory', 1)) {
	echo $this->loadTemplate('showcategory');
    }
    ?>

<?php
echo $this->loadTemplate('reviews');
?>
</div>
