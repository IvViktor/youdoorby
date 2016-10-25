<script>
let totalPrice = <?php echo $this->cart->prices['billTotal'] ?>;
let purshases = [];
let purshaseSumm = <?php echo $this->cart->prices['salesPrice'] ?>;
let discountSumm = <?php echo $this->cart->prices['discountAmount'] ?>;
let shippingSumm = <?php echo $this->cart->prices['salesPriceShipment']; ?>;
<?php
	foreach( $this->cart->products as $pkey =>$prow ) { 
	$productStr = JHTML::link($prow->url, $prow->product_name).$prow->customfields;
	$productStr .= " (комплектов: " .$prow->quantity ."; цена комплекта: " .$prow->salesPrice .");";
?>
	purshases.push(<?php echo $productStr; ?>);
<?php } ?>
function getCustomerName(){
	let name = document.getElementById('customerName').value;
	return name;
}

function getCustomerEmail(){
	let email = document.getElementById('customerEmail').value;
	return email;	
}

function getCustomerPhone(){
	let number = document.getElementById('customerPhoneNumber').value;
	return number;
}

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
}

function getCustomerPayment(){
	let cash = document.getElementById('Choise1').checked;
	let online = document.getElementById('Choise2').checked;
	let bankBill = document.getElementById('Choise3').checked;
	let loan = document.getElementById('Choise4').checked;
	let message = '';
	if(cash) message = "Наличными";
	else if(online) message = "Онлайн оплата";
	else if(bankBill) message = "Бесналичный расчет";
	else if(loan) message = "Рассрочка, кредит";
	return message;
}

function getPurshases(){
	return purshases.join('<br/>');
}

function getHeaderText(){
	return "Поступил заказ на сумму " + totalPrice + " с сайта youdoor.by";
}

function validateCustomerData(){
	return (validateName() && validateEmail() && validatePhone() && validatePayment() && validateShippment());
}

function validateName(){
	let name = getCustomerName();
	if(name.length === 0) return false;
	return /^[A-Za-z\s]+$/.test(name);
}

function validateEmail() {
		let email = getCustomerEmail();
		if(email.length === 0) return false;
		let re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    return re.test(email);
}

function validatePhone(){
	let number = getCustomerPhone();
	if(number.length === 0) return false;
	return /^[+]*[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s\./0-9]*$/g.test(number);
}

function validatePayment(){
	let cash = document.getElementById('Choise1').checked;
	let online = document.getElementById('Choise2').checked;
	let bankBill = document.getElementById('Choise3').checked;
	let loan = document.getElementById('Choise4').checked;
	return (cash || online || bankBill || loan);
}
	
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
}

function confirmOrder(){
	if(validateCustomerData()){
		jQuery.ajax({
			url: "https://formspree.io/viittyok1992@gmail.com",	
			method: "POST",
			dataType: "json",
			data: {
				'_subject': getHeaderText() ,
				'Товары': getPurshases() ,
				'Сумма заказа': purshaseSumm,
				"Суммарная скидка": discountSumm,
				"Плата за доставку": shippingSumm,
				"К оплате": totalPrice,
				"Имя и фамилия покупателя": getCustomerName(),
				"_email": getCustomerEmail(),
				"Телефон покупателя": getCustomerPhone(),
				"Выбраный способ доставки": getCustomerShipping(),
				"Выбраный способ оплаты": getCustomerPayment(),
			   "_next": ""	
			},
			success: function(data){
				document.checkoutForm.submit();
			}	
		});
	}
}
</script>
