<?php
/**
*
* Modify user form view, User info
* This file is OBSOLETE, because the bankinformation should be done by a payment plugin
*
* @package	VirtueMart
* @subpackage User
* @author Oscar van Eijk, Max Milbers
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: edit_payment.php 2570 2010-10-08 17:20:10Z milbo $
*/

//
//// Check to ensure this file is included in Joomla!
//defined('_JEXEC') or die('Restricted access'); ?>
//
//<?php 
//	$_k = 0;
//	$_set = false;
//	$_table = false;
//	$_hiddenFields = '';
//
//	if (count($this->bankInfo['functions']) > 0) {
//		echo '<script language="javascript">'."\n";
//		echo join("\n", $this->bankInfo['functions']);
//		echo '</script>'."\n";
//	}
//	for ($_i = 0, $_n = count($this->bankInfo['fields']); $_i < $_n; $_i++) {
//		// Do this at the start of the loop, since we're using 'continue' below!
//		if ($_i == 0) {
//			$_field = current($this->bankInfo['fields']);
//		} else {
//			$_field = next($this->bankInfo['fields']);
//		}
//
//		if ($_field['hidden'] == true) {
//			$_hiddenFields .= $_field['formcode']."\n";
//			continue;
//		}
//		if ($_field['type'] == 'delimiter') {
//			if ($_set) {
//				// We're in Fieldset. Close this one and start a new
//				if ($_table) {
//					echo '	</table>'."\n";
//					$_table = false;
//				}
//				echo '</fieldset>'."\n";
//			}
//			$_set = true;
//			echo '<fieldset>'."\n";
//			echo '	<legend>'."\n";
//			echo '		' . $_field['title'];
//			echo '	</legend>'."\n";
//			continue;
//		}
//
//		if (!$_table) {
//			// A table hasn't been opened as well. We need one here, 
//			echo '	<table class="adminform">'."\n";
//			$_table = true;
//		}
//		echo '		<tr>'."\n";
//		echo '			<td class="key">'."\n";
//		echo '				<label for="'.$_field['name'].'_field">'."\n";
//		echo '					'.$_field['title'] . ($_field['required']?' *': '')."\n";
//		echo '				</label>'."\n";
//		echo '			</td>'."\n";
//		echo '			<td>'."\n";
//		echo '				'.$_field['formcode']."\n";
//		echo '			</td>'."\n";
//		echo '		</tr>'."\n";
//	}
//
//	if ($_table) {
//		echo '	</table>'."\n";
//	}
//	if ($_set) {
//		echo '</fieldset>'."\n";
//	}
//	echo $_hiddenFields;
//?>