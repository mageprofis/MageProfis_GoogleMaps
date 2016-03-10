<?php

require_once 'Mage/Widget/controllers/Adminhtml/WidgetController.php';

class MageProfis_GoogleMaps_Adminhtml_WidgetController
    extends Mage_Widget_Adminhtml_WidgetController
{

    protected function _setOptions($request)
    {
        $optionsBlock = $this->getLayout()->getBlock('wysiwyg_widget.options');

        if (isset($request['widget_type'])) {
            $optionsBlock->setWidgetType($request['widget_type']);
        }

        if (isset($request['values'])) {
            // Decode only if type is your widget
            if ($optionsBlock->getWidgetType() == 'mp_googlemaps/widget_gmap') {
                $request['values'] = Mage::helper('mp_googlemaps')->decodeWidgetValues($request['values']);
            }

            $optionsBlock->setWidgetValues($request['values']);
        }

        return $this;
    }

    public function buildWidgetAction()
    {
        $type   = $this->getRequest()->getPost('widget_type');
        $params = $this->getRequest()->getPost('parameters', array());
        $asIs   = $this->getRequest()->getPost('as_is');

        // Encode all params for your widget
        if ($type == 'mp_googlemaps/widget_gmap') {
            $params = Mage::helper('mp_googlemaps')->encodeWidgetValues($params);
        }

        $html = Mage::getSingleton('widget/widget')->getWidgetDeclaration($type, $params, $asIs);

        $this->getResponse()
            ->setBody($html);
    }

    public function loadOptionsAction()
    {
        try {
            $this->loadLayout('empty');

            if ( ($paramsJson = $this->getRequest()->getParam('widget')) ) {
                $request = Mage::helper('core')->jsonDecode($paramsJson);

                if (is_array($request)) {
                    $this->_setOptions($request);
                }

                $this->renderLayout();
            }
        } catch (Mage_Core_Exception $e) {
            $result = array('error' => true, 'message' => $e->getMessage());

            $this->getResponse()
                ->setBody(Mage::helper('core')->jsonEncode($result));
        }
    }
}
