<?php declare(strict_types=1);


namespace Bytedance\Kernel\Exceptions;


use Throwable;

class InvalidSignatureException extends Exception
{
    public function __construct($message = "invalid signature", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
