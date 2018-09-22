# TechAdmin 

## Intro

基于ThinkPHP5.1+和AmazeUI的快速后台开发框架

## Install

最方便的安装方式就是使用Composer ( https://getcomposer.org/ )，在这之前务必先搭建好thinkphp5.1项目

1、安装 TechAdmin :

```
composer require techone/admin
```

2、初始化和数据迁移

```
php think techadmin:init
php think techadmin:migrate:run
```

3、配置

添加行为在 `application/tags.php`

```
return [

    'app_init'     => [
        \techadmin\behavior\Boot::class,
    ],

    // ...
];
```

## 进入TechAdmin后台

打开后台地址，例如：

http://yourdomain/admin



