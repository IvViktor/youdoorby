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
$product_decode = unserialize(stripcslashes($_COOKIE['vm_favorites']));
if((array_search($productId,(array)$product_decode)) === false) $deleted = 'deleted'; else $deleted = '';
?>
<script>
function send<?php echo $productId ?>() {
	var product_id = jQuery('#product_id<?php echo $productId ?>').val()
	jQuery.ajax({
		type: "POST",
		url: "<?php echo JURI::root() ?>components/com_vm_favorite/script/script.php",
		data:  ( {'product_id' : product_id, 'cookie' : jQuery.cookie('vm_favorites')} ),
		success: function(favorite) {
			/*jQuery("#result<?php echo $productId ?>").empty(); //Для отладки работы скрипта
			jQuery("#result<?php echo $productId ?>").append(favorite);*/
			jQuery.cookie('vm_favorites',favorite, {path: "/",domain: "<?php echo $_SERVER['SERVER_NAME'] ?>"});//запись в куки
			jQuery("#favorite_button<?php echo $productId ?>").toggleClass("deleted");
			getWishListCount();
		}
	});
}
</script>
<form action="" method="post" style="display: inline;width: 100%;">
	<input type="button" id="favorite_button<?php echo $productId ?>" onclick="send<?php echo $productId ?>();" title="В избранное" class="favorite_button <?php echo $deleted ?>">
	<input type="hidden" id="product_id<?php echo $productId ?>" value="<?php echo $productId ?>">
</form>
<!--Для отладки работы скрипта-->
<!--<div id="result<?php echo $productId ?>"></div>-->
