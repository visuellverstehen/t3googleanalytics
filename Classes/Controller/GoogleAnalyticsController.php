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
            $parameter['footerData']['inject-t3googleanalytics-configuration'] = '
                <script type="text/javascript" src="https://www.googletagmanager.com/gtag/js?id=' . $this->getTrackingId() . '" async></script>
                <script type="text/javascript">
                   window.dataLayer = window.dataLayer || [];
                   function gtag(){dataLayer.push(arguments);}
                   gtag("js", new Date());
                   gtag("config", "' . $this->getTrackingId() . '", {
                     "transport_type": "beacon",
                     "anonymize_ip": true
                   });
               </script>
            ';
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
