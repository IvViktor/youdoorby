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
$controller = JController::getInstance('vm_favorite'); // Получаем экземпляр контроллера с префиксом vm_favorite.

class vm_favoriteModelvm_favorite extends JModel {
	public function getTitle() {
		if (!isset($this->_title)) {
			$this->_title = 'Ваши избранные товары';
		}
		return $this->_title;
	}
}