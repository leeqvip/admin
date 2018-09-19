<?php
namespace techadmin\controller\auth;

use techadmin\model\OperationLog;
use techadmin\support\AbstractController;
use think\Controller;

class Log extends AbstractController
{

    protected $operationLog;

    public function __construct(OperationLog $operationLog)
    {
        parent::__construct();
        $this->operationLog = $operationLog;
    }

    public function index()
    {
        $logs = $this->operationLog->order('id', 'desc')->paginate();
        return $this->fetch('auth/log/index', [
            'logs' => $logs,
        ]);
    }
}
