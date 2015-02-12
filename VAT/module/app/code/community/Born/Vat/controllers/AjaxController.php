<?php

class Born_Vat_AjaxController extends Mage_Core_Controller_Front_Action
{
	 public function setCustomerVatAction()
	 {
	 	$CustomerVat = $this->getRequest()->getParam('vat');
		if($CustomerVat == "")
		{
			Mage::getSingleton('core/session')->unsVatValue();			
		}
		else {
			Mage::getSingleton('core/session')->setVatValue($CustomerVat);			
		}
	 }	 
}
