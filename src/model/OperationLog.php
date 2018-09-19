<?php
namespace techadmin\model;

/**
 *
 */
class OperationLog extends Model
{
    protected $table = 'techadmin_operation_logs';

    public function getBrowserAttr()
    {
        return $this->getClientBrowser($this->useragent);
    }

    public function adminer()
    {
        return $this->hasOne(Adminer::class, 'id', 'adminer_id');
    }

    public function getClientBrowser($agent, $glue = ' ')
    {
        $browser = array();
        /* 定义浏览器特性正则表达式 */
        $regex = array(
            'ie'      => '/(MSIE) (\d+\.\d)/',
            'chrome'  => '/(Chrome)\/(\d+\.\d+)/',
            'firefox' => '/(Firefox)\/(\d+\.\d+)/',
            'opera'   => '/(Opera)\/(\d+\.\d+)/',
            'safari'  => '/Version\/(\d+\.\d+\.\d) (Safari)/',
        );
        foreach ($regex as $type => $reg) {
            preg_match($reg, $agent, $data);
            if (!empty($data) && is_array($data)) {
                $browser = $type === 'safari' ? array($data[2], $data[1]) : array($data[1], $data[2]);
                break;
            }
        }
        return empty($browser) ? false : (is_null($glue) ? $browser : implode($glue, $browser));
    }
}
