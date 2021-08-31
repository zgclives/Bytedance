<?php

namespace Bytedance\Handlers\Tool\Requests\CreateQRCode;

use Bytedance\Kernel\Http\Response;

class CreateQRCodeResponse extends Response
{
    /**
     * @var string
     */
    public $byte;

    public function __construct($byte)
    {
        $this->byte = $byte;
    }

    public static function create($byte)
    {
        return new static($byte);
    }
}
