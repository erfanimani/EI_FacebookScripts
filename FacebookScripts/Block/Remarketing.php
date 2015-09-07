<?php

class EI_FacebookScripts_Block_Remarketing extends Mage_Core_Block_Template
{

    private function _isEnabled()
    {
        return Mage::getStoreConfig(sprintf(
            '%s/remarketing/enabled',
            EI_FacebookScripts_Model_Config::XML_NAMESPACE
        ));
    }

    protected function _getPixelId()
    {
        return Mage::getStoreConfig(sprintf(
            '%s/remarketing/pixel_id',
            EI_FacebookScripts_Model_Config::XML_NAMESPACE
        ));
    }

    protected function _toHtml()
    {
        if ($this->_isEnabled() && $this->_getPixelId()) {
            return parent::_toHtml();
        }
        return '';
    }

}
