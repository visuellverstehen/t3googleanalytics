[![Actions](https://github.com/visuellverstehen/t3googleanalytics/workflows/TER/badge.svg)](https://github.com/visuellverstehen/t3googleanalytics/actions)
[![Downloads](https://img.shields.io/packagist/dt/visuellverstehen/t3googleanalytics.svg)](https://packagist.org/packages/visuellverstehen/t3googleanalytics)

# t3googleanalytics
An easy and basic Google Analytics extension for TYPO3.

## How to use
1. Install TYPO3 extension via [composer](https://packagist.org/packages/visuellverstehen/t3googleanalytics), [TER](https://extensions.typo3.org/extension/t3googleanalytics/) or download and install manually.
1. [Configure the extension](#configuration)
1. Call `googleAnalyticsDisable()` or `googleAnalyticsEnable()` via JavaScript to disable or enable Google Analytics. By default it is enabled. The user can disable tracking with a simple button which can look like this: `<a onclick="return googleAnalyticsDisable();">Disbale GA Opt Tracking</a>`

<a name="configuration"></a>
## Configure the extension
There are several options to add your tracking id. The following list will show you all options in the prioritized order.
1. Add the tracking ID within the sys_template row via the backend module

![screenshot of the new field inside the template backend module](https://user-images.githubusercontent.com/2337693/64471407-12e3ba00-d16f-11e9-840c-2b7b4b2df39c.png)

2. When you add your template through the [runThroughTemplatesPostProcessing hook](https://docs.typo3.org/c/typo3/cms-core/master/en-us/Changelog/8.6/Feature-79140-AddHookToAddCustomTypoScriptTemplates.html) add the tracking ID like so:

```php
// $row is your template record array
$row['constants'] .= 'google_analytics_tracking_id = UA-11111111-1';
```

3. Add the tracking ID directly to the settings section inside your site configuration file:

```yaml
settings:
  googleAnalyticsTrackingId: UA-11111111-1
```

## Tips
- To allow onclick events within CKEditor add `extraAllowedContent: '*(*)[onclick]'` to your CKEditor configuration file. Then you can add a link with `onclick="return googleAnalyticsDisable();"`
