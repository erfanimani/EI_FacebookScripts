<?php

class EI_FacebookScripts_Block_Conversion extends Mage_Core_Block_Template
{

    private function _isEnabled()
    {
        return Mage::getStoreConfig(sprintf(
            '%s/conversion/enabled',
            EI_FacebookScripts_Model_Config::XML_NAMESPACE
        ));
    }

    protected function _getPixelId()
    {
        return Mage::getStoreConfig(sprintf(
            '%s/conversion/pixel_id',
            EI_FacebookScripts_Model_Config::XML_NAMESPACE
        ));
    }

    /**
     * Returns the order from the checkout/session singleton. Luckily they
     * cache the order object it in the session object so multiple calls
     * won't have an effect on performance.
     *
     * @return Mage_Checkout_Model_Session last placed order by current session
     */
    protected function _getOrder()
    {
        return Mage::getSingleton('checkout/session')->getLastRealOrder();
    }

    /**
     * Returns the currency code of the currency the order was placed with.
     * (Otherwise you can do order->getBaseCurrencyCode. Make sure to also
     * change the getValue to return order->getBaseGrandTotal
     *
     * @return string currency code
     */
    protected function _getCurrency()
    {
        return $this->_getOrder()->getStoreCurrencyCode();
    }

    /**
     * Returns the grand total. Value amount is with the currency the order was
     * placed in
     *
     * @return string
     */
    protected function _getValue()
    {
        $currency = Mage::app()->getStore()->getCurrentCurrency();
        $total    = $this->_getOrder()->getGrandTotal();

        return $currency->format(
            $total,
            array('display' => Zend_Currency::NO_SYMBOL),
            false
        );
    }

    protected function _toHtml()
    {
        if ($this->_isEnabled() && $this->_getPixelId()) {
            return parent::_toHtml();
        }
        return '';
    }

}
