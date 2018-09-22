# TechAdmin : The admin framework based on ThinkPHP5.1+

## Intro

Quickly create an admin system

## Install

The fastest way to install TechAdmin is to add it to your project using Composer (https://getcomposer.org/).

1、Require TechAdmin as a dependency using Composer:

```
composer require techone/admin
```

2、Initialize and migrate

```
php think techadmin:init
php think techadmin:migrate:run
```

3、Config

add the behavior in `application/tags.php`

```
return [

    'app_init'     => [
        \techadmin\behavior\Boot::class,
    ],

    // ...
];
```

## Welcome to TechAdmin

open the admin link like this：

http://yourdomain/admin



