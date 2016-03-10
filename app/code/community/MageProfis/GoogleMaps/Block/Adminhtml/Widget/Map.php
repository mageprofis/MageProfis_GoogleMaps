<?php

class MageProfis_GoogleMaps_Block_Adminhtml_Widget_Map extends Mage_Adminhtml_Block_Template
{
    protected $_template = 'mp_googlemaps/adminhtml/widget/gmap.phtml';

    /**
     * Get the API key
     *
     * @return string Api key
     */
    public function getApiKey()
    {
        return Mage::helper('mp_googlemaps')->getApiKey();
    }
}
