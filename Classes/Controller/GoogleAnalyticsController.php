<?php

namespace VV\T3googleanalytics\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class GoogleAnalyticsController extends ActionController
{
    /**
     * @param array $parameter
     */
    public function writeConfiguration(array $parameter)
    {
        if (TYPO3_MODE === 'FE') {
            $parameter['footerData']['inject-t3googleanalytics-configuration'] = "
                <script>
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
                </script>
            ";
        }
    }

    /**
     * @return string
     */
    protected function getTrackingId(): string
    {
        $trackingId = '';
        $sysTemplate = $GLOBALS['TSFE']->cObj->getRecords('sys_template', [
            'pidInList' => $GLOBALS['TSFE']->cObj->getData('leveluid:0'),
            'max' => 1,
        ]);

        if (isset($sysTemplate[0]['google_analytics_tracking_id'])) {
            $trackingId = $sysTemplate[0]['google_analytics_tracking_id'];
        }

        return $trackingId;
    }
}
