<?php

return [
    \techadmin\service\upload\contract\Factory::class => \techadmin\service\upload\Uploader::class,
    \techadmin\service\auth\contract\Authenticate::class => \techadmin\model\Adminer::class,
    \techadmin\service\auth\guard\contract\Guard::class => \techadmin\service\auth\guard\SessionGuard::class,
    \techadmin\service\auth\contract\Auth::class => \techadmin\service\auth\Auth::class,
];
