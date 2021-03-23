<?php

namespace VV\T3googleanalytics\Controller;

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

class GoogleAnalyticsController
{
    /**
     * @param array $parameter
     */
    public function writeConfiguration(array $parameter)
    {
        if (TYPO3_MODE === 'FE' && $this->getTrackingId() !== '') {
            $this->getPageRenderer()->addJsFooterInlineCode('t3googleanalytics-configuration', "
              var googleAnalyticsTrackingId = '" . $this->getTrackingId() . "',
                googleAnalyticsDisabledCookie = 'google-analytics-disable-' + googleAnalyticsTrackingId;

              // Function to disable Google Analytics
              var googleAnalyticsDisable = function() {
                document.cookie = googleAnalyticsDisabledCookie + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
                window[googleAnalyticsDisable] = true;
              };

              // Function to enable Google Analytics
              var googleAnalyticsEnable = function() {
                document.cookie = googleAnalyticsDisabledCookie + '=true; expires=Thu, 01 Jan 1970 00:00:01 UTC; path=/';
                window[googleAnalyticsDisable] = false;
              };

              // Load and start Google Analytics if not disabled
              if (document.cookie.indexOf(googleAnalyticsDisabledCookie + '=true') === -1) {
                var googleAnalyticsScript = document.createElement('script');
                googleAnalyticsScript.onload = function () {
                  window.dataLayer = window.dataLayer || [];
                  function gtag(){dataLayer.push(arguments);}
                  gtag('js', new Date());
                  gtag('config', googleAnalyticsTrackingId, {
                    'transport_type': 'beacon',
                    'anonymize_ip': true
                  });
                };
                googleAnalyticsScript.src = 'https://www.googletagmanager.com/gtag/js?id=' + googleAnalyticsTrackingId;
                document.head.appendChild(googleAnalyticsScript);
              }
            ");
        }
    }

    /**
     * @return string
     */
    protected function getTrackingId(): string
    {
        $tsfe = $this->getTypoScriptFrontendController();
        $sysTemplate = $tsfe->cObj->getRecords('sys_template', [
            'pidInList' => $tsfe->cObj->getData('leveluid:0'),
            'max' => 1,
        ]);

        // Returns the tracking id from the sys_template record
        if (isset($sysTemplate[0]['google_analytics_tracking_id'])) {
            return $sysTemplate[0]['google_analytics_tracking_id'];
        }

        // Returns the tracking id from the runThroughTemplatesPostProcessing hook
        if (isset($tsfe->tmpl->setup_constants['google_analytics_tracking_id'])) {
            return $tsfe->tmpl->setup_constants['google_analytics_tracking_id'];
        }

        // Returns the tracking id from the site configuration settings
        if (method_exists($tsfe, 'getSite')) {
            $settings = $tsfe->getSite()->getConfiguration()['settings'];

            return isset($settings['googleAnalyticsTrackingId']) ? $settings['googleAnalyticsTrackingId'] : '';
        }
    }

    /**
     * @return PageRenderer
     */
    protected function getPageRenderer(): PageRenderer
    {
        return GeneralUtility::makeInstance(PageRenderer::class);
    }

    /**
     * @return TypoScriptFrontendController
     */
    protected function getTypoScriptFrontendController(): TypoScriptFrontendController
    {
        return $GLOBALS['TSFE'] ?? GeneralUtility::makeInstance(TypoScriptFrontendController::class);
    }
}
