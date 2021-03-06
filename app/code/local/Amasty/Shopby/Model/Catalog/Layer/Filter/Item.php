<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2017 Amasty (https://www.amasty.com)
 * @package Amasty_Shopby
 */

/**
 * Class Amasty_Shopby_Model_Catalog_Layer_Filter_Item
 * @method int getCount()
 */
class Amasty_Shopby_Model_Catalog_Layer_Filter_Item extends Mage_Catalog_Model_Layer_Filter_Item
{
    public function getUrl()
    {
        Varien_Profiler::start('amshopby_filter_item_url');

        /** @var Amasty_Shopby_Model_Url_Builder $urlBuilder */
        $urlBuilder = Mage::getModel('amshopby/url_builder');
        $urlBuilder->reset();
        $urlBuilder->clearPagination();

		// Fix for old magento versions (before 1.7.0)
		if($this->getFilter()->getRequestVar() == "price")
		{
			$value = explode(",",$this->getValue());
			if(count($value) > 1) {
				$value = ($value[0]-1)*$value[1]."-".$value[0]*$value[1];
				$this->setValue($value);
			}
		}

        $urlBuilder->changeQuery(array(
            $this->getFilter()->getRequestVar() => $this->getValue(),
        ));

        $url = $urlBuilder->getUrl();
        Varien_Profiler::stop('amshopby_filter_item_url');
        return $url;
    }
    
    
    public function getRemoveUrl()
    {
        Varien_Profiler::start('amshopby_filter_item_url');

        /** @var Amasty_Shopby_Model_Url_Builder $urlBuilder */
        $urlBuilder = Mage::getModel('amshopby/url_builder');
        $urlBuilder->reset();
        $urlBuilder->clearPagination();

        $urlBuilder->changeQuery(array(
            $this->getFilter()->getRequestVar() => $this->getFilter()->getResetValue(),
        ));

        $url = $urlBuilder->getUrl();

        Varien_Profiler::stop('amshopby_filter_item_url');
        return $url;
    }
    
    /**
     * @param bool $isForRemoveUrl
     * @return array
     */
    public function getUrlAttributeOptionConfigAsJson($isForRemoveUrl = false)
    {
        /** @var Amasty_Shopby_Model_Url_Builder $urlBuilder */
        $urlBuilder = Mage::getModel('amshopby/url_builder');
        $urlBuilder->reset();

        $isDecimal = Mage::helper('amshopby/url')->isDecimal($this->getFilter()->getRequestVar());

        // Fix for old magento versions (before 1.7.0)
        if($this->getFilter()->getRequestVar() == "price" || $isDecimal) {
            $value = explode(",",$this->getValue());
            if(count($value) > 1) {
                $value = ($value[0]-1)*$value[1]."-".$value[0]*$value[1];
                $this->setValue($value);
            }
        }

        if($isForRemoveUrl) {
            $additionalData = $urlBuilder->getAttributeOptionConfig($this->getFilter()->getRequestVar(), $this->getFilter()->getResetValue());
        } else {
            $additionalData = $urlBuilder->getAttributeOptionConfig(
                $this->getFilter()->getRequestVar(),
                ($this->getFilter()->getRequestVar() == "price" || $isDecimal) ? $this->getValue() : $this->getOptionId());
        }

        return json_encode($additionalData);
    }
}