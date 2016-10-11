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
defined('_JEXEC') or die; // Запрет прямого доступа!
jimport('joomla.html.pane');
jimport('joomla.application.component.view');

echo '<link rel="stylesheet" href="'.$_SERVER['HOST'].'/components/com_vm_favorite/css/style.css" type="text/css">';
echo '<script type="text/javascript" src="'.$_SERVER['HOST'].'/components/com_vm_favorite/script/jquery-2.0.2.min.js"></script>';
echo '<script type="text/javascript" src="'.$_SERVER['HOST'].'/components/com_vm_favorite/script/jquery.cookie.js"></script>';
echo '<link rel="stylesheet" href="'.$_SERVER['HOST'].'/components/com_vm_favorite/css/heart.css" type="text/css">'; ?>
<div class="browse-view width100">
<hr>
<h1><?php echo $this->title; ?></h1>
<?php
$cookiename = 'vm_favorites';
$cookie = $_COOKIE[$cookiename];
$product_decode = unserialize(stripcslashes($cookie));
$BrowseTotalProducts = count($product_decode);
if ($product_decode != null) {
	echo $this->loadTemplate('view');
} else {
	echo '<p>Вы не добавляли товары в избранное!</p>';
}
if ($iBrowseCol != 1) { ?>
<div class="clear"></div>
<?php } ?>
<hr>
</div>