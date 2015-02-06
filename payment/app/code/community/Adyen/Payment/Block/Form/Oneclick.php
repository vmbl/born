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
class Adyen_Payment_Block_Form_Oneclick extends Adyen_Payment_Block_Form_Cc {

    protected function _construct() {
        parent::_construct();
        $this->setTemplate('adyen/form/oneclick.phtml');
    }

    public function getlistRecurringDetails() {
        return $this->getMethod()->getlistRecurringDetails();
    }

    public function isNotRecurring() {
        return  $this->getMethod()->isNotRecurring();
    }

    public function getInstallmentForCreditCardType($ccType) {

        // map $ccType to creditcard type we saved in backend

        $ccType = Mage::helper('adyen/data')->getMagentoCreditCartType($ccType);
        $result = Mage::helper('adyen/installments')->getInstallmentForCreditCardType($ccType);

        return $result;
    }
}
