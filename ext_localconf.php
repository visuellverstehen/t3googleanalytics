<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'VV.T3googleanalytics',
    'Pi1',
    [
        'GoogleAnalytics' => 'show',
    ],
    [
        'GoogleAnalytics' => '',
    ]
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-preProcess'][] =
     \VV\T3googleanalytics\Controller\GoogleAnalyticsController::class . '->writeConfiguration';