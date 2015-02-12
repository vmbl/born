<?php
class Born_Vat_Model_Tax_Calculation extends Mage_Tax_Model_Calculation{

 	public function getRate($request){    	
        if (!$request->getCountryId() || !$request->getCustomerClassId() || !$request->getProductClassId()) {
            return 0;
        }
		
        $cacheKey = $this->_getRequestCacheKey($request);
        if (!isset($this->_rateCache[$cacheKey])) {
            $this->unsRateValue();
            $this->unsCalculationProcess();
            $this->unsEventModuleId();
            Mage::dispatchEvent('tax_rate_data_fetch', array(
                'request' => $request));
            if (!$this->hasRateValue()) {
                $rateInfo = $this->_getResource()->getRateInfo($request);
                $this->setCalculationProcess($rateInfo['process']);
                $this->setRateValue($rateInfo['value']);
            } else {
                $this->setCalculationProcess($this->_formCalculationProcess());
            }
            $this->_rateCache[$cacheKey] = $this->getRateValue();
            $this->_rateCalculationProcess[$cacheKey] = $this->getCalculationProcess();
        }
        return $this->_rateCache[$cacheKey];
    }

	protected function _getRequestCacheKey($request)
    {
        $key = $request->getStore() ? $request->getStore()->getId() . '|' : '';
        $key .= $request->getProductClassId() . '|' . $request->getCustomerClassId() . '|'
            . $request->getCountryId() . '|' . $request->getRegionId() . '|' . $request->getPostcode();
        return $key;
    }
	
	public function getRateRequest(
        $shippingAddress = null,
        $billingAddress = null,
        $customerTaxClass = null,
        $store = null)
    {
        if ($shippingAddress === false && $billingAddress === false && $customerTaxClass === false) {
            return $this->getRateOriginRequest($store);
        }
        $address = new Varien_Object();
        $customer = $this->getCustomer();
        $basedOn = Mage::getStoreConfig(Mage_Tax_Model_Config::CONFIG_XML_PATH_BASED_ON, $store);

        if (($shippingAddress === false && $basedOn == 'shipping')
            || ($billingAddress === false && $basedOn == 'billing')
        ) {
            $basedOn = 'default';
        } else {
            if ((($billingAddress === false || is_null($billingAddress) || !$billingAddress->getCountryId())
                && $basedOn == 'billing')
                || (($shippingAddress === false || is_null($shippingAddress) || !$shippingAddress->getCountryId())
                    && $basedOn == 'shipping')
            ) {
                if ($customer) {
                    $defBilling = $customer->getDefaultBillingAddress();
                    $defShipping = $customer->getDefaultShippingAddress();

                    if ($basedOn == 'billing' && $defBilling && $defBilling->getCountryId()) {
                        $billingAddress = $defBilling;
                    } else if ($basedOn == 'shipping' && $defShipping && $defShipping->getCountryId()) {
                        $shippingAddress = $defShipping;
                    } else {
                        $basedOn = 'default';
                    }
                } else {
                    $basedOn = 'default';
                }
            }
        }

        switch ($basedOn) {
            case 'billing':
                $address = $billingAddress;
                break;
            case 'shipping':
                $address = $shippingAddress;
                break;
            case 'origin':
                $address = $this->getRateOriginRequest($store);
                break;
            case 'default':
                $address
                    ->setCountryId(Mage::getStoreConfig(
                    Mage_Tax_Model_Config::CONFIG_XML_PATH_DEFAULT_COUNTRY,
                    $store))
                    ->setRegionId(Mage::getStoreConfig(Mage_Tax_Model_Config::CONFIG_XML_PATH_DEFAULT_REGION, $store))
                    ->setPostcode(Mage::getStoreConfig(
                    Mage_Tax_Model_Config::CONFIG_XML_PATH_DEFAULT_POSTCODE,
                    $store));
                break;
        }
        if (is_null($customerTaxClass) && $customer) {
            $customerTaxClass = $customer->getTaxClassId();
        } elseif (($customerTaxClass === false) || !$customer) {
            $customerTaxClass = Mage::getModel('customer/group')
                    ->getTaxClassId(Mage_Customer_Model_Group::NOT_LOGGED_IN_ID);
        }
        $request = new Varien_Object();
		$VatData = Mage::getSingleton('core/session')->getVatValue();
		if(Mage::getSingleton('customer/session')->isLoggedIn())
		{
			$VatData = $this->getCustomer()->getTaxvat();
		}
		else 
		{
			$VatData = Mage::getSingleton('core/session')->getVatValue();	
		}
		if($VatData != "")
		{
			$request
             	->setCountryId($address->getCountryId())
           	 	->setRegionId($address->getRegionId())
           		->setPostcode($address->getPostcode())
           	    ->setStore($store);
       		 return $request;
			
		}
	
        $request
            ->setCountryId($address->getCountryId())
            ->setRegionId($address->getRegionId())
            ->setPostcode($address->getPostcode())
            ->setStore($store)
            ->setCustomerClassId($customerTaxClass);
        return $request;
    }

}