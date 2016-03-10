<?php

class MageProfis_GoogleMaps_Block_Adminhtml_Widget_Gmap
    extends Mage_Adminhtml_Block_Widget
{
    /**
     * Prepare map element HTML
     *
     * @param Varien_Data_Form_Element_Abstract $element Form Element
     * @return Varien_Data_Form_Element_Abstract
     */
    public function prepareElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $uniqId = Mage::helper('core')->uniqHash($element->getId());

        $map = $this->getLayout()->createBlock('mp_googlemaps/adminhtml_widget_map')
            ->setElement($element)
            ->setTranslationHelper($this->getTranslationHelper())
            ->setConfig($this->getConfig())
            ->setFieldsetId($this->getFieldsetId())
            ->setUniqId($uniqId);

        $element->setData('after_element_html', $map->toHtml());
        return $element;
    }
}
