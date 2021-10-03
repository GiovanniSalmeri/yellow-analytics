Cookieconsent 0.8.16
=================
Web analytics and cookie consent banner.

<p align="center"><img src="cookieconsent-screenshot.png?raw=true" width="795" height="836" alt="Screenshot"></p>

## How to add a cookie consent banner

This extension adds analytics by Matomo, Google Analytics, Facebook Pixel or Hotjar to the site and creates a GDPR-compliant cookie consent banner which enables or disables them.

## Settings

The following settings can be configured in file `system/extensions/yellow-system.ini`:

`CookieconsentStyle` (default: `2`) = banner style; possible values are `1`, `2`, `3`  
`CookieconsentPolicy` = page for policy, e.g. `privacy-statement`  
`CookieconsentMatomo` = Matomo URL and siteId, e.g. `mysite.org/matomo#1`  
`CookieconsentGoogleAnalytics` = Google Analytics alphanumeric tracking code  
`CookieconsentFacebookPixel` = Facebook Pixel numeric code  
`CookieconsentHotjar` = Hotjar numeric tracking code  

Al least one of `CookieconsentMatomo`, `CookieconsentGoogleAnalytics`, `CookieconsentFacebookPixel` or `CookieconsentHotjar` must be set for the banner to be shown.

## Installation

[Download extension](https://github.com/GiovanniSalmeri/yellow-cookieconsent/archive/master.zip) and copy zip file into your `system/extensions` folder. Right click if you use Safari.

This extension uses [GlowCookies](https://manucaralmo.github.io/glow-cookies-web/) by Manuel Carrillo Almoguera.

## Developer

Giovanni Salmeri. [Get help](https://github.com/GiovanniSalmeri/yellow-metatags/issues).
