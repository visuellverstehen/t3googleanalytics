<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_template', [
    'google_analytics_tracking_id' => [
        'exclude' => true,
        'label' => 'LLL:EXT:t3googleanalytics/Resources/Private/Language/locallang.xlf:tx_t3googleanalytics.google_analytics_tracking_id',
        'config' => [
            'type' => 'input',
            'eval' => 'trim,nospace,upper'
        ]
    ],
]);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_template', '
    --div--;LLL:EXT:t3googleanalytics/Resources/Private/Language/locallang.xlf:tx_t3googleanalytics.tab_title,
        google_analytics_tracking_id
');