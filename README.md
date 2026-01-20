# iO PHP_CodeSniffer Standard

Extending the default [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) with iO rules


## Installation

Require the package:

```
composer require --dev iodigital-com/php-code-sniffer-standard
```


## Setup
Create a `phpcs.xml`-file in the root of your project, and include the default iO ruleset:

```
<?xml version="1.0" encoding="UTF-8"?>
<ruleset>
    <arg name="cache"/>

    <!-- include root folder of project , change to your framework requirements -->
    <file>.</file>
    <!-- exclude paths -->
    <exclude-pattern>./src/Migrations</exclude-pattern>
    <exclude-pattern>./vendor</exclude-pattern>
    <exclude-pattern>./local-repo</exclude-pattern>

    <!-- include all rules in iO ruleset -->
    <rule ref="IO"/>
    <rule ref="YourFramework"/> <!-- include your framework standards -->
    
    <!-- Configure minimum supported PHP version (used by PHP_CodeSniffer and Slevomat sniffs) -->
    <config name="php_version" value="80100"/>
    <!-- Configure PHP version or range of PHP versions (used by PHPCompatibility sniffs) -->
    <config name="testVersion" value="8.2-8.5"/>
</ruleset>
```

Modify the excluded paths and PHP versions and optionally include custom rulesets for your project.


## Usage

Since you now have a `phpcs.xml` file in the root of your project, you can run the default phpcs command: `vendor/bin/phpcs`.

### Ignoring sniff violations

Sometimes a violation of a sniff cannot be resolved. In this case, the violation should be ignored using the `phpcs:ignore` and `phpcs:disable` / `phpcs:enable` annotations.

In order to do this, please take the following approach:
1. Ignore only the *parts* of the file that cause the violation, not the file itself. If it is *really* the case the file should be ignored, you can use the `phpcs:ignoreFile` annotation or, better, add an `<exclude-pattern>` to the `ruleset.xml` of the project.
2. Prefer `phpcs:ignore` over `phpcs:disable` and `phpcs:enable`, i.e. use `phpcs:ignore` when this is possible and when the placement of the `phpcs:ignore` does not introduce any other sniff violations, use `phpcs:disable` and `phpcs:enable` otherwise. Rationale: using `phpcs:disable` and `phpcs:enable` might disable more code than initially intended when adding new code or moving existing code, for instance when refactoring code.
3. Always indicate the exact sniff or sniffs that are going to be ignored, use the complete sniff name, not only the sniff group. So for instance use `phpcs:ignore Squiz.WhiteSpace.FunctionSpacing.BeforeFirst, Squiz.WhiteSpace.FunctionSpacing.AfterLast` instead of `phpcs:ignore Squiz.WhiteSpace.FunctionSpacing` or `phpcs:ignore` without any arguments.
4. Prefer placing the `phpcs:ignore` annotation on a separate line *before* the violation over placing it on the line of the violation itself. Rationale: when ignoring multiple sniffs, the `phpcs:ignore` annotation can quickly exceed the line length limit; this is *not* checked when the `phpcs:ignore` annotation is placed on a separate line before the violation, but it is checked when the `phpcs:ignore` annotation is placed on the line of the violation itself.
5. Add an explanation why the sniff is ignored using `--` followed by a short explanation.

Example:

```php
try {
    $this->logger->log(LogLevel::INFO, new DateTimeImmutable());
//phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedCatch -- DateTimeImmutable creation cannot fail in this case
} catch (Exception $exception) {
}
```

## Contributing

If you want to contribute, create a merge request with **one sniff per merge request**. Please provide
an example in the description of what the sniff is about with a good and bad code snippet.

**Note**: Adding new phpcs rules to this package must result in a major version update!
