Analytics 0.8.16
=================
Web analytics and cookie consent banner.

<p align="center"><img src="analytics-screenshot.png?raw=true" alt="Screenshot"></p>

## How to install an extension

[Download ZIP file](https://github.com/GiovanniSalmeri/yellow-analytics/archive/main.zip) and copy it into your `system/extensions` folder. [Learn more about extensions](https://github.com/annaesvensson/yellow-update).

## How to add web analytics

This extension adds web analytics through third-party services and creates a GDPR-compliant cookie consent banner.

Supported services are [Matomo](https://matomo.org/docs/installation/), [Open Web Analytics](https://github.com/Open-Web-Analytics/Open-Web-Analytics/wiki/), 
[Google Analytics](https://marketingplatform.google.com/about/analytics/), [Facebook Pixel](https://developers.facebook.com/docs/facebook-pixel/implementation) and [Hotjar](https://www.hotjar.com/).

You should know that the service providers collect personal data and use cookies.

The extension does nothing if no service is configured.

## Settings

The following settings can be configured in file `system/extensions/yellow-system.ini`:

`AnalyticsStyle` = banner style, `rounded`, `medium`, or `squared`  
`AnalyticsPosition` = banner position, `left` or `right`  
`AnalyticsPolicy` = page for policy, e.g. `cookies`  
`AnalyticsMatomo` = Matomo URL and siteId, e.g. `mysite.org/matomo#1`  
`AnalyticsOpenWebAnalytics` = Open Web Analytics URL and siteId, e.g. `mysite.org/owa#12345`  
`AnalyticsGoogleAnalytics` = Google Analytics alphanumeric code  
`AnalyticsFacebookPixel` = Facebook Pixel numeric code  
`AnalyticsHotjar` = Hotjar numeric code  

## Acknowledgements

This extension includes a modified version of [GlowCookies](https://manucaralmo.github.io/glow-cookies-web/) by Manuel Carrillo Almoguera. Thank you for the good work.

## Developer

Giovanni Salmeri. [Get help](https://datenstrom.se/yellow/help/).
