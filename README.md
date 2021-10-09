Analytics 0.8.16
=================
Web analytics and cookie consent banner.

<p align="center"><img src="analytics-screenshot.png?raw=true" width="795" height="836" alt="Screenshot"></p>

## How to add web analytics

This extension adds web analytics through third-party services and creates a GDPR-compliant cookie consent banner.

Supported services are [Matomo](https://matomo.org/docs/installation/), [Open Web Analytics](https://github.com/Open-Web-Analytics/Open-Web-Analytics/wiki/), 
[Google Analytics](https://marketingplatform.google.com/about/analytics/), [Facebook Pixel](https://developers.facebook.com/docs/facebook-pixel/implementation) and [Hotjar](https://www.hotjar.com/).

The extension does nothing if no service is configured.

## Settings

The following settings can be configured in file `system/extensions/yellow-system.ini`:

`AnalyticsStyle` (default: `medium`) = banner style; possible values are `rounded`, `medium`, `squared`  
`AnalyticsPosition` (default: `right`) = banner position; possible values are `left` and `right`  
`AnalyticsPolicy` = page for policy, e.g. `cookies`  
`AnalyticsMatomo` = Matomo URL and siteId, e.g. `mysite.org/matomo#1`  
`AnalyticsOpenWebAnalytics` = Open Web Analytics URL and siteId, e.g. `mysite.org/owa#12345`  
`AnalyticsGoogleAnalytics` = Google Analytics alphanumeric code  
`AnalyticsFacebookPixel` = Facebook Pixel numeric code  
`AnalyticsHotjar` = Hotjar numeric code  

## Installation

[Download extension](https://github.com/GiovanniSalmeri/yellow-analytics/archive/master.zip) and copy zip file into your `system/extensions` folder. Right click if you use Safari.

This extension uses [GlowCookies](https://manucaralmo.github.io/glow-cookies-web/) by Manuel Carrillo Almoguera.

## Developer

Giovanni Salmeri. [Get help](https://github.com/GiovanniSalmeri/yellow-analytics/issues).
