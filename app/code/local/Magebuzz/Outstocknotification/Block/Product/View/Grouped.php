<?php
/*
 * @Copyright (c) 2014 www.magebuzz.com
 */ 
  class Magebuzz_Outstocknotification_Block_Product_View_Grouped extends Mage_Catalog_Block_Product_View_Type_Grouped
  {                                                         
    protected function _prepareLayout()
    {                                                                                   
      $groupedBlock = $this->getLayout()->getBlock('product.info.grouped');     
      $outstockenable = Mage::getStoreConfig('outstocknotification/general/module_enable');

      if($groupedBlock && $outstockenable){
        $groupedBlock->setTemplate('outstocknotification/catalog/product/view/type/grouped.phtml');
      }

    }
  }

?>
