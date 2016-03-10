<?php

class MageProfis_GoogleMaps_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_API_KEY = 'mp_googlemaps/general/api_key';

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
     * @param mixed $values
     * @param array $ignore
     *
     * @return mixed Base64 decoded value or array with decoded values
     */
    public function decodeWidgetValues($values, $ignore = array())
    {
        if (!is_array($values)) {
            return base64_decode($values);
        }

        foreach ($values as $key => $value) {
            if ( is_scalar($value) && !in_array($key, $ignore) ) {
                $values[$key] = base64_decode($value);
            }
        }

        return $values;
    }

    /**
     * @param mixed $values
     * @param array $ignore
     *
     * @return mixed Base64 encoded value or array with encoded values
     */
    public function encodeWidgetValues($values, $ignore = array())
    {
        if ( !is_array($values) && !in_array($key, $ignore) ) {
            return base64_encode($values);
        }

        foreach ($values as $key => $value) {
            if (is_scalar($value)) {
                $values[$key] = base64_encode($value);
            }
        }

        return $values;
    }
}
