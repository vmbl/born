<?php

/**
 * Adyen Payment Module
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category	Adyen
 * @package	Adyen_Payment
 * @copyright	Copyright (c) 2011 Adyen (http://www.adyen.com)
 * @license	http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/**
 * @category   Payment Gateway
 * @package    Adyen_Payment
 * @author     Adyen
 * @property   Adyen B.V
 * @copyright  Copyright (c) 2014 Adyen BV (http://www.adyen.com)
 */
class Adyen_Payment_Model_Mysql4_Order extends Mage_Core_Model_Mysql4_Abstract {

    protected function _construct() {
        $this->_init('sales/order', 'entity_id');
    }

    /**
     * IncrementId exist on the system
     * @param type $incrementId
     * @return array
     */
    public function orderExist($incrementId) {
        $db = $this->_getReadAdapter();
        $sql = $db->select()
                ->from($this->getMainTable(), array('entity_id', 'increment_id'))
                ->where('increment_id = ?', $incrementId)
        ;
        $stmt = $db->query($sql);
        return $stmt->fetch();
    }

}