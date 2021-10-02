<?php
// Cookieconsent extension

class YellowCookieconsent {
    const VERSION = "0.8.16";
    public $yellow;         // access to API
    
    // Handle initialisation
    public function onLoad($yellow) {
        $this->yellow = $yellow;
        $this->yellow->system->setDefault("CookieconsentStyle", "1"); // 1, 2 or 3
        $this->yellow->system->setDefault("CookieconsentPolicy", "");
        $this->yellow->system->setDefault("CookieconsentGoogleAnalytics", "");
        $this->yellow->system->setDefault("CookieconsentFacebookPixel", "");
        $this->yellow->system->setDefault("CookieconsentHotjar", "");
    }
    
    // Handle page extra data
    public function onParsePageExtra($page, $name) {
        $output = null;
        if ($name=="header") {
            $extensionLocation = $this->yellow->system->get("coreServerBase").$this->yellow->system->get("coreExtensionLocation");
            $output = "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"{$extensionLocation}cookieconsent.css\" />\n";
            $output .= "<script type=\"text/javascript\"  src=\"{$extensionLocation}cookieconsent.js\"></script>\n";
            $output .= "<script type=\"text/javascript\" defer=\"defer\">\n";
            $output .= "    glowCookies.start(null, ";
            $output .= json_encode([
                style => $this->yellow->system->get("CookieconsentStyle"),
                position => "right",
                analytics => $this->yellow->system->get("CookieconsentGoogleAnalytics"),
                facebookPixel => $this->yellow->system->get("CookieconsentFacebookPixel"),
                HotjarTrackingCode => $this->yellow->system->get("CookieconsentHotjar"),
// controllare se la base viene presa bene
                policyLink => $this->yellow->system->get("CookieconsentPolicy") ? $page->getBase($this->yellow->system->get("coreMultiLanguageMode"))."/".$this->yellow->system->get("CookieconsentPolicy") : null,
                bannerHeading => $this->yellow->language->getTextHtml("CookieconsentBannerHeading"),
                bannerDescription => $this->yellow->language->getTextHtml("CookieconsentBannerDescription"),
                bannerLinkText => $this->yellow->language->getTextHtml("CookieconsentBannerLinkText"),
                acceptBtnText => $this->yellow->language->getTextHtml("CookieconsentAcceptBtnText"),
                rejectBtnText => $this->yellow->language->getTextHtml("CookieconsentRejectBtnText"),
                manageText => $this->yellow->language->getTextHtml("CookieconsentManageText"),
	    ], JSON_UNESCAPED_UNICODE);
            $output .= ");\n";
            $output .= "</script>\n";
        }
        return $output;
    }
}
