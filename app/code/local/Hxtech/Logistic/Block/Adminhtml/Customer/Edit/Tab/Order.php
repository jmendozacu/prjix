<?php

class Hxtech_Logistic_Block_Adminhtml_Customer_Edit_Tab_Order extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('list_importer_order');
        $this->setDefaultSort('created_at');
        $this->setDefaultDir('desc');
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $currentImporterId = $this->getRequest()->getParam('id');
        $collection = Mage::getModel('sales/order')->getCollection()->addFieldToFilter('customer_id', $currentImporterId);
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('real_order_id', array(
            'header'=> Mage::helper('sales')->__('Order #'),
            'width' => '80px',
            'type'  => 'text',
            'index' => 'increment_id',
        ));

        $this->addColumn('status', array(
            'header' => Mage::helper('sales')->__('Status'),
            'index' => 'status',
            'type'  => 'options',
            'width' => '70px',
            'options' => Mage::getSingleton('sales/order_config')->getStatuses(),
        ));

        $this->addColumn('created_at', array(
            'header' => Mage::helper('sales')->__('Purchased On'),
            'index' => 'created_at',
            'type' => 'datetime',
            'width' => '100px',
        ));

        $this->addColumn('grand_total', array(
            'header' => Mage::helper('sales')->__('Total Order Value of Goods Sold'),
            'index' => 'grand_total',
            'type'  => 'currency',
            'currency' => 'base_currency_code',
        ));

        $this->addColumn('subtotal', array(
            'header' => Mage::helper('sales')->__('Total Invoice Value'),
            'index' => 'subtotal',
            'type'  => 'currency',
            'currency' => 'order_currency_code',
        ));

        $this->addColumn('importer_commission_type', array(
            'header' => Mage::helper('sales')->__('Commission Algorithm'),
            'index' => 'importer_commission_type',
            'type'  => 'options',
            'width' => '70px',
            'options' => Mage::getSingleton('logistic/logistic')->getCommissionTypeOptions(),
        ));

        $this->addColumn('importer_commission_fee', array(
            'header' => Mage::helper('sales')->__('Commission Fee'),
            'index' => 'importer_commission_fee',
            'type'  => 'currency',
            'currency' => 'order_currency_code',
        ));

        /*$this->addColumn('action',
            array(
                'header'    =>  Mage::helper('sales')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('sales')->__('Detail'),
                        'url'       => array('base'=> 'adminhtml/sales_order/view'),
                        'field'     => 'order_id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
            )
        );*/

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return false;
    }
}