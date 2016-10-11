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
$product_id = $_POST[product_id];
$kuk = $_POST[cookie];
$product_decode = unserialize(stripcslashes($kuk));
	if(!isset($kuk)) {
		if(($key = array_search($product_id,(array)$product_decode)) === false){
			$product_info = array($product_id);
			$product_encode = serialize($product_info);
			echo $product_encode;
		} else {
			echo null;
		}
	} else {
		if(($key = array_search($product_id,(array)$product_decode)) !== false){
			unset($product_decode[$key]);
			$product_encode = serialize($product_decode);
			echo $product_encode;
		} else {
			$product_decode[] = $product_id;
			$product_encode = serialize($product_decode);
			echo $product_encode;
		}
	}
?>