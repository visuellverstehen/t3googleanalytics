[![Build Status](https://travis-ci.org/visuellverstehen/t3googleanalytics.svg)](https://travis-ci.org/visuellverstehen/t3googleanalytics)
[![Downloads](https://img.shields.io/packagist/dt/visuellverstehen/t3googleanalytics.svg)](https://packagist.org/packages/visuellverstehen/t3googleanalytics)

# t3googleanalytics
An easy and basic Google Analytics extension for TYPO3.

## How to use
1. Install TYPO3 extension via [composer](https://packagist.org/packages/visuellverstehen/t3googleanalytics), [TER](https://extensions.typo3.org/extension/t3googleanalytics/) or download and install manually.
2. Configure extension: Add Google Analytics tracking ID within sys_template.
3. Call `googleAnalyticsDisable()` or `googleAnalyticsEnable()` via JavaScript to disable or enable Google Analytics. In the beginning it is enabled.

## Tips
- To allow onclick events within CKEditor add `extraAllowedContent: '*(*)[onclick]'` to your CKEditor configuration file.
