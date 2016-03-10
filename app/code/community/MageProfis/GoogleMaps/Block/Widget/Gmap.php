<?php

class MageProfis_GoogleMaps_Block_Widget_Gmap
    extends Mage_Core_Block_Template
    implements Mage_Widget_Block_Interface
{
    const XML_PATH_API_KEY = 'mp_googlemaps/general/api_key';

    protected $_template = 'mp_googlemaps/gmap.phtml';

    protected $_reservedData = array(
        'type', 'name_in_layout', 'area', 'module_name',
        'name', '_is_changed', '_renderer_name',
    );

    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        if (!$this->getLayout()->getBlock('init.gmaps')) {
            $initBlock = $this->getLayout()
                ->createBlock('core/template', 'init.gmaps')
                ->setTemplate('mp_googlemaps/init.phtml');

            $this->getLayout()->getBlock('before_body_end')->append($initBlock);
        }
    }

    /**
     * Get the API key from system configuration
     *
     * @return string Api key
     */
    public function getApiKey()
    {
        return Mage::getStoreConfig(self::XML_PATH_API_KEY);
    }

    /**
     * Try to find an address in content_html
     *
     * @return string
     */
    public function getAddress()
    {
        $dom = DOMDocument::loadHtml(str_replace(array('<br>', '<br/>', '<br />'), ' ', $this->getContentHtml()));
        $sxml = simplexml_import_dom($dom);

        foreach ($sxml->xpath('//p[@itemprop="address"]') as $addr) {
            $addr = iconv('UTF-8', 'ISO8859-1', (string) $addr);
            return urlencode($addr);
        }

        return '';
    }

    public function getMapId()
    {
        return 'gmap_' . md5($this->getNameInLayout());
    }

    /**
     * @see http://magento.stackexchange.com/questions/59958/html-tags-in-widgets-breaks-edit-mode
     */
    public function getData($key = '', $index = null)
    {
        // Check for decoded flag on widget, as needed with
        // custom preset configurations, widget instances, and
        // other cases where widget configuration is not
        // passed through the widget builder controller.
        if (parent::getData('is_data_decoded')) {
            // If already decoded, then return as-is
            return parent::getData($key, $index);
        }

        if ('' === $key) {
            $data = Mage::helper('mp_googlemaps')->decodeWidgetValues($this->_data, $this->_reservedData);
        } else {
            $data = parent::getData($key, $index);

            if (is_scalar($data)) {
                $data = Mage::helper('mp_googlemaps')->decodeWidgetValues($data, $this->_reservedData);
            }
        }

        return $data;
    }
}
