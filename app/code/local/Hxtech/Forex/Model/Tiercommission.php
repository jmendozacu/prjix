<?php

class Hxtech_Forex_Model_Tiercommission extends Mage_Core_Model_Abstract
{
    public function _construct() 
    {
        parent::_construct();
        $this->_init('forex/tiercommission');
    }

    public function saveTierCommission($tierData, $financierId)
    {
    	unset($tierData['delete']);
    	$oldId = $tierData['id'];

    	if($oldId){
    		$this->load($oldId);
    	}else{
    		unset($tierData['id']);
    	}

    	$this->setData($tierData);
    	$this->setFinancierId($financierId);
    	try {
    		$this->save();
    	} catch (Exception $e) {
    		Mage::logException($e->getMessage());
    	}
    }

    public function deleteTierCommission($tierData)
    {
    	$oldId = $tierData['id'];
    	if($oldId){
    		$this->load($oldId);
    	}
    	try {
    		$this->delete();
    	} catch (Exception $e) {
    		Mage::logException($e->getMessage());
    	}
    }
}