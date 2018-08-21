ISAAC PHPCS
===========

Extending the default [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) with ISAAC rules

### Installation

First, add the path of this repo to the composer file in your project:

```
composer config phpcs vcs git@gitlab.isaac.local:php-module/phpcs.git
```

Now require the package:

```
composer require-dev "php-module/phpcs:^1.0"
```

### Setup
Create a `phpcs.xml`-file in the root of your project, which extends the default ISAAC ruleset:

```
<?xml version="1.0" encoding="UTF-8"?>
<ruleset name="phpcs-isaac">
    <!-- include root folder of project -->
    <file>.</file>
    <!-- exclude paths -->
    <exclude-pattern>./src/Migrations</exclude-pattern>
    <exclude-pattern>./vendor</exclude-pattern>

    <!-- extend isaac ruleset -->
    <rule ref="vendor/php-module/phpcs/phpcs.xml"/>
</ruleset>
```

Modify the excluded paths and/or include custom rulesets for your project.