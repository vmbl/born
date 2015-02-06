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
class Adyen_Payment_Block_Form_Cc extends Mage_Payment_Block_Form_Cc {

    protected function _construct() {
        parent::_construct();

        $paymentMethodIcon = $this->getSkinUrl('images'.DS.'adyen'.DS."img_trans.gif");
        $label = Mage::helper('adyen')->_getConfigData("title", "adyen_cc");

        $mark = Mage::getConfig()->getBlockClassName('core/template');
        $mark = new $mark;
        $mark->setTemplate('adyen/payment/payment_method_label.phtml')
            ->setPaymentMethodIcon($paymentMethodIcon)
            ->setPaymentMethodLabel($label)
            ->setPaymentMethodClass("adyen_cc");

        $this->setTemplate('adyen/form/cc.phtml')
            ->setMethodTitle('')
            ->setMethodLabelAfterHtml($mark->toHtml());
    }
	
    /**
     * Retrieve availables credit card types
     *
     * @return array
     */
    public function getCcAvailableTypes() {
        return $this->getMethod()->getAvailableCCTypes();
    }
    
    public function isCseEnabled() {
        return $this->getMethod()->isCseEnabled();
    }
    public function getCsePublicKey() {
        return $this->getMethod()->getCsePublicKey();
    }
	
    public function getPossibleInstallments(){
        return $this->getMethod()->getPossibleInstallments();
    }
    
    public function hasInstallments(){
        return Mage::helper('adyen/installments')->isInstallmentsEnabled();
    }

    public function getRecurringType() {
        return $this->getMethod()->getRecurringType();
    }

    /**
     * Alway's return true for creditcard verification otherwise api call to adyen won't work
     *
     * @return boolean
     */
    public function hasVerification()
    {
    	return true;
    }

}
