<?php
/*
NOTICE OF LICENSE

This source file is subject to the SafeMageEULA that is bundled with this package in the file LICENSE.txt.

It is also available at this URL: https://www.safemage.com/LICENSE_EULA.txt

Copyright (c)  SafeMage (https://www.safemage.com/)
*/

class SafeMage_Permissions_Model_Plugin_Restrict_Products_RendererFieldsetElement
    extends SafeMage_Permissions_Model_Plugin_Restrict_CatalogFormRendererFieldsetElement
{
    /**
     * Product Permissions of current admin
     *
     * @return SafeMage_Permissions_Model_Product
     */
    public function getPermissions()
    {
        $perm = $this->getSession()->getPermissions('product');
        return $perm;
    }

    public function getEntityTypeId()
    {
        return 4;
    }
}
