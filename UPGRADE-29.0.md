UPGRADE to 29.0
===============

Version 29 is a rename of the module. It replaces the isaac module in favor of the io module.

To replace the code sniff standard in your project, the following steps are required.

Remove isaac module
-------------------
```shell
composer remove --dev isaac/php-code-sniffer-standard
```

Install version 29.0 of the io module
-------------------------------------
```shell
composer require --dev --update-with-dependencies iodigital/php-code-sniffer-standard ^29.0
```
