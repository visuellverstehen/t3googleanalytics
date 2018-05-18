<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 't3googleanalytics',
    'description' => 'An easy and basic Google Analytics extension for TYPO3.',
    'category' => 'fe',
    'author' => 'visuellverstehen',
    'author_email' => 'kontakt@visuellverstehen.de',
    'author_company' => 'visuellverstehen',
    'state' => 'beta',
    'clearCacheOnLoad' => true,
    'version' => '0.1.4',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-8.7.99',
        ]
    ]
];
