/*
    GLOW COOKIES
    CREATED BY MANUEL CARRILLO
    https://github.com/manucaralmo/GlowCookies
    2021 - v 3.1.3

Changes by GS 2021-10-02
https://github.com/GiovanniSalmeri/yellow-analytics

+ Corrected according to https://github.com/manucaralmo/GlowCookies/discussions/40
+ Deleted SVG
+ Deleted addCss
+ Deleted languages
+ Added Matomo
+ Added Open Web Analytics
+ Cookies banner prepended, not appended (accessibility)
+ ARIA roles added (accessibility)
+ DOM instead of innerHTML

*/

class GlowCookies {
  constructor() {
    // Cookies banner
    this.banner = undefined
    // Config
    this.config = undefined
    this.tracking = undefined
    // DOM ELEMENTS
    this.PreBanner = undefined
    this.Cookies = undefined
    this.DOMbanner = undefined
  }

  render() {
    this.createDOMElements()
    this.checkStatus()
  }

  createDOMElements() {
    // COOKIES BUTTON
    this.PreBanner = document.createElement('div');
    this.PreBanner.style.display = 'none';
      this.PreBannerButton = document.createElement('button');
      this.PreBannerButton.type = 'button';
      this.PreBannerButton.id = 'prebannerBtn';
      this.PreBannerButton.className = `prebanner prebanner__border__${this.config.bannerStyle} glowCookies__${this.config.position} glowCookies__${this.config.border} animation`;
      this.PreBannerButton.style.color = this.banner.manageCookies.color;
      this.PreBannerButton.style.backgroundColor = this.banner.manageCookies.background;
      this.PreBannerButton.textContent = this.banner.manageCookies.text;
    this.PreBanner.appendChild(this.PreBannerButton);
    document.body.appendChild(this.PreBanner);

    // COOKIES BANNER
    this.Cookies = document.createElement('div');
    this.Cookies.id = 'glowCookies-banner';
    this.Cookies.className = `glowCookies__banner glowCookies__banner__${this.config.bannerStyle} glowCookies__${this.config.border} glowCookies__${this.config.position}`;
    this.Cookies.style.backgroundColor = this.banner.background;
    this.Cookies.setAttribute('role', 'dialog');
    this.Cookies.setAttribute('aria-modal', 'false');
    this.Cookies.setAttribute('aria-labelledby', 'cookie-consent-title');
    this.Cookies.setAttribute('aria-describedby', 'cookie-consent-message');
      this.CookiesHeading = document.createElement('h3');
      this.CookiesHeading.id = 'cookie-consent-title';
      this.CookiesHeading.style.color = this.banner.color;
      this.CookiesHeading.textContent = this.banner.heading;
    this.Cookies.appendChild(this.CookiesHeading);
      this.CookiesContent = document.createElement('p');
      this.CookiesContent.id = 'cookie-consent-message';
      this.CookiesContent.style.color = this.banner.color;
        this.CookiesNotice = document.createTextNode(this.banner.description+' ');
      this.CookiesContent.appendChild(this.CookiesNotice);
        this.CookiesLink = document.createElement('a');
        this.CookiesLink.href = this.banner.link;
        this.CookiesLink.className = 'read__more';
        this.CookiesLink.style.color = this.banner.color;
        this.CookiesLink.textContent = this.banner.linkText;
      this.CookiesContent.appendChild(this.CookiesLink);
    this.Cookies.appendChild(this.CookiesContent);
      this.CookiesButtons = document.createElement('div');
      this.CookiesButtons.className = 'btn__section';
        this.CookiesButton1 = document.createElement('button');
        this.CookiesButton1.type = 'button';
        this.CookiesButton1.id = 'acceptCookies';
        this.CookiesButton1.className = 'btn__accept accept__btn__styles';
        this.CookiesButton1.style.color = this.banner.acceptBtn.color;
        this.CookiesButton1.style.backgroundColor = this.banner.acceptBtn.background;
        this.CookiesButton1.textContent = this.banner.acceptBtn.text;
      this.CookiesButtons.appendChild(this.CookiesButton1);
        this.CookiesButton2 = document.createElement('button');
        this.CookiesButton2.type = 'button';
        this.CookiesButton2.id = 'rejectCookies';
        this.CookiesButton2.className = 'btn__settings settings__btn__styles';
        this.CookiesButton2.style.color = this.banner.rejectBtn.color;
        this.CookiesButton2.style.backgroundColor = this.banner.rejectBtn.background;
        this.CookiesButton2.textContent = this.banner.rejectBtn.text;
      this.CookiesButtons.appendChild(this.CookiesButton2);
    this.Cookies.appendChild(this.CookiesButtons);

    document.body.insertBefore(this.Cookies,document.body.firstChild);
    this.DOMbanner = document.getElementById('glowCookies-banner')

    // SET EVENT LISTENERS
    document.getElementById('prebannerBtn').addEventListener('click', () => this.openSelector())
    document.getElementById('acceptCookies').addEventListener('click', () => this.acceptCookies())
    document.getElementById('rejectCookies').addEventListener('click', () => this.rejectCookies())
  }

  checkStatus() {
    switch (localStorage.getItem("GlowCookies")) {
      case "1":
        this.openManageCookies();
        this.activateTracking();
        this.addCustomScript();
        break;
      case "0":
        this.openManageCookies();
        break;
      default:
        this.openSelector();
    }
  }

  openManageCookies() {
    this.PreBanner.style.display = this.config.hideAfterClick ? "none" : "block"
    this.DOMbanner.classList.remove('glowCookies__show')
  }

  openSelector() {
    this.PreBanner.style.display = "none";
    this.DOMbanner.classList.add('glowCookies__show')
  }

  acceptCookies() {
    localStorage.setItem("GlowCookies", "1")
    this.openManageCookies()
    this.activateTracking()
    this.addCustomScript()
  }

  rejectCookies() {
    localStorage.setItem("GlowCookies", "0");
    this.openManageCookies();
    this.disableTracking();
  }

  activateTracking() {
    // Matomo Tracking
    if (this.tracking.MatomoTrackingUrl) {
      let MatomoTrackingParts = this.tracking.MatomoTrackingUrl.split("#");
      let MatomoTrackingData = document.createElement('script');
      MatomoTrackingData.text = `
                                var _paq = window._paq = window._paq || [];
                                _paq.push(['trackPageView']);
                                _paq.push(['enableLinkTracking']);
                                (function() {
                                  var u="//${MatomoTrackingParts[0]}/";
                                  _paq.push(['setTrackerUrl', u+'matomo.php']);
                                  _paq.push(['setSiteId', ${MatomoTrackingParts[1]}]);
                                  var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                                  g.type='text/javascript'; g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
                                })();
                                `;
      document.head.appendChild(MatomoTrackingData);
    }

    // Open Web Analytics
    if (this.tracking.OpenWebAnalyticsUrl) {
      let OpenWebAnalyticsParts = this.tracking.OpenWebAnalyticsUrl.split("#");
      let OpenWebAnalyticsScript = document.createElement('script');
      OpenWebAnalyticsScript.setAttribute('src', `'//${OpenWebAnalyticsParts[0]}//modules/base/js/owa.tracker-combined-min.js';`);
      document.head.appendChild(OpenWebAnalyticsScript);
      let OpenWebAnalyticsData = document.createElement('script');
      OpenWebAnalyticsData.text = `
                                OWA.setSetting('baseUrl', '//${OpenWebAnalyticsParts[0]}/');
                                OWATracker = new OWA.tracker();
                                OWATracker.setSiteId('${OpenWebAnalyticsParts[1]}');
                                OWATracker.trackPageView();
                                OWATracker.trackClicks();
                                OWATracker.trackDomStream();
                                `;
      document.head.appendChild(OpenWebAnalyticsData);
    }

    // Google Analytics Tracking
    if (this.tracking.AnalyticsCode) {
      let Analytics = document.createElement('script');
      Analytics.setAttribute('src', `https://www.googletagmanager.com/gtag/js?id=${this.tracking.AnalyticsCode}`);
      document.head.appendChild(Analytics);
      let AnalyticsData = document.createElement('script');
      AnalyticsData.text = `window.dataLayer = window.dataLayer || [];
                                function gtag(){dataLayer.push(arguments);}
                                gtag('js', new Date());
                                gtag('config', '${this.tracking.AnalyticsCode}');`;
      document.head.appendChild(AnalyticsData);
    }

    // Facebook pixel tracking code
    if (this.tracking.FacebookPixelCode) {
      let FacebookPixelData = document.createElement('script');
      FacebookPixelData.text = `
                                    !function(f,b,e,v,n,t,s)
                                    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                                    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                                    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                                    n.queue=[];t=b.createElement(e);t.async=!0;
                                    t.src=v;s=b.getElementsByTagName(e)[0];
                                    s.parentNode.insertBefore(t,s)}(window, document,'script',
                                    'https://connect.facebook.net/en_US/fbevents.js');
                                    fbq('init', '${this.tracking.FacebookPixelCode}');
                                    fbq('track', 'PageView');
                                `;
      document.head.appendChild(FacebookPixelData);
      let FacebookPixelNS = document.createElement('noscript');
      let FacebookPixel = document.createElement('img');
      FacebookPixel.setAttribute('height', `1`);
      FacebookPixel.setAttribute('width', `1`);
      FacebookPixel.setAttribute('style', `display:none`);
      FacebookPixel.setAttribute('src', `https://www.facebook.com/tr?id=${this.tracking.FacebookPixelCode}&ev=PageView&noscript=1`);
      FacebookPixelNS.appendChild(FacebookPixel);
      document.head.appendChild(FacebookPixelNS);
    }

    // Hotjar Tracking
    if (this.tracking.HotjarTrackingCode) {
      let hotjarTrackingData = document.createElement('script');
      hotjarTrackingData.text = `
                                (function(h,o,t,j,a,r){
                                    h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                                    h._hjSettings={hjid:${this.tracking.HotjarTrackingCode},hjsv:6};
                                    a=o.getElementsByTagName('head')[0];
                                    r=o.createElement('script');r.async=1;
                                    r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                                    a.appendChild(r);
                                })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
                                `;
      document.head.appendChild(hotjarTrackingData);
    }
  }

  disableTracking() {
    // Google Analytics Tracking ('client_storage': 'none')
    if (this.tracking.AnalyticsCode) {
      let Analytics = document.createElement('script');
      Analytics.setAttribute('src', `https://www.googletagmanager.com/gtag/js?id=${this.tracking.AnalyticsCode}`);
      document.head.appendChild(Analytics);
      let AnalyticsData = document.createElement('script');
      AnalyticsData.text = `window.dataLayer = window.dataLayer || [];
                        function gtag(){dataLayer.push(arguments);}
                        gtag('js', new Date());
                        gtag('config', '${this.tracking.AnalyticsCode}' , {
                            'client_storage': 'none',
                            'anonymize_ip': true
                        });`;
      document.head.appendChild(AnalyticsData);
    }

    // Clear cookies - not working 100%
    this.clearCookies()
  }

  clearCookies() {
    let cookies = document.cookie.split("; ");
    for (let c = 0; c < cookies.length; c++) {
      let d = window.location.hostname.split(".");
      while (d.length > 0) {
        let cookieBase = encodeURIComponent(cookies[c].split(";")[0].split("=")[0]) + '=; expires=Thu, 01-Jan-1970 00:00:01 GMT; domain=' + d.join('.') + ' ;path=';
        let p = location.pathname.split('/');
        document.cookie = cookieBase + '/';
        while (p.length > 0) {
          document.cookie = cookieBase + p.join('/');
          p.pop();
        };
        d.shift();
      }
    }
  }

  addCustomScript() {
    if (this.tracking.customScript !== undefined) {
      let customScriptTag

      this.tracking.customScript.forEach(script => {
        if (script.type === 'src') {
          customScriptTag = document.createElement('script');
          customScriptTag.setAttribute('src', script.content);
        } else if (script.type === 'custom') {
          customScriptTag = document.createElement('script');
          customScriptTag.text = script.content;
        }

        if (script.position === 'head') {
          document.head.appendChild(customScriptTag);
        } else {
          document.body.appendChild(customScriptTag);
        }
      })
    }
  }

  start(languaje, obj) {
    if (!obj) obj = {}
    //const lang = new LanguagesGC(languaje)

    this.config = {
      border: obj.border || 'border',
      position: obj.position || 'left',
      hideAfterClick: obj.hideAfterClick || false,
      bannerStyle: obj.style || 2
    }

    this.tracking = {
      MatomoTrackingUrl: obj.matomo || undefined,
      OpenWebAnalyticsUrl: obj.owa || undefined,
      AnalyticsCode: obj.google || undefined,
      FacebookPixelCode: obj.facebookPixel || undefined,
      HotjarTrackingCode: obj.hotjar || undefined,
      customScript: obj.customScript || undefined
    }

    this.banner = {
      description: obj.bannerDescription || lang.bannerDescription,
      linkText: obj.bannerLinkText || lang.bannerLinkText,
      link: obj.policyLink || '#link',
      background: obj.bannerBackground || '#fff',
      color: obj.bannerColor || '#1d2e38',
      heading: obj.bannerHeading !== 'none' ? obj.bannerHeading || lang.bannerHeading : '',
      acceptBtn: {
        text: obj.acceptBtnText || lang.acceptBtnText,
        background: obj.acceptBtnBackground || '#253b48',
        color: obj.acceptBtnColor || '#fff'
      },
      rejectBtn: {
        text: obj.rejectBtnText || lang.rejectBtnText,
        background: obj.rejectBtnBackground || '#E8E8E8',
        color: obj.rejectBtnColor || '#636363'
      },
      manageCookies: {
        color: obj.manageColor || '#1d2e38',
        background: obj.manageBackground || '#fff',
        text: obj.manageText || lang.manageText,
      }
    }

    // Draw banner
    window.addEventListener('load', () => { this.render() })
  }
}

const glowCookies = new GlowCookies()
