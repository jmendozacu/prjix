<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2017 Amasty (https://www.amasty.com)
 * @package Amasty_Customerattr
 */

$installer = $this;

$installer->startSetup();

$installer->run(
    "

ALTER TABLE `{$this->getTable('customer/eav_attribute')}` ADD  `sorting_order` SMALLINT UNSIGNED NOT NULL ;

"
);

$installer->endSetup(); 