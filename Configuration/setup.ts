googleAnalyticsPage = PAGE
googleAnalyticsPage {
    typeNum = 301

    config {
        admPanel = 0
        debug = 0
        no_cache = 1
        contentObjectExceptionHandler = 0
        sourceopt.enabled = 0

        disableAllHeaderCode = 1
        additionalHeaders {
            10.header = Content-Type: application/javascript;charset=UTF-8
            # Cache for 1 month
            20.header = Cache-Control: max-age=2678400
        }

        xhtml_cleaning = 0
    }

    1000 = USER
    1000 {
        userFunc = TYPO3\CMS\Extbase\Core\Bootstrap->run

        vendorName = VV
        extensionName = T3googleanalytics
        pluginName = Pi1
        controller = GoogleAnalytics
        action = show
    }
}
