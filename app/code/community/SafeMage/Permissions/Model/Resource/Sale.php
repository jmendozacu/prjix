<?php
/*
NOTICE OF LICENSE

This source file is subject to the SafeMageEULA that is bundled with this package in the file LICENSE.txt.

It is also available at this URL: https://www.safemage.com/LICENSE_EULA.txt

Copyright (c)  SafeMage (https://www.safemage.com/)
*/

class SafeMage_Permissions_Model_Resource_Sale extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('safemage_permissions/sale', 'item_id');
    }
}