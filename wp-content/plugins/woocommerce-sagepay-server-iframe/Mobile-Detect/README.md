# Mobile Detect
### The lightweight PHP class for detecting mobile devices.

> Mobile\_Detect is a lightweight PHP class for detecting mobile devices. It uses the user-agent string combined with specific HTTP headers to detect the mobile environment.

**Note:** this project is _the same_ with [http://code.google.com/p/php-mobile-detect/](http://code.google.com/p/php-mobile-detect/). We are keeping both repositories updated until the transition to GitHub is completed.

Sponsored by ![BrowserStack](http://jquery.org/wp-content/uploads/2010/01/browserstack-150.png).
[BrowserStack](http://www.browserstack.com) is a complete browser coverage tool (including mobile devices) for testing you web application.

### Usage

Include and instantiate the class:
```php
<?php
include 'Mobile_Detect.php';
$detect = new Mobile_Detect();
```
Basic usage, looking for mobile devices or tablets:
```php
<?php
if ($detect->isMobile()) {
    // Any mobile device.
}
```

```php
<?php
if($detect->isTablet()){
    // Any tablet device.
}
```

Check for a specific platform with the help of the magic methods:
```php
<?php
if($detect->isiOS()){
    // Code to run for the Apple's iOS platform.
}
```

```php
<?php
if($detect->isAndroidOS()){
    // Code to run for the Google's Android platform.
}
```
Other case insensitive available methods are `isIphone()`, `isIpad()`, `isBlackBerry()`, `isKindle()`, `isOpera()`, etc. For the full list of available methods check the `demo.php` file.

Alternative method `is()` for checking specific properties (in beta):
```php
<?php
$detect->is('Chrome')
$detect->is('iOS')
$detect->is('UC Browser')
[...]
```

Batch mode using `setUserAgent()`:
```php
<?php
$userAgents = array(
'Mozilla/5.0 (Linux; Android 4.0.4; Desire HD Build/IMM76D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19',
'BlackBerry7100i/4.1.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/103',
[...]
);
foreach($userAgents as $userAgent){
  $detect->setUserAgent($userAgent);
  $isMobile = $detect->isMobile();
  $isTablet = $detect->isTablet();
  // Use the force however you want.
}
```

Get the `version()` of components (in beta):
```php
<?php
$detect->version('iPad'); // 4.3 (float)
$detect->version('iPhone') // 3.1 (float)
$detect->version('Android'); // 2.1 (float)
$detect->version('Opera Mini'); // 5.0 (float)
[...]
```

### Projects that are using the class

* **[Symphony2](https://github.com/suncat2000/MobileDetectBundle)** - Symfony2 bundle for detect mobile devices, manage mobile view and redirect to the mobile and tablet version.
* **[Context Mobile Detect](http://drupal.org/project/context_mobile_detect)** - This is a Drupal Context module which integrates Context and PHP Mobile Detect library.
* **[WP Mobile Detect](http://wordpress.org/extend/plugins/wp-mobile-detect/)** - WP Mobile detect gives you the ability to wrap that infographic in a [notdevice][/notdevice] shortcode so at the server level WordPress will decide to show that content only if the user is NOT on a phone or tablet.
* **[Tiny Tiny RSS](http://tt-rss.org/redmine/projects/tt-rss/wiki)** - Is an open source web-based news feed (RSS/Atom) reader and aggregator, designed to allow you to read news from any location, while feeling as close to a real desktop application as possible.
* **[Responsage](https://github.com/iamspacehead/responsage)** - Is a small WordPress theme plugin that allows you to make your images responsive.
* **[bConsole](http://code.google.com/p/bconsole/)** - Creates a panel that sits on top of a browser-based project and provides information about the client machine and browser.