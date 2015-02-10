Magento
=======

This is the Adyen Payment plugin for Magento. The plugin supports the Magento Community and Enterprise edition.

We commit all our new features directly into our GitHub repository.
But you can also request or suggest new features or code changes yourself!

<h2>Setup Module</h2>
<a href="http://vimeo.com/94005128">Click here to see the video how to setup your Adyen Magento module and the Adyen backoffice</a><br />
<a href="https://www.adyen.com/dam/jcr:80ea0213-02cd-43aa-8136-459a471d2a0d/MagentoQuickIntegrationManual.pdf">Click here to download the Magento Quick Integration Guide how to setup the basics for the Adyen Magento module and the Adyen backoffice</a><br />
<a href="https://www.adyen.com/dam/jcr:d0fd4c42-831b-4c4a-b5e5-864cc1410145/AdyenMagentoExtension">For a more advanced manual click here</a>

<h2>Support</h2>
You can create issues on our Magento Repository or if you have some specific problems for your account you can contact <a href="mailto:magento@adyen.com">magento@adyen.com</a>  as well.

<h2>Current Release</h2>
<h3>2.2.0</h3>
<h4>Features</h4>
* #156 CreditCard logos are shown and automatically detected instead of selecting your cart type
* #174 Added Elo and Hipercard to CreditCard types
* #175 Show number of installments in payment details of the order
* #170 Encrypt password fields in configuration settings
* #168 Option to add phonenumber field only for the OpenInvoice payment method
* #113 Show fraudscore in Magento (if you have this setup for your account or if you have Adyen CC payment method enabled)
* #144 Show by default Ideal payment method as a list instead of logos (can be changed in the configurations)
* #140 Added payment logos for all payment methods
* #149 Pre fill country for Payment Method SEPA based on billing information
* #157 Added option to use IPFilter for the payment method Adyen POS
* #150 Create a new  configuration field for Client-Side Encryption Public Key for test
* #114 Added extra setting so you can can define a different status for Downloadable products 
* #165 Option to send out confirmation mail for Banktransfer/SEPA before payment is received
* #176 Added CSE support for IWD One Page Checkout
* #154 Added Filter on N.A in Adyen Status column of sales order grid
* #127 #180 Added translation for Dutch,German,Spanish and French 
* #181 Cash Drawer support for epson ePOS-Device  

<h4>Fixes</h4>
* #152 IOS CheckSum Fix For POS payments
* #172 Update scripts now support tables that have prefixes
* #169 Admin Order is now showing Total Due and Total Refunded
* #126 Change logic for Capture so it will shoot in an api call to Adyen when you use the magento API capture
* #158 Orders not using Adyen Payments can now be cancelled without errors
* #151 #155 Database Optimization for better performance
* #130 Adyen PSP Reference link in order details goes directly to the payment instead of the list with filtering on this PSP Reference.
* #121 Don’t throw exception when there are no payment methods available for the Adyen HPP payment method
* #117 Use for Afterpay afterpay_default payment method instead of old open invoice integration
* #115 Fix validation for Diners cards
* #183 Openinvoice (Afterpay/Klarna) are always manual captured
* #116 Removed specific OneStepCheckout changes from the module, this will be added on GitHub as an external asset

<h2>Previous Releases</h2>
<h3>2.1.1</h3>
<h4>Features</h4>
* Make installments possible for the OneClick Payments
* Added cash express checkout button on the shopping card for easy pay with cash
* Added possibility to open cash drawer after cash payment
* Cancel the order in Adyen as well when order is cancelled in Magento
* Automatically create shipment for cash payment and added setting to do this for POS payments as well
* Added checkbox for shoppers in CreditCard payments to not save their creditcard data for OneClick payments
* Added Setting to disable payment method openinvoice(Klarna/AfterPay) when billing and delivery addresses differ
* Show the payment method in Payment Information block of the order
* After canceling payment on Adyen HPP reactivate current quote instead of creating a new quote
* Added client side validation on "delivery_days" on the settings page in Magento
* HPP Payment method show correct label in payment information panel in the Magento checkout page
* POS now acts on CAPTURE notification instead of AUTHORIZATION
* CANCEL_OR_REFUND improvements for POS
* Improved support for Scanners that press enter after scanning barcode
* OneStepCheckout improvments

<h4>Fixes</h4>
* Fixed that OneClick will not breaks when creditcard name has special characters
* Fixed that the extra fee totals in the order confirmation email is not visible when the amount is zero.
* Fixed Directory Lookup for amounts under the one euro and improved error messages when payment methods cannot be shown because of incorrect settings
* Fixed that PaymentMethod is shown if you print the invoice
* Fixed incorrect rounding in tax for OpenInvoice payment method
* Fixed that GetInstallments call is not executed when installments are disabled
* Fixed Client side validation for JCB, Maestro and CarteBlue
* Fixed that in the backend the configuration are loaded from the store view where the order has been made instead of the default settings
* Fixed that BankTransfer and SEPA are always auto captured because you can’t capture the payment method
* Fixed that DeliveryDate For Boleto is now correctly send to Adyen platform
* Fixed that Ajax calls now support the HTTPS protocol

<h3>2.1.0</h3>
<h4>Features & Fixes</h4>
 * Show OneClick payments in Magento checkout
 * New API payment method SEPA
 * Add discount for the payment method open invoice (karna/Afterpay)
 * Optimized UI in the payment step (for the default OnePage checkout and the OneStepCheckout module)
 * Build in scan functionality for using Magento as cash register solution
 * express checkout button for payments through the Adyen Shuttle
 * Creditcard installments can now be setup foreach creditcard type
 * Installment rate (in %) is now added to the installment setup
 * For Klarna it is now possible to show date of birth and gender only when you select payment method open invoice
 * Multicurrency problem with Api Payments solved
 * Show reservationNumber for Klarna and AfterPay in the payment information of the order
 * Directory lookup call to retrieve the payment methods shown in the payment step can now be cached for better performance
 * Payment methods can now be sorted in the front-end
 * Boleto firstname and lastname automatically filled in based on billing information
 * For Boleto payments the paid amount is now shown in the payment information of the order detail page
 * Possible to select different status for Boleto if the payment is overpaid or underpaid
 * Full refund will send in Cancel\Refund request to Adyen if payment is not yet captured the order will be cancelled
 * For payment method Klarna and after pay the fields are disabled on the Adyen HPP
 * Payment methods in the checkout give back the language specific payment method text
 * Add after pay logo in magento checkout
 * Plugin version number and links for setting up now visible in the Adyen General settings sections

<h3>2.0.3</h3>
<h4>Features & Fixes</h4>
 
 * HPP payment method selection now automatically loaded from the selected skin (Adyen calls this directory lookup)
 * Module namespace and module name is now Adyen/Payment instead of Madia/Adyen
 * CSE now better support for the onestepcheckout modules as well
 * CSE IE8 Fix
 * Possible to make Cash payments


<h3>1.0.0.8</h3>
<h4>Features and Fixes:</h4>
 * Recurring contract default is ONECLICK and fully changeable
 * OpenInvoice payment method supports afterpay and Klarna
 * API payments available in the backend
 * Bank transfer (incl. international) added as HPP payment options
 * Adyen AUTHORIZATION status (succeeded/failed) visible in order overview
 * Saving configuration removes spaces in front and end of input value
 * DeliveryDate for Boleto payments is now configurable
 * Completion email is now triggered when notification AUTHORIZATION is received
 * Added payment method POS. Automatic redirect to Adyen app for the payment
 * Payment to applicable countries now available for all payment methods
 * Fixed time-out in notification (removed the filelock system). 

<h3>1.0.0.7</h3>

<h4>Features:</h4>
 * CC with client side encryption
 * CC with 3D secure
 * new Boleto payment method (Brazilian market)

<h4>Fixes:</h4>
 * notification receival now works properly on NFS
 * improved logging
