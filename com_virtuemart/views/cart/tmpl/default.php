<?php
/**
*
* Layout for the shopping cart
*
* @package	VirtueMart
* @subpackage Cart
* @author Max Milbers
*
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: cart.php 2551 2010-09-30 18:52:40Z milbo $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
JHTML::script('facebox.js', 'components/com_virtuemart/assets/js/', false);
JHTML::stylesheet('facebox.css', 'components/com_virtuemart/assets/css/', false);

JHtml::_('behavior.formvalidation');
$document = &JFactory::getDocument();
$document->addScriptDeclaration("
	jQuery(document).ready(function($) {
		$('div#full-tos').hide();
		$('span.terms-of-service').click( function(){
			//$.facebox({ span: '#full-tos' });
			$.facebox( { div: '#full-tos' }, 'my-groovy-style');
		});
	});
");
$document->addStyleDeclaration('#facebox .content {display: block !important; height: 480px !important; overflow: auto; width: 560px !important; }');
//  vmdebug('cart',$this->cart);
?>

<div class="cart-filter">
<div class="cart-view">
	<div>
	<div class="width50 floatleft">
		<h1><?php echo JText::_('COM_VIRTUEMART_CART_TITLE'); ?></h1>
		<p class="cart-text">Проверьте количество и список товаров в корзине</p>
	</div>
	<?php if (VmConfig::get('oncheckout_show_steps', 1) && $this->checkout_task==='confirm'){
		vmdebug('checkout_task',$this->checkout_task);
		echo '<div class="checkoutStep" id="checkoutStep4">'.JText::_('COM_VIRTUEMART_USER_FORM_CART_STEP4').'</div>';
	} ?>
	<div class="width50 floatleft right">
		<?php // Continue Shopping Button
		if ($this->continue_link_html != '') {
			echo $this->continue_link_html;
		} ?>
	</div>
<div class="clear"></div>
</div>



<?php echo shopFunctionsF::getLoginForm($this->cart,false);
//echo $this->loadTemplate('login');


//
//
//// Continue and Checkout Button
/* The problem here is that we use a form for the quantity boxes and so we cant let the form start here,
 * because we would have then a form in a form.
 *
 * But we cant make an extra form here, because then pressing the above checkout button would not send the
 * user notices for exampel. The solution is to write a javascript which checks and unchecks both tos checkboxes simultan
 * The upper checkout button should than just fire the form below.
 *
<div class="checkout-button-top">

	<?php // Terms Of Service Checkbox
	if(!class_exists('VmHtml'))require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'html.php');
	echo VmHtml::checkbox('tosAccepted',$this->cart->tosAccepted,1,0,'class="terms-of-service"');
	$checked = '';
	//echo '<input class="terms-of-service" type="checkbox" name="tosAccepted" value="1" ' . $this->cart->tosAccepted . '/>

	echo '<span class="tos">'. JText::_('COM_VIRTUEMART_CART_TOS_READ_AND_ACCEPTED').'</span>';
	?>

	<?php // Checkout Button
	echo $this->checkout_link_html;
	$text = JText::_('COM_VIRTUEMART_ORDER_CONFIRM_MNU');
	?>

</div>
	<form method="post" id="checkoutForm" name="checkoutForm" action="<?php echo JRoute::_( 'index.php?option=com_virtuemart' ); ?>">

	<input type='hidden' name='task' value='<?php echo $this->checkout_task; ?>'/>
	<input type='hidden' name='option' value='com_virtuemart'/>
	<input type='hidden' name='view' value='cart'/>
*/

	// This displays the pricelist MUST be done with tables, because it is also used for the emails
	echo $this->loadTemplate('pricelist');
	if ($this->checkout_task) $taskRoute = '&task='.$this->checkout_task;
	//else $taskRoute ='';
	?>




           <div class="forms-all">
	<div class="dannyie">
	<p class="formtext">Данные получателя</p>
<form action="">
<input type="text" class="forma8" placeholder="Имя Фамилия" id="customerName"><br>
<input type="text" class="forma8" placeholder="email" id="customerEmail"><br>
<input type="text" class="forma4" placeholder="+7 (123) 123 12 12" id="customerPhoneNumber"><br>
</form>
   </div>

	  <div id="sposobd">
<p class="formtext">Способ доставки</p>
<form action="">
  <div class="form-in-form">

<input type="radio" id="Choice5" class="choise" name="sposobname">
 <label for="Choice5"><span class="sposobss2">Курьером</span></label>
 <br>
<select class="selectform" id="shippingCity">
    <option selected disabled>Город</option>
    <option value="Значение 1">Минск</option>
    <option value="Значение 2">Выхино</option>
    <option value="Значение 3">Несмачне</option>
    <option value="Значение 4">Гминск</option>
    <option value="Значение 5">Москва</option>
            </select><br>
<input type="text" class="forma1" placeholder="Улица" id="shippingStreet"><br>
<input type="text" class="forma2" placeholder="Дом" id="shippingHouse">
<input type="text" class="forma2" placeholder="Кв." id="shippingFlat"><br>
  </div>
  <div class="choose">
<input type="radio" id="Choice6" class="choise" name="sposobname">
 <label for="Choice6"><span class="sposobss">Самовывоз</span></label>
 <br>
 </div>
</form>
      </div>




<div id="sposob">
<p class="formtext">Способ оплаты</p>
 <input type="radio" id="Choice1" class="choise" name="Choice">
 <label for="Choice1"><span class="sposobss">Наличными</span></label>
 <br>

 <input type="radio" id="Choice2" class="choise" name="Choice">
 <label for='Choice2'><span class="sposobss">Онлайн оплата</span>
 </label><br>

 <input type="radio" id="Choice3"  class="choise" name="Choice">
 <label for='Choice3'>Бесналичный расчет<br><span class="sposobs1">(для юр.лиц)</span></label><br>

 <input type="radio" id="Choice4"  class="choise" name="Choice">
 <label for="Choice4"><span class="sposobss">Рассрочка, кредит</span>
 <br>
 <span class="sposobs">(оформление в офисе)</span></label><br>
</div>	
                   </div>


	<form method="post" id="checkoutForm" name="checkoutForm" action="<?php echo JRoute::_( 'index.php?option=com_virtuemart&view=cart'.$taskRoute,$this->useXHTML,$this->useSSL ); ?>">
<div class="totalprices">
<table class="tableprices">
   <tr><td>Сумма заказа:</td><td><?php echo $this->cart->prices['salesPrice'] ?></td>
    <tr><td>Суммарная скидка: </td><td><?php echo $this->cart->prices['discountAmount'] ?></td>
   <tr><td>Доставка: </td><td><?php echo $this->cart->prices['salesPriceShipment']; ?> </td>
  </table>
</div>
              

<div class="total">
<table class="tableprices-2">
   <tr><td>К оплате:</td><td><?php echo $this->cart->prices['billTotal'] ?></td>
  </table>
</div>

		<button type="button" class="vm-button-correct"
			 id="confirmOrderButton">
			Оформить заказ
		</button>
		    <?php

			//echo $this->checkout_link_html;
			//$text = JText::_('COM_VIRTUEMART_ORDER_CONFIRM_MNU');
			?>
		<?php //vmdebug('my cart',$this->cart);// Continue and Checkout Button END ?>

		<input type='hidden' name='task' value='<?php echo $this->checkout_task; ?>'/>
		<input type='hidden' name='option' value='com_virtuemart'/>
		<input type='hidden' name='view' value='cart'/>
	</form>
</div> 
<script language="javascript">
let adminEmail = 'example@example.com'; 
let totalprice = '<?php echo $this->cart->prices['billTotal'] ?>';
let purshases = [];
let purshaseSumm = '<?php echo $this->cart->prices['salesPrice'] ?>';
let discountSumm = '<?php echo $this->cart->prices['discountAmount'] ?>';
let shippingSumm = '<?php echo $this->cart->prices['salesPriceShipment'] ?>';
<?php
	foreach( $this->cart->products as $pkey =>$prow ) { 
		$productStr = $prow->product_name;
		$productStr .= " ( Артикул: ".$prow->product_sku ."; комплектов: " .$prow->quantity ."; цена комплекта: " .$prow->salesPrice .");";
?>
	purshases.push('<?php echo $productStr ?>');
<?php } ?>

let confirmOrder = function(){
	if(validateCustomerData()){
		jQuery.ajax({
			url: "https://formspree.io/"+adminEmail ,	
			method: "POST",
			dataType: "json",
			data: {
				'_subject': getHeaderText() ,
				'Товары': getPurshases() ,
				'Сумма заказа': purshaseSumm,
				"Суммарная скидка": discountSumm,
				"Плата за доставку": shippingSumm,
				"К оплате": totalprice,
				"Имя и фамилия покупателя": getCustomerName(),
				"email": getCustomerEmail(),
				"Телефон покупателя": getCustomerPhone(),
				"Выбраный способ доставки": getCustomerShipping(),
				"Выбраный способ оплаты ": getCustomerPayment(),
				"_format": 'html'
			},
			success: function(data){
				document.getElementById('checkoutForm').submit();
				//console.log(data);
			}	
		});
	}
};

function getCustomerName(){
	let name = document.getElementById('customerName').value;
	return name;
};

function getCustomerEmail(){
	let email = document.getElementById('customerEmail').value;
	return email;	
};

function getCustomerPhone(){
	let number = document.getElementById('customerPhoneNumber').value;
	return number;
};

function getCustomerShipping(){
	let courier = document.getElementById('Choice5').checked;
	let selfShipping = document.getElementById('Choice6').checked;	
	let message = '';
	if(selfShipping) message = "Cамовывоз";
	if(courier){
		message = "Курьером по адресу: ";
		let city = document.getElementById('shippingCity').value;
		let street = document.getElementById('shippingStreet').value;
		let house = document.getElementById('shippingHouse').value;
		let flat = document.getElementById('shippingFlat').value;
		message += city + ", ул."+ street + ", дом " + house;
		if(flat.length > 0) message += ", кв." + flat;
	}
	return message;
};

function getCustomerPayment(){
	let cash = document.getElementById('Choice1').checked;
	let online = document.getElementById('Choice2').checked;
	let bankBill = document.getElementById('Choice3').checked;
	let loan = document.getElementById('Choice4').checked;
	let message = '';
	if(cash) message = "Наличными";
	else if(online) message = "Онлайн оплата";
	else if(bankBill) message = "Бесналичный расчет";
	else if(loan) message = "Рассрочка, кредит";
	return message;
}

function getPurshases(){
	return purshases.join('\r\n');
};

function getHeaderText(){
	return "Поступил заказ на сумму " + totalprice + " с сайта youdoor.by";
};

function validateCustomerData(){
		if(purshases.length === 0) return false;
		if (validateName() && validateEmail() && validatePhone() && validatePayment() && validateShippment()) return true;
		return false;
};

function validateName(){
	let name = getCustomerName();
	if(name == '') return false;
	return /^[A-Za-z\s]+$/.test(name);
};

function validateEmail() {
		let email = getCustomerEmail();
		if(email == '') return false;
		let re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    return re.test(email);
};

function validatePhone(){
	let number = getCustomerPhone();
	if(number == '') return false;
	return /^[+]*[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s\./0-9]*$/g.test(number);
};

function validatePayment(){
	let cash = document.getElementById('Choice1').checked;
	let online = document.getElementById('Choice2').checked;
	let bankBill = document.getElementById('Choice3').checked;
	let loan = document.getElementById('Choice4').checked;
	return (cash || online || bankBill || loan);
};
	
function validateShippment(){
	let courier = document.getElementById('Choice5').checked;
	let selfShipping = document.getElementById('Choice6').checked;	
	if(selfShipping) return true;
	if(courier){
		let city = document.getElementById('shippingCity');
		let street = document.getElementById('shippingStreet');
		let house = document.getElementById('shippingHouse');
		let flat = document.getElementById('shippingFlat');
		if((city.value.length > 0) && (street.value.length > 0) && (house.value.length > 0)){
			return true;
		}
	}
	return false;
};

document.getElementById('confirmOrderButton').addEventListener('click',() => {confirmOrder();},false);
</script>
