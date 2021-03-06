<?php
/*
NOTICE OF LICENSE

This source file is subject to the SafeMageEULA that is bundled with this package in the file LICENSE.txt.

It is also available at this URL: https://www.safemage.com/LICENSE_EULA.txt

Copyright (c)  SafeMage (https://www.safemage.com/)
*/

class SafeMage_Permissions_Model_Plugin_Restrict_Categories_CatalogCategoryTabAttributes
    extends SafeMage_Permissions_Model_Plugin_Restrict_Categories_Block
{
    /**
     * Prepare readonly elements
     *
     * @param Mage_Adminhtml_Block_Catalog_Category_Tab_Attributes $object
     * @param null
     * @param array $arguments
     */
    public function afterSetFieldset($object, $result, array &$arguments)
    {
        $perm = $this->getPermissions();
        if ($perm && $this->_detect($object) && isset($arguments[0]) && isset($arguments[1])) {
            //$attributes = $arguments[0];
            $fieldset = $arguments[1];

            $this->getFormHelper()->setReadonlyElements($fieldset, $perm);
        }
    }

    /**
     * Detect if this Block should be processed
     *
     * @param Mage_Adminhtml_Block_Catalog_Category_Tab_Attributes $object
     * @return bool
     */
    protected function _detect($object)
    {
        $res = $this->getCategoriesClassHelper()->isCatalogCategoryTabAttributes($object);
        return $res;
    }
}
