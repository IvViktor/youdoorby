<?php
	$kuk = $_POST[cookie];
	$product_decode = unserialize(stripcslashes($kuk));
	if(!isset($kuk) || ($kuk == '')){
			echo 0;	
	} else {
		echo count($product_decode);
	}
?>
