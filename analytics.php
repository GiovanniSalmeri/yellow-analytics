<?php
// Analytics extension, https://github.com/GiovanniSalmeri/yellow-analytics

class YellowAnalytics {
    const VERSION = "0.8.16";
    public $yellow;         // access to API
    
    // Handle initialisation
    public function onLoad($yellow) {
        $this->yellow = $yellow;
        $this->yellow->system->setDefault("analyticsStyle", "medium"); // rounded, medium or squared
        $this->yellow->system->setDefault("analyticsPosition", "right"); // left or right
        $this->yellow->system->setDefault("analyticsPolicy", "");
        $this->yellow->system->setDefault("analyticsMatomo", "");
        $this->yellow->system->setDefault("analyticsOpenWebAnalytics", "");
        $this->yellow->system->setDefault("analyticsGoogleAnalytics", "");
        $this->yellow->system->setDefault("analyticsFacebookPixel", "");
        $this->yellow->system->setDefault("analyticsHotjar", "");
        $this->yellow->language->setDefaults([
            "Language: af",
            "AnalyticsBannerHeading: Ons gebruik koekies",
            "AnalyticsBannerDescription: Ons gebruik ons eie koekies en die van derdepartye, om inhoud te verpersoonlik en om webverkeer te ontleed.",
            "AnalyticsBannerLinkText: Lees meer oor koekies",
            "AnalyticsAcceptBtnText: Aanvaar koekies",
            "AnalyticsRejectBtnText: Weier",
            "AnalyticsManageText: Koekie-instellings",
            "Language: bg",
            "AnalyticsBannerHeading: Ние използваме бисквитки",
            "AnalyticsBannerDescription: Използваме наши и бисквитки на трети страни, за да запазим Вашите предпочитания и да събираме аналитични данни.",
            "AnalyticsBannerLinkText: Прочетете повече за бисквитките",
            "AnalyticsAcceptBtnText: Приеми бисквитките",
            "AnalyticsRejectBtnText: Откажи",
            "AnalyticsManageText: Настрой бисквитките",
            "Language: de",
            "AnalyticsBannerHeading: Verwendung von Cookies",
            "AnalyticsBannerDescription: Wir nutzen Cookies (auch von Drittanbietern), um Inhalte zu personalisieren und Surfverhalten zu analysieren.",
            "AnalyticsBannerLinkText: Mehr über Cookies",
            "AnalyticsAcceptBtnText: Cookies akzeptieren",
            "AnalyticsRejectBtnText: Ablehnen",
            "AnalyticsManageText: Cookies verwalten",
            "Language: en",
            "AnalyticsBannerHeading: We use cookies",
            "AnalyticsBannerDescription: We use our own and third-party cookies to personalise content and to analyse web traffic.",
            "AnalyticsBannerLinkText: Read more about cookies",
            "AnalyticsAcceptBtnText: Accept cookies",
            "AnalyticsRejectBtnText: Reject",
            "AnalyticsManageText: Manage cookies",
            "Language: es",
            "AnalyticsBannerHeading: Uso de cookies",
            "AnalyticsBannerDescription: Utilizamos cookies propias y de terceros para personalizar el contenido y para analizar el tráfico de la web.",
            "AnalyticsBannerLinkText: Ver más sobre las cookies",
            "AnalyticsAcceptBtnText: Aceptar cookies",
            "AnalyticsRejectBtnText: Rechazar",
            "AnalyticsManageText: Cookies",
            "Language: fr",
            "AnalyticsBannerHeading: Nous utilisons des cookies",
            "AnalyticsBannerDescription: Nous utilisons nos propres cookies et ceux de tiers pour adapter le contenu et analyser le trafic web.",
            "AnalyticsBannerLinkText: En savoir plus sur les cookies",
            "AnalyticsAcceptBtnText: Accepter les cookies",
            "AnalyticsRejectBtnText: Refuser",
            "AnalyticsManageText: Paramétrez les cookies",
            "Language: it",
            "AnalyticsBannerHeading: Utilizziamo i cookie",
            "AnalyticsBannerDescription: Utilizziamo cookie nostri e di terze parti per personalizzare il contenuto e analizzare il traffico web.",
            "AnalyticsBannerLinkText: Per saperne di più riguardo i cookie",
            "AnalyticsAcceptBtnText: Accetta i cookie",
            "AnalyticsRejectBtnText: Rifiuta",
            "AnalyticsManageText: Gestisci i cookie",
            "Language: mg",
            "AnalyticsBannerHeading: Izahay dia mampiasa cookies",
            "AnalyticsBannerDescription: Mampiasa ny cookies anay manokana sy ireo anny antoko fahatelo izahay hampifanarahana ny atiny sy hamakafaka ny fivezivezena aminny tranonkala.",
            "AnalyticsBannerLinkText: Maniry halala bebe kokoa momba ny cookies",
            "AnalyticsAcceptBtnText: Manaiky ireo cookies",
            "AnalyticsRejectBtnText: Tsy mety",
            "AnalyticsManageText: Hamboarina ny cookies",
            "Language: nl",
            "AnalyticsBannerHeading: We gebruiken cookies",
            "AnalyticsBannerDescription: We gebruiken onze en third-party cookies om content te personaliseren en web traffic te analyseren.",
            "AnalyticsBannerLinkText: Lees meer over cookies",
            "AnalyticsAcceptBtnText: Cookies accepteren",
            "AnalyticsRejectBtnText: Weigeren",
            "AnalyticsManageText: Cookies beheren",
            "Language: oc",
            "AnalyticsBannerHeading: Utilizam de cookies",
            "AnalyticsBannerDescription: Utilizam nòstres pròpris cookies e de cookies tèrces per adaptar lo contengut e analisar lo trafic web.",
            "AnalyticsBannerLinkText: Ne saber mai suls cookies",
            "AnalyticsAcceptBtnText: Acceptar los cookies",
            "AnalyticsRejectBtnText: Refusar",
            "AnalyticsManageText: Configurar los cookies",
            "Language: pl",
            "AnalyticsBannerHeading: Używamy plików cookie",
            "AnalyticsBannerDescription: Ta strona używa plików cookie – zarówno własnych, jak i od zewnętrznych dostawców – w celu personalizacji treści i analizy ruchu.",
            "AnalyticsBannerLinkText: Więcej o plikach cookie",
            "AnalyticsAcceptBtnText: Zaakceptuj pliki cookie",
            "AnalyticsRejectBtnText: Odrzuć",
            "AnalyticsManageText: Ustawienia plików cookie",
            "Language: pt",
            "AnalyticsBannerHeading: Uso de cookies",
            "AnalyticsBannerDescription: Usamos cookies próprios e de terceiros para personalizar o conteúdo e analisar o tráfego da web.",
            "AnalyticsBannerLinkText: Leia mais sobre os cookies",
            "AnalyticsAcceptBtnText: Aceitar cookies",
            "AnalyticsRejectBtnText: Rejeitar",
            "AnalyticsManageText: Gerenciar cookies",
            "Language: sk",
            "AnalyticsBannerHeading: Používame cookies",
            "AnalyticsBannerDescription: Na prispôsobenie obsahu a analýzu webovej stránky používame vlastné cookies a cookies tretích strán.",
            "AnalyticsBannerLinkText: Čo sú cookies?",
            "AnalyticsAcceptBtnText: Povoliť cookies",
            "AnalyticsRejectBtnText: Nepovoliť",
            "AnalyticsManageText: Spravovať cookies",
            "Language: th",
            "AnalyticsBannerHeading: Cookies",
            "AnalyticsBannerDescription: พวกเราใช้คุกกี้บุคคลที่สาม เพื่อปรับแต่งเนื้อหาและวิเคราะห์การเข้าชมเว็บ",
            "AnalyticsBannerLinkText: อ่านเพิ่มเติมเกี่ยวกับคุกกี้",
            "AnalyticsAcceptBtnText: ยอมรับคุกกี้",
            "AnalyticsRejectBtnText: ปฏิเสธคุกกี้",
            "AnalyticsManageText: Cookies",
            "Language: tr",
            "AnalyticsBannerHeading: Çerez kullanımı",
            "AnalyticsBannerDescription: İçeriği kişiselleştirmek ve web trafiğini analiz etmek için kendi ve üçüncü taraf çerezlerimizi kullanıyoruz.",
            "AnalyticsBannerLinkText: Çerezler hakkında daha fazlasını okuyun",
            "AnalyticsAcceptBtnText: Çerezleri kabul et",
            "AnalyticsRejectBtnText: Reddet",
            "AnalyticsManageText: Çerezleri yönet",
            "Language: ja",
            "AnalyticsBannerHeading: Cookies を使用しています",
            "AnalyticsBannerDescription: 私たちは、コンテンツのパーソナライズやトラフィックの分析のために、独自およびサードパーティー製 Cookies を使用しています。",
            "AnalyticsBannerLinkText: Cookiesについて詳しく見る",
            "AnalyticsAcceptBtnText: Cookiesを受け入れる",
            "AnalyticsRejectBtnText: 拒否",
            "AnalyticsManageText: cookies管理",
            "Language: ru",
            "AnalyticsBannerHeading: Мы используем cookie",
            "AnalyticsBannerDescription: Мы используем собственные и сторонние куки для персонализации контента и анализа веб-трафика.",
            "AnalyticsBannerLinkText: Узнать больше про куки.",
            "AnalyticsAcceptBtnText: Ок, используйте",
            "AnalyticsRejectBtnText: Не разрешаю",
            "AnalyticsManageText: Разрешите использовать куки?",
        ]);
    }
    
    // Handle page extra data
    public function onParsePageExtra($page, $name) {
        $output = null;
        if ($name=="header") {
            if ($this->yellow->system->isExisting("analyticsMatomo") || $this->yellow->system->isExisting("analyticsOpenWebAnalytics") || $this->yellow->system->isExisting("analyticsGoogleAnalytics") || $this->yellow->system->isExisting("analyticsFacebookPixel") || $this->yellow->system->isExisting("analyticsHotjar")) {
                $extensionLocation = $this->yellow->system->get("coreServerBase").$this->yellow->system->get("coreExtensionLocation");
                $output = "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"{$extensionLocation}analytics.css\" />\n";
                $output .= "<script type=\"text/javascript\"  src=\"{$extensionLocation}analytics.js\"></script>\n";
                $output .= "<script type=\"text/javascript\">\n";
                $output .= "    glowCookies.start(";
                $output .= json_encode([
                    "style" => $this->yellow->system->get("analyticsStyle"),
                    "position" => $this->yellow->system->get("analyticsPosition"),
                    "matomo" => $this->yellow->system->get("analyticsMatomo"),
                    "owa" => $this->yellow->system->get("analyticsOpenWebAnalytics"),
                    "google" => $this->yellow->system->get("analyticsGoogleAnalytics"),
                    "facebookPixel" => $this->yellow->system->get("analyticsFacebookPixel"),
                    "hotjar" => $this->yellow->system->get("analyticsHotjar"),
                    "policyLink" => $this->yellow->system->get("analyticsPolicy") ? $page->getBase($this->yellow->system->get("coreMultiLanguageMode"))."/".$this->yellow->system->get("analyticsPolicy") : null,
                    "bannerHeading" => $this->yellow->language->getText("analyticsBannerHeading"),
                    "bannerDescription" => $this->yellow->language->getTextHtml("analyticsBannerDescription"),
                    "bannerLinkText" => $this->yellow->language->getText("analyticsBannerLinkText"),
                    "acceptBtnText" => $this->yellow->language->getText("analyticsAcceptBtnText"),
                    "rejectBtnText" => $this->yellow->language->getText("analyticsRejectBtnText"),
                    "manageText" => $this->yellow->language->getText("analyticsManageText"),
                ], JSON_UNESCAPED_UNICODE);
                $output .= ");\n";
                $output .= "</script>\n";
            }
        }
        return $output;
    }
}
