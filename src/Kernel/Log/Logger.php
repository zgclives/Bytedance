<?php declare(strict_types=1);


namespace Bytedance\Kernel\Log;


use Bytedance\Kernel\Exceptions\Exception;
use Psr\Log\LoggerInterface;

class Logger
{
    /**
     * @var LoggerInterface
     */
    protected $handler;

    public function __construct(LoggerInterface $handler)
    {
        $this->handler = $handler;
    }

    /**
     * log error message from exception
     * @param Exception $exception
     */
    public function errorFromException(Exception $exception): void
    {
        $this->error($exception->toString());
    }

    /**
     * log error message
     * @param string $message
     * @param array $context
     */
    public function error(string $message, array $context = []): void
    {
        $this->handler->error($message, $context);
    }

    /**
     * debug error message
     * @param string $message
     * @param array $context
     */
    public function debug(string $message, array $context = []): void
    {
        $this->handler->debug($message, $context);
    }
}
