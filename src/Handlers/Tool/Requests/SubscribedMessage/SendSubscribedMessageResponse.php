<?php

namespace Bytedance\Handlers\Tool\Requests\SubscribedMessage;

use Bytedance\Kernel\Http\Response;

class SendSubscribedMessageResponse extends Response
{
    /**
     * @var int
     */
    public $err_no;

    /**
     * @var string
     */
    public $err_tips;

    public function __construct($err_no, $err_tips)
    {
        $this->err_no   = $err_no;
        $this->err_tips = $err_tips;
    }

    public static function create(array $array)
    {
        return new static($array['err_no'], $array['err_tips']);
    }
}
