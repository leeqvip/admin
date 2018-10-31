<?php

namespace techadmin\middleware;

use techadmin\model\OperationLog;
use techadmin\service\auth\facade\Auth;

class LogRecord
{
    protected $operationLog;

    public function __construct(OperationLog $operationLog)
    {
        $this->operationLog = $operationLog;
    }

    public function handle($request, \Closure $next)
    {
        $this->createLog($request);

        return $next($request);
    }

    protected function createLog($request)
    {
        $adminer = Auth::user();
        $this->operationLog->create([
            'adminer_id' => $adminer ? $adminer->id : 0,
            'path' => $request->path(),
            'method' => $request->method(),
            'ip' => $request->ip(),
            'input' => var_export($request->param(), true),
            'useragent' => $request->header('User-Agent'),
        ]);
    }
}
