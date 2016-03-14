MageProfis GoogleMaps Extension
=====================

Facts
-----
- version: 1.0.0
- [extension on GitHub](https://github.com/mageprofis/MageProfis_GoogleMaps)

Description
-----------
> **tl;dr**: Add Google Maps to any CMS content area.

This module adds a Magento widget that can be used like any other widget (e.g. on CMS pages, static blocks, ...). Just select the widget from the drop down list, move the pin to the desired location and set a zoom level. If you like, you can add a (HTML) description. If you do, you should considger using a microformat to describe the data (like an address). More information about microformats can be found [here](https://developers.google.com/structured-data/schema-org) and [here](http://schema.org/). A click on the map will open the target in a new window/tab.

# Example

```html
<div class="address" itemscope itemtype="http://schema.org/LocalBusiness">
    <p><b><span itemprop="name">Company name</span> Location</b></p>
    <p itemprop="address">Street No.<br>Zip-Code City</p>
    <p>Tel. <span class="tel" itemprop="telephone">01234/56789</span><br>Fax <span class="fax" itemprop="faxNumber">01234/56788</span></p>
    <p><a href="mailto:info@domain.com" itemprop="email">info@domain.com</a></p>
</div>
```

Please take notice of the P tag with the `itemprop="address"` attribute. The innerHTML will be used as address for the external link.

Requirements
------------
- PHP >= 5.3.0

Compatibility
-------------
- Magento >= 1.5

Support
-------
If you have any issues with this extension, open an issue on [GitHub](https://github.com/mageprofis/MageProfis_GoogleMaps/issues).

Contribution
------------
Any contribution is highly appreciated. The best way to contribute code is to open a [pull request on GitHub](https://help.github.com/articles/using-pull-requests).

Developer
---------
Volker Thiel
[http://www.mage-profis.de](http://www.mage-profis.de)

Licence
-------
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)

Copyright
---------
(c) 2016 Mage-Profis GmbH
