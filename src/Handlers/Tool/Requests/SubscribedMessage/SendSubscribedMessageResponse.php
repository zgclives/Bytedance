<?php

namespace Bytedance\Handlers\Tool\Requests\SubscribedMessage;

use Bytedance\Kernel\Http\Response;

class SendSubscribedMessageResponse extends Response
{
    /**
     * @var array
     */
    public $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    public static function create(array $array)
    {
        return new static($array);
    }
}
