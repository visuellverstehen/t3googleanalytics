<?php

namespace VV\T3googleanalytics\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extensionmanager\Utility\ConfigurationUtility;

class GoogleAnalyticsController extends ActionController
{
    /**
     * @var ConfigurationUtitlity
     */
    protected $configurationUtility = null;

    public function __construct()
    {
        $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $this->configurationUtility = $this->objectManager->get(ConfigurationUtility::class);
    }

    /**
     * @return string
     */
    public function showAction(): string
    {
        return GeneralUtility::getURL('https://www.googletagmanager.com/gtag/js?id=' . $this->getTrackingId());
    }

    /**
     * @param array $parameter
     */
    public function writeConfiguration($parameter)
    {
        if (TYPO3_MODE === 'FE') {
            // Prevent tracking bots
            if (!isset($_SERVER['HTTP_USER_AGENT']) || strpos($_SERVER['HTTP_USER_AGENT'], 'Speed Insights') === false) {
                $parameter['footerData']['inject-t3googleanalytics-configuration'] = '
                    <script src="' . $GLOBALS['TSFE']->absRefPrefix . '?type=301" async></script>
                    <script>
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
    }

    /**
     * @return string
     */
    protected function getTrackingId(): string
    {
        $extensionConfiguration = $this->configurationUtility->getCurrentConfiguration('t3googleanalytics');

        return $extensionConfiguration['tracking-id']['value'];
    }
}
