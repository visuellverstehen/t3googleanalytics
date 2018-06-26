<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 't3googleanalytics',
    'description' => 'An easy and basic Google Analytics extension for TYPO3.',
    'category' => 'fe',
    'author' => 'visuellverstehen',
    'author_email' => 'kontakt@visuellverstehen.de',
    'author_company' => 'visuellverstehen',
    'state' => 'stable',
    'clearCacheOnLoad' => true,
    'version' => '0.2.0',
    'constraints' => [
        'depends' => [
            'typo3' => '7.6.0-8.7.99',
        ]
    ]
];
