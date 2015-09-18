<?php
class TIG_Buckaroo3Extended_Model_Masterpass_v06
{
    /**
     * InitializeCheckout - return parameters from Masterpass for the lightbox javascript
     */
    public function lightbox()
    {
        try
        {
            // get quote from session
            $session = Mage::getSingleton('checkout/session');
            $quote = $session->getQuote();

            // set Masterpass as chosen payment method
            $paymentMethod = Mage::getModel('buckaroo3extended/paymentMethods_masterpass_paymentMethod');
            $quote->getPayment()->importData(array('method' => $paymentMethod->getCode()));

            // initiate request
            $quoteRequest = Mage::getModel('buckaroo3extended/request_quote', array('quote' => $quote));

            // do the request
            $parameters = $quoteRequest->sendRequest();

            // return lightbox parameters
            return $parameters;
        }
        catch (Exception $e)
        {
            Mage::helper('buckaroo3extended')->logException($e);

            return Mage::getModel('buckaroo3extended/response_abstract', array(
                'response'   => false,
                'XML'        => false,
                'debugEmail' => isset($quoteRequest) ? $quoteRequest->getDebugEmail() : '',
            ))->processResponse();
        }
    }

    /**
     * FinalizeCheckout - finish a payment when all supplied information is final
     */
    public function pay()
    {
        $session = Mage::getSingleton('checkout/session');
        $quote = $session->getQuote();

        // Check if order exists and create order from quote if not
        $order = Mage::getModel('sales/order')->load($quote->getId(), 'quote_id');

        // initiate request
        $quoteFinalRequest = Mage::getModel('buckaroo3extended/request_quoteFinal');
        $quoteFinalRequest->setOrder($order);
//            ->setOrderBillingInfo();
        $response = $quoteFinalRequest->sendRequest();

        /**
         * invoicenumber is invalid for the action FinalizeCheckOut.
         * originaltransaction (or originaltransactionreference and originaltransactionreferencetype) should be provided for the action originaltransactionreferencetype.
         */

        var_dump($response);
        die;

        // @TODO implement Buckaroo FinalizeCheckout request

        return false;
    }
}