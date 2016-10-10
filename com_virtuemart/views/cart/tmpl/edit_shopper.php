<?php
/**
 *
 * Modify user form view, User info
 *
 * @package	VirtueMart
 * @subpackage User
 * @author Oscar van Eijk
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit_shopper.php 5401 2012-02-09 08:48:52Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

?>
<?php echo $this->loadTemplate('address_userfields'); ?>
 


<?php echo $this->loadTemplate('address_addshipto');
  
  ?>



<input type="hidden" name="virtuemart_userinfo_id" value="<?php echo $this->virtuemart_userinfo_id; ?>" />
<input type="hidden" name="address_type" value="BT" />
