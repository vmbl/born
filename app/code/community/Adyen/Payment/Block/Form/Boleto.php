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
class Adyen_Payment_Block_Form_Boleto extends Mage_Payment_Block_Form {

    protected function _construct() {
        $paymentMethodIcon = $this->getSkinUrl('images'.DS.'adyen'.DS."img_trans.gif");
        $label = Mage::helper('adyen')->_getConfigData("title", "adyen_boleto");

        $mark = Mage::getConfig()->getBlockClassName('core/template');
        $mark = new $mark;
        $mark->setTemplate('adyen/payment/payment_method_label.phtml')
            ->setPaymentMethodIcon($paymentMethodIcon)
            ->setPaymentMethodLabel($label)
            ->setPaymentMethodClass("adyen_boleto");

        $this->setTemplate('adyen/form/boleto.phtml')
            ->setMethodTitle('')
            ->setMethodLabelAfterHtml($mark->toHtml());

        parent::_construct();
    }

    /**
     * Retrieve availables boleto card types
     *
     * @return array
     */
    public function getBoletoAvailableTypes() {
        return $this->getMethod()->getAvailableBoletoTypes();
    }


    public function getFirstname() {
        $firstname = "";

        // check if user is logged in
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            /* Get the customer data */
            $customer = Mage::getSingleton('customer/session')->getCustomer();
            $firstname = $customer->getFirstname();

        } else {
            $firstname = Mage::getSingleton('checkout/session')->getQuote()->getBillingAddress()->getFirstname();
        }
        return $firstname;
    }

    public function getLastname() {
        $lastname = "";

        // check if user is logged in
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            /* Get the customer data */
            $customer = Mage::getSingleton('customer/session')->getCustomer();
            $lastname = $customer->getLastname();

        } else {
            $lastname = Mage::getSingleton('checkout/session')->getQuote()->getBillingAddress()->getLastname();
        }
        return $lastname;
    }

    public function getUseTaxvat() {
        return $this->getMethod()->getUseTaxvat();
    }

    public function getTaxvat() {
        $taxvat = "";

        // check if user is logged in
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            /* Get the customer data */
            $customer = Mage::getSingleton('customer/session')->getCustomer();
            $taxvat = $customer->getTaxvat();

        } else {
            //getCustomerTaxvat
            $taxvat = Mage::getSingleton('checkout/session')->getQuote()->getCustomerTaxvat();
        }
        return $taxvat;
    }

}
