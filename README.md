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

Running tests
-------------
Run `composer install` and then in the project root directory
```
./vendor/bin/phpunit
```
