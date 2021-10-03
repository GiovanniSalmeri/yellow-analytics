<?php
// Cookieconsent extension

class YellowCookieconsent {
    const VERSION = "0.8.16";
    public $yellow;         // access to API
    
    // Handle initialisation
    public function onLoad($yellow) {
        $this->yellow = $yellow;
        $this->yellow->system->setDefault("cookieconsentStyle", "1"); // 1, 2 or 3
        $this->yellow->system->setDefault("cookieconsentPolicy", "");
        $this->yellow->system->setDefault("cookieconsentGoogleAnalytics", "");
        $this->yellow->system->setDefault("cookieconsentFacebookPixel", "");
        $this->yellow->system->setDefault("cookieconsentHotjar", "");
    }
    
    // Handle page extra data
    public function onParsePageExtra($page, $name) {
        $output = null;
        if ($name=="header") {
            if ($this->yellow->system->isExisting("cookieconsentGoogleAnalytics") || $this->yellow->system->isExisting("cookieconsentFacebookPixel") || $this->yellow->system->isExisting("cookieconsentHotjar")) {
                $extensionLocation = $this->yellow->system->get("coreServerBase").$this->yellow->system->get("coreExtensionLocation");
                $output = "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"{$extensionLocation}cookieconsent.css\" />\n";
                $output .= "<script type=\"text/javascript\"  src=\"{$extensionLocation}cookieconsent.js\"></script>\n";
                $output .= "<script type=\"text/javascript\" defer=\"defer\">\n";
                $output .= "    glowCookies.start(null, ";
                $output .= json_encode([
                    style => $this->yellow->system->get("cookieconsentStyle"),
                    position => "right",
                    analytics => $this->yellow->system->get("cookieconsentGoogleAnalytics"),
                    facebookPixel => $this->yellow->system->get("cookieconsentFacebookPixel"),
                    HotjarTrackingCode => $this->yellow->system->get("cookieconsentHotjar"),
                    policyLink => $this->yellow->system->get("cookieconsentPolicy") ? $page->getBase($this->yellow->system->get("coreMultiLanguageMode"))."/".$this->yellow->system->get("cookieconsentPolicy") : null,
                    bannerHeading => $this->yellow->language->getTextHtml("cookieconsentBannerHeading"),
                    bannerDescription => $this->yellow->language->getTextHtml("cookieconsentBannerDescription"),
                    bannerLinkText => $this->yellow->language->getTextHtml("cookieconsentBannerLinkText"),
                    acceptBtnText => $this->yellow->language->getTextHtml("cookieconsentAcceptBtnText"),
                    rejectBtnText => $this->yellow->language->getTextHtml("cookieconsentRejectBtnText"),
                    manageText => $this->yellow->language->getTextHtml("cookieconsentManageText"),
                ], JSON_UNESCAPED_UNICODE);
                $output .= ");\n";
                $output .= "</script>\n";
            }
        }
        return $output;
    }
}
