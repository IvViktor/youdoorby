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
				
<div class="browse-view width80">


				<div class="width70 floatleft">
					<?php echo $this->orderByList['orderby'];?>
				</div>

<h1>Товары в избранном:</h1>
<div class='wishlist-prodperpage'>
	Выводить по:
	<span><a href='/wishlist?limit=20' title='Выводить по 20'>20</a></span>
	<span><a href='/wishlist?limit=40' title='Выводить по 40'>40</a></span>
	<span><a href='/wishlist?limit=0' title='Вывести все '>Все</a></span>
</div>
<?php
$cookiename = 'vm_favorites';
$cookie = $_COOKIE[$cookiename];
$product_decode = unserialize(stripcslashes($cookie));
$prodPerPage = JRequest::getInt('limit',20);
$pageNumber = JRequest::getInt('start',0);
$BrowseTotalProducts = count($product_decode);
jimport('joomla.html.pagination');
$WlPagination = new JPagination($BrowseTotalProducts,$pageNumber,$prodPerPage);
if ($product_decode != null) {
	echo $this->loadTemplate('view');
} else {
	echo '<p>Вы не добавляли товары в избранное!</p>';
}
if ($iBrowseCol != 1) { ?>
<div class="clear"></div>
<?php } ?>
	<div class='wishlist-pagination'>
		<?php
			echo $WlPagination->getPagesLinks();
		?>
	</div>
</div>
