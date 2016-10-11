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
defined('_JEXEC') or die('Restricted access'); // Запрет прямого доступа!
jimport('joomla.application.component.controller'); // Подключаем библиотеку контроллера Joomla.
JLog::addLogger(array('text_file' => 'com_vm_favorite.php'), JLog::ALL, array('com_vm_favorite')); // Подключаем логирование.
JError::$legacy = false; // Устанавливаем обработку ошибок в режим использования Exception.

$controller = JController::getInstance('vm_favorite'); // Получаем экземпляр контроллера с префиксом vm_favorite.

// Исполняем задачу task из Запроса.
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task', 'display'));

$controller->redirect(); // Перенаправляем, если перенаправление установлено в контроллере.
?>