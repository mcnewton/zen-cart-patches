<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: navigation.php 16937 2010-07-20 17:21:37Z drbyte $
 */

?>
<ul>
  <li id="welcome">Welcome</li>
  <li id="licenseaccept">License</li>
  <li id="inspection">Prerequisites</li>
  <li id="database">Database Setup</li>
<?php if ((isset($is_upgradable) && $is_upgradable) || (isset($is_upgrade) && $is_upgrade)) { ?>
  <li id="databaseupg">Database Upgrade</li>
<?php } ?>
  <li id="system">System Setup</li>
<?php if (isset($flag_check_config_keys) && $flag_check_config_keys) { ?>
  <li id="cfgcheck">Config File Check</li>
<?php } ?>
  <li id="store">Store Setup</li>
  <li id="admin">Admin Setup</li>
  <li id="finish">Finished</li>
</ul>