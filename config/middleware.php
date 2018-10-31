<?php

return [
    'techadmin.admin' => [
        \techadmin\middleware\AuthCheck::class,
        \techadmin\middleware\PermissionCheck::class,
        \techadmin\middleware\LogRecord::class,
    ],
];
