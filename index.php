<?php
/**
 * Template for Joomla by JBlank.pro (JBZoo.com)
 *
 * @package    JBlank
 * @author     SmetDenis <admin@jbzoo.com>
 * @copyright  Copyright (c) JBlank.pro
 * @license    http://www.gnu.org/licenses/gpl.html GNU/GPL
 * @link       http://jblank.pro/ JBlank project page
 */

 

defined('_JEXEC') or die;


// init $tpl helper
require dirname(__FILE__) . '/php/init.php';

?><?php echo $tpl->renderHTML(); ?>
<head>

<?php
$doc = JFactory::getDocument(); // получаем параметры 
$doc->addStyleSheet(JUri::base().'/templates/'.$this->template.'/css/menu.css'); // подключаем файл стилей
$doc->addScript('http://code.jquery.com/jquery-latest.min.js'); //подключаем последнюю версию библиотеки jQuery 
$doc->addScript(JUri::base().'/templates/'.$this->template.'/js/menu-collapsed.js'); // подключаем скрипт меню, в данном случае это вариант 1
?>  
 
<?php
$doc = JFactory::getDocument(); // получаем параметры 
$doc->addStyleSheet(JUri::base().'/templates/'.$this->template.'/libs/fancybox/jquery.fancybox.css'); // подключаем файл стилей
$doc->addScript(JUri::base().'/templates/'.$this->template.'/libs/fancybox/jquery.fancybox.pack.js'); // подключаем скрипт меню, в данном случае это вариант 1
$doc->addScript(JUri::base().'/templates/'.$this->template.'/libs/fancybox/jquery.fancybox.js'); // подключаем скрипт меню, в данном случае это вариант 1
?>  
 
<?php
$doc = JFactory::getDocument(); // получаем параметры 
$doc->addStyleSheet(JUri::base().'/templates/'.$this->template.'/css/tcal.css'); // подключаем файл стилей
?>  



<?php
$doc = JFactory::getDocument(); // получаем параметры 
$doc->addScript(JUri::base().'/templates/'.$this->template.'/libs/jquery/jquery-1.11.1.min.js'); // подключаем скрипт меню, в данном случае это вариант 1
?>  


<?php
$doc = JFactory::getDocument(); // получаем параметры 
$doc->addStyleSheet(JUri::base().'/templates/'.$this->template.'/css/style.css'); // подключаем файл стилей
$doc->addScript(JUri::base().'/templates/'.$this->template.'/js/my_scripts.js'); // подключаем скрипт меню, в данном случае это вариант 1
$doc->addScript(JUri::base().'/templates/'.$this->template.'/js/cart.js'); // подключаем скрипт меню, в данном случае это вариант 1
?>  

<?php
$doc = JFactory::getDocument(); // получаем параметры 
$doc->addScript(JUri::base().'/templates/'.$this->template.'/js/popup.js'); // подключаем скрипт меню, в данном случае это вариант 1
?>  

<?php
$doc = JFactory::getDocument(); // получаем параметры 
$doc->addScript(JUri::base().'/templates/'.$this->template.'/js/checkbox.js'); // подключаем скрипт меню, в данном случае это вариант 1
?>  

  

 
  <style type="text/css">
    <? include "css/template.css" ?>
  </style>
  
  <style type="text/css">
    <? include "css/template2.css" ?>
  </style>  
  
  <style type="text/css">
    <? include "css/template3.css" ?>
  </style>

  <style type="text/css">
    <? include "libs/font-awesome-4.2.0/css/font-awesome.min.css" ?>
  </style>

  <style type="text/css">
    <? include "libs/fancybox/jquery.fancybox.css" ?>
  </style>
  
  <style type="text/css">
    <? include "libs/owl-carousel/owl.carousel.css" ?>
  </style>
  
  <style type="text/css">
    <? include "libs/countdown/jquery.countdown.css" ?>
  </style>
  
  <style type="text/css">
    <? include "css/fonts.css" ?>
  </style>
  
  <style type="text/css">
    <? include "css/media.css" ?>
  </style>
  

<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

  <script type="text/javaScript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.1.5/angular.js"></script>
  <script type="text/javaScript" src="js/libs/jquery-mousewheel/jquery.mousewheel.min.js"></script>
  <script type="text/javaScript" src="js/jquery-1.7.1.min.js"></script>
  <script type="text/javaScript" src="js/libs/owl-carousel/owl.carousel.min.js"></script>
<!-- Подключен скрипт для вывода количества избраных товаров -->
<script>
	function getWishListCount(){
		jQuery.ajax({
			type: "POST",
			url: "<?php echo JURI::root() ?>components/com_vm_favorite/script/numberscript.php",
			data: ( {'cookie' : jQuery.cookie('vm_favorites')}),
			success: function(number){
				if(number > 0){
					let heartWrapper = document.getElementsByClassName('wishlist-container')[0];
					heartWrapper.innerHTML += number;
				}
			}
		});
	}	
</script>
  <jdoc:include type="head" />
</head>
<body class="<?php echo $tpl->getBodyClasses(); ?>" onload='getWishListCount()'>



      <?php if ($tpl->isMobile()) : ?>
        <!-- only for mobiles  -->
      <? endif; ?>

      <?php if ($tpl->isTablet()) : ?>

      <? endif; ?>

 <div class="call">           <jdoc:include type="modules" name="call"/> </div>
	  
      <div class="all_content">

        <?php if ($tpl->isError()) : ?>
          <jdoc:include type="message" />
        <?php endif; ?>
        <div class="parent">
          <div class="header">
            <jdoc:include type="modules" name="pre_component" />
            <jdoc:include type="modules" name="logo"/>
            <jdoc:include type="modules" name="contacts" />
            <jdoc:include type="modules" name="callback" />
          </div>
		  
		  <div class="navigation">
			      <jdoc:include type="modules" name="nav" />
            <jdoc:include type="modules" name="search" />
            <jdoc:include type="modules" name="cart" />
		  </div>

          <div class="content">
		<?php if (JRequest::getVar('view') != "frontpage") { ?>
            <jdoc:include type="modules" name="breadcrumbs" />
		<?php } ?>
		<?php $view = JRequest::getVar('view', null); if ($view !== "checkout.index" && $view !== "cart" && $view!== "shop.cart" && $view!== "account.order_details" && $view !== "checkout.thankyou"){?>
		    <jdoc:include type="modules" name="sidebar" />
		<?php } ?>
		<?php $view = JRequest::getVar('view', null); if ($view !== "productdetails" && $view !== "checkout.index" && $view !== "cart" && $view!== "shop.cart" && $view!== "account.order_details" && $view !== "checkout.thankyou"){?>
			<jdoc:include type="modules" name="filterpanel"/>
		<?php } ?>
			
            <div class="component">

			<jdoc:include type="component" /></div> <!-- Контент-->
            <div class="buttons"><jdoc:include type="modules" name="buttons" /></div>
            <jdoc:include type="modules" name="slider" />
            <div class="sliderm"><jdoc:include type="modules" name="sliderm" /></div> 
            <div class="showcase"><jdoc:include type="modules" name="showcase" /></div>
           <div class="recommended"> <jdoc:include type="modules" name="recommended" /></div>
           <div class="last"><jdoc:include type="modules" name="last" /></div> 
            <jdoc:include type="modules" name="text" />
          </div>
          </div>
        </div>

      </div>
	  
	  
          <div class="footer">
            <jdoc:include type="modules" name="post_component" />
            <div class="gallery"><jdoc:include type="modules" name="gallery" /></div>
            <jdoc:include type="modules" name="footer" />
            <jdoc:include type="modules" name="footer-back" />
      </div>

	  
 
      <?php echo $tpl->partial('counters', array(
        'myVar' => 123
        ));?>

        <?php if ($tpl->isDebug()) : ?>
          <jdoc:include type="modules" name="debug" />
        <?php endif; ?>

      </body></html>
