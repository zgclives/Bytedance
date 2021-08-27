<?php declare(strict_types=1);


namespace Bytedance\Kernel\Exceptions;

use Exception as BaseException;

class Exception extends BaseException
{
    public function toString(): string
    {
        return <<<LOG
bytedance mini app error: $this->message. file: $this->file:$this->line. 
LOG;
    }

    public function __toString():string
    {
        return $this->toString();
    }
}
