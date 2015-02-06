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
class Adyen_Payment_Block_Form_Pos extends Mage_Payment_Block_Form {

    protected function _construct() {
        $paymentMethodIcon = $this->getSkinUrl('images'.DS.'adyen'.DS."img_trans.gif");
        $label = Mage::helper('adyen')->_getConfigData("title", "adyen_pos");

        $mark = Mage::getConfig()->getBlockClassName('core/template');
        $mark = new $mark;
        $mark->setTemplate('adyen/payment/payment_method_label.phtml')
            ->setPaymentMethodIcon($paymentMethodIcon)
            ->setPaymentMethodLabel($label)
            ->setPaymentMethodClass("adyen_pos");

        $this->setTemplate('adyen/form/pos.phtml')
            ->setMethodTitle('')
            ->setMethodLabelAfterHtml($mark->toHtml());

        parent::_construct();
    }
}