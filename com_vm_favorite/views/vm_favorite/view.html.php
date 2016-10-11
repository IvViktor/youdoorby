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
jimport('joomla.application.component.view'); // Подключаем библиотеку представления Joomla.

class vm_favoriteViewvm_favorite extends JViewLegacy {
	protected $title;
	public function display($tpl = null) {
		$this->title = $this->get('Title'); // Получаем сообщение.

		parent::display($tpl); // Отображаем представление.
	}
}