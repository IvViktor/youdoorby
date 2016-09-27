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


  <script type="text/javaScript" src="js/libs/jquery/jquery-1.11.1.min.js"></script>
  <script type="text/javaScript" src="js/libs/jquery-mousewheel/jquery.mousewheel.min.js"></script>
  <script type="text/javaScript" src="js/libs/fancybox/jquery.fancybox.pack.js"></script>
  <script type="text/javaScript" src="js/libs/owl-carousel/owl.carousel.min.js"></script>
  <script type="text/javaScript" src="js/libs/countdown/jquery.plugin.js"></script>

  <jdoc:include type="head" />
</head>
<body class="<?php echo $tpl->getBodyClasses(); ?>">



      <?php if ($tpl->isMobile()) : ?>
        <!-- only for mobiles  -->
      <? endif; ?>

      <?php if ($tpl->isTablet()) : ?>

      <? endif; ?>


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
			<jdoc:include type="modules" name="filterpanel"/>
		  </div>

          <div class="content">
            <jdoc:include type="modules" name="breadcrumbs" />
            <jdoc:include type="component" /> <!-- Контент-->
            <jdoc:include type="modules" name="sidebar" />
            <jdoc:include type="modules" name="slider" />
            <div class="sliderm"><jdoc:include type="modules" name="sliderm" /></div> 
            <div class="showcase"><jdoc:include type="modules" name="showcase" /></div>
           <div class="recommended"> <jdoc:include type="modules" name="recommended" /></div>
            <jdoc:include type="modules" name="last" />
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
