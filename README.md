[![Build Status](https://scrutinizer-ci.com/g/opus-online/yii2-base/badges/build.png?b=master)](https://scrutinizer-ci.com/g/opus-online/yii2-base/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/opus-online/yii2-base/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/opus-online/yii2-base/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/opus-online/yii2-base/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/opus-online/yii2-base/?branch=master)

Base components for Yii2 projects and modules
=========

This repository contains very basic building blocks for modules and projects
used by Opus Online. As the components are very specific to the projects and
modules involved, this repository is probably of little public interest.

Contents
--------
Behaviors:
* BlameableBehavior - auto-fills `created_by` and `updated_by` fields
* SafeSaverBehavior - provides `saveSafe($attributes)` method to AR models
* TimestampBehavior - auto-fills `created_at` and `updated_at` fields
* QueryLanguageBehaviour - adds functionality to generate links with query languages with ease
* ResponseFormatBehavior - auto-assigns responseType according to response header in Response object

Running tests
-------------
Run `composer install` and then in the project root directory
```
./vendor/bin/phpunit
```

Changelog
---------
* 1.2 - Added `ResponseFormatBehavior`
* 1.1 - Added `JsVariablesBehavior`, `QueryLanguageBehaviour`
* 1.0 - Initial commit