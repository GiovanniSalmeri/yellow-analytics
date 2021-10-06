<?php
// Analytics extension, https://github.com/GiovanniSalmeri/yellow-analytics

class YellowAnalytics {
    const VERSION = "0.8.16";
    public $yellow;         // access to API
    
    // Handle initialisation
    public function onLoad($yellow) {
        $this->yellow = $yellow;
        $this->yellow->system->setDefault("analyticsStyle", "2"); // 1, 2 or 3
        $this->yellow->system->setDefault("analyticsPosition", "right"); // left or right
        $this->yellow->system->setDefault("analyticsPolicy", "");
        $this->yellow->system->setDefault("analyticsMatomo", "");
        $this->yellow->system->setDefault("analyticsOpenWebAnalytics", "");
        $this->yellow->system->setDefault("analyticsGoogleAnalytics", "");
        $this->yellow->system->setDefault("analyticsFacebookPixel", "");
        $this->yellow->system->setDefault("analyticsHotjar", "");
    }
    
    // Handle page extra data
    public function onParsePageExtra($page, $name) {
        $output = null;
        if ($name=="header") {
            if ($this->yellow->system->isExisting("analyticsMatomo") || $this->yellow->system->isExisting("analyticsOpenWebAnalytics") || $this->yellow->system->isExisting("analyticsGoogleAnalytics") || $this->yellow->system->isExisting("analyticsFacebookPixel") || $this->yellow->system->isExisting("analyticsHotjar")) {
                $extensionLocation = $this->yellow->system->get("coreServerBase").$this->yellow->system->get("coreExtensionLocation");
                $output = "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"{$extensionLocation}analytics.css\" />\n";
                $output .= "<script type=\"text/javascript\"  src=\"{$extensionLocation}analytics.js\"></script>\n";
                $output .= "<script type=\"text/javascript\" defer=\"defer\">\n";
                $output .= "    glowCookies.start(null, ";
                $output .= json_encode([
                    style => $this->yellow->system->get("analyticsStyle"),
                    position => $this->yellow->system->get("analyticsPosition"),
                    matomo => $this->yellow->system->get("analyticsMatomo"),
                    owa => $this->yellow->system->get("analyticsOpenWebAnalytics"),
                    google => $this->yellow->system->get("analyticsGoogleAnalytics"),
                    facebookPixel => $this->yellow->system->get("analyticsFacebookPixel"),
                    hotjar => $this->yellow->system->get("analyticsHotjar"),
                    policyLink => $this->yellow->system->get("analyticsPolicy") ? $page->getBase($this->yellow->system->get("coreMultiLanguageMode"))."/".$this->yellow->system->get("analyticsPolicy") : null,
                    bannerHeading => $this->yellow->language->getText("analyticsBannerHeading"),
                    bannerDescription => $this->yellow->language->getTextHtml("analyticsBannerDescription"),
                    bannerLinkText => $this->yellow->language->getText("analyticsBannerLinkText"),
                    acceptBtnText => $this->yellow->language->getText("analyticsAcceptBtnText"),
                    rejectBtnText => $this->yellow->language->getText("analyticsRejectBtnText"),
                    manageText => $this->yellow->language->getText("analyticsManageText"),
                ], JSON_UNESCAPED_UNICODE);
                $output .= ");\n";
                $output .= "</script>\n";
            }
        }
        return $output;
    }
}
